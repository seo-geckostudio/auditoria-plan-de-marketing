<?php
require_once '../../config/database.php';
require_once '../../config/auth.php';

header('Content-Type: application/json');

$accion = $_GET['accion'] ?? $_POST['accion'] ?? '';

switch ($accion) {
    case 'listar':
        listarPlantillas();
        break;
    case 'guardar':
        guardarPlantilla();
        break;
    case 'obtener':
        obtenerPlantilla();
        break;
    case 'eliminar':
        eliminarPlantilla();
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no válida']);
}

function listarPlantillas() {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            SELECT id, nombre, descripcion, tipo_archivo, fecha_creacion, usuario_id
            FROM plantillas_importacion 
            ORDER BY fecha_creacion DESC
        ");
        $stmt->execute();
        $plantillas = $stmt->fetchAll();
        
        echo json_encode([
            'success' => true,
            'plantillas' => $plantillas
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function guardarPlantilla() {
    global $pdo;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        return;
    }
    
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $tipo_archivo = $_POST['tipo_archivo'] ?? '';
    $mapeo = $_POST['mapeo'] ?? '';
    $estructura_esperada = $_POST['estructura_esperada'] ?? '';
    
    if (empty($nombre) || empty($tipo_archivo) || empty($mapeo)) {
        http_response_code(400);
        echo json_encode(['error' => 'Faltan campos requeridos']);
        return;
    }
    
    try {
        // Validar que el mapeo sea JSON válido
        $mapeo_array = json_decode($mapeo, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('El mapeo debe ser un JSON válido');
        }
        
        $stmt = $pdo->prepare("
            INSERT INTO plantillas_importacion 
            (nombre, descripcion, tipo_archivo, mapeo, estructura_esperada, usuario_id, fecha_creacion) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $usuario_id = $_SESSION['usuario_id'] ?? 1; // Usar sesión real
        
        $stmt->execute([
            $nombre,
            $descripcion,
            $tipo_archivo,
            $mapeo,
            $estructura_esperada,
            $usuario_id
        ]);
        
        $plantilla_id = $pdo->lastInsertId();
        
        echo json_encode([
            'success' => true,
            'message' => 'Plantilla guardada correctamente',
            'plantilla_id' => $plantilla_id
        ]);
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function obtenerPlantilla() {
    global $pdo;
    
    $id = $_GET['id'] ?? '';
    
    if (empty($id)) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de plantilla requerido']);
        return;
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT * FROM plantillas_importacion WHERE id = ?
        ");
        $stmt->execute([$id]);
        $plantilla = $stmt->fetch();
        
        if (!$plantilla) {
            http_response_code(404);
            echo json_encode(['error' => 'Plantilla no encontrada']);
            return;
        }
        
        echo json_encode([
            'success' => true,
            'plantilla' => $plantilla
        ]);
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function eliminarPlantilla() {
    global $pdo;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        return;
    }
    
    $id = $_POST['id'] ?? '';
    
    if (empty($id)) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de plantilla requerido']);
        return;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM plantillas_importacion WHERE id = ?");
        $stmt->execute([$id]);
        
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Plantilla no encontrada']);
            return;
        }
        
        echo json_encode([
            'success' => true,
            'message' => 'Plantilla eliminada correctamente'
        ]);
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// Crear tabla si no existe
function crearTablaPlantillas() {
    global $pdo;
    
    $sql = "
    CREATE TABLE IF NOT EXISTS plantillas_importacion (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        descripcion TEXT,
        tipo_archivo ENUM('json', 'csv', 'excel') NOT NULL,
        mapeo JSON NOT NULL,
        estructura_esperada JSON,
        usuario_id INT,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_usuario (usuario_id),
        INDEX idx_tipo (tipo_archivo)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    
    try {
        $pdo->exec($sql);
    } catch (Exception $e) {
        error_log("Error creando tabla plantillas_importacion: " . $e->getMessage());
    }
}

// Ejecutar creación de tabla
crearTablaPlantillas();
?>