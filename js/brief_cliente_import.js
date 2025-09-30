/**
 * BRIEF DEL CLIENTE - SISTEMA DE IMPORTACIÓN MEJORADO
 * ====================================================
 *
 * Funciones específicas para el formulario del brief inicial del cliente
 * con esquemas JSON estructurados y validación de campos
 */

// Esquema JSON específico para el brief del cliente
const BRIEF_CLIENTE_SCHEMA = {
    "info_general": {
        "cliente": "Texto (obligatorio) - Nombre del cliente",
        "fecha": "Fecha (formato DD/MM/YYYY) - Fecha del brief",
        "consultor": "Texto (obligatorio) - Nombre del consultor SEO",
        "nombre_empresa": "Texto (obligatorio) - Nombre comercial de la empresa",
        "nombre_real": "Texto (opcional) - Razón social si es diferente",
        "sector_industria": "Texto (obligatorio) - Sector o industria de la empresa",
        "tamano_empresa": "Selección ('Startup', 'PYME', 'Empresa mediana', 'Gran empresa')",
        "anos_mercado": "Texto - Años que lleva en el mercado (ej: 'Desde 1998')",
        "ubicacion_principal": "Texto (obligatorio) - Ubicación principal de la empresa",
        "mercados_opera": "Texto - Mercados donde opera separados por comas"
    },
    "website": {
        "url_principal": "URL (obligatorio) - URL principal del sitio web",
        "dominios_adicionales": "Texto (opcional) - Otros dominios que posee",
        "subdominios_relevantes": "Texto (opcional) - Subdominios importantes",
        "lanzamiento_web": "Selección ('<1 año', '1-3 años', '3-5 años', '>5 años')",
        "ultima_remodelacion": "Texto (opcional) - Año de la última remodelación"
    },
    "modelo_negocio": {
        "tipo_negocio": "Selección ('B2B', 'B2C', 'B2B2C', 'Marketplace', 'SaaS', 'Otro')",
        "productos_servicios": "Array - Lista de productos/servicios principales",
        "propuesta_valor": "Texto largo (obligatorio) - Propuesta de valor única",
        "objetivo_principal": "Selección ('Ventas', 'Leads', 'Tráfico', 'Branding', 'Otro')",
        "objetivos_2024": "Array - Objetivos específicos para el año",
        "monetizacion": "Selección ('Venta directa online', 'Generación leads', 'Contactos/Cotizaciones', 'Publicidad', 'Suscripciones', 'Otro')"
    },
    "publico_objetivo": {
        "target_principal": {
            "edad": "Texto - Rango de edad del público principal",
            "ubicacion": "Texto - Ubicación geográfica del target",
            "nivel_socioeconomico": "Texto - Nivel socioeconómico",
            "comportamiento_online": "Texto (opcional) - Comportamiento online"
        },
        "targets_secundarios": "Array - Audiencias secundarias con descripción y porcentaje",
        "estacionalidad": {
            "tiene_estacionalidad": "Boolean - Si el negocio tiene estacionalidad",
            "meses_mayor_demanda": "Texto - Meses de mayor demanda",
            "meses_menor_demanda": "Texto - Meses de menor demanda"
        }
    },
    "competencia": {
        "competidores": "Array - Lista de competidores con nombre, URL y razón de competencia",
        "diferenciacion": "Texto largo (obligatorio) - Qué los diferencia de la competencia"
    },
    "situacion_seo": {
        "han_hecho_seo": "Boolean - Si han hecho SEO anteriormente",
        "agencia_anterior": "Texto (opcional) - Agencia o consultor anterior",
        "periodo": "Texto (opcional) - Período de trabajo anterior",
        "resultados_obtenidos": "Texto (opcional) - Resultados del SEO anterior",
        "fin_relacion": "Texto (opcional) - Por qué terminó la relación anterior",
        "equipo_seo_interno": "Boolean - Si tienen equipo con conocimientos SEO",
        "herramientas_actuales": "Array - Herramientas SEO que usan actualmente"
    },
    "objetivos_seo": {
        "keywords_prioritarias": "Array - Palabras clave prioritarias a rankear",
        "pagina_principal": "URL - Página principal más importante del negocio",
        "paginas_comerciales": "Array - Páginas comerciales clave",
        "landing_pages": "Array - Landing pages prioritarias"
    },
    "timeline": {
        "cuando_auditoria": "Texto - Cuándo necesitan la auditoría completa",
        "cuando_implementar": "Texto - Cuándo planean implementar cambios",
        "expectativas_tiempo": "Texto (opcional) - Expectativas de tiempo para ver resultados"
    },
    "aspectos_tecnicos": {
        "desarrollador_interno": "Boolean - Si tienen desarrollador interno",
        "agencia_desarrollo": "Boolean - Si tienen agencia de desarrollo",
        "contacto_tecnico": "Texto (opcional) - Contacto técnico",
        "pueden_implementar": "Selección ('Fácilmente', 'Con dificultad', 'No')",
        "limitaciones_cms": "Texto (opcional) - Limitaciones técnicas del CMS",
        "restricciones_sitio": "Texto (opcional) - Restricciones para cambios"
    },
    "info_adicional": {
        "otros_canales": "Array - Otros canales de marketing que usan",
        "factores_especiales": "Texto (opcional) - Factores especiales a considerar",
        "expectativas_auditoria": "Texto largo (obligatorio) - Qué esperan obtener de la auditoría"
    },
    "proximos_pasos": {
        "brief_validado": "Boolean - Si el brief está validado",
        "objetivos_definidos": "Boolean - Si los objetivos están claros",
        "accesos_solicitados": "Boolean - Si se han solicitado accesos",
        "timeline_acordado": "Boolean - Si el timeline está acordado",
        "kickoff_programado": "Boolean - Si se ha programado el kick-off"
    },
    "campos_adicionales": {
        "recursos_internos_seo": "Selección ('Ninguno', 'Básico', 'Avanzado') - Recursos internos para SEO",
        "expectativas_principales": "Texto largo (obligatorio) - Qué esperas conseguir con la auditoría",
        "timeline_implementacion": "Selección ('1 mes', '3 meses', '6 meses') - Tiempo para implementar recomendaciones",
        "kpis_principales": "Boolean/Texto - KPIs más importantes (campo problemático en formulario actual)",
        "observaciones": "Texto libre - Cualquier observación adicional"
    }
};

