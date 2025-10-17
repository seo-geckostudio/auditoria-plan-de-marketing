<?php
$db = new PDO('sqlite:data/auditoria_seo.sqlite');
$stmt = $db->query('SELECT id, codigo_paso, paso_nombre FROM pasos WHERE id = 968');
$paso = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Paso 968:\n";
print_r($paso);

// Verificar si cumple condición brief
$codigo = strtolower($paso['codigo_paso'] ?? '');
$nombre = strtolower($paso['paso_nombre'] ?? '');

echo "\nCódigo lowercase: $codigo\n";
echo "Nombre lowercase: $nombre\n";
echo "\n¿Tiene 'brief' en código? " . (strpos($codigo, 'brief') !== false ? 'SÍ' : 'NO') . "\n";
echo "¿Tiene 'brief' en nombre? " . (strpos($nombre, 'brief') !== false ? 'SÍ' : 'NO') . "\n";
