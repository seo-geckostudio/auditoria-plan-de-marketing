<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

$archivo_id = $_GET['id'] ?? null;

if (!$archivo_id) {
    http_response_code(404);
    echo 'Archivo no encontrado';
    exit;
}

try {
    $pdo = obtenerConexion();
    
    // Obtener información del archivo
    $stmt = $pdo->prepare("
        SELECT a.*, ap.auditoria_id
        FROM archivos a
        JOIN auditoria_pasos ap ON a.auditoria_paso_id = ap.id
        WHERE a.id = ?
    ");
    $stmt->execute([$archivo_id]);
    $archivo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$archivo) {
        http_response_code(404);
        echo 'Archivo no encontrado';
        exit;
    }
    
    $ruta_archivo = $archivo['ruta_archivo'];
    
    // Verificar que el archivo existe físicamente
    if (!file_exists($ruta_archivo)) {
        http_response_code(404);
        echo 'Archivo físico no encontrado';
        exit;
    }
    
    // Configurar headers para descarga
    $nombre_original = $archivo['nombre_original'];
    $tipo_archivo = $archivo['tipo_archivo'];
    $tamaño = filesize($ruta_archivo);
    
    // Limpiar cualquier output previo
    if (ob_get_level()) {
        ob_end_clean();
    }
    
    // Headers para descarga
    header('Content-Type: ' . $tipo_archivo);
    header('Content-Disposition: attachment; filename="' . $nombre_original . '"');
    header('Content-Length: ' . $tamaño);
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Enviar el archivo
    readfile($ruta_archivo);
    exit;
    
} catch (Exception $e) {
    http_response_code(500);
    echo 'Error del servidor: ' . $e->getMessage();
    exit;
}
?>