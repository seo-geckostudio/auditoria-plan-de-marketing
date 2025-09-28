<?php
echo "=== TESTING REAL FORM SUBMISSION ===\n";

// 1. Obtener token CSRF real
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/index.php?modulo=clientes&accion=crear');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');

$html = curl_exec($ch);
preg_match('/name="csrf_token" value="([^"]+)"/', $html, $matches);
$csrf_token = $matches[1] ?? '';
echo "1. CSRF Token: $csrf_token\n";

if (empty($csrf_token)) {
    echo "ERROR: Could not get CSRF token\n";
    exit;
}

// 2. Enviar formulario con curl y seguir redirects
$post_data = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Real Curl Test',
    'contacto_nombre' => 'Ana Curl',
    'contacto_email' => 'curl@realtest.com',
    'contacto_telefono' => '555666777',
    'sector' => 'Real Testing',
    'pais' => 'Colombia',
    'sitio_web' => 'https://real-curl-test.com',
    'notas' => 'Cliente desde curl real',
    'csrf_token' => $csrf_token
];

curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/processor.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');

echo "2. Submitting form...\n";
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

echo "3. HTTP Code: $http_code\n";
echo "4. Final URL: $final_url\n";

// Buscar en el response si hay mensajes de éxito o error
if (strpos($response, 'Cliente creado exitosamente') !== false) {
    echo "5. SUCCESS MESSAGE found in response\n";
} elseif (strpos($response, 'alert-success') !== false) {
    echo "5. SUCCESS ALERT found in response\n";
} elseif (strpos($response, 'alert-danger') !== false) {
    echo "5. ERROR ALERT found in response\n";
} else {
    echo "5. No success/error message found\n";
}

curl_close($ch);

// 3. Verificar en la base de datos
echo "\n=== DATABASE CHECK ===\n";
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
$stmt = $pdo->query('SELECT * FROM clientes WHERE contacto_email = "curl@realtest.com"');
$cliente = $stmt->fetch();

if ($cliente) {
    echo "SUCCESS: Client found in database:\n";
    echo "ID: {$cliente['id']}, Name: {$cliente['nombre_empresa']}, Email: {$cliente['contacto_email']}\n";
} else {
    echo "FAILED: Client not found in database\n";
}

// Limpiar archivo de cookies
if (file_exists('cookies.txt')) {
    unlink('cookies.txt');
}
?>