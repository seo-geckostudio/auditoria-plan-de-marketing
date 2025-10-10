<?php
// Simple logger para auditoría: guarda historial y backup del JSON de estructura

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método no permitido']);
  exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);
if (!$data) {
  http_response_code(400);
  echo json_encode(['error' => 'JSON inválido']);
  exit;
}

$baseDir = __DIR__ . '/../logs';
$historyDir = $baseDir . '/history';
$backupDir = $baseDir . '/backups';

foreach ([$baseDir, $historyDir, $backupDir] as $dir) {
  if (!is_dir($dir)) {
    @mkdir($dir, 0777, true);
  }
}

$ts = isset($data['timestamp']) ? $data['timestamp'] : date('c');
$stamp = date('Ymd_His');

// Guardar evento individual como archivo JSON
$eventFile = $historyDir . "/event_{$stamp}.json";
file_put_contents($eventFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Copia de seguridad del JSON de estructura (si existe)
$estructuraPath = __DIR__ . '/../data/analisis_estructura.json';
if (file_exists($estructuraPath)) {
  $backupFile = $backupDir . "/analisis_estructura_{$stamp}.json";
  @copy($estructuraPath, $backupFile);
}

echo json_encode(['ok' => true, 'event_file' => basename($eventFile)]);
?>