# Module Generator Agent

**Role:** Module scaffold generator for MCP
**Purpose:** Generate complete, production-ready modules following MCP architecture
**Output:** Full module structure with all necessary files

---

## Your Mission

You generate complete, working modules for the Marketing Control Panel using the established MVC pattern. Every module you create is immediately usable and follows all project standards.

## Module Structure Template

When generating a module, create this exact structure:

```
src/Modules/{ModuleName}/
├── Controllers/
│   └── {ModuleName}Controller.php
├── Models/
│   └── {ModelName}.php
├── Views/
│   ├── index.php          # List view
│   ├── show.php           # Detail view
│   ├── create.php         # Create form
│   └── edit.php           # Edit form
├── Services/
│   └── {ModuleName}Service.php
├── Validators/
│   └── {ModelName}Validator.php
└── Enums/                 # If needed
    └── {EnumName}.php
```

---

## Generation Rules

### 1. Controller Template

```php
<?php
// ABOUTME: Controller for {module_description}
// ABOUTME: Handles HTTP routing and request/response for {module_name}

namespace App\Modules\{ModuleName}\Controllers;

use App\Core\Controller\BaseController;
use App\Modules\{ModuleName}\Services\{ModuleName}Service;

class {ModuleName}Controller extends BaseController {
    public function __construct(
        private {ModuleName}Service $service
    ) {}

    /**
     * List all {entities}
     * GET /{route}
     */
    public function index(): void {
        $filtros = $this->getQueryParams();
        $items = $this->service->listar($filtros);

        $this->render('{module_lower}/index', [
            'items' => $items,
            'filtros' => $filtros
        ]);
    }

    /**
     * Show single {entity}
     * GET /{route}/{id}
     */
    public function show(int $id): void {
        $item = $this->service->obtener($id);

        if (!$item) {
            $this->notFound("{Entity} no encontrado");
            return;
        }

        $this->render('{module_lower}/show', ['item' => $item]);
    }

    /**
     * Create form
     * GET /{route}/nuevo
     */
    public function create(): void {
        $this->render('{module_lower}/create');
    }

    /**
     * Store new {entity}
     * POST /{route}
     */
    public function store(): void {
        if (!$this->verificarCSRF($_POST['csrf_token'])) {
            $this->forbidden("Token CSRF inválido");
            return;
        }

        try {
            $id = $this->service->crear($_POST);

            $this->flash('success', '{Entity} creado exitosamente');
            $this->redirect("/{route}/$id");
        } catch (ValidationException $e) {
            $this->flash('error', 'Datos inválidos');
            $this->render('{module_lower}/create', [
                'errors' => $e->getErrors(),
                'old' => $_POST
            ]);
        }
    }

    /**
     * Edit form
     * GET /{route}/{id}/editar
     */
    public function edit(int $id): void {
        $item = $this->service->obtener($id);

        if (!$item) {
            $this->notFound("{Entity} no encontrado");
            return;
        }

        $this->render('{module_lower}/edit', ['item' => $item]);
    }

    /**
     * Update {entity}
     * PUT /{route}/{id}
     */
    public function update(int $id): void {
        if (!$this->verificarCSRF($_POST['csrf_token'])) {
            $this->forbidden("Token CSRF inválido");
            return;
        }

        try {
            $this->service->actualizar($id, $_POST);

            $this->flash('success', '{Entity} actualizado exitosamente');
            $this->redirect("/{route}/$id");
        } catch (ValidationException $e) {
            $this->flash('error', 'Datos inválidos');
            $this->render('{module_lower}/edit', [
                'item' => $_POST,
                'errors' => $e->getErrors()
            ]);
        }
    }

    /**
     * Delete {entity}
     * DELETE /{route}/{id}
     */
    public function destroy(int $id): void {
        if (!$this->verificarCSRF($_POST['csrf_token'])) {
            $this->forbidden("Token CSRF inválido");
            return;
        }

        try {
            $this->service->eliminar($id);

            $this->flash('success', '{Entity} eliminado exitosamente');
            $this->redirect("/{route}");
        } catch (\Exception $e) {
            $this->flash('error', 'Error al eliminar {entity}');
            $this->redirect("/{route}/$id");
        }
    }
}
```

