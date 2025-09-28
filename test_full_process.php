<?php
session_start();
define('SISTEMA_INICIADO', true);
require_once 'includes/functions.php';
require_once 'modules/clientes.php';

// Simular datos POST completos
$_POST = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Test Company Full',
    'contacto_nombre' => 'Juan Full',
    'contacto_email' => 'full@test.com',
    'contacto_telefono' => '111222333',
    'sector' => 'Full Testing',
    'pais' => 'España',
    'sitio_web' => 'https://test-full.com',
    'notas' => 'Cliente de prueba completo',
    'csrf_token' => 'test_token'
];

echo "=== TESTING FULL PROCESS ===\n";

// Comprobar si existen las funciones necesarias
echo "Functions exist:\n";
echo "- insertarRegistro: " . (function_exists('insertarRegistro') ? 'YES' : 'NO') . "\n";
echo "- sanitizar: " . (function_exists('sanitizar') ? 'YES' : 'NO') . "\n";
echo "- verificarTokenCSRF: " . (function_exists('verificarTokenCSRF') ? 'YES' : 'NO') . "\n";
echo "- validarDatosCliente: " . (function_exists('validarDatosCliente') ? 'YES' : 'NO') . "\n";
echo "- existeClienteConEmail: " . (function_exists('existeClienteConEmail') ? 'YES' : 'NO') . "\n";

echo "\nTesting procesarCrearCliente():\n";

try {
    $resultado = procesarCrearCliente();
    echo "Result: " . print_r($resultado, true);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
?>