// Ejemplo de JSON completado basado en el caso real de Ibiza Villa
const EJEMPLO_BRIEF_COMPLETO = {
    "info_general": {
        "cliente": "Ibiza Villa",
        "fecha": "29/09/2025",
        "consultor": "Miguel Angel Jiménez",
        "nombre_empresa": "Ibiza Villa",
        "nombre_real": "Ibiza 1998 S.L",
        "sector_industria": "Alquiler de villas",
        "tamano_empresa": "PYME",
        "anos_mercado": "Desde 1998",
        "ubicacion_principal": "Ibiza",
        "mercados_opera": "España, Reino Unido, Italia, Francia, Alemania"
    },
    "website": {
        "url_principal": "https://www.ibizavilla.com/",
        "dominios_adicionales": "",
        "subdominios_relevantes": "",
        "lanzamiento_web": ">5 años",
        "ultima_remodelacion": "2018"
    },
    "modelo_negocio": {
        "tipo_negocio": "B2C",
        "productos_servicios": [
            "Alquiler villas",
            "Venta de casas (secundario)"
        ],
        "propuesta_valor": "Conocemos físicamente las casas y ofrecemos servicio de disponibilidad, años de experiencia, conocimiento de la isla, comisiones razonables",
        "objetivo_principal": "Leads",
        "objetivos_2024": [
            "Número de Conversiones"
        ],
        "monetizacion": "Generación leads"
    },
    "publico_objetivo": {
        "target_principal": {
            "edad": "35-50 años",
            "ubicacion": "Italia, Francia",
            "nivel_socioeconomico": "Alto",
            "comportamiento_online": ""
        },
        "targets_secundarios": [
            {
                "descripcion": "Familia",
                "porcentaje_trafico": "50"
            },
            {
                "descripcion": "Despedida de solteros - Grupos de amigos",
                "porcentaje_trafico": "50"
            }
        ],
        "estacionalidad": {
            "tiene_estacionalidad": true,
            "meses_mayor_demanda": "Empieza en Abril, más en Mayo y hasta octubre",
            "meses_menor_demanda": "Noviembre a Marzo"
        }
    },
    "competencia": {
        "competidores": [
            {
                "nombre": "Ibiza Prestige",
                "url": "https://ibizaprestige.es/",
                "razon_competencia": "Son franceses y hacen alquiler similar"
            },
            {
                "nombre": "Ibiza Summer Villas",
                "url": "https://www.ibizasummervillas.com/es",
                "razon_competencia": "Competencia directa en alquileres"
            },
            {
                "nombre": "Ibiza House Renting",
                "url": "ibizahouserenting.com",
                "razon_competencia": "Mismo sector y ubicación"
            }
        ],
        "diferenciacion": "El servicio y conocimiento de las casas"
    },
    "situacion_seo": {
        "han_hecho_seo": true,
        "agencia_anterior": "",
        "periodo": "Seis meses",
        "resultados_obtenidos": "Buenos",
        "fin_relacion": "Fin de servicio",
        "equipo_seo_interno": false,
        "herramientas_actuales": ["Google Analytics"]
    },
    "objetivos_seo": {
        "keywords_prioritarias": [
            "location villa ibiza",
            "rent villa ibiza",
            "affito ville ibiza",
            "alquiler villa ibiza"
        ],
        "pagina_principal": "https://www.ibizavilla.com/rentals/",
        "paginas_comerciales": [
            "https://www.ibizavilla.com/rentals/"
        ],
        "landing_pages": []
    },
    "timeline": {
        "cuando_auditoria": "Dos semanas",
        "cuando_implementar": "Después de la auditoría",
        "expectativas_tiempo": ""
    },
    "aspectos_tecnicos": {
        "desarrollador_interno": false,
        "agencia_desarrollo": false,
        "contacto_tecnico": "",
        "pueden_implementar": "No",
        "limitaciones_cms": "No",
        "restricciones_sitio": "No"
    },
    "info_adicional": {
        "otros_canales": ["Google Ads"],
        "factores_especiales": "Una web para comparar",
        "expectativas_auditoria": "Informe técnico y presupuesto para implementación"
    },
    "proximos_pasos": {
        "brief_validado": true,
        "objetivos_definidos": true,
        "accesos_solicitados": true,
        "timeline_acordado": true,
        "kickoff_programado": true
    },
    "campos_adicionales": {
        "recursos_internos_seo": "Ninguno",
        "expectativas_principales": "Aumentar visibilidad orgánica y generar más leads cualificados para el alquiler de villas en Ibiza",
        "timeline_implementacion": "3 meses",
        "kpis_principales": "Tráfico orgánico, posiciones keywords objetivo, leads generados, tiempo en página",
        "observaciones": "Importante considerar estacionalidad del negocio turístico en Ibiza"
    }
};