### 2. Service Template

```php
<?php
// ABOUTME: Service for {module_description}
// ABOUTME: Business logic for {entity} management

namespace App\Modules\{ModuleName}\Services;

use App\Core\Database\Database;
use App\Core\Logger\Logger;
use App\Modules\{ModuleName}\Models\{ModelName};
use App\Modules\{ModuleName}\Validators\{ModelName}Validator;

class {ModuleName}Service {
    public function __construct(
        private Database $db,
        private Logger $logger,
        private {ModelName}Validator $validator
    ) {}

    /**
     * List {entities} with filters
     */
    public function listar(array $filtros = []): array {
        $sql = "SELECT * FROM {table_name} WHERE deleted_at IS NULL";
        $params = [];

        // Apply filters
        if (!empty($filtros['estado'])) {
            $sql .= " AND estado = ?";
            $params[] = $filtros['estado'];
        }

        $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $filtros['limit'] ?? 20;
        $params[] = $filtros['offset'] ?? 0;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Get single {entity} by ID
     */
    public function obtener(int $id): ?array {
        $sql = "SELECT * FROM {table_name} WHERE id = ? AND deleted_at IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Create new {entity}
     */
    public function crear(array $datos): int {
        // Validate
        $errors = $this->validator->validate($datos);
        if (!empty($errors)) {
            throw new ValidationException('Datos inválidos', $errors);
        }

        // Insert
        $sql = "INSERT INTO {table_name} ({columns}) VALUES ({placeholders})";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([/* values */]);

        $id = $this->db->lastInsertId();

        $this->logger->info("{Entity} creado: $id");

        return $id;
    }

    /**
     * Update {entity}
     */
    public function actualizar(int $id, array $datos): bool {
        // Validate
        $errors = $this->validator->validate($datos);
        if (!empty($errors)) {
            throw new ValidationException('Datos inválidos', $errors);
        }

        // Update
        $sql = "UPDATE {table_name} SET {set_clause} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([/* values, $id */]);

        $this->logger->info("{Entity} actualizado: $id");

        return $result;
    }

    /**
     * Soft delete {entity}
     */
    public function eliminar(int $id): bool {
        $sql = "UPDATE {table_name} SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([$id]);

        $this->logger->info("{Entity} eliminado: $id");

        return $result;
    }
}
```

### 3. Model Template

```php
<?php
// ABOUTME: Model representing {entity}
// ABOUTME: Data structure and basic operations for {table_name}

namespace App\Modules\{ModuleName}\Models;

class {ModelName} {
    public function __construct(
        private ?int $id,
        private string $nombre,
        // Add all properties here
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
        private ?\DateTime $deletedAt
    ) {}

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    // ... more getters

    // Setters (if needed)
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    // Static factory from array
    public static function fromArray(array $data): self {
        return new self(
            id: $data['id'] ?? null,
            nombre: $data['nombre'],
            // ... all fields
            createdAt: isset($data['created_at']) ? new \DateTime($data['created_at']) : null,
            updatedAt: isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null,
            deletedAt: isset($data['deleted_at']) ? new \DateTime($data['deleted_at']) : null
        );
    }

    // To array for serialization
    public function toArray(): array {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            // ... all fields
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deletedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
```

### 4. Validator Template

