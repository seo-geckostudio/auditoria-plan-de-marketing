<?php
require_once 'includes/functions.php';

echo "=== EXISTING CLIENTS IN DATABASE ===\n";

$pdo = obtenerConexion();
$stmt = $pdo->query('SELECT id, contacto_email, nombre_empresa, fecha_creacion FROM clientes ORDER BY id');
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($clientes)) {
    echo "No clients found in database.\n";
} else {
    echo "Found " . count($clientes) . " clients:\n";
    foreach ($clientes as $cliente) {
        echo "ID: {$cliente['id']}, Email: {$cliente['contacto_email']}, Company: {$cliente['nombre_empresa']}, Created: {$cliente['fecha_creacion']}\n";
    }
}

echo "\n=== CLEARING TEST DATA ===\n";
$testEmails = [
    'processor@test.com',
    'debug@testcompany.com',
    'form@test.com',
    'curl@realtest.com',
    'debug@response.com'
];

foreach ($testEmails as $email) {
    $deleted = $pdo->prepare('DELETE FROM clientes WHERE contacto_email = ?');
    $result = $deleted->execute([$email]);
    if ($result && $deleted->rowCount() > 0) {
        echo "Deleted client with email: $email\n";
    }
}

echo "\n=== REMAINING CLIENTS ===\n";
$stmt = $pdo->query('SELECT id, contacto_email, nombre_empresa FROM clientes ORDER BY id');
$remaining = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($remaining)) {
    echo "No clients remain in database.\n";
} else {
    echo "Remaining " . count($remaining) . " clients:\n";
    foreach ($remaining as $cliente) {
        echo "ID: {$cliente['id']}, Email: {$cliente['contacto_email']}, Company: {$cliente['nombre_empresa']}\n";
    }
}
?>