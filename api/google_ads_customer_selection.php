<?php
// Simple endpoint to set/get selected Google Ads customer ID.
// Usage:
//   GET /api/google_ads_customer_selection.php            -> returns current selection
//   POST /api/google_ads_customer_selection.php id=test    -> sets to test (257-911-2901)
//   POST /api/google_ads_customer_selection.php id=test2   -> sets to test2 (649-791-4215)

header('Content-Type: application/json');

$allowed = [
    'test' => '257-911-2901',
    'test2' => '649-791-4215',
];

$dataPath = __DIR__ . '/../datos_google_ads/selected_customer.json';

function readSelection($dataPath, $allowed) {
    if (file_exists($dataPath)) {
        $raw = file_get_contents($dataPath);
        $json = json_decode($raw, true);
        if (is_array($json) && isset($json['label'], $json['customer_id'])) {
            return $json;
        }
    }
    // default: none selected
    return [
        'label' => null,
        'customer_id' => null,
        'allowed' => $allowed,
    ];
}

function writeSelection($dataPath, $label, $customerId) {
    $payload = [
        'label' => $label,
        'customer_id' => $customerId,
        'updated_at' => date('c'),
    ];
    file_put_contents($dataPath, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $payload;
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    $label = $_POST['id'] ?? $_POST['label'] ?? null;
    if (!$label) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing id parameter. Use id=test or id=test2.']);
        exit;
    }
    if (!isset($allowed[$label])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid id. Allowed: test, test2']);
        exit;
    }
    $customerId = $allowed[$label];
    $result = writeSelection($dataPath, $label, $customerId);
    echo json_encode(['ok' => true, 'selection' => $result]);
    exit;
}

// GET
$selection = readSelection($dataPath, $allowed);
echo json_encode(['ok' => true, 'selection' => $selection]);