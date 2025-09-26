<?php
/**
 * VISTA: EDITAR AUDITORÍA
 * =======================
 * 
 * Formulario para editar una auditoría SEO existente
 */

// Verificar que tenemos los datos necesarios
$auditoria = $auditoria ?? [];
$clientes = $clientes ?? [];
$usuarios = $usuarios ?? [];
$fases = $fases ?? [];
$error = $error ?? '';
$errores = $errores ?? [];

if (empty($auditoria)) {
    echo '<div class="alert alert-danger">Error: No se pudo cargar la auditoría.</div>';
    return;
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Editar Auditoría SEO: <?= htmlspecialchars($auditoria['titulo'] ?? $auditoria['nombre'] ?? 'Sin título') ?>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="?modulo=auditorias&accion=editar&id=<?= $auditoria['id'] ?>" class="needs-validation" novalidate>
                        <?= generarCampoCSRF() ?>
                        <input type="hidden" name="accion" value="editar_auditoria">
                        <input type="hidden" name="id" value="<?= $auditoria['id'] ?>">
                        
                        <div class="row">
                            <!-- Información básica -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Información Básica</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre de la Auditoría *</label>
                                            <input type="text" 
                                                   class="form-control <?= isset($errores['nombre']) ? 'is-invalid' : '' ?>" 
                                                   id="nombre" 
                                                   name="nombre" 
                                                   value="<?= htmlspecialchars($_POST['nombre'] ?? $auditoria['titulo'] ?? $auditoria['nombre'] ?? '') ?>"
                                                   required>
                                            <?php if (isset($errores['nombre'])): ?>
                                                <div class="invalid-feedback"><?= $errores['nombre'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <textarea class="form-control" 
                                                      id="descripcion" 
                                                      name="descripcion" 
                                                      rows="3"><?= htmlspecialchars($_POST['descripcion'] ?? $auditoria['descripcion'] ?? '') ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="url_principal" class="form-label">URL Principal *</label>
                                            <input type="url" 
                                                   class="form-control <?= isset($errores['url_principal']) ? 'is-invalid' : '' ?>" 
                                                   id="url_principal" 
                                                   name="url_principal" 
                                                   value="<?= htmlspecialchars($_POST['url_principal'] ?? $auditoria['url_principal'] ?? '') ?>"
                                                   required>
                                            <?php if (isset($errores['url_principal'])): ?>
                                                <div class="invalid-feedback"><?= $errores['url_principal'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select class="form-select" id="estado" name="estado">
                                                <option value="pendiente" <?= (($_POST['estado'] ?? $auditoria['estado'] ?? '') == 'pendiente') ? 'selected' : '' ?>>Pendiente</option>
                                                <option value="en_progreso" <?= (($_POST['estado'] ?? $auditoria['estado'] ?? '') == 'en_progreso') ? 'selected' : '' ?>>En Progreso</option>
                                                <option value="completada" <?= (($_POST['estado'] ?? $auditoria['estado'] ?? '') == 'completada') ? 'selected' : '' ?>>Completada</option>
                                                <option value="pausada" <?= (($_POST['estado'] ?? $auditoria['estado'] ?? '') == 'pausada') ? 'selected' : '' ?>>Pausada</option>
                                                <option value="cancelada" <?= (($_POST['estado'] ?? $auditoria['estado'] ?? '') == 'cancelada') ? 'selected' : '' ?>>Cancelada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Asignación -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Asignación</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="cliente_id" class="form-label">Cliente *</label>
                                            <select class="form-select <?= isset($errores['cliente_id']) ? 'is-invalid' : '' ?>" 
                                                    id="cliente_id" 
                                                    name="cliente_id" 
                                                    required>
                                                <option value="">Seleccionar cliente...</option>
                                                <?php foreach ($clientes as $cliente): ?>
                                                    <option value="<?= $cliente['id'] ?>" 
                                                            <?= (($_POST['cliente_id'] ?? $auditoria['cliente_id'] ?? '') == $cliente['id']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($cliente['nombre_empresa'] ?? $cliente['nombre'] ?? '') ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errores['cliente_id'])): ?>
                                                <div class="invalid-feedback"><?= $errores['cliente_id'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="usuario_id" class="form-label">Responsable *</label>
                                            <select class="form-select <?= isset($errores['usuario_id']) ? 'is-invalid' : '' ?>" 
                                                    id="usuario_id" 
                                                    name="usuario_id" 
                                                    required>
                                                <option value="">Seleccionar responsable...</option>
                                                <?php foreach ($usuarios as $usuario): ?>
                                                    <option value="<?= $usuario['id'] ?>" 
                                                            <?= (($_POST['usuario_id'] ?? $auditoria['usuario_id'] ?? '') == $usuario['id']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($usuario['nombre']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errores['usuario_id'])): ?>
                                                <div class="invalid-feedback"><?= $errores['usuario_id'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="prioridad" class="form-label">Prioridad</label>
                                            <select class="form-select" id="prioridad" name="prioridad">
                                                <option value="baja" <?= (($_POST['prioridad'] ?? $auditoria['prioridad'] ?? 'media') == 'baja') ? 'selected' : '' ?>>Baja</option>
                                                <option value="media" <?= (($_POST['prioridad'] ?? $auditoria['prioridad'] ?? 'media') == 'media') ? 'selected' : '' ?>>Media</option>
                                                <option value="alta" <?= (($_POST['prioridad'] ?? $auditoria['prioridad'] ?? 'media') == 'alta') ? 'selected' : '' ?>>Alta</option>
                                                <option value="critica" <?= (($_POST['prioridad'] ?? $auditoria['prioridad'] ?? 'media') == 'critica') ? 'selected' : '' ?>>Crítica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Fechas -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Fechas</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="fecha_inicio" class="form-label">Fecha de Inicio *</label>
                                            <input type="date" 
                                                   class="form-control <?= isset($errores['fecha_inicio']) ? 'is-invalid' : '' ?>" 
                                                   id="fecha_inicio" 
                                                   name="fecha_inicio" 
                                                   value="<?= $_POST['fecha_inicio'] ?? (isset($auditoria['fecha_inicio']) ? date('Y-m-d', strtotime($auditoria['fecha_inicio'])) : '') ?>"
                                                   required>
                                            <?php if (isset($errores['fecha_inicio'])): ?>
                                                <div class="invalid-feedback"><?= $errores['fecha_inicio'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fecha_estimada_fin" class="form-label">Fecha Estimada de Finalización</label>
                                            <input type="date" 
                                                   class="form-control" 
                                                   id="fecha_estimada_fin" 
                                                   name="fecha_estimada_fin" 
                                                   value="<?= $_POST['fecha_estimada_fin'] ?? (isset($auditoria['fecha_estimada_fin']) ? date('Y-m-d', strtotime($auditoria['fecha_estimada_fin'])) : '') ?>">
                                        </div>

                                        <?php if (isset($auditoria['fecha_fin']) && $auditoria['fecha_fin']): ?>
                                        <div class="mb-3">
                                            <label class="form-label">Fecha de Finalización Real</label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   value="<?= date('d/m/Y', strtotime($auditoria['fecha_fin'])) ?>"
                                                   readonly>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Progreso -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Progreso</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Porcentaje de Completado</label>
                                            <div class="progress mb-2">
                                                <div class="progress-bar" 
                                                     role="progressbar" 
                                                     style="width: <?= $auditoria['porcentaje_completado'] ?? 0 ?>%"
                                                     aria-valuenow="<?= $auditoria['porcentaje_completado'] ?? 0 ?>" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="100">
                                                    <?= round($auditoria['porcentaje_completado'] ?? 0) ?>%
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Fecha de Creación</label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   value="<?= isset($auditoria['fecha_creacion']) ? date('d/m/Y H:i', strtotime($auditoria['fecha_creacion'])) : '' ?>"
                                                   readonly>
                                        </div>

                                        <?php if (isset($auditoria['fecha_actualizacion']) && $auditoria['fecha_actualizacion']): ?>
                                        <div class="mb-3">
                                            <label class="form-label">Última Actualización</label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   value="<?= date('d/m/Y H:i', strtotime($auditoria['fecha_actualizacion'])) ?>"
                                                   readonly>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="?modulo=auditorias&accion=listar" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Volver a la Lista
                                </a>
                                <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria['id'] ?>" class="btn btn-info">
                                    <i class="fas fa-eye me-2"></i>Ver Detalles
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación del formulario
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>