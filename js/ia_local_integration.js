/**
 * INTEGRACIÓN CON IA LOCAL (CLAUDE CLI / GEMINI CLI)
 * ===================================================
 *
 * Permite usar IAs locales para generar automáticamente el JSON del brief
 * a partir de documentos o conversaciones con el cliente
 */

// Configuración de comandos CLI disponibles
const CLI_CONFIGS = {
    ollama: {
        nombre: 'Ollama (100% Local)',
        comando_test: 'ollama --version',
        comando_ejecutar: 'ollama',
        instalacion_url: 'https://ollama.com/',
        detectado: false,
        tipo: 'local',
        requiere_api: false
    },
    claude: {
        nombre: 'Claude CLI',
        comando_test: 'claude --version',
        comando_ejecutar: 'claude',
        instalacion_url: 'https://docs.claude.ai/docs/claude-cli',
        detectado: false,
        tipo: 'api',
        requiere_api: true
    },
    gemini: {
        nombre: 'Gemini CLI',
        comando_test: 'gemini --version',
        comando_ejecutar: 'gemini',
        instalacion_url: 'https://ai.google.dev/gemini-api/docs/cli',
        detectado: false,
        tipo: 'api',
        requiere_api: true
    }
};

/**
 * Detectar qué CLIs están instaladas
 * Nota: Esto requiere endpoint PHP que ejecute los comandos
 */
async function detectarCLIsDisponibles() {
    try {
        const response = await fetch('api/detectar_cli_ia.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                clientes: ['ollama', 'claude', 'gemini']
            })
        });

        const data = await response.json();

        // Actualizar estado de detección
        for (let cli in CLI_CONFIGS) {
            if (data.disponibles && data.disponibles[cli]) {
                CLI_CONFIGS[cli].detectado = true;
                CLI_CONFIGS[cli].version = data.disponibles[cli].version;
                CLI_CONFIGS[cli].modelos = data.disponibles[cli].modelos || [];
                CLI_CONFIGS[cli].configurado = data.disponibles[cli].configurado || false;
                CLI_CONFIGS[cli].mensaje_config = data.disponibles[cli].mensaje_config || '';
            }
        }

        return data;
    } catch (error) {
        console.error('Error detectando CLIs:', error);
        return {disponibles: {}, error: error.message};
    }
}

/**
 * Generar prompt optimizado para la IA
 */
function generarPromptParaIA(contexto) {
    const schema = typeof BRIEF_CLIENTE_SCHEMA !== 'undefined' ? BRIEF_CLIENTE_SCHEMA : {};

    return `# TAREA: Extraer información del Brief de Cliente SEO

## CONTEXTO
Eres un asistente que ayuda a consultores SEO a procesar briefs de clientes.
Necesito que extraigas toda la información relevante del texto/documento proporcionado
y la organices según el siguiente schema JSON.

## SCHEMA JSON ESPERADO
\`\`\`json
${JSON.stringify(schema, null, 2)}
\`\`\`

## INSTRUCCIONES
1. Lee cuidadosamente toda la información proporcionada
2. Extrae los datos relevantes para cada campo del schema
3. Si un dato no está disponible, usa null o "" según corresponda
4. Para arrays, incluye todos los elementos relevantes encontrados
5. Para booleans, infiere el valor basándote en el contexto
6. Devuelve ÚNICAMENTE el JSON válido, sin explicaciones adicionales

## INFORMACIÓN DEL CLIENTE
${contexto.informacion_cliente || "No se proporcionó información adicional"}

## DOCUMENTO/CONVERSACIÓN
${contexto.contenido || ""}

## OUTPUT
Devuelve el JSON completado siguiendo exactamente la estructura del schema:`;
}

/**
 * Ejecutar IA Local para procesar el brief
 */
