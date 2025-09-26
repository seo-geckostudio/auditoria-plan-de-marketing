<?php
/**
 * DASHBOARD PRINCIPAL
 * ===================
 * 
 * Vista principal del sistema que muestra estadísticas generales,
 * auditorías recientes, pasos críticos pendientes y gráficos de progreso.
 */

// Obtener estadísticas del sistema
$estadisticas = obtenerEstadisticasSistema();

// Obtener auditorías recientes
$auditoriasRecientes = obtenerAuditoriasRecientes(5);

// Obtener pasos críticos pendientes
$pasosCriticos = obtenerPasosCriticosPendientes(10);

// Obtener actividad reciente
$actividadReciente = obtenerActividadReciente(8);
?>

<div class="row">
    <!-- Tarjetas de estadísticas -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Auditorías
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($estadisticas['total_auditorias']) ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Auditorías Completadas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($estadisticas['auditorias_completadas'] ?? 0) ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Progreso Promedio
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?= number_format($estadisticas['progreso_promedio'] ?? 0, 1) ?>%
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                         style="width: <?= $estadisticas['progreso_promedio'] ?? 0 ?>%"
                                         aria-valuenow="<?= $estadisticas['progreso_promedio'] ?? 0 ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pasos Críticos Pendientes
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($estadisticas['pasos_criticos_pendientes'] ?? 0) ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Gráfico de progreso de auditorías -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-area me-2"></i>
                    Progreso de Auditorías Activas
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                         aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Opciones:</div>
                        <a class="dropdown-item" href="?modulo=reportes&tipo=progreso">Ver Reporte Completo</a>
                        <a class="dropdown-item" href="?modulo=auditorias&accion=listar&filtro=activas">Ver Auditorías Activas</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="graficoProgreso" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribución por estados -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie me-2"></i>
                    Estados de Auditorías
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="graficoEstados" width="100%" height="50"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Activas
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Completadas
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Pausadas
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Pendientes
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Auditorías recientes -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-clock me-2"></i>
                    Auditorías Recientes
                </h6>
            </div>
            <div class="card-body">
                <?php if (empty($auditoriasRecientes)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>No hay auditorías recientes</p>
                        <a href="?modulo=auditorias&accion=crear" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Crear Primera Auditoría
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Sitio Web</th>
                                    <th>Progreso</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($auditoriasRecientes as $auditoria): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <div class="avatar-initial bg-primary rounded-circle">
                                                        <?= strtoupper(substr($auditoria['cliente_nombre'], 0, 1)) ?>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-bold"><?= htmlspecialchars($auditoria['cliente_nombre']) ?></div>
                                                    <small class="text-muted"><?= formatearFecha($auditoria['fecha_creacion']) ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?= htmlspecialchars($auditoria['sitio_web']) ?>" 
                                               target="_blank" class="text-decoration-none">
                                                <?= htmlspecialchars($auditoria['sitio_web']) ?>
                                                <i class="fas fa-external-link-alt fa-sm ms-1"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                    <div class="progress-bar <?= obtenerClaseCSS($auditoria['estado']) ?>" 
                                                         role="progressbar" 
                                                         style="width: <?= $auditoria['porcentaje_completado'] ?>%"
                                                         aria-valuenow="<?= $auditoria['porcentaje_completado'] ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <small class="text-muted"><?= number_format($auditoria['porcentaje_completado'], 1) ?>%</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge <?= obtenerClaseCSS($auditoria['estado']) ?>">
                                                <?= obtenerNombreAmigable($auditoria['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria['id'] ?>" 
                                                   class="btn btn-outline-primary" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="?modulo=auditorias&accion=editar&id=<?= $auditoria['id'] ?>" 
                                                   class="btn btn-outline-secondary" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="?modulo=auditorias&accion=listar" class="btn btn-outline-primary">
                            Ver Todas las Auditorías
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Pasos críticos pendientes -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Pasos Críticos Pendientes
                </h6>
            </div>
            <div class="card-body">
                <?php if (empty($pasosCriticos)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                        <p>¡Excelente! No hay pasos críticos pendientes</p>
                    </div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($pasosCriticos as $paso): ?>
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <a href="?modulo=auditorias&accion=ver&id=<?= $paso['auditoria_id'] ?>#paso-<?= $paso['id'] ?>" 
                                               class="text-decoration-none">
                                                <?= htmlspecialchars($paso['nombre']) ?>
                                            </a>
                                        </h6>
                                        <p class="mb-1 text-muted small">
                                            <?= htmlspecialchars($paso['cliente_nombre']) ?> - 
                                            <?= htmlspecialchars($paso['fase_nombre']) ?>
                                        </p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            Estimado: <?= $paso['tiempo_estimado'] ?> min
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge badge-danger mb-2">Crítico</span>
                                        <br>
                                        <small class="text-muted">
                                            <?= formatearFecha($paso['fecha_limite']) ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            onclick="actualizarEstadoPaso(<?= $paso['id'] ?>, <?= $paso['auditoria_id'] ?>, 'en_progreso')">
                                        <i class="fas fa-play"></i> Iniciar
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" 
                                            onclick="actualizarEstadoPaso(<?= $paso['id'] ?>, <?= $paso['auditoria_id'] ?>, 'completado')">
                                        <i class="fas fa-check"></i> Completar
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center mt-3">
                        <a href="?modulo=pasos&accion=criticos" class="btn btn-outline-warning">
                            Ver Todos los Pasos Críticos
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Actividad reciente -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-history me-2"></i>
                    Actividad Reciente
                </h6>
            </div>
            <div class="card-body">
                <?php if (empty($actividadReciente)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-clock fa-3x mb-3"></i>
                        <p>No hay actividad reciente</p>
                    </div>
                <?php else: ?>
                    <div class="timeline">
                        <?php foreach ($actividadReciente as $actividad): ?>
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas <?= obtenerIconoActividad($actividad['tipo']) ?> 
                                              text-<?= obtenerColorActividad($actividad['tipo']) ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1"><?= htmlspecialchars($actividad['descripcion']) ?></h6>
                                            <p class="mb-1 text-muted small">
                                                <?= htmlspecialchars($actividad['usuario_nombre']) ?> - 
                                                <?= htmlspecialchars($actividad['cliente_nombre']) ?>
                                            </p>
                                        </div>
                                        <small class="text-muted">
                                            <?= formatearTiempoTranscurrido($actividad['fecha_cambio']) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center mt-3">
                        <a href="?modulo=reportes&tipo=actividad" class="btn btn-outline-primary">
                            Ver Toda la Actividad
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos para los gráficos (obtenidos del PHP)
    const datosProgreso = <?= json_encode(obtenerDatosGraficoProgreso()) ?>;
    const datosEstados = <?= json_encode(obtenerDatosGraficoEstados()) ?>;
    
    // Gráfico de progreso de auditorías
    const ctxProgreso = document.getElementById('graficoProgreso').getContext('2d');
    new Chart(ctxProgreso, {
        type: 'line',
        data: {
            labels: datosProgreso.labels,
            datasets: [{
                label: 'Progreso Promedio (%)',
                data: datosProgreso.data,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Progreso: ' + context.parsed.y + '%';
                        }
                    }
                }
            }
        }
    });
    
    // Gráfico de estados
    const ctxEstados = document.getElementById('graficoEstados').getContext('2d');
    new Chart(ctxEstados, {
        type: 'doughnut',
        data: {
            labels: datosEstados.labels,
            datasets: [{
                data: datosEstados.data,
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
});
</script>

<style>
/* Estilos adicionales para el dashboard */
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.avatar {
    width: 2rem;
    height: 2rem;
}

.avatar-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
    width: 100%;
    height: 100%;
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -1.5rem;
    top: 1.5rem;
    width: 2px;
    height: calc(100% + 0.5rem);
    background-color: #e3e6f0;
}

.timeline-marker {
    position: absolute;
    left: -2rem;
    top: 0;
    width: 2rem;
    height: 2rem;
    background-color: white;
    border: 2px solid #e3e6f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.timeline-content {
    background-color: #f8f9fc;
    padding: 1rem;
    border-radius: 0.5rem;
    border-left: 3px solid #4e73df;
}

.chart-area {
    position: relative;
    height: 20rem;
}

.chart-pie {
    position: relative;
    height: 15rem;
}

@media (max-width: 768px) {
    .timeline {
        padding-left: 1rem;
    }
    
    .timeline-marker {
        left: -1rem;
        width: 1.5rem;
        height: 1.5rem;
    }
    
    .timeline-item:not(:last-child)::before {
        left: -0.75rem;
    }
}
</style>