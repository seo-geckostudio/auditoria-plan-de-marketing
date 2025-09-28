<?php
/**
 * VISTA: AYUDA GENERAL DEL SISTEMA
 * ===============================
 *
 * Página principal de ayuda con índice de todos los recursos disponibles
 */

// Verificar que se ha incluido desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

require_once __DIR__ . '/../../includes/functions.php';

// Obtener estadísticas del sistema
$pdo = obtenerConexion();

// Contar pasos por fase
$sql = "SELECT
    f.numero_fase,
    f.nombre as fase_nombre,
    COUNT(pp.id) as total_pasos,
    SUM(CASE WHEN (SELECT COUNT(*) FROM paso_campos pc WHERE pc.paso_plantilla_id = pp.id) > 0 THEN 1 ELSE 0 END) as pasos_configurados
FROM fases f
LEFT JOIN pasos_plantilla pp ON f.id = pp.fase_id
GROUP BY f.id, f.numero_fase, f.nombre
ORDER BY f.numero_fase";

$fases = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Obtener pasos con ayuda disponible
$sql_ayuda = "SELECT pp.id, pp.nombre, pp.codigo_paso, f.numero_fase, f.nombre as fase_nombre
FROM pasos_plantilla pp
JOIN fases f ON pp.fase_id = f.id
WHERE pp.codigo_paso IN ('01_brief_cliente', '00_checklist_accesos', '03_keywords_actuales', '12_posicionamiento_organico')
ORDER BY f.numero_fase, pp.orden_en_fase";

