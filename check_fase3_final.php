<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICANDO PASOS FASE 3 RESTANTES:\n\n";

// Buscar todos los pasos que podrían ser fase 3
$sql = "SELECT id, codigo_paso, nombre FROM pasos_plantilla WHERE
        id >= 7 AND id <= 15
        ORDER BY id";
$result = $pdo->query($sql);
echo "Pasos ID 7-15 (posibles Fase 3):\n";
while ($row = $result->fetch()) {
    // Verificar si tiene campos configurados
    $sql2 = 'SELECT COUNT(*) as count FROM paso_campos WHERE paso_plantilla_id = ?';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$row['id']]);
    $campos = $stmt2->fetch()['count'];

    $status = $campos > 0 ? "✅ CONFIGURADO ($campos campos)" : "❌ SIN CONFIGURAR";

    echo "ID: {$row['id']} | {$row['codigo_paso']} | {$row['nombre']} | {$status}\n";
}

// Verificar auditoría 26 para ver qué pasos tiene
echo "\n\nPASOS EN AUDITORÍA 26:\n";
$sql = "SELECT ap.id, ap.paso_plantilla_id, pt.codigo_paso, pt.nombre
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pt ON ap.paso_plantilla_id = pt.id
        WHERE ap.auditoria_id = 26 AND ap.paso_plantilla_id >= 7 AND ap.paso_plantilla_id <= 15
        ORDER BY ap.paso_plantilla_id";
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    echo "Audit ID: {$row['id']} | Template: {$row['paso_plantilla_id']} | {$row['codigo_paso']} | {$row['nombre']}\n";
}
?>