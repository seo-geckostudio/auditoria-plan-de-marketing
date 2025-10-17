<?php
/**
 * Gestor de Configuración de Auditorías Multi-Tipo
 *
 * Este sistema permite configurar diferentes tipos de auditorías
 * con procesadores automáticos, IA y manuales.
 *
 * @author Sistema de Auditoría
 * @version 1.0
 */

class AuditoriaConfigManager {

    private $configPath;
    private $cache = [];

    public function __construct($configPath = null) {
        $this->configPath = $configPath ?? __DIR__ . '/../config/tipos_auditoria/';
    }

    /**
     * Carga configuración de un tipo de auditoría
     *
     * @param string $tipo Identificador del tipo (seo, accesibilidad, rendimiento, etc)
     * @return AuditoriaConfig
     * @throws Exception Si el tipo no existe o config inválida
     */
    public function cargarTipo($tipo) {
        // Verificar caché
        if (isset($this->cache[$tipo])) {
            return $this->cache[$tipo];
        }

        $configFile = $this->configPath . $tipo . '.json';

        if (!file_exists($configFile)) {
            throw new Exception("Tipo de auditoría '{$tipo}' no encontrado en: {$configFile}");
        }

        $json = file_get_contents($configFile);
        $config = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al parsear configuración: " . json_last_error_msg());
        }

        // Validar esquema básico
        $this->validarEsquemaBasico($config);

        // Crear instancia de configuración
        $auditoriaConfig = new AuditoriaConfig($config);

        // Cachear
        $this->cache[$tipo] = $auditoriaConfig;

        return $auditoriaConfig;
    }

    /**
     * Lista todos los tipos de auditoría disponibles
     *
     * @return array
     */
    public function listarTipos() {
        $files = glob($this->configPath . '*.json');
        $tipos = [];

        foreach ($files as $file) {
            try {
                $config = json_decode(file_get_contents($file), true);
                $tipos[] = [
                    'id' => $config['tipo'],
                    'nombre' => $config['nombre'],
                    'version' => $config['version'] ?? '1.0',
                    'descripcion' => $config['descripcion'] ?? '',
                    'icono' => $config['icono'] ?? '📊'
                ];
            } catch (Exception $e) {
                // Skip archivos inválidos
                error_log("Error cargando tipo de auditoría {$file}: " . $e->getMessage());
            }
        }

        return $tipos;
    }

    /**
     * Valida esquema básico de configuración
     *
     * @param array $config
     * @throws Exception Si falta algún campo requerido
     */
    private function validarEsquemaBasico($config) {
        $camposRequeridos = ['tipo', 'nombre', 'modulos'];

        foreach ($camposRequeridos as $campo) {
            if (!isset($config[$campo])) {
                throw new Exception("Campo requerido '{$campo}' no encontrado en configuración");
            }
        }

        if (!is_array($config['modulos']) || empty($config['modulos'])) {
            throw new Exception("La configuración debe tener al menos un módulo");
        }
    }
}

/**
 * Clase de Configuración de Auditoría
 */
class AuditoriaConfig {

    private $config;
    private $procesadores = [];

    public function __construct($config) {
        $this->config = $config;
        $this->inicializarProcesadores();
    }

    public function getTipo() {
        return $this->config['tipo'];
    }

    public function getNombre() {
        return $this->config['nombre'];
    }

    public function getModulos() {
        return $this->config['modulos'];
    }

    public function getModulo($id) {
        foreach ($this->config['modulos'] as $modulo) {
            if ($modulo['id'] === $id) {
                return $modulo;
            }
        }
        return null;
    }

    public function getFuentesDatos() {
        return $this->config['fuentes_datos'] ?? [];
    }

    public function getReglasGlobales() {
        return $this->config['reglas_globales'] ?? [];
    }

    /**
     * Obtiene procesador para un campo específico
     *
     * @param array $campo Configuración del campo
     * @return CampoProcessor
     */
    public function getProcesador($campo) {
        $tipo = $campo['tipo_procesamiento'];

        if (!isset($this->procesadores[$tipo])) {
            $this->procesadores[$tipo] = $this->crearProcesador($tipo);
        }

        return $this->procesadores[$tipo];
    }

    private function inicializarProcesadores() {
        // Inicializar procesadores comunes
        $this->procesadores = [
            'automatico' => new AutomaticProcessor(),
            'ia' => new AIProcessor(),
            'manual' => new ManualProcessor(),
            'hibrido' => new HybridProcessor()
        ];
    }