async function ejecutarIALocal(cli, contexto, onProgress) {
    const prompt = generarPromptParaIA(contexto);

    // Mostrar progreso
    if (onProgress) {
        onProgress({
            estado: 'preparando',
            mensaje: `Preparando consulta para ${CLI_CONFIGS[cli].nombre}...`
        });
    }

    try {
        // Preparar opciones según el CLI
        const opciones = {
            max_tokens: 4000,
            temperature: 0.1 // Baja temperatura para mayor precisión
        };

        // Si hay modelo seleccionado (Ollama), incluirlo
        if (contexto.modelo_seleccionado) {
            opciones.model = contexto.modelo_seleccionado;
        }

        // Llamar al endpoint PHP que ejecutará el comando CLI
        const response = await fetch('api/ejecutar_ia_local.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                cli: cli,
                prompt: prompt,
                archivo: contexto.archivo || null,
                opciones: opciones
            })
        });

        if (onProgress) {
            onProgress({
                estado: 'ejecutando',
                mensaje: 'Esperando respuesta de la IA...'
            });
        }

        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }

        if (onProgress) {
            onProgress({
                estado: 'procesando',
                mensaje: 'Procesando respuesta...'
            });
        }

        // Extraer JSON de la respuesta
        const jsonExtraido = extraerJSON(data.respuesta);

        if (!jsonExtraido) {
            throw new Error('No se pudo extraer un JSON válido de la respuesta de la IA');
        }

        if (onProgress) {
            onProgress({
                estado: 'completado',
                mensaje: 'JSON generado correctamente'
            });
        }

        return {
            success: true,
            json: jsonExtraido,
            respuesta_completa: data.respuesta,
            cli_usado: cli
        };

    } catch (error) {
        if (onProgress) {
            onProgress({
                estado: 'error',
                mensaje: error.message
            });
        }

        return {
            success: false,
            error: error.message
        };
    }
}

/**
 * Extraer JSON válido de una respuesta que puede contener texto adicional
 */
function extraerJSON(texto) {
    // Intentar extraer JSON entre ```json y ```
    let match = texto.match(/```json\s*([\s\S]*?)\s*```/);
    if (match) {
        try {
            return JSON.parse(match[1]);
        } catch (e) {
            console.log('JSON en código markdown inválido');
        }
    }

    // Intentar extraer JSON entre llaves
    match = texto.match(/\{[\s\S]*\}/);
    if (match) {
        try {
            return JSON.parse(match[0]);
        } catch (e) {
            console.log('JSON directo inválido');
        }
    }

    // Intentar parsear el texto completo
    try {
        return JSON.parse(texto);
    } catch (e) {
        console.log('Texto completo no es JSON válido');
    }

    return null;
}

/**
 * Interfaz principal para el usuario
 */
async function iniciarAsistenteIALocal() {
    console.log('🚀 [iniciarAsistenteIALocal] INICIO');

    // Detectar CLIs disponibles
    console.log('📡 [iniciarAsistenteIALocal] Llamando a detectarCLIsDisponibles()...');
    const clisDisponibles = await detectarCLIsDisponibles();
    console.log('✅ [iniciarAsistenteIALocal] CLIs detectadas:', clisDisponibles);

    if (!clisDisponibles.disponibles || Object.keys(clisDisponibles.disponibles).length === 0) {
        console.log('⚠️ [iniciarAsistenteIALocal] No hay CLIs disponibles, mostrando modal');
        mostrarModalNoHayCLI();
        return;
    }

    console.log('🎨 [iniciarAsistenteIALocal] Mostrando interfaz con CLIs:', Object.keys(clisDisponibles.disponibles));
    // Mostrar interfaz de selección
    mostrarInterfazIALocal(clisDisponibles);
    console.log('✅ [iniciarAsistenteIALocal] FIN');
}

/**
 * Mostrar interfaz cuando no hay CLI instalada
 */
function mostrarModalNoHayCLI() {
    const html = `
        <div class="alert alert-warning">
            <h5><i class="fas fa-exclamation-triangle"></i> No se detectaron CLIs de IA instaladas</h5>
            <p>Para usar la funcionalidad de IA Local, necesitas instalar una de las siguientes herramientas:</p>
            <ul>
                <li><strong>Claude CLI:</strong> <a href="${CLI_CONFIGS.claude.instalacion_url}" target="_blank">Instrucciones de instalación</a></li>
                <li><strong>Gemini CLI:</strong> <a href="${CLI_CONFIGS.gemini.instalacion_url}" target="_blank">Instrucciones de instalación</a></li>
            </ul>
            <p class="mb-0"><strong>¿Cómo funciona?</strong></p>
            <ol>
                <li>Instalas el CLI en tu máquina</li>
                <li>Configuras tu API key</li>
                <li>Desde aquí puedes procesar documentos automáticamente</li>
                <li>La IA extrae la información y genera el JSON</li>
                <li>Los datos se importan automáticamente al formulario</li>
            </ol>
        </div>
    `;

    const contenedor = document.getElementById('contenido-dinamico');
    if (contenedor) {
        contenedor.innerHTML = html;
        contenedor.style.display = 'block';
    } else {
        alert('No se detectaron CLIs de IA instaladas. Por favor, instala Claude CLI o Gemini CLI.');
    }
}

