<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$pdo = obtenerConexion();

// Ver auditorías disponibles
echo "=== AUDITORÍAS DISPONIBLES ===\n\n";
$stmt = $pdo->query("SELECT id, titulo, cliente_id FROM auditorias LIMIT 10");
$auditorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($auditorias as $auditoria) {
    echo "ID: {$auditoria['id']} - {$auditoria['titulo']}\n";
}

// Si hay auditorías, ver pasos de la primera
if (count($auditorias) > 0) {
    $auditoria_id = $auditorias[0]['id'];

    echo "\n\n=== PASOS DE AUDITORÍA #{$auditoria_id} ===\n\n";

    $stmt = $pdo->prepare("
        SELECT
            ap.id,
            pp.nombre as paso_nombre,
            ap.estado
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
        WHERE ap.auditoria_id = ?
        LIMIT 20
    ");
    $stmt->execute([$auditoria_id]);
    $pasos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($pasos as $paso) {
        echo "ID: {$paso['id']} - {$paso['paso_nombre']} [{$paso['estado']}]\n";

        // Buscar pasos que activen secciones educativas
        $nombre_lower = strtolower($paso['paso_nombre']);
        if (strpos($nombre_lower, 'url') !== false ||
            strpos($nombre_lower, 'arquitectura') !== false ||
            strpos($nombre_lower, 'h1') !== false ||
            strpos($nombre_lower, 'meta') !== false ||
            strpos($nombre_lower, 'imagen') !== false ||
            strpos($nombre_lower, 'keyword') !== false) {
            echo "   ✅ Este paso activará sección educativa\n";
        }
    }
}
