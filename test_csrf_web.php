<?php
session_start();

// Include the functions
require_once __DIR__ . '/includes/functions.php';

echo "<h1>CSRF Token Test</h1>";

// Generate a token
$token = generarTokenCSRF();
echo "<p>Generated Token: " . htmlspecialchars($token) . "</p>";
echo "<p>Session Token: " . htmlspecialchars($_SESSION['csrf_token'] ?? 'NOT SET') . "</p>";

// Test verification
$isValid = verificarTokenCSRF($token);
echo "<p>Token Verification: " . ($isValid ? 'VALID' : 'INVALID') . "</p>";

// Show session data
echo "<h2>Session Data:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Test form
echo "<h2>Test Form:</h2>";
echo "<form method='POST'>";
echo "<input type='hidden' name='csrf_token' value='" . htmlspecialchars($token) . "'>";
echo "<input type='text' name='test_field' placeholder='Test field'>";
echo "<button type='submit'>Submit</button>";
echo "</form>";

if ($_POST) {
    echo "<h2>POST Data:</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    $postToken = $_POST['csrf_token'] ?? '';
    $isPostValid = verificarTokenCSRF($postToken);
    echo "<p>POST Token Verification: " . ($isPostValid ? 'VALID' : 'INVALID') . "</p>";
}
?>