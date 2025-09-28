<?php
session_start();
define('SISTEMA_INICIADO', true);
require_once 'includes/functions.php';

// Generar token CSRF válido
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

echo "=== DEBUG CLIENT CREATION ===\n";
echo "1. Generated CSRF token: " . $_SESSION['csrf_token'] . "\n";

// Simular datos POST del formulario
$_POST = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Debug Test Company',
    'contacto_nombre' => 'Juan Debug',
    'contacto_email' => 'debug@testcompany.com',
    'contacto_telefono' => '666777888',
    'sector' => 'Debug Sector',
    'pais' => 'España',
    'sitio_web' => 'https://debug-test.com',
    'notas' => 'Cliente de debug test',
    'csrf_token' => $_SESSION['csrf_token']
];

echo "2. POST data prepared:\n";
print_r($_POST);

// Incluir módulo después de preparar datos
require_once 'modules/clientes.php';

echo "\n3. Testing procesarCrearCliente():\n";

try {
    $resultado = procesarCrearCliente();
    echo "4. Result: " . print_r($resultado, true);

    if ($resultado['success']) {
        echo "5. SUCCESS: Client should be created with ID: " . $resultado['cliente_id'] . "\n";

        // Verificar en la base de datos
        $cliente = obtenerRegistro("SELECT * FROM clientes WHERE id = ?", [$resultado['cliente_id']]);
        if ($cliente) {
            echo "6. VERIFIED: Client exists in database:\n";
            print_r($cliente);
        } else {
            echo "6. ERROR: Client not found in database!\n";
        }
    } else {
        echo "5. FAILED: " . $resultado['message'] . "\n";
        if (isset($resultado['errores'])) {
            echo "6. Validation errors: " . print_r($resultado['errores'], true);
        }
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
?>