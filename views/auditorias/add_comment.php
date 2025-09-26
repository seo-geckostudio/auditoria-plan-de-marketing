<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

$paso_id = $input['paso_id'] ?? null;
$comentario = trim($input['comentario'] ?? '');

if (!$paso_id || !$comentario) {
    echo json_encode(['success' => false, 'message' => 'Paso ID y comentario son requeridos']);
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
    
    // Insertar el comentario
    $stmt = $pdo->prepare("
        INSERT INTO comentarios (auditoria_paso_id, usuario_id, comentario, fecha_creacion)
        VALUES (?, ?, ?, ?)
    ");
    
    // Por ahora usamos usuario_id = 1, en una implementación real sería el usuario logueado
    $usuario_id = 1;
    $fecha_creacion = date('Y-m-d H:i:s');
    
    $result = $stmt->execute([$paso_id, $usuario_id, $comentario, $fecha_creacion]);
    
    if ($result) {
        $comment_id = $pdo->lastInsertId();
        
        // Obtener el comentario recién creado con información del usuario
        $stmt = $pdo->prepare("
            SELECT c.*, u.nombre as usuario_nombre
            FROM comentarios c
            LEFT JOIN usuarios u ON c.usuario_id = u.id
            WHERE c.id = ?
        ");
        $stmt->execute([$comment_id]);
        $nuevo_comentario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'message' => 'Comentario agregado correctamente',
            'data' => $nuevo_comentario
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar el comentario']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
?>