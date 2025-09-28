<?php
// Test exactly like the web form submission happens
session_start();
define('SISTEMA_INICIADO', true);

// Include everything like processor.php does
require_once 'includes/functions.php';
require_once 'modules/clientes.php';

echo "=== WEB CONTEXT TEST ===\n";

// Generate CSRF token like the form does
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Set up like web request
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Web Context Test',
    'contacto_nombre' => 'Web User',
    'contacto_email' => 'web@context.test',
    'contacto_telefono' => '555999888',
    'sector' => 'Web Testing',
    'pais' => 'Colombia',
    'sitio_web' => 'https://web-context.test',
    'notas' => 'Web context test client',
    'csrf_token' => $csrf_token
];

echo "1. CSRF Token: $csrf_token\n";
echo "2. POST data set up\n";

// Call function exactly like processor.php does
echo "3. Calling procesarCrearCliente()...\n";
$resultado = procesarCrearCliente();

echo "4. Raw result:\n";
var_dump($resultado);

echo "\n5. Analysis:\n";
if (isset($resultado['success'])) {
    if ($resultado['success'] === true) {
        echo "SUCCESS: True\n";
    } elseif ($resultado['success'] === false) {
        echo "SUCCESS: False\n";
    } else {
        echo "SUCCESS: Other value: " . var_export($resultado['success'], true) . "\n";
    }
} else {
    echo "SUCCESS key not set!\n";
}

if (isset($resultado['message'])) {
    echo "MESSAGE: " . $resultado['message'] . "\n";
}

if (isset($resultado['errores'])) {
    echo "ERRORS: " . print_r($resultado['errores'], true);
}

echo "\n6. Database check:\n";
$cliente = obtenerRegistro("SELECT * FROM clientes WHERE contacto_email = ?", ['web@context.test']);
if ($cliente) {
    echo "Client created in database: ID " . $cliente['id'] . "\n";
} else {
    echo "Client NOT found in database\n";
}
?>