    private function crearProcesador($tipo) {
        switch ($tipo) {
            case 'automatico':
                return new AutomaticProcessor();
            case 'ia':
                return new AIProcessor();
            case 'ia_asistido':
                return new AIAssistedProcessor();
            case 'manual':
                return new ManualProcessor();
            case 'hibrido':
                return new HybridProcessor();
            default:
                throw new Exception("Tipo de procesador desconocido: {$tipo}");
        }
    }
}

/**
 * Interfaz base para todos los procesadores
 */
interface IAuditoriaProcessor {
    public function procesar($datos, $config, $contexto);
    public function validar($resultado);
    public function getCacheDuration();
}

/**
 * Procesador Automático
 * Procesa datos usando lógica determinista (filtros, cálculos, reglas)
 */
class AutomaticProcessor implements IAuditoriaProcessor {

    public function procesar($datos, $config, $contexto) {
        // Obtener fuente de datos
        $fuente = $config['fuente'] ?? null;
        if (!$fuente) {
            throw new Exception("Campo automático requiere 'fuente' en configuración");
        }

        // Extraer datos de la fuente
        $datosExtraidos = $this->extraerDatos($datos, $fuente['origen']);

        // Aplicar procesador si está especificado
        if (isset($fuente['procesador'])) {
            $datosExtraidos = $this->aplicarProcesador($datosExtraidos, $fuente['procesador'], $contexto);
        }

        // Aplicar reglas de filtrado
        if (isset($config['reglas_filtrado'])) {
            $datosExtraidos = $this->aplicarFiltros($datosExtraidos, $config['reglas_filtrado']);
        }

        // Enriquecimiento adicional
        if (isset($config['enriquecimiento'])) {
            $datosExtraidos = $this->aplicarEnriquecimientos($datosExtraidos, $config['enriquecimiento'], $datos, $contexto);
        }

        // Priorización
        if (isset($config['priorizacion'])) {
            $datosExtraidos = $this->aplicarPriorizacion($datosExtraidos, $config['priorizacion']);
        }

        return $datosExtraidos;
    }

    public function validar($resultado) {
        return is_array($resultado) || is_object($resultado);
    }

    public function getCacheDuration() {
        return 86400; // 24 horas
    }

    private function extraerDatos($datos, $origen) {
        // Navegar estructura de datos usando notación de punto
        // Ej: "screaming_frog.internal" → $datos['screaming_frog']['internal']
        $partes = explode('.', $origen);
        $valor = $datos;

        foreach ($partes as $parte) {
            if (is_array($valor) && isset($valor[$parte])) {
                $valor = $valor[$parte];
            } else {
                return [];
            }
        }

        return $valor;
    }

    private function aplicarProcesador($datos, $procesador, $contexto) {
        // Formato: "ClaseProcessor::metodo"
        list($clase, $metodo) = explode('::', $procesador);

        if (!class_exists($clase)) {
            throw new Exception("Clase procesador no encontrada: {$clase}");
        }

        $instancia = new $clase();

        if (!method_exists($instancia, $metodo)) {
            throw new Exception("Método procesador no encontrado: {$clase}::{$metodo}");
        }

        return $instancia->$metodo($datos, $contexto);
    }

    private function aplicarFiltros($datos, $reglas) {
        if (!is_array($datos)) {
            return $datos;
        }

        return array_filter($datos, function($item) use ($reglas) {
            foreach ($reglas as $campo => $valorEsperado) {
                if (!isset($item[$campo]) || $item[$campo] != $valorEsperado) {
                    return false;
                }
            }
            return true;
        });
    }

    private function aplicarEnriquecimientos($datos, $enriquecimientos, $datosCompletos, $contexto) {
        foreach ($enriquecimientos as $enriquecimiento) {
            $tipo = $enriquecimiento['tipo'];

            if ($tipo === 'automatico') {
                // Enriquecer desde otra fuente
                $datosAdicionales = $this->extraerDatos($datosCompletos, $enriquecimiento['fuente']);
                // Merge datos
                $datos = $this->mergeData($datos, $datosAdicionales, $enriquecimiento);
            } elseif ($tipo === 'ia') {
                // Procesar con IA (llamar a AIProcessor)
                $aiProcessor = new AIProcessor();
                $datosIA = $aiProcessor->procesar($datos, $enriquecimiento, $contexto);
                $datos = $this->mergeData($datos, $datosIA, $enriquecimiento);
            }
        }

        return $datos;
    }

