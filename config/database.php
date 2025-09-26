<?php
/**
 * CONFIGURACIÓN DE BASE DE DATOS
 * ==============================
 * 
 * Archivo de configuración para la conexión a SQLite
 * del Sistema de Gestión de Auditorías SEO
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

// =====================================================
// CONFIGURACIÓN DE CONEXIÓN
// =====================================================

// Incluir configuración generada
require_once __DIR__ . '/database_config.php';

// Configuración de base de datos SQLite
$sqlite_path = __DIR__ . '/../data/auditoria_seo.sqlite';

// DSN (Data Source Name) para SQLite
$dsn = "sqlite:$sqlite_path";

// Opciones de PDO para SQLite
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];

// =====================================================
// FUNCIÓN DE CONEXIÓN
// =====================================================

/**
 * Obtiene una conexión PDO a la base de datos SQLite
 * 
 * @return PDO Instancia de conexión
 * @throws PDOException Si no se puede conectar
 */
function obtenerConexion() {
    global $dsn, $options;
    
    try {
        $pdo = new PDO($dsn, null, null, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Log del error (en producción, no mostrar detalles)
        error_log("Error de conexión a SQLite: " . $e->getMessage());
        throw new PDOException("Error de conexión a la base de datos SQLite");
    }
}

// =====================================================
// CONFIGURACIÓN ADICIONAL
// =====================================================

// Configuración de zona horaria
date_default_timezone_set('Europe/Madrid');

// Configuración de errores (cambiar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// =====================================================
// CONSTANTES DEL SISTEMA
// =====================================================

// Rutas de archivos
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('TEMP_PATH', __DIR__ . '/../temp/');
define('LOGS_PATH', __DIR__ . '/../logs/');

// Configuración de archivos
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'csv', 'png', 'jpg', 'jpeg']);

// Estados de auditoría
define('ESTADOS_AUDITORIA', [
    'planificada' => 'Planificada',
    'en_progreso' => 'En Progreso', 
    'pausada' => 'Pausada',
    'completada' => 'Completada',
    'cancelada' => 'Cancelada'
]);

// Estados de pasos
define('ESTADOS_PASO', [
    'pendiente' => 'Pendiente',
    'en_progreso' => 'En Progreso',
    'completado' => 'Completado', 
    'omitido' => 'Omitido',
    'bloqueado' => 'Bloqueado'
]);

// Prioridades
define('PRIORIDADES', [
    'baja' => 'Baja',
    'media' => 'Media',
    'alta' => 'Alta', 
    'urgente' => 'Urgente'
]);

// =====================================================
// FUNCIONES AUXILIARES
// =====================================================

/**
 * Verifica si la base de datos está disponible
 * 
 * @return bool True si está disponible
 */
function verificarBaseDatos() {
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->query("SELECT 1");
        return $stmt !== false;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Obtiene información de la base de datos
 * 
 * @return array Información de la BD
 */
function obtenerInfoBaseDatos() {
    try {
        $pdo = obtenerConexion();
        
        $info = [];
        
        // Versión de SQLite
        $stmt = $pdo->query("SELECT sqlite_version() as version");
        $info['sqlite_version'] = $stmt->fetchColumn();
        
        // Número de tablas
        $stmt = $pdo->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table'");
        $info['total_tablas'] = $stmt->fetchColumn();
        
        // Tamaño de la base de datos
        $dbPath = __DIR__ . '/../data/auditoria_seo.sqlite';
        if (file_exists($dbPath)) {
            $info['tamaño_mb'] = round(filesize($dbPath) / 1024 / 1024, 2);
        } else {
            $info['tamaño_mb'] = 0;
        }
        
        return $info;
        
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Ejecuta el script de instalación de la base de datos
 * 
 * @return bool True si se instaló correctamente
 */
function instalarBaseDatos() {
    try {
        $sqlFile = __DIR__ . '/../database_schema.sql';
        
        if (!file_exists($sqlFile)) {
            throw new Exception("Archivo de esquema no encontrado: $sqlFile");
        }
        
        $sql = file_get_contents($sqlFile);
        $pdo = obtenerConexion();
        
        // Ejecutar el script SQL
        $pdo->exec($sql);
        
        return true;
        
    } catch (Exception $e) {
        error_log("Error instalando BD: " . $e->getMessage());
        return false;
    }
}

/**
 * Verifica si el sistema está instalado
 * 
 * @return bool True si está instalado
 */
function verificarInstalacion() {
    $dbPath = __DIR__ . '/../data/auditoria_seo.sqlite';
    
    if (!file_exists($dbPath)) {
        return false;
    }
    
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='usuarios'");
        return $stmt->fetchColumn() > 0;
    } catch (Exception $e) {
        return false;
    }
}

// =====================================================
// VERIFICACIÓN INICIAL
// =====================================================

// Crear directorios necesarios si no existen
$directorios = [UPLOAD_PATH, TEMP_PATH, LOGS_PATH];

foreach ($directorios as $directorio) {
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }
}

// =====================================================
// CONFIGURACIÓN DE SESIONES (si se usa)
// =====================================================

// Configuración segura de sesiones
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Cambiar a 1 en HTTPS
}

// =====================================================
// DOCUMENTACIÓN DE CONFIGURACIÓN
// =====================================================

/*
CONFIGURACIÓN PARA DIFERENTES ENTORNOS:

1. DESARROLLO:
   - SQLite local
   - mostrar errores: activado
   - logs: activados

2. PRODUCCIÓN:
   - SQLite con permisos restringidos
   - mostrar errores: desactivado
   - logs: activados
   - backups automáticos

3. TESTING:
   - base de datos separada para pruebas
   - datos de prueba automatizados

SEGURIDAD:
- Nunca commitear bases de datos con datos reales
- Configurar permisos de archivos apropiados
- Implementar backups regulares
- Auditar accesos regularmente

RENDIMIENTO:
- Optimizar índices según uso
- Monitorear consultas lentas
- Implementar cache cuando sea necesario
- Considerar WAL mode para SQLite
*/

?>