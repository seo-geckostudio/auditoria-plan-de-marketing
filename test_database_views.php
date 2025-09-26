<?php
require_once 'config/database.php';

echo "<h1>Database Views and Tables Check</h1>";

try {
    $pdo = obtenerConexion();
    
    echo "<h2>1. Checking Views</h2>";
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='view'");
    $views = $stmt->fetchAll();
    echo "<p>Views found: " . count($views) . "</p>";
    if (count($views) > 0) {
        echo "<ul>";
        foreach ($views as $view) {
            echo "<li>" . $view['name'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>❌ No views found in database</p>";
    }
    
    echo "<h2>2. Checking Auditorias Table</h2>";
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM auditorias");
    $count = $stmt->fetch();
    echo "<p>Total auditorias: " . $count['count'] . "</p>";
    
    echo "<h2>3. Last Created Audit</h2>";
    $stmt = $pdo->query("SELECT * FROM auditorias ORDER BY id DESC LIMIT 1");
    $audit = $stmt->fetch();
    if ($audit) {
        echo "<p>✅ Last audit found:</p>";
        echo "<ul>";
        echo "<li>ID: " . $audit['id'] . "</li>";
        echo "<li>Title: " . $audit['titulo'] . "</li>";
        echo "<li>Created: " . $audit['created_at'] . "</li>";
        echo "</ul>";
    } else {
        echo "<p>❌ No audits found</p>";
    }
    
    echo "<h2>4. Testing Direct Query</h2>";
    $stmt = $pdo->query("SELECT * FROM auditorias WHERE id = 17");
    $audit17 = $stmt->fetch();
    if ($audit17) {
        echo "<p>✅ Audit ID 17 found directly in auditorias table</p>";
        echo "<pre>" . json_encode($audit17, JSON_PRETTY_PRINT) . "</pre>";
    } else {
        echo "<p>❌ Audit ID 17 NOT found in auditorias table</p>";
    }
    
    echo "<h2>5. Testing Vista Query</h2>";
    try {
        $stmt = $pdo->query("SELECT * FROM vista_auditorias_resumen WHERE id = 17");
        $auditVista = $stmt->fetch();
        if ($auditVista) {
            echo "<p>✅ Audit ID 17 found in vista_auditorias_resumen</p>";
        } else {
            echo "<p>❌ Audit ID 17 NOT found in vista_auditorias_resumen</p>";
        }
    } catch (Exception $e) {
        echo "<p>❌ Error querying vista_auditorias_resumen: " . $e->getMessage() . "</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
}
?>