<?php
require_once '../../config/database.php';
require_once '../../config/auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

if (!isset($_POST['paso_id']) || !isset($_FILES['archivo'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan parámetros requeridos']);
    exit;
}

$paso_id = intval($_POST['paso_id']);
$mapping = isset($_POST['mapping']) ? json_decode($_POST['mapping'], true) : [];

// Verificar que el paso existe
$stmt = $pdo->prepare("SELECT id, nombre FROM pasos_auditoria WHERE id = ?");
$stmt->execute([$paso_id]);
$paso = $stmt->fetch();

if (!$paso) {
    http_response_code(404);
    echo json_encode(['error' => 'Paso no encontrado']);
    exit;
}

$archivo = $_FILES['archivo'];
$extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

try {
    $datos_procesados = [];
    
    switch ($extension) {
        case 'json':
            $contenido = file_get_contents($archivo['tmp_name']);
            $datos_json = json_decode($contenido, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Archivo JSON inválido: ' . json_last_error_msg());
            }
            
            $datos_procesados = aplicarMapeo($datos_json, $mapping);
            break;
            
        case 'csv':
            $datos_procesados = procesarCSV($archivo['tmp_name'], $mapping);
            break;
            
        case 'xlsx':
        case 'xls':
            $datos_procesados = procesarExcel($archivo['tmp_name'], $mapping);
            break;
            
        default:
            throw new Exception('Formato de archivo no soportado');
    }
    
    // Validar estructura JSON resultante
    $validacion = validarEstructuraJSON($datos_procesados);
    if (!$validacion['valido']) {
        echo json_encode([
            'success' => false,
            'error' => 'Datos no válidos',
            'detalles' => $validacion['errores'],
            'datos_procesados' => $datos_procesados
        ]);
        exit;
    }
    
    // Guardar datos en la base de datos
    $stmt = $pdo->prepare("UPDATE pasos_auditoria SET datos_completados = ?, fecha_actualizacion = NOW() WHERE id = ?");
    $stmt->execute([json_encode($datos_procesados), $paso_id]);
    
    // Actualizar progreso de la auditoría
    actualizarProgresoAuditoria($paso_id, $pdo);
    
    echo json_encode([
        'success' => true,
        'message' => 'Archivo procesado correctamente',
        'datos_procesados' => $datos_procesados,
        'total_registros' => count($datos_procesados)
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

function procesarCSV($archivo, $mapping) {
    $datos = [];
    $handle = fopen($archivo, 'r');
    
    if ($handle === false) {
        throw new Exception('No se pudo abrir el archivo CSV');
    }
    
    $headers = fgetcsv($handle);
    if ($headers === false) {
        throw new Exception('Archivo CSV vacío o inválido');
    }
    
    while (($row = fgetcsv($handle)) !== false) {
        $registro = [];
        foreach ($headers as $index => $header) {
            $valor = isset($row[$index]) ? $row[$index] : '';
            
            // Aplicar mapeo si existe
            if (isset($mapping[$header])) {
                $campo_destino = $mapping[$header];
                $registro[$campo_destino] = $valor;
            } else {
                $registro[$header] = $valor;
            }
        }
        $datos[] = $registro;
    }
    
    fclose($handle);
    return $datos;
}

function procesarExcel($archivo, $mapping) {
    // Simulación de procesamiento de Excel
    // En un entorno real, usarías PhpSpreadsheet
    throw new Exception('Procesamiento de Excel no implementado. Use CSV como alternativa.');
}

function aplicarMapeo($datos, $mapping) {
    if (empty($mapping)) {
        return $datos;
    }
    
    $datos_mapeados = [];
    
    if (is_array($datos) && isset($datos[0])) {
        // Array de objetos
        foreach ($datos as $registro) {
            $registro_mapeado = [];
            foreach ($registro as $campo => $valor) {
                $campo_destino = isset($mapping[$campo]) ? $mapping[$campo] : $campo;
                $registro_mapeado[$campo_destino] = $valor;
            }
            $datos_mapeados[] = $registro_mapeado;
        }
    } else {
        // Objeto único
        foreach ($datos as $campo => $valor) {
            $campo_destino = isset($mapping[$campo]) ? $mapping[$campo] : $campo;
            $datos_mapeados[$campo_destino] = $valor;
        }
    }
    
    return $datos_mapeados;
}

function validarEstructuraJSON($datos) {
    $errores = [];
    
    // Validaciones básicas
    if (empty($datos)) {
        $errores[] = 'Los datos no pueden estar vacíos';
    }
    
    if (is_array($datos)) {
        foreach ($datos as $index => $registro) {
            if (!is_array($registro)) {
                $errores[] = "El registro en la posición $index debe ser un objeto";
            }
        }
    }
    
    // Aquí puedes agregar más validaciones específicas según tus necesidades
    
    return [
        'valido' => empty($errores),
        'errores' => $errores
    ];
}

function actualizarProgresoAuditoria($paso_id, $pdo) {
    // Obtener la auditoría del paso
    $stmt = $pdo->prepare("
        SELECT a.id 
        FROM auditorias a 
        JOIN pasos_auditoria pa ON a.id = pa.auditoria_id 
        WHERE pa.id = ?
    ");
    $stmt->execute([$paso_id]);
    $auditoria = $stmt->fetch();
    
    if ($auditoria) {
        // Calcular progreso
        $stmt = $pdo->prepare("
            SELECT 
                COUNT(*) as total_pasos,
                SUM(CASE WHEN datos_completados IS NOT NULL AND datos_completados != '' THEN 1 ELSE 0 END) as pasos_completados
            FROM pasos_auditoria 
            WHERE auditoria_id = ?
        ");
        $stmt->execute([$auditoria['id']]);
        $progreso = $stmt->fetch();
        
        $porcentaje = $progreso['total_pasos'] > 0 ? 
            round(($progreso['pasos_completados'] / $progreso['total_pasos']) * 100, 2) : 0;
        
        // Actualizar auditoría
        $stmt = $pdo->prepare("UPDATE auditorias SET porcentaje_completado = ? WHERE id = ?");
        $stmt->execute([$porcentaje, $auditoria['id']]);
    }
}
?>