/**
 * Genera una plantilla mejorada para cliente remoto
 */
function generarPlantillaMejoradaCliente() {
    // Intentar obtener datos específicos del formulario, con valores por defecto si no están disponibles
    let nombrePaso = 'BRIEF INICIAL DEL CLIENTE - AUDITORÍA SEO';
    let nombreCliente = 'Cliente';

    try {
        // Buscar específicamente en el contexto del formulario, no en tests
        // Priorizar elementos dentro del formulario o breadcrumb
        const breadcrumbElement = document.querySelector('.breadcrumb-item.active');
        if (breadcrumbElement && breadcrumbElement.textContent && breadcrumbElement.textContent.includes('BRIEF')) {
            nombrePaso = breadcrumbElement.textContent.trim();
        } else {
            // Buscar h4 que no esté en tests
            const h4Elements = document.querySelectorAll('h4');
            for (let h4 of h4Elements) {
                if (h4.textContent && !h4.closest('#result1, #result2, #result3, #result4, #result5, #result6') &&
                    (h4.textContent.includes('BRIEF') || h4.textContent.includes('brief'))) {
                    nombrePaso = h4.textContent.trim();
                    break;
                }
            }
        }

        // Buscar cliente en elementos que no sean de test
        const smallElements = document.querySelectorAll('small');
        for (let small of smallElements) {
            if (small.textContent && !small.closest('#result1, #result2, #result3, #result4, #result5, #result6')) {
                const clienteMatch = small.textContent.match(/Cliente:\s*([^|]+)/);
                if (clienteMatch && clienteMatch[1]) {
                    nombreCliente = clienteMatch[1].trim();
                    break;
                }
            }
        }

        // Si no encontramos nada específico, buscar en metadatos de la página
        const titleElement = document.querySelector('title');
        if (titleElement && titleElement.textContent.includes('BRIEF')) {
            // Extraer información del título si está disponible
            const titleParts = titleElement.textContent.split(' - ');
            if (titleParts.length > 1) {
                nombreCliente = titleParts[1] || nombreCliente;
            }
        }

    } catch (error) {
        // Si hay error leyendo DOM, usar valores por defecto
        console.log('Usando valores por defecto para la plantilla - Error:', error.message);
    }

    // Limpiar nombre del paso si contiene texto de test
    if (nombrePaso.includes('Test ') || nombrePaso.includes('TEST ')) {
        nombrePaso = 'BRIEF INICIAL DEL CLIENTE - AUDITORÍA SEO';
    }

    const plantillaCompleta = `
📧 PARA: ${nombreCliente}
📌 ASUNTO: Información necesaria para ${nombrePaso}

Hola,

Para completar tu auditoría SEO de forma eficiente, necesito que me proporciones información estructurada sobre tu empresa. He preparado un sistema que te permitirá usar inteligencia artificial para agilizar este proceso.

🤖 CÓMO USAR CHATGPT O CLAUDE PARA COMPLETAR LA INFORMACIÓN:

1️⃣ COPIA Y PEGA esta instrucción completa en ChatGPT o Claude:

---

"Eres un asistente especializado en auditorías SEO. Voy a proporcionarte un esquema JSON con todos los campos que necesito completar para mi brief inicial de auditoría SEO. Por favor:

1. Revisa cada campo y su descripción
2. Pregúntame específicamente sobre cada sección que necesites
3. Una vez que tengas toda la información, devuélveme un JSON final con el formato exacto
4. Asegúrate de que todos los campos obligatorios estén completos

ESQUEMA A COMPLETAR:

${JSON.stringify(BRIEF_CLIENTE_SCHEMA, null, 2)}

EJEMPLO DE RESPUESTA FINAL (sustituye con mis datos reales):

${JSON.stringify(EJEMPLO_BRIEF_COMPLETO, null, 2)}

Ahora pregúntame sobre mi empresa para completar cada campo. Comienza con la información general y ve sección por sección."

---

2️⃣ RESPONDE las preguntas que te haga la IA sobre tu empresa

3️⃣ COPIA el JSON final que te proporcione y envíamelo

🎯 VENTAJAS DE ESTE MÉTODO:
✅ No omitirás información importante
✅ El formato será compatible con mi sistema
✅ La IA te ayudará a estructurar mejor las respuestas
✅ Ahorraremos tiempo en ambos lados

📝 INFORMACIÓN QUE LA IA TE PEDIRÁ:
- Datos básicos de tu empresa (sector, tamaño, años en mercado)
- Información de tu sitio web actual
- Modelo de negocio y objetivos
- Público objetivo y competencia
- Historial SEO (si lo hay)
- Objetivos específicos para esta auditoría
- Capacidades técnicas de tu equipo
- Timeline y expectativas

⚡ RESULTADO: Una vez que me envíes el JSON, podré importarlo directamente al sistema y comenzar tu auditoría con toda la información necesaria.

¿Alguna duda con este proceso?

Saludos,
Tu consultor SEO
    `.trim();

    return plantillaCompleta;
}

