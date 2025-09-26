<?php
require_once 'config/database.php';

echo "<h1>Creating vista_auditorias_resumen View</h1>";

try {
    $pdo = obtenerConexion();
    
    echo "<h2>1. Dropping existing view if exists</h2>";
    try {
        $pdo->exec("DROP VIEW IF EXISTS vista_auditorias_resumen");
        echo "<p>✅ Existing view dropped</p>";
    } catch (Exception $e) {
        echo "<p>ℹ️ No existing view to drop</p>";
    }
    
    echo "<h2>2. Creating new view</h2>";
    $sql = "
    CREATE VIEW vista_auditorias_resumen AS
    SELECT 
        a.id,
        a.titulo as nombre_auditoria,
        c.nombre_empresa as cliente,
        u.nombre as consultor,
        a.estado,
        a.porcentaje_completado,
        a.fecha_inicio,
        a.fecha_fin as fecha_fin_estimada,
        COUNT(ap.id) as total_pasos,
        SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados,
        SUM(CASE WHEN ap.estado = 'pendiente' THEN 1 ELSE 0 END) as pasos_pendientes
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
    GROUP BY a.id
    ";
    
    $pdo->exec($sql);
    echo "<p>✅ Vista creada exitosamente</p>";
    
    echo "<h2>3. Testing the view</h2>";
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM vista_auditorias_resumen");
    $count = $stmt->fetch();
    echo "<p>Auditorías en la vista: " . $count['count'] . "</p>";
    
    echo "<h2>4. Testing specific audit (ID 17)</h2>";
    $stmt = $pdo->prepare("SELECT * FROM vista_auditorias_resumen WHERE id = ?");
    $stmt->execute([17]);
    $audit = $stmt->fetch();
    if ($audit) {
        echo "<p>✅ Auditoría 17 encontrada en la vista</p>";
        echo "<pre>" . json_encode($audit, JSON_PRETTY_PRINT) . "</pre>";
    } else {
        echo "<p>❌ Auditoría 17 NO encontrada en la vista</p>";
    }
    
    echo "<h2>5. Testing obtenerAuditoria function</h2>";
    require_once 'includes/functions.php';
    $auditoria = obtenerAuditoria(17);
    if ($auditoria) {
        echo "<p>✅ obtenerAuditoria(17) funciona correctamente</p>";
        echo "<pre>" . json_encode($auditoria, JSON_PRETTY_PRINT) . "</pre>";
    } else {
        echo "<p>❌ obtenerAuditoria(17) NO funciona</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}
?>