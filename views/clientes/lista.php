<?php
/**
 * VISTA: Lista de Clientes
 * 
 * Muestra la lista de clientes con opciones de filtrado, búsqueda y acciones.
 */

// Verificar que se incluya desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

// Obtener mensajes de la URL
$mensaje = $_GET['mensaje'] ?? '';
$error = $_GET['error'] ?? '';
?>

<div class="container-fluid">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users"></i>
                Gestión de Clientes
            </h1>
            <p class="mb-0 text-muted">Administra la información de tus clientes</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="?modulo=clientes&accion=crear" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Nuevo Cliente
            </a>
        </div>
    </div>

    <!-- Mensajes -->
    <?php if ($mensaje): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php
            switch ($mensaje) {
                case 'creado':
                    echo '<i class="fas fa-check-circle"></i> Cliente creado exitosamente';
                    break;
                case 'actualizado':
                    echo '<i class="fas fa-check-circle"></i> Cliente actualizado exitosamente';
                    break;
                case 'cliente_desactivado':
                    echo '<i class="fas fa-info-circle"></i> Cliente desactivado correctamente';
                    break;
                case 'cliente_activado':
                    echo '<i class="fas fa-check-circle"></i> Cliente activado correctamente';
                    break;
                default:
                    echo htmlspecialchars($mensaje);
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php
            switch ($error) {
                case 'id_requerido':
                    echo '<i class="fas fa-exclamation-triangle"></i> ID de cliente requerido';
                    break;
                case 'cliente_no_encontrado':
                    echo '<i class="fas fa-exclamation-triangle"></i> Cliente no encontrado';
                    break;
                case 'tiene_auditorias_activas':
                    echo '<i class="fas fa-exclamation-triangle"></i> No se puede desactivar el cliente porque tiene auditorías activas';
                    break;
                case 'error_desactivar':
                    echo '<i class="fas fa-exclamation-triangle"></i> Error al desactivar el cliente';
                    break;
                case 'error_activar':
                    echo '<i class="fas fa-exclamation-triangle"></i> Error al activar el cliente';
                    break;
                default:
                    echo htmlspecialchars($error);
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-filter"></i>
                Filtros de Búsqueda
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="">
                <input type="hidden" name="modulo" value="clientes">
                <input type="hidden" name="accion" value="listar">
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="busqueda" class="form-label">Búsqueda</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="busqueda" 
                                   name="busqueda" 
                                   value="<?= htmlspecialchars($_GET['busqueda'] ?? '') ?>"
                                   placeholder="Nombre, contacto o email...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="sector" class="form-label">Sector</label>
                            <select class="form-select" id="sector" name="sector">
                                <option value="">Todos los sectores</option>
                                <?php foreach ($sectores as $sector): ?>
                                    <option value="<?= htmlspecialchars($sector) ?>" 
                                            <?= (($_GET['sector'] ?? '') === $sector) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($sector) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="pais" class="form-label">País</label>
                            <select class="form-select" id="pais" name="pais">
                                <option value="">Todos los países</option>
                                <?php foreach ($paises as $pais): ?>
                                    <option value="<?= htmlspecialchars($pais) ?>" 
                                            <?= (($_GET['pais'] ?? '') === $pais) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($pais) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="activo" class="form-label">Estado</label>
                            <select class="form-select" id="activo" name="activo">
                                <option value="">Todos</option>
                                <option value="1" <?= (($_GET['activo'] ?? '') === '1') ? 'selected' : '' ?>>Activos</option>
                                <option value="0" <?= (($_GET['activo'] ?? '') === '0') ? 'selected' : '' ?>>Inactivos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid gap-2 d-md-flex">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Buscar
                                </button>
                                <a href="?modulo=clientes&accion=listar" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                    Limpiar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de Clientes -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list"></i>
                Lista de Clientes (<?= count($clientes) ?>)
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (empty($clientes)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No se encontraron clientes</h5>
                    <p class="text-muted">
                        <?php if (!empty($_GET['busqueda']) || !empty($_GET['sector']) || !empty($_GET['pais'])): ?>
                            Intenta ajustar los filtros de búsqueda o 
                            <a href="?modulo=clientes&accion=listar">ver todos los clientes</a>
                        <?php else: ?>
                            <a href="?modulo=clientes&accion=crear" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Crear tu primer cliente
                            </a>
                        <?php endif; ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Empresa</th>
                                <th>Contacto</th>
                                <th>Email</th>
                                <th>Sector</th>
                                <th>País</th>
                                <th>Estado</th>
                                <th>Fecha Creación</th>
                                <th width="150">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                                <?= strtoupper(substr($cliente['nombre_empresa'], 0, 1)) ?>
                                            </div>
                                            <div>
                                                <strong><?= htmlspecialchars($cliente['nombre_empresa']) ?></strong>
                                                <?php if ($cliente['url_principal']): ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        <a href="<?= htmlspecialchars($cliente['url_principal']) ?>" 
                                                           target="_blank" 
                                                           class="text-decoration-none">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            <?= htmlspecialchars(parse_url($cliente['url_principal'], PHP_URL_HOST)) ?>
                                                        </a>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($cliente['contacto_nombre']): ?>
                                            <?= htmlspecialchars($cliente['contacto_nombre']) ?>
                                            <?php if ($cliente['contacto_telefono']): ?>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-phone"></i>
                                                    <?= htmlspecialchars($cliente['contacto_telefono']) ?>
                                                </small>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cliente['contacto_email']): ?>
                                            <a href="mailto:<?= htmlspecialchars($cliente['contacto_email']) ?>" 
                                               class="text-decoration-none">
                                                <?= htmlspecialchars($cliente['contacto_email']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cliente['sector']): ?>
                                            <span class="badge bg-info">
                                                <?= htmlspecialchars($cliente['sector']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cliente['pais']): ?>
                                            <?= htmlspecialchars($cliente['pais']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cliente['activo'] ?? 1): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('d/m/Y', strtotime($cliente['fecha_creacion'])) ?>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="?modulo=clientes&accion=ver&id=<?= $cliente['id'] ?>" 
                                               class="btn btn-outline-primary" 
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?modulo=clientes&accion=editar&id=<?= $cliente['id'] ?>" 
                                               class="btn btn-outline-secondary" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($cliente['activo'] ?? 1): ?>
                                                <button type="button" 
                                                        class="btn btn-outline-danger" 
                                                        title="Desactivar"
                                                        onclick="confirmarDesactivar(<?= $cliente['id'] ?>, '<?= htmlspecialchars($cliente['nombre_empresa']) ?>')">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-outline-danger" 
                                                        title="Borrar permanentemente"
                                                        onclick="confirmarBorrar(<?= $cliente['id'] ?>, '<?= htmlspecialchars($cliente['nombre_empresa']) ?>')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php else: ?>
                                                <a href="?modulo=clientes&accion=activar&id=<?= $cliente['id'] ?>" 
                                                   class="btn btn-outline-success" 
                                                   title="Activar"
                                                   onclick="return confirm('¿Estás seguro de que quieres activar este cliente?')">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-outline-danger" 
                                                        title="Borrar permanentemente"
                                                        onclick="confirmarBorrar(<?= $cliente['id'] ?>, '<?= htmlspecialchars($cliente['nombre_empresa']) ?>')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
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

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 14px;
    font-weight: bold;
}
</style>

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

// Auto-submit del formulario de filtros cuando cambian los selects
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('#sector, #pais, #activo');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>