/**
 * Valida un JSON contra el esquema del brief del cliente
 */
function validarJSONBriefCliente(datos) {
    const errores = [];
    const advertencias = [];

    // Validar estructura principal
    const seccionesRequeridas = ['info_general', 'website', 'modelo_negocio', 'publico_objetivo', 'competencia', 'situacion_seo', 'objetivos_seo', 'info_adicional'];

    seccionesRequeridas.forEach(seccion => {
        if (!datos[seccion]) {
            errores.push(`Sección requerida faltante: ${seccion}`);
        }
    });

    // Validar campos obligatorios en info_general
    if (datos.info_general) {
        const obligatorios = ['cliente', 'consultor', 'nombre_empresa', 'sector_industria', 'ubicacion_principal'];
        obligatorios.forEach(campo => {
            if (!datos.info_general[campo]) {
                errores.push(`Campo obligatorio faltante en info_general: ${campo}`);
            }
        });

        // Validar valores específicos
        if (datos.info_general.tamano_empresa && !['Startup', 'PYME', 'Empresa mediana', 'Gran empresa'].includes(datos.info_general.tamano_empresa)) {
            advertencias.push(`Valor no estándar en tamaño_empresa: ${datos.info_general.tamano_empresa}`);
        }
    }

    // Validar URL principal
    if (datos.website?.url_principal) {
        try {
            new URL(datos.website.url_principal);
        } catch (e) {
            errores.push(`URL principal no válida: ${datos.website.url_principal}`);
        }
    } else {
        errores.push('URL principal es obligatoria');
    }

    // Validar tipo de negocio
    if (datos.modelo_negocio?.tipo_negocio && !['B2B', 'B2C', 'B2B2C', 'Marketplace', 'SaaS', 'Otro'].includes(datos.modelo_negocio.tipo_negocio)) {
        advertencias.push(`Tipo de negocio no estándar: ${datos.modelo_negocio.tipo_negocio}`);
    }

    return { errores, advertencias };
}

/**
 * Mapea los datos del JSON al formulario específico del brief del cliente
 */
