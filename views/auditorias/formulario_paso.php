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
        pp.es_critico,
        pp.orden_en_fase,
        f.numero_fase,
        a.titulo as nombre_auditoria,
        c.nombre_empresa
    FROM auditoria_pasos ap
    JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
    JOIN fases f ON pp.fase_id = f.id
    JOIN auditorias a ON ap.auditoria_id = a.id
    JOIN clientes c ON a.cliente_id = c.id
    WHERE ap.id = ? AND ap.auditoria_id = ?
";

$paso_info = obtenerRegistro($sql_paso, [$paso_id, $auditoria_id]);

// Obtener todos los pasos para generar descripción dinámica
if ($paso_info) {
    $fases = obtenerPasosPorFase($auditoria_id);
    $todosPasos = [];
    foreach ($fases as $fase) {
        foreach ($fase['pasos'] as $paso) {
            $todosPasos[] = $paso;
        }
    }

    // Generar descripción dinámica para este paso específico
    $paso_info['descripcion_dinamica'] = generarDescripcionPaso($paso_info, $todosPasos);
}

if (!$paso_info) {
    echo '<div class="alert alert-danger">Paso no encontrado</div>';
    return;
}

/**
 * Genera plantilla JSON para IA externa con descripción de campos
 */
function generarPlantillaIA($campos) {
    $plantilla = [];
    foreach ($campos as $campo) {
        $nombre_campo = $campo['nombre'] ?? $campo['campo'] ?? 'campo_ejemplo';
        $label = $campo['label'] ?? $campo['titulo'] ?? $nombre_campo;
        $descripcion = $campo['descripcion'] ?? $campo['ayuda'] ?? '';

        // Generar descripción más clara para IA
        $descripcion_ia = generarDescripcionCampoIA($campo, $label, $descripcion);
        $plantilla[$nombre_campo] = $descripcion_ia;
    }

    return json_encode($plantilla, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

/**
 * Genera descripción específica para cada tipo de campo que IA pueda entender
 */
function generarDescripcionCampoIA($campo, $label, $descripcion) {
    $tipo = $campo['tipo'] ?? 'text';
    $obligatorio = ($campo['obligatorio'] ?? false) ? 'obligatorio' : 'opcional';
    $limite = '';

    if (isset($campo['max_length']) && $campo['max_length'] > 0) {
        $limite = " de máximo {$campo['max_length']} caracteres";
    }

    $base_description = "";

    switch ($tipo) {
        case 'text':
            $base_description = "Campo de texto{$limite}";
            break;
        case 'textarea':
            $base_description = "Texto largo{$limite}";
            break;
        case 'number':
            $base_description = "Valor numérico";
            break;
        case 'select':
            $opciones = isset($campo['opciones']) ? implode(', ', $campo['opciones']) : 'ver opciones disponibles';
            $base_description = "Selección única entre: {$opciones}";
            break;
        case 'checkbox':
            $base_description = "Valor verdadero/falso (true/false)";
            break;
        case 'date':
            $base_description = "Fecha en formato YYYY-MM-DD";
            break;
        case 'url':
            $base_description = "URL válida (incluir http:// o https://)";
            break;
        case 'email':
            $base_description = "Dirección de email válida";
            break;
        default:
            $base_description = "Campo de texto";
    }

    // Combinar información
    $descripcion_completa = "{$base_description} ({$obligatorio})";

    if ($descripcion) {
        $descripcion_completa .= " - {$descripcion}";
    }

    $campo_nombre = $campo['nombre'] ?? $campo['campo'] ?? '';
    if ($label && $label !== $campo_nombre) {
        $descripcion_completa = "{$label}: {$descripcion_completa}";
    }

    return $descripcion_completa;
}

/**
 * Genera un ejemplo de JSON simple para importación directa
 */
function generarEjemploJSON($campos) {
    $ejemplo = [];
    foreach ($campos as $campo) {
        $nombre_campo = $campo['nombre'] ?? $campo['campo'] ?? 'campo_ejemplo';

        switch ($campo['tipo']) {
            case 'text':
            case 'textarea':
                $ejemplo[$nombre_campo] = 'Contenido de ejemplo para ' . $nombre_campo;
                break;
            case 'number':
                $ejemplo[$nombre_campo] = 100;
                break;
            case 'select':
                $ejemplo[$nombre_campo] = 'opcion_seleccionada';
                break;
            case 'checkbox':
                $ejemplo[$nombre_campo] = true;
                break;
            case 'date':
                $ejemplo[$nombre_campo] = '2025-09-28';
                break;
            case 'url':
                $ejemplo[$nombre_campo] = 'https://ejemplo.com';
                break;
            case 'email':
                $ejemplo[$nombre_campo] = 'ejemplo@dominio.com';
                break;
            default:
                $ejemplo[$nombre_campo] = 'valor_de_ejemplo';
        }
    }

    return json_encode($ejemplo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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

                    <?php if ($paso_info['descripcion_dinamica'] || $paso_info['paso_descripcion'] || $paso_info['paso_instrucciones']): ?>
                    <div class="card-body">
                        <?php if ($paso_info['descripcion_dinamica']): ?>
                            <div class="alert alert-info mb-3" style="background-color: #e8f5e8; border-color: #d4e6d4;">
                                <strong>📋 Estado del Paso:</strong> <?= htmlspecialchars($paso_info['descripcion_dinamica']) ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($paso_info['paso_descripcion']): ?>
                            <p class="mb-2"><?= nl2br(htmlspecialchars($paso_info['paso_descripcion'])) ?></p>
                        <?php endif; ?>

                        <?php if ($paso_info['paso_instrucciones']): ?>
                            <!-- Sección de instrucciones colapsable para evitar confusión -->
                            <div class="alert alert-light border" id="instrucciones-section" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="fas fa-info-circle"></i> Ver Plantilla del Brief</h6>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ocultarInstrucciones()">
                                        <i class="fas fa-times"></i> Ocultar
                                    </button>
                                </div>
                                <hr>
                                <div class="small" style="max-height: 400px; overflow-y: auto;">
                                    <?= nl2br(htmlspecialchars($paso_info['paso_instrucciones'])) ?>
                                </div>
                            </div>

                            <!-- Botón para mostrar la plantilla si es necesario -->
                            <div class="alert alert-secondary" id="mostrar-plantilla-btn">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6><i class="fas fa-file-alt"></i> Plantilla de Brief Disponible</h6>
                                        <p class="mb-0 small text-muted">¿Necesitas ver la plantilla completa del brief del cliente?</p>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="mostrarInstrucciones()">
                                        <i class="fas fa-eye"></i> Ver Plantilla
                                    </button>
                                </div>
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

                    <!-- Sección de Asistencia con IA -->
                    <div class="card mb-4">
                        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <h6 class="mb-0">
                                <i class="fas fa-robot"></i> Asistencia con Inteligencia Artificial
                                <button type="button" class="btn btn-sm btn-outline-light float-end" onclick="toggleImportacion()">
                                    <i class="fas fa-chevron-down" id="toggle-icon"></i>
                                </button>
                            </h6>
                        </div>
                        <div class="card-body" id="seccion-importacion" style="display: none;">
                            <p class="text-muted mb-4">
                                <i class="fas fa-lightbulb text-warning"></i>
                                <strong>Rellena automáticamente este formulario usando IA:</strong> Elige el método que mejor se adapte a tu flujo de trabajo.
                            </p>

                            <!-- Tres opciones principales -->
                            <div class="row g-3">
                                <!-- Opción 1: Para enviar al cliente -->
                                <div class="col-lg-4">
                                    <div class="card h-100 border-primary">
                                        <div class="card-header bg-primary text-white text-center">
                                            <i class="fas fa-user-friends fa-2x mb-2"></i>
                                            <h6 class="mb-0">Para Cliente Remoto</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <p class="small text-muted">Genera plantilla para enviar al cliente y que use ChatGPT/Claude</p>
                                            <button type="button" class="btn btn-primary btn-sm w-100" onclick="generarPlantillaCliente()">
                                                <i class="fas fa-file-export"></i> Generar Plantilla IA
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Opción 2: Importación directa -->
                                <div class="col-lg-4">
                                    <div class="card h-100 border-success">
                                        <div class="card-header bg-success text-white text-center">
                                            <i class="fas fa-upload fa-2x mb-2"></i>
                                            <h6 class="mb-0">Importar JSON</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <p class="small text-muted">Importa datos ya procesados por IA externa</p>
                                            <button type="button" class="btn btn-success btn-sm w-100 mb-2" onclick="mostrarImportacion()">
                                                <i class="fas fa-file-upload"></i> Subir Archivo
                                            </button>
                                            <button type="button" class="btn btn-outline-success btn-sm w-100" onclick="mostrarTextarea()">
                                                <i class="fas fa-paste"></i> Pegar JSON
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Opción 3: IA Local (Claude) -->
                                <div class="col-lg-4">
                                    <div class="card h-100 border-warning">
                                        <div class="card-header bg-warning text-dark text-center">
                                            <i class="fas fa-magic fa-2x mb-2"></i>
                                            <h6 class="mb-0">IA Local (Claude)</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <p class="small text-muted">Búsqueda automática de información para revisión</p>
                                            <button type="button" class="btn btn-warning btn-sm w-100" onclick="buscarConIA()" <?php echo empty($auditoria['url_principal']) ? 'disabled title="Necesitas URL del cliente"' : ''; ?>>
                                                <i class="fas fa-search"></i> Buscar Automáticamente
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de contenido dinámico -->
                            <div id="contenido-dinamico" class="mt-4" style="display: none;">
                                <!-- Aquí se mostrará el contenido según la opción elegida -->
                            </div>

                            <!-- Botones de acción globales -->
                            <div class="d-flex gap-2 mt-3 pt-3 border-top" id="botones-accion" style="display: none;">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="limpiarFormulario()">
                                    <i class="fas fa-eraser"></i> Limpiar Todo
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm" onclick="exportarJSON()">
                                    <i class="fas fa-download"></i> Exportar JSON Actual
                                </button>
                            </div>
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

    <!-- Script específico para el brief del cliente si es el caso -->
    <?php if (strpos(strtolower($paso_info['codigo_paso'] ?? ''), 'brief') !== false ||
              strpos(strtolower($paso_info['paso_nombre'] ?? ''), 'brief') !== false): ?>
    <script src="js/brief_cliente_import.js"></script>
    <script src="js/ia_local_integration.js"></script>
    <?php endif; ?>

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

        // Mostrar notificación toast mejorada
        function mostrarNotificacion(mensaje, tipo = 'info', duracion = 3000) {
            // Crear contenedor de notificaciones si no existe
            let container = document.getElementById('notifications-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'notifications-container';
                container.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    max-width: 350px;
                `;
                document.body.appendChild(container);
            }

            // Crear notificación
            const notification = document.createElement('div');
            const notificationId = 'notification-' + Date.now();
            notification.id = notificationId;

            const tipoClass = {
                'success': 'alert-success',
                'error': 'alert-danger',
                'warning': 'alert-warning',
                'info': 'alert-info',
                'danger': 'alert-danger'
            }[tipo] || 'alert-info';

            const iconClass = {
                'success': 'fas fa-check-circle',
                'error': 'fas fa-exclamation-triangle',
                'warning': 'fas fa-exclamation-triangle',
                'info': 'fas fa-info-circle',
                'danger': 'fas fa-exclamation-triangle'
            }[tipo] || 'fas fa-info-circle';

            notification.innerHTML = `
                <div class="alert ${tipoClass} alert-dismissible fade show mb-2" role="alert" style="box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <i class="${iconClass} me-2"></i>
                    ${mensaje}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.getElementById('${notificationId}').remove()"></button>
                </div>
            `;

            container.appendChild(notification);

            // Auto-remover después del tiempo especificado
            setTimeout(() => {
                const element = document.getElementById(notificationId);
                if (element) {
                    element.remove();
                }
            }, duracion);
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

        // ===================================================
        // FUNCIONES DE ASISTENCIA CON IA
        // ===================================================

        // Toggle sección de importación
        function toggleImportacion() {
            const seccion = document.getElementById('seccion-importacion');
            const icon = document.getElementById('toggle-icon');

            if (seccion.style.display === 'none') {
                seccion.style.display = 'block';
                icon.className = 'fas fa-chevron-up';
            } else {
                seccion.style.display = 'none';
                icon.className = 'fas fa-chevron-down';
            }
        }

        // OPCIÓN 1: Generar plantilla para cliente remoto
        function generarPlantillaCliente() {
            const contenidoDinamico = document.getElementById('contenido-dinamico');
            const botonesAccion = document.getElementById('botones-accion');

            // Verificar si tenemos la funcionalidad específica del brief del cliente
            const esBriefCliente = "<?php
                $es_brief = (strpos(strtolower($paso_info['codigo_paso'] ?? ''), 'brief') !== false) ||
                           (strpos(strtolower($paso_info['paso_nombre'] ?? ''), 'brief') !== false);
                echo $es_brief ? 'true' : 'false';
            ?>" === 'true';

            let plantillaTexto = '';

            if (esBriefCliente && typeof generarPlantillaMejoradaCliente === 'function') {
                // Usar la plantilla mejorada específica para el brief del cliente
                plantillaTexto = generarPlantillaMejoradaCliente();
            } else {
                // Usar la plantilla genérica original
                const plantillaIA = <?php
                    echo json_encode(function_exists('generarPlantillaIA') && isset($campos) ? generarPlantillaIA($campos) : []);
                ?>;
                const nombrePaso = "<?php echo htmlspecialchars($paso_info['paso_nombre'] ?? 'Paso'); ?>";
                const nombreCliente = "<?php echo htmlspecialchars($paso_info['nombre_empresa'] ?? 'Cliente'); ?>";

                plantillaTexto = `📧 PARA: ${nombreCliente}
📌 ASUNTO: Información necesaria para ${nombrePaso}

Hola,

Para completar tu auditoría SEO, necesito que me proporciones información sobre "${nombrePaso}".

📝 INSTRUCCIONES:
1. Copia el JSON de campos que aparece abajo
2. Pégalo en ChatGPT o Claude junto con estas instrucciones:

💬 Prompt para la IA:
"Ayúdame a rellenar esta información sobre mi empresa. Te proporciono un JSON con los campos que necesito completar y sus descripciones. Por favor, pregúntame sobre cada campo y luego devuélveme un JSON final con las respuestas. Los campos son:

${JSON.stringify(plantillaIA, null, 2)}

🔄 Cuando tengas el JSON final de respuesta, envíamelo y yo lo importaré directamente al sistema.

Gracias,
Tu consultor SEO`;
            }

            contenidoDinamico.innerHTML = `
                <div class="alert alert-success">
                    <h6><i class="fas fa-robot"></i> Plantilla Mejorada para Cliente</h6>
                    <p class="mb-0"><strong>✨ Plantilla específica diseñada para obtener información precisa y estructurada</strong></p>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><strong>📧 Email listo para enviar al cliente</strong></span>
                        <button type="button" class="btn btn-sm btn-success" onclick="copiarPlantillaCliente()">
                            <i class="fas fa-copy"></i> Copiar Email Completo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light border" id="plantilla-cliente" style="white-space: pre-wrap; font-family: monospace; font-size: 0.9em;">
${plantillaTexto}
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="alert alert-info small">
                                    <strong>🎯 Ventajas de esta plantilla:</strong><br>
                                    ✅ Estructura clara y específica<br>
                                    ✅ Compatible con ChatGPT y Claude<br>
                                    ✅ Formato de respuesta estandarizado<br>
                                    ✅ Evita información faltante
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-warning small">
                                    <strong>📋 Qué obtendrás:</strong><br>
                                    • JSON directamente importable<br>
                                    • Información completa y estructurada<br>
                                    • Formato consistente<br>
                                    • Menos idas y venidas con el cliente
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            contenidoDinamico.style.display = 'block';
            botonesAccion.style.display = 'flex';
        }

        // OPCIÓN 2A: Mostrar importación por archivo
        function mostrarImportacion() {
            const contenidoDinamico = document.getElementById('contenido-dinamico');
            const botonesAccion = document.getElementById('botones-accion');

            contenidoDinamico.innerHTML = `
                <div class="alert alert-success">
                    <h6><i class="fas fa-file-upload"></i> Importar desde Archivo JSON</h6>
                    <p class="mb-0">Sube un archivo .json con los datos procesados por IA:</p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="archivo-json" class="form-label">Seleccionar archivo JSON:</label>
                            <input type="file" class="form-control" id="archivo-json" accept=".json" onchange="procesarArchivoJSON(this)">
                            <small class="text-muted">El archivo debe contener datos en formato JSON válido</small>
                        </div>

                        <div class="alert alert-light">
                            <strong>📋 Formato esperado:</strong>
                            <pre class="mb-0 mt-2" style="font-size: 0.9em;">${JSON.stringify(<?php
                                echo json_encode(isset($campos) && is_array($campos) ? array_slice(array_keys($campos), 0, 3) : []);
                            ?>.reduce((obj, key) => {
                                obj[key] = "valor_ejemplo";
                                return obj;
                            }, {}), null, 2)}</pre>
                        </div>
                    </div>
                </div>
            `;

            contenidoDinamico.style.display = 'block';
            botonesAccion.style.display = 'flex';
        }

        // OPCIÓN 2B: Mostrar textarea para JSON
        function mostrarTextarea() {
            const contenidoDinamico = document.getElementById('contenido-dinamico');
            const botonesAccion = document.getElementById('botones-accion');
            const esBriefCliente = "<?php
                $es_brief = (strpos(strtolower($paso_info['codigo_paso'] ?? ''), 'brief') !== false) ||
                           (strpos(strtolower($paso_info['paso_nombre'] ?? ''), 'brief') !== false);
                echo $es_brief ? 'true' : 'false';
            ?>" === 'true';

            let esquemaInfo = '';
            let ejemploJSON = '';

            if (esBriefCliente && typeof BRIEF_CLIENTE_SCHEMA !== 'undefined' && typeof EJEMPLO_BRIEF_COMPLETO !== 'undefined') {
                esquemaInfo = `
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Esquema JSON para Brief del Cliente</h6>
                        <p class="small mb-2">Tu JSON debe seguir esta estructura específica para mayor precisión:</p>
                        <details>
                            <summary class="text-primary" style="cursor: pointer;">📋 Ver esquema completo</summary>
                            <pre class="mt-2 mb-0" style="font-size: 0.8em; max-height: 300px; overflow-y: auto;">${JSON.stringify(BRIEF_CLIENTE_SCHEMA, null, 2)}</pre>
                        </details>
                    </div>
                `;

                ejemploJSON = JSON.stringify(EJEMPLO_BRIEF_COMPLETO, null, 2).substring(0, 500) + '...';
            } else {
                ejemploJSON = '{\n  "campo1": "valor1",\n  "campo2": "valor2"\n}';
            }

            contenidoDinamico.innerHTML = `
                <div class="alert alert-success">
                    <h6><i class="fas fa-paste"></i> Importar JSON con Validación Avanzada</h6>
                    <p class="mb-0">Pega aquí el JSON que te ha devuelto la IA. <strong>Incluye validación automática de estructura y campos.</strong></p>
                </div>

                ${esquemaInfo}

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="json-textarea" class="form-label">JSON de respuesta:</label>
                            <textarea class="form-control" id="json-textarea" rows="10" placeholder='${ejemploJSON}'></textarea>
                            <small class="text-muted">
                                ${esBriefCliente ?
                                    '✨ Validación automática activada para Brief del Cliente' :
                                    'Pega aquí el JSON que te ha proporcionado ChatGPT o Claude'
                                }
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-success" onclick="importarJSON()">
                                        <i class="fas fa-upload"></i> Importar y Validar
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="validarJSON()">
                                        <i class="fas fa-check"></i> Solo Validar
                                    </button>
                                    ${esBriefCliente ?
                                        '<button type="button" class="btn btn-outline-info" onclick="cargarEjemplo()"><i class="fas fa-lightbulb"></i> Cargar Ejemplo</button>' :
                                        ''
                                    }
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">
                                    ${esBriefCliente ?
                                        '<strong>🎯 Validación incluye:</strong><br>• Campos obligatorios<br>• Formato de URLs<br>• Valores permitidos<br>• Estructura de datos' :
                                        '<strong>Validación:</strong><br>• Formato JSON válido<br>• Campos básicos'
                                    }
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            contenidoDinamico.style.display = 'block';
            botonesAccion.style.display = 'flex';
        }

        // OPCIÓN 3: Búsqueda automática con IA local
        function buscarConIA() {
            // Usar el sistema de IA Local si está disponible
            if (typeof iniciarAsistenteIALocal === 'function') {
                iniciarAsistenteIALocal();
            } else {
                alert('El sistema de IA Local no está disponible para este formulario.\n\nEsta funcionalidad está disponible solo para el Brief del Cliente.');
            }
        }

        // Copiar plantilla completa al portapapeles
        function copiarPlantillaCliente() {
            const plantilla = document.getElementById('plantilla-cliente').innerText;
            navigator.clipboard.writeText(plantilla).then(() => {
                mostrarNotificacion('Plantilla copiada al portapapeles. ¡Listo para enviar al cliente!', 'success');
            }).catch(err => {
                console.error('Error al copiar: ', err);
                alert('Error al copiar al portapapeles');
            });
        }

        // Validar JSON antes de importar
        function validarJSON() {
            const jsonText = document.getElementById('json-textarea').value.trim();
            if (!jsonText) {
                alert('Por favor, ingresa un JSON para validar');
                return;
            }

            try {
                const datos = JSON.parse(jsonText);
                const campos = Object.keys(datos);
                mostrarNotificacion(`JSON válido con ${campos.length} campos: ${campos.join(', ')}`, 'success');
            } catch (error) {
                alert('JSON inválido: ' + error.message);
            }
        }

        // Procesar archivo JSON subido
        function procesarArchivoJSON(input) {
            const file = input.files[0];
            if (!file) return;

            if (file.type !== 'application/json' && !file.name.endsWith('.json')) {
                alert('Por favor, selecciona un archivo JSON válido');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const jsonContent = e.target.result;
                    document.getElementById('json-textarea').value = jsonContent;
                    mostrarNotificacion('Archivo cargado correctamente', 'success');
                } catch (error) {
                    alert('Error al leer el archivo: ' + error.message);
                }
            };
            reader.readAsText(file);
        }

        // Importar datos JSON al formulario
        function importarJSON() {
            const jsonText = document.getElementById('json-textarea').value.trim();
            if (!jsonText) {
                alert('Por favor, ingresa o carga un JSON válido');
                return;
            }

            try {
                const datos = JSON.parse(jsonText);
                const esBriefCliente = "<?php
                $es_brief = (strpos(strtolower($paso_info['codigo_paso'] ?? ''), 'brief') !== false) ||
                           (strpos(strtolower($paso_info['paso_nombre'] ?? ''), 'brief') !== false);
                echo $es_brief ? 'true' : 'false';
            ?>" === 'true';

                let camposImportados = 0;
                let errores = [];
                let advertencias = [];

                // Si es un brief del cliente y tenemos las funciones específicas, usar validación mejorada
                if (esBriefCliente && typeof validarJSONBriefCliente === 'function' && typeof mapearDatosBriefCliente === 'function') {
                    // Validar estructura específica del brief
                    const validacion = validarJSONBriefCliente(datos);
                    errores = validacion.errores;
                    advertencias = validacion.advertencias;

                    if (errores.length > 0) {
                        const continuar = confirm(`Se encontraron ${errores.length} errores en el JSON:\n\n${errores.join('\n')}\n\n¿Continuar con la importación de los campos válidos?`);
                        if (!continuar) return;
                    }

                    // Mapear datos específicos del brief
                    const datosMapeados = mapearDatosBriefCliente(datos);
                    const resultado = aplicarDatosMapeados(datosMapeados);

                    camposImportados = resultado.camposAplicados;
                    errores.push(...resultado.errores);

                } else {
                    // Usar importación genérica original
                    for (const [campo, valor] of Object.entries(datos)) {
                        const elemento = document.querySelector(`[name="${campo}"]`);

                        if (elemento) {
                            if (elemento.type === 'checkbox' || elemento.type === 'radio') {
                                elemento.checked = Boolean(valor);
                            } else if (elemento.tagName === 'SELECT') {
                                // Buscar la opción que coincida
                                const opcion = Array.from(elemento.options).find(opt =>
                                    opt.value === valor || opt.text === valor
                                );
                                if (opcion) {
                                    elemento.value = opcion.value;
                                } else {
                                    errores.push(`Opción "${valor}" no encontrada para campo "${campo}"`);
                                }
                            } else {
                                elemento.value = valor;
                            }
                            camposImportados++;
                        } else {
                            errores.push(`Campo "${campo}" no encontrado en el formulario`);
                        }
                    }
                }

                // Mostrar resultado detallado
                let mensaje = `✅ Importación completada: ${camposImportados} campos importados`;

                if (advertencias.length > 0) {
                    mensaje += `\n\n⚠️ Advertencias (${advertencias.length}):\n${advertencias.map(a => '• ' + a).join('\n')}`;
                }

                if (errores.length > 0) {
                    mensaje += `\n\n❌ Errores (${errores.length}):\n${errores.map(e => '• ' + e).join('\n')}`;
                }

                // Mostrar modal con resultados si hay muchos errores/advertencias
                if (errores.length > 3 || advertencias.length > 3) {
                    mostrarModalResultadosImportacion(camposImportados, errores, advertencias);
                } else {
                    alert(mensaje);
                }

                mostrarNotificacion(`Datos importados: ${camposImportados} campos`, camposImportados > 0 ? 'success' : 'warning');

                // Marcar cambios pendientes
                if (camposImportados > 0) {
                    cambiosPendientes = true;
                    mostrarIndicadorCambios();
                }

            } catch (error) {
                alert('❌ Error al procesar JSON: ' + error.message);
                mostrarNotificacion('Error en el formato JSON', 'error');
            }
        }

        // OPCIÓN 3: Simular búsqueda automática con IA local
        function simularBusquedaIA(urlCliente, nombrePaso) {
            const progressBar = document.querySelector('#progreso-busqueda .progress-bar');
            const spinner = document.getElementById('spinner-busqueda');
            const resultadoDiv = document.getElementById('resultado-busqueda');

            let progreso = 10;
            const pasos = [
                { mensaje: 'Accediendo al sitio web...', tiempo: 1000 },
                { mensaje: 'Analizando meta tags y estructura...', tiempo: 1500 },
                { mensaje: 'Revisando contenido relevante...', tiempo: 2000 },
                { mensaje: 'Extrayendo datos específicos para ' + nombrePaso + '...', tiempo: 1500 },
                { mensaje: 'Generando respuestas estructuradas...', tiempo: 1000 },
                { mensaje: 'Finalizando análisis...', tiempo: 500 }
            ];

            let pasoActual = 0;

            function ejecutarSiguientePaso() {
                if (pasoActual < pasos.length) {
                    const paso = pasos[pasoActual];
                    progreso += 15;
                    progressBar.style.width = progreso + '%';

                    // Mostrar mensaje de progreso
                    const mensaje = document.querySelector('#progreso-busqueda').parentElement.querySelector('small');
                    mensaje.textContent = paso.mensaje;

                    pasoActual++;
                    setTimeout(ejecutarSiguientePaso, paso.tiempo);
                } else {
                    // Completar la búsqueda
                    completarBusquedaIA();
                }
            }

            function completarBusquedaIA() {
                progressBar.style.width = '100%';
                progressBar.classList.remove('progress-bar-animated');
                progressBar.classList.add('bg-success');

                spinner.style.display = 'none';

                // Generar resultados simulados basados en el paso actual
                const resultadosSimulados = generarResultadosIA(nombrePaso, urlCliente);

                resultadoDiv.innerHTML = `
                    <div class="alert alert-success">
                        <h6><i class="fas fa-check-circle"></i> Análisis Completado</h6>
                        <p class="mb-0">Se ha analizado automáticamente la información disponible</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6>📊 Datos Encontrados:</h6>
                            <div class="border rounded p-3 mb-3" style="background-color: #f8f9fa;">
                                <pre style="white-space: pre-wrap; font-size: 12px;">${JSON.stringify(resultadosSimulados, null, 2)}</pre>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>🎯 Acciones Disponibles:</h6>
                            <button type="button" class="btn btn-success btn-sm me-2 mb-2" onclick="aplicarResultadosIA()">
                                <i class="fas fa-magic"></i> Aplicar Automáticamente
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm me-2 mb-2" onclick="revisarResultados()">
                                <i class="fas fa-eye"></i> Revisar y Editar
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm mb-2" onclick="exportarResultados()">
                                <i class="fas fa-download"></i> Exportar JSON
                            </button>
                        </div>
                    </div>
                `;

                resultadoDiv.style.display = 'block';

                // Guardar los resultados para uso posterior
                window.resultadosIA = resultadosSimulados;
            }

            // Iniciar el proceso
            setTimeout(ejecutarSiguientePaso, 500);
        }

        // Generar resultados simulados basados en el tipo de paso
        function generarResultadosIA(nombrePaso, urlCliente) {
            const baseData = {
                '_analisis_automatico': true,
                '_timestamp': new Date().toISOString(),
                '_url_analizada': urlCliente,
                '_paso_analizado': nombrePaso
            };

            // Personalizar según el tipo de paso
            if (nombrePaso.toLowerCase().includes('meta') || nombrePaso.toLowerCase().includes('título')) {
                return {
                    ...baseData,
                    'meta_title': 'Título principal encontrado en la página',
                    'meta_description': 'Descripción meta extraída automáticamente',
                    'meta_keywords': 'palabras, clave, encontradas',
                    'longitud_titulo': '60 caracteres',
                    'longitud_descripcion': '155 caracteres'
                };
            } else if (nombrePaso.toLowerCase().includes('contenido') || nombrePaso.toLowerCase().includes('keyword')) {
                return {
                    ...baseData,
                    'keyword_principal': 'palabra clave principal detectada',
                    'densidad_keyword': '2.5%',
                    'palabras_totales': '1250',
                    'encabezados_h1': '1',
                    'encabezados_h2': '4',
                    'enlace_internos': '12'
                };
            } else if (nombrePaso.toLowerCase().includes('técnico') || nombrePaso.toLowerCase().includes('velocidad')) {
                return {
                    ...baseData,
                    'tiempo_carga': '2.8 segundos',
                    'tamaño_pagina': '1.2 MB',
                    'solicitudes_http': '45',
                    'optimizacion_imagenes': 'Requerida',
                    'compresion_gzip': 'Activa'
                };
            } else {
                return {
                    ...baseData,
                    'estado_general': 'Analizado automáticamente',
                    'recomendaciones': 'Revisar manualmente los campos específicos',
                    'nivel_completitud': '75%',
                    'datos_extraidos': 'Información básica del sitio web'
                };
            }
        }

        // Aplicar resultados de IA directamente al formulario
        function aplicarResultadosIA() {
            if (!window.resultadosIA) {
                alert('No hay resultados disponibles para aplicar');
                return;
            }

            if (!confirm('¿Aplicar automáticamente los resultados encontrados? Esto sobrescribirá los campos actuales.')) {
                return;
            }

            let camposAplicados = 0;
            const errores = [];

            for (const [campo, valor] of Object.entries(window.resultadosIA)) {
                // Saltar campos meta que no son del formulario
                if (campo.startsWith('_')) continue;

                const elemento = document.querySelector(`[name="${campo}"]`);
                if (elemento) {
                    if (elemento.type === 'checkbox' || elemento.type === 'radio') {
                        elemento.checked = Boolean(valor);
                    } else {
                        elemento.value = valor;
                    }
                    camposAplicados++;
                } else {
                    errores.push(`Campo "${campo}" no encontrado`);
                }
            }

            mostrarNotificacion(`IA aplicada: ${camposAplicados} campos completados automáticamente`, 'success');
            cambiosPendientes = true;
            mostrarIndicadorCambios();

            if (errores.length > 0) {
                console.log('Campos no aplicados:', errores);
            }
        }

        // Mostrar modal para revisar resultados
        function revisarResultados() {
            if (!window.resultadosIA) {
                alert('No hay resultados disponibles para revisar');
                return;
            }

            const jsonString = JSON.stringify(window.resultadosIA, null, 2);
            document.getElementById('json-textarea').value = jsonString;

            // Enfocar la sección de importación
            document.getElementById('seccion-importacion').style.display = 'block';
            document.getElementById('toggle-icon').className = 'fas fa-chevron-up';
            document.querySelector('#seccion-importacion').scrollIntoView({ behavior: 'smooth' });

            mostrarNotificacion('Resultados cargados en el área de revisión', 'info');
        }

        // Exportar resultados como archivo JSON
        function exportarResultados() {
            if (!window.resultadosIA) {
                alert('No hay resultados disponibles para exportar');
                return;
            }

            const jsonString = JSON.stringify(window.resultadosIA, null, 2);
            const blob = new Blob([jsonString], { type: 'application/json' });
            const url = URL.createObjectURL(blob);

            const link = document.createElement('a');
            link.href = url;
            link.download = `ai_results_${Date.now()}.json`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);

            mostrarNotificacion('Resultados exportados como archivo JSON', 'success');
        }

        // Limpiar todos los campos del formulario
        function limpiarFormulario() {
            if (!confirm('¿Estás seguro de que quieres limpiar todos los campos del formulario?')) {
                return;
            }

            const form = document.getElementById('formulario-dinamico');
            const campos = form.querySelectorAll('input, textarea, select');

            campos.forEach(campo => {
                if (campo.type === 'checkbox' || campo.type === 'radio') {
                    campo.checked = false;
                } else if (campo.type !== 'hidden') {
                    campo.value = '';
                }
            });

            mostrarNotificacion('Formulario limpiado', 'info');
            cambiosPendientes = true;
            mostrarIndicadorCambios();
        }

        // Exportar datos actuales del formulario como JSON
        function exportarJSON() {
            const form = document.getElementById('formulario-dinamico');
            const campos = form.querySelectorAll('input, textarea, select');
            const datos = {};

            campos.forEach(campo => {
                if (campo.name && campo.type !== 'hidden') {
                    if (campo.type === 'checkbox' || campo.type === 'radio') {
                        datos[campo.name] = campo.checked;
                    } else if (campo.value) {
                        datos[campo.name] = campo.value;
                    }
                }
            });

            const jsonString = JSON.stringify(datos, null, 2);

            // Mostrar en modal
            document.getElementById('datos-preview').textContent = jsonString;
            const modal = new bootstrap.Modal(document.getElementById('modalVistaPrevia'));
            modal.show();
        }

        // Copiar JSON al portapapeles
        function copiarDatos() {
            const texto = document.getElementById('datos-preview').textContent;
            navigator.clipboard.writeText(texto).then(() => {
                mostrarNotificacion('JSON copiado al portapapeles', 'success');
            }).catch(err => {
                console.error('Error al copiar: ', err);
                alert('Error al copiar al portapapeles');
            });
        }

        // Función para cargar ejemplo del brief del cliente
        function cargarEjemplo() {
            if (typeof EJEMPLO_BRIEF_COMPLETO !== 'undefined') {
                document.getElementById('json-textarea').value = JSON.stringify(EJEMPLO_BRIEF_COMPLETO, null, 2);
                mostrarNotificacion('Ejemplo cargado - modifica los datos según tu cliente', 'info');
            } else {
                alert('Ejemplo no disponible para este tipo de formulario');
            }
        }

        // Modal para mostrar resultados de importación detallados
        function mostrarModalResultadosImportacion(camposImportados, errores, advertencias) {
            // Crear modal dinámicamente si no existe
            let modal = document.getElementById('modalResultadosImportacion');
            if (!modal) {
                modal = document.createElement('div');
                modal.className = 'modal fade';
                modal.id = 'modalResultadosImportacion';
                modal.innerHTML = `
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">📊 Resultados de Importación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="contenido-resultados">
                                <!-- Contenido dinámico -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="copiarResultadosImportacion()">
                                    <i class="fas fa-copy"></i> Copiar Resumen
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }

            // Generar contenido
            const contenido = document.getElementById('contenido-resultados');
            contenido.innerHTML = `
                <div class="alert alert-${camposImportados > 0 ? 'success' : 'warning'}">
                    <h6><i class="fas fa-check-circle"></i> Resumen</h6>
                    <p class="mb-0"><strong>${camposImportados} campos importados correctamente</strong></p>
                </div>

                ${advertencias.length > 0 ? `
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle"></i> Advertencias (${advertencias.length})</h6>
                    <ul class="mb-0">
                        ${advertencias.map(a => `<li>${a}</li>`).join('')}
                    </ul>
                </div>
                ` : ''}

                ${errores.length > 0 ? `
                <div class="alert alert-danger">
                    <h6><i class="fas fa-times-circle"></i> Errores (${errores.length})</h6>
                    <ul class="mb-0">
                        ${errores.map(e => `<li>${e}</li>`).join('')}
                    </ul>
                </div>
                ` : ''}

                <div class="alert alert-info">
                    <h6><i class="fas fa-info-circle"></i> Recomendaciones</h6>
                    <ul class="mb-0">
                        ${camposImportados === 0 ? '<li>Verificar que el JSON tenga la estructura correcta</li>' : ''}
                        ${errores.length > 0 ? '<li>Revisar los campos que no se pudieron importar</li>' : ''}
                        ${advertencias.length > 0 ? '<li>Considerar corregir las advertencias para mayor precisión</li>' : ''}
                        <li>Guardar el formulario después de revisar los datos importados</li>
                    </ul>
                </div>
            `;

            // Mostrar modal
            const bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
        }

        // Copiar resultados de importación
        function copiarResultadosImportacion() {
            const contenido = document.getElementById('contenido-resultados').innerText;
            navigator.clipboard.writeText(contenido).then(() => {
                mostrarNotificacion('Resumen copiado al portapapeles', 'success');
            }).catch(err => {
                console.error('Error al copiar: ', err);
                alert('Error al copiar al portapapeles');
            });
        }

        // Validar JSON mejorado para brief del cliente
        function validarJSON() {
            const jsonText = document.getElementById('json-textarea').value.trim();
            if (!jsonText) {
                alert('Por favor, ingresa un JSON para validar');
                return;
            }

            try {
                const datos = JSON.parse(jsonText);
                const esBriefCliente = "<?php
                $es_brief = (strpos(strtolower($paso_info['codigo_paso'] ?? ''), 'brief') !== false) ||
                           (strpos(strtolower($paso_info['paso_nombre'] ?? ''), 'brief') !== false);
                echo $es_brief ? 'true' : 'false';
            ?>" === 'true';

                let mensaje = '✅ JSON válido';
                let tipo = 'success';

                if (esBriefCliente && typeof validarJSONBriefCliente === 'function') {
                    const validacion = validarJSONBriefCliente(datos);

                    if (validacion.errores.length > 0) {
                        mensaje = `⚠️ JSON válido pero con ${validacion.errores.length} errores de estructura`;
                        tipo = 'warning';
                    }

                    if (validacion.advertencias.length > 0) {
                        mensaje += ` y ${validacion.advertencias.length} advertencias`;
                    }

                    // Mostrar detalles en console para revisión
                    if (validacion.errores.length > 0 || validacion.advertencias.length > 0) {
                        console.log('Detalles de validación:', validacion);
                        mensaje += '\n\nVer detalles en la consola del navegador';
                    }
                } else {
                    const campos = Object.keys(datos);
                    mensaje += ` con ${campos.length} campos: ${campos.slice(0, 5).join(', ')}${campos.length > 5 ? '...' : ''}`;
                }

                mostrarNotificacion(mensaje.split('\n')[0], tipo);
                alert(mensaje);

            } catch (error) {
                alert('❌ JSON inválido: ' + error.message);
                mostrarNotificacion('Error en el formato JSON', 'error');
            }
        }
        // Funciones para mostrar/ocultar instrucciones del brief
        function mostrarInstrucciones() {
            document.getElementById('instrucciones-section').style.display = 'block';
            document.getElementById('mostrar-plantilla-btn').style.display = 'none';
        }

        function ocultarInstrucciones() {
            document.getElementById('instrucciones-section').style.display = 'none';
            document.getElementById('mostrar-plantilla-btn').style.display = 'block';
        }
    </script>
</body>
</html>