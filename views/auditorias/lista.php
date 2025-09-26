<?php
// Vista para listar auditorías
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>
                        Lista de Auditorías
                    </h5>
                    <a href="?modulo=auditorias&accion=crear" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Nueva Auditoría
                    </a>
                </div>
                <div class="card-body">
                    <?php if (empty($auditorias)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay auditorías registradas</h5>
                            <p class="text-muted">Comienza creando tu primera auditoría SEO</p>
                            <a href="?modulo=auditorias&accion=crear" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>
                                Crear Primera Auditoría
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Prioridad</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Límite</th>
                                        <th>Progreso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($auditorias as $auditoria): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($auditoria['id']) ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($auditoria['nombre']) ?></strong>
                                                <?php if (!empty($auditoria['descripcion'])): ?>
                                                    <br><small class="text-muted"><?= htmlspecialchars(substr($auditoria['descripcion'], 0, 50)) ?>...</small>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($auditoria['cliente_nombre'] ?? 'Sin asignar') ?></td>
                                            <td>
                                                <span class="badge bg-<?= obtenerColorEstado($auditoria['estado']) ?>">
                                                    <?= ucfirst($auditoria['estado']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= obtenerColorPrioridad($auditoria['prioridad'] ?? 'media') ?>">
                                                    <?= ucfirst($auditoria['prioridad'] ?? 'media') ?>
                                                </span>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($auditoria['fecha_inicio'])) ?></td>
                                            <td><?= !empty($auditoria['fecha_limite']) ? date('d/m/Y', strtotime($auditoria['fecha_limite'])) : 'Sin fecha' ?></td>
                                            <td>
                                                <?php $progreso = $auditoria['porcentaje_completado'] ?? 0; ?>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: <?= $progreso ?>%" 
                                                         aria-valuenow="<?= $progreso ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        <?= round($progreso) ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria['id'] ?>" 
                                                       class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="?modulo=auditorias&accion=editar&id=<?= $auditoria['id'] ?>" 
                                                       class="btn btn-sm btn-outline-secondary" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="confirmarEliminar(<?= $auditoria['id'] ?>)" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarEliminar(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta auditoría? Esta acción no se puede deshacer.')) {
        window.location.href = '?modulo=auditorias&accion=eliminar&id=' + id;
    }
}

<?php
function obtenerColorEstado($estado) {
    switch ($estado) {
        case 'planificada': return 'secondary';
        case 'en_progreso': return 'primary';
        case 'completada': return 'success';
        case 'pausada': return 'warning';
        case 'cancelada': return 'danger';
        default: return 'secondary';
    }
}

function obtenerColorPrioridad($prioridad) {
    switch ($prioridad) {
        case 'alta': return 'danger';
        case 'media': return 'warning';
        case 'baja': return 'success';
        default: return 'secondary';
    }
}
?>
</script>