<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$paso_id = $_POST['paso_id'] ?? null;

if (!$paso_id) {
    echo json_encode(['success' => false, 'message' => 'Paso ID requerido']);
    exit;
}

if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Error al subir el archivo']);
    exit;
}

try {
    $pdo = obtenerConexion();
    
    // Verificar que el paso existe
    $stmt = $pdo->prepare("SELECT id FROM auditoria_pasos WHERE id = ?");
    $stmt->execute([$paso_id]);
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Paso no encontrado']);
        exit;
    }
    
    $archivo = $_FILES['archivo'];
    $nombre_original = $archivo['name'];
    $tipo_archivo = $archivo['type'];
    $tamaño = $archivo['size'];
    $archivo_temporal = $archivo['tmp_name'];
    
    // Validar tipo de archivo (permitir la mayoría de tipos comunes)
    $tipos_permitidos = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/plain',
        'text/csv',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'application/zip',
        'application/x-zip-compressed'
    ];
    
    // También permitir por extensión
    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
    $extensiones_permitidas = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'csv', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'zip'];
    
    if (!in_array($tipo_archivo, $tipos_permitidos) && !in_array($extension, $extensiones_permitidas)) {
        echo json_encode(['success' => false, 'message' => 'Tipo de archivo no permitido']);
        exit;
    }
    
    // Validar tamaño (máximo 10MB)
    if ($tamaño > 10 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'El archivo es demasiado grande (máximo 10MB)']);
        exit;
    }
    
    // Crear directorio de uploads si no existe
    $upload_dir = '../../uploads/audit_files/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Generar nombre único para el archivo
    $nombre_archivo = uniqid() . '_' . time() . '.' . $extension;
    $ruta_archivo = $upload_dir . $nombre_archivo;
    
    // Mover el archivo
    if (!move_uploaded_file($archivo_temporal, $ruta_archivo)) {
        echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo']);
        exit;
    }
    
    // Guardar información en la base de datos
    $stmt = $pdo->prepare("
        INSERT INTO archivos (auditoria_paso_id, usuario_id, nombre_original, nombre_archivo, ruta_archivo, tipo_archivo, tamaño, fecha_subida)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    // Por ahora usamos usuario_id = 1, en una implementación real sería el usuario logueado
    $usuario_id = 1;
    $fecha_subida = date('Y-m-d H:i:s');
    
    $result = $stmt->execute([
        $paso_id,
        $usuario_id,
        $nombre_original,
        $nombre_archivo,
        $ruta_archivo,
        $tipo_archivo,
        $tamaño,
        $fecha_subida
    ]);
    
    if ($result) {
        $archivo_id = $pdo->lastInsertId();
        
        // Obtener información del archivo recién subido
        $stmt = $pdo->prepare("
            SELECT a.*, u.nombre as usuario_nombre
            FROM archivos a
            LEFT JOIN usuarios u ON a.usuario_id = u.id
            WHERE a.id = ?
        ");
        $stmt->execute([$archivo_id]);
        $archivo_info = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'message' => 'Archivo subido correctamente',
            'data' => $archivo_info
        ]);
    } else {
        // Si falla la inserción en BD, eliminar el archivo
        unlink($ruta_archivo);
        echo json_encode(['success' => false, 'message' => 'Error al guardar la información del archivo']);
    }
    
} catch (Exception $e) {
    // Si hay error, intentar eliminar el archivo si se creó
    if (isset($ruta_archivo) && file_exists($ruta_archivo)) {
        unlink($ruta_archivo);
    }
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
?>