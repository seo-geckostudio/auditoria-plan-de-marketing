<?php
/**
 * Script de depuración para el formulario de auditorías
 * Simula el envío del formulario para identificar el problema del token CSRF
 */

session_start();
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/forms.php';

echo "<h1>Debug Formulario de Auditorías</h1>";

// Generar token para el formulario
$token = generarTokenCSRF();
echo "<h2>Token Generado para Formulario</h2>";
echo "<p><strong>Token:</strong> " . htmlspecialchars($token) . "</p>";
echo "<p><strong>Token en sesión:</strong> " . htmlspecialchars($_SESSION['csrf_token'] ?? 'NO EXISTE') . "</p>";

// Simular datos del formulario
$datosFormulario = [
    'csrf_token' => $token,
    'accion' => 'crear_auditoria',
    'nombre' => 'Auditoría de Prueba',
    'descripcion' => 'Descripción de prueba',
    'url_principal' => 'https://ejemplo.com',
    'cliente_id' => '1',
    'usuario_id' => '1',
    'fecha_inicio' => date('Y-m-d'),
    'fases' => ['1', '2']
];

echo "<h2>Datos del Formulario Simulado</h2>";
echo "<pre>";
print_r($datosFormulario);
echo "</pre>";

// Simular POST
$_POST = $datosFormulario;
$_SERVER['REQUEST_METHOD'] = 'POST';

echo "<h2>Validación Manual del Token</h2>";
$tokenRecibido = $_POST['csrf_token'] ?? '';
$tokenSesion = $_SESSION['csrf_token'] ?? '';

echo "<p><strong>Token recibido:</strong> " . htmlspecialchars($tokenRecibido) . "</p>";
echo "<p><strong>Token en sesión:</strong> " . htmlspecialchars($tokenSesion) . "</p>";
echo "<p><strong>Son iguales:</strong> " . ($tokenRecibido === $tokenSesion ? 'SÍ' : 'NO') . "</p>";

$validacion = verificarTokenCSRF($tokenRecibido);
echo "<p><strong>Resultado verificarTokenCSRF():</strong> " . ($validacion ? 'VÁLIDO' : 'INVÁLIDO') . "</p>";

// Probar procesarFormulario
echo "<h2>Prueba de procesarFormulario()</h2>";
try {
    $resultado = procesarFormulario();
    echo "<p><strong>Resultado:</strong></p>";
    echo "<pre>";
    print_r($resultado);
    echo "</pre>";
} catch (Exception $e) {
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Probar con el token problemático del usuario
echo "<h2>Prueba con Token Problemático</h2>";
$tokenProblematico = 'ca4418f8ea1fc3c59eab7b20c80acc8ca4b5ff13a8621d47416959827a1216d5';
$validacionProblematica = verificarTokenCSRF($tokenProblematico);
echo "<p><strong>Token problemático:</strong> " . htmlspecialchars($tokenProblematico) . "</p>";
echo "<p><strong>Validación:</strong> " . ($validacionProblematica ? 'VÁLIDO' : 'INVÁLIDO') . "</p>";

// Información adicional de depuración
echo "<h2>Información de Depuración</h2>";
echo "<p><strong>Session ID:</strong> " . session_id() . "</p>";
echo "<p><strong>Session Status:</strong> " . session_status() . "</p>";
echo "<p><strong>Longitud token sesión:</strong> " . strlen($tokenSesion) . "</p>";
echo "<p><strong>Longitud token recibido:</strong> " . strlen($tokenRecibido) . "</p>";
echo "<p><strong>Longitud token problemático:</strong> " . strlen($tokenProblematico) . "</p>";

// Mostrar función de verificación
echo "<h2>Código de verificarTokenCSRF</h2>";
echo "<pre>";
echo htmlspecialchars('
function verificarTokenCSRF($token) {
    if (!isset($_SESSION["csrf_token"]) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION["csrf_token"], $token);
}
');
echo "</pre>";
?>