    private function aplicarPriorizacion($datos, $config) {
        if (!is_array($datos)) {
            return $datos;
        }

        foreach ($datos as &$item) {
            $prioridad = 'Baja';

            if (isset($config['reglas'])) {
                foreach ($config['reglas'] as $regla) {
                    if ($this->evaluarCondicion($item, $regla['condicion'])) {
                        $prioridad = $regla['prioridad'];
                        break;
                    }
                }
            }

            $item['prioridad'] = $prioridad;
        }

        return $datos;
    }

    private function evaluarCondicion($item, $condicion) {
        // Evaluar expresión simple
        // Formato: "campo operador valor"
        // Ej: "trafico_mensual > 500"

        if (preg_match('/(.+?)\s*([><=]+)\s*(.+)/', $condicion, $matches)) {
            $campo = trim($matches[1]);
            $operador = $matches[2];
            $valor = trim($matches[3]);

            $valorItem = $item[$campo] ?? 0;

            switch ($operador) {
                case '>':
                    return $valorItem > $valor;
                case '<':
                    return $valorItem < $valor;
                case '>=':
                    return $valorItem >= $valor;
                case '<=':
                    return $valorItem <= $valor;
                case '==':
                case '=':
                    return $valorItem == $valor;
            }
        }

        return false;
    }

    private function mergeData($datos, $datosAdicionales, $config) {
        // Implementar merge según configuración
        // Por ahora, merge simple
        if (is_array($datos) && is_array($datosAdicionales)) {
            return array_merge($datos, $datosAdicionales);
        }
        return $datos;
    }
}

/**
 * Procesador IA
 * Procesa datos usando modelos de lenguaje (Claude, GPT, etc.)
 */
class AIProcessor implements IAuditoriaProcessor {

    private $aiProvider;
    private $cache;

    public function __construct() {
        // Inicializar proveedor de IA (Claude API)
        $this->aiProvider = new ClaudeAIProvider();
        $this->cache = new SimpleCache();
    }

    public function procesar($datos, $config, $contexto) {
        $procesadorIA = $config['procesador_ia'] ?? $config;

        // Verificar caché
        $cacheKey = $this->generarCacheKey($datos, $procesadorIA, $contexto);
        if ($config['cache'] ?? true) {
            $cached = $this->cache->get($cacheKey);
            if ($cached) {
                return $cached;
            }
        }

        // Construir prompt
        $prompt = $this->construirPrompt($procesadorIA, $datos, $contexto);

        // Llamar a IA
        $resultado = $this->aiProvider->analyze([
            'prompt' => $prompt,
            'model' => $procesadorIA['modelo'] ?? 'claude-3-5-sonnet-20241022',
            'temperature' => $procesadorIA['temperatura'] ?? 0.3,
            'max_tokens' => $procesadorIA['max_tokens'] ?? 4000
        ]);

        // Parsear resultado
        $resultadoParsado = $this->parsearResultado($resultado, $procesadorIA['outputs'] ?? null);

        // Cachear
        if ($config['cache'] ?? true) {
            $cacheDuration = $config['cache_duracion'] ?? 604800; // 7 días
            $this->cache->set($cacheKey, $resultadoParsado, $cacheDuration);
        }

        return $resultadoParsado;
    }

    public function validar($resultado) {
        return !empty($resultado);
    }

    public function getCacheDuration() {
        return 604800; // 7 días (IA es costosa, cachear más tiempo)
    }

    private function construirPrompt($config, $datos, $contexto) {
        $promptTemplate = $config['prompt_template'] ?? $config['prompt'];

        if (file_exists($promptTemplate)) {
            // Es un archivo de template
            $prompt = file_get_contents($promptTemplate);
        } else {
            // Es el prompt directo
            $prompt = $promptTemplate;
        }

        // Reemplazar variables
        $prompt = $this->reemplazarVariables($prompt, $datos, $contexto);

        return $prompt;
    }

    private function reemplazarVariables($texto, $datos, $contexto) {
        // Reemplazar {variable} con valores
        return preg_replace_callback('/{(\w+)}/', function($matches) use ($datos, $contexto) {
            $variable = $matches[1];

            if (isset($datos[$variable])) {
                return $datos[$variable];
            }

            if (isset($contexto[$variable])) {
                return $contexto[$variable];
            }

            return $matches[0]; // No reemplazar si no se encuentra
        }, $texto);
    }

