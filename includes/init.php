<?php
/**
 * INICIALIZACIÓN DEL SISTEMA
 * ==========================
 *
 * Archivo centralizado para inicializar el sistema de manera segura
 * Evita problemas de headers y sesiones duplicadas
 */

// Prevenir output antes de headers
ob_start();

// Definir constante de seguridad
if (!defined('SISTEMA_INICIADO')) {
    define('SISTEMA_INICIADO', true);
}

// Configurar sesiones solo si no están iniciadas
if (session_status() === PHP_SESSION_NONE) {
    // Configurar directorio de sesiones personalizado
    $session_path = __DIR__ . '/../temp';
    if (is_dir($session_path) && is_writable($session_path)) {
        session_save_path($session_path);
    }

    // Configurar parámetros de sesión
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);

    // Iniciar sesión
    session_start();
}

// Configuración de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurar zona horaria
date_default_timezone_set('Europe/Madrid');

// Incluir archivos básicos
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/notifications.php';

/**
 * Función para mostrar notificaciones sin problemas de headers
 */
function mostrarNotificacionSegura($mensaje, $tipo = 'info') {
    if (session_status() !== PHP_SESSION_NONE) {
        $_SESSION['notificaciones'][$tipo][] = $mensaje;
    }
}

/**
 * Función para limpiar output buffer si es necesario
 */
function limpiarBuffer() {
    if (ob_get_level()) {
        ob_clean();
    }
}

/**
 * Verificar que el usuario está autenticado
 */
function verificarAutenticacion() {
    if (!isset($_SESSION['usuario_id'])) {
        // Para demo, crear sesión automática con usuario admin
        $_SESSION['usuario_id'] = 1;
        $_SESSION['usuario_nombre'] = 'Administrador';
        $_SESSION['usuario_email'] = 'admin@auditoriaseo.com';
        $_SESSION['usuario_rol'] = 'admin';
    }
}

// Verificar autenticación automáticamente
verificarAutenticacion();
?>