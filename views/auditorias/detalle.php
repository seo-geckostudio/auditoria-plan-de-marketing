<?php
/**
 * VISTA: Detalle de Auditoría
 * ===========================
 * 
 * Muestra el detalle completo de una auditoría específica
 * incluyendo pasos por fase, archivos, comentarios e historial
 */

// Verificar que tenemos los datos necesarios
if (!isset($auditoria) || !$auditoria) {
    echo '<div class="alert alert-danger">No se pudo cargar la información de la auditoría.</div>';
    return;
}
?>

<div class="container-fluid">
    <!-- Encabezado de la auditoría -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1"><?= htmlspecialchars($auditoria['titulo'] ?? $auditoria['nombre'] ?? 'Auditoría sin nombre') ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="?modulo=auditorias&accion=listar">Auditorías</a></li>
                            <li class="breadcrumb-item active">Detalle</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="?modulo=auditorias&accion=listar" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Información general de la auditoría -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Información General
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombre:</strong> <?= htmlspecialchars($auditoria['titulo'] ?? $auditoria['nombre'] ?? 'N/A') ?></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge bg-<?= obtenerColorEstado($auditoria['estado'] ?? 'planificada') ?>">
                                    <?= ucfirst($auditoria['estado'] ?? 'planificada') ?>
                                </span>
                            </p>
                            <p><strong>Prioridad:</strong> 
                                <span class="badge bg-<?= obtenerColorPrioridad($auditoria['prioridad'] ?? 'media') ?>">
                                    <?= ucfirst($auditoria['prioridad'] ?? 'media') ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha Inicio:</strong> <?= formatearFecha($auditoria['fecha_inicio'] ?? '', true) ?></p>
                            <p><strong>Fecha Fin Estimada:</strong> <?= formatearFecha($auditoria['fecha_fin_estimada'] ?? '', true) ?></p>
                            <p><strong>Progreso:</strong> 
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?= $auditoria['porcentaje_completado'] ?? 0 ?>%"
                                         aria-valuenow="<?= $auditoria['porcentaje_completado'] ?? 0 ?>" 
                                         aria-valuemin="0" aria-valuemax="100">
                                        <?= round($auditoria['porcentaje_completado'] ?? 0) ?>%
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                    
                    <?php if (!empty($auditoria['descripcion'])): ?>
                    <div class="mt-3">
                        <strong>Descripción:</strong>
                        <p class="mt-2"><?= nl2br(htmlspecialchars($auditoria['descripcion'])) ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($auditoria['url_principal'])): ?>
                    <div class="mt-3">
                        <strong>URL Principal:</strong>
                        <p class="mt-2">
                            <a href="<?= htmlspecialchars($auditoria['url_principal']) ?>" target="_blank" class="text-decoration-none">
                                <?= htmlspecialchars($auditoria['url_principal']) ?>
                                <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie"></i> Estadísticas
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (isset($fases) && is_array($fases)): ?>
                        <?php 
                        $totalPasos = 0;
                        $pasosCompletados = 0;
                        foreach ($fases as $fase) {
                            if (isset($fase['pasos']) && is_array($fase['pasos'])) {
                                $totalPasos += count($fase['pasos']);
                                foreach ($fase['pasos'] as $paso) {
                                    if (($paso['estado'] ?? '') === 'completado') {
                                        $pasosCompletados++;
                                    }
                                }
                            }
                        }
                        ?>
                        <p><strong>Total de Pasos:</strong> <?= $totalPasos ?></p>
                        <p><strong>Pasos Completados:</strong> <?= $pasosCompletados ?></p>
                        <p><strong>Pasos Pendientes:</strong> <?= $totalPasos - $pasosCompletados ?></p>
                    <?php else: ?>
                        <p class="text-muted">No hay información de pasos disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasos por fase -->
    <?php if (isset($fases) && is_array($fases) && !empty($fases)): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tasks"></i> Pasos por Fase
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="fasesAccordion">
                        <?php foreach ($fases as $index => $fase): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse<?= $index ?>" 
                                        aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" 
                                        aria-controls="collapse<?= $index ?>">
                                    <strong>Fase <?= $fase['numero_fase'] ?? ($index + 1) ?>: <?= htmlspecialchars($fase['nombre'] ?? 'Fase sin nombre') ?></strong>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" 
                                 class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" 
                                 aria-labelledby="heading<?= $index ?>" 
                                 data-bs-parent="#fasesAccordion">
                                <div class="accordion-body">
                                    <?php if (isset($fase['pasos']) && is_array($fase['pasos']) && !empty($fase['pasos'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Paso</th>
                                                        <th>Estado</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Completado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($fase['pasos'] as $paso): ?>
                                                    <tr>
                                                        <td>
                                                            <strong><?= htmlspecialchars($paso['nombre'] ?? 'Paso sin nombre') ?></strong>
                                                            <?php if (!empty($paso['descripcion'])): ?>
                                                                <br><small class="text-muted"><?= htmlspecialchars($paso['descripcion']) ?></small>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-<?= obtenerColorEstado($paso['estado'] ?? 'pendiente') ?>">
                                                                <?= ucfirst($paso['estado'] ?? 'pendiente') ?>
                                                            </span>
                                                        </td>
                                                        <td><?= formatearFecha($paso['fecha_inicio'] ?? '', true) ?></td>
                                                        <td><?= formatearFecha($paso['fecha_completado'] ?? '', true) ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary" 
                                                                    onclick="editarPaso(<?= $paso['id'] ?? 0 ?>)">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">No hay pasos definidos para esta fase</p>
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
    <?php endif; ?>

    <!-- Archivos y comentarios -->
    <div class="row">
        <div class="col-md-6">
            <?php if (isset($archivos) && is_array($archivos) && !empty($archivos)): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-alt"></i> Archivos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($archivos as $archivo): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= htmlspecialchars($archivo['nombre_original'] ?? 'Archivo sin nombre') ?></h6>
                                <small><?= formatearFecha($archivo['fecha_subida'] ?? '', true) ?></small>
                            </div>
                            <p class="mb-1">
                                <small class="text-muted">
                                    Paso: <?= htmlspecialchars($archivo['paso_nombre'] ?? 'N/A') ?>
                                </small>
                            </p>
                            <small>Subido por: <?= htmlspecialchars($archivo['subido_por'] ?? 'N/A') ?></small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <?php if (isset($comentarios) && is_array($comentarios) && !empty($comentarios)): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-comments"></i> Comentarios Recientes
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach (array_slice($comentarios, 0, 5) as $comentario): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= htmlspecialchars($comentario['autor'] ?? 'Usuario') ?></h6>
                                <small><?= formatearFecha($comentario['fecha_creacion'] ?? '', true) ?></small>
                            </div>
                            <p class="mb-1"><?= nl2br(htmlspecialchars($comentario['comentario'] ?? '')) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
/**
 * Funciones auxiliares para la vista
 */
function obtenerColorEstado($estado) {
    switch (strtolower($estado)) {
        case 'completado':
        case 'completada':
            return 'success';
        case 'en_progreso':
            return 'warning';
        case 'pendiente':
            return 'secondary';
        case 'bloqueado':
            return 'danger';
        case 'omitido':
            return 'info';
        default:
            return 'secondary';
    }
}

function obtenerColorPrioridad($prioridad) {
    switch (strtolower($prioridad)) {
        case 'alta':
        case 'urgente':
            return 'danger';
        case 'media':
            return 'warning';
        case 'baja':
            return 'success';
        default:
            return 'secondary';
    }
}
?>