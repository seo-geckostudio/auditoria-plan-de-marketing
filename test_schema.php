<?php
try {
    $sqlite_path = __DIR__ . '/data/auditoria_seo.sqlite';
    $dsn = 'sqlite:' . $sqlite_path;
    $pdo = new PDO($dsn, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    $sql = file_get_contents(__DIR__ . '/database_schema.sql');
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $i => $statement) {
        if (!empty($statement)) {
            echo 'Executing statement ' . ($i + 1) . ': ' . substr($statement, 0, 50) . '...' . PHP_EOL;
            $pdo->exec($statement);
        }
    }
    
    echo 'Schema created successfully!' . PHP_EOL;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
?>