<?php
/**
 * VISTA: FORMULARIO DINÁMICO PARA PASO DE AUDITORÍA
 * ==================================================
 *
 * Vista que genera formularios dinámicos basados en la configuración
 * de campos definida en la base de datos para cada paso
 */

// Verificar que se ha incluido desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

require_once __DIR__ . '/../../modules/formularios.php';

// Obtener parámetros
$auditoria_id = (int)($_GET['auditoria_id'] ?? 0);
$paso_id = (int)($_GET['paso_id'] ?? 0);

if (!$auditoria_id || !$paso_id) {
    echo '<div class="alert alert-danger">Parámetros incorrectos</div>';
    return;
}

// Obtener información del paso
$sql_paso = "
    SELECT
        ap.*,
        pp.nombre as paso_nombre,
        pp.descripcion as paso_descripcion,
        pp.instrucciones as paso_instrucciones,
        pp.codigo_paso,
        a.titulo as nombre_auditoria,
        c.nombre_empresa
    FROM auditoria_pasos ap
    JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
    JOIN auditorias a ON ap.auditoria_id = a.id
    JOIN clientes c ON a.cliente_id = c.id
    WHERE ap.id = ? AND ap.auditoria_id = ?
";

$paso_info = obtenerRegistro($sql_paso, [$paso_id, $auditoria_id]);

if (!$paso_info) {
    echo '<div class="alert alert-danger">Paso no encontrado</div>';
    return;
}

// Obtener campos del formulario
$campos = obtenerCamposPaso($paso_info['paso_plantilla_id']);

if (empty($campos)) {
    echo '<div class="alert alert-warning">No hay campos configurados para este paso</div>';
    return;
}

// Obtener valores ya guardados
$valores_guardados = obtenerValoresPaso($paso_id);

