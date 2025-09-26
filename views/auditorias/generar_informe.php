<?php
require_once '../../config/database.php';
require_once '../../config/auth.php';

$auditoria_id = $_GET['id'] ?? 0;

if (!$auditoria_id) {
    header('Location: ?modulo=auditorias&accion=listar');
    exit;
}

// Obtener datos de la auditoría
$stmt = $pdo->prepare("
    SELECT a.*, c.nombre as cliente_nombre, u.nombre as usuario_nombre
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    WHERE a.id = ?
");
$stmt->execute([$auditoria_id]);
$auditoria = $stmt->fetch();

if (!$auditoria) {
    header('Location: ?modulo=auditorias&accion=listar');
    exit;
}

// Obtener pasos con datos
$stmt = $pdo->prepare("
    SELECT pa.*, f.nombre as fase_nombre, f.orden as fase_orden
    FROM pasos_auditoria pa
    JOIN fases f ON pa.fase_id = f.id
    WHERE pa.auditoria_id = ?
    ORDER BY f.orden, pa.orden
");
$stmt->execute([$auditoria_id]);
$pasos = $stmt->fetchAll();

// Obtener archivos
$stmt = $pdo->prepare("
    SELECT af.*, pa.nombre as paso_nombre, f.nombre as fase_nombre
    FROM archivos_pasos af
    JOIN pasos_auditoria pa ON af.paso_id = pa.id
    JOIN fases f ON pa.fase_id = f.id
    WHERE pa.auditoria_id = ?
    ORDER BY f.orden, pa.orden, af.fecha_subida
");
$stmt->execute([$auditoria_id]);
$archivos = $stmt->fetchAll();

// Obtener comentarios
$stmt = $pdo->prepare("
    SELECT c.*, pa.nombre as paso_nombre, f.nombre as fase_nombre, u.nombre as usuario_nombre
    FROM comentarios_pasos c
    JOIN pasos_auditoria pa ON c.paso_id = pa.id
    JOIN fases f ON pa.fase_id = f.id
    LEFT JOIN usuarios u ON c.usuario_id = u.id
    WHERE pa.auditoria_id = ?
    ORDER BY f.orden, pa.orden, c.fecha_creacion
");
$stmt->execute([$auditoria_id]);
$comentarios = $stmt->fetchAll();

// Agrupar datos por fases
$fases_data = [];
foreach ($pasos as $paso) {
    $fase_id = $paso['fase_id'];
    if (!isset($fases_data[$fase_id])) {
        $fases_data[$fase_id] = [
            'nombre' => $paso['fase_nombre'],
            'orden' => $paso['fase_orden'],
            'pasos' => [],
            'archivos' => [],
            'comentarios' => []
        ];
    }
    $fases_data[$fase_id]['pasos'][] = $paso;
}

foreach ($archivos as $archivo) {
    $fase_nombre = $archivo['fase_nombre'];
    foreach ($fases_data as &$fase) {
        if ($fase['nombre'] === $fase_nombre) {
            $fase['archivos'][] = $archivo;
            break;
        }
    }
}

foreach ($comentarios as $comentario) {
    $fase_nombre = $comentario['fase_nombre'];
    foreach ($fases_data as &$fase) {
        if ($fase['nombre'] === $fase_nombre) {
            $fase['comentarios'][] = $comentario;
            break;
        }
    }
}

// Ordenar fases por orden
uasort($fases_data, function($a, $b) {
    return $a['orden'] - $b['orden'];
});

// Función para generar ZIP con archivos
function generarZipArchivos($auditoria_id, $archivos) {
    $zip_filename = "auditoria_{$auditoria_id}_archivos_" . date('Y-m-d_H-i-s') . ".zip";
    $zip_path = "../../uploads/informes/" . $zip_filename;
    
    // Crear directorio si no existe
    if (!file_exists(dirname($zip_path))) {
        mkdir(dirname($zip_path), 0755, true);
    }
    
    $zip = new ZipArchive();
    if ($zip->open($zip_path, ZipArchive::CREATE) !== TRUE) {
        return false;
    }
    
    foreach ($archivos as $archivo) {
        $archivo_path = "../../uploads/" . $archivo['ruta_archivo'];
        if (file_exists($archivo_path)) {
            $nombre_en_zip = $archivo['fase_nombre'] . "/" . $archivo['paso_nombre'] . "/" . $archivo['nombre_original'];
            $zip->addFile($archivo_path, $nombre_en_zip);
        }
    }
    
    $zip->close();
    return $zip_filename;
}

// Procesar descarga de ZIP si se solicita
if (isset($_GET['descargar_zip'])) {
    $zip_filename = generarZipArchivos($auditoria_id, $archivos);
    if ($zip_filename) {
        $zip_path = "../../uploads/informes/" . $zip_filename;
        
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zip_filename . '"');
        header('Content-Length: ' . filesize($zip_path));
        
        readfile($zip_path);
        unlink($zip_path); // Eliminar archivo temporal
        exit;
    }
}

// Procesar generación de PDF si se solicita
if (isset($_GET['generar_pdf'])) {
    // Aquí implementarías la generación de PDF
    // Por ahora, redirigimos con un mensaje
    $mensaje = "Funcionalidad de PDF en desarrollo";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Final - <?= htmlspecialchars($auditoria['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .informe-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        
        .fase-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #007bff;
        }
        
        .paso-item {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e9ecef;
        }
        
        .status-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
        
        .archivo-item {
            background: #e3f2fd;
            border-radius: 5px;
            padding: 0.5rem;
            margin: 0.25rem 0;
            display: flex;
            align-items: center;
            justify-content: between;
        }
        
        .comentario-item {
            background: #fff3e0;
            border-radius: 5px;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border-left: 3px solid #ff9800;
        }
        
        @media print {
            .no-print { display: none !important; }
            .informe-header { background: #667eea !important; }
        }
    </style>
</head>
<body>
    <div class="informe-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-file-alt me-2"></i>Informe Final de Auditoría</h1>
                    <h3><?= htmlspecialchars($auditoria['nombre']) ?></h3>
                    <p class="mb-0">Cliente: <?= htmlspecialchars($auditoria['cliente_nombre'] ?? 'No asignado') ?></p>
                </div>
                <div class="col-md-4 text-end no-print">
                    <div class="btn-group-vertical">
                        <a href="?modulo=auditorias&accion=generar_informe&id=<?= $auditoria_id ?>&descargar_zip=1" 
                           class="btn btn-light mb-2">
                            <i class="fas fa-download me-2"></i>Descargar Archivos (ZIP)
                        </a>
                        <button onclick="window.print()" class="btn btn-light mb-2">
                            <i class="fas fa-print me-2"></i>Imprimir Informe
                        </button>
                        <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria_id ?>" class="btn btn-outline-light">
                            <i class="fas fa-arrow-left me-2"></i>Volver a Auditoría
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Resumen General -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h3 class="text-primary"><?= count($pasos) ?></h3>
                    <p class="mb-0">Total Pasos</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h3 class="text-success"><?= count(array_filter($pasos, function($p) { return $p['estado'] === 'completado'; })) ?></h3>
                    <p class="mb-0">Completados</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h3 class="text-info"><?= count($archivos) ?></h3>
                    <p class="mb-0">Archivos</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h3 class="text-warning"><?= count($comentarios) ?></h3>
                    <p class="mb-0">Comentarios</p>
                </div>
            </div>
        </div>

        <!-- Información General -->
        <div class="stats-card mb-4">
            <h4><i class="fas fa-info-circle me-2"></i>Información General</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>URL Principal:</strong> 
                        <a href="<?= htmlspecialchars($auditoria['url_principal']) ?>" target="_blank">
                            <?= htmlspecialchars($auditoria['url_principal']) ?>
                        </a>
                    </p>
                    <p><strong>Fecha de Inicio:</strong> <?= date('d/m/Y', strtotime($auditoria['fecha_inicio'])) ?></p>
                    <p><strong>Fecha Estimada de Fin:</strong> <?= date('d/m/Y', strtotime($auditoria['fecha_fin_estimada'])) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Estado:</strong> 
                        <span class="badge bg-<?= $auditoria['estado'] === 'completada' ? 'success' : ($auditoria['estado'] === 'en_progreso' ? 'warning' : 'secondary') ?>">
                            <?= ucfirst($auditoria['estado']) ?>
                        </span>
                    </p>
                    <p><strong>Progreso:</strong> <?= $auditoria['porcentaje_completado'] ?>%</p>
                    <p><strong>Auditor:</strong> <?= htmlspecialchars($auditoria['usuario_nombre'] ?? 'No asignado') ?></p>
                </div>
            </div>
            <?php if ($auditoria['descripcion']): ?>
                <p><strong>Descripción:</strong></p>
                <p><?= nl2br(htmlspecialchars($auditoria['descripcion'])) ?></p>
            <?php endif; ?>
        </div>

        <!-- Detalles por Fases -->
        <?php foreach ($fases_data as $fase): ?>
            <div class="fase-section">
                <h4><i class="fas fa-layer-group me-2"></i><?= htmlspecialchars($fase['nombre']) ?></h4>
                
                <!-- Pasos de la fase -->
                <h5 class="mt-3 mb-2">Pasos Realizados</h5>
                <?php foreach ($fase['pasos'] as $paso): ?>
                    <div class="paso-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h6><?= htmlspecialchars($paso['nombre']) ?></h6>
                                <?php if ($paso['descripcion']): ?>
                                    <p class="text-muted mb-2"><?= htmlspecialchars($paso['descripcion']) ?></p>
                                <?php endif; ?>
                                
                                <?php if ($paso['datos_completados']): ?>
                                    <div class="mt-2">
                                        <strong>Datos Capturados:</strong>
                                        <pre class="bg-light p-2 mt-1" style="font-size: 0.8rem; max-height: 200px; overflow-y: auto;">
<?= htmlspecialchars(json_encode(json_decode($paso['datos_completados']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) ?>
                                        </pre>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($paso['notas']): ?>
                                    <div class="mt-2">
                                        <strong>Notas:</strong>
                                        <p><?= nl2br(htmlspecialchars($paso['notas'])) ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ms-3">
                                <span class="badge status-badge bg-<?= $paso['estado'] === 'completado' ? 'success' : ($paso['estado'] === 'en_progreso' ? 'warning' : 'secondary') ?>">
                                    <?= ucfirst($paso['estado']) ?>
                                </span>
                                <?php if ($paso['tiempo_real']): ?>
                                    <div class="text-muted small mt-1">
                                        Tiempo: <?= $paso['tiempo_real'] ?>h
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Archivos de la fase -->
                <?php if (!empty($fase['archivos'])): ?>
                    <h5 class="mt-3 mb-2">Archivos Adjuntos</h5>
                    <div class="row">
                        <?php foreach ($fase['archivos'] as $archivo): ?>
                            <div class="col-md-6">
                                <div class="archivo-item">
                                    <div class="flex-grow-1">
                                        <i class="fas fa-file me-2"></i>
                                        <strong><?= htmlspecialchars($archivo['nombre_original']) ?></strong>
                                        <div class="small text-muted">
                                            Paso: <?= htmlspecialchars($archivo['paso_nombre']) ?> | 
                                            <?= date('d/m/Y H:i', strtotime($archivo['fecha_subida'])) ?>
                                        </div>
                                    </div>
                                    <div class="no-print">
                                        <a href="download.php?id=<?= $archivo['id'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Comentarios de la fase -->
                <?php if (!empty($fase['comentarios'])): ?>
                    <h5 class="mt-3 mb-2">Comentarios y Observaciones</h5>
                    <?php foreach ($fase['comentarios'] as $comentario): ?>
                        <div class="comentario-item">
                            <div class="d-flex justify-content-between">
                                <strong><?= htmlspecialchars($comentario['usuario_nombre'] ?? 'Usuario') ?></strong>
                                <small class="text-muted"><?= date('d/m/Y H:i', strtotime($comentario['fecha_creacion'])) ?></small>
                            </div>
                            <p class="mb-1"><?= nl2br(htmlspecialchars($comentario['comentario'])) ?></p>
                            <small class="text-muted">Paso: <?= htmlspecialchars($comentario['paso_nombre']) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Pie del informe -->
        <div class="stats-card text-center">
            <p class="mb-0">
                <strong>Informe generado el <?= date('d/m/Y H:i') ?></strong><br>
                Sistema de Gestión de Auditorías SEO
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>