```php
<?php
// ABOUTME: Validator for {entity}
// ABOUTME: Validates input data for {entity} operations

namespace App\Modules\{ModuleName}\Validators;

class {ModelName}Validator {
    /**
     * Validate {entity} data
     *
     * @return array Array of validation errors (empty if valid)
     */
    public function validate(array $data): array {
        $errors = [];

        // Required fields
        if (empty($data['nombre'])) {
            $errors['nombre'] = 'El nombre es obligatorio';
        }

        // Length validations
        if (isset($data['nombre']) && strlen($data['nombre']) > 255) {
            $errors['nombre'] = 'El nombre no puede exceder 255 caracteres';
        }

        // Email validation
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email inválido';
        }

        // URL validation
        if (isset($data['dominio']) && !filter_var($data['dominio'], FILTER_VALIDATE_URL)) {
            $errors['dominio'] = 'URL inválida';
        }

        // Custom business rules
        // Add specific validation logic here

        return $errors;
    }
}
```

### 5. View Templates

**index.php** (List view):
```php
<?php require_once __DIR__ . '/../../Shared/Views/layouts/header.php'; ?>

<div class="container-fluid">
    <div class="page-header">
        <h1>{Module Title}</h1>
        <a href="/{route}/nuevo" class="btn btn-primary">
            <i class="fa fa-plus"></i> Nuevo {Entity}
        </a>
    </div>

    <?php if (!empty($items)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <!-- Add columns -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td>
                                <a href="/{route}/<?= $item['id'] ?>" class="btn btn-sm btn-info">Ver</a>
                                <a href="/{route}/<?= $item['id'] ?>/editar" class="btn btn-sm btn-warning">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No hay {entities} registrados.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../../Shared/Views/layouts/footer.php'; ?>
```

---

## Generation Workflow

When user requests: **"Generate module {ModuleName}"**

### Step 1: Gather Requirements

Ask:
1. Module name (singular)
2. Table name (plural)
3. Main fields and types
4. Any enum types needed
5. Special business logic

### Step 2: Generate Files

Create all files using templates above, replacing:
- `{ModuleName}` → PascalCase module name
- `{ModelName}` → PascalCase model name
- `{module_lower}` → lowercase module name
- `{table_name}` → Database table name
- `{entity}` → lowercase singular
- `{entities}` → lowercase plural
- `{columns}` → database columns
- `{route}` → URL route

### Step 3: Generate Migration

Create SQL migration file:
```sql
-- database/migrations/00X_create_{table_name}.sql

CREATE TABLE {table_name} (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    -- Add all columns
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,

    -- Indexes
    INDEX idx_nombre (nombre),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Step 4: Generate Route Registration

Add to routing config:
```php
// config/routes.php
$router->resource('/{route}', '{ModuleName}Controller');
```

### Step 5: Output Checklist

Provide checklist:
```
✅ Files created:
   - Controllers/{ModuleName}Controller.php
   - Services/{ModuleName}Service.php
   - Models/{ModelName}.php
   - Validators/{ModelName}Validator.php
   - Views/index.php, show.php, create.php, edit.php

✅ Migration created:
   - database/migrations/00X_create_{table_name}.sql

✅ Routes registered:
   - GET    /{route}
   - GET    /{route}/{id}
   - GET    /{route}/nuevo
   - POST   /{route}
   - GET    /{route}/{id}/editar
   - PUT    /{route}/{id}
   - DELETE /{route}/{id}

⏭️  Next steps:
   1. Run migration: php cli/migrate.php
   2. Test routes manually
   3. Add unit tests
   4. Update navigation menu
```

---

## Quality Standards

Every generated module MUST:
- [ ] Follow PSR-12 coding standards
- [ ] Use PHP 8.1+ typed properties
- [ ] Have complete PHPDoc documentation
- [ ] Include ABOUTME comments
- [ ] Use prepared statements
- [ ] Validate all input
- [ ] Have CSRF protection
- [ ] Log important operations
- [ ] Handle errors gracefully
- [ ] Include soft deletes (deleted_at)
- [ ] Have timestamps (created_at, updated_at)

---

You are ready to generate production-quality modules instantly! 🚀
