<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $stmt = $pdo->query('SELECT name FROM sqlite_master WHERE type="table" AND name="clientes"');
    $result = $stmt->fetch();
    
    if ($result) {
        echo "Table clientes exists\n";
        $stmt = $pdo->query('PRAGMA table_info(clientes)');
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Columns:\n";
        foreach ($columns as $col) {
            echo "- " . $col['name'] . " (" . $col['type'] . ")" . ($col['notnull'] ? " NOT NULL" : "") . "\n";
        }
    } else {
        echo "Table clientes does not exist\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>