/**
 * Mostrar interfaz para usar IA Local
 */
function mostrarInterfazIALocal(clisDisponibles) {
    const clis = Object.entries(clisDisponibles.disponibles);

    let opcionesCLI = '';
    clis.forEach(([nombre, info]) => {
        const config = CLI_CONFIGS[nombre];
        const tipoLabel = info.tipo === 'local' ? '✅ 100% Local' : '⚠️ Requiere API';
        const estadoConfig = info.configurado ? '✅ Configurado' : '❌ No configurado';

        opcionesCLI += `
            <div class="form-check mb-2 p-2 border rounded ${clis.length === 1 ? 'bg-light' : ''}">
                <input class="form-check-input" type="radio" name="cli_seleccionada" id="cli_${nombre}" value="${nombre}" ${clis.length === 1 ? 'checked' : ''} data-modelos='${JSON.stringify(info.modelos || [])}'>
                <label class="form-check-label" for="cli_${nombre}">
                    <strong>${config.nombre}</strong> <small class="text-muted">(v${info.version})</small>
                    <br>
                    <small>${tipoLabel} • ${estadoConfig}</small>
                    ${info.modelos && info.modelos.length > 0 ? `<br><small class="text-info">Modelos: ${info.modelos.join(', ')}</small>` : ''}
                    ${info.mensaje_config ? `<br><small class="text-muted">${info.mensaje_config}</small>` : ''}
                </label>
            </div>
        `;
    });

    const html = `
        <div class="card">
            <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h6 class="mb-0"><i class="fas fa-robot"></i> Asistente con IA Local</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <strong>CLIs detectadas correctamente</strong>
                </div>

                <form id="form-ia-local">
                    <div class="mb-3">
                        <label class="form-label"><strong>1. Selecciona la IA a usar:</strong></label>
                        ${opcionesCLI}
                    </div>

                    <div class="mb-3" id="selector-modelo" style="display: none;">
                        <label class="form-label"><strong>2. Selecciona el modelo:</strong></label>
                        <select class="form-control" id="modelo_seleccionado"></select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>3. Proporciona la información del cliente:</strong></label>
                        <p class="small text-muted">Puedes pegar texto de emails, documentos, notas de reunión, etc.</p>
                        <textarea class="form-control" id="informacion_cliente" rows="10"
                                  placeholder="Pega aquí toda la información del cliente (emails, documentos, conversaciones, etc.)"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>4. O sube un archivo:</strong></label>
                        <input type="file" class="form-control" id="archivo_cliente" accept=".txt,.doc,.docx,.pdf,.md">
                        <small class="text-muted">Formatos aceptados: TXT, DOC, DOCX, PDF, MD</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>5. Información adicional (opcional):</strong></label>
                        <input type="text" class="form-control" id="info_adicional"
                               placeholder="Ej: Cliente del sector turismo, necesita auditoría urgente">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-magic"></i> Generar Brief Automáticamente
                    </button>
                </form>

                <div id="progreso-ia" style="display: none;" class="mt-3">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="text-center mt-2" id="mensaje-progreso"></p>
                </div>

                <div id="resultado-ia" style="display: none;" class="mt-3"></div>
            </div>
        </div>
    `;

    const contenedor = document.getElementById('contenido-dinamico');
    if (contenedor) {
        contenedor.innerHTML = html;
        contenedor.style.display = 'block';

        // Esperar a que el DOM se actualice antes de añadir eventos
        setTimeout(() => {
            // Configurar evento del formulario
            const formIALocal = document.getElementById('form-ia-local');
            if (formIALocal) {
                formIALocal.addEventListener('submit', procesarConIALocal);
            }

            // Configurar eventos para mostrar selector de modelos
            document.querySelectorAll('input[name="cli_seleccionada"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const modelos = JSON.parse(this.dataset.modelos || '[]');
                const selectorModelo = document.getElementById('selector-modelo');
                const selectModelo = document.getElementById('modelo_seleccionado');

                if (modelos.length > 0) {
                    // Mostrar selector y llenar opciones
                    selectModelo.innerHTML = '';
                    modelos.forEach(modelo => {
                        const option = document.createElement('option');
                        option.value = modelo;
                        option.textContent = modelo;
                        selectModelo.appendChild(option);
                    });
                    selectorModelo.style.display = 'block';
                } else {
                    selectorModelo.style.display = 'none';
                }
            });
        });

        // Trigger inicial para el radio seleccionado
        const radioSeleccionado = document.querySelector('input[name="cli_seleccionada"]:checked');
        if (radioSeleccionado) {
            radioSeleccionado.dispatchEvent(new Event('change'));
        }
        }, 0); // Ejecutar en el siguiente ciclo del event loop
    }
}