function mapearDatosBriefCliente(datos) {
    const mapping = {
        // Info general
        'cliente': datos.info_general?.cliente,
        'fecha': datos.info_general?.fecha,
        'consultor': datos.info_general?.consultor,
        'nombre_empresa': datos.info_general?.nombre_empresa,
        'nombre_real': datos.info_general?.nombre_real,
        'sector_industria': datos.info_general?.sector_industria,
        'tamano_empresa': datos.info_general?.tamano_empresa,
        'anos_mercado': datos.info_general?.anos_mercado,
        'ubicacion_principal': datos.info_general?.ubicacion_principal,
        'mercados_opera': datos.info_general?.mercados_opera,

        // Website
        'url_principal': datos.website?.url_principal,
        'dominios_adicionales': datos.website?.dominios_adicionales,
        'subdominios_relevantes': datos.website?.subdominios_relevantes,
        'lanzamiento_web': datos.website?.lanzamiento_web,
        'ultima_remodelacion': datos.website?.ultima_remodelacion,

        // Modelo de negocio
        'tipo_negocio': datos.modelo_negocio?.tipo_negocio,
        'productos_servicios': Array.isArray(datos.modelo_negocio?.productos_servicios) ?
            datos.modelo_negocio.productos_servicios.join('\n') : datos.modelo_negocio?.productos_servicios,
        'propuesta_valor': datos.modelo_negocio?.propuesta_valor,
        'objetivo_principal': datos.modelo_negocio?.objetivo_principal,
        'objetivos_2024': Array.isArray(datos.modelo_negocio?.objetivos_2024) ?
            datos.modelo_negocio.objetivos_2024.join('\n') : datos.modelo_negocio?.objetivos_2024,
        'monetizacion': datos.modelo_negocio?.monetizacion,

        // Público objetivo
        'target_edad': datos.publico_objetivo?.target_principal?.edad,
        'target_ubicacion': datos.publico_objetivo?.target_principal?.ubicacion,
        'target_socioeconomico': datos.publico_objetivo?.target_principal?.nivel_socioeconomico,
        'target_comportamiento': datos.publico_objetivo?.target_principal?.comportamiento_online,
        'tiene_estacionalidad': datos.publico_objetivo?.estacionalidad?.tiene_estacionalidad,
        'meses_mayor_demanda': datos.publico_objetivo?.estacionalidad?.meses_mayor_demanda,
        'meses_menor_demanda': datos.publico_objetivo?.estacionalidad?.meses_menor_demanda,

        // Competencia
        'diferenciacion': datos.competencia?.diferenciacion,

        // Situación SEO
        'han_hecho_seo': datos.situacion_seo?.han_hecho_seo,
        'agencia_anterior': datos.situacion_seo?.agencia_anterior,
        'periodo_seo': datos.situacion_seo?.periodo,
        'resultados_seo': datos.situacion_seo?.resultados_obtenidos,
        'fin_relacion_seo': datos.situacion_seo?.fin_relacion,
        'equipo_seo_interno': datos.situacion_seo?.equipo_seo_interno,

        // Objetivos SEO
        'keywords_prioritarias': Array.isArray(datos.objetivos_seo?.keywords_prioritarias) ?
            datos.objetivos_seo.keywords_prioritarias.join('\n') : datos.objetivos_seo?.keywords_prioritarias,
        'pagina_principal_negocio': datos.objetivos_seo?.pagina_principal,
        'paginas_comerciales': Array.isArray(datos.objetivos_seo?.paginas_comerciales) ?
            datos.objetivos_seo.paginas_comerciales.join('\n') : datos.objetivos_seo?.paginas_comerciales,

        // Timeline
        'cuando_auditoria': datos.timeline?.cuando_auditoria,
        'cuando_implementar': datos.timeline?.cuando_implementar,
        'expectativas_tiempo': datos.timeline?.expectativas_tiempo,

        // Aspectos técnicos
        'desarrollador_interno': datos.aspectos_tecnicos?.desarrollador_interno,
        'agencia_desarrollo': datos.aspectos_tecnicos?.agencia_desarrollo,
        'contacto_tecnico': datos.aspectos_tecnicos?.contacto_tecnico,
        'pueden_implementar': datos.aspectos_tecnicos?.pueden_implementar,
        'limitaciones_cms': datos.aspectos_tecnicos?.limitaciones_cms,
        'restricciones_sitio': datos.aspectos_tecnicos?.restricciones_sitio,

        // Info adicional
        'otros_canales': Array.isArray(datos.info_adicional?.otros_canales) ?
            datos.info_adicional.otros_canales.join(', ') : datos.info_adicional?.otros_canales,
        'factores_especiales': datos.info_adicional?.factores_especiales,
        'expectativas_auditoria': datos.info_adicional?.expectativas_auditoria,

        // Próximos pasos
        'brief_validado': datos.proximos_pasos?.brief_validado,
        'objetivos_definidos': datos.proximos_pasos?.objetivos_definidos,
        'accesos_solicitados': datos.proximos_pasos?.accesos_solicitados,
        'timeline_acordado': datos.proximos_pasos?.timeline_acordado,
        'kickoff_programado': datos.proximos_pasos?.kickoff_programado
    };

    return mapping;
}

/**
 * Aplica datos del JSON al formulario real mediante búsqueda inteligente
 */
function aplicarDatosMapeados(datosMapeados) {
    let camposAplicados = 0;
    const errores = [];

    // Primero, intentar aplicación directa con los datos mapeados tal como están
    Object.entries(datosMapeados).forEach(([nombreCampo, valor]) => {
        if (valor === undefined || valor === null || valor === '') return;

        // Buscar campo directo
        let elemento = document.querySelector(`[name="${nombreCampo}"], [name="campos[${nombreCampo}]"], #${nombreCampo}`);

        if (!elemento) {
            // Búsqueda alternativa por atributos
            elemento = document.querySelector(`[data-field="${nombreCampo}"], [id*="${nombreCampo}"], [name*="${nombreCampo}"]`);
        }

        if (elemento) {
            aplicarValorACampo(elemento, valor);
            camposAplicados++;
        } else {
            errores.push(`Campo "${nombreCampo}" no encontrado en formulario`);
        }
    });

    // Si no encontramos muchos campos, intentar búsqueda inteligente por contenido
    if (camposAplicados < 5) {
        const resultadoInteligente = aplicarDatosInteligente(datosMapeados);
        camposAplicados += resultadoInteligente.camposAplicados;
        errores.push(...resultadoInteligente.errores);
    }

    return { camposAplicados, errores };
}

/**
 * Aplica un valor específico a un campo según su tipo
 */
