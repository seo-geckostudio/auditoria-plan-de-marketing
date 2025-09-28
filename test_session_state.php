<?php
echo "=== SESSION STATE DEBUG ===\n";

// Test 1: Get form and check session/token state
echo "1. Getting form page...\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/index.php?modulo=clientes&accion=crear');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'session_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'session_cookies.txt');
curl_setopt($ch, CURLOPT_HEADER, true);

$response1 = curl_exec($ch);
$http_code1 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "   HTTP Code: $http_code1\n";

// Extract session cookie from response
if (preg_match('/Set-Cookie: PHPSESSID=([^;]+)/', $response1, $cookie_matches)) {
    $session_id = $cookie_matches[1];
    echo "   Session ID set: $session_id\n";
} else {
    echo "   No session cookie found in response\n";
}

// Extract CSRF token
if (preg_match('/name="csrf_token" value="([^"]+)"/', $response1, $token_matches)) {
    $csrf_token = $token_matches[1];
    echo "   CSRF Token: $csrf_token\n";
} else {
    echo "   No CSRF token found\n";
    exit;
}

// Test 2: Check what cookies we're sending back
echo "\n2. Checking cookies to send...\n";
if (file_exists('session_cookies.txt')) {
    $cookies_content = file_get_contents('session_cookies.txt');
    echo "   Cookies file content:\n";
    echo "   " . str_replace("\n", "\n   ", $cookies_content) . "\n";
}

// Test 3: Create a simple session verification endpoint
$session_test_code = '<?php
session_start();
header("Content-Type: text/plain");

echo "Session ID: " . session_id() . "\n";
echo "Session status: " . session_status() . "\n";
echo "CSRF token in session: " . ($_SESSION["csrf_token"] ?? "NOT SET") . "\n";

if (isset($_POST["test_token"])) {
    echo "Posted token: " . $_POST["test_token"] . "\n";
    echo "Tokens match: " . (($_SESSION["csrf_token"] ?? "") === $_POST["test_token"] ? "YES" : "NO") . "\n";
}
?>';

file_put_contents('session_test.php', $session_test_code);

// Test 4: Check session state with our token
echo "\n3. Testing session state...\n";
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/session_test.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['test_token' => $csrf_token]));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'session_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'session_cookies.txt');

$response2 = curl_exec($ch);
$http_code2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "   HTTP Code: $http_code2\n";
echo "   Response:\n";
echo "   " . str_replace("\n", "\n   ", $response2) . "\n";

curl_close($ch);

// Cleanup
if (file_exists('session_cookies.txt')) {
    unlink('session_cookies.txt');
}
if (file_exists('session_test.php')) {
    unlink('session_test.php');
}
?>