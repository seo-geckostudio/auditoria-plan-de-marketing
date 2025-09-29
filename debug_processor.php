<?php
/**
 * DEPURADOR DE PROCESSOR.PHP
 * 
 * Este archivo es una versión modificada de processor.php que muestra información
 * detallada sobre cada paso del procesamiento sin redireccionar.
 */

// IMPORTANTE: Iniciar sesión ANTES de cualquier salida
// Esto evita el error "headers already sent"
session_start();

// Configurar para mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función para mostrar información de depuración
function debug_info($titulo, $datos, $tipo = 'info') {
    $color = 'black';
    $bg = '#f8f9fa';
    
    switch ($tipo) {
        case 'success':
            $color = 'green';
            $bg = '#d4edda';
            break;
        case 'error':
            $color = 'red';
            $bg = '#f8d7da';
            break;
        case 'warning':
            $color = '#856404';
            $bg = '#fff3cd';
            break;
        case 'info':
            $color = '#0c5460';
            $bg = '#d1ecf1';
            break;
    }
    
    echo "<div style='margin: 10px 0; padding: 15px; border-radius: 5px; background-color: {$bg}; color: {$color}; border: 1px solid " . darken_color($bg) . ";'>";
    echo "<h3 style='margin-top: 0;'>{$titulo}</h3>";
    
    if (is_array($datos) || is_object($datos)) {
        echo "<pre style='background-color: #f5f5f5; padding: 10px; border-radius: 3px; overflow: auto;'>";
        print_r($datos);
        echo "</pre>";
    } else {
        echo "<p>{$datos}</p>";
    }
    
    echo "</div>";
}

