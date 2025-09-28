<?php
// Test directo del processor con debugging
echo "=== TESTING PROCESSOR DIRECTLY ===\n";

// Configurar como si fuera el processor.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir constante del sistema
define('SISTEMA_INICIADO', true);

// Incluir funciones del sistema
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/modules/clientes.php';

// Generar token CSRF válido
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Simular REQUEST_METHOD POST
$_SERVER['REQUEST_METHOD'] = 'POST';

// Simular datos POST
$_POST = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Processor Test Company',
    'contacto_nombre' => 'Pedro Processor',
    'contacto_email' => 'processor@test.com',
    'contacto_telefono' => '999888777',
    'sector' => 'Processor Testing',
    'pais' => 'México',
    'sitio_web' => 'https://processor-test.com',
    'notas' => 'Cliente desde processor test',
    'csrf_token' => $_SESSION['csrf_token']
];

echo "1. POST data configured\n";
echo "2. CSRF token: " . $_SESSION['csrf_token'] . "\n";

// Obtener el nombre del formulario
$form_name = $_POST['form_name'] ?? '';
echo "3. Form name: $form_name\n";

if (empty($form_name)) {
    echo "ERROR: Form name is empty\n";
    exit;
}

echo "4. Processing form...\n";

// Procesar según el tipo de formulario (copiado del processor.php)
switch ($form_name) {
    case 'clientes_crear':
        echo "5. Calling procesarCrearCliente()...\n";
        $resultado = procesarCrearCliente();
        echo "6. Result: " . print_r($resultado, true);

        if ($resultado['success']) {
            echo "7. SUCCESS: Setting session message and redirecting...\n";
            $_SESSION['success'] = $resultado['message'];
            $redirect_url = 'index.php?modulo=clientes&accion=ver&id=' . $resultado['cliente_id'];
            echo "8. Redirect URL would be: $redirect_url\n";

            // No hacer el redirect real para poder ver el resultado
            echo "9. CLIENT SHOULD BE CREATED WITH ID: " . $resultado['cliente_id'] . "\n";
        } else {
            echo "7. FAILED: " . $resultado['message'] . "\n";
            $_SESSION['error'] = $resultado['message'];
            $redirect_url = 'index.php?modulo=clientes&accion=crear';
            echo "8. Error redirect URL would be: $redirect_url\n";
        }
        break;

    default:
        echo "ERROR: Unknown form type: $form_name\n";
        break;
}

echo "\n=== FINAL DATABASE CHECK ===\n";
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
$stmt = $pdo->query('SELECT * FROM clientes WHERE contacto_email = "processor@test.com"');
$cliente = $stmt->fetch();

if ($cliente) {
    echo "SUCCESS: Client found in database:\n";
    print_r($cliente);
} else {
    echo "FAILED: Client not found in database\n";
}
?>