<?php
session_start();

// Generar un token CSRF
$token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;

echo "Session ID: " . session_id() . "\n";
echo "Generated CSRF Token: " . $token . "\n";
echo "Session CSRF Token: " . ($_SESSION['csrf_token'] ?? 'NOT SET') . "\n";

// Verificar el token
function verificarTokenCSRF($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

echo "Token verification (same token): " . (verificarTokenCSRF($token) ? 'VALID' : 'INVALID') . "\n";
echo "Token verification (different token): " . (verificarTokenCSRF('different_token') ? 'VALID' : 'INVALID') . "\n";

// Mostrar toda la sesión
echo "\nSession data:\n";
print_r($_SESSION);
?>