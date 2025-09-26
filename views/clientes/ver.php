<?php
/**
 * VISTA: Ver Cliente
 * 
 * Muestra los detalles completos de un cliente.
 */

// Verificar que se incluya desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}
?>

<div class="container-fluid">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user"></i>
                <?= htmlspecialchars($cliente['nombre_empresa']) ?>
            </h1>
            <p class="mb-0 text-muted">Información detallada del cliente</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="?modulo=clientes&accion=editar&id=<?= $cliente['id'] ?>" class="btn btn-primary me-2">
                <i class="fas fa-edit"></i>
                Editar
            </a>
            <a href="?modulo=clientes&accion=listar" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i>
                Volver a la Lista
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-lg-8">
            <!-- Información de la Empresa -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-building"></i>
                        Información de la Empresa
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Nombre de la Empresa</label>
                                <p class="h6 mb-0"><?= htmlspecialchars($cliente['nombre_empresa']) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Sitio Web Principal</label>
                                <?php if ($cliente['url_principal']): ?>
                                    <p class="mb-0">
                                        <a href="<?= htmlspecialchars($cliente['url_principal']) ?>" 
                                           target="_blank" 
                                           class="text-decoration-none">
                                            <i class="fas fa-external-link-alt"></i>
                                            <?= htmlspecialchars($cliente['url_principal']) ?>
                                        </a>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No especificado</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Sector</label>
                                <?php if ($cliente['sector']): ?>
                                    <p class="mb-0">
                                        <span class="badge bg-info fs-6">
                                            <?= htmlspecialchars($cliente['sector']) ?>
                                        </span>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No especificado</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">País</label>
                                <?php if ($cliente['pais']): ?>
                                    <p class="mb-0"><?= htmlspecialchars($cliente['pais']) ?></p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No especificado</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Estado</label>
                                <p class="mb-0">
                                    <?php if ($cliente['activo'] ?? 1): ?>
                                        <span class="badge bg-success fs-6">
                                            <i class="fas fa-check-circle"></i>
                                            Activo
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary fs-6">
                                            <i class="fas fa-pause-circle"></i>
                                            Inactivo
                                        </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-address-card"></i>
                        Información de Contacto
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Nombre del Contacto</label>
                                <?php if ($cliente['contacto_nombre']): ?>
                                    <p class="mb-0"><?= htmlspecialchars($cliente['contacto_nombre']) ?></p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No especificado</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Email de Contacto</label>
                                <?php if ($cliente['contacto_email']): ?>
                                    <p class="mb-0">
                                        <a href="mailto:<?= htmlspecialchars($cliente['contacto_email']) ?>" 
                                           class="text-decoration-none">
                                            <i class="fas fa-envelope"></i>
                                            <?= htmlspecialchars($cliente['contacto_email']) ?>
                                        </a>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No especificado</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label text-muted">Teléfono de Contacto</label>
                                <?php if ($cliente['contacto_telefono']): ?>
                                    <p class="mb-0">
                                        <i class="fas fa-phone"></i>
                                        <?= htmlspecialchars($cliente['contacto_telefono']) ?>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No especificado</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notas -->
            <?php if ($cliente['notas']): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-sticky-note"></i>
                            Notas
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><?= nl2br(htmlspecialchars($cliente['notas'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Auditorías del Cliente -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-search"></i>
                        Auditorías del Cliente (<?= count($auditorias) ?>)
                    </h5>
                    <a href="?modulo=auditorias&accion=crear&cliente_id=<?= $cliente['id'] ?>" 
                       class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                        Nueva Auditoría
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($auditorias)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No hay auditorías registradas</h6>
                            <p class="text-muted mb-3">Este cliente aún no tiene auditorías SEO asociadas.</p>
                            <a href="?modulo=auditorias&accion=crear&cliente_id=<?= $cliente['id'] ?>" 
                               class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Crear Primera Auditoría
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Prioridad</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Límite</th>
                                        <th>Progreso</th>
                                        <th width="120">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($auditorias as $auditoria): ?>
                                        <tr>
                                            <td>
                                                <strong><?= htmlspecialchars($auditoria['nombre']) ?></strong>
                                                <?php if ($auditoria['descripcion']): ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?= htmlspecialchars(substr($auditoria['descripcion'], 0, 50)) ?>
                                                        <?= strlen($auditoria['descripcion']) > 50 ? '...' : '' ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $estadoClases = [
                                                    'planificada' => 'bg-info',
                                                    'en_progreso' => 'bg-warning',
                                                    'completada' => 'bg-success',
                                                    'pausada' => 'bg-secondary',
                                                    'cancelada' => 'bg-danger'
                                                ];
                                                $estadoTextos = [
                                                    'planificada' => 'Planificada',
                                                    'en_progreso' => 'En Progreso',
                                                    'completada' => 'Completada',
                                                    'pausada' => 'Pausada',
                                                    'cancelada' => 'Cancelada'
                                                ];
                                                ?>
                                                <span class="badge <?= $estadoClases[$auditoria['estado']] ?? 'bg-secondary' ?>">
                                                    <?= $estadoTextos[$auditoria['estado']] ?? ucfirst($auditoria['estado']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                $prioridadClases = [
                                                    'alta' => 'text-danger',
                                                    'media' => 'text-warning',
                                                    'baja' => 'text-success'
                                                ];
                                                ?>
                                                <span class="<?= $prioridadClases[$auditoria['prioridad']] ?? '' ?>">
                                                    <i class="fas fa-circle"></i>
                                                    <?= ucfirst($auditoria['prioridad']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small>
                                                    <?= date('d/m/Y', strtotime($auditoria['fecha_inicio'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    <?= date('d/m/Y', strtotime($auditoria['fecha_limite'])) ?>
                                                    <?php
                                                    $diasRestantes = ceil((strtotime($auditoria['fecha_limite']) - time()) / (60 * 60 * 24));
                                                    if ($diasRestantes < 0): ?>
                                                        <br><span class="badge bg-danger">Vencida</span>
                                                    <?php elseif ($diasRestantes <= 3): ?>
                                                        <br><span class="badge bg-warning">Próxima</span>
                                                    <?php endif; ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php
                                                $progreso = $auditoria['progreso'] ?? 0;
                                                $colorProgreso = $progreso < 30 ? 'bg-danger' : ($progreso < 70 ? 'bg-warning' : 'bg-success');
                                                ?>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar <?= $colorProgreso ?>" 
                                                         style="width: <?= $progreso ?>%"></div>
                                                </div>
                                                <small class="text-muted"><?= $progreso ?>%</small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria['id'] ?>" 
                                                       class="btn btn-outline-primary" 
                                                       title="Ver auditoría">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="?modulo=auditorias&accion=editar&id=<?= $auditoria['id'] ?>" 
                                                       class="btn btn-outline-secondary" 
                                                       title="Editar auditoría">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
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

        <!-- Panel Lateral -->
        <div class="col-lg-4">
            <!-- Estadísticas -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar"></i>
                        Estadísticas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary mb-0"><?= $estadisticas['total_auditorias'] ?></h4>
                                <small class="text-muted">Total Auditorías</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-0"><?= $estadisticas['auditorias_completadas'] ?></h4>
                            <small class="text-muted">Completadas</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-4">
                            <h6 class="text-warning mb-0"><?= $estadisticas['auditorias_en_progreso'] ?></h6>
                            <small class="text-muted">En Progreso</small>
                        </div>
                        <div class="col-4">
                            <h6 class="text-info mb-0"><?= $estadisticas['auditorias_planificadas'] ?></h6>
                            <small class="text-muted">Planificadas</small>
                        </div>
                        <div class="col-4">
                            <h6 class="text-secondary mb-0"><?= $estadisticas['auditorias_pausadas'] ?></h6>
                            <small class="text-muted">Pausadas</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Sistema -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información del Sistema
                    </h6>
                </div>
                <div class="card-body">
                    <div class="small">
                        <p class="mb-2">
                            <strong>ID del Cliente:</strong> 
                            <code><?= $cliente['id'] ?></code>
                        </p>
                        <p class="mb-2">
                            <strong>Fecha de Creación:</strong><br>
                            <?= date('d/m/Y H:i:s', strtotime($cliente['fecha_creacion'])) ?>
                        </p>
                        <?php if ($cliente['fecha_actualizacion']): ?>
                            <p class="mb-2">
                                <strong>Última Actualización:</strong><br>
                                <?= date('d/m/Y H:i:s', strtotime($cliente['fecha_actualizacion'])) ?>
                            </p>
                        <?php endif; ?>
                        <p class="mb-0">
                            <strong>Estado:</strong> 
                            <?php if ($cliente['activo'] ?? 1): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt"></i>
                        Acciones Rápidas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="?modulo=auditorias&accion=crear&cliente_id=<?= $cliente['id'] ?>" 
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i>
                            Nueva Auditoría
                        </a>
                        <a href="?modulo=clientes&accion=editar&id=<?= $cliente['id'] ?>" 
                           class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar Cliente
                        </a>
                        <?php if ($cliente['activo'] ?? 1): ?>
                            <button type="button" 
                                    class="btn btn-outline-warning btn-sm"
                                    onclick="confirmarDesactivar(<?= $cliente['id'] ?>, '<?= htmlspecialchars($cliente['nombre_empresa']) ?>')">
                                <i class="fas fa-ban"></i>
                                Desactivar Cliente
                            </button>
                        <?php else: ?>
                            <a href="?modulo=clientes&accion=activar&id=<?= $cliente['id'] ?>" 
                               class="btn btn-outline-success btn-sm"
                               onclick="return confirm('¿Estás seguro de que quieres activar este cliente?')">
                                <i class="fas fa-check"></i>
                                Activar Cliente
                            </a>
                        <?php endif; ?>
                        <button type="button" 
                                class="btn btn-outline-danger btn-sm"
                                onclick="confirmarBorrar(<?= $cliente['id'] ?>, '<?= htmlspecialchars($cliente['nombre_empresa']) ?>')">
                            <i class="fas fa-trash"></i>
                            Borrar Permanentemente
                        </button>
                        <?php if ($cliente['contacto_email']): ?>
                            <a href="mailto:<?= htmlspecialchars($cliente['contacto_email']) ?>" 
                               class="btn btn-outline-info btn-sm">
                                <i class="fas fa-envelope"></i>
                                Enviar Email
                            </a>
                        <?php endif; ?>
                        <?php if ($cliente['url_principal']): ?>
                            <a href="<?= htmlspecialchars($cliente['url_principal']) ?>" 
                               target="_blank" 
                               class="btn btn-outline-success btn-sm">
                                <i class="fas fa-external-link-alt"></i>
                                Visitar Sitio Web
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarDesactivar(clienteId, nombreEmpresa) {
    if (confirm(`¿Estás seguro de que quieres desactivar el cliente "${nombreEmpresa}"?\n\nEsta acción solo se puede realizar si el cliente no tiene auditorías activas.`)) {
        window.location.href = `?modulo=clientes&accion=eliminar&id=${clienteId}`;
    }
}

function confirmarBorrar(clienteId, nombreEmpresa) {
    if (confirm(`⚠️ ATENCIÓN: ¿Estás seguro de que quieres BORRAR PERMANENTEMENTE el cliente "${nombreEmpresa}"?\n\nEsta acción NO SE PUEDE DESHACER y eliminará completamente el cliente del sistema.\n\nSolo se puede realizar si el cliente no tiene auditorías asociadas.`)) {
        window.location.href = `?modulo=clientes&accion=borrar&id=${clienteId}`;
    }
}
</script>