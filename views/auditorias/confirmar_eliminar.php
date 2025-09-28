<?php
/**
 * VISTA: CONFIRMACIÓN DE ELIMINACIÓN DE AUDITORÍA
 * ===============================================
 *
 * Vista que solicita confirmación antes de eliminar una auditoría
 */

// Verificar que se ha incluido desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

// La variable $auditoria debe estar disponible
if (!isset($auditoria) || !$auditoria) {
    echo '<div class="alert alert-danger">No se encontró la auditoría especificada.</div>';
    return;
}
?>

<style>
    .danger-zone {
        border: 2px solid #dc3545;
        border-radius: 8px;
        background-color: #fff5f5;
    }
    .audit-info {
        background-color: #f8f9fa;
        border-radius: 6px;
        padding: 1rem;
    }

    /* Estilos mejorados para botones - Máxima especificidad */
    button.btn.btn-danger:not(:disabled),
    button.btn.btn-danger:not([disabled]) {
        cursor: pointer !important;
    }

    button.btn.btn-danger:disabled,
    button.btn.btn-danger[disabled],
    button.btn:disabled,
    button.btn[disabled] {
        cursor: not-allowed !important;
        opacity: 0.6 !important;
        pointer-events: auto !important; /* Permitir eventos para mostrar cursor */
    }

    button.btn-danger:disabled,
    button.btn-danger[disabled] {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        color: #fff !important;
        opacity: 0.5 !important;
    }

    button.btn-danger:not(:disabled):hover,
    button.btn-danger:not([disabled]):hover {
        cursor: pointer !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    /* Forzar cursor en el botón específico */
    #btn-eliminar:disabled,
    #btn-eliminar[disabled],
    #btn-eliminar.btn-disabled {
        cursor: not-allowed !important;
    }

    #btn-eliminar:not(:disabled),
    #btn-eliminar:not([disabled]),
    #btn-eliminar.btn-enabled {
        cursor: pointer !important;
    }

    /* Clases auxiliares para forzar cursores */
    .btn-disabled {
        cursor: not-allowed !important;
    }

    .btn-enabled {
        cursor: pointer !important;
    }

    /* Aplicar a toda la página para debug */
    * {
        /* Para debug - comentar en producción */
        /* outline: 1px solid rgba(255,0,0,0.1); */
    }

    /* Prevenir selección de texto en elementos UI */
    .card-body h6, .card-body p, .card-body ul, .card-body li {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    /* Permitir selección solo en texto importante */
    .audit-info p {
        user-select: text;
        -webkit-user-select: text;
        -moz-user-select: text;
        -ms-user-select: text;
    }
</style>

<div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?modulo=auditorias&accion=listar">Auditorías</a>
                        </li>
                        <li class="breadcrumb-item active">Eliminar Auditoría</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Zona de peligro -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="danger-zone p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-triangle text-danger" style="font-size: 4rem;"></i>
                        <h2 class="text-danger mt-3">¡Atención!</h2>
                        <h4>Estás a punto de eliminar una auditoría</h4>
                    </div>

                    <!-- Información de la auditoría -->
                    <div class="audit-info mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-info-circle text-primary"></i>
                            Información de la Auditoría
                        </h5>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nombre:</strong><br>
                                   <?= htmlspecialchars($auditoria['nombre_auditoria'] ?? $auditoria['titulo'] ?? 'Sin nombre') ?>
                                </p>
                                <p><strong>Cliente:</strong><br>
                                   <?= htmlspecialchars($auditoria['cliente_nombre'] ?? 'Sin especificar') ?>
                                </p>
                                <p><strong>Estado:</strong><br>
                                   <span class="badge bg-<?= $auditoria['estado'] == 'completada' ? 'success' : ($auditoria['estado'] == 'en_progreso' ? 'primary' : 'secondary') ?>">
                                       <?= ucfirst($auditoria['estado']) ?>
                                   </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Fecha creación:</strong><br>
                                   <?= date('d/m/Y H:i', strtotime($auditoria['fecha_creacion'])) ?>
                                </p>
                                <p><strong>Progreso:</strong><br>
                                   <?= round($auditoria['porcentaje_completado'], 1) ?>% completado
                                </p>
                                <p><strong>ID:</strong><br>
                                   #<?= $auditoria['id'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Advertencia -->
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle"></i> Esta acción es irreversible</h6>
                        <p class="mb-2">Al eliminar esta auditoría se borrarán <strong>permanentemente</strong>:</p>
                        <ul class="mb-0">
                            <li>Todos los datos de formularios introducidos</li>
                            <li>Archivos subidos relacionados</li>
                            <li>Datos CSV importados</li>
                            <li>Comentarios y notas</li>
                            <li>Historial de cambios</li>
                            <li>Configuración de pasos personalizados</li>
                        </ul>
                    </div>

                    <!-- Formulario de confirmación -->
                    <form method="POST" id="form-eliminar">
                        <input type="hidden" name="auditoria_id" value="<?= $auditoria['id'] ?>">

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="confirmar-eliminacion" required>
                            <label class="form-check-label fw-bold" for="confirmar-eliminacion">
                                Entiendo que esta acción es irreversible y quiero proceder con la eliminación
                            </label>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="?modulo=auditorias&accion=listar" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria['id'] ?>" class="btn btn-info me-md-2">
                                <i class="fas fa-eye"></i> Ver Auditoría
                            </a>
                            <button type="submit" name="confirmar" value="1" class="btn btn-danger" id="btn-eliminar" disabled>
                                <i class="fas fa-trash"></i> Eliminar Definitivamente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h6><i class="fas fa-lightbulb text-warning"></i> Alternativas a la eliminación</h6>
                        <p class="mb-2">Antes de eliminar, considera estas opciones:</p>
                        <ul class="mb-0">
                            <li><strong>Archivar:</strong> Cambia el estado a "Cancelada" para mantener el registro</li>
                            <li><strong>Duplicar:</strong> Crea una copia para reutilizar la estructura</li>
                            <li><strong>Exportar:</strong> Descarga los datos antes de eliminar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('confirmar-eliminacion');
    const btnEliminar = document.getElementById('btn-eliminar');
    const form = document.getElementById('form-eliminar');

    // Habilitar/deshabilitar botón según checkbox con feedback visual
    checkbox.addEventListener('change', function() {
        btnEliminar.disabled = !this.checked;

        if (this.checked) {
            btnEliminar.style.cursor = 'pointer !important';
            btnEliminar.style.opacity = '1';
            btnEliminar.title = 'Clic para eliminar definitivamente';
            btnEliminar.classList.remove('btn-disabled');
            btnEliminar.classList.add('btn-enabled');
        } else {
            btnEliminar.style.cursor = 'not-allowed !important';
            btnEliminar.style.opacity = '0.5';
            btnEliminar.title = 'Debes confirmar la eliminación primero';
            btnEliminar.classList.remove('btn-enabled');
            btnEliminar.classList.add('btn-disabled');
        }
    });

    // Feedback visual al pasar el mouse por el botón deshabilitado
    btnEliminar.addEventListener('mouseover', function() {
        if (this.disabled) {
            this.style.opacity = '0.7';
            if (!checkbox.checked) {
                // Resaltar brevemente el checkbox
                checkbox.parentElement.style.border = '2px solid #dc3545';
                checkbox.parentElement.style.borderRadius = '4px';
                checkbox.parentElement.style.padding = '5px';

                setTimeout(() => {
                    checkbox.parentElement.style.border = '';
                    checkbox.parentElement.style.borderRadius = '';
                    checkbox.parentElement.style.padding = '';
                }, 1500);
            }
        }
    });

    btnEliminar.addEventListener('mouseout', function() {
        if (this.disabled) {
            this.style.opacity = '0.5';
        }
    });

    // Confirmación adicional al enviar
    form.addEventListener('submit', function(e) {
        if (!confirm('¿Estás completamente seguro de que quieres eliminar esta auditoría?\n\nEsta acción NO se puede deshacer.')) {
            e.preventDefault();
            return false;
        }

        // NO deshabilitar el botón aquí - permitir que el form se envíe
        // El indicador visual se puede añadir sin deshabilitar
        btnEliminar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Eliminando...';

        // Usar setTimeout para deshabilitar después del envío
        setTimeout(function() {
            btnEliminar.disabled = true;
        }, 10);
    });

    // Prevenir envío accidental con Enter
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.type !== 'submit' && e.target.type !== 'checkbox') {
            e.preventDefault();
        }
    });

    // Inicializar estado del botón
    btnEliminar.style.cursor = 'not-allowed !important';
    btnEliminar.style.opacity = '0.5';
    btnEliminar.title = 'Debes confirmar la eliminación primero';
    btnEliminar.classList.add('btn-disabled');

    // Forzar aplicación de estilos después de un pequeño delay
    setTimeout(function() {
        if (btnEliminar.disabled) {
            btnEliminar.style.setProperty('cursor', 'not-allowed', 'important');
            btnEliminar.classList.add('btn-disabled');
        }
    }, 100);
});
</script>