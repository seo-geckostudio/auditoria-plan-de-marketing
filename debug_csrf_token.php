<?php
/**
 * Script de depuración para el token CSRF
 * Ayuda a identificar problemas con la generación y validación de tokens
 */

session_start();
require_once __DIR__ . '/includes/functions.php';

echo "<h1>Debug CSRF Token</h1>";

// Mostrar información de la sesión
echo "<h2>Información de Sesión</h2>";
echo "<p><strong>Session ID:</strong> " . session_id() . "</p>";
echo "<p><strong>Session Status:</strong> " . session_status() . "</p>";

// Generar un token
echo "<h2>Generación de Token</h2>";
$token1 = generarTokenCSRF();
echo "<p><strong>Token generado (1ra vez):</strong> " . htmlspecialchars($token1) . "</p>";

$token2 = generarTokenCSRF();
echo "<p><strong>Token generado (2da vez):</strong> " . htmlspecialchars($token2) . "</p>";

echo "<p><strong>¿Son iguales?:</strong> " . ($token1 === $token2 ? 'SÍ' : 'NO') . "</p>";

// Mostrar token en sesión
echo "<p><strong>Token en sesión:</strong> " . htmlspecialchars($_SESSION['csrf_token'] ?? 'NO EXISTE') . "</p>";

// Probar validación
echo "<h2>Validación de Token</h2>";
$validacion1 = verificarTokenCSRF($token1);
echo "<p><strong>Validación token1:</strong> " . ($validacion1 ? 'VÁLIDO' : 'INVÁLIDO') . "</p>";

$validacion2 = verificarTokenCSRF($token2);
echo "<p><strong>Validación token2:</strong> " . ($validacion2 ? 'VÁLIDO' : 'INVÁLIDO') . "</p>";

// Probar con token incorrecto
$tokenIncorrecto = 'ca4418f8ea1fc3c59eab7b20c80acc8ca4b5ff13a8621d47416959827a1216d5';
$validacionIncorrecta = verificarTokenCSRF($tokenIncorrecto);
echo "<p><strong>Validación token incorrecto:</strong> " . ($validacionIncorrecta ? 'VÁLIDO' : 'INVÁLIDO') . "</p>";

// Mostrar toda la información de la sesión
echo "<h2>Datos Completos de Sesión</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Simular formulario
echo "<h2>Formulario de Prueba</h2>";
echo "<form method='POST'>";
echo "<input type='hidden' name='csrf_token' value='" . htmlspecialchars($token1) . "'>";
echo "<input type='text' name='test_field' placeholder='Campo de prueba' value='" . htmlspecialchars($_POST['test_field'] ?? '') . "'>";
echo "<button type='submit'>Enviar</button>";
echo "</form>";

// Procesar POST si existe
if ($_POST) {
    echo "<h2>Procesamiento POST</h2>";
    echo "<p><strong>Token recibido:</strong> " . htmlspecialchars($_POST['csrf_token'] ?? 'NO ENVIADO') . "</p>";
    echo "<p><strong>Token en sesión:</strong> " . htmlspecialchars($_SESSION['csrf_token'] ?? 'NO EXISTE') . "</p>";
    
    $tokenRecibido = $_POST['csrf_token'] ?? '';
    $validacionPost = verificarTokenCSRF($tokenRecibido);
    echo "<p><strong>Validación POST:</strong> " . ($validacionPost ? 'VÁLIDO' : 'INVÁLIDO') . "</p>";
    
    if (!$validacionPost) {
        echo "<div style='background: #ffebee; padding: 10px; border: 1px solid #f44336; color: #c62828;'>";
        echo "<strong>ERROR:</strong> Token de seguridad inválido<br>";
        echo "Token esperado: " . htmlspecialchars($_SESSION['csrf_token'] ?? 'NO EXISTE') . "<br>";
        echo "Token recibido: " . htmlspecialchars($tokenRecibido) . "<br>";
        echo "Longitud esperada: " . strlen($_SESSION['csrf_token'] ?? '') . "<br>";
        echo "Longitud recibida: " . strlen($tokenRecibido) . "<br>";
        echo "</div>";
    } else {
        echo "<div style='background: #e8f5e8; padding: 10px; border: 1px solid #4caf50; color: #2e7d32;'>";
        echo "<strong>ÉXITO:</strong> Token válido";
        echo "</div>";
    }
}
?>