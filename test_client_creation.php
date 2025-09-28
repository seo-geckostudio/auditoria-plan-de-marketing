<?php
define('SISTEMA_INICIADO', true);
require_once 'includes/functions.php';
require_once 'modules/clientes.php';

// Simular datos POST
$_POST = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Test Company Debug',
    'contacto_nombre' => 'Juan Debug',
    'contacto_email' => 'debug@test.com',
    'contacto_telefono' => '123456789',
    'sector' => 'Testing',
    'pais' => 'España',
    'sitio_web' => 'https://test-debug.com',
    'notas' => 'Cliente de prueba debug',
    'csrf_token' => 'debug_token'
];

echo "=== TEST CLIENT CREATION ===\n";
echo "POST data prepared\n";

// Intentar crear el cliente directamente
$datos = [
    'nombre_empresa' => 'Test Direct',
    'contacto_nombre' => 'Juan Direct',
    'contacto_email' => 'direct@test.com',
    'contacto_telefono' => '987654321',
    'sector' => 'Direct Testing',
    'pais' => 'México',
    'activo' => 1,
    'fecha_creacion' => date('Y-m-d H:i:s')
];

echo "\nTesting insertarRegistro directly:\n";
$resultado = insertarRegistro('clientes', $datos);
echo "Result: " . ($resultado ? "ID $resultado" : "FAILED") . "\n";

if ($resultado) {
    echo "\nClient created successfully with ID: $resultado\n";

    // Verificar en la base de datos
    $cliente = obtenerRegistro("SELECT * FROM clientes WHERE id = ?", [$resultado]);
    if ($cliente) {
        echo "Client data: " . print_r($cliente, true);
    }
}
?>