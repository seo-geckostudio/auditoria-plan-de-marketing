<?php
echo "=== DEBUGGING FORM RESPONSE ===\n";

// 1. Obtener token CSRF real
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/index.php?modulo=clientes&accion=crear');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');

$html = curl_exec($ch);
preg_match('/name="csrf_token" value="([^"]+)"/', $html, $matches);
$csrf_token = $matches[1] ?? '';

if (empty($csrf_token)) {
    echo "ERROR: Could not get CSRF token\n";
    exit;
}

// 2. Enviar formulario
$post_data = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Response Debug Test',
    'contacto_nombre' => 'Debug User',
    'contacto_email' => 'debug@response.com',
    'contacto_telefono' => '555123456',
    'sector' => 'Debug Testing',
    'pais' => 'España',
    'sitio_web' => 'https://debug-response.com',
    'notas' => 'Debug response test',
    'csrf_token' => $csrf_token
];

curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/processor.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); // Don't follow redirects to see what happens
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "HTTP Code: $http_code\n";
echo "Response:\n";
echo $response;

curl_close($ch);

// Limpiar
if (file_exists('cookies.txt')) {
    unlink('cookies.txt');
}
?>