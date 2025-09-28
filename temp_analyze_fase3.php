<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "ANÁLISIS AUTOMÁTICO - FASE 3: ARQUITECTURA DEL SITIO\n\n";

// Buscar pasos que puedan ser de la fase 3 (arquitectura)
$sql = 'SELECT id, codigo_paso, nombre, metodos_entrada FROM pasos_plantilla WHERE
        codigo_paso LIKE "%mapping%" OR
        codigo_paso LIKE "%arquitectura%" OR
        nombre LIKE "%arquitectura%" OR
        nombre LIKE "%mapping%" OR
        nombre LIKE "%estructura%" OR
        codigo_paso LIKE "%05_%" OR
        codigo_paso LIKE "%06_%" OR
        codigo_paso LIKE "%07_%" OR
        codigo_paso LIKE "%08_%"
        ORDER BY id';
$stmt = $pdo->query($sql);

echo "PASOS POTENCIALES PARA FASE 3:\n";
while ($row = $stmt->fetch()) {
    // Verificar si tiene campos configurados
    $sql2 = 'SELECT COUNT(*) as count FROM paso_campos WHERE paso_plantilla_id = ?';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$row['id']]);
    $campos = $stmt2->fetch()['count'];

    $status = $campos > 0 ? "✅ CONFIGURADO ($campos campos)" : "❌ SIN CONFIGURAR";

    echo "ID: {$row['id']} | {$row['codigo_paso']} | {$row['nombre']} | {$status}\n";
}

echo "\nPRIORIDAD SUGERIDA PARA FASE 3:\n";
echo "1. KEYWORD MAPPING (mapeo de keywords a URLs)\n";
echo "2. ARQUITECTURA ACTUAL (análisis de estructura existente)\n";
echo "3. PROPUESTA ARQUITECTURA (nueva estructura optimizada)\n";
echo "4. PLAN MIGRACIÓN (implementación de cambios)\n";
?>