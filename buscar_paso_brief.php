<?php
// Script temporal para buscar el paso del Brief del Cliente

$db = new PDO('sqlite:seo_audit_system.db');

echo "=== Buscando paso 'Brief del Cliente' ===\n\n";

// Buscar en pasos_plantilla
$sql = "SELECT id, nombre, codigo_paso, fase_id FROM pasos_plantilla WHERE nombre LIKE '%brief%' OR nombre LIKE '%cliente%'";
$result = $db->query($sql);

echo "Pasos encontrados:\n";
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | Nombre: {$row['nombre']} | Código: {$row['codigo_paso']} | Fase: {$row['fase_id']}\n";
}

echo "\n=== Buscando auditorías con pasos ===\n\n";

// Buscar auditorías y sus pasos
$sql = "SELECT ap.id as paso_id, ap.auditoria_id, a.titulo, pp.nombre as paso_nombre
        FROM auditoria_pasos ap
        JOIN auditorias a ON ap.auditoria_id = a.id
        JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
        WHERE pp.nombre LIKE '%brief%' OR pp.nombre LIKE '%cliente%'
        LIMIT 5";
$result = $db->query($sql);

echo "Auditorías con paso Brief:\n";
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "URL: http://localhost:8000/index.php?modulo=auditorias&accion=formulario&auditoria_id={$row['auditoria_id']}&paso_id={$row['paso_id']}\n";
    echo "  Auditoría: {$row['titulo']} | Paso: {$row['paso_nombre']}\n\n";
}
