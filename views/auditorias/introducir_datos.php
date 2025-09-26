<?php
/**
 * VISTA: Introducir Datos en Paso de Auditoría
 * ============================================
 * 
 * Página para introducir datos con validación JSON, importación de archivos
 * y sistema de plantillas reutilizables
 */

// Verificar que tenemos el ID del paso
if (!isset($_GET['paso_id']) || !is_numeric($_GET['paso_id'])) {
    echo '<div class="alert alert-danger">ID de paso no válido.</div>';
    return;
}

$paso_id = (int)$_GET['paso_id'];

// Obtener información del paso y la auditoría
try {
    $stmt = $pdo->prepare("
        SELECT 
            ap.*,
            pt.nombre as plantilla_nombre,
            pt.descripcion as plantilla_descripcion,
            pt.estructura_json,
            pt.campos_requeridos,
            a.titulo as auditoria_titulo,
            a.id as auditoria_id,
            f.nombre as fase_nombre
        FROM auditoria_pasos ap
        LEFT JOIN paso_templates pt ON ap.paso_template_id = pt.id
        LEFT JOIN auditorias a ON ap.auditoria_id = a.id
        LEFT JOIN fases f ON pt.fase_id = f.id
        WHERE ap.id = ?
    ");
    $stmt->execute([$paso_id]);
    $paso = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$paso) {
        echo '<div class="alert alert-danger">Paso no encontrado.</div>';
        return;
    }
    
    // Obtener plantillas de datos disponibles
    $stmt_plantillas = $pdo->prepare("
        SELECT * FROM plantillas_datos 
        WHERE paso_template_id = ? OR paso_template_id IS NULL
        ORDER BY nombre
    ");
    $stmt_plantillas->execute([$paso['paso_template_id']]);
    $plantillas_disponibles = $stmt_plantillas->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    echo '<div class="alert alert-danger">Error al cargar el paso: ' . htmlspecialchars($e->getMessage()) . '</div>';
    return;
}

// Decodificar estructura JSON si existe
$estructura_json = null;
if (!empty($paso['estructura_json'])) {
    $estructura_json = json_decode($paso['estructura_json'], true);
}

// Decodificar datos completados si existen
$datos_actuales = null;
if (!empty($paso['datos_completados'])) {
    $datos_actuales = json_decode($paso['datos_completados'], true);
}
?>

<style>
.json-editor {
    font-family: 'Courier New', monospace;
    font-size: 14px;
    line-height: 1.4;
}

.campo-requerido {
    border-left: 3px solid #dc3545;
}

.campo-opcional {
    border-left: 3px solid #28a745;
}

.plantilla-item {
    cursor: pointer;
    transition: all 0.3s ease;
}

.plantilla-item:hover {
    background-color: #f8f9fa;
    border-color: #007bff;
}

.plantilla-item.selected {
    background-color: #e3f2fd;
    border-color: #2196f3;
}

.formato-ejemplo {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 10px;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
}

.validacion-error {
    color: #dc3545;
    font-size: 0.875rem;
}

.validacion-success {
    color: #28a745;
    font-size: 0.875rem;
}

.drop-zone {
    border: 2px dashed #ccc;
    border-radius: 8px;
    padding: 40px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.drop-zone.dragover {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.progress-container {
    display: none;
    margin-top: 15px;
}
</style>

<div class="container-fluid">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">
                        <i class="fas fa-database me-2"></i>
                        Introducir Datos: <?= htmlspecialchars($paso['plantilla_nombre'] ?? 'Paso sin nombre') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="?modulo=auditorias&accion=listar">Auditorías</a></li>
                            <li class="breadcrumb-item"><a href="?modulo=auditorias&accion=ver&id=<?= $paso['auditoria_id'] ?>"><?= htmlspecialchars($paso['auditoria_titulo']) ?></a></li>
                            <li class="breadcrumb-item active">Introducir Datos</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" onclick="guardarDatos()">
                        <i class="fas fa-save"></i> Guardar Datos
                    </button>
                    <a href="?modulo=auditorias&accion=ver&id=<?= $paso['auditoria_id'] ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Panel principal de entrada de datos -->
        <div class="col-lg-8">
            <!-- Información del paso -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Información del Paso
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Fase:</strong> <?= htmlspecialchars($paso['fase_nombre'] ?? 'N/A') ?></p>
                            <p><strong>Estado Actual:</strong> 
                                <span class="badge bg-<?= obtenerColorEstado($paso['estado']) ?> fs-6">
                                    <?= ucfirst($paso['estado']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tiempo Estimado:</strong> <?= $paso['tiempo_estimado_horas'] ?? 'N/A' ?>h</p>
                            <p><strong>Criticidad:</strong> 
                                <span class="badge bg-<?= obtenerColorCriticidad($paso['criticidad']) ?> fs-6">
                                    <?= ucfirst($paso['criticidad'] ?? 'Media') ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    <?php if (!empty($paso['plantilla_descripcion'])): ?>
                    <div class="mt-3">
                        <strong>Descripción:</strong>
                        <p class="mt-2"><?= nl2br(htmlspecialchars($paso['plantilla_descripcion'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Métodos de entrada de datos -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <ul class="nav nav-tabs card-header-tabs" id="metodosTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-white" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manual" type="button" role="tab">
                                <i class="fas fa-keyboard"></i> Manual
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-white" id="archivo-tab" data-bs-toggle="tab" data-bs-target="#archivo" type="button" role="tab">
                                <i class="fas fa-file-upload"></i> Importar Archivo
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-white" id="api-tab" data-bs-toggle="tab" data-bs-target="#api" type="button" role="tab">
                                <i class="fas fa-cloud-download-alt"></i> API
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="metodosTabContent">
                        <!-- Entrada manual -->
                        <div class="tab-pane fade show active" id="manual" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Editor JSON</h6>
                                    <textarea id="jsonEditor" class="form-control json-editor" rows="15" placeholder="Introduce los datos en formato JSON..."><?= $datos_actuales ? json_encode($datos_actuales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '' ?></textarea>
                                    <div id="validacionResultado" class="mt-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Vista Previa</h6>
                                    <div id="vistaPrevia" class="formato-ejemplo" style="min-height: 300px;">
                                        <em class="text-muted">La vista previa aparecerá aquí...</em>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Importar archivo -->
                        <div class="tab-pane fade" id="archivo" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="drop-zone" id="dropZone">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                        <h5>Arrastra archivos aquí</h5>
                                        <p class="text-muted">o haz clic para seleccionar</p>
                                        <input type="file" id="fileInput" class="d-none" accept=".json,.csv,.xlsx,.xls" multiple>
                                        <div class="mt-3">
                                            <small class="text-muted">
                                                Formatos soportados: JSON, CSV, Excel (.xlsx, .xls)
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="progress-container">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Mapeo de Campos</h6>
                                    <div id="mapeoContainer" class="d-none">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i>
                                            Mapea los campos del archivo con la estructura requerida
                                        </div>
                                        <div id="mapeoFields"></div>
                                        <button type="button" class="btn btn-primary mt-3" onclick="procesarMapeo()">
                                            <i class="fas fa-check"></i> Aplicar Mapeo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- API -->
                        <div class="tab-pane fade" id="api" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Configuración API</h6>
                                    <form id="apiForm">
                                        <div class="mb-3">
                                            <label class="form-label">URL del Endpoint</label>
                                            <input type="url" class="form-control" id="apiUrl" placeholder="https://api.ejemplo.com/datos">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Método</label>
                                            <select class="form-select" id="apiMethod">
                                                <option value="GET">GET</option>
                                                <option value="POST">POST</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Headers (JSON)</label>
                                            <textarea class="form-control" id="apiHeaders" rows="3" placeholder='{"Authorization": "Bearer token"}'></textarea>
                                        </div>
                                        <div class="mb-3" id="apiBodyContainer" style="display: none;">
                                            <label class="form-label">Body (JSON)</label>
                                            <textarea class="form-control" id="apiBody" rows="3" placeholder='{}'></textarea>
                                        </div>
                                        <button type="button" class="btn btn-primary" onclick="ejecutarAPI()">
                                            <i class="fas fa-play"></i> Ejecutar API
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h6>Respuesta API</h6>
                                    <div id="apiResponse" class="formato-ejemplo" style="min-height: 300px;">
                                        <em class="text-muted">La respuesta de la API aparecerá aquí...</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel lateral -->
        <div class="col-lg-4">
            <!-- Estructura esperada -->
            <?php if ($estructura_json): ?>
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-sitemap"></i> Estructura Esperada
                    </h6>
                </div>
                <div class="card-body">
                    <div class="formato-ejemplo">
                        <?= htmlspecialchars(json_encode($estructura_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Plantillas disponibles -->
            <?php if (!empty($plantillas_disponibles)): ?>
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-templates"></i> Plantillas Disponibles
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php foreach ($plantillas_disponibles as $plantilla): ?>
                    <div class="plantilla-item border-bottom p-3" onclick="cargarPlantilla(<?= $plantilla['id'] ?>)">
                        <h6 class="mb-1"><?= htmlspecialchars($plantilla['nombre']) ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($plantilla['descripcion'] ?? 'Sin descripción') ?></small>
                        <div class="mt-2">
                            <small class="badge bg-info">
                                <?= $plantilla['tipo_archivo'] ?? 'JSON' ?>
                            </small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-outline-primary btn-sm w-100" onclick="guardarComoPlantilla()">
                        <i class="fas fa-save"></i> Guardar como Plantilla
                    </button>
                </div>
            </div>
            <?php endif; ?>

            <!-- Procesos recomendados -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-lightbulb"></i> Procesos Recomendados
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0">
                            <i class="fas fa-search text-primary me-2"></i>
                            <strong>Análisis SEO:</strong> Utiliza herramientas como Screaming Frog o SEMrush
                        </div>
                        <div class="list-group-item border-0 px-0">
                            <i class="fas fa-tachometer-alt text-warning me-2"></i>
                            <strong>Performance:</strong> Google PageSpeed Insights o GTmetrix
                        </div>
                        <div class="list-group-item border-0 px-0">
                            <i class="fas fa-mobile-alt text-info me-2"></i>
                            <strong>Mobile:</strong> Google Mobile-Friendly Test
                        </div>
                        <div class="list-group-item border-0 px-0">
                            <i class="fas fa-chart-line text-success me-2"></i>
                            <strong>Analytics:</strong> Google Analytics o Google Search Console
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para guardar plantilla -->
<div class="modal fade" id="plantillaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Guardar como Plantilla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="plantillaForm">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Plantilla</label>
                        <input type="text" class="form-control" id="plantillaNombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="plantillaDescripcion" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="plantillaGlobal">
                            <label class="form-check-label" for="plantillaGlobal">
                                Disponible para todos los pasos similares
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarPlantilla()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
let datosActuales = <?= $datos_actuales ? json_encode($datos_actuales) : '{}' ?>;
let estructuraEsperada = <?= $estructura_json ? json_encode($estructura_json) : 'null' ?>;
let archivosCargados = [];

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    // Configurar editor JSON
    const jsonEditor = document.getElementById('jsonEditor');
    jsonEditor.addEventListener('input', validarJSON);
    
    // Configurar drag & drop
    setupDragDrop();
    
    // Configurar API method change
    document.getElementById('apiMethod').addEventListener('change', function() {
        const bodyContainer = document.getElementById('apiBodyContainer');
        bodyContainer.style.display = this.value === 'POST' ? 'block' : 'none';
    });
    
    // Validar JSON inicial si existe
    if (jsonEditor.value) {
        validarJSON();
    }
});

function validarJSON() {
    const editor = document.getElementById('jsonEditor');
    const resultado = document.getElementById('validacionResultado');
    const vistaPrevia = document.getElementById('vistaPrevia');
    
    try {
        if (!editor.value.trim()) {
            resultado.innerHTML = '<div class="validacion-error"><i class="fas fa-exclamation-triangle"></i> JSON vacío</div>';
            vistaPrevia.innerHTML = '<em class="text-muted">La vista previa aparecerá aquí...</em>';
            return false;
        }
        
        const datos = JSON.parse(editor.value);
        datosActuales = datos;
        
        // Validar estructura si existe
        let errores = [];
        if (estructuraEsperada) {
            errores = validarEstructura(datos, estructuraEsperada);
        }
        
        if (errores.length === 0) {
            resultado.innerHTML = '<div class="validacion-success"><i class="fas fa-check-circle"></i> JSON válido</div>';
        } else {
            resultado.innerHTML = '<div class="validacion-error"><i class="fas fa-exclamation-triangle"></i> Errores: ' + errores.join(', ') + '</div>';
        }
        
        // Actualizar vista previa
        vistaPrevia.innerHTML = '<pre>' + JSON.stringify(datos, null, 2) + '</pre>';
        
        return errores.length === 0;
        
    } catch (e) {
        resultado.innerHTML = '<div class="validacion-error"><i class="fas fa-times-circle"></i> JSON inválido: ' + e.message + '</div>';
        vistaPrevia.innerHTML = '<em class="text-danger">JSON inválido</em>';
        return false;
    }
}

function validarEstructura(datos, estructura) {
    const errores = [];
    
    function validarRecursivo(obj, esquema, ruta = '') {
        for (const [clave, valor] of Object.entries(esquema)) {
            const rutaCompleta = ruta ? `${ruta}.${clave}` : clave;
            
            if (valor.required && !(clave in obj)) {
                errores.push(`Campo requerido faltante: ${rutaCompleta}`);
                continue;
            }
            
            if (clave in obj) {
                const valorObj = obj[clave];
                
                if (valor.type && typeof valorObj !== valor.type) {
                    errores.push(`Tipo incorrecto en ${rutaCompleta}: esperado ${valor.type}, recibido ${typeof valorObj}`);
                }
                
                if (valor.properties && typeof valorObj === 'object') {
                    validarRecursivo(valorObj, valor.properties, rutaCompleta);
                }
            }
        }
    }
    
    if (typeof estructura === 'object' && estructura.properties) {
        validarRecursivo(datos, estructura.properties);
    }
    
    return errores;
}

function setupDragDrop() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    
    dropZone.addEventListener('click', () => fileInput.click());
    
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });
    
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });
    
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        procesarArchivos(e.dataTransfer.files);
    });
    
    fileInput.addEventListener('change', (e) => {
        procesarArchivos(e.target.files);
    });
}

function procesarArchivos(archivos) {
    const progressContainer = document.querySelector('.progress-container');
    const progressBar = document.querySelector('.progress-bar');
    
    progressContainer.style.display = 'block';
    
    Array.from(archivos).forEach((archivo, index) => {
        const formData = new FormData();
        formData.append('archivo', archivo);
        formData.append('paso_id', <?= $paso_id ?>);
        
        // Obtener mapeo si existe
        const mappingInputs = document.querySelectorAll('#mapeoFields select');
        const mapping = {};
        mappingInputs.forEach(select => {
            if (select.value) {
                mapping[select.dataset.target] = select.value;
            }
        });
        
        if (Object.keys(mapping).length > 0) {
            formData.append('mapping', JSON.stringify(mapping));
        }
        
        fetch('?modulo=auditorias&accion=procesar_archivo', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                archivosCargados.push(data);
                mostrarMapeoArchivo(data);
                
                // Mostrar datos procesados en el editor JSON
                document.getElementById('jsonEditor').value = JSON.stringify(data.datos_procesados, null, 2);
                validarJSON();
                
                // Cambiar a la pestaña manual para revisar
                document.getElementById('manual-tab').click();
                
                // Preguntar si quiere guardar como plantilla
                if (confirm('¿Deseas guardar esta configuración como plantilla para uso futuro?')) {
                    guardarComoPlantilla();
                }
            } else {
                alert('Error al procesar archivo: ' + data.message);
                if (data.detalles) {
                    console.error('Detalles del error:', data.detalles);
                }
            }
            
            // Actualizar progreso
            const progreso = ((index + 1) / archivos.length) * 100;
            progressBar.style.width = progreso + '%';
            
            if (index === archivos.length - 1) {
                setTimeout(() => {
                    progressContainer.style.display = 'none';
                    progressBar.style.width = '0%';
                }, 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar archivo');
        });
    });
}

function mostrarMapeoArchivo(archivoData) {
    const mapeoContainer = document.getElementById('mapeoContainer');
    const mapeoFields = document.getElementById('mapeoFields');
    
    mapeoContainer.classList.remove('d-none');
    
    let html = `<h6>Archivo: ${archivoData.nombre}</h6>`;
    html += '<div class="row">';
    
    // Campos del archivo
    html += '<div class="col-md-6">';
    html += '<h6>Campos del Archivo</h6>';
    archivoData.campos.forEach(campo => {
        html += `<div class="form-check">
            <input class="form-check-input" type="checkbox" id="campo_${campo}" value="${campo}">
            <label class="form-check-label" for="campo_${campo}">${campo}</label>
        </div>`;
    });
    html += '</div>';
    
    // Campos esperados
    html += '<div class="col-md-6">';
    html += '<h6>Mapear a</h6>';
    if (estructuraEsperada && estructuraEsperada.properties) {
        Object.keys(estructuraEsperada.properties).forEach(campo => {
            html += `<select class="form-select mb-2" data-target="${campo}">
                <option value="">Seleccionar campo para ${campo}</option>`;
            archivoData.campos.forEach(campoArchivo => {
                html += `<option value="${campoArchivo}">${campoArchivo}</option>`;
            });
            html += '</select>';
        });
    }
    html += '</div>';
    
    html += '</div>';
    mapeoFields.innerHTML = html;
}

function procesarMapeo() {
    // Implementar lógica de mapeo
    alert('Funcionalidad de mapeo en desarrollo');
}

function ejecutarAPI() {
    const url = document.getElementById('apiUrl').value;
    const method = document.getElementById('apiMethod').value;
    const headers = document.getElementById('apiHeaders').value;
    const body = document.getElementById('apiBody').value;
    
    if (!url) {
        alert('Por favor, introduce una URL');
        return;
    }
    
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        }
    };
    
    if (headers) {
        try {
            Object.assign(options.headers, JSON.parse(headers));
        } catch (e) {
            alert('Headers JSON inválido');
            return;
        }
    }
    
    if (method === 'POST' && body) {
        options.body = body;
    }
    
    fetch(url, options)
        .then(response => response.json())
        .then(data => {
            document.getElementById('apiResponse').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            
            // Cargar datos en el editor
            document.getElementById('jsonEditor').value = JSON.stringify(data, null, 2);
            validarJSON();
            
            // Cambiar a la pestaña manual
            document.getElementById('manual-tab').click();
        })
        .catch(error => {
            document.getElementById('apiResponse').innerHTML = '<div class="text-danger">Error: ' + error.message + '</div>';
        });
}

