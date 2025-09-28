<?php
// Simular una sesión del navegador
session_start();

// 1. Primero obtener el token CSRF de la página de creación
echo "=== STEP 1: Getting CSRF token ===\n";
$html = file_get_contents('http://localhost:8000/index.php?modulo=clientes&accion=crear');
preg_match('/name="csrf_token" value="([^"]+)"/', $html, $matches);
$csrf_token = $matches[1] ?? '';
echo "CSRF Token extracted: $csrf_token\n";

if (empty($csrf_token)) {
    echo "ERROR: Could not extract CSRF token from form\n";
    exit;
}

// 2. Simular el envío del formulario
echo "\n=== STEP 2: Submitting form ===\n";

$post_data = http_build_query([
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Form Test Company',
    'contacto_nombre' => 'Maria Form',
    'contacto_email' => 'form@test.com',
    'contacto_telefono' => '111222333',
    'sector' => 'Form Testing',
    'pais' => 'España',
    'sitio_web' => 'https://form-test.com',
    'notas' => 'Cliente creado via form test',
    'csrf_token' => $csrf_token
]);

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => [
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: ' . strlen($post_data)
        ],
        'content' => $post_data
    ]
]);

echo "Sending POST to processor.php...\n";
$response = file_get_contents('http://localhost:8000/processor.php', false, $context);

// 3. Analizar la respuesta
echo "\n=== STEP 3: Analyzing response ===\n";
echo "Response length: " . strlen($response) . " bytes\n";

if (empty($response)) {
    echo "Empty response - likely a redirect\n";
} else {
    echo "Response content (first 500 chars):\n";
    echo substr($response, 0, 500) . "\n";

    if (strpos($response, 'Fatal error') !== false) {
        echo "FATAL ERROR detected in response!\n";
    }
    if (strpos($response, 'Warning') !== false) {
        echo "WARNING detected in response!\n";
    }
}

// 4. Verificar en la base de datos
echo "\n=== STEP 4: Checking database ===\n";
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
$stmt = $pdo->query('SELECT * FROM clientes WHERE contacto_email = "form@test.com"');
$cliente = $stmt->fetch();

if ($cliente) {
    echo "SUCCESS: Client found in database:\n";
    echo "ID: {$cliente['id']}, Name: {$cliente['nombre_empresa']}, Email: {$cliente['contacto_email']}\n";
} else {
    echo "FAILED: Client not found in database\n";
}

?>