function aplicarValorACampo(elemento, valor) {
    // Manejo especial para campos problemáticos conocidos
    if (elemento.type === 'checkbox') {
        // Para campos como "KPIs Principales" que son checkbox obligatorios
        const etiqueta = obtenerEtiquetaCampo(elemento);
        if (etiqueta && etiqueta.toLowerCase().includes('kpi')) {
            // Si el valor es un string con KPIs específicos, marcar como checked
            elemento.checked = valor && valor.toString().length > 0;

            // Si hay un campo de texto asociado cerca, poner el valor ahí
            const campoTextoAsociado = buscarCampoTextoAsociado(elemento);
            if (campoTextoAsociado) {
                campoTextoAsociado.value = valor.toString();
            }
        } else {
            // Comportamiento normal para otros checkboxes
            elemento.checked = Boolean(valor);
        }
    } else if (elemento.type === 'radio') {
        if (elemento.value === valor.toString()) {
            elemento.checked = true;
        }
    } else if (elemento.tagName === 'SELECT') {
        // Manejo especial para Timeline de implementación
        const etiqueta = obtenerEtiquetaCampo(elemento);
        if (etiqueta && etiqueta.toLowerCase().includes('timeline')) {
            // Mapear valores más flexibles a las opciones disponibles
            const valorLower = valor.toString().toLowerCase();
            let opcionElegida = null;

            if (valorLower.includes('asap') || valorLower.includes('inmediato') || valorLower.includes('urgente')) {
                opcionElegida = '1 mes';
            } else if (valorLower.includes('corto') || valorLower.includes('pronto') || valorLower.match(/[1-3]\s*mes/)) {
                opcionElegida = '3 meses';
            } else if (valorLower.includes('medio') || valorLower.match(/[4-6]\s*mes/)) {
                opcionElegida = '6 meses';
            } else {
                // Intentar mapeo directo
                opcionElegida = valor.toString();
            }

            const opcion = Array.from(elemento.options).find(opt =>
                opt.value === opcionElegida || opt.text === opcionElegida
            );
            if (opcion) {
                elemento.value = opcion.value;
            }
        } else {
            // Comportamiento normal para otros selects
            const opcion = Array.from(elemento.options).find(opt =>
                opt.value === valor ||
                opt.text === valor ||
                opt.text.toLowerCase().includes(valor.toString().toLowerCase()) ||
                valor.toString().toLowerCase().includes(opt.text.toLowerCase())
            );
            if (opcion) {
                elemento.value = opcion.value;
            }
        }
    } else {
        // Campos de texto normales
        elemento.value = valor.toString();
    }
}

/**
 * Busca un campo de texto asociado a un checkbox (para casos como KPIs)
 */
function buscarCampoTextoAsociado(checkboxElement) {
    // Buscar en el mismo contenedor
    const contenedor = checkboxElement.closest('.campo-obligatorio, .mb-3, .form-group');
    if (contenedor) {
        const campoTexto = contenedor.querySelector('textarea, input[type="text"]');
        if (campoTexto && campoTexto !== checkboxElement) {
            return campoTexto;
        }
    }

    // Buscar hermanos cercanos
    let siguiente = checkboxElement.parentElement.nextElementSibling;
    for (let i = 0; i < 3 && siguiente; i++) {
        const campo = siguiente.querySelector('textarea, input[type="text"]');
        if (campo) return campo;
        siguiente = siguiente.nextElementSibling;
    }

    return null;
}

/**
 * Función específica para manejar el campo problemático de KPIs Principales
 */
function manejarCampoKPIsProblematico() {
    // Buscar el campo KPIs Principales problemático
    const checkboxKPIs = Array.from(document.querySelectorAll('input[type="checkbox"]')).find(cb => {
        const etiqueta = obtenerEtiquetaCampo(cb);
        return etiqueta && etiqueta.toLowerCase().includes('kpis principales');
    });

    if (checkboxKPIs && checkboxKPIs.required) {
        console.log('🔧 Campo KPIs Principales problemático detectado');

        // Crear un botón de ayuda junto al campo
        const contenedor = checkboxKPIs.closest('.campo-obligatorio, .mb-3');
        if (contenedor && !contenedor.querySelector('.kpis-helper')) {
            const helper = document.createElement('div');
            helper.className = 'kpis-helper mt-2';
            helper.innerHTML = `
                <div class="alert alert-warning small">
                    <strong>💡 Ayuda:</strong> Este checkbox debe marcarse para cumplir con el formulario.
                    Los KPIs específicos se pueden añadir en el campo de observaciones o mediante el sistema de IA.
                    <button type="button" class="btn btn-sm btn-outline-warning ms-2" onclick="marcarKPIsAutomaticamente()">
                        <i class="fas fa-magic"></i> Marcar automáticamente
                    </button>
                </div>
            `;
            contenedor.appendChild(helper);
        }

        return checkboxKPIs;
    }

    return null;
}

/**
 * Marca automáticamente el checkbox de KPIs problemático
 */
function marcarKPIsAutomaticamente() {
    const checkboxKPIs = Array.from(document.querySelectorAll('input[type="checkbox"]')).find(cb => {
        const etiqueta = obtenerEtiquetaCampo(cb);
        return etiqueta && etiqueta.toLowerCase().includes('kpis principales');
    });

    if (checkboxKPIs) {
        checkboxKPIs.checked = true;

        // Mostrar confirmación
        const contenedor = checkboxKPIs.closest('.campo-obligatorio, .mb-3');
        if (contenedor) {
            const confirmacion = document.createElement('div');
            confirmacion.className = 'alert alert-success small mt-1';
            confirmacion.innerHTML = '✅ KPIs marcado correctamente. Define los KPIs específicos en otros campos.';
            contenedor.appendChild(confirmacion);

            // Ocultar después de 3 segundos
            setTimeout(() => {
                if (confirmacion.parentNode) {
                    confirmacion.remove();
                }
            }, 3000);
        }
    }
}