function cargarPlantilla(plantillaId) {
    fetch(`gestionar_plantillas.php?accion=obtener&id=${plantillaId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('jsonEditor').value = data.plantilla.contenido;
                validarJSON();
                
                // Cambiar a la pestaña manual
                document.getElementById('manual-tab').click();
                
                // Mostrar mensaje de éxito
                mostrarAlerta(`Plantilla "${data.plantilla.nombre}" cargada correctamente`, 'success');
            } else {
                mostrarAlerta('Error al cargar plantilla: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarAlerta('Error al cargar plantilla', 'error');
        });
}

function guardarComoPlantilla() {
    if (!validarJSON()) {
        alert('Por favor, introduce datos JSON válidos antes de guardar como plantilla');
        return;
    }
    
    new bootstrap.Modal(document.getElementById('plantillaModal')).show();
}

function guardarPlantilla() {
    const nombre = document.getElementById('plantillaNombre').value;
    const descripcion = document.getElementById('plantillaDescripcion').value;
    const global = document.getElementById('plantillaGlobal').checked;
    
    if (!nombre) {
        alert('Por favor, introduce un nombre para la plantilla');
        return;
    }
    
    const datos = {
        nombre: nombre,
        descripcion: descripcion,
        contenido: document.getElementById('jsonEditor').value,
        paso_template_id: global ? null : <?= $paso['paso_template_id'] ?? 'null' ?>,
        tipo_archivo: 'JSON'
    };
    
    fetch('?modulo=auditorias&accion=guardar_plantilla', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Plantilla guardada correctamente');
            bootstrap.Modal.getInstance(document.getElementById('plantillaModal')).hide();
            location.reload();
        } else {
            alert('Error al guardar plantilla: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error al guardar plantilla');
    });
}

function guardarDatos() {
    const jsonData = document.getElementById('jsonEditor').value;
    
    if (!jsonData.trim()) {
        mostrarAlerta('No hay datos para guardar', 'warning');
        return;
    }
    
    try {
        JSON.parse(jsonData); // Validar JSON
    } catch (e) {
        mostrarAlerta('El JSON no es válido', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('paso_id', <?php echo $paso_id; ?>);
    formData.append('datos', jsonData);
    
    fetch('update_step.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            mostrarAlerta('Datos guardados correctamente', 'success');
            
            // Actualizar progreso en tiempo real
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            mostrarAlerta('Error al guardar: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarAlerta('Error al guardar datos', 'error');
    });
}

// Mostrar modal para guardar plantilla
function mostrarModalGuardarPlantilla(mapping, nombreArchivo) {
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Guardar como Plantilla</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="form-plantilla">
                        <div class="mb-3">
                            <label class="form-label">Nombre de la plantilla</label>
                            <input type="text" class="form-control" id="nombre-plantilla" 
                                   value="Plantilla ${nombreArchivo}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion-plantilla" rows="3"
                                      placeholder="Describe para qué sirve esta plantilla..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo de archivo</label>
                            <select class="form-control" id="tipo-archivo-plantilla" required>
                                <option value="csv">CSV</option>
                                <option value="json">JSON</option>
                                <option value="excel">Excel</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarPlantilla()">Guardar Plantilla</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    const modalInstance = new bootstrap.Modal(modal);
    modalInstance.show();
    
    // Guardar mapeo en el modal para uso posterior
    modal.dataset.mapping = JSON.stringify(mapping);
}

// Guardar plantilla
function guardarPlantilla() {
    const modal = document.querySelector('.modal.show');
    const mapping = JSON.parse(modal.dataset.mapping);
    
    const formData = new FormData();
    formData.append('accion', 'guardar');
    formData.append('nombre', document.getElementById('nombre-plantilla').value);
    formData.append('descripcion', document.getElementById('descripcion-plantilla').value);
    formData.append('tipo_archivo', document.getElementById('tipo-archivo-plantilla').value);
    formData.append('mapeo', JSON.stringify(mapping));
    formData.append('estructura_esperada', document.getElementById('jsonEditor').value);
    
    fetch('gestionar_plantillas.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            mostrarAlerta('Plantilla guardada correctamente', 'success');
            bootstrap.Modal.getInstance(modal).hide();
            cargarPlantillas(); // Recargar lista de plantillas
        } else {
            mostrarAlerta('Error al guardar plantilla: ' + data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarAlerta('Error al guardar plantilla', 'error');
    });
}
</script>