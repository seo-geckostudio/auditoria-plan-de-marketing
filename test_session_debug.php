<?php
echo "=== SESSION DEBUG TEST ===\n";

// 1. First, get a CSRF token from the form page like a real browser would
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/index.php?modulo=clientes&accion=crear');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'debug_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'debug_cookies.txt');

$html = curl_exec($ch);
preg_match('/name="csrf_token" value="([^"]+)"/', $html, $matches);
$csrf_token = $matches[1] ?? '';

echo "1. CSRF Token from form: $csrf_token\n";

if (empty($csrf_token)) {
    echo "ERROR: Could not get CSRF token from form\n";
    exit;
}

// 2. Let's also check what cookies we got
if (file_exists('debug_cookies.txt')) {
    echo "2. Cookies received:\n";
    echo file_get_contents('debug_cookies.txt');
}

// 3. Now submit to processor.php with debug output enabled
$post_data = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Session Debug Test',
    'contacto_nombre' => 'Debug Session',
    'contacto_email' => 'session@debug.test',
    'contacto_telefono' => '555777999',
    'sector' => 'Session Testing',
    'pais' => 'Perú',
    'sitio_web' => 'https://session-debug.test',
    'notas' => 'Session debug test client',
    'csrf_token' => $csrf_token
];

curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/processor.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'debug_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'debug_cookies.txt');

echo "\n3. Submitting to processor.php...\n";
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "4. HTTP Response Code: $http_code\n";

// Parse response
list($headers, $body) = explode("\r\n\r\n", $response, 2);
echo "5. Response headers:\n$headers\n";

if (!empty($body)) {
    echo "6. Response body (first 500 chars):\n";
    echo substr($body, 0, 500) . "\n";
}

// Check if redirect
if (preg_match('/Location: (.*)/', $headers, $location_matches)) {
    echo "7. Redirect to: " . trim($location_matches[1]) . "\n";
}

curl_close($ch);

// 8. Final database check
echo "\n8. Database check:\n";
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $stmt = $pdo->query('SELECT * FROM clientes WHERE contacto_email = "session@debug.test"');
    $cliente = $stmt->fetch();

    if ($cliente) {
        echo "SUCCESS: Client found - ID: {$cliente['id']}, Name: {$cliente['nombre_empresa']}\n";
    } else {
        echo "FAILED: Client not found in database\n";
    }
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}

// Cleanup
if (file_exists('debug_cookies.txt')) {
    unlink('debug_cookies.txt');
}
?>