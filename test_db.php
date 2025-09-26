<?php
try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    echo "Conexión exitosa a SQLite\n";
    
    $stmt = $pdo->query('SELECT name FROM sqlite_master WHERE type="table"');
    echo "Tablas encontradas:\n";
    while($row = $stmt->fetch()) {
        echo "- " . $row['name'] . "\n";
    }
    
    // Verificar tabla auditorias específicamente
    $stmt = $pdo->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='auditorias'");
    $auditorias_existe = $stmt->fetchColumn() > 0;
    echo "Tabla auditorias existe: " . ($auditorias_existe ? "SÍ" : "NO") . "\n";
    
    // Verificar tabla pasos específicamente
    $stmt = $pdo->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='pasos'");
    $pasos_existe = $stmt->fetchColumn() > 0;
    echo "Tabla pasos existe: " . ($pasos_existe ? "SÍ" : "NO") . "\n";
    
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>