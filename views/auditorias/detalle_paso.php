<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

$pdo = obtenerConexion();
$paso_id = $_GET['id'] ?? null;

if (!$paso_id) {
    header('Location: gestionar.php');
    exit;
}

// Obtener información completa del paso
$stmt = $pdo->prepare("
    SELECT 
        ap.*,
        pp.nombre as paso_nombre,
        pp.descripcion,
        pp.tiempo_estimado_horas,
        pp.datos_requeridos,
        f.nombre as fase_nombre,
        f.numero_fase,
        a.titulo as auditoria_titulo,
        a.id as auditoria_id,
        c.nombre_empresa,
        u.nombre as usuario_asignado_nombre
    FROM auditoria_pasos ap
    JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
    JOIN fases f ON pp.fase_id = f.id
    JOIN auditorias a ON ap.auditoria_id = a.id
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON ap.usuario_asignado_id = u.id
    WHERE ap.id = ?
");
$stmt->execute([$paso_id]);
$paso = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paso) {
    header('Location: gestionar.php');
    exit;
}

// Obtener comentarios del paso
$stmt = $pdo->prepare("
    SELECT c.*, u.nombre as usuario_nombre
    FROM comentarios c
    LEFT JOIN usuarios u ON c.usuario_id = u.id
    WHERE c.auditoria_paso_id = ?
    ORDER BY c.fecha_creacion DESC
");
$stmt->execute([$paso_id]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener archivos del paso
$stmt = $pdo->prepare("
    SELECT a.*, u.nombre as usuario_nombre
    FROM archivos a
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    WHERE a.auditoria_paso_id = ?
    ORDER BY a.fecha_subida DESC
");
$stmt->execute([$paso_id]);
$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Decodificar datos completados
$datos_completados = [];
if ($paso['datos_completados']) {
    $datos_completados = json_decode($paso['datos_completados'], true) ?? [];
}

// Decodificar datos requeridos
$datos_requeridos = [];
if ($paso['datos_requeridos']) {
    $datos_requeridos = json_decode($paso['datos_requeridos'], true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Paso - <?= htmlspecialchars($paso['paso_nombre']) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .breadcrumb {
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .breadcrumb a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .main-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completado { background: #d4edda; color: #155724; }
        .status-en_progreso { background: #fff3cd; color: #856404; }
        .status-pendiente { background: #f8d7da; color: #721c24; }
        .status-bloqueado { background: #e2e3e5; color: #383d41; }
        .status-omitido { background: #d1ecf1; color: #0c5460; }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
        }

        .info-label {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary { background: #667eea; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .data-viewer {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            max-height: 300px;
            overflow-y: auto;
        }

        .comment-item {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 8px 8px 0;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .comment-content {
            color: #333;
            line-height: 1.5;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-icon {
            font-size: 1.5rem;
        }

        .progress-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .progress-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .json-editor {
            background: #2d3748;
            color: #e2e8f0;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            min-height: 200px;
            resize: vertical;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 15px;
            }
            
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="breadcrumb">
                <a href="gestionar.php">Auditorías</a> → 
                <a href="gestionar_pasos.php?id=<?= $paso['auditoria_id'] ?>">Pasos</a> → 
                Detalle
            </div>
            <h1>📋 <?= htmlspecialchars($paso['paso_nombre']) ?></h1>
            <p><strong>Auditoría:</strong> <?= htmlspecialchars($paso['auditoria_titulo']) ?> | 
               <strong>Fase <?= $paso['numero_fase'] ?>:</strong> <?= htmlspecialchars($paso['fase_nombre']) ?></p>
        </div>

        <div class="main-content">
            <!-- Columna izquierda -->
            <div class="left-column">
                <!-- Información del paso -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">📊 Información del Paso</h2>
                        <div class="status-badge status-<?= $paso['estado'] ?>">
                            <?= ucfirst(str_replace('_', ' ', $paso['estado'])) ?>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Tiempo Estimado</div>
                            <div class="info-value"><?= $paso['tiempo_estimado_horas'] ?>h</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tiempo Real</div>
                            <div class="info-value"><?= $paso['tiempo_real_horas'] ?? '0' ?>h</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Asignado a</div>
                            <div class="info-value"><?= htmlspecialchars($paso['usuario_asignado_nombre'] ?? 'Sin asignar') ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Fecha Inicio</div>
                            <div class="info-value">
                                <?= $paso['fecha_inicio'] ? date('d/m/Y H:i', strtotime($paso['fecha_inicio'])) : 'No iniciado' ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Fecha Completado</div>
                            <div class="info-value">
                                <?= $paso['fecha_completado'] ? date('d/m/Y H:i', strtotime($paso['fecha_completado'])) : 'No completado' ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Comentarios</div>
                            <div class="info-value"><?= count($comentarios) ?></div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>📝 Descripción</h3>
                        <div class="data-viewer">
                            <?= nl2br(htmlspecialchars($paso['descripcion'])) ?>
                        </div>
                    </div>

                    <?php if ($paso['notas']): ?>
                    <div class="form-section">
                        <h3>📋 Notas</h3>
                        <div class="data-viewer">
                            <?= nl2br(htmlspecialchars($paso['notas'])) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sección Educativa -->
                <?php
                // Cargar configuración educativa
                $config_educativa = null;
                $educativa_file = '../../config/secciones_educativas_seo.json';
                if (file_exists($educativa_file)) {
                    $educativa_data = json_decode(file_get_contents($educativa_file), true);

                    // Determinar qué sección educativa mostrar según el nombre del paso
                    $paso_nombre_lower = strtolower($paso['paso_nombre']);

                    if (strpos($paso_nombre_lower, 'url') !== false || strpos($paso_nombre_lower, 'arquitectura') !== false) {
                        $config_educativa = $educativa_data['arquitectura_urls'] ?? null;
                    } elseif (strpos($paso_nombre_lower, 'h1') !== false || strpos($paso_nombre_lower, 'encabezado') !== false) {
                        $config_educativa = $educativa_data['encabezados_h1'] ?? null;
                    } elseif (strpos($paso_nombre_lower, 'meta') !== false || strpos($paso_nombre_lower, 'title') !== false || strpos($paso_nombre_lower, 'description') !== false) {
                        $config_educativa = $educativa_data['meta_tags'] ?? null;
                    } elseif (strpos($paso_nombre_lower, 'imagen') !== false || strpos($paso_nombre_lower, 'alt') !== false) {
                        $config_educativa = $educativa_data['imagenes_alt'] ?? null;
                    } elseif (strpos($paso_nombre_lower, 'keyword') !== false || strpos($paso_nombre_lower, 'palabra') !== false) {
                        $config_educativa = $educativa_data['keywords_oportunidad'] ?? null;
                    }
                }

                if ($config_educativa):
                ?>
                <div class="card seccion-educativa">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h2 class="card-title" style="color: white; display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.8rem;"><?= $config_educativa['icono'] ?></span>
                            <?= htmlspecialchars($config_educativa['nombre']) ?>
                        </h2>
                    </div>

                    <!-- Concepto y Analogía -->
                    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                        <h3 style="color: white; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <span>🎓</span> <?= htmlspecialchars($config_educativa['concepto']) ?>
                        </h3>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(255,255,255,0.95);">
                            <?= htmlspecialchars($config_educativa['analogia']) ?>
                        </p>
                    </div>

                    <!-- Beneficios y Riesgos -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                        <!-- Beneficios -->
                        <div style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); padding: 20px; border-radius: 12px;">
                            <h3 style="color: #0f766e; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                <span>✅</span> Beneficios de Implementar
                            </h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php foreach ($config_educativa['beneficios'] as $beneficio): ?>
                                <li style="padding: 8px 0; color: #0f766e; font-weight: 500; line-height: 1.6;">
                                    <?= htmlspecialchars($beneficio) ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Riesgos -->
                        <div style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); padding: 20px; border-radius: 12px;">
                            <h3 style="color: #9a3412; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                <span>⚠️</span> Riesgos de NO Implementar
                            </h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php foreach ($config_educativa['riesgos'] as $riesgo): ?>
                                <li style="padding: 8px 0; color: #9a3412; font-weight: 500; line-height: 1.6;">
                                    <?= htmlspecialchars($riesgo) ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Comparativa ANTES / DESPUÉS -->
                    <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                        <h3 style="text-align: center; margin-bottom: 30px; color: #2c3e50; font-size: 1.5rem;">
                            📊 Comparativa: Situación ANTES vs DESPUÉS
                        </h3>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                            <!-- ANTES -->
                            <div style="background: white; border: 3px solid #ef4444; border-radius: 12px; padding: 20px;">
                                <div style="background: #ef4444; color: white; padding: 12px; border-radius: 8px 8px 0 0; margin: -20px -20px 20px -20px; text-align: center; font-weight: bold; font-size: 1.2rem;">
                                    ❌ <?= htmlspecialchars($config_educativa['antes']['titulo']) ?>
                                </div>

                                <?php foreach ($config_educativa['antes']['ejemplos'] as $ejemplo): ?>
                                <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin-bottom: 15px; border-radius: 0 8px 8px 0;">
                                    <?php if (isset($ejemplo['url'])): ?>
                                        <div style="font-family: monospace; color: #dc2626; font-size: 0.85rem; word-break: break-all; margin-bottom: 8px;">
                                            <?= htmlspecialchars($ejemplo['url']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($ejemplo['codigo'])): ?>
                                        <pre style="background: #2d3748; color: #e2e8f0; padding: 10px; border-radius: 6px; font-size: 0.85rem; overflow-x: auto; margin-bottom: 8px;"><code><?= htmlspecialchars($ejemplo['codigo']) ?></code></pre>
                                    <?php endif; ?>
                                    <div style="color: #b91c1c; font-weight: 600; margin-bottom: 5px;">
                                        <?= htmlspecialchars($ejemplo['problema'] ?? '') ?>
                                    </div>
                                    <div style="color: #991b1b; font-size: 0.9rem;">
                                        <strong>Impacto:</strong> <?= htmlspecialchars($ejemplo['impacto']) ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                                <?php if (isset($config_educativa['antes']['metricas'])): ?>
                                <div style="background: #fee2e2; padding: 15px; border-radius: 8px; margin-top: 15px;">
                                    <h4 style="color: #991b1b; margin-bottom: 10px; font-size: 0.95rem;">📉 Métricas Actuales:</h4>
                                    <div style="display: grid; grid-template-columns: 1fr; gap: 8px;">
                                        <?php foreach ($config_educativa['antes']['metricas'] as $key => $value): ?>
                                        <div style="display: flex; justify-content: space-between; color: #7f1d1d; font-size: 0.9rem;">
                                            <span><?= ucfirst(str_replace('_', ' ', $key)) ?>:</span>
                                            <strong><?= htmlspecialchars($value) ?></strong>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- DESPUÉS -->
                            <div style="background: white; border: 3px solid #22c55e; border-radius: 12px; padding: 20px;">
                                <div style="background: #22c55e; color: white; padding: 12px; border-radius: 8px 8px 0 0; margin: -20px -20px 20px -20px; text-align: center; font-weight: bold; font-size: 1.2rem;">
                                    ✅ <?= htmlspecialchars($config_educativa['despues']['titulo']) ?>
                                </div>

                                <?php foreach ($config_educativa['despues']['ejemplos'] as $ejemplo): ?>
                                <div style="background: #f0fdf4; border-left: 4px solid #22c55e; padding: 15px; margin-bottom: 15px; border-radius: 0 8px 8px 0;">
                                    <?php if (isset($ejemplo['url'])): ?>
                                        <div style="font-family: monospace; color: #16a34a; font-size: 0.85rem; word-break: break-all; margin-bottom: 8px;">
                                            <?= htmlspecialchars($ejemplo['url']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($ejemplo['codigo'])): ?>
                                        <pre style="background: #2d3748; color: #e2e8f0; padding: 10px; border-radius: 6px; font-size: 0.85rem; overflow-x: auto; margin-bottom: 8px;"><code><?= htmlspecialchars($ejemplo['codigo']) ?></code></pre>
                                    <?php endif; ?>
                                    <div style="color: #15803d; font-weight: 600; margin-bottom: 5px;">
                                        <?= htmlspecialchars($ejemplo['mejora'] ?? '') ?>
                                    </div>
                                    <div style="color: #166534; font-size: 0.9rem;">
                                        <strong>Impacto:</strong> <?= htmlspecialchars($ejemplo['impacto']) ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                                <?php if (isset($config_educativa['despues']['metricas'])): ?>
                                <div style="background: #dcfce7; padding: 15px; border-radius: 8px; margin-top: 15px;">
                                    <h4 style="color: #166534; margin-bottom: 10px; font-size: 0.95rem;">📈 Métricas Proyectadas:</h4>
                                    <div style="display: grid; grid-template-columns: 1fr; gap: 8px;">
                                        <?php foreach ($config_educativa['despues']['metricas'] as $key => $value): ?>
                                        <div style="display: flex; justify-content: space-between; color: #14532d; font-size: 0.9rem;">
                                            <span><?= ucfirst(str_replace('_', ' ', $key)) ?>:</span>
                                            <strong><?= htmlspecialchars($value) ?></strong>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- CSV Entregable -->
                    <?php if (isset($config_educativa['csv_entregable'])): ?>
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 12px; text-align: center;">
                        <h3 style="color: white; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <span>📥</span> CSV Entregable Listo
                        </h3>
                        <p style="margin-bottom: 15px; opacity: 0.95;">
                            <?= htmlspecialchars($config_educativa['csv_entregable']['descripcion']) ?>
                        </p>
                        <a href="../../ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/entregables/ibiza_villa/<?= $config_educativa['csv_entregable']['nombre'] ?>"
                           class="btn btn-success"
                           download
                           style="background: white; color: #667eea; font-weight: bold; padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block;">
                            📥 Descargar <?= htmlspecialchars($config_educativa['csv_entregable']['nombre']) ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Formulario de datos -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">💾 Datos del Paso</h2>
                    </div>

                    <form id="dataForm">
                        <input type="hidden" name="paso_id" value="<?= $paso_id ?>">
                        
                        <div class="form-group">
                            <label class="form-label">Estado:</label>
                            <select class="form-control" name="estado">
                                <option value="pendiente" <?= $paso['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="en_progreso" <?= $paso['estado'] === 'en_progreso' ? 'selected' : '' ?>>En Progreso</option>
                                <option value="completado" <?= $paso['estado'] === 'completado' ? 'selected' : '' ?>>Completado</option>
                                <option value="bloqueado" <?= $paso['estado'] === 'bloqueado' ? 'selected' : '' ?>>Bloqueado</option>
                                <option value="omitido" <?= $paso['estado'] === 'omitido' ? 'selected' : '' ?>>Omitido</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tiempo Real (horas):</label>
                            <input type="number" class="form-control" name="tiempo_real_horas" 
                                   value="<?= $paso['tiempo_real_horas'] ?? '' ?>" step="0.5" min="0">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notas:</label>
                            <textarea class="form-control" name="notas" rows="4"><?= htmlspecialchars($paso['notas'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Datos Completados (JSON):</label>
                            <textarea class="json-editor" name="datos_completados" rows="10"><?= htmlspecialchars($paso['datos_completados'] ?? '{}') ?></textarea>
                            <small style="color: #666; margin-top: 5px; display: block;">
                                Formato JSON válido. Ejemplo: {"urls_analizadas": 50, "errores_encontrados": 3}
                            </small>
                        </div>

                        <div style="text-align: right;">
                            <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                        </div>
                    </form>
                </div>

                <!-- Comentarios -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">💬 Comentarios (<?= count($comentarios) ?>)</h2>
                    </div>

                    <form id="commentForm" style="margin-bottom: 20px;">
                        <input type="hidden" name="paso_id" value="<?= $paso_id ?>">
                        <div class="form-group">
                            <textarea class="form-control" name="comentario" rows="3" 
                                      placeholder="Agregar un comentario..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">💬 Agregar Comentario</button>
                    </form>

                    <div id="comentarios-list">
                        <?php foreach ($comentarios as $comentario): ?>
                        <div class="comment-item">
                            <div class="comment-header">
                                <strong><?= htmlspecialchars($comentario['usuario_nombre'] ?? 'Usuario') ?></strong>
                                <span><?= date('d/m/Y H:i', strtotime($comentario['fecha_creacion'])) ?></span>
                            </div>
                            <div class="comment-content">
                                <?= nl2br(htmlspecialchars($comentario['comentario'])) ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="right-column">
                <!-- Progreso -->
                <div class="progress-section">
                    <div class="progress-circle">
                        <?php
                        $progreso = 0;
                        switch($paso['estado']) {
                            case 'completado': $progreso = 100; break;
                            case 'en_progreso': $progreso = 50; break;
                            case 'pendiente': $progreso = 0; break;
                            case 'bloqueado': $progreso = 25; break;
                            case 'omitido': $progreso = 100; break;
                        }
                        ?>
                        <?= $progreso ?>%
                    </div>
                    <h3>Estado del Paso</h3>
                    <p><?= ucfirst(str_replace('_', ' ', $paso['estado'])) ?></p>
                </div>

                <!-- Acciones rápidas -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">⚡ Acciones Rápidas</h2>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <?php if ($paso['estado'] === 'pendiente'): ?>
                        <button class="btn btn-warning" onclick="quickUpdate('en_progreso')">
                            ▶️ Iniciar Paso
                        </button>
                        <?php endif; ?>
                        
                        <?php if ($paso['estado'] === 'en_progreso'): ?>
                        <button class="btn btn-success" onclick="quickUpdate('completado')">
                            ✅ Completar Paso
                        </button>
                        <?php endif; ?>
                        
                        <button class="btn btn-secondary" onclick="quickUpdate('bloqueado')">
                            🚫 Marcar como Bloqueado
                        </button>
                        
                        <button class="btn btn-secondary" onclick="quickUpdate('omitido')">
                            ⏭️ Omitir Paso
                        </button>
                    </div>
                </div>

                <!-- Archivos -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">📎 Archivos (<?= count($archivos) ?>)</h2>
                    </div>

                    <form id="fileForm" style="margin-bottom: 20px;">
                        <input type="hidden" name="paso_id" value="<?= $paso_id ?>">
                        <div class="form-group">
                            <input type="file" class="form-control" name="archivo" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">📎 Subir Archivo</button>
                    </form>

                    <div id="archivos-list">
                        <?php foreach ($archivos as $archivo): ?>
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">📄</div>
                                <div>
                                    <div><strong><?= htmlspecialchars($archivo['nombre_original']) ?></strong></div>
                                    <div style="font-size: 0.8rem; color: #666;">
                                        <?= date('d/m/Y H:i', strtotime($archivo['fecha_subida'])) ?>
                                    </div>
                                </div>
                            </div>
                            <a href="download.php?id=<?= $archivo['id'] ?>" class="btn btn-secondary">⬇️</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Datos requeridos -->
                <?php if (!empty($datos_requeridos)): ?>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">📋 Datos Requeridos</h2>
                    </div>
                    <div class="data-viewer">
                        <?= htmlspecialchars(json_encode($datos_requeridos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Actualización rápida de estado
        function quickUpdate(estado) {
            if (confirm(`¿Cambiar el estado a "${estado.replace('_', ' ')}"?`)) {
                updateStep({estado: estado});
            }
        }

        // Función general para actualizar paso
        function updateStep(data) {
            data.step_id = <?= $paso_id ?>;
            
            fetch('update_step.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error de conexión');
                console.error(error);
            });
        }

        // Formulario de datos
        document.getElementById('dataForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Validar JSON
            if (data.datos_completados) {
                try {
                    JSON.parse(data.datos_completados);
                } catch (e) {
                    alert('El formato JSON no es válido');
                    return;
                }
            }
            
            updateStep(data);
        });

        // Formulario de comentarios
        document.getElementById('commentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const comentario = formData.get('comentario').trim();
            
            if (!comentario) {
                alert('Por favor ingresa un comentario');
                return;
            }
            
            fetch('add_comment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    paso_id: <?= $paso_id ?>,
                    comentario: comentario
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al agregar comentario: ' + data.message);
                }
            });
        });

        // Formulario de archivos
        document.getElementById('fileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            if (!formData.get('archivo').name) {
                alert('Por favor selecciona un archivo');
                return;
            }
            
            fetch('upload_file.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al subir archivo: ' + data.message);
                }
            });
        });
    </script>
</body>
</html>