/**
 * Búsqueda inteligente de campos por similitud de etiquetas y contenido
 */
function aplicarDatosInteligente(datos) {
    let camposAplicados = 0;
    const errores = [];

    // Mapeo de palabras clave del JSON a posibles textos en el formulario
    const mapeoPalabrasClave = {
        // Info general
        'cliente': ['cliente', 'nombre cliente', 'empresa'],
        'fecha': ['fecha'],
        'consultor': ['consultor', 'responsable'],
        'nombre_empresa': ['nombre empresa', 'empresa', 'compañía'],
        'sector_industria': ['sector', 'industria', 'rubro'],
        'tamano_empresa': ['tamaño empresa', 'tamaño', 'size'],
        'anos_mercado': ['años mercado', 'años', 'tiempo mercado'],
        'ubicacion_principal': ['ubicación', 'localización', 'sede'],
        'mercados_opera': ['mercados', 'países', 'regiones'],

        // Website
        'url_principal': ['url', 'sitio web', 'website', 'dominio'],
        'dominios_adicionales': ['dominios adicionales', 'otros dominios'],
        'lanzamiento_web': ['lanzamiento', 'fecha lanzamiento'],
        'ultima_remodelacion': ['remodelación', 'rediseño'],

        // Modelo de negocio
        'tipo_negocio': ['tipo negocio', 'modelo'],
        'productos_servicios': ['productos', 'servicios'],
        'propuesta_valor': ['propuesta valor', 'diferencial'],
        'objetivo_principal': ['objetivo principal', 'meta'],
        'monetizacion': ['monetización', 'ingresos'],

        // Público objetivo
        'target_edad': ['edad', 'rango edad'],
        'target_ubicacion': ['ubicación target', 'mercado objetivo'],
        'tiene_estacionalidad': ['estacionalidad'],

        // SEO
        'han_hecho_seo': ['seo anterior', 'han hecho seo'],
        'keywords_prioritarias': ['keywords', 'palabras clave'],

        // Timeline
        'cuando_auditoria': ['cuándo auditoría', 'plazo'],
        'cuando_implementar': ['cuándo implementar'],

        // KPIs y métricas (campo problemático en formulario)
        'kpis_actuales': ['kpis', 'métricas', 'indicadores'],
        'kpis_principales': ['kpis principales', 'métricas principales', 'kpis más importantes'],
        'objetivos_kpis': ['objetivos kpis', 'metas métricas'],

        // Timeline específico
        'timeline_implementacion': ['timeline', 'cronograma', 'plazo implementación'],

        // Técnico
        'desarrollador_interno': ['desarrollador', 'equipo técnico'],
        'pueden_implementar': ['implementar cambios'],
        'recursos_internos': ['recursos internos', 'equipo seo'],
        'expectativas_principales': ['expectativas', 'objetivos', 'que espera']
    };

    // Obtener todos los campos del formulario con sus etiquetas
    const campos = document.querySelectorAll('#formulario-dinamico input, #formulario-dinamico textarea, #formulario-dinamico select');

    Object.entries(datos).forEach(([clave, valor]) => {
        if (valor === undefined || valor === null || valor === '') return;

        const palabrasClave = mapeoPalabrasClave[clave] || [clave];
        let campoEncontrado = false;

        // Buscar campo por similitud de etiqueta
        campos.forEach(campo => {
            if (campoEncontrado || campo.type === 'hidden') return;

            // Obtener etiqueta del campo
            const etiqueta = obtenerEtiquetaCampo(campo);
            if (!etiqueta) return;

            // Verificar si alguna palabra clave coincide
            const coincide = palabrasClave.some(palabra =>
                etiqueta.toLowerCase().includes(palabra.toLowerCase()) ||
                palabra.toLowerCase().includes(etiqueta.toLowerCase())
            );

            if (coincide) {
                try {
                    aplicarValorACampo(campo, valor);
                    camposAplicados++;
                    campoEncontrado = true;
                    console.log(`Campo inteligente aplicado: "${clave}" -> "${etiqueta}"`);
                } catch (error) {
                    errores.push(`Error aplicando "${clave}" a "${etiqueta}": ${error.message}`);
                }
            }
        });

        if (!campoEncontrado) {
            errores.push(`No se encontró campo similar para "${clave}"`);
        }
    });

    return { camposAplicados, errores };
}

/**
 * Obtiene la etiqueta de un campo del formulario
 */
function obtenerEtiquetaCampo(campo) {
    // Buscar por ID del campo
    if (campo.id) {
        const label = document.querySelector(`label[for="${campo.id}"]`);
        if (label) return label.textContent.replace(' *', '').trim();
    }

    // Buscar label padre
    const labelPadre = campo.closest('label');
    if (labelPadre) return labelPadre.textContent.replace(' *', '').trim();

    // Buscar label hermano anterior
    const labelHermano = campo.previousElementSibling;
    if (labelHermano && labelHermano.tagName === 'LABEL') {
        return labelHermano.textContent.replace(' *', '').trim();
    }

    // Usar placeholder o nombre del campo
    return campo.placeholder || campo.name || '';
}