// Función para oscurecer un color (para bordes)
function darken_color($hex, $percent = 15) {
    $hex = ltrim($hex, '#');
    if (strlen($hex) == 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    
    $rgb = array_map('hexdec', str_split($hex, 2));
    
    foreach ($rgb as &$color) {
        $color = max(0, min(255, $color - $percent));
    }
    
    return '#' . implode('', array_map(function($val) {
        return sprintf('%02x', $val);
    }, $rgb));
}

// Mostrar encabezado
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Depurador de Processor.php</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        h1 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .step { margin-bottom: 30px; }
        .step-title { background: #f0f0f0; padding: 10px; border-left: 4px solid #007bff; }
    </style>
</head>
<body>
    <h1>Depurador de Processor.php</h1>";

// PASO 1: Mostrar información de la solicitud
echo "<div class='step'><h2 class='step-title'>PASO 1: Información de la solicitud</h2>";
debug_info("Método de la solicitud", $_SERVER['REQUEST_METHOD']);
debug_info("Datos POST recibidos", $_POST);
debug_info("Datos GET recibidos", $_GET);
debug_info("Variables de sesión", $_SESSION);
echo "</div>";

// Definir constante del sistema
define('SISTEMA_INICIADO', true);

// PASO 2: Incluir archivos necesarios
echo "<div class='step'><h2 class='step-title'>PASO 2: Cargando archivos necesarios</h2>";
try {
    require_once __DIR__ . '/includes/functions.php';
    debug_info("Archivo functions.php cargado correctamente", "OK", "success");
} catch (Exception $e) {
    debug_info("Error al cargar functions.php", $e->getMessage(), "error");
}

try {
    require_once __DIR__ . '/modules/clientes.php';
    debug_info("Archivo clientes.php cargado correctamente", "OK", "success");
} catch (Exception $e) {
    debug_info("Error al cargar clientes.php", $e->getMessage(), "error");
}

try {
    require_once __DIR__ . '/modules/auditorias.php';
    debug_info("Archivo auditorias.php cargado correctamente", "OK", "success");
} catch (Exception $e) {
    debug_info("Error al cargar auditorias.php", $e->getMessage(), "error");
}
echo "</div>";

// PASO 3: Verificar método de solicitud
echo "<div class='step'><h2 class='step-title'>PASO 3: Verificando método de solicitud</h2>";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    debug_info("Error: Se esperaba método POST", "Método actual: " . $_SERVER['REQUEST_METHOD'], "error");
    echo "<p>En processor.php normal, esto redireccionaría a index.php</p>";
} else {
    debug_info("Método POST verificado correctamente", "OK", "success");
}
echo "</div>";

// PASO 4: Obtener nombre del formulario
echo "<div class='step'><h2 class='step-title'>PASO 4: Obteniendo nombre del formulario</h2>";
$form_name = $_POST['form_name'] ?? '';

if (empty($form_name)) {
    debug_info("Error: Formulario no identificado", "El campo form_name está vacío o no existe", "error");
    echo "<p>En processor.php normal, esto establecería un error en la sesión y redireccionaría a index.php</p>";
} else {
    debug_info("Nombre del formulario obtenido", $form_name, "success");
}
echo "</div>";

// PASO 5: Procesar según el tipo de formulario
echo "<div class='step'><h2 class='step-title'>PASO 5: Procesando formulario</h2>";

if (!empty($form_name)) {
    debug_info("Tipo de formulario a procesar", $form_name);
    
    switch ($form_name) {
        case 'clientes_crear':
            debug_info("Procesando formulario de creación de cliente", "Llamando a procesarCrearCliente()");
            
            // Verificar token CSRF antes de procesar
            if (!isset($_POST['csrf_token'])) {
                debug_info("Error CSRF", "No se encontró token CSRF en la solicitud", "error");
            } else {
                debug_info("Token CSRF encontrado", $_POST['csrf_token']);
                
                // Verificar si el token es válido
                if (function_exists('verificarTokenCSRF')) {
                    $token_valido = verificarTokenCSRF($_POST['csrf_token']);
                    debug_info("Validación de token CSRF", $token_valido ? "Token válido" : "Token inválido", $token_valido ? "success" : "error");
                } else {
                    debug_info("Error", "La función verificarTokenCSRF no está definida", "error");
                }
            }
            
            // Procesar la creación del cliente
            try {
                $resultado = procesarCrearCliente();
                debug_info("Resultado de procesarCrearCliente()", $resultado, $resultado['success'] ? "success" : "error");
                
                echo "<p>En processor.php normal, esto ";
                if ($resultado['success']) {
                    echo "establecería un mensaje de éxito en la sesión y redireccionaría a 'index.php?modulo=clientes&accion=ver&id=" . ($resultado['cliente_id'] ?? '') . "'";
                } else {
                    echo "establecería un mensaje de error en la sesión y redireccionaría a 'index.php?modulo=clientes&accion=crear'";
                }
                echo "</p>";
                
            } catch (Exception $e) {
                debug_info("Excepción al procesar cliente", $e->getMessage(), "error");
            }
            break;
            
        // Otros casos del switch
        default:
            debug_info("Tipo de formulario no reconocido", $form_name, "warning");
            echo "<p>En processor.php normal, esto establecería un error en la sesión y redireccionaría a index.php</p>";
    }
}
echo "</div>";

// PASO 6: Verificar estructura de la tabla clientes
echo "<div class='step'><h2 class='step-title'>PASO 6: Verificando estructura de la tabla clientes</h2>";
try {
    $pdo = obtenerConexion();
    $stmt = $pdo->prepare("SELECT sql FROM sqlite_master WHERE type='table' AND name='clientes'");
    $stmt->execute();
    $tabla_info = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($tabla_info) {
        debug_info("Estructura de la tabla clientes", $tabla_info['sql'], "info");
    } else {
        debug_info("Error", "No se pudo obtener la estructura de la tabla clientes", "error");
    }
} catch (Exception $e) {
    debug_info("Error al consultar la estructura de la tabla", $e->getMessage(), "error");
}
echo "</div>";

// PASO 7: Mostrar datos preparados para inserción
echo "<div class='step'><h2 class='step-title'>PASO 7: Datos preparados para inserción</h2>";
if (isset($form_name) && $form_name === 'clientes_crear') {
    $datos_preparados = [
        'nombre_empresa' => $_POST['nombre_empresa'] ?? '',
        'contacto_nombre' => $_POST['persona_contacto'] ?? '',
        'contacto_email' => $_POST['email'] ?? '',
        'contacto_telefono' => $_POST['telefono'] ?? '',
        'sector' => $_POST['sector'] ?? '',
        'url_principal' => $_POST['sitio_web'] ?? '',
        'pais' => $_POST['pais'] ?? '',
        'notas' => $_POST['notas'] ?? '',
        'activo' => isset($_POST['activo']) ? (int)$_POST['activo'] : 1
    ];
    
    debug_info("Datos que se intentarían insertar", $datos_preparados);
}
echo "</div>";

// Cerrar HTML
echo "</body></html>";