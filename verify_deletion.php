<?php
/**
 * VERIFICAR ELIMINACIÓN
 * ====================
 */

require_once 'includes/init.php';

echo "🔍 VERIFICACIÓN POST-ELIMINACIÓN\n";
echo "==============================\n\n";

try {
    $pdo = obtenerConexion();

    // Verificar auditorías restantes
    $sql = "SELECT id, titulo FROM auditorias ORDER BY id DESC LIMIT 10";
    $stmt = $pdo->query($sql);
    $auditorias = $stmt->fetchAll();

    echo "📋 AUDITORÍAS ACTUALES:\n";
    foreach ($auditorias as $auditoria) {
        echo "ID: {$auditoria['id']} - {$auditoria['titulo']}\n";
    }

    // Verificar específicamente la ID 24
    $sql = "SELECT COUNT(*) FROM auditorias WHERE id = 24";
    $exists = $pdo->query($sql)->fetchColumn();

    echo "\n🎯 VERIFICACIÓN ID 24:\n";
    if ($exists == 0) {
        echo "✅ CONFIRMADO: La auditoría ID 24 fue eliminada exitosamente\n";
    } else {
        echo "❌ ERROR: La auditoría ID 24 AÚN existe\n";
    }

    // Contar total de auditorías
    $sql = "SELECT COUNT(*) FROM auditorias";
    $total = $pdo->query($sql)->fetchColumn();
    echo "\n📊 TOTAL DE AUDITORÍAS: $total\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>