/**
 * Procesar información con IA Local
 */
async function procesarConIALocal(e) {
    e.preventDefault();

    const cli = document.querySelector('input[name="cli_seleccionada"]:checked')?.value;
    const informacionCliente = document.getElementById('informacion_cliente').value;
    const archivoInput = document.getElementById('archivo_cliente');
    const infoAdicional = document.getElementById('info_adicional').value;
    const modeloSelect = document.getElementById('modelo_seleccionado');
    const modeloSeleccionado = modeloSelect.style.display !== 'none' ? modeloSelect.value : null;

    if (!cli) {
        alert('Por favor selecciona una IA');
        return;
    }

    if (!informacionCliente && !archivoInput.files[0]) {
        alert('Por favor proporciona información del cliente (texto o archivo)');
        return;
    }

    // Mostrar progreso
    document.getElementById('form-ia-local').style.display = 'none';
    document.getElementById('progreso-ia').style.display = 'block';

    // Preparar contexto
    let contexto = {
        informacion_cliente: infoAdicional,
        contenido: informacionCliente,
        modelo_seleccionado: modeloSeleccionado
    };

    // Si hay archivo, leerlo
    if (archivoInput.files[0]) {
        const archivo = archivoInput.files[0];
        contexto.archivo = {
            nombre: archivo.name,
            tipo: archivo.type,
            tamano: archivo.size
        };

        // Leer contenido del archivo
        const lector = new FileReader();
        lector.onload = async function(e) {
            contexto.contenido += '\n\n--- Contenido del archivo ---\n' + e.target.result;
            await ejecutarYProcesarIA(cli, contexto);
        };
        lector.readAsText(archivo);
    } else {
        await ejecutarYProcesarIA(cli, contexto);
    }
}

/**
 * Ejecutar IA y procesar resultado
 */
async function ejecutarYProcesarIA(cli, contexto) {
    const tiempoInicio = Date.now();

    const resultado = await ejecutarIALocal(cli, contexto, (progreso) => {
        document.getElementById('mensaje-progreso').textContent = progreso.mensaje;
    });

    const tiempoTotal = ((Date.now() - tiempoInicio) / 1000).toFixed(2);

    document.getElementById('progreso-ia').style.display = 'none';
    document.getElementById('resultado-ia').style.display = 'block';

    if (resultado.success) {
        // Información sobre el CLI usado
        const cliUsado = CLI_CONFIGS[resultado.cli_usado] || {};
        const modeloUsado = resultado.model || contexto.modelo_seleccionado || 'default';
        const tipoIA = resultado.tipo === 'local' ? '✅ 100% Local' : '⚠️ API';

        // Generar preview detallado del JSON
        const previewHTML = generarPreviewJSON(resultado.json);

        // Guardar el resultado globalmente para poder aplicarlo después
        window._ultimoResultadoIA = resultado.json;

        document.getElementById('resultado-ia').innerHTML = `
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-check-circle"></i> ¡Brief generado correctamente!</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-3">
                        <h6><i class="fas fa-info-circle"></i> Información del Procesamiento:</h6>
                        <ul class="mb-0">
                            <li><strong>IA Usada:</strong> ${cliUsado.nombre || cli}</li>
                            <li><strong>Modelo:</strong> ${modeloUsado}</li>
                            <li><strong>Tipo:</strong> ${tipoIA}</li>
                            <li><strong>Tiempo de procesamiento:</strong> ${tiempoTotal}s</li>
                        </ul>
                    </div>

                    <h6><strong>Preview de los Datos Extraídos:</strong></h6>
                    <div class="accordion mb-3" id="preview-accordion">
                        ${previewHTML}
                    </div>

                    <details class="mb-3">
                        <summary class="btn btn-sm btn-outline-secondary mb-2">Ver JSON Completo</summary>
                        <pre class="bg-light p-3" style="max-height: 400px; overflow-y: auto;"><code>${JSON.stringify(resultado.json, null, 2)}</code></pre>
                    </details>

                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-lg" onclick="aplicarDatosDesdePreview()">
                            <i class="fas fa-check-double"></i> ✅ Aplicar Datos al Formulario
                        </button>
                        <div class="btn-group">
                            <button class="btn btn-secondary" onclick="copiarJSON(JSON.stringify(window._ultimoResultadoIA))">
                                <i class="fas fa-copy"></i> Copiar JSON
                            </button>
                            <button class="btn btn-outline-secondary" onclick="location.reload()">
                                <i class="fas fa-redo"></i> Nueva Consulta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        document.getElementById('resultado-ia').innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="fas fa-exclamation-triangle"></i> Error al procesar</h5>
                <p><strong>Mensaje:</strong> ${resultado.error}</p>
                <button class="btn btn-primary" onclick="location.reload()">
                    <i class="fas fa-redo"></i> Intentar de Nuevo
                </button>
            </div>
        `;
    }
}

