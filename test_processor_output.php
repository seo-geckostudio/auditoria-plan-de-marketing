<?php
echo "=== PROCESSOR OUTPUT DEBUG ===\n";

// Create a modified processor that outputs debug info
$processor_code = '<?php
// Start output buffering to capture any debug output
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define("SISTEMA_INICIADO", true);

require_once __DIR__ . "/includes/functions.php";
require_once __DIR__ . "/modules/clientes.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "ERROR: Not POST request\n";
    exit;
}

$form_name = $_POST["form_name"] ?? "";

if (empty($form_name)) {
    echo "ERROR: Empty form name\n";
    exit;
}

echo "DEBUG: Form name: $form_name\n";

switch ($form_name) {
    case "clientes_crear":
        echo "DEBUG: Calling procesarCrearCliente()\n";
        $resultado = procesarCrearCliente();

        echo "DEBUG: Result received:\n";
        echo "DEBUG: success = " . var_export($resultado["success"], true) . "\n";
        echo "DEBUG: message = " . ($resultado["message"] ?? "no message") . "\n";
        echo "DEBUG: cliente_id = " . ($resultado["cliente_id"] ?? "no id") . "\n";

        if ($resultado["success"]) {
            echo "DEBUG: Success case - setting session and redirecting\n";
            $_SESSION["success"] = $resultado["message"];
            $redirect = "index.php?modulo=clientes&accion=ver&id=" . $resultado["cliente_id"];
            echo "DEBUG: Redirect URL: $redirect\n";
            header("Location: $redirect");
        } else {
            echo "DEBUG: Failure case - setting error and redirecting\n";
            $_SESSION["error"] = $resultado["message"];
            $redirect = "index.php?modulo=clientes&accion=crear";
            echo "DEBUG: Error redirect URL: $redirect\n";
            header("Location: $redirect");
        }
        exit;
        break;

    default:
        echo "ERROR: Unknown form type: $form_name\n";
        exit;
}
?>';

file_put_contents('debug_processor.php', $processor_code);

// Now test with the debug processor
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/index.php?modulo=clientes&accion=crear');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'debug_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'debug_cookies.txt');

$html = curl_exec($ch);
preg_match('/name="csrf_token" value="([^"]+)"/', $html, $matches);
$csrf_token = $matches[1] ?? '';

echo "1. CSRF Token: $csrf_token\n";

if (empty($csrf_token)) {
    echo "ERROR: Could not get CSRF token\n";
    exit;
}

$post_data = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Output Debug Test',
    'contacto_nombre' => 'Debug Output',
    'contacto_email' => 'output@debug.test',
    'contacto_telefono' => '555111222',
    'sector' => 'Output Testing',
    'pais' => 'Chile',
    'sitio_web' => 'https://output-debug.test',
    'notas' => 'Output debug test client',
    'csrf_token' => $csrf_token
];

curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/debug_processor.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'debug_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'debug_cookies.txt');

echo "2. Submitting to debug processor...\n";
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "3. HTTP Code: $http_code\n";
echo "4. Full Response:\n$response\n";

curl_close($ch);

// Cleanup
if (file_exists('debug_cookies.txt')) {
    unlink('debug_cookies.txt');
}
if (file_exists('debug_processor.php')) {
    unlink('debug_processor.php');
}

// Check database
echo "\n5. Database check:\n";
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
$stmt = $pdo->query('SELECT * FROM clientes WHERE contacto_email = "output@debug.test"');
$cliente = $stmt->fetch();

if ($cliente) {
    echo "SUCCESS: Client found - ID: {$cliente['id']}\n";
} else {
    echo "FAILED: Client not found in database\n";
}
?>