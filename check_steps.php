<?php
// Verificar estado de pasos y plantillas
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICACIÓN DE PASOS PLANTILLA:\n";
$sql = 'SELECT id, codigo_paso, nombre, metodos_entrada FROM pasos_plantilla LIMIT 10';
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch()) {
    echo 'ID: ' . $row['id'] . ' | Código: ' . $row['codigo_paso'] . ' | Métodos: ' . $row['metodos_entrada'] . "\n";
}

echo "\nAUDITORIA_PASOS PARA AUDITORIA ID=1:\n";
$sql = 'SELECT ap.id, pp.codigo_paso, pp.nombre FROM auditoria_pasos ap JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id WHERE ap.auditoria_id = 1 LIMIT 5';
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch()) {
    echo 'Paso ID: ' . $row['id'] . ' | Código: ' . $row['codigo_paso'] . ' | Nombre: ' . $row['nombre'] . "\n";
}

echo "\nCONFIGURACIÓN DE CAMPOS PARA PASO ID=1:\n";
$sql = 'SELECT COUNT(*) as count FROM paso_campos WHERE paso_plantilla_id = 1';
$result = $pdo->query($sql)->fetch();
echo 'Campos configurados: ' . $result['count'] . "\n";

if ($result['count'] > 0) {
    $sql = 'SELECT nombre_campo, tipo_campo, etiqueta FROM paso_campos WHERE paso_plantilla_id = 1';
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        echo '  - ' . $row['nombre_campo'] . ' (' . $row['tipo_campo'] . '): ' . $row['etiqueta'] . "\n";
    }
}
?>