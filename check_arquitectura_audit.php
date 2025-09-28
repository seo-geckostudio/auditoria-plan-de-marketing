<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICANDO PASO ARQUITECTURA EN AUDITORÍA 26:\n\n";

// Verificar si existe paso en auditoria específica
$sql = "SELECT id, auditoria_id, paso_plantilla_id FROM auditoria_pasos WHERE paso_plantilla_id = 8 AND auditoria_id = 26";
$result = $pdo->query($sql);
echo "Paso en auditoría 26:\n";
while ($row = $result->fetch()) {
    echo "ID: {$row['id']} | Auditoría: {$row['auditoria_id']} | Plantilla: {$row['paso_plantilla_id']}\n";
}

// Verificar campos configurados
$sql = "SELECT COUNT(*) as count FROM paso_campos WHERE paso_plantilla_id = 8";
$result = $pdo->query($sql);
$count = $result->fetch()['count'];
echo "\nCampos configurados: $count\n";
?>