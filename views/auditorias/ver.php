<?php
/**
 * VISTA: Ver Auditoría Individual
 * ===============================
 * 
 * Vista mejorada para mostrar una auditoría con pasos organizados por fases
 * y niveles de criticidad, siguiendo el flujo del usuario
 */

// Verificar que tenemos los datos necesarios
if (!isset($auditoria) || !$auditoria) {
    echo '<div class="alert alert-danger">No se pudo cargar la información de la auditoría.</div>';
    return;
}

// Función para obtener color según criticidad
function obtenerColorCriticidad($criticidad) {
    switch (strtolower($criticidad ?? '')) {
        case 'critica': return 'danger';
        case 'alta': return 'warning';
        case 'media': return 'info';
        case 'baja': return 'secondary';
        default: return 'light';
    }
}

// Función para obtener icono según criticidad
function obtenerIconoCriticidad($criticidad) {
    switch (strtolower($criticidad ?? '')) {
        case 'critica': return 'fas fa-exclamation-triangle';
        case 'alta': return 'fas fa-exclamation-circle';
        case 'media': return 'fas fa-info-circle';
        case 'baja': return 'fas fa-check-circle';
        default: return 'fas fa-circle';
    }
}
?>

<style>
.fase-card {
    border-left: 4px solid #007bff;
    transition: all 0.3s ease;
}