$pasos_con_ayuda = $pdo->query($sql_ayuda)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Ayuda - Sistema de Auditorías SEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .help-card {
            transition: transform 0.2s;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .help-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .fase-card {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .progreso-bar {
            background: #e9ecef;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
        }
        .progreso-fill {
            background: linear-gradient(90deg, #28a745, #20c997);
            height: 100%;
            transition: width 0.3s ease;
        }
        .quick-access {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-3">
                        <i class="fas fa-question-circle me-3"></i>
                        Centro de Ayuda
                    </h1>
                    <p class="lead">
                        Guías completas, especificaciones técnicas y mejores prácticas para dominar el sistema de auditorías SEO
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Accesos Rápidos -->
        <div class="quick-access">
            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fas fa-rocket me-2"></i>Accesos Rápidos</h4>
                    <div class="row">
                        <div class="col-6">
                            <a href="?modulo=ayuda&accion=csv" class="btn btn-light btn-sm w-100 mb-2">
                                <i class="fas fa-file-csv"></i> Guía CSV
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="?modulo=ayuda&accion=herramientas" class="btn btn-light btn-sm w-100 mb-2">
                                <i class="fas fa-tools"></i> Herramientas
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4><i class="fas fa-chart-line me-2"></i>Estado del Sistema</h4>
                    <p class="mb-1">
                        <strong>Pasos configurados:</strong>
                        <?= array_sum(array_column($fases, 'pasos_configurados')) ?> de <?= array_sum(array_column($fases, 'total_pasos')) ?>
                    </p>
                    <div class="progreso-bar">
                        <div class="progreso-fill" style="width: <?= round((array_sum(array_column($fases, 'pasos_configurados')) / array_sum(array_column($fases, 'total_pasos'))) * 100, 1) ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secciones de Ayuda -->
        <div class="row">
            <!-- Ayuda por Pasos -->
            <div class="col-lg-8">
                <h2 class="mb-4">
                    <i class="fas fa-tasks text-primary"></i>
                    Ayuda por Pasos de Auditoría
                </h2>

                <?php foreach ($fases as $fase): ?>
                    <div class="fase-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">
                                    📁 Fase <?= $fase['numero_fase'] ?>: <?= htmlspecialchars($fase['fase_nombre']) ?>
                                </h5>
                                <small class="text-muted">
                                    <?= $fase['pasos_configurados'] ?> de <?= $fase['total_pasos'] ?> pasos configurados
                                </small>
                            </div>
                            <div class="text-end">
                                <?php if ($fase['total_pasos'] > 0): ?>
                                    <div class="progreso-bar" style="width: 80px;">
                                        <div class="progreso-fill" style="width: <?= round(($fase['pasos_configurados'] / $fase['total_pasos']) * 100) ?>%"></div>
                                    </div>
                                    <small><?= round(($fase['pasos_configurados'] / $fase['total_pasos']) * 100) ?>%</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <h3 class="mt-4 mb-3">
                    <i class="fas fa-book-open text-success"></i>
                    Pasos con Ayuda Disponible
                </h3>

                <div class="row">
                    <?php foreach ($pasos_con_ayuda as $paso): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card help-card">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <?= htmlspecialchars($paso['nombre']) ?>
                                    </h6>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Fase <?= $paso['numero_fase'] ?> - <?= htmlspecialchars($paso['fase_nombre']) ?>
                                        </small>
                                    </p>
                                    <a href="?modulo=ayuda&accion=paso&paso_id=<?= $paso['id'] ?>"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Ver Ayuda
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sidebar con recursos -->
            <div class="col-lg-4">
                <h3 class="mb-3">
                    <i class="fas fa-toolbox text-warning"></i>
                    Recursos Técnicos
                </h3>

                <!-- Especificaciones CSV -->
                <div class="card help-card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-file-csv text-success"></i>
                            Especificaciones CSV
                        </h5>
                        <p class="card-text">Formatos y configuraciones para importar datos desde GSC, Ahrefs y Screaming Frog.</p>
                        <a href="?modulo=ayuda&accion=csv" class="btn btn-success btn-sm">Ver Guía CSV</a>
                    </div>
                </div>

                <!-- Herramientas -->
                <div class="card help-card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-tools text-primary"></i>
                            Guía de Herramientas
                        </h5>
                        <p class="card-text">Configuración y uso de herramientas SEO principales.</p>
                        <a href="?modulo=ayuda&accion=herramientas" class="btn btn-primary btn-sm">Ver Herramientas</a>
                    </div>
                </div>

                <!-- Plan de Implementación -->
                <div class="card help-card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-map text-info"></i>
                            Plan de Implementación
                        </h5>
                        <p class="card-text">Roadmap completo para configurar todos los pasos del sistema.</p>
                        <a href="/PLAN_IMPLEMENTACION_COMPLETO.md" target="_blank" class="btn btn-info btn-sm">
                            <i class="fas fa-external-link-alt"></i> Ver Plan
                        </a>
                    </div>
                </div>

                <!-- Documentación Técnica -->
                <div class="card help-card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-code text-secondary"></i>
                            Documentación Técnica
                        </h5>
                        <p class="card-text">Detalles técnicos del sistema y arquitectura.</p>
                        <a href="/RESUMEN_IMPLEMENTACION_FINAL.md" target="_blank" class="btn btn-secondary btn-sm">
                            <i class="fas fa-external-link-alt"></i> Ver Docs
                        </a>
                    </div>
                </div>

                <!-- Tips Rápidos -->
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb"></i> Tips Rápidos</h6>
                    <ul class="mb-0">
                        <li>Usa el botón <strong>"Ayuda"</strong> en cualquier formulario</li>
                        <li>Los campos obligatorios están marcados con <span class="text-danger">*</span></li>
                        <li>El sistema auto-guarda cada 30 segundos</li>
                        <li>Puedes exportar datos en formato JSON o Excel</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contacto y Soporte -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h4><i class="fas fa-headset text-primary"></i> ¿Necesitas más ayuda?</h4>
                        <p class="text-muted">Si no encuentras la información que buscas, consulta la documentación completa del sistema.</p>
                        <div class="btn-group" role="group">
                            <a href="?modulo=auditorias&accion=listar" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Volver a Auditorías
                            </a>
                            <a href="?modulo=dashboard" class="btn btn-outline-secondary">
                                <i class="fas fa-home"></i> Ir al Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>