    private function parsearResultado($resultado, $outputs) {
        // Si se especifican outputs, intentar parsear estructura
        if ($outputs) {
            // Por ahora, asumir JSON
            $json = json_decode($resultado, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $json;
            }
        }

        return $resultado;
    }

    private function generarCacheKey($datos, $config, $contexto) {
        $dataHash = md5(json_encode($datos));
        $configHash = md5(json_encode($config));
        $contextHash = md5(json_encode($contexto));

        return "ai_{$configHash}_{$dataHash}_{$contextHash}";
    }
}

/**
 * Procesador Manual
 * Solicita input del auditor
 */
class ManualProcessor implements IAuditoriaProcessor {

    public function procesar($datos, $config, $contexto) {
        // Este procesador requiere input manual
        // Retornar estado "pendiente de input"

        return [
            'estado' => 'pendiente',
            'tipo_input' => $config['tipo_input'] ?? 'text',
            'campo_id' => $config['id'],
            'label' => $config['nombre'],
            'valor_default' => $config['valor_default'] ?? null
        ];
    }

    public function validar($resultado) {
        return isset($resultado['estado']);
    }

    public function getCacheDuration() {
        return 0; // No cachear datos manuales
    }
}

/**
 * Procesador Híbrido
 * Combina automático + IA + override manual
 */
class HybridProcessor implements IAuditoriaProcessor {

    private $autoProcessor;
    private $aiProcessor;

    public function __construct() {
        $this->autoProcessor = new AutomaticProcessor();
        $this->aiProcessor = new AIProcessor();
    }

    public function procesar($datos, $config, $contexto) {
        // 1. Procesar automáticamente
        $resultadoAuto = $this->autoProcessor->procesar($datos, $config, $contexto);

        // 2. Si hay procesador IA configurado, aplicarlo
        if (isset($config['procesador_ia'])) {
            $resultadoIA = $this->aiProcessor->procesar($resultadoAuto, $config, $contexto);

            // Merge resultados
            $resultadoAuto = $this->merge($resultadoAuto, $resultadoIA);
        }

        // 3. Permitir override manual si está configurado
        if ($config['permite_override'] ?? false) {
            $resultadoAuto['_permite_override'] = true;
            $resultadoAuto['_valor_automatico'] = $resultadoAuto;
        }

        return $resultadoAuto;
    }

    public function validar($resultado) {
        return true;
    }

    public function getCacheDuration() {
        return 86400; // 24 horas
    }

    private function merge($auto, $ia) {
        if (is_array($auto) && is_array($ia)) {
            return array_merge($auto, $ia);
        }
        return $auto;
    }
}

/**
 * Cache simple (mejorar con Redis/Memcached en producción)
 */
class SimpleCache {
    private $cacheDir;

    public function __construct() {
        $this->cacheDir = __DIR__ . '/../cache/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function get($key) {
        $file = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($file)) {
            $data = unserialize(file_get_contents($file));
            if ($data['expires'] > time()) {
                return $data['value'];
            }
            unlink($file);
        }
        return null;
    }

    public function set($key, $value, $duration) {
        $file = $this->cacheDir . md5($key) . '.cache';
        $data = [
            'value' => $value,
            'expires' => time() + $duration
        ];
        file_put_contents($file, serialize($data));
    }
}

/**
 * Proveedor de IA (Claude)
 */
class ClaudeAIProvider {

    private $apiKey;
    private $apiUrl = 'https://api.anthropic.com/v1/messages';

    public function __construct() {
        $this->apiKey = getenv('ANTHROPIC_API_KEY') ?: '';
    }

    public function analyze($params) {
        if (empty($this->apiKey)) {
            throw new Exception("ANTHROPIC_API_KEY no configurada");
        }

        $payload = [
            'model' => $params['model'],
            'max_tokens' => $params['max_tokens'],
            'temperature' => $params['temperature'],
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $params['prompt']
                ]
            ]
        ];

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-api-key: ' . $this->apiKey,
            'anthropic-version: 2023-06-01'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception("Error en API de Claude: HTTP {$httpCode} - {$response}");
        }

        $data = json_decode($response, true);

        return $data['content'][0]['text'] ?? '';
    }
}
