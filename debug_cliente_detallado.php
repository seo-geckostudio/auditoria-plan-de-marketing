<?php
/**
 * DEBUG: Análisis detallado del proceso de creación de cliente
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>DEBUG: Simulando creación de cliente</h2>";

// Incluir sistema
require_once __DIR__ . '/includes/init.php';

echo "<h3>1. Testing CSRF token functions</h3>";
echo "generarTokenCSRF exists: " . (function_exists('generarTokenCSRF') ? 'YES' : 'NO') . "<br>";
echo "verificarTokenCSRF exists: " . (function_exists('verificarTokenCSRF') ? 'YES' : 'NO') . "<br>";

if (function_exists('generarTokenCSRF')) {
    $token = generarTokenCSRF();
    echo "Generated token: " . $token . "<br>";

    if (function_exists('verificarTokenCSRF')) {
        $valid = verificarTokenCSRF($token);
        echo "Token validation: " . ($valid ? 'VALID' : 'INVALID') . "<br>";
    }
}

echo "<h3>2. Testing database connection</h3>";
if (function_exists('obtenerConexion')) {
    try {
        $pdo = obtenerConexion();
        echo "Database connection: SUCCESS<br>";

        // Test clientes table
        $stmt = $pdo->query("SELECT COUNT(*) FROM clientes");
        $count = $stmt->fetchColumn();
        echo "Existing clients count: " . $count . "<br>";

    } catch (Exception $e) {
        echo "Database connection ERROR: " . $e->getMessage() . "<br>";
    }
} else {
    echo "obtenerConexion function NOT FOUND<br>";
}

echo "<h3>3. Testing client module functions</h3>";
require_once __DIR__ . '/modules/clientes.php';

echo "procesarFormularioCliente exists: " . (function_exists('procesarFormularioCliente') ? 'YES' : 'NO') . "<br>";
echo "procesarCrearCliente exists: " . (function_exists('procesarCrearCliente') ? 'YES' : 'NO') . "<br>";
echo "validarDatosCliente exists: " . (function_exists('validarDatosCliente') ? 'YES' : 'NO') . "<br>";
echo "insertarRegistro exists: " . (function_exists('insertarRegistro') ? 'YES' : 'NO') . "<br>";

echo "<h3>4. Simulating form data</h3>";
$_POST = [
    'csrf_token' => $token ?? 'test_token',
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Gecko Studio',
    'sitio_web' => '',
    'sector' => '',
    'pais' => 'España',
    'contacto_nombre' => '',
    'contacto_email' => 'soloibiza1@gmail.com',
    'contacto_telefono' => '',
    'notas' => '',
    'activo' => '1'
];

echo "POST data:<br>";
echo "<pre>" . print_r($_POST, true) . "</pre>";

echo "<h3>5. Testing validation</h3>";
if (function_exists('validarDatosCliente')) {
    $errores = validarDatosCliente($_POST);
    echo "Validation errors:<br>";
    echo "<pre>" . print_r($errores, true) . "</pre>";
}

echo "<h3>6. Testing client creation function</h3>";
if (function_exists('procesarCrearCliente')) {
    ob_start();
    $resultado = procesarCrearCliente();
    $output = ob_get_clean();

    echo "Function output: " . $output . "<br>";
    echo "Function result:<br>";
    echo "<pre>" . print_r($resultado, true) . "</pre>";
}

echo "<h3>7. Form submission flow test</h3>";
// Simulate the exact flow from index.php
$_SERVER['REQUEST_METHOD'] = 'POST';
$modulo = 'clientes';
$accion = 'crear';

echo "Module: $modulo, Action: $accion<br>";
echo "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

// Test the index.php POST processing logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($modulo) {
        case 'clientes':
            if ($accion === 'crear') {
                echo "Entering clients creation block...<br>";
                if (function_exists('procesarFormularioCliente')) {
                    echo "Calling procesarFormularioCliente...<br>";
                    ob_start();
                    $resultado = procesarFormularioCliente();
                    $debug_output = ob_get_clean();

                    echo "Debug output from function: " . $debug_output . "<br>";
                    echo "Result from procesarFormularioCliente:<br>";
                    echo "<pre>" . print_r($resultado, true) . "</pre>";

                    if ($resultado['success']) {
                        echo "SUCCESS: Would redirect to client view<br>";
                    } else {
                        echo "ERROR: " . $resultado['message'] . "<br>";
                        if (isset($resultado['errores'])) {
                            echo "Errors: <pre>" . print_r($resultado['errores'], true) . "</pre>";
                        }
                    }
                } else {
                    echo "ERROR: procesarFormularioCliente function not found<br>";
                }
            }
            break;
    }
}

?>