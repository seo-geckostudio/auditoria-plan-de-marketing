<?php
/**
 * VISTA: CREAR AUDITORÍA
 * ======================
 * 
 * Formulario para crear una nueva auditoría SEO
 */

// Incluir funciones necesarias
require_once __DIR__ . '/../../includes/forms.php';

// Verificar que tenemos los datos necesarios
$clientes = $clientes ?? [];
$usuarios = $usuarios ?? [];
$fases = $fases ?? [];
$error = $error ?? '';
$errores = $errores ?? [];

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nueva Auditoría SEO
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="?modulo=auditorias&accion=crear" class="needs-validation" novalidate>
                        <?= generarCampoCSRF() ?>
                        <input type="hidden" name="accion" value="crear_auditoria">
                        
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
                                                   value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"
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
                                                      rows="3"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="url_principal" class="form-label">URL Principal *</label>
                                            <input type="url" 
                                                   class="form-control <?= isset($errores['url_principal']) ? 'is-invalid' : '' ?>" 
                                                   id="url_principal" 
                                                   name="url_principal" 
                                                   value="<?= htmlspecialchars($_POST['url_principal'] ?? '') ?>"
                                                   required>
                                            <?php if (isset($errores['url_principal'])): ?>
                                                <div class="invalid-feedback"><?= $errores['url_principal'] ?></div>
                                            <?php endif; ?>
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
                                                            <?= (($_POST['cliente_id'] ?? '') == $cliente['id']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($cliente['nombre']) ?>
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
                                                            <?= (($_POST['usuario_id'] ?? '') == $usuario['id']) ? 'selected' : '' ?>>
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
                                                <option value="baja" <?= (($_POST['prioridad'] ?? 'media') == 'baja') ? 'selected' : '' ?>>Baja</option>
                                                <option value="media" <?= (($_POST['prioridad'] ?? 'media') == 'media') ? 'selected' : '' ?>>Media</option>
                                                <option value="alta" <?= (($_POST['prioridad'] ?? 'media') == 'alta') ? 'selected' : '' ?>>Alta</option>
                                                <option value="critica" <?= (($_POST['prioridad'] ?? 'media') == 'critica') ? 'selected' : '' ?>>Crítica</option>
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
                                                   value="<?= $_POST['fecha_inicio'] ?? date('Y-m-d') ?>"
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
                                                   value="<?= $_POST['fecha_estimada_fin'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fases -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Fases a Incluir</h5>
                                        <?php if (!empty($fases)): ?>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" id="incluir-todas-fases">
                                                    <i class="fas fa-check-double me-1"></i>Incluir Todas
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary" id="limpiar-fases">
                                                    <i class="fas fa-times me-1"></i>Limpiar
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <?php if (empty($fases)): ?>
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                No hay fases disponibles. <a href="?modulo=pasos&accion=plantillas">Crear plantillas de pasos</a>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-info mb-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <strong>Recomendación:</strong> Para una auditoría completa, se recomienda incluir todas las fases.
                                            </div>
                                            <?php foreach ($fases as $fase): ?>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input fase-checkbox" 
                                                           type="checkbox" 
                                                           value="<?= $fase['id'] ?>" 
                                                           id="fase_<?= $fase['id'] ?>"
                                                           name="fases[]"
                                                           <?= in_array($fase['id'], $_POST['fases'] ?? []) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="fase_<?= $fase['id'] ?>">
                                                        <strong>Fase <?= $fase['numero_fase'] ?>: <?= htmlspecialchars($fase['nombre']) ?></strong>
                                                        <?php if ($fase['descripcion']): ?>
                                                            <br><small class="text-muted"><?= htmlspecialchars($fase['descripcion']) ?></small>
                                                        <?php endif; ?>
                                                        <?php if (isset($fase['total_pasos'])): ?>
                                                            <br><small class="badge bg-secondary"><?= $fase['total_pasos'] ?> pasos</small>
                                                        <?php endif; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Configuración adicional -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Configuración Adicional</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           value="1" 
                                           id="notificaciones"
                                           name="notificaciones"
                                           <?= (($_POST['notificaciones'] ?? true)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="notificaciones">
                                        Enviar notificaciones por email
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="?modulo=auditorias&accion=listar" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Crear Auditoría
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

// Auto-generar nombre basado en cliente y fecha
document.getElementById('cliente_id').addEventListener('change', function() {
    const nombreInput = document.getElementById('nombre');
    if (!nombreInput.value) {
        const clienteSelect = this;
        const clienteNombre = clienteSelect.options[clienteSelect.selectedIndex].text;
        const fecha = new Date().toLocaleDateString('es-ES');
        if (clienteNombre !== 'Seleccionar cliente...') {
            nombreInput.value = `Auditoría SEO - ${clienteNombre} - ${fecha}`;
        }
    }
});

// Funcionalidad para incluir/limpiar todas las fases
document.addEventListener('DOMContentLoaded', function() {
    const incluirTodasBtn = document.getElementById('incluir-todas-fases');
    const limpiarFasesBtn = document.getElementById('limpiar-fases');
    const faseCheckboxes = document.querySelectorAll('.fase-checkbox');

    if (incluirTodasBtn) {
        incluirTodasBtn.addEventListener('click', function() {
            faseCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            
            // Mostrar mensaje de confirmación
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show mt-2';
            alert.innerHTML = `
                <i class="fas fa-check me-2"></i>
                Todas las fases han sido seleccionadas para una auditoría completa.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            this.closest('.card-body').insertBefore(alert, this.closest('.card-body').firstChild);
            
            // Auto-remover el mensaje después de 3 segundos
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 3000);
        });
    }

    if (limpiarFasesBtn) {
        limpiarFasesBtn.addEventListener('click', function() {
            faseCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        });
    }
});
</script>