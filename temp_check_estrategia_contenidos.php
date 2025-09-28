<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "VERIFICACIÓN PASO ESTRATEGIA DE CONTENIDOS:\n\n";

$sql = 'SELECT id, codigo_paso, nombre, metodos_entrada FROM pasos_plantilla WHERE codigo_paso = "03_estrategia_contenidos"';
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

if ($row) {
    echo "ID: {$row['id']} | Código: {$row['codigo_paso']} | Nombre: {$row['nombre']} | Métodos: {$row['metodos_entrada']}\n";

    // Verificar si tiene campos configurados
    $sql2 = 'SELECT COUNT(*) as count FROM paso_campos WHERE paso_plantilla_id = ?';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$row['id']]);
    $campos = $stmt2->fetch()['count'];

    echo "Campos configurados: $campos\n";
} else {
    echo "Paso no encontrado\n";
}
?>