/**
 * Generar preview HTML del JSON en formato accordion
 */
function generarPreviewJSON(json) {
    let html = '';
    let index = 0;

    for (const [seccion, datos] of Object.entries(json)) {
        const seccionId = `seccion-${index}`;
        const seccionTitulo = seccion.replace(/_/g, ' ').toUpperCase();

        html += `
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button ${index === 0 ? '' : 'collapsed'}" type="button" data-bs-toggle="collapse" data-bs-target="#${seccionId}">
                        <strong>${seccionTitulo}</strong>
                    </button>
                </h2>
                <div id="${seccionId}" class="accordion-collapse collapse ${index === 0 ? 'show' : ''}" data-bs-parent="#preview-accordion">
                    <div class="accordion-body">
                        ${generarContenidoSeccion(datos)}
                    </div>
                </div>
            </div>
        `;
        index++;
    }

    return html;
}

/**
 * Generar contenido de cada sección
 */
function generarContenidoSeccion(datos) {
    if (typeof datos === 'object' && datos !== null) {
        if (Array.isArray(datos)) {
            if (datos.length === 0) return '<p class="text-muted mb-0">Sin datos</p>';
            return '<ul>' + datos.map(item => `<li>${typeof item === 'object' ? JSON.stringify(item) : item}</li>`).join('') + '</ul>';
        } else {
            let html = '<dl class="row mb-0">';
            for (const [key, value] of Object.entries(datos)) {
                const label = key.replace(/_/g, ' ');
                let valorFormateado = value;

                if (typeof value === 'object' && value !== null) {
                    valorFormateado = Array.isArray(value) ? value.join(', ') : JSON.stringify(value);
                }

                html += `
                    <dt class="col-sm-4">${label}:</dt>
                    <dd class="col-sm-8">${valorFormateado || '<em class="text-muted">No especificado</em>'}</dd>
                `;
            }
            html += '</dl>';
            return html;
        }
    }
    return `<p class="mb-0">${datos || '<em class="text-muted">No especificado</em>'}</p>`;
}

/**
 * Aplicar datos desde preview
 */
function aplicarDatosDesdePreview() {
    if (!window._ultimoResultadoIA) {
        alert('No hay datos para aplicar');
        return;
    }

    if (confirm('¿Confirmas que quieres aplicar estos datos al formulario?\n\nEsto sobrescribirá cualquier dato existente en los campos.')) {
        aplicarDatosInteligente(window._ultimoResultadoIA);

        // Ocultar el modal/contenedor de IA
        const contenedor = document.getElementById('contenido-dinamico');
        if (contenedor) {
            contenedor.style.display = 'none';
        }

        alert('✅ Datos aplicados correctamente al formulario');
    }
}

/**
 * Copiar JSON al portapapeles
 */
function copiarJSON(json) {
    navigator.clipboard.writeText(json).then(() => {
        alert('JSON copiado al portapapeles');
    });
}

// Exponer funciones globalmente
window.iniciarAsistenteIALocal = iniciarAsistenteIALocal;
window.detectarCLIsDisponibles = detectarCLIsDisponibles;
