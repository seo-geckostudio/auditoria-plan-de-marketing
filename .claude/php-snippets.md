# PHP Code Snippets Library

**Descripción:** Plantillas de código reutilizables para patrones comunes en el MCP

---

## 📋 Índice de Snippets

1. [Service Layer Patterns](#service-layer-patterns)
2. [Controller Actions](#controller-actions)
3. [Validation Rules](#validation-rules)
4. [Database Queries](#database-queries)
5. [API Integration](#api-integration)
6. [Error Handling](#error-handling)
7. [Authentication & Authorization](#authentication--authorization)
8. [Email & Notifications](#email--notifications)

---

## Service Layer Patterns

### Basic CRUD Service

```php
<?php

namespace App\Modules\{Module}\Services;

use App\Shared\Database\Database;
use App\Shared\Exceptions\ValidationException;
use App\Shared\Exceptions\NotFoundException;
use App\Modules\{Module}\Validators\{Entity}Validator;

class {Entity}Service
{
    public function __construct(
        private Database $db,
        private {Entity}Validator $validator
    ) {}

    /**
     * Lista registros con filtros y paginación
     */
    public function listar(array $filtros = []): array
    {
        $sql = "SELECT * FROM {table} WHERE deleted_at IS NULL";
        $params = [];

        if (!empty($filtros['busqueda'])) {
            $sql .= " AND nombre LIKE ?";
            $params[] = "%{$filtros['busqueda']}%";
        }

        if (!empty($filtros['estado'])) {
            $sql .= " AND estado = ?";
            $params[] = $filtros['estado'];
        }

        $sql .= " ORDER BY created_at DESC";

        // Paginación
        $page = $filtros['page'] ?? 1;
        $perPage = $filtros['per_page'] ?? 20;
        $offset = ($page - 1) * $perPage;

        $sql .= " LIMIT ? OFFSET ?";
        $params[] = $perPage;
        $params[] = $offset;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un registro por ID
     */
    public function obtener(int $id): array
    {
        $sql = "SELECT * FROM {table} WHERE id = ? AND deleted_at IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("{Entity} no encontrado");
        }

        return $result;
    }

    /**
     * Crea un nuevo registro
     */
    public function crear(array $datos): int
    {
        // Validar datos
        $errors = $this->validator->validate($datos);
        if (!empty($errors)) {
            throw new ValidationException('Datos inválidos', $errors);
        }

        // Preparar datos para inserción
        $campos = [
            'nombre' => $datos['nombre'],
            'estado' => $datos['estado'] ?? 'activo',
            'metadata' => json_encode($datos['metadata'] ?? []),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insertar
        $placeholders = implode(',', array_fill(0, count($campos), '?'));
        $columnas = implode(',', array_keys($campos));

        $sql = "INSERT INTO {table} ($columnas) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($campos));

        return (int) $this->db->lastInsertId();
    }

    /**
     * Actualiza un registro existente
     */
    public function actualizar(int $id, array $datos): bool
    {
        // Verificar que existe
        $this->obtener($id);

        // Validar datos
        $errors = $this->validator->validate($datos, $id);
        if (!empty($errors)) {
            throw new ValidationException('Datos inválidos', $errors);
        }

        // Preparar datos
        $campos = [
            'nombre' => $datos['nombre'],
            'estado' => $datos['estado'],
            'metadata' => json_encode($datos['metadata'] ?? []),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Actualizar
        $sets = implode(',', array_map(fn($col) => "$col = ?", array_keys($campos)));
        $sql = "UPDATE {table} SET $sets WHERE id = ? AND deleted_at IS NULL";

        $params = array_values($campos);
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Elimina (soft delete) un registro
     */
    public function eliminar(int $id): bool
    {
        // Verificar que existe
        $this->obtener($id);

        $sql = "UPDATE {table} SET deleted_at = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([date('Y-m-d H:i:s'), $id]);
    }
}
```

### Service with Cache

```php
<?php

namespace App\Modules\{Module}\Services;

use App\Shared\Cache\CacheManager;

class {Entity}CachedService
{
    private const CACHE_TTL = 3600; // 1 hora

    public function __construct(
        private {Entity}Service $service,
        private CacheManager $cache
    ) {}

    public function obtenerConCache(int $id): array
    {
        $cacheKey = "entity:{$id}";

        return $this->cache->remember($cacheKey, self::CACHE_TTL, function() use ($id) {
            return $this->service->obtener($id);
        });
    }

    public function actualizarConCache(int $id, array $datos): bool
    {
        $result = $this->service->actualizar($id, $datos);

        if ($result) {
            // Invalidar cache
            $this->cache->forget("entity:{$id}");
            $this->cache->forget("entity:list");
        }

        return $result;
    }
}
```

---

## Controller Actions

### Index Action (List)

```php
/**
 * Muestra listado de registros
 */
public function index(): void
{
    try {
        // Obtener filtros desde query params
        $filtros = [
            'busqueda' => $_GET['q'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'page' => (int) ($_GET['page'] ?? 1),
            'per_page' => 20
        ];

        // Obtener datos del service
        $items = $this->service->listar($filtros);
        $total = $this->service->contar($filtros);

        // Calcular paginación
        $totalPages = ceil($total / $filtros['per_page']);

        // Renderizar vista
        $this->render('{module}/index', [
            'items' => $items,
            'filtros' => $filtros,
            'pagination' => [
                'current' => $filtros['page'],
                'total' => $totalPages,
                'per_page' => $filtros['per_page']
            ]
        ]);
    } catch (\Exception $e) {
        $this->handleError($e, "Error al listar {entities}");
    }
}
```

### Show Action (Detail)

```php
/**
 * Muestra detalle de un registro
 */
public function show(int $id): void
{
    try {
        $item = $this->service->obtener($id);

        // Obtener datos relacionados si es necesario
        $relacionados = $this->service->obtenerRelacionados($id);

        $this->render('{module}/show', [
            'item' => $item,
            'relacionados' => $relacionados
        ]);
    } catch (NotFoundException $e) {
        $this->notFound($e->getMessage());
    } catch (\Exception $e) {
        $this->handleError($e, "Error al obtener {entity}");
    }
}
```

### Create Action (Form)

```php
/**
 * Muestra formulario de creación
 */
public function create(): void
{
    try {
        // Obtener datos necesarios para el formulario
        $opciones = $this->service->obtenerOpcionesFormulario();

        $this->render('{module}/create', [
            'opciones' => $opciones,
            'csrf_token' => $this->generateCSRFToken()
        ]);
    } catch (\Exception $e) {
        $this->handleError($e, "Error al cargar formulario");
    }
}
```

### Store Action (Save)

```php
/**
 * Procesa creación de registro
 */
public function store(): void
{
    try {
        // Verificar método
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->methodNotAllowed();
            return;
        }

        // Verificar CSRF
        if (!$this->verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            $this->forbidden("Token CSRF inválido");
            return;
        }

        // Crear registro
        $id = $this->service->crear($_POST);

        // Flash message y redirect
        $this->flash('success', '{Entity} creado exitosamente');
        $this->redirect("/{route}/$id");

    } catch (ValidationException $e) {
        // Mantener datos en formulario
        $this->flash('error', 'Por favor corrija los errores');

        $opciones = $this->service->obtenerOpcionesFormulario();

        $this->render('{module}/create', [
            'errors' => $e->getErrors(),
            'old' => $_POST,
            'opciones' => $opciones,
            'csrf_token' => $this->generateCSRFToken()
        ]);
    } catch (\Exception $e) {
        $this->handleError($e, "Error al crear {entity}");
    }
}
```

### Update Action (Save Edit)

```php
/**
 * Procesa actualización de registro
 */
public function update(int $id): void
{
    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->methodNotAllowed();
            return;
        }

        if (!$this->verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            $this->forbidden("Token CSRF inválido");
            return;
        }

        $this->service->actualizar($id, $_POST);

        $this->flash('success', '{Entity} actualizado exitosamente');
        $this->redirect("/{route}/$id");

    } catch (ValidationException $e) {
        $this->flash('error', 'Por favor corrija los errores');

        $item = $this->service->obtener($id);
        $opciones = $this->service->obtenerOpcionesFormulario();

        $this->render('{module}/edit', [
            'item' => $item,
            'errors' => $e->getErrors(),
            'old' => $_POST,
            'opciones' => $opciones,
            'csrf_token' => $this->generateCSRFToken()
        ]);
    } catch (NotFoundException $e) {
        $this->notFound($e->getMessage());
    } catch (\Exception $e) {
        $this->handleError($e, "Error al actualizar {entity}");
    }
}
```

### Delete Action

```php
/**
 * Elimina un registro
 */
public function destroy(int $id): void
{
    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->methodNotAllowed();
            return;
        }

        if (!$this->verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            $this->forbidden("Token CSRF inválido");
            return;
        }

        $this->service->eliminar($id);

        $this->flash('success', '{Entity} eliminado exitosamente');
        $this->redirect('/{route}');

    } catch (NotFoundException $e) {
        $this->notFound($e->getMessage());
    } catch (\Exception $e) {
        $this->handleError($e, "Error al eliminar {entity}");
    }
}
```

### AJAX Action

```php
/**
 * Endpoint AJAX para obtener datos
 */
public function apiGet(int $id): void
{
    header('Content-Type: application/json');

    try {
        $item = $this->service->obtener($id);

        echo json_encode([
            'success' => true,
            'data' => $item
        ]);
    } catch (NotFoundException $e) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Error interno del servidor'
        ]);
    }
    exit;
}
```

---

## Validation Rules

### Basic Validator

```php
<?php

namespace App\Modules\{Module}\Validators;

use App\Shared\Validation\Validator;

class {Entity}Validator extends Validator
{
    /**
     * Reglas de validación
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:clientes,email'],
            'telefono' => ['nullable', 'regex:/^[0-9]{9,15}$/'],
            'estado' => ['required', 'in:activo,inactivo,pausado'],
            'fecha_inicio' => ['required', 'date', 'after:today'],
            'precio' => ['required', 'numeric', 'min:0'],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'metadata' => ['nullable', 'json']
        ];
    }

    /**
     * Mensajes de error personalizados
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',
            'email.email' => 'El formato del email no es válido',
            'email.unique' => 'Este email ya está registrado',
            'estado.in' => 'El estado debe ser: activo, inactivo o pausado',
            'fecha_inicio.after' => 'La fecha debe ser posterior a hoy',
            'cliente_id.exists' => 'El cliente seleccionado no existe'
        ];
    }

    /**
     * Validación condicional
     */
    public function validate(array $data, ?int $id = null): array
    {
        $rules = $this->rules();

        // Para update, email único debe excluir el registro actual
        if ($id !== null) {
            $rules['email'][2] = "unique:clientes,email,$id";
        }

        // Validación condicional
        if (!empty($data['requiere_factura'])) {
            $rules['cif'] = ['required', 'string'];
            $rules['razon_social'] = ['required', 'string'];
        }

        return $this->performValidation($data, $rules);
    }
}
```

### Custom Validation Rules

```php
<?php

namespace App\Shared\Validation;

class CustomValidationRules
{
    /**
     * Valida que un archivo sea CSV
     */
    public static function csv($value): bool
    {
        if (!is_array($value) || !isset($value['tmp_name'])) {
            return false;
        }

        $mime = mime_content_type($value['tmp_name']);
        return in_array($mime, ['text/csv', 'text/plain', 'application/csv']);
    }

    /**
     * Valida código postal español
     */
    public static function codigoPostalES(string $value): bool
    {
        return preg_match('/^(0[1-9]|[1-4][0-9]|5[0-2])[0-9]{3}$/', $value);
    }

    /**
     * Valida NIF/CIF español
     */
    public static function nifCif(string $value): bool
    {
        $value = strtoupper(trim($value));

        // Validar formato
        if (!preg_match('/^[A-Z0-9]{9}$/', $value)) {
            return false;
        }

        // Validar letra de control (simplificado)
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $number = substr($value, 0, 8);
        $letter = substr($value, 8, 1);

        if (is_numeric($number)) {
            return $letters[(int)$number % 23] === $letter;
        }

        return true; // CIF (validación completa más compleja)
    }

    /**
     * Valida URL de dominio
     */
    public static function domain(string $value): bool
    {
        return (bool) preg_match('/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/i', $value);
    }

    /**
     * Valida que un valor sea JSON válido
     */
    public static function json(string $value): bool
    {
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
```

---

## Database Queries

### Complex Query with Joins

```php
/**
 * Obtiene auditorías con información de cliente y consultor
 */
public function obtenerAuditoriasCompletas(array $filtros = []): array
{
    $sql = "
        SELECT
            a.id,
            a.titulo,
            a.estado,
            a.progreso,
            a.created_at,
            c.nombre as cliente_nombre,
            c.dominio as cliente_dominio,
            u.nombre as consultor_nombre,
            COUNT(DISTINCT ap.id) as total_pasos,
            SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados
        FROM auditorias a
        INNER JOIN clientes c ON a.cliente_id = c.id
        INNER JOIN usuarios u ON a.consultor_id = u.id
        LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
        WHERE a.deleted_at IS NULL
    ";

    $params = [];

    if (!empty($filtros['estado'])) {
        $sql .= " AND a.estado = ?";
        $params[] = $filtros['estado'];
    }

    if (!empty($filtros['consultor_id'])) {
        $sql .= " AND a.consultor_id = ?";
        $params[] = $filtros['consultor_id'];
    }

    $sql .= " GROUP BY a.id, c.id, u.id";
    $sql .= " ORDER BY a.created_at DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
```

### Aggregate Query

```php
/**
 * Obtiene estadísticas de auditorías
 */
public function obtenerEstadisticas(int $consultorId = null): array
{
    $sql = "
        SELECT
            COUNT(*) as total,
            SUM(CASE WHEN estado = 'en_progreso' THEN 1 ELSE 0 END) as en_progreso,
            SUM(CASE WHEN estado = 'completada' THEN 1 ELSE 0 END) as completadas,
            AVG(progreso) as progreso_promedio,
            AVG(DATEDIFF(fecha_finalizacion, fecha_inicio)) as dias_promedio
        FROM auditorias
        WHERE deleted_at IS NULL
    ";

    $params = [];

    if ($consultorId) {
        $sql .= " AND consultor_id = ?";
        $params[] = $consultorId;
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetch(\PDO::FETCH_ASSOC);
}
```

### Transaction Example

```php
/**
 * Crea auditoría con pasos iniciales (transacción)
 */
public function crearAuditoriaConPasos(array $datosAuditoria): int
{
    try {
        $this->db->beginTransaction();

        // 1. Crear auditoría
        $auditoriaId = $this->crearAuditoria($datosAuditoria);

        // 2. Copiar plantilla de pasos
        $sql = "
            INSERT INTO auditoria_pasos (auditoria_id, paso_plantilla_id, orden, estado)
            SELECT ?, id, orden, 'pendiente'
            FROM pasos_plantilla
            WHERE deleted_at IS NULL
            ORDER BY orden
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$auditoriaId]);

        // 3. Registrar en historial
        $this->registrarCambio($auditoriaId, 'creacion', 'Auditoría creada');

        $this->db->commit();

        return $auditoriaId;

    } catch (\Exception $e) {
        $this->db->rollBack();
        throw $e;
    }
}
```

---

## API Integration

### HTTP Client Wrapper

```php
<?php

namespace App\Shared\HTTP;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HTTPClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'connect_timeout' => 10,
            'http_errors' => false // Manejamos errores manualmente
        ]);
    }

    /**
     * GET request
     */
    public function get(string $url, array $query = [], array $headers = []): array
    {
        try {
            $response = $this->client->get($url, [
                'query' => $query,
                'headers' => $headers
            ]);

            return $this->parseResponse($response);

        } catch (GuzzleException $e) {
            throw new \Exception("Error en petición GET: " . $e->getMessage());
        }
    }

    /**
     * POST request
     */
    public function post(string $url, array $data = [], array $headers = []): array
    {
        try {
            $response = $this->client->post($url, [
                'json' => $data,
                'headers' => $headers
            ]);

            return $this->parseResponse($response);

        } catch (GuzzleException $e) {
            throw new \Exception("Error en petición POST: " . $e->getMessage());
        }
    }

    /**
     * POST form data
     */
    public function postForm(string $url, array $formData, array $headers = []): array
    {
        try {
            $response = $this->client->post($url, [
                'form_params' => $formData,
                'headers' => $headers
            ]);

            return $this->parseResponse($response);

        } catch (GuzzleException $e) {
            throw new \Exception("Error en petición POST: " . $e->getMessage());
        }
    }

    /**
     * Parsea respuesta HTTP
     */
    private function parseResponse($response): array
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();

        // Intentar decodificar JSON
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $data = ['raw' => $body];
        }

        return [
            'status' => $statusCode,
            'success' => $statusCode >= 200 && $statusCode < 300,
            'data' => $data,
            'headers' => $response->getHeaders()
        ];
    }
}
```

### API Rate Limiter

```php
<?php

namespace App\Shared\API;

use App\Shared\Cache\CacheManager;

class RateLimiter
{
    public function __construct(
        private CacheManager $cache
    ) {}

    /**
     * Verifica si se puede hacer una petición
     */
    public function attempt(string $key, int $maxAttempts, int $decaySeconds): bool
    {
        $cacheKey = "rate_limit:$key";

        $attempts = (int) $this->cache->get($cacheKey, 0);

        if ($attempts >= $maxAttempts) {
            return false;
        }

        // Incrementar contador
        $this->cache->increment($cacheKey);

        // Establecer expiración en primer intento
        if ($attempts === 0) {
            $this->cache->expire($cacheKey, $decaySeconds);
        }

        return true;
    }

    /**
     * Obtiene intentos restantes
     */
    public function remaining(string $key, int $maxAttempts): int
    {
        $cacheKey = "rate_limit:$key";
        $attempts = (int) $this->cache->get($cacheKey, 0);

        return max(0, $maxAttempts - $attempts);
    }

    /**
     * Resetea el contador
     */
    public function clear(string $key): void
    {
        $cacheKey = "rate_limit:$key";
        $this->cache->forget($cacheKey);
    }
}
```

### API Integration Example (Google Search Console)

```php
<?php

namespace App\Shared\API\Google;

use App\Shared\HTTP\HTTPClient;
use App\Shared\API\RateLimiter;

class GoogleSearchConsoleAPI
{
    private const BASE_URL = 'https://www.googleapis.com/webmasters/v3';
    private const RATE_LIMIT_KEY = 'gsc_api';
    private const MAX_REQUESTS_PER_MINUTE = 600;

    public function __construct(
        private HTTPClient $http,
        private RateLimiter $rateLimiter
    ) {}

    /**
     * Obtiene datos de queries
     */
    public function getQueries(
        string $siteUrl,
        string $accessToken,
        string $startDate,
        string $endDate,
        int $rowLimit = 1000
    ): array {
        // Verificar rate limit
        if (!$this->rateLimiter->attempt(self::RATE_LIMIT_KEY, self::MAX_REQUESTS_PER_MINUTE, 60)) {
            throw new \Exception("Límite de peticiones excedido. Intente en 1 minuto.");
        }

        $url = self::BASE_URL . '/sites/' . urlencode($siteUrl) . '/searchAnalytics/query';

        $payload = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'dimensions' => ['query'],
            'rowLimit' => $rowLimit
        ];

        $headers = [
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json'
        ];

        $response = $this->http->post($url, $payload, $headers);

        if (!$response['success']) {
            throw new \Exception("Error en API de GSC: " . ($response['data']['error']['message'] ?? 'Unknown error'));
        }

        return $response['data']['rows'] ?? [];
    }
}
```

---

## Error Handling

### Custom Exceptions

```php
<?php

namespace App\Shared\Exceptions;

class ValidationException extends \Exception
{
    private array $errors;

    public function __construct(string $message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

class NotFoundException extends \Exception
{
    public function __construct(string $message = "Recurso no encontrado")
    {
        parent::__construct($message, 404);
    }
}

class UnauthorizedException extends \Exception
{
    public function __construct(string $message = "No autorizado")
    {
        parent::__construct($message, 401);
    }
}

class ForbiddenException extends \Exception
{
    public function __construct(string $message = "Acceso prohibido")
    {
        parent::__construct($message, 403);
    }
}
```

### Global Error Handler

```php
<?php

namespace App\Shared\Error;

use App\Shared\Logger\Logger;

class ErrorHandler
{
    public function __construct(
        private Logger $logger
    ) {}

    /**
     * Registra handler global
     */
    public function register(): void
    {
        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);
        register_shutdown_function([$this, 'handleShutdown']);
    }

    /**
     * Maneja excepciones no capturadas
     */
    public function handleException(\Throwable $e): void
    {
        $this->logger->error('Uncaught exception', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        // En producción, mostrar mensaje genérico
        if ($_ENV['APP_ENV'] === 'production') {
            http_response_code(500);
            include __DIR__ . '/../views/errors/500.php';
        } else {
            // En desarrollo, mostrar detalles
            echo "<pre>";
            echo "Exception: " . get_class($e) . "\n";
            echo "Message: " . $e->getMessage() . "\n";
            echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
            echo $e->getTraceAsString();
            echo "</pre>";
        }

        exit(1);
    }

    /**
     * Maneja errores PHP
     */
    public function handleError(int $level, string $message, string $file, int $line): bool
    {
        if (!(error_reporting() & $level)) {
            return false;
        }

        throw new \ErrorException($message, 0, $level, $file, $line);
    }

    /**
     * Maneja errores fatales en shutdown
     */
    public function handleShutdown(): void
    {
        $error = error_get_last();

        if ($error && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
            $this->logger->critical('Fatal error', $error);

            if ($_ENV['APP_ENV'] === 'production') {
                http_response_code(500);
                include __DIR__ . '/../views/errors/500.php';
            }
        }
    }
}
```

---

## Authentication & Authorization

### Authentication Middleware

```php
<?php

namespace App\Shared\Auth;

class AuthMiddleware
{
    /**
     * Verifica que usuario esté autenticado
     */
    public static function requireAuth(): void
    {
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: /login');
            exit;
        }
    }

    /**
     * Verifica rol específico
     */
    public static function requireRole(string $role): void
    {
        self::requireAuth();

        if ($_SESSION['usuario_rol'] !== $role && $_SESSION['usuario_rol'] !== 'admin') {
            http_response_code(403);
            include __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }

    /**
     * Verifica permisos específicos
     */
    public static function requirePermission(string $permission): void
    {
        self::requireAuth();

        $permissions = $_SESSION['usuario_permisos'] ?? [];

        if (!in_array($permission, $permissions) && $_SESSION['usuario_rol'] !== 'admin') {
            http_response_code(403);
            include __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }
}
```

### Login Handler

```php
<?php

namespace App\Modules\Auth\Services;

class AuthService
{
    public function __construct(
        private Database $db
    ) {}

    /**
     * Intenta login
     */
    public function login(string $email, string $password): bool
    {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND activo = 1 AND deleted_at IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        // Iniciar sesión
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        $_SESSION['usuario_email'] = $user['email'];
        $_SESSION['usuario_rol'] = $user['rol'];
        $_SESSION['usuario_permisos'] = $this->getPermissions($user['id']);

        // Actualizar último login
        $this->updateLastLogin($user['id']);

        return true;
    }

    /**
     * Cierra sesión
     */
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }

    /**
     * Obtiene permisos del usuario
     */
    private function getPermissions(int $userId): array
    {
        $sql = "
            SELECT p.codigo
            FROM permisos p
            INNER JOIN rol_permisos rp ON p.id = rp.permiso_id
            INNER JOIN usuarios u ON u.rol_id = rp.rol_id
            WHERE u.id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        return array_column($stmt->fetchAll(\PDO::FETCH_ASSOC), 'codigo');
    }
}
```

---

## Email & Notifications

### Email Service

```php
<?php

namespace App\Shared\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);

        // Configuración SMTP
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['SMTP_HOST'];
        $this->mailer->Port = $_ENV['SMTP_PORT'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['SMTP_USERNAME'];
        $this->mailer->Password = $_ENV['SMTP_PASSWORD'];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->CharSet = 'UTF-8';

        // Remitente
        $this->mailer->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
    }

    /**
     * Envía email simple
     */
    public function send(string $to, string $subject, string $body, bool $isHTML = true): bool
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML($isHTML);
            $this->mailer->Body = $body;

            return $this->mailer->send();

        } catch (Exception $e) {
            error_log("Error enviando email: " . $this->mailer->ErrorInfo);
            return false;
        }
    }

    /**
     * Envía desde plantilla
     */
    public function sendFromTemplate(string $to, string $template, array $data): bool
    {
        $subject = $data['subject'] ?? 'Notificación';
        $body = $this->renderTemplate($template, $data);

        return $this->send($to, $subject, $body);
    }

    /**
     * Renderiza plantilla de email
     */
    private function renderTemplate(string $template, array $data): string
    {
        $templatePath = __DIR__ . "/../../views/emails/$template.php";

        if (!file_exists($templatePath)) {
            throw new \Exception("Plantilla de email no encontrada: $template");
        }

        extract($data);

        ob_start();
        include $templatePath;
        return ob_get_clean();
    }
}
```

### Notification Service

```php
<?php

namespace App\Shared\Notifications;

class NotificationService
{
    public function __construct(
        private Database $db,
        private EmailService $email
    ) {}

    /**
     * Crea notificación en sistema
     */
    public function notify(int $userId, string $type, string $title, string $message): void
    {
        $sql = "
            INSERT INTO notificaciones (usuario_id, tipo, titulo, mensaje, leida, created_at)
            VALUES (?, ?, ?, ?, 0, NOW())
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $type, $title, $message]);
    }

    /**
     * Notifica por email y en sistema
     */
    public function notifyWithEmail(
        int $userId,
        string $type,
        string $title,
        string $message,
        string $emailTemplate
    ): void {
        // Notificación en sistema
        $this->notify($userId, $type, $title, $message);

        // Obtener email del usuario
        $user = $this->getUser($userId);

        if ($user && !empty($user['email'])) {
            // Enviar email
            $this->email->sendFromTemplate($user['email'], $emailTemplate, [
                'subject' => $title,
                'title' => $title,
                'message' => $message,
                'user_name' => $user['nombre']
            ]);
        }
    }

    /**
     * Marca notificaciones como leídas
     */
    public function markAsRead(array $notificationIds): bool
    {
        $placeholders = implode(',', array_fill(0, count($notificationIds), '?'));
        $sql = "UPDATE notificaciones SET leida = 1 WHERE id IN ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($notificationIds);
    }
}
```

---

## 💡 Usage Tips

### Como usar estos snippets:

1. **En tu editor/IDE:** Copia el snippet que necesites
2. **Reemplaza placeholders:** Cambia `{Module}`, `{Entity}`, `{table}`, etc.
3. **Adapta a tu caso:** Modifica campos y lógica específica
4. **Mantén consistencia:** Usa siempre los mismos patrones

### Placeholders comunes:

- `{Module}` - Nombre del módulo (ej: Cliente, Auditoria)
- `{Entity}` - Nombre de la entidad (ej: Cliente, Plan)
- `{table}` - Nombre de la tabla (ej: clientes, planes_marketing)
- `{route}` - Ruta base (ej: clientes, auditorias)
- `{module_lower}` - Módulo en minúsculas (ej: cliente, auditoria)
- `{entities}` - Entidad en plural (ej: clientes, auditorías)

---

**Estos snippets siguen todos los estándares del proyecto: PSR-12, PHP 8.1+, seguridad, validación y documentación!**