// Calcular progreso
$porcentaje_completado = calcularCompletitudFormulario($paso_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario: <?= htmlspecialchars($paso_info['paso_nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .progress-indicator {
            background: linear-gradient(90deg, #28a745 0%, #28a745 <?= $porcentaje_completado ?>%, #e9ecef <?= $porcentaje_completado ?>%, #e9ecef 100%);
            height: 8px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .campo-obligatorio {
            border-left: 3px solid #dc3545;
        }
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .save-indicator {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header con navegación -->
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?modulo=auditorias&accion=listar">Auditorías</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria_id ?>">
                                <?= htmlspecialchars($paso_info['nombre_auditoria']) ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= htmlspecialchars($paso_info['paso_nombre']) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Información del paso -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">
                                    <i class="fas fa-edit text-primary"></i>
                                    <?= htmlspecialchars($paso_info['paso_nombre']) ?>
                                </h4>
                                <small class="text-muted">
                                    Cliente: <?= htmlspecialchars($paso_info['nombre_empresa']) ?> |
                                    Código: <?= htmlspecialchars($paso_info['codigo_paso']) ?>
                                </small>
                            </div>
                            <div class="text-end">
                                <div class="progress-indicator"></div>
                                <small class="text-muted">Completado: <?= round($porcentaje_completado, 1) ?>%</small>
                            </div>
                        </div>
                    </div>

                    <?php if ($paso_info['paso_descripcion'] || $paso_info['paso_instrucciones']): ?>
                    <div class="card-body">
                        <?php if ($paso_info['paso_descripcion']): ?>
                            <p class="mb-2"><?= nl2br(htmlspecialchars($paso_info['paso_descripcion'])) ?></p>
                        <?php endif; ?>

                        <?php if ($paso_info['paso_instrucciones']): ?>
                            <div class="alert alert-info">
                                <h6><i class="fas fa-info-circle"></i> Instrucciones:</h6>
                                <?= nl2br(htmlspecialchars($paso_info['paso_instrucciones'])) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Formulario dinámico -->
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form id="formulario-dinamico" class="form-section">
                    <input type="hidden" name="auditoria_id" value="<?= $auditoria_id ?>">
                    <input type="hidden" name="paso_id" value="<?= $paso_id ?>">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5><i class="fas fa-clipboard-list"></i> Datos del Formulario</h5>
                        <div>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="limpiarFormulario()">
                                <i class="fas fa-eraser"></i> Limpiar
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="previsualizarDatos()">
                                <i class="fas fa-eye"></i> Vista previa
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-sm" onclick="mostrarAyuda()">
                                <i class="fas fa-question-circle"></i> Ayuda
                            </button>
                        </div>
                    </div>

                    <!-- Campos dinámicos -->
                    <div id="campos-formulario">
                        <?php foreach ($campos as $campo): ?>
                            <div class="<?= $campo['obligatorio'] ? 'campo-obligatorio' : '' ?> p-3 mb-3 border rounded">
                                <?= generarCampoFormulario($campo, $valores_guardados) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Botones de acción -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-save"></i> Guardar Datos
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary w-100" onclick="guardarYContinuar()">
                                <i class="fas fa-arrow-right"></i> Guardar y Continuar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Panel lateral con información adicional -->
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6><i class="fas fa-info-circle"></i> Información del Paso</h6>
                </div>
                <div class="card-body">
                    <p><strong>Estado:</strong>
                        <span class="badge bg-<?= $paso_info['estado'] == 'completado' ? 'success' : ($paso_info['estado'] == 'en_progreso' ? 'warning' : 'secondary') ?>">
                            <?= ucfirst($paso_info['estado']) ?>
                        </span>
                    </p>
                    <p><strong>Campos totales:</strong> <?= count($campos) ?></p>
                    <p><strong>Campos obligatorios:</strong>
                        <?= count(array_filter($campos, function($c) { return $c['obligatorio']; })) ?>
                    </p>
                    <p><strong>Última actualización:</strong><br>
                        <small><?= $paso_info['fecha_actualizacion'] ?? 'Nunca' ?></small>
                    </p>

                    <hr>

                    <h6>Acciones adicionales:</h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm" onclick="exportarDatos('json')">
                            <i class="fas fa-download"></i> Exportar JSON
                        </button>
                        <button class="btn btn-outline-success btn-sm" onclick="exportarDatos('excel')">
                            <i class="fas fa-file-excel"></i> Exportar Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de vista previa -->
    <div class="modal fade" id="modalVistaPrevia" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vista Previa de Datos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <pre id="datos-preview" class="bg-light p-3 rounded"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="copiarDatos()">
                        <i class="fas fa-copy"></i> Copiar JSON
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicador de guardado -->
    <div id="save-indicator" class="save-indicator"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Variables globales
        let autoSaveTimer;
        let cambiosPendientes = false;

        // Inicializar cuando carga la página
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar auto-guardado
            const campos = document.querySelectorAll('#formulario-dinamico input, #formulario-dinamico textarea, #formulario-dinamico select');
            campos.forEach(campo => {
                campo.addEventListener('input', function() {
                    cambiosPendientes = true;
                    mostrarIndicadorCambios();
                    programarAutoGuardado();
                });
            });

            // Configurar envío del formulario
            document.getElementById('formulario-dinamico').addEventListener('submit', function(e) {
                e.preventDefault();
                guardarFormulario();
            });
        });

        // Función principal para guardar
        function guardarFormulario() {
            const formData = new FormData(document.getElementById('formulario-dinamico'));

            mostrarIndicador('Guardando...', 'info');

            fetch('api/guardar_formulario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarIndicador('✓ Guardado correctamente', 'success');
                    cambiosPendientes = false;
                    actualizarProgreso(data.porcentaje_completado);
                } else {
                    mostrarIndicador('✗ Error: ' + data.message, 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarIndicador('✗ Error de conexión', 'danger');
            });
        }

        // Auto-guardado cada 30 segundos
        function programarAutoGuardado() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                if (cambiosPendientes) {
                    guardarFormulario();
                }
            }, 30000);
        }

        // Guardar y continuar al siguiente paso
        function guardarYContinuar() {
            guardarFormulario();
            // TODO: Implementar navegación al siguiente paso
            setTimeout(() => {
                window.location.href = '?modulo=auditorias&accion=ver&id=<?= $auditoria_id ?>';
            }, 1500);
        }

        // Limpiar formulario
        function limpiarFormulario() {
            if (confirm('¿Estás seguro de que quieres limpiar todos los campos?')) {
                document.getElementById('formulario-dinamico').reset();
                cambiosPendientes = true;
                mostrarIndicadorCambios();
            }
        }

        // Vista previa de datos
        function previsualizarDatos() {
            const formData = new FormData(document.getElementById('formulario-dinamico'));
            const datos = {};

            for (let [key, value] of formData.entries()) {
                if (key.startsWith('campos[')) {
                    const campoId = key.match(/campos\[(\d+)\]/)[1];
                    const etiqueta = document.querySelector(`label[for="campo_${campoId}"]`).textContent.replace(' *', '');
                    datos[etiqueta] = value;
                }
            }

            document.getElementById('datos-preview').textContent = JSON.stringify(datos, null, 2);
            new bootstrap.Modal(document.getElementById('modalVistaPrevia')).show();
        }

        // Exportar datos
        function exportarDatos(formato) {
            window.open(`api/exportar_formulario.php?paso_id=<?= $paso_id ?>&formato=${formato}`, '_blank');
        }

        // Copiar datos al portapapeles
        function copiarDatos() {
            navigator.clipboard.writeText(document.getElementById('datos-preview').textContent);
            mostrarIndicador('✓ Datos copiados al portapapeles', 'success');
        }

        // Mostrar indicador de estado
        function mostrarIndicador(mensaje, tipo) {
            const indicator = document.getElementById('save-indicator');
            indicator.innerHTML = `
                <div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
                    ${mensaje}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

            // Auto-ocultar después de 3 segundos
            setTimeout(() => {
                const alert = indicator.querySelector('.alert');
                if (alert) {
                    alert.remove();
                }
            }, 3000);
        }

        // Mostrar indicador de cambios pendientes
        function mostrarIndicadorCambios() {
            if (cambiosPendientes) {
                document.title = '● ' + document.title.replace('● ', '');
            }
        }

        // Actualizar progreso visual
        function actualizarProgreso(porcentaje) {
            const progressBar = document.querySelector('.progress-indicator');
            if (progressBar) {
                progressBar.style.background = `linear-gradient(90deg, #28a745 0%, #28a745 ${porcentaje}%, #e9ecef ${porcentaje}%, #e9ecef 100%)`;
            }
        }

        // Prevenir pérdida de datos al cerrar ventana
        window.addEventListener('beforeunload', function(e) {
            if (cambiosPendientes) {
                e.preventDefault();
                e.returnValue = '';
                return 'Tienes cambios sin guardar. ¿Estás seguro de que quieres salir?';
            }
        });

        // Mostrar ayuda contextual
        function mostrarAyuda() {
            const url = `?modulo=ayuda&accion=paso&paso_id=<?= $paso_id ?>`;
            window.open(url, 'ayuda', 'width=1200,height=800,scrollbars=yes,resizable=yes');
        }
    </script>
</body>
</html>