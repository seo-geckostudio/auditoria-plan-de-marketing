<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICANDO PASO PLAN DE MIGRACIÓN:\n\n";

// Buscar pasos relacionados con migración/implementación
$sql = "SELECT id, codigo_paso, nombre FROM pasos_plantilla WHERE
        codigo_paso LIKE '%migracion%' OR
        codigo_paso LIKE '%implementacion%' OR
        nombre LIKE '%migración%' OR
        nombre LIKE '%implementación%' OR
        codigo_paso LIKE '10_%'
        ORDER BY id";
$result = $pdo->query($sql);
echo "Pasos relacionados con migración/implementación:\n";
while ($row = $result->fetch()) {
    echo "ID: {$row['id']} | {$row['codigo_paso']} | {$row['nombre']}\n";
}
?>