.fase-card.fase-0 { border-left-color: #6f42c1; }
.fase-card.fase-1 { border-left-color: #dc3545; }
.fase-card.fase-2 { border-left-color: #fd7e14; }
.fase-card.fase-3 { border-left-color: #ffc107; }
.fase-card.fase-4 { border-left-color: #20c997; }
.fase-card.fase-5 { border-left-color: #0dcaf0; }

.paso-item {
    border-left: 3px solid transparent;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.paso-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.paso-item.critica { border-left-color: #dc3545; background: #fff5f5; }
.paso-item.alta { border-left-color: #fd7e14; background: #fff8f0; }
.paso-item.media { border-left-color: #0dcaf0; background: #f0fcff; }
.paso-item.baja { border-left-color: #6c757d; background: #f8f9fa; }

.progress-ring {
    width: 60px;
    height: 60px;
}

.criticidad-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.datos-json {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 10px;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    max-height: 200px;
    overflow-y: auto;
}
</style>

<div class="container-fluid">
    <!-- Encabezado de la auditoría -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">
                        <i class="fas fa-search me-2"></i>
                        <?= htmlspecialchars($auditoria['titulo'] ?? $auditoria['nombre'] ?? 'Auditoría sin nombre') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="?modulo=auditorias&accion=listar">Auditorías</a></li>
                            <li class="breadcrumb-item active">Ver Auditoría</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group">
                    <a href="?modulo=auditorias&accion=editar&id=<?= $auditoria['id'] ?>" class="btn btn-outline-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="?modulo=auditorias&accion=informe&id=<?= $auditoria['id'] ?>" class="btn btn-success">
                        <i class="fas fa-file-pdf"></i> Generar Informe
                    </a>
                    <a href="?modulo=auditorias&accion=listar" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel de información general -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Información General
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> <?= htmlspecialchars($auditoria['cliente_nombre'] ?? 'N/A') ?></p>
                            <p><strong>Responsable:</strong> <?= htmlspecialchars($auditoria['usuario_nombre'] ?? 'N/A') ?></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge bg-<?= obtenerColorEstado($auditoria['estado'] ?? 'planificada') ?> fs-6">
                                    <?= ucfirst($auditoria['estado'] ?? 'planificada') ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha Inicio:</strong> <?= formatearFecha($auditoria['fecha_inicio'] ?? '', true) ?></p>
                            <p><strong>Fecha Fin:</strong> <?= formatearFecha($auditoria['fecha_fin'] ?? '', true) ?></p>
                            <p><strong>URL Principal:</strong> 
                                <?php if (!empty($auditoria['url_principal'])): ?>
                                    <a href="<?= htmlspecialchars($auditoria['url_principal']) ?>" target="_blank" class="text-decoration-none">
                                        <?= htmlspecialchars($auditoria['url_principal']) ?>
                                        <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No especificada</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    
                    <?php if (!empty($auditoria['descripcion'])): ?>
                    <div class="mt-3">
                        <strong>Descripción:</strong>
                        <p class="mt-2"><?= nl2br(htmlspecialchars($auditoria['descripcion'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie"></i> Progreso General
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="progress-ring mx-auto mb-3">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e9ecef" stroke-width="4" fill="none"/>
                            <circle cx="30" cy="30" r="25" stroke="#28a745" stroke-width="4" fill="none"
                                    stroke-dasharray="<?= 2 * pi() * 25 ?>"
                                    stroke-dashoffset="<?= 2 * pi() * 25 * (1 - ($auditoria['porcentaje_completado'] ?? 0) / 100) ?>"
                                    transform="rotate(-90 30 30)"/>
                        </svg>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <strong><?= round($auditoria['porcentaje_completado'] ?? 0) ?>%</strong>
                        </div>
                    </div>
                    
                    <?php if (isset($estadisticas)): ?>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="text-primary">
                                    <strong><?= $estadisticas['total_pasos'] ?? 0 ?></strong>
                                    <br><small>Total</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-success">
                                    <strong><?= $estadisticas['pasos_completados'] ?? 0 ?></strong>
                                    <br><small>Completados</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-warning">
                                    <strong><?= $estadisticas['pasos_pendientes'] ?? 0 ?></strong>
                                    <br><small>Pendientes</small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasos organizados por fases -->
    <?php if (isset($fases_con_pasos) && is_array($fases_con_pasos) && !empty($fases_con_pasos)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tasks"></i> Pasos por Fase
                    </h5>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-light btn-sm" onclick="expandirTodas()">
                            <i class="fas fa-expand-arrows-alt"></i> Expandir Todas
                        </button>
                        <button type="button" class="btn btn-light btn-sm" onclick="contraerTodas()">
                            <i class="fas fa-compress-arrows-alt"></i> Contraer Todas
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="fasesAccordion">
                        <?php foreach ($fases_con_pasos as $index => $fase): ?>
                        <div class="accordion-item fase-card fase-<?= $fase['numero'] ?? $index ?>">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse<?= $index ?>" 
                                        aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" 
                                        aria-controls="collapse<?= $index ?>">
                                    <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                        <div>
                                            <strong>Fase <?= $fase['numero'] ?? ($index + 1) ?>: <?= htmlspecialchars($fase['nombre'] ?? 'Fase sin nombre') ?></strong>
                                            <?php if (!empty($fase['descripcion'])): ?>
                                                <br><small class="text-muted"><?= htmlspecialchars($fase['descripcion']) ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-end">
                                            <?php if (isset($fase['progreso'])): ?>
                                                <div class="progress" style="width: 100px; height: 8px;">
                                                    <div class="progress-bar bg-success" style="width: <?= $fase['progreso'] ?>%"></div>
                                                </div>
                                                <small class="text-muted"><?= $fase['progreso'] ?>% completado</small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" 
                                 class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" 
                                 aria-labelledby="heading<?= $index ?>" 
                                 data-bs-parent="#fasesAccordion">
                                <div class="accordion-body">
                                    <?php if (isset($fase['pasos']) && is_array($fase['pasos']) && !empty($fase['pasos'])): ?>
                                        <?php 
                                        // Ordenar pasos por criticidad
                                        $pasos_ordenados = $fase['pasos'];
                                        usort($pasos_ordenados, function($a, $b) {
                                            $orden_criticidad = ['critica' => 1, 'alta' => 2, 'media' => 3, 'baja' => 4];
                                            $crit_a = $orden_criticidad[strtolower($a['criticidad'] ?? 'media')] ?? 5;
                                            $crit_b = $orden_criticidad[strtolower($b['criticidad'] ?? 'media')] ?? 5;
                                            return $crit_a - $crit_b;
                                        });
                                        ?>
                                        
                                        <?php foreach ($pasos_ordenados as $paso): ?>
                                        <div class="paso-item <?= strtolower($paso['criticidad'] ?? 'media') ?>" 
                                             data-paso-id="<?= $paso['id'] ?? 0 ?>">
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <div class="d-flex align-items-start">
                                                        <div class="me-3">
                                                            <i class="<?= obtenerIconoCriticidad($paso['criticidad'] ?? 'media') ?> text-<?= obtenerColorCriticidad($paso['criticidad'] ?? 'media') ?>"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($paso['nombre'] ?? 'Paso sin nombre') ?>
                                                                <span class="badge bg-<?= obtenerColorCriticidad($paso['criticidad'] ?? 'media') ?> criticidad-badge ms-2">
                                                                    <?= ucfirst($paso['criticidad'] ?? 'Media') ?>
                                                                </span>
                                                            </h6>
                                                            <?php if (!empty($paso['descripcion'])): ?>
                                                                <p class="text-muted mb-2 small"><?= htmlspecialchars($paso['descripcion']) ?></p>
                                                            <?php endif; ?>
                                                            
                                                            <?php if (!empty($paso['datos_completados'])): ?>
                                                                <div class="mt-2">
                                                                    <small class="text-success"><i class="fas fa-check-circle"></i> Datos introducidos</small>
                                                                    <div class="datos-json mt-1">
                                                                        <?= htmlspecialchars(json_encode(json_decode($paso['datos_completados'], true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) ?>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            
                                                            <?php if (!empty($paso['notas'])): ?>
                                                                <div class="mt-2">
                                                                    <small class="text-info"><i class="fas fa-sticky-note"></i> Notas:</small>
                                                                    <p class="small mt-1"><?= nl2br(htmlspecialchars($paso['notas'])) ?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <div class="mb-2">
                                                        <span class="badge bg-<?= obtenerColorEstado($paso['estado'] ?? 'pendiente') ?> fs-6">
                                                            <?= ucfirst($paso['estado'] ?? 'pendiente') ?>
                                                        </span>
                                                    </div>
                                                    
                                                    <?php if (!empty($paso['tiempo_real_horas'])): ?>
                                                        <div class="mb-2">
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock"></i> <?= $paso['tiempo_real_horas'] ?>h
                                                            </small>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-primary btn-sm" 
                                                                onclick="introducirDatos(<?= $paso['id'] ?? 0 ?>)"
                                                                title="Introducir datos">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-outline-info btn-sm" 
                                                                onclick="verDetallePaso(<?= $paso['id'] ?? 0 ?>)"
                                                                title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                                            <p>No hay pasos definidos para esta fase</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                <h5>No hay pasos definidos</h5>
                <p>Esta auditoría no tiene pasos asignados. <a href="?modulo=auditorias&accion=editar&id=<?= $auditoria['id'] ?>">Editar auditoría</a> para agregar pasos.</p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Botón de informe final -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="generar_informe.php?id=<?= $auditoria['id'] ?>" class="btn btn-success btn-lg">
                <i class="fas fa-file-alt me-2"></i>Generar Informe Final
            </a>
        </div>
    </div>
</div>

<script>
function expandirTodas() {
    document.querySelectorAll('.accordion-collapse').forEach(collapse => {
        if (!collapse.classList.contains('show')) {
            new bootstrap.Collapse(collapse, { show: true });
        }
    });
}

function contraerTodas() {
    document.querySelectorAll('.accordion-collapse.show').forEach(collapse => {
        new bootstrap.Collapse(collapse, { hide: true });
    });
}

function introducirDatos(pasoId) {
    // Redirigir a la página de introducción de datos
    window.location.href = `?modulo=auditorias&accion=introducir_datos&paso_id=${pasoId}`;
}

function verDetallePaso(pasoId) {
    // Redirigir a la página de detalle del paso
    window.location.href = `?modulo=auditorias&accion=detalle_paso&id=${pasoId}`;
}

// Actualizar progreso automáticamente cada 30 segundos
setInterval(function() {
    // Solo si hay pasos en progreso
    const pasosEnProgreso = document.querySelectorAll('[data-paso-id]').length;
    if (pasosEnProgreso > 0) {
        location.reload();
    }
}, 30000);
</script>