/**
 * Función para inspeccionar y mostrar la estructura real del formulario
 */
function inspeccionarFormularioReal() {
    const campos = document.querySelectorAll('#formulario-dinamico input, #formulario-dinamico textarea, #formulario-dinamico select');
    const estructura = [];

    campos.forEach((campo, index) => {
        if (campo.type === 'hidden') return;

        const info = {
            indice: index,
            name: campo.name,
            id: campo.id,
            type: campo.type || campo.tagName.toLowerCase(),
            etiqueta: obtenerEtiquetaCampo(campo),
            placeholder: campo.placeholder,
            required: campo.required,
            valor_actual: campo.value
        };

        estructura.push(info);
    });

    return estructura;
}

/**
 * Función para mostrar los campos del formulario en consola
 */
function mostrarCamposFormulario() {
    const campos = inspeccionarFormularioReal();
    console.log('📋 CAMPOS REALES DEL FORMULARIO:', campos);
    console.table(campos);
    return campos;
}

/**
 * Función para generar mapeo automático basado en campos reales
 */
function generarMapeoAutomatico() {
    const campos = inspeccionarFormularioReal();
    const mapeoGenerado = {};

    // Mapeo de datos JSON a posibles etiquetas de campos
    const correspondencias = {
        // Info general
        'info_general.cliente': ['cliente', 'nombre cliente'],
        'info_general.fecha': ['fecha'],
        'info_general.consultor': ['consultor', 'responsable'],
        'info_general.nombre_empresa': ['nombre empresa', 'empresa', 'compañía'],
        'info_general.sector_industria': ['sector', 'industria'],
        'info_general.tamano_empresa': ['tamaño empresa', 'tamaño'],
        'info_general.anos_mercado': ['años mercado', 'años'],
        'info_general.ubicacion_principal': ['ubicación', 'localización'],
        'info_general.mercados_opera': ['mercados', 'países'],

        // Website
        'website.url_principal': ['url', 'sitio web', 'website'],
        'website.dominios_adicionales': ['dominios'],
        'website.lanzamiento_web': ['lanzamiento'],
        'website.ultima_remodelacion': ['remodelación'],

        // Modelo de negocio
        'modelo_negocio.tipo_negocio': ['tipo negocio', 'modelo'],
        'modelo_negocio.productos_servicios': ['productos', 'servicios'],
        'modelo_negocio.propuesta_valor': ['propuesta', 'valor'],
        'modelo_negocio.objetivo_principal': ['objetivo'],

        // Más correspondencias...
    };

    Object.entries(correspondencias).forEach(([claveJSON, posiblesEtiquetas]) => {
        const campoEncontrado = campos.find(campo => {
            const etiqueta = campo.etiqueta.toLowerCase();
            return posiblesEtiquetas.some(posible =>
                etiqueta.includes(posible.toLowerCase())
            );
        });

        if (campoEncontrado) {
            mapeoGenerado[claveJSON] = {
                campo_name: campoEncontrado.name,
                campo_id: campoEncontrado.id,
                etiqueta: campoEncontrado.etiqueta,
                tipo: campoEncontrado.type
            };
        }
    });

    console.log('🔄 MAPEO AUTOMÁTICO GENERADO:', mapeoGenerado);
    return mapeoGenerado;
}

// Exportar funciones para uso global
window.BRIEF_CLIENTE_SCHEMA = BRIEF_CLIENTE_SCHEMA;
window.EJEMPLO_BRIEF_COMPLETO = EJEMPLO_BRIEF_COMPLETO;
window.generarPlantillaMejoradaCliente = generarPlantillaMejoradaCliente;
window.validarJSONBriefCliente = validarJSONBriefCliente;
window.mapearDatosBriefCliente = mapearDatosBriefCliente;
window.aplicarDatosMapeados = aplicarDatosMapeados;
window.inspeccionarFormularioReal = inspeccionarFormularioReal;
window.mostrarCamposFormulario = mostrarCamposFormulario;
window.generarMapeoAutomatico = generarMapeoAutomatico;
window.manejarCampoKPIsProblematico = manejarCampoKPIsProblematico;
window.marcarKPIsAutomaticamente = marcarKPIsAutomaticamente;

// Ejecutar automáticamente cuando se carga en un formulario del brief
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        // Detectar si estamos en un formulario del brief
        if (document.title.includes('BRIEF') || document.querySelector('.breadcrumb-item.active')?.textContent.includes('BRIEF')) {
            setTimeout(() => {
                manejarCampoKPIsProblematico();
            }, 1000);
        }
    });
} else {
    // Si ya está cargado, ejecutar inmediatamente
    setTimeout(() => {
        if (document.title.includes('BRIEF') || document.querySelector('.breadcrumb-item.active')?.textContent.includes('BRIEF')) {
            manejarCampoKPIsProblematico();
        }
    }, 500);
}