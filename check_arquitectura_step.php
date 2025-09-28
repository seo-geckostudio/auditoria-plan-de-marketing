<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICANDO PASO 07_ARQUITECTURA_ACTUAL:\n\n";

// Verificar si existe en pasos_plantilla
$sql = "SELECT id, codigo_paso, nombre FROM pasos_plantilla WHERE codigo_paso = '07_arquitectura_actual'";
$result = $pdo->query($sql);
echo "Paso en plantilla:\n";
while ($row = $result->fetch()) {
    echo "ID: {$row['id']} | {$row['codigo_paso']} | {$row['nombre']}\n";
}

// Si no existe, buscar pasos similares
$sql = "SELECT id, codigo_paso, nombre FROM pasos_plantilla WHERE codigo_paso LIKE '%arquitectura%' OR nombre LIKE '%arquitectura%'";
$result = $pdo->query($sql);
echo "\nPasos con 'arquitectura':\n";
while ($row = $result->fetch()) {
    echo "ID: {$row['id']} | {$row['codigo_paso']} | {$row['nombre']}\n";
}
?>