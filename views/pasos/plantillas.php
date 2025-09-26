<?php
/**
 * VISTA: Gestión de Plantillas de Pasos
 * ====================================
 * 
 * Interfaz para gestionar las plantillas de pasos de auditoría SEO
 * organizadas por fases.
 */

// Verificar que se incluya desde el módulo correcto
if (!defined('MODULO_PASOS')) {
    define('MODULO_PASOS', true);
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Encabezado -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">
                        <i class="fas fa-list-check text-primary"></i>
                        Plantillas de Pasos
                    </h1>
                    <p class="text-muted mb-0">Gestiona las plantillas de pasos para las auditorías SEO</p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoStep">
                        <i class="fas fa-plus"></i> Nuevo Paso
                    </button>
                    <a href="?modulo=pasos&accion=importar" class="btn btn-outline-secondary">
                        <i class="fas fa-file-import"></i> Importar
                    </a>
                </div>
            </div>

            <!-- Mensajes de estado -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i>
                    Operación realizada exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['imported'])): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-file-import"></i>
                    Pasos importados correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= htmlspecialchars($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Contenido principal -->
            <?php if (empty($plantillas)): ?>
                <!-- Estado vacío -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-list-check fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">No hay plantillas de pasos</h4>
                    <p class="text-muted mb-4">
                        Comienza creando plantillas de pasos para organizar tus auditorías SEO.
                    </p>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoStep">
                            <i class="fas fa-plus"></i> Crear Primera Plantilla
                        </button>
                        <a href="?modulo=pasos&accion=importar" class="btn btn-outline-secondary">
                            <i class="fas fa-file-import"></i> Importar desde Archivos
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Lista de plantillas por fase -->
                <div class="row">
                    <?php foreach ($plantillas as $numeroFase => $fase): ?>
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <i class="fas fa-layer-group text-primary"></i>
                                            Fase <?= $numeroFase ?>: <?= htmlspecialchars($fase['nombre']) ?>
                                        </h5>
                                        <span class="badge bg-secondary">
                                            <?= count($fase['pasos']) ?> pasos
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($fase['pasos'])): ?>
                                        <div class="text-center py-3">
                                            <i class="fas fa-info-circle text-muted"></i>
                                            <span class="text-muted">No hay pasos definidos para esta fase</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Nombre</th>
                                                        <th>Descripción</th>
                                                        <th>Tiempo Est.</th>
                                                        <th>Crítico</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($fase['pasos'] as $paso): ?>
                                                        <tr>
                                                            <td>
                                                                <code><?= htmlspecialchars($paso['codigo_paso']) ?></code>
                                                            </td>
                                                            <td>
                                                                <strong><?= htmlspecialchars($paso['nombre']) ?></strong>
                                                            </td>
                                                            <td>
                                                                <span class="text-muted">
                                                                    <?= htmlspecialchars(substr($paso['descripcion'], 0, 100)) ?>
                                                                    <?= strlen($paso['descripcion']) > 100 ? '...' : '' ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php if ($paso['tiempo_estimado_horas']): ?>
                                                                    <span class="badge bg-info">
                                                                        <?= $paso['tiempo_estimado_horas'] ?>h
                                                                    </span>
                                                                <?php else: ?>
                                                                    <span class="text-muted">-</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($paso['es_critico']): ?>
                                                                    <span class="badge bg-danger">
                                                                        <i class="fas fa-exclamation-triangle"></i> Crítico
                                                                    </span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-secondary">Normal</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm">
                                                                    <button type="button" 
                                                                            class="btn btn-outline-primary btn-editar-paso"
                                                                            data-paso-id="<?= $paso['id'] ?>"
                                                                            data-bs-toggle="modal" 
                                                                            data-bs-target="#modalEditarStep"
                                                                            title="Editar">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" 
                                                                            class="btn btn-outline-danger btn-eliminar-paso"
                                                                            data-paso-id="<?= $paso['id'] ?>"
                                                                            data-paso-nombre="<?= htmlspecialchars($paso['nombre']) ?>"
                                                                            title="Eliminar">
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
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal para nuevo paso -->
<div class="modal fade" id="modalNuevoStep" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="accion_plantilla" value="crear">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus"></i> Nueva Plantilla de Paso
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fase_id" class="form-label">Fase *</label>
                                <select class="form-select" id="fase_id" name="fase_id" required>
                                    <option value="">Seleccionar fase...</option>
                                    <?php
                                    // Obtener todas las fases disponibles
                                    $fases = ejecutarConsulta("SELECT * FROM fases ORDER BY numero_fase");
                                    foreach ($fases as $fase):
                                    ?>
                                        <option value="<?= $fase['id'] ?>">
                                            Fase <?= $fase['numero_fase'] ?>: <?= htmlspecialchars($fase['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="codigo_paso" class="form-label">Código del Paso *</label>
                                <input type="text" class="form-control" id="codigo_paso" name="codigo_paso" 
                                       placeholder="Ej: F1_001" required>
                                <div class="form-text">Código único para identificar el paso</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Paso *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               placeholder="Nombre descriptivo del paso" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                  placeholder="Descripción detallada del paso"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="instrucciones" class="form-label">Instrucciones</label>
                        <textarea class="form-control" id="instrucciones" name="instrucciones" rows="4"
                                  placeholder="Instrucciones paso a paso para completar esta tarea"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tiempo_estimado_horas" class="form-label">Tiempo Estimado (horas)</label>
                                <input type="number" class="form-control" id="tiempo_estimado_horas" 
                                       name="tiempo_estimado_horas" step="0.5" min="0" placeholder="0.0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="es_critico" name="es_critico">
                                    <label class="form-check-label" for="es_critico">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                        Paso crítico
                                    </label>
                                    <div class="form-text">Los pasos críticos requieren atención especial</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Crear Plantilla
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para editar paso -->
<div class="modal fade" id="modalEditarStep" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="" id="formEditarPaso">
                <input type="hidden" name="accion_plantilla" value="actualizar">
                <input type="hidden" name="plantilla_id" id="edit_plantilla_id">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit"></i> Editar Plantilla de Paso
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre del Paso *</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_instrucciones" class="form-label">Instrucciones</label>
                        <textarea class="form-control" id="edit_instrucciones" name="instrucciones" rows="4"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tiempo_estimado_horas" class="form-label">Tiempo Estimado (horas)</label>
                                <input type="number" class="form-control" id="edit_tiempo_estimado_horas" 
                                       name="tiempo_estimado_horas" step="0.5" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="edit_es_critico" name="es_critico">
                                    <label class="form-check-label" for="edit_es_critico">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                        Paso crítico
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar edición de pasos
    document.querySelectorAll('.btn-editar-paso').forEach(btn => {
        btn.addEventListener('click', function() {
            const pasoId = this.dataset.pasoId;
            // Aquí se cargarían los datos del paso via AJAX
            // Por simplicidad, se deja la implementación básica
            document.getElementById('edit_plantilla_id').value = pasoId;
        });
    });
    
    // Manejar eliminación de pasos
    document.querySelectorAll('.btn-eliminar-paso').forEach(btn => {
        btn.addEventListener('click', function() {
            const pasoId = this.dataset.pasoId;
            const pasoNombre = this.dataset.pasoNombre;
            
            if (confirm(`¿Estás seguro de que deseas eliminar el paso "${pasoNombre}"?`)) {
                // Crear formulario para eliminar
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="accion_plantilla" value="eliminar">
                    <input type="hidden" name="plantilla_id" value="${pasoId}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>