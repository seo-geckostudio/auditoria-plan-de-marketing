<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICANDO PASO 09_PROPUESTA_ARQUITECTURA:\n\n";

// Verificar si existe en pasos_plantilla
$sql = "SELECT id, codigo_paso, nombre FROM pasos_plantilla WHERE codigo_paso = '09_propuesta_arquitectura'";
$result = $pdo->query($sql);
echo "Paso en plantilla:\n";
while ($row = $result->fetch()) {
    echo "ID: {$row['id']} | {$row['codigo_paso']} | {$row['nombre']}\n";
}

// Verificar si existe paso en auditoria específica
$sql = "SELECT id, auditoria_id, paso_plantilla_id FROM auditoria_pasos WHERE paso_plantilla_id = 10 AND auditoria_id = 26";
$result = $pdo->query($sql);
echo "\nPaso en auditoría 26:\n";
while ($row = $result->fetch()) {
    echo "ID: {$row['id']} | Auditoría: {$row['auditoria_id']} | Plantilla: {$row['paso_plantilla_id']}\n";
}

// Verificar campos configurados
$sql = "SELECT COUNT(*) as count FROM paso_campos WHERE paso_plantilla_id = 10";
$result = $pdo->query($sql);
$count = $result->fetch()['count'];
echo "\nCampos configurados: $count\n";
?>