# Instrucciones para completar los módulos de la auditoría web (extendido)

Este documento detalla, por página/módulo del informe, qué datos cargar, desde qué fuentes obtenerlos, y cómo validar. Los módulos de análisis manual requieren evidencias (capturas, checklist, tabla resumen). No se debe inventar datos: si una fuente no está disponible, documentar el motivo y el paso para habilitarla.

- Ruta destino de CSVs: `ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/data/`
- Formato CSV: separador `,`, codificación `UTF-8`, primera fila con encabezados exactos.
- Normalización: fechas ISO (`YYYY-MM-DD`), países ISO-3166 alfa-2, dispositivos (`desktop`,`mobile`,`tablet`), motores (`google`,`bing`,`yahoo`,`duckduckgo`…)
- Fuentes típicas: GA4, Google Search Console (GSC), Ahrefs/SISTRIX/SEMrush, Screaming Frog, BigQuery, CMS, capturas.

## Índice de secciones
- Sección 01 — Tráfico y canales (páginas 003–015)
- Sección 02 — SEO orgánico (páginas 016–019)
- Sección 03 — SEO On-Page (páginas 025–046)
- Sección 04 — Enlazado interno, Headings y Contenido (páginas 047–071)
- Sección 05 — Imágenes, Datos Estructurados, Rich Snippets, Idiomas y Accesibilidad (páginas 072–090)
- Sección 06 — Accesibilidad avanzada e Indexabilidad (páginas 091–110)
- Sección 07 — Indexabilidad y SEO Off-Page (páginas 111–129)
- Sección 08 — Priorización de Tareas (páginas 130–133)

## Estándar de formato
- Encabezado: `### Página N — Título`
- Bloques por página: `Fuente:`, `Acción:`, `Evidencias:`
- Idioma y nomenclatura consistentes (usar "Off-Page", guion `/` para rutas, comillas invertidas en código)
- CSVs opcionales: incluir nombre de archivo y columnas cuando aplique

## Sección 01 — Tráfico y canales (páginas 003–015)

### Página 003 — Tráfico orgánico general
- Fuente: GA4
- Acción: extraer métricas generales de tráfico orgánico (sesiones, usuarios, páginas vistas, duración promedio, tasa de rebote) para período de análisis.
- Evidencias: CSV `trafico_organico_general.csv` con columnas: fecha, sesiones_organicas, usuarios_organicos, paginas_vistas, duracion_promedio_sesion, tasa_rebote.

- Explicación: el análisis del tráfico orgánico general proporciona la línea base para evaluar el rendimiento SEO y identificar tendencias de crecimiento o declive.
- Análisis: segmentar datos por períodos comparables, identificar patrones estacionales, correlacionar con eventos de algoritmo o cambios técnicos, evaluar calidad del tráfico mediante métricas de engagement.
- Solución: establecer benchmarks de rendimiento, identificar oportunidades de mejora en páginas con alto tráfico pero bajo engagement, optimizar para retención de usuarios.
- Prioridad: A por ser métrica fundamental para evaluación de estrategia SEO.
- Definición de Hecho: datos completos de tráfico orgánico con tendencias identificadas y benchmarks establecidos para seguimiento continuo.

### Página 004 — Tráfico por canales
- Fuente: GA4
- Acción: desglosar tráfico por canal de adquisición (orgánico, directo, referral, social, email, paid) con métricas de conversión por canal.
- Evidencias: CSV `trafico_por_canales.csv` con columnas: canal, sesiones, usuarios, conversiones, valor_conversion, costo_adquisicion.

- Explicación: la distribución del tráfico por canales revela la efectividad de cada fuente y permite optimizar la asignación de recursos de marketing.
- Análisis: calcular ROI por canal, identificar canales con mejor calidad de tráfico, evaluar dependencia excesiva de canales específicos, analizar complementariedad entre canales.
- Solución: diversificar fuentes de tráfico, optimizar canales de alto rendimiento, reducir dependencia de canales volátiles, mejorar attribution modeling.
- Prioridad: A para estrategia de marketing integral; B para optimizaciones específicas por canal.
- Definición de Hecho: distribución equilibrada de tráfico con métricas de calidad optimizadas por canal y reducción de riesgos de dependencia.

### Página 005 — Páginas de aterrizaje orgánico
- Fuente: GA4, Google Search Console
- Acción: identificar top páginas de aterrizaje orgánico con métricas de rendimiento (tráfico, conversiones, posición promedio, CTR).
- Evidencias: CSV `landing_pages_organico.csv` con columnas: url, sesiones_organicas, conversiones, posicion_promedio, ctr, impresiones.

- Explicación: las páginas de aterrizaje orgánico son el primer punto de contacto con usuarios de búsqueda y determinan la efectividad de la estrategia de contenido.
- Análisis: correlacionar rendimiento de páginas con posiciones en SERP, identificar páginas con alto potencial pero bajo rendimiento, evaluar alineación entre intención de búsqueda y contenido.
- Solución: optimizar páginas de alto tráfico para mejorar conversiones, mejorar CTR de páginas bien posicionadas, crear contenido para keywords de alto potencial sin cobertura.
- Prioridad: A en páginas con alto tráfico o potencial comercial; B en optimizaciones de páginas de soporte.
- Definición de Hecho: páginas de aterrizaje optimizadas con mejoras medibles en CTR, conversiones y posicionamiento.

### Página 006 — Países y dispositivos
- Fuente: GA4
- Acción: analizar distribución geográfica y por tipo de dispositivo del tráfico orgánico con métricas de engagement por segmento.
- Evidencias: CSV `paises_dispositivos.csv` con columnas: pais, dispositivo, sesiones, usuarios, tasa_rebote, duracion_sesion, conversiones.

- Explicación: la segmentación geográfica y por dispositivo revela oportunidades de localización y optimización técnica específica para diferentes audiencias.
- Análisis: identificar mercados geográficos de alto potencial, evaluar rendimiento mobile vs desktop, detectar problemas de usabilidad por dispositivo, analizar patrones de comportamiento por región.
- Solución: implementar estrategias de SEO local para mercados prioritarios, optimizar experiencia mobile, personalizar contenido por región, mejorar velocidad de carga por dispositivo.
- Prioridad: A para mercados principales y optimización mobile; B para mercados secundarios y dispositivos específicos.
- Definición de Hecho: estrategia de segmentación implementada con mejoras medibles en engagement por país y dispositivo.

### Página 007 — Motores de búsqueda
- Fuente: GA4, Google Search Console
- Acción: evaluar distribución de tráfico por motor de búsqueda (Google, Bing, Yahoo, DuckDuckGo) y rendimiento específico por motor.
- Evidencias: CSV `motores_busqueda.csv` con columnas: motor, sesiones, usuarios, conversiones, queries_top, posicion_promedio.

- Explicación: aunque Google domina, otros motores pueden representar oportunidades específicas y audiencias diferenciadas que requieren estrategias adaptadas.
- Análisis: evaluar cuota de mercado por motor, identificar diferencias en comportamiento de usuarios, analizar keywords específicas por motor, detectar oportunidades en motores alternativos.
- Solución: optimizar para algoritmos específicos de cada motor, adaptar estrategia de contenido para audiencias diferenciadas, aprovechar nichos en motores alternativos.
- Prioridad: A para Google como motor principal; B para optimizaciones específicas en motores alternativos.
- Definición de Hecho: estrategia multi-motor implementada con crecimiento medible en tráfico de motores secundarios.

### Página 008 — Distribución temporal
- Fuente: GA4
- Acción: analizar patrones temporales de tráfico orgánico (horarios, días de semana, estacionalidad) para optimizar timing de contenido.
- Evidencias: CSV `distribucion_temporal.csv` con columnas: fecha, hora, dia_semana, sesiones, conversiones, engagement_score.

- Explicación: los patrones temporales revelan cuándo la audiencia está más activa y receptiva, permitiendo optimizar la publicación y promoción de contenido.
- Análisis: identificar picos de tráfico por hora y día, detectar patrones estacionales, correlacionar timing con conversiones, evaluar oportunidades de contenido time-sensitive.
- Solución: programar publicaciones en horarios óptimos, crear contenido estacional, ajustar campañas según patrones de audiencia, optimizar disponibilidad de recursos en picos.
- Prioridad: B para optimización de timing; A si hay patrones críticos para el negocio.
- Definición de Hecho: estrategia de timing implementada con mejoras en engagement y conversiones durante períodos optimizados.

### Página 009 — Conversiones
- Fuente: GA4
- Acción: analizar conversiones del tráfico orgánico por tipo (compras, leads, suscripciones) y funnel de conversión.
- Evidencias: CSV `conversiones_organico.csv` con columnas: tipo_conversion, sesiones, conversiones, tasa_conversion, valor_promedio, fuente_trafico.

- Explicación: las conversiones del tráfico orgánico miden la efectividad real de la estrategia SEO en términos de objetivos de negocio.
- Análisis: calcular ROI del tráfico orgánico, identificar páginas con mejor tasa de conversión, analizar funnel de conversión para detectar puntos de fuga, segmentar conversiones por tipo de usuario.
- Solución: optimizar páginas de alta conversión para mayor tráfico, mejorar funnel en puntos de fuga, crear landing pages específicas para keywords comerciales, implementar CRO en páginas críticas.
- Prioridad: A por impacto directo en objetivos de negocio.
- Definición de Hecho: tasa de conversión del tráfico orgánico optimizada con incremento medible en valor generado por SEO.

### Página 010 — Sesiones año sobre año
- Fuente: GA4
- Acción: comparar métricas de sesiones orgánicas año sobre año para evaluar crecimiento y tendencias de largo plazo.
- Evidencias: CSV `sesiones_yoy.csv` con columnas: mes, año_actual, año_anterior, crecimiento_porcentual, sesiones_nuevas, sesiones_recurrentes.

- Explicación: la comparación año sobre año elimina efectos estacionales y proporciona una visión clara del crecimiento real del tráfico orgánico.
- Análisis: calcular tasas de crecimiento por período, identificar factores que impactan el crecimiento, correlacionar con cambios de algoritmo o mejoras técnicas, evaluar sostenibilidad del crecimiento.
- Solución: identificar y replicar factores de crecimiento exitosos, corregir declives identificados, establecer objetivos realistas basados en tendencias históricas.
- Prioridad: A para evaluación estratégica y planificación de objetivos.
- Definición de Hecho: tendencia de crecimiento sostenible establecida con factores de éxito identificados y replicables.

### Página 011 — Análisis de retención de usuarios
- Fuente: GA4
- Acción: evaluar retención de usuarios orgánicos (usuarios recurrentes, frecuencia de visita, lifetime value) para medir calidad del tráfico.
- Evidencias: CSV `retencion_usuarios.csv` con columnas: cohorte, usuarios_nuevos, retencion_dia7, retencion_dia30, sesiones_promedio, valor_lifetime.

- Explicación: la retención de usuarios orgánicos indica la calidad del tráfico SEO y la efectividad del contenido para generar engagement a largo plazo.
- Análisis: segmentar usuarios por cohortes de adquisición, calcular métricas de retención por período, identificar contenido que genera mayor fidelización, evaluar valor de usuario orgánico vs otros canales.
- Solución: crear contenido que fomente retención, implementar estrategias de re-engagement, optimizar experiencia de usuario recurrente, desarrollar programas de fidelización.
- Prioridad: A para negocios con modelo de suscripción o compra recurrente; B para transacciones únicas.
- Definición de Hecho: métricas de retención mejoradas con estrategias específicas para aumentar lifetime value de usuarios orgánicos.

### Página 012 — Velocidad de página y Core Web Vitals
- Fuente: GA4, Google Search Console, PageSpeed Insights
- Acción: correlacionar métricas de velocidad con rendimiento de tráfico orgánico y identificar impacto en conversiones.
- Evidencias: CSV `velocidad_trafico.csv` con columnas: url, lcp, fid, cls, velocidad_movil, velocidad_desktop, sesiones, tasa_rebote.

- Explicación: la velocidad de página es factor de ranking y experiencia de usuario que impacta directamente en el rendimiento del tráfico orgánico.
- Análisis: correlacionar Core Web Vitals con métricas de tráfico, identificar páginas críticas con problemas de velocidad, evaluar impacto en conversiones y engagement.
- Solución: priorizar optimización de velocidad en páginas de alto tráfico, implementar mejoras técnicas específicas, monitorear impacto de optimizaciones en métricas SEO.
- Prioridad: A para páginas críticas con problemas de velocidad; B para optimizaciones preventivas.
- Definición de Hecho: Core Web Vitals optimizados con mejoras medibles en tráfico orgánico y conversiones.

### Página 013 — Análisis de contenido por rendimiento
- Fuente: GA4, Ahrefs
- Acción: evaluar rendimiento de diferentes tipos de contenido (blog, productos, categorías) en términos de tráfico orgánico y engagement.
- Evidencias: CSV `contenido_rendimiento.csv` con columnas: tipo_contenido, url, sesiones_organicas, tiempo_pagina, tasa_rebote, backlinks, posicion_promedio.

- Explicación: diferentes tipos de contenido tienen patrones de rendimiento distintos que requieren estrategias de optimización específicas.
- Análisis: segmentar contenido por tipo y evaluar métricas específicas, identificar formatos de alto rendimiento, correlacionar autoridad de página con tráfico orgánico.
- Solución: replicar formatos exitosos, optimizar tipos de contenido de bajo rendimiento, crear estrategias específicas por tipo de página.
- Prioridad: A para tipos de contenido críticos para el negocio; B para optimizaciones de contenido de soporte.
- Definición de Hecho: estrategia de contenido optimizada por tipo con mejoras medibles en rendimiento orgánico.

### Página 014 — Análisis de keywords por intención
- Fuente: Google Search Console, GA4
- Acción: segmentar tráfico orgánico por intención de búsqueda (informacional, navegacional, transaccional) y evaluar rendimiento por segmento.
- Evidencias: CSV `keywords_intencion.csv` con columnas: keyword, intencion, impresiones, clics, ctr, posicion, conversiones.

- Explicación: la segmentación por intención de búsqueda permite optimizar contenido específicamente para diferentes etapas del customer journey.
- Análisis: clasificar keywords por intención, evaluar rendimiento por segmento, identificar gaps en cobertura de intenciones, correlacionar intención con conversiones.
- Solución: crear contenido específico para intenciones desatendidas, optimizar funnel por tipo de intención, mejorar alineación contenido-intención.
- Prioridad: A para intenciones transaccionales; B para informacionales y navegacionales.
- Definición de Hecho: cobertura completa de intenciones de búsqueda con contenido optimizado y conversiones mejoradas por segmento.

### Página 015 — Análisis de competencia en tráfico orgánico
- Fuente: Ahrefs, SEMrush, GA4
- Acción: comparar rendimiento de tráfico orgánico vs competidores principales y identificar oportunidades de crecimiento.
- Evidencias: CSV `competencia_trafico.csv` con columnas: competidor, trafico_estimado, keywords_comunes, gap_keywords, share_of_voice.

- Explicación: el análisis competitivo revela oportunidades de crecimiento y benchmarks realistas para el rendimiento del tráfico orgánico.
- Análisis: identificar competidores con mejor rendimiento, analizar keywords donde compiten, detectar gaps de contenido, evaluar share of voice por categoría.
- Solución: crear contenido para keywords de competidores, mejorar páginas donde se compite directamente, identificar nichos desatendidos por competencia.
- Prioridad: A para keywords de alto valor comercial; B para oportunidades de nicho.
- Definición de Hecho: estrategia competitiva implementada con crecimiento en share of voice y captura de keywords objetivo.

## Sección 02 — SEO orgánico (páginas 016–019)

### Página 016 — Posiciones por categoría
- Fuente: Ahrefs, SEMrush, Google Search Console
- Acción: mapear posiciones promedio por categoría de producto/servicio y identificar oportunidades de mejora por segmento.
- Evidencias: CSV `posiciones_categoria.csv` con columnas: categoria, keyword, posicion_actual, volumen_busqueda, dificultad, url_ranking.

- Explicación: el análisis de posiciones por categoría permite priorizar esfuerzos SEO en segmentos con mayor potencial de impacto comercial.
- Análisis: calcular posición promedio por categoría, identificar categorías con mejor/peor rendimiento, evaluar correlación entre posición y tráfico, detectar oportunidades de quick wins.
- Solución: priorizar optimización en categorías de alto valor comercial, implementar mejoras técnicas en categorías de bajo rendimiento, crear contenido de soporte para categorías emergentes.
- Prioridad: A para categorías principales del negocio; B para categorías de soporte o nicho.
- Definición de Hecho: mejora medible en posiciones promedio por categoría con incremento en tráfico orgánico segmentado.

### Página 017 — Índice de visibilidad
- Fuente: SISTRIX, SEMrush, Ahrefs
- Acción: monitorear evolución del índice de visibilidad general y por categorías para evaluar rendimiento SEO integral.
- Evidencias: CSV `indice_visibilidad.csv` con columnas: fecha, visibilidad_general, visibilidad_por_categoria, competidores_benchmark, cambios_algoritmo.

- Explicación: el índice de visibilidad proporciona una métrica unificada del rendimiento SEO que permite comparaciones temporales y competitivas.
- Análisis: evaluar tendencias de visibilidad a largo plazo, correlacionar cambios con actualizaciones de algoritmo, comparar con competidores, identificar factores de impacto.
- Solución: implementar estrategias para mejorar visibilidad en categorías críticas, corregir declives identificados, mantener crecimiento sostenible de visibilidad.
- Prioridad: A para monitoreo estratégico y detección temprana de problemas.
- Definición de Hecho: índice de visibilidad estable o en crecimiento con factores de mejora identificados y monitoreados.

### Página 018 — Comparación vs sector
- Fuente: SEMrush, Ahrefs, datos de industria
- Acción: benchmarking del rendimiento SEO vs promedio del sector y competidores directos en métricas clave.
- Evidencias: CSV `benchmark_sector.csv` con columnas: metrica, valor_propio, promedio_sector, top_competidor, gap_mejora, percentil_industria.

- Explicación: la comparación sectorial contextualiza el rendimiento SEO y establece objetivos realistas basados en benchmarks de industria.
- Análisis: identificar métricas donde se está por encima/debajo del sector, evaluar gaps competitivos, detectar mejores prácticas de líderes del sector.
- Solución: implementar mejores prácticas del sector, cerrar gaps críticos vs competencia, establecer objetivos basados en benchmarks realistas.
- Prioridad: A para métricas críticas donde se está por debajo del sector; B para optimizaciones de liderazgo.
- Definición de Hecho: rendimiento SEO posicionado en percentiles superiores del sector con gaps competitivos cerrados.

### Página 019 — Queries GSC
- Fuente: Google Search Console
- Acción: analizar queries de búsqueda con mayor potencial (alto volumen, baja posición) y optimizar contenido correspondiente.
- Evidencias: CSV `queries_gsc.csv` con columnas: query, impresiones, clics, ctr, posicion, url_landing, potencial_mejora.

- Explicación: las queries de GSC revelan oportunidades reales de mejora basadas en búsquedas donde ya se tiene presencia pero con rendimiento subóptimo.
- Análisis: identificar queries con alto volumen y baja posición, evaluar CTR vs posición para detectar problemas de relevancia, priorizar por potencial de tráfico.
- Solución: optimizar contenido para queries de alto potencial, mejorar títulos y meta descriptions para aumentar CTR, crear contenido específico para queries desatendidas.
- Prioridad: A para queries con alto potencial de tráfico; B para optimizaciones de long tail.
- Definición de Hecho: mejoras medibles en posición y CTR para queries prioritarias con incremento en tráfico orgánico.

## Sección 03 — SEO On-Page (páginas 025–046)

### Página 025 — Auditoría técnica general
- Fuente: Screaming Frog, Google Search Console, herramientas técnicas
- Acción: evaluación integral de aspectos técnicos SEO (crawlability, indexabilidad, arquitectura, rendimiento técnico).
- Evidencias: reporte técnico completo con priorización de issues y roadmap de correcciones.

- Explicación: la auditoría técnica identifica barreras que impiden el óptimo rendimiento SEO y establece las bases para mejoras sostenibles.
- Análisis: crawlear sitio completo, identificar errores técnicos críticos, evaluar arquitectura de información, revisar implementación de estándares técnicos.
- Solución: corregir errores críticos que bloquean indexación, optimizar arquitectura para mejor crawling, implementar mejores prácticas técnicas.
- Prioridad: A para errores que impactan indexación; B para optimizaciones de rendimiento.
- Definición de Hecho: sitio técnicamente optimizado sin barreras críticas para crawling e indexación.

### Página 026 — Estructura de URLs
- Fuente: Screaming Frog, análisis manual
- Acción: evaluar estructura de URLs (longitud, keywords, jerarquía, consistencia) y proponer optimizaciones.
- Evidencias: inventario de URLs con propuestas de mejora y plan de redirects si necesario.

- Explicación: las URLs optimizadas mejoran la comprensión del contenido por motores de búsqueda y usuarios, facilitando el crawling y la experiencia de navegación.
- Análisis: revisar longitud y estructura de URLs, evaluar uso de keywords relevantes, verificar consistencia en nomenclatura, identificar URLs problemáticas.
- Solución: establecer estructura consistente de URLs, incluir keywords relevantes, mantener URLs cortas y descriptivas, implementar redirects para cambios necesarios.
- Prioridad: A para URLs de páginas críticas; B para optimizaciones generales de estructura.
- Definición de Hecho: estructura de URLs optimizada y consistente que mejora crawlability y user experience.

### Página 027 — Meta títulos y descripciones
- Fuente: Screaming Frog, Google Search Console
- Acción: auditar meta títulos y descripciones (longitud, keywords, duplicados, CTR potencial) y optimizar para mejor rendimiento.
- Evidencias: CSV con meta tags actuales, propuestas de mejora y priorización por impacto.

- Explicación: los meta títulos y descripciones son elementos críticos para CTR en SERPs y comunicación de relevancia a motores de búsqueda.
- Análisis: evaluar longitud óptima, uso de keywords objetivo, detectar duplicados, analizar CTR actual vs potencial, revisar alineación con contenido.
- Solución: optimizar títulos para keywords objetivo manteniendo naturalidad, crear descripciones persuasivas que mejoren CTR, eliminar duplicados.
- Prioridad: A para páginas de alto tráfico o potencial; B para optimizaciones generales.
- Definición de Hecho: meta tags optimizados que mejoran CTR y comunicación de relevancia en SERPs.

### Página 028 — Encabezados H1-H6
- Fuente: Screaming Frog, análisis manual
- Acción: revisar estructura jerárquica de encabezados, uso de keywords y consistencia en implementación.
- Evidencias: mapa de estructura de encabezados por plantilla con recomendaciones de mejora.

- Explicación: la estructura correcta de encabezados mejora la comprensión del contenido, accesibilidad y señales semánticas para SEO.
- Análisis: verificar jerarquía lógica sin saltos de nivel, evaluar H1 único por página, revisar uso de keywords en encabezados, analizar consistencia por plantilla.
- Solución: corregir jerarquía de encabezados, optimizar H1 para keyword principal, distribuir keywords secundarias en H2-H3, mantener consistencia.
- Prioridad: A para páginas críticas con problemas de jerarquía; B para optimizaciones de keywords.
- Definición de Hecho: estructura de encabezados optimizada que mejora semántica y accesibilidad del contenido.

### Página 029 — Contenido duplicado interno
- Fuente: Screaming Frog, herramientas de contenido duplicado
- Acción: identificar contenido duplicado interno y implementar soluciones (canonical, noindex, reescritura).
- Evidencias: reporte de contenido duplicado con URLs afectadas y plan de resolución.

- Explicación: el contenido duplicado diluye la autoridad de página y puede causar problemas de indexación y canibalización de keywords.
- Análisis: detectar páginas con contenido similar o idéntico, evaluar impacto en indexación, identificar causas técnicas de duplicación.
- Solución: implementar canonical tags apropiados, reescribir contenido duplicado, usar noindex cuando sea necesario, corregir causas técnicas.
- Prioridad: A para duplicación que afecta páginas críticas; B para duplicación menor.
- Definición de Hecho: contenido duplicado resuelto con implementación correcta de señales de canonicalización.

### Página 030 — Optimización de imágenes
- Fuente: Screaming Frog, análisis manual
- Acción: auditar optimización de imágenes (alt text, nombres de archivo, tamaños, formatos, lazy loading).
- Evidencias: inventario de imágenes con estado de optimización y recomendaciones técnicas.

- Explicación: las imágenes optimizadas mejoran la velocidad de carga, accesibilidad y proporcionan oportunidades adicionales de posicionamiento.
- Análisis: revisar alt text descriptivo, evaluar nombres de archivo optimizados, verificar tamaños y formatos apropiados, analizar implementación de lazy loading.
- Solución: añadir alt text descriptivo con keywords relevantes, optimizar tamaños y formatos, implementar lazy loading, usar nombres descriptivos.
- Prioridad: A para imágenes en páginas críticas; B para optimización general del sitio.
- Definición de Hecho: imágenes completamente optimizadas que mejoran velocidad, accesibilidad y oportunidades SEO.

### Página 031 — Enlaces internos
- Fuente: Screaming Frog, análisis manual
- Acción: evaluar estrategia de enlazado interno (distribución de autoridad, anchor text, profundidad de página).
- Evidencias: mapa de enlazado interno con métricas de distribución y oportunidades de mejora.

- Explicación: el enlazado interno efectivo distribuye autoridad, mejora crawlability y facilita la navegación de usuarios y bots.
- Análisis: mapear flujo de autoridad interna, evaluar anchor text utilizado, medir profundidad de páginas importantes, identificar páginas huérfanas.
- Solución: crear enlaces contextuales relevantes, optimizar anchor text para keywords objetivo, reducir profundidad de páginas importantes.
- Prioridad: A para distribución de autoridad a páginas críticas; B para mejoras generales de navegación.
- Definición de Hecho: estrategia de enlazado interno optimizada que mejora distribución de autoridad y crawlability.

### Página 032 — Schema markup y datos estructurados
- Fuente: Google Search Console, herramientas de validación de schema
- Acción: auditar implementación de datos estructurados y optimizar para rich snippets y mejor comprensión del contenido.
- Evidencias: reporte de schema implementado con errores detectados y oportunidades de expansión.

- Explicación: los datos estructurados mejoran la comprensión del contenido por motores de búsqueda y habilitan rich snippets que aumentan CTR.
- Análisis: verificar schema implementado correctamente, identificar errores de validación, evaluar oportunidades para nuevos tipos de schema.
- Solución: corregir errores de schema existente, implementar tipos adicionales relevantes, optimizar para rich snippets específicos.
- Prioridad: A para schema crítico (Product, Organization); B para schema de mejora (FAQ, Review).
- Definición de Hecho: schema markup completo y válido que mejora rich snippets y comprensión del contenido.

### Página 033 — Velocidad de carga
- Fuente: PageSpeed Insights, GTmetrix, Core Web Vitals
- Acción: evaluar métricas de velocidad y Core Web Vitals, identificar optimizaciones técnicas prioritarias.
- Evidencias: reporte de velocidad con métricas específicas y roadmap de optimizaciones técnicas.

- Explicación: la velocidad de carga es factor de ranking y experiencia de usuario crítico que impacta directamente en conversiones y SEO.
- Análisis: medir LCP, FID, CLS en páginas críticas, identificar recursos que impactan velocidad, evaluar optimizaciones técnicas disponibles.
- Solución: optimizar imágenes y recursos, implementar caching efectivo, minimizar CSS/JS, mejorar server response time.
- Prioridad: A para páginas críticas con problemas severos; B para optimizaciones preventivas.
- Definición de Hecho: Core Web Vitals en rangos óptimos con velocidad de carga mejorada mediblemente.

### Página 034 — Mobile-first y responsive design
- Fuente: Google Search Console, herramientas de testing mobile
- Acción: evaluar implementación mobile-first y experiencia responsive en dispositivos móviles.
- Evidencias: reporte de usabilidad móvil con issues detectados y recomendaciones de mejora.

- Explicación: el diseño mobile-first es crítico dado el índice mobile-first de Google y el predominio del tráfico móvil.
- Análisis: verificar responsive design correcto, evaluar usabilidad en dispositivos móviles, revisar velocidad específica mobile.
- Solución: corregir problemas de usabilidad móvil, optimizar velocidad específica para mobile, mejorar experiencia táctil.
- Prioridad: A por ser factor crítico de ranking y experiencia de usuario.
- Definición de Hecho: experiencia móvil optimizada sin issues de usabilidad y con rendimiento superior.

### Página 035 — Arquitectura de información
- Fuente: análisis manual, herramientas de crawling
- Acción: evaluar estructura del sitio, navegación y jerarquía de contenido para optimizar findability y crawling.
- Evidencias: mapa de arquitectura actual con propuestas de mejora y impacto en SEO.

- Explicación: una arquitectura de información clara mejora la experiencia del usuario y facilita el crawling efectivo de motores de búsqueda.
- Análisis: mapear estructura actual del sitio, evaluar lógica de categorización, revisar profundidad de páginas importantes.
- Solución: optimizar jerarquía de contenido, mejorar navegación principal, reducir clics para llegar a contenido importante.
- Prioridad: A para mejoras que impactan crawling de páginas críticas; B para optimizaciones de UX.
- Definición de Hecho: arquitectura optimizada que mejora findability y distribución efectiva de autoridad.

### Página 036 — Sitemap XML y robots.txt
- Fuente: Google Search Console, análisis de archivos técnicos
- Acción: auditar configuración de sitemap XML y robots.txt para optimizar crawling y indexación.
- Evidencias: análisis de archivos técnicos con recomendaciones de optimización.

- Explicación: el sitemap XML y robots.txt son herramientas fundamentales para guiar el crawling de motores de búsqueda de manera eficiente.
- Análisis: verificar sitemap actualizado y completo, revisar directivas de robots.txt, evaluar páginas incluidas/excluidas.
- Solución: mantener sitemap actualizado automáticamente, optimizar robots.txt para crawling eficiente, corregir directivas problemáticas.
- Prioridad: A para configuraciones que bloquean indexación; B para optimizaciones de eficiencia.
- Definición de Hecho: configuración técnica optimizada que facilita crawling e indexación efectivos.

### Página 037 — Canonical tags y gestión de duplicados
- Fuente: Screaming Frog, Google Search Console
- Acción: auditar implementación de canonical tags y gestión de contenido duplicado técnico.
- Evidencias: reporte de canonical tags con errores detectados y plan de corrección.

- Explicación: los canonical tags correctos previenen problemas de contenido duplicado y consolidan señales de ranking en la URL preferida.
- Análisis: verificar canonical tags implementados correctamente, detectar canonical loops o errores, evaluar auto-referencing canonicals.
- Solución: corregir canonical tags erróneos, implementar canonicals faltantes, resolver loops y conflictos.
- Prioridad: A para errores que causan problemas de indexación; B para optimizaciones preventivas.
- Definición de Hecho: canonical tags implementados correctamente sin errores que consoliden señales de ranking.

### Página 038 — Hreflang y SEO internacional
- Fuente: Screaming Frog, Google Search Console
- Acción: evaluar implementación de hreflang para sitios multiidioma o multirregión.
- Evidencias: análisis de hreflang con errores detectados y recomendaciones de implementación.

- Explicación: el hreflang correcto asegura que usuarios vean la versión apropiada del contenido según su idioma y ubicación.
- Análisis: verificar hreflang implementado correctamente, detectar errores de configuración, evaluar cobertura de idiomas/regiones.
- Solución: corregir errores de hreflang, implementar para nuevos idiomas/regiones, mantener consistencia en implementación.
- Prioridad: A para sitios con audiencia internacional; N/A para sitios mono-idioma.
- Definición de Hecho: hreflang implementado correctamente que mejora targeting geográfico y de idioma.

### Página 039 — HTTPS y seguridad técnica
- Fuente: herramientas de seguridad, análisis técnico
- Acción: verificar implementación correcta de HTTPS y aspectos de seguridad que impactan SEO.
- Evidencias: reporte de seguridad técnica con certificados y configuraciones verificadas.

- Explicación: HTTPS es factor de ranking y requisito básico para confianza del usuario y seguridad de datos.
- Análisis: verificar certificado SSL válido, revisar redirects HTTP a HTTPS, evaluar mixed content issues.
- Solución: corregir problemas de certificado, implementar redirects correctos, resolver mixed content.
- Prioridad: A por ser factor de ranking y seguridad crítica.
- Definición de Hecho: HTTPS implementado correctamente sin issues de seguridad que impacten SEO.

### Página 040 — Crawl budget y optimización técnica
- Fuente: Google Search Console, logs del servidor
- Acción: analizar uso del crawl budget y optimizar para maximizar crawling de páginas importantes.
- Evidencias: análisis de crawl budget con recomendaciones de optimización técnica.

- Explicación: la optimización del crawl budget asegura que motores de búsqueda crawleen eficientemente las páginas más importantes del sitio.
- Análisis: revisar frecuencia de crawling por sección, identificar páginas de bajo valor que consumen budget, evaluar errores que impactan crawling.
- Solución: bloquear crawling de páginas de bajo valor, corregir errores que desperdician budget, priorizar páginas importantes.
- Prioridad: A para sitios grandes con limitaciones de crawl budget; B para sitios pequeños.
- Definición de Hecho: crawl budget optimizado que maximiza crawling de páginas críticas para el negocio.

### Página 041 — Core Web Vitals detallado
- Fuente: PageSpeed Insights, Chrome UX Report, herramientas de monitoreo
- Acción: análisis detallado de Core Web Vitals con plan específico de optimización técnica.
- Evidencias: reporte técnico de CWV con métricas específicas y roadmap de mejoras.

- Explicación: los Core Web Vitals son factores de ranking oficiales que miden aspectos críticos de experiencia de usuario.
- Análisis: medir LCP, FID, CLS en condiciones reales, identificar elementos específicos que impactan métricas, evaluar optimizaciones técnicas.
- Solución: optimizar elementos que impactan LCP, reducir JavaScript que afecta FID, estabilizar layout para mejorar CLS.
- Prioridad: A por ser factores de ranking oficiales con impacto directo en UX.
- Definición de Hecho: Core Web Vitals en rangos "Good" con mejoras medibles en experiencia de usuario.

### Página 042 — JavaScript SEO y renderizado
- Fuente: herramientas de testing de JavaScript, Google Search Console
- Acción: evaluar renderizado de contenido JavaScript y optimizar para crawling efectivo.
- Evidencias: análisis de renderizado con contenido visible para bots vs usuarios.

- Explicación: el contenido generado por JavaScript debe ser accesible para motores de búsqueda para asegurar indexación completa.
- Análisis: verificar renderizado correcto de contenido JavaScript, evaluar tiempo de renderizado, revisar contenido crítico accesible.
- Solución: implementar server-side rendering o pre-rendering cuando sea necesario, optimizar JavaScript crítico, asegurar contenido accesible.
- Prioridad: A para sitios con contenido crítico en JavaScript; B para optimizaciones preventivas.
- Definición de Hecho: contenido JavaScript completamente accesible para crawling con renderizado optimizado.

### Página 043 — Logs de servidor y análisis técnico
- Fuente: logs del servidor web, herramientas de análisis de logs
- Acción: analizar logs de servidor para identificar patrones de crawling y problemas técnicos.
- Evidencias: análisis de logs con insights sobre comportamiento de bots y optimizaciones técnicas.

- Explicación: los logs de servidor proporcionan información detallada sobre el comportamiento real de crawling y problemas técnicos.
- Análisis: revisar frecuencia de crawling por bot, identificar errores 4xx/5xx, evaluar páginas más/menos crawleadas.
- Solución: corregir errores identificados en logs, optimizar páginas frecuentemente crawleadas, mejorar server response times.
- Prioridad: B para insights técnicos avanzados; A si se detectan problemas críticos.
- Definición de Hecho: análisis de logs implementado que proporciona insights para optimización técnica continua.

### Página 044 — Monitoreo y alertas SEO técnico
- Fuente: herramientas de monitoreo, Google Search Console
- Acción: implementar sistema de monitoreo y alertas para detectar problemas técnicos SEO proactivamente.
- Evidencias: configuración de monitoreo con alertas específicas y dashboard de métricas técnicas.

- Explicación: el monitoreo proactivo permite detectar y corregir problemas técnicos antes de que impacten significativamente el rendimiento SEO.
- Análisis: identificar métricas críticas para monitorear, configurar alertas para cambios significativos, establecer benchmarks de rendimiento.
- Solución: implementar herramientas de monitoreo automatizado, configurar alertas específicas, crear dashboard de métricas técnicas.
- Prioridad: A para sitios críticos que requieren monitoreo continuo; B para implementación preventiva.
- Definición de Hecho: sistema de monitoreo implementado que detecta y alerta sobre problemas técnicos proactivamente.

### Página 045 — Auditoría de errores técnicos
- Fuente: Screaming Frog, Google Search Console, herramientas técnicas
- Acción: identificar y priorizar corrección de errores técnicos que impactan SEO (4xx, 5xx, redirects, etc.).
- Evidencias: inventario completo de errores técnicos con priorización y plan de corrección.

- Explicación: los errores técnicos pueden bloquear indexación, desperdiciar crawl budget y deteriorar la experiencia del usuario.
- Análisis: catalogar todos los errores técnicos detectados, evaluar impacto en SEO, priorizar por criticidad y volumen afectado.
- Solución: corregir errores críticos que bloquean indexación, implementar redirects apropiados, resolver problemas de servidor.
- Prioridad: A para errores que bloquean indexación de páginas críticas; B para errores menores.
- Definición de Hecho: errores técnicos críticos resueltos con sistema de prevención implementado.

### Página 046 — Optimización técnica avanzada
- Fuente: herramientas técnicas especializadas, análisis manual avanzado
- Acción: implementar optimizaciones técnicas avanzadas (HTTP/2, CDN, caching avanzado, optimización de recursos).
- Evidencias: plan de optimizaciones técnicas avanzadas con impacto esperado en rendimiento.

- Explicación: las optimizaciones técnicas avanzadas pueden proporcionar ventajas competitivas significativas en rendimiento y experiencia de usuario.
- Análisis: evaluar oportunidades de optimización avanzada, medir impacto potencial, priorizar por ROI técnico.
- Solución: implementar HTTP/2, optimizar CDN, configurar caching avanzado, minimizar y comprimir recursos.
- Prioridad: B para optimizaciones que proporcionan ventajas competitivas; A si hay problemas de rendimiento críticos.
- Definición de Hecho: optimizaciones técnicas avanzadas implementadas que mejoran significativamente el rendimiento del sitio.

## Sección 04 — Enlazado interno, Headings y Contenido (páginas 047–071)

A continuación se incorporan módulos 047–071 tomando títulos y fuentes desde `index.html`. Por defecto no requieren CSV; se recomiendan capturas, listados y tablas resumen. Cuando se desee, pueden apoyarse exportaciones de Screaming Frog (`Internal All`) para enlazado y meta tags.

### Página 047 — Enlazado Interno: Blog
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: evaluar interlinking entre posts, enlaces hacia categorías/productos y pillar pages; revisar enlaces contextuales en cuerpo y al final.
- Evidencias: capturas de ejemplos, lista de posts con mejoras sugeridas.

- Explicación: el interlinking efectivo en blog distribuye autoridad, mejora la experiencia del usuario y facilita el descubrimiento de contenido relacionado.
- Análisis: revisar patrones de enlazado entre posts con GA4 (flujo de usuarios), identificar posts con alta autoridad (Ahrefs) que pueden distribuir señales, mapear enlaces contextuales vs navegacionales.
- Solución: implementar enlaces contextuales relevantes, crear clusters temáticos, enlazar hacia pillar pages y productos relacionados, optimizar enlaces de "posts relacionados".
- Prioridad: A en posts con alto tráfico o autoridad; B en contenido de soporte.
- Definición de Hecho: aumento de páginas por sesión desde blog y mejora en distribución de autoridad interna.

### Página 048 — Enlazado Interno: Breadcrumb
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: verificar presencia y consistencia de breadcrumbs en plantillas; comprobar `BreadcrumbList` (schema) y jerarquía correcta.
- Evidencias: capturas de breadcrumbs por plantillas; nota de validación con `validator.schema.org`.

- Explicación: los breadcrumbs mejoran la navegación del usuario, facilitan el entendimiento de la arquitectura del sitio y proporcionan señales de jerarquía a los motores de búsqueda.
- Análisis: auditar presencia y consistencia de breadcrumbs por plantilla, validar marcado `BreadcrumbList` con herramientas de schema, revisar jerarquía lógica y enlaces funcionales.
- Solución: implementar breadcrumbs consistentes en todas las plantillas, corregir marcado schema, asegurar jerarquía lógica y enlaces clicables hacia niveles superiores.
- Prioridad: A si faltan en plantillas críticas o hay errores de schema; B si son mejoras menores.
- Definición de Hecho: breadcrumbs implementados en 100% de plantillas con schema válido y navegación funcional.

### Página 049 — Enlazado Interno: Footer
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: revisar enlaces del footer (cantidad, relevancia, agrupación), evitar `link farms`; asegurar enlaces hacia páginas clave (categorías, contacto, políticas).
- Evidencias: inventario de enlaces del footer y propuesta de depuración.

- Explicación: el footer debe proporcionar navegación útil sin convertirse en una granja de enlaces que diluya la autoridad o confunda a los usuarios.
- Análisis: inventariar enlaces del footer, evaluar relevancia y agrupación lógica, medir clics desde GA4, revisar si hay exceso de enlaces o categorías irrelevantes.
- Solución: mantener enlaces esenciales (categorías principales, contacto, políticas), agrupar lógicamente, eliminar enlaces redundantes o de bajo valor, optimizar para UX y SEO.
- Prioridad: A si hay exceso de enlaces o estructura confusa; B si son ajustes menores.
- Definición de Hecho: footer limpio con enlaces relevantes, agrupación lógica y mejora en métricas de navegación.

### Página 050 — Estructura de Encabezados
- Fuente: GA4, Ahrefs
- Acción: revisar consistencia general de H1–H6 en plantillas; alineación con intención y keywords; evitar múltiples H1.
- Evidencias: checklist por plantilla y ejemplos.

- Explicación: la estructura correcta de encabezados mejora la accesibilidad, facilita la comprensión del contenido y proporciona señales semánticas importantes para SEO.
- Análisis: auditar jerarquía de encabezados con herramientas de accesibilidad, verificar H1 único por página, revisar secuencia lógica sin saltos de nivel, evaluar alineación con keywords objetivo.
- Solución: corregir jerarquía de encabezados, asegurar H1 único y descriptivo, implementar secuencia lógica H1>H2>H3, optimizar encabezados para palabras clave relevantes.
- Prioridad: A en páginas críticas con problemas de jerarquía; B en ajustes menores de optimización.
- Definición de Hecho: estructura de encabezados correcta en 100% de plantillas con jerarquía lógica y H1 únicos.

### Página 051 — Headings
- Fuente: GA4, Ahrefs, SEMrush
- Acción: evaluación global de headings (longitud, repetición, canibalización semántica); mapeo H1/H2 contra palabras clave objetivo.
- Evidencias: tabla de URLs con ajustes propuestos.

- Explicación: los encabezados optimizados mejoran la relevancia semántica, evitan la canibalización de keywords y fortalecen la arquitectura de información.
- Análisis: mapear H1/H2 contra palabras clave objetivo, identificar repeticiones y canibalización semántica, evaluar longitud óptima, revisar alineación con intención de búsqueda.
- Solución: diversificar encabezados para evitar canibalización, optimizar longitud (30-60 caracteres para H1), alinear con keywords objetivo, crear jerarquía semántica clara.
- Prioridad: A en páginas con canibalización detectada; B en optimizaciones preventivas.
- Definición de Hecho: encabezados únicos y optimizados sin canibalización semántica entre páginas.

### Página 052 — Headings: Home
- Fuente: SEMrush, Análisis Manual
- Acción: revisar H1/H2/H3 de la home; asegurar que comunican la propuesta de valor y keywords principales; evitar sobreoptimización.
- Evidencias: capturas y propuesta de copy/estructura.

- Explicación: los encabezados de la home deben comunicar claramente la propuesta de valor mientras optimizan para las keywords más importantes del negocio.
- Análisis: evaluar H1 actual contra propuesta de valor, revisar H2/H3 para keywords secundarias, analizar competencia en SERPs, verificar equilibrio entre optimización y naturalidad.
- Solución: optimizar H1 para keyword principal y propuesta de valor, estructurar H2/H3 para keywords secundarias, mantener naturalidad y evitar keyword stuffing.
- Prioridad: A por ser la página más importante del sitio.
- Definición de Hecho: encabezados de home optimizados que comunican valor y posicionan para keywords objetivo.

### Página 053 — Headings: Home (2ª pasada)
- Fuente: Ahrefs, SEMrush
- Acción: segunda revisión centrada en SERP y competencia; ajustar títulos/encabezados según benchmarks.
- Evidencias: comparativa SERP y recomendaciones.

- Explicación: la segunda revisión permite ajustar los encabezados basándose en análisis competitivo y tendencias de SERP para maximizar el potencial de posicionamiento.
- Análisis: analizar encabezados de competidores top 3 en SERPs objetivo, identificar patrones y oportunidades de diferenciación, evaluar performance actual vs benchmarks del sector.
- Solución: ajustar encabezados incorporando insights competitivos, mantener diferenciación de marca, optimizar para featured snippets y posición cero cuando sea relevante.
- Prioridad: A si hay oportunidades claras de mejora vs competencia.
- Definición de Hecho: encabezados optimizados que superan benchmarks competitivos y mejoran posicionamiento.

### Página 054 — Headings: Categorías y Subcategorías
- Fuente: Ahrefs, SEMrush, Análisis Manual
- Acción: revisar headings en listados; incluir keywords y modifiers; coherencia entre categorías y subcategorías.
- Evidencias: listado de categorías con propuestas.

- Explicación: los encabezados de categorías deben optimizar para términos comerciales mientras mantienen coherencia jerárquica y facilitan la navegación.
- Análisis: mapear keywords comerciales por categoría, revisar coherencia entre niveles jerárquicos, evaluar uso de modificadores (mejor, barato, online), analizar volumen de búsqueda por término.
- Solución: optimizar H1 de categorías para keywords comerciales principales, incluir modificadores relevantes en H2/H3, mantener coherencia semántica entre niveles, evitar canibalización.
- Prioridad: A en categorías con alto potencial comercial; B en categorías de soporte.
- Definición de Hecho: encabezados de categorías optimizados para términos comerciales con jerarquía coherente.

### Página 055 — Headings: Producto
- Fuente: Análisis Manual
- Acción: validar H1 (nombre del producto), H2/H3 (beneficios, especificaciones, FAQs); no duplicar H1; coherencia con slug.
- Evidencias: ejemplos y plantilla recomendada.

- Explicación: los encabezados de producto deben equilibrar la información del producto con la optimización para búsquedas específicas y long-tail.
- Análisis: validar H1 único por producto, revisar estructura H2/H3 para beneficios y especificaciones, evaluar coherencia con URL y breadcrumbs, analizar keywords long-tail relevantes.
- Solución: optimizar H1 con nombre de producto y modificador clave, estructurar H2 para beneficios principales, usar H3 para especificaciones técnicas, incluir sección FAQ optimizada.
- Prioridad: A en productos estrella o con alto margen; B en catálogo general.
- Definición de Hecho: plantilla de encabezados de producto implementada con estructura consistente y optimizada.

### Página 056 — Headings: Otras páginas
- Fuente: Screaming Frog, Ahrefs, Análisis Manual
- Acción: revisar headings en páginas informativas (contacto, políticas, about); ajustar claridad y SEO básico.
- Evidencias: checklist y mejoras.

- Explicación: las páginas informativas necesitan encabezados claros que mejoren la usabilidad y proporcionen valor SEO básico sin sobreoptimización.
- Análisis: auditar encabezados en páginas de soporte, evaluar claridad y utilidad para usuarios, revisar oportunidades de SEO local (contacto), verificar cumplimiento de accesibilidad.
- Solución: optimizar encabezados para claridad y usabilidad, incluir keywords locales en página de contacto, mantener estructura simple y accesible, evitar sobreoptimización.
- Prioridad: B en general; A si hay problemas de usabilidad o accesibilidad.
- Definición de Hecho: encabezados claros y útiles en páginas informativas con SEO básico implementado.

### Página 057 — Contenido
- Fuente: GA4
- Acción: auditar performance de contenidos (engagement, páginas por sesión, scroll si disponible); identificar piezas de alto/ bajo rendimiento.
- Evidencias: tabla de contenidos top/bottom con acciones.

- Explicación: el análisis de performance de contenido identifica qué páginas generan mayor engagement y cuáles necesitan mejoras para optimizar la experiencia del usuario.
- Análisis: revisar métricas de engagement por página (tiempo en página, bounce rate, páginas por sesión), analizar scroll depth cuando esté disponible, identificar contenido de alto y bajo rendimiento.
- Solución: mejorar contenido de bajo rendimiento con información más relevante, optimizar estructura de contenido exitoso para replicar, implementar elementos interactivos en páginas con bajo engagement.
- Prioridad: A en páginas críticas con bajo rendimiento; B en optimizaciones de contenido exitoso.
- Definición de Hecho: mejora en métricas de engagement y identificación clara de patrones de contenido exitoso.

### Página 058 — Contenido
- Fuente: GA4, Ahrefs
- Acción: relacionar performance GA4 con señales off-page (backlinks/DR) para priorizar mejoras o internal linking.
- Evidencias: mapa contenido ↔ autoridad y recomendaciones.

- Explicación: correlacionar performance de contenido con autoridad de página permite priorizar esfuerzos de optimización y estrategias de link building interno.
- Análisis: mapear páginas con alta autoridad (DR/backlinks) vs performance en GA4, identificar páginas con alta autoridad pero bajo tráfico, detectar oportunidades de internal linking desde páginas autoritativas.
- Solución: optimizar páginas con alta autoridad pero bajo rendimiento, implementar estrategia de internal linking desde páginas autoritativas, crear contenido de soporte para páginas con alto potencial.
- Prioridad: A en páginas con alta autoridad y bajo aprovechamiento; B en optimizaciones de distribución de autoridad.
- Definición de Hecho: mejor aprovechamiento de páginas autoritativas y distribución optimizada de link juice interno.

### Página 059 — Contenido: Home
- Fuente: GA4, SEMrush, Análisis Manual
- Acción: evaluar copy de home, módulos destacados y CTAs; asegurar alineación con keywords y funnel.
- Evidencias: wire de ajustes y ejemplos.

- Explicación: el contenido de la home debe comunicar la propuesta de valor, optimizar para keywords principales y guiar efectivamente a los usuarios por el funnel de conversión.
- Análisis: evaluar copy actual vs propuesta de valor, revisar alineación con keywords principales, analizar efectividad de CTAs con métricas de conversión, mapear flujo de usuarios desde home.
- Solución: optimizar copy para keywords principales manteniendo naturalidad, mejorar CTAs con copy persuasivo y posicionamiento estratégico, alinear módulos con objetivos de negocio.
- Prioridad: A por ser la página más crítica para conversiones.
- Definición de Hecho: home optimizada que mejora conversiones y posiciona para keywords objetivo.

### Página 060 — Contenido: Categorías y subcategorías
- Fuente: SEMrush, Análisis Manual
- Acción: optimizar descripciones de categorías; añadir bloques informativos; soporte semántico.
- Evidencias: propuestas por categoría.

- Explicación: el contenido de categorías debe proporcionar contexto semántico, mejorar la experiencia del usuario y optimizar para términos comerciales relevantes.
- Análisis: evaluar descripciones actuales de categorías, identificar oportunidades de enriquecimiento semántico, revisar necesidades informativas de usuarios, analizar keywords comerciales por categoría.
- Solución: crear descripciones únicas y valiosas por categoría, añadir bloques informativos (guías, comparativas), implementar contenido de soporte semántico, optimizar para long-tail comerciales.
- Prioridad: A en categorías principales con alto potencial comercial; B en categorías secundarias.
- Definición de Hecho: categorías con contenido enriquecido que mejoran UX y posicionamiento comercial.

### Página 061 — Contenido: Producto
- Fuente: Ahrefs, Análisis Manual
- Acción: enriquecer fichas (descripción única, especificaciones, FAQs, multimedia); evitar contenido duplicado de proveedor.
- Evidencias: checklist por plantilla.

- Explicación: las fichas de producto deben proporcionar información única y valiosa que facilite la decisión de compra y mejore el posicionamiento para búsquedas específicas.
- Análisis: auditar contenido actual de productos, identificar contenido duplicado de proveedores, evaluar completitud de información (especificaciones, beneficios, FAQs), revisar necesidades informativas de compradores.
- Solución: crear descripciones únicas por producto, enriquecer con especificaciones detalladas, implementar secciones FAQ optimizadas, añadir contenido multimedia (imágenes, videos), evitar contenido genérico de fabricantes.
- Prioridad: A en productos estrella o con alto margen; B en catálogo general.
- Definición de Hecho: fichas de producto enriquecidas con contenido único que mejoran conversión y SEO.

### Página 062 — Contenido: Duplicado y Thin content
- Fuente: GA4, Screaming Frog, Análisis Manual
- Acción: detectar duplicados (title/description/body) y páginas de bajo valor; consolidar/canonizar o ampliar.
- Evidencias: listado (puede apoyarse en export SF), plan de acción.

- Explicación: el contenido duplicado y thin content diluye la autoridad del sitio y puede generar penalizaciones, requiriendo consolidación o enriquecimiento estratégico.
- Análisis: identificar contenido duplicado interno con Screaming Frog, detectar páginas con contenido insuficiente, evaluar valor y performance de páginas thin, revisar oportunidades de consolidación.
- Solución: consolidar páginas duplicadas con redirects 301, implementar canonical tags donde sea apropiado, enriquecer contenido thin con información valiosa, eliminar páginas sin valor.
- Prioridad: A en duplicados que afecten páginas críticas; B en thin content de bajo impacto.
- Definición de Hecho: eliminación de contenido duplicado y enriquecimiento de páginas thin con valor agregado.

### Página 063 — Canibalizaciones
- Fuente: GA4
- Acción: detectar signos por landing y query (si vinculadas) de competencia entre URLs; observar fluctuaciones y rutas de entrada.
- Evidencias: casos y propuesta de consolidación.

- Explicación: la canibalización de keywords ocurre cuando múltiples páginas compiten por los mismos términos, diluyendo la autoridad y confundiendo a los motores de búsqueda.
- Análisis: identificar fluctuaciones en rankings de páginas similares, analizar rutas de entrada desde GA4, detectar competencia interna por queries específicas, evaluar performance relativo entre URLs canibalizadas.
- Solución: consolidar páginas similares con redirects 301, diferenciar contenido y keywords objetivo, implementar canonical tags estratégicos, crear jerarquía clara de páginas principales vs soporte.
- Prioridad: A en canibalizaciones que afecten keywords comerciales principales; B en términos de menor impacto.
- Definición de Hecho: eliminación de canibalización con páginas claramente diferenciadas y rankings estabilizados.

### Página 064 — Canibalizaciones
- Fuente: GA4, Search Console, Screaming Frog, SEMrush
- Acción: análisis cruzado con GSC (queries ↔ páginas), rastreo SF y competencia; priorizar por impacto.
- Evidencias: matriz query ↔ URL con decisión.

- Explicación: el análisis cruzado de múltiples fuentes permite identificar canibalizaciones complejas y priorizar acciones según el impacto real en el negocio.
- Análisis: crear matriz query-URL desde Search Console, identificar múltiples páginas posicionando para mismas queries, analizar contenido con Screaming Frog, evaluar competencia externa con SEMrush.
- Solución: priorizar canibalizaciones por volumen de búsqueda e impacto comercial, definir página principal por query, implementar estrategia de consolidación o diferenciación según el caso.
- Prioridad: A en queries de alto volumen con múltiples páginas compitiendo; B en canibalizaciones menores.
- Definición de Hecho: matriz clara de decisiones implementada con una página principal por query objetivo.

### Página 065 — Canibalizaciones
- Fuente: Ahrefs, SEMrush, Análisis Manual
- Acción: complementar con SERP y contenido competidor; definir diferenciación o fusión.
- Evidencias: benchmark y plan.

- Explicación: el análisis competitivo ayuda a determinar si la diferenciación de contenido es viable o si la consolidación es la mejor estrategia.
- Análisis: analizar SERPs para queries canibalizadas, evaluar estrategias de competidores top, identificar oportunidades de diferenciación semántica, benchmarcar contenido y estructura.
- Solución: definir estrategia de diferenciación basada en intención de búsqueda específica, o consolidar cuando la diferenciación no sea viable, implementar plan basado en análisis competitivo.
- Prioridad: A en mercados competitivos con oportunidades claras; B en nichos con menor competencia.
- Definición de Hecho: estrategia de canibalización implementada con diferenciación viable o consolidación efectiva.

### Página 066 — Meta Tags
- Fuente: GA4
- Acción: chequear cobertura y coherencia de meta tags a nivel global; relacionar con rendimiento (CTR solo desde GSC, si se usa).
- Evidencias: resumen y prioridades.

- Explicación: los meta tags son elementos críticos para el CTR en SERPs y deben estar optimizados consistentemente en todo el sitio.
- Análisis: auditar cobertura de meta tags por plantilla, evaluar coherencia con contenido y keywords, analizar CTR desde Search Console cuando esté disponible, identificar patrones de rendimiento.
- Solución: implementar meta tags faltantes, optimizar títulos y descripciones para mejorar CTR, asegurar coherencia entre meta tags y contenido, crear plantillas optimizadas por tipo de página.
- Prioridad: A en páginas críticas sin meta tags o con bajo CTR; B en optimizaciones incrementales.
- Definición de Hecho: cobertura completa de meta tags optimizados con mejora en CTR desde SERPs.

### Página 067 — Meta Tags: Titles
- Fuente: Ahrefs
- Acción: revisar títulos visibles en SERP (Top Pages / Site Explorer); evitar truncamientos y duplicados; incluir modifiers.
- Evidencias: tabla de titles a optimizar.

- Explicación: los títulos son el elemento más visible en SERPs y deben optimizarse para CTR y relevancia sin truncarse ni duplicarse.
- Análisis: revisar títulos actuales en SERPs con Ahrefs, identificar truncamientos (>60 caracteres), detectar duplicados, evaluar uso de modificadores comerciales, analizar performance vs competencia.
- Solución: optimizar longitud de títulos (50-60 caracteres), eliminar duplicados, incluir modificadores relevantes (mejor, barato, 2024), mantener keywords principales al inicio, crear títulos únicos por página.
- Prioridad: A en páginas con títulos truncados o duplicados en SERPs; B en optimizaciones de CTR.
- Definición de Hecho: títulos optimizados sin truncamientos ni duplicados con mejora en CTR.

### Página 068 — Meta Tags: Titles
- Fuente: GA4, Screaming Frog, Ahrefs, Análisis Manual
- Acción: auditoría completa de titles por plantilla/URL con SF; cruzar con rendimiento GA4/Ahrefs.
- Evidencias: export SF y lista priorizada.

- Explicación: la auditoría técnica completa de títulos permite identificar problemas sistemáticos y priorizar optimizaciones según el impacto real.
- Análisis: exportar todos los títulos con Screaming Frog, identificar patrones problemáticos por plantilla, correlacionar con métricas de rendimiento de GA4 y Ahrefs, priorizar por impacto potencial.
- Solución: corregir problemas técnicos sistemáticos, optimizar títulos de páginas de alto rendimiento, implementar plantillas de títulos por tipo de página, crear proceso de QA para títulos nuevos.
- Prioridad: A en páginas de alto tráfico con títulos problemáticos; B en correcciones sistemáticas.
- Definición de Hecho: auditoría completa implementada con títulos optimizados por plantilla y rendimiento mejorado.

### Página 069 — Meta Tags: Meta Descriptions
- Fuente: Search Console, Ahrefs, SEMrush
- Acción: analizar CTR por página/consulta (GSC), detectar duplicadas o ausentes; proponer descripciones orientadas a intención.
- Evidencias: tabla con propuestas.

- Explicación: las meta descriptions influyen directamente en el CTR desde SERPs y deben estar optimizadas para cada intención de búsqueda específica.
- Análisis: analizar CTR por página desde Search Console, identificar descripciones duplicadas o ausentes, evaluar alineación con intención de búsqueda, benchmarcar contra competencia en SERPs.
- Solución: crear descripciones únicas orientadas a intención específica, optimizar longitud (150-160 caracteres), incluir call-to-action persuasivo, eliminar duplicados, implementar descripciones faltantes.
- Prioridad: A en páginas críticas con bajo CTR o sin descripción; B en optimizaciones incrementales.
- Definición de Hecho: descripciones optimizadas implementadas con mejora medible en CTR desde SERPs.

### Página 070 — Meta Tags: Meta Descriptions
- Fuente: GA4, Screaming Frog, Ahrefs, Análisis Manual
- Acción: auditoría completa de descripciones por plantilla/URL; coherencia con titles y contenido.
- Evidencias: export SF y mejoras.

- Explicación: la auditoría técnica sistemática de meta descriptions asegura coherencia y optimización en todo el sitio web.
- Análisis: exportar todas las meta descriptions con Screaming Frog, identificar patrones problemáticos por plantilla, evaluar coherencia con títulos y contenido, detectar oportunidades de mejora sistemática.
- Solución: corregir inconsistencias sistemáticas, crear plantillas de descriptions por tipo de página, implementar proceso de QA para nuevas descriptions, optimizar coherencia con títulos y contenido.
- Prioridad: A en plantillas críticas con problemas sistemáticos; B en optimizaciones menores.
- Definición de Hecho: sistema coherente de meta descriptions implementado con plantillas optimizadas por tipo de página.

### Página 071 — Imágenes
- Fuente: GA4
- Acción: revisar peso/formatos (WebP/AVIF), atributos `alt`, lazy-loading; impacto en performance.
- Evidencias: checklist y ejemplos.

- Explicación: la optimización de imágenes impacta directamente en Core Web Vitals, accesibilidad y experiencia del usuario, siendo crítica para SEO técnico.
- Análisis: auditar formatos de imagen actuales, evaluar implementación de WebP/AVIF, revisar atributos alt para accesibilidad, verificar lazy-loading, medir impacto en LCP y CLS.
- Solución: implementar formatos modernos (WebP/AVIF), optimizar atributos alt descriptivos, configurar lazy-loading efectivo, comprimir imágenes sin pérdida de calidad, implementar responsive images.
- Prioridad: A en imágenes que afecten Core Web Vitals; B en optimizaciones generales.
- Definición de Hecho: imágenes optimizadas con formatos modernos, alt text completo y mejora en métricas de performance.

## Validación y control de calidad
- Confirmar que los módulos manuales incluyen evidencias claras y accionables.
- Si se usan CSVs de apoyo (SF/exports), ubicarlos en `WEB_AUDITORIA/data/` y documentar encabezados.
- Mantener consistencia de nomenclatura y filtros con las secciones anteriores.

## Referencias credenciales/entorno
- `GA4_PROPERTY_ID`, `GSC_SITE_URL`, `AHREFS_TOKEN`, `SEMRUSH_TOKEN`, `SISTRIX_TOKEN`
- Mantener tokens en entorno seguro; no incluir credenciales en CSV.

## Sección 05 — Imágenes, Datos Estructurados, Rich Snippets, Idiomas y Accesibilidad (páginas 072–090)

Estas páginas se basan en auditoría manual con soporte de herramientas. Salvo que se indique, no requieren CSV; se recomiendan capturas, listados y tablas. Si se usan exportaciones de Screaming Frog (imágenes/meta/status), ubicar CSVs en `WEB_AUDITORIA/data/`.

### Página 072 — Imágenes
- Fuente: Ahrefs, Análisis Manual
- Acción: revisar atributos `alt` relevantes, formatos (`WebP/AVIF`), peso y dimensiones; verificar lazy-loading y compresión; comprobar impacto en métricas de experiencia (LCP/CLS si disponibles).
- Evidencias: checklist por plantilla, ejemplos de optimización y antes/después.

- Explicación: la optimización avanzada de imágenes combina SEO técnico, accesibilidad y performance para maximizar el impacto en rankings y experiencia del usuario.
- Análisis: auditar formatos actuales vs modernos (WebP/AVIF), evaluar peso y dimensiones por plantilla, revisar calidad de atributos alt, verificar implementación de lazy-loading, medir impacto en Core Web Vitals.
- Solución: migrar a formatos modernos con fallbacks, optimizar dimensiones y compresión, crear atributos alt descriptivos y relevantes, implementar lazy-loading estratégico, configurar responsive images.
- Prioridad: A en imágenes críticas que afecten LCP o accesibilidad; B en optimizaciones generales de catálogo.
- Definición de Hecho: imágenes optimizadas con formatos modernos, alt text de calidad y mejora medible en Core Web Vitals.

### Página 073 — Imágenes
- Fuente: Screaming Frog, Ahrefs, SEMrush, Análisis Manual
- Acción: utilizar export de Screaming Frog (`Images`/`All`) para detectar imágenes pesadas, sin `alt` o con `alt` vacío; cruzar con señales SEO off-page.
- Evidencias: tabla priorizada de imágenes a optimizar y plan.
- Opcional CSV: `images_auditoria.csv` con columnas `url,image_src,bytes,alt_text,template`.

- Explicación: la auditoría técnica sistemática de imágenes identifica problemas de performance y accesibilidad que impactan SEO y experiencia del usuario.
- Análisis: exportar inventario completo de imágenes con Screaming Frog, identificar imágenes pesadas (>100KB), detectar alt text faltante o vacío, priorizar por impacto en páginas críticas, correlacionar con autoridad de página.
- Solución: optimizar imágenes pesadas en páginas críticas, implementar alt text descriptivo faltante, crear proceso de QA para nuevas imágenes, establecer estándares de peso y formato por tipo de imagen.
- Prioridad: A en imágenes de páginas críticas sin alt o muy pesadas; B en optimizaciones sistemáticas.
- Definición de Hecho: inventario completo optimizado con alt text implementado y reducción significativa de peso de imágenes.

### Página 074 — Datos Estructurados
- Fuente: GA4
- Acción: relacionar la presencia de datos estructurados con el rendimiento (engagement/landing orgánico); identificar plantillas clave sin marcado.
- Evidencias: lista de plantillas con estado de schema y métricas asociadas.

- Explicación: los datos estructurados mejoran la comprensión del contenido por parte de los motores de búsqueda y habilitan rich snippets que aumentan CTR.
- Análisis: mapear plantillas con y sin datos estructurados, correlacionar con métricas de rendimiento en GA4, identificar oportunidades de schema por tipo de contenido, evaluar impacto en tráfico orgánico.
- Solución: implementar schema relevante en plantillas críticas sin marcado, optimizar schema existente para rich snippets, priorizar tipos con mayor impacto en CTR (FAQ, Product, Article, HowTo).
- Prioridad: A en plantillas críticas sin schema; B en optimizaciones de schema existente.
- Definición de Hecho: cobertura completa de schema en plantillas críticas con mejora medible en métricas de engagement.

### Páginas 075–082 — Rich Snippets

### Página 075 — Rich Snippets
- Fuente: GA4, Ahrefs, SEMrush
- Acción: detectar snippets en SERP (product/review/FAQ/etc.) y su impacto en CTR/conversiones; priorizar tipos con mayor retorno.
- Evidencias: capturas SERP y tabla de páginas con snippet.

- Explicación: los rich snippets aumentan visibilidad y potencial de clic, impactando tráfico cualificado y conversión.
- Análisis: usar Ahrefs/SEMrush para detectar presencia de snippets y competencia; GA4 para medir sesiones y conversión de páginas elegibles; si disponible, comparar rendimiento antes/después de obtener snippet.
- Solución: implementar/optimizar esquema para tipos con mayor retorno (FAQ/HowTo/Product/Article) y ajustar contenido editorial para soportarlo; focalizar en plantillas de alto tráfico.
- Prioridad: A en plantillas críticas o oportunidades claras; B en páginas secundarias; C si el tipo no aplica.
- Definición de Hecho: snippet visible estable en SERP para páginas objetivo y mejora de métricas en GA4.

### Página 076 — Rich Snippets
- Fuente: Ahrefs, SEMrush, Análisis Manual
- Acción: auditar implementación técnica de schema para soportar snippets (FAQ, HowTo, Product, Article); validar con `Rich Results Test`.
- Evidencias: inventario de tipos y estado (válido/advertencias/errores).

- Explicación: la calidad técnica del marcado condiciona la elegibilidad para resultados enriquecidos.
- Análisis: revisar marcado por tipo (FAQ/HowTo/Product/Article) y validar manualmente con `Rich Results Test`; comparar con patrones de la competencia (Ahrefs/SEMrush).
- Solución: corregir errores/advertencias, completar propiedades obligatorias y recomendadas; limitar tipos al contexto real de cada plantilla.
- Prioridad: A si hay errores generalizados; B si hay advertencias puntuales; C si la cobertura ya es alta.
- Definición de Hecho: 0 errores en validación y advertencias reducidas a casos justificados.

### Página 077 — Rich Snippets
- Fuente: Ahrefs, SEMrush
- Acción: analizar cobertura de snippets frente a competencia; identificar oportunidades no explotadas.
- Evidencias: benchmark y recomendaciones.

- Explicación: entender la brecha competitiva orienta dónde invertir esfuerzo de marcado.
- Análisis: comparar presencia de tipos de snippet por categoría/plantilla frente a competidores directos (Ahrefs/SEMrush).
- Solución: priorizar tipos con mayor gap y retorno esperado; adaptar contenidos y marcado para capturar oportunidades.
- Prioridad: A donde el gap sea alto en áreas clave; B en áreas secundarias.
- Definición de Hecho: cierre de brecha definida (objetivo de cobertura por tipo) frente al set competitivo.

### Página 078 — Rich Snippets
- Fuente: GA4, Ahrefs
- Acción: correlacionar snippet vs desempeño (GA4) y autoridad (Ahrefs); ajustar contenidos/markup para maximizar resultados.
- Evidencias: tabla correlativa y plan de mejora.

- Explicación: el efecto del snippet debe reflejarse en comportamiento y negocio.
- Análisis: relacionar presencia de snippet con engagement y conversión en GA4; considerar autoridad (DR/UR) para entender variaciones.
- Solución: reforzar contenido y marcado en páginas con potencial alto y autoridad suficiente; mejorar interlinking interno para apoyar.
- Prioridad: A en páginas de negocio; B en informativas.
- Definición de Hecho: aumento sostenido de métricas clave en páginas con snippet.

### Página 079 — Rich Snippets
- Fuente: GA4, Ahrefs
- Acción: revisar caída/ganancia de snippets a lo largo del tiempo y su impacto en tráfico/conversión.
- Evidencias: resumen temporal y acciones.

- Explicación: variaciones de snippet afectan la captación orgánica y deben gestionarse.
- Análisis: seguimiento temporal del estado de snippet y métricas GA4; investigar cambios en contenido/marcado o competencia.
- Solución: estabilizar marcado, reforzar contenido estructurado y actualizar según directrices; documentar cambios.
- Prioridad: A si hay pérdida relevante; B si la variación es menor.
- Definición de Hecho: recuperación/estabilización del estado de snippet con métricas recuperadas.

### Página 080 — Rich Snippets
- Fuente: GA4, Search Console, Screaming Frog, Ahrefs, Análisis Manual
- Acción: auditoría exhaustiva: extracción con SF de páginas con/ sin schema; verificación en GSC de cobertura y posibles errores; cruzar con rendimiento GA4.
- Evidencias: matriz página ↔ snippet ↔ estado.
- Opcional CSV: `schema_coverage.csv` (`url,template,schema_types,rich_result_status`).

- Explicación: visión integral para decidir acciones de mayor impacto y corregir fallos de implementación.
- Análisis: `SF` para cobertura por plantilla; `GSC` para estado de cobertura/errores; `GA4` para impacto en engagement/conversión; `Ahrefs` para autoridad.
- Solución: plan por plantilla con correcciones técnicas, mejoras editoriales y priorización por impacto/efuerzo.
- Prioridad: A en plantillas con errores y alto impacto; B en mejoras incrementales.
- Definición de Hecho: cobertura mínima objetivo y 0 errores en `GSC`/validadores.

### Página 081 — Rich Snippets
- Fuente: GA4
- Acción: evaluar el efecto de rich snippets sobre KPIs de negocio (engagement/conversión); identificar casos de alto potencial.
- Evidencias: listado de URLs con resultados y próximos pasos.

- Explicación: medir el valor real de los snippets en métricas de negocio.
- Análisis: comparar desempeño de páginas con/ sin snippet en GA4; segmentar por dispositivo/país.
- Solución: replicar patrones ganadores en páginas similares; optimizar UX y contenido.
- Prioridad: A en páginas con margen claro de mejora; B en el resto.
- Definición de Hecho: mejora estadística significativa vs baseline definida.

### Página 082 — Rich Snippets
- Fuente: Análisis Manual
- Acción: revisión editorial para que el contenido soporte y mantenga snippets (estructura clara, FAQs reales, HowTo detallado, reviews verificables).
- Evidencias: guía editorial por tipo de snippet.

- Explicación: el soporte editorial es clave para la elegibilidad y persistencia del snippet.
- Análisis: evaluar estructura, claridad y adecuación del contenido a cada tipo de schema.
- Solución: pautas editoriales específicas (FAQ con preguntas reales; HowTo con pasos y medios; Product con atributos completos y reseñas verificables).
- Prioridad: A en plantillas con intención transaccional/informativa crítica; B en otras.
- Definición de Hecho: contenidos conformes con guía editorial y validados en revisiones.

## CHECKLIST EJECUTABLE RICH SNIPPETS

### Validación Técnica General
- [ ] Verificar implementación de schema.org en formato JSON-LD
- [ ] Validar con Rich Results Test (search.google.com/test/rich-results)
- [ ] Comprobar con Schema Markup Validator (validator.schema.org)
- [ ] Revisar ausencia de errores críticos en Google Search Console
- [ ] Confirmar que el marcado está en `<head>` o cerca del contenido relevante

### FAQ Schema
- [ ] Implementar `@type: "FAQPage"` con array de `mainEntity`
- [ ] Cada pregunta tiene `@type: "Question"` con `name` y `acceptedAnswer`
- [ ] Respuestas contienen `@type: "Answer"` con `text` completo
- [ ] Mínimo 2 preguntas, máximo recomendado 10
- [ ] Preguntas reales que los usuarios hacen frecuentemente
- [ ] Respuestas completas y útiles (no solo enlaces)
- [ ] Evitar contenido promocional directo en respuestas

### HowTo Schema
- [ ] Implementar `@type: "HowTo"` con `name` descriptivo
- [ ] Incluir array `step` con mínimo 2 pasos
- [ ] Cada paso tiene `@type: "HowToStep"` con `name` y `text`
- [ ] Añadir `totalTime` en formato ISO 8601 si aplica
- [ ] Incluir `supply` y `tool` si son necesarios
- [ ] Considerar `image` para pasos complejos
- [ ] Verificar que los pasos son secuenciales y completos

### Product Schema
- [ ] Implementar `@type: "Product"` con `name` y `description`
- [ ] Incluir `offers` con `@type: "Offer"` y `price`
- [ ] Añadir `priceCurrency` en formato ISO 4217
- [ ] Especificar `availability` (InStock, OutOfStock, etc.)
- [ ] Incluir `aggregateRating` si hay reseñas
- [ ] Añadir `review` con `@type: "Review"` si disponible
- [ ] Verificar `brand` y `manufacturer` cuando aplique
- [ ] Incluir `image` de alta calidad del producto

### Article Schema
- [ ] Implementar `@type: "Article"` o subtipo específico
- [ ] Incluir `headline` (máximo 110 caracteres)
- [ ] Añadir `author` con `@type: "Person" o "Organization"`
- [ ] Especificar `datePublished` y `dateModified` en ISO 8601
- [ ] Incluir `publisher` con `name` y `logo`
- [ ] Añadir `image` representativa del artículo
- [ ] Verificar `mainEntityOfPage` apuntando a la URL canónica

### Validación de Contenido Editorial
- [ ] El contenido visible coincide con el marcado schema
- [ ] No hay contenido oculto o engañoso en el marcado
- [ ] Las fechas son precisas y están actualizadas
- [ ] Los precios reflejan la realidad actual
- [ ] Las reseñas son auténticas y verificables
- [ ] Las imágenes son relevantes y de calidad

### Monitoreo y Mantenimiento
- [ ] Configurar alertas en GSC para errores de datos estructurados
- [ ] Revisar mensualmente el estado en Rich Results Test
- [ ] Monitorear cambios en CTR tras implementación
- [ ] Documentar tipos de snippet por plantilla
- [ ] Establecer proceso de actualización ante cambios de contenido

### Criterios de Éxito
- [ ] Snippet visible en SERP para términos objetivo
- [ ] 0 errores en Google Search Console
- [ ] Mejora medible en CTR (mínimo 5% vs baseline)
- [ ] Validación exitosa en herramientas oficiales
- [ ] Contenido editorial alineado con marcado técnico

### Página 083 — Idiomas
- Fuente: GA4
- Acción: verificar rutas y contenidos multilingües, segmentación por país/idioma; conectar comportamiento de usuarios con versiones lingüísticas.
- Evidencias: mapa de idiomas y hallazgos.

- Explicación: la segmentación multilingüe permite entender el comportamiento diferenciado por mercado y optimizar la experiencia por idioma/región.
- Análisis: en GA4, segmentar sesiones por idioma del navegador y país; identificar rutas más utilizadas por cada versión lingüística; detectar patrones de navegación y conversión diferenciados.
- Solución: mapear contenidos por idioma, identificar huecos de traducción en rutas críticas, ajustar interlinking entre versiones y optimizar contenido según comportamiento local.
- Prioridad: A si hay mercados multilingües significativos; B si es preparación para expansión.
- Definición de Hecho: mapa completo de contenidos por idioma y métricas de comportamiento diferenciadas por mercado.

### Página 084 — Idiomas
- Fuente: Ahrefs
- Acción: evaluar señales off-page y autoridad por idioma/mercado; detectar huecos frente a competencia.
- Evidencias: benchmark de backlinks/DR por versión.

- Explicación: las señales off-page varían por mercado; una estrategia multilingüe requiere autoridad específica en cada región/idioma.
- Análisis: comparar DR/UR y perfil de backlinks por versión de idioma; identificar dominios referentes locales vs internacionales; detectar oportunidades de enlazado por mercado.
- Solución: desarrollar estrategia de enlaces específica por idioma/región, contactar medios locales, participar en comunidades regionales y crear contenido relevante para cada mercado.
- Prioridad: A en mercados con competencia intensa; B en mercados emergentes.
- Definición de Hecho: incremento de autoridad (DR) y diversificación de backlinks por versión lingüística.

### Página 085 — Idiomas: Hreflang
- Fuente: Análisis Manual
- Acción: validar `hreflang` entre versiones (ISO-639 + ISO-3166), bidireccionalidad y canónicos; evitar cadenas incorrectas.
- Evidencias: tabla de pares `hreflang` y correcciones necesarias.

- Explicación: `hreflang` correcto evita contenido duplicado entre idiomas y asegura que cada usuario vea la versión apropiada en buscadores.
- Análisis: revisar implementación de etiquetas `hreflang` en `<head>` o sitemap; validar códigos ISO-639-1 (idioma) e ISO-3166-1 (país); comprobar bidireccionalidad y coherencia con canónicos.
- Solución: corregir códigos incorrectos, asegurar reciprocidad entre versiones, eliminar referencias a URLs inexistentes, alinear con estructura de sitemap y canónicos.
- Prioridad: A si hay errores generalizados o mercados clave afectados; B si son correcciones menores.
- Definición de Hecho: implementación `hreflang` sin errores en GSC y validación manual exitosa.

### Página 086 — Idiomas: Errores
- Fuente: Screaming Frog, Ahrefs, Análisis Manual
- Acción: rastrear errores comunes en multilenguaje (faltan etiquetas, apuntan a URL equivocada, mezclas regionales); revisar sitemap y enlaces internos.
- Evidencias: listado de errores y plan de remediación.

- Explicación: los errores multilingües fragmentan la experiencia del usuario y pueden causar penalizaciones por contenido duplicado.
- Análisis: con Screaming Frog, detectar páginas sin `hreflang`, etiquetas que apuntan a URLs 404/301, mezclas de códigos regionales; revisar interlinking entre versiones y cobertura en sitemaps.
- Solución: completar etiquetas faltantes, corregir URLs de destino, estandarizar códigos de idioma/región, actualizar enlaces internos y asegurar cobertura completa en sitemaps por idioma.
- Prioridad: A si afecta rutas críticas o hay errores masivos; B si son casos puntuales.
- Definición de Hecho: 0 errores de `hreflang` en herramientas de auditoría y GSC, interlinking coherente entre versiones.

### Página 087 — Accesibilidad
- Fuente: GA4
- Acción: relacionar métricas de experiencia (si disponibles) con barreras potenciales; detectar plantillas con peor comportamiento.
- Evidencias: resumen por plantilla.

- Explicación: las barreras de accesibilidad impactan negativamente en la experiencia del usuario y pueden correlacionarse con métricas de comportamiento deficientes.
- Análisis: segmentar métricas GA4 por plantilla para identificar patrones de abandono, tiempo de sesión bajo o interacciones limitadas; correlacionar con auditorías de accesibilidad básicas.
- Solución: priorizar mejoras de accesibilidad en plantillas con peor rendimiento, implementar navegación por teclado, mejorar contraste y legibilidad, optimizar formularios.
- Prioridad: A en plantillas críticas con métricas deficientes; B en mejoras generales de accesibilidad.
- Definición de Hecho: mejora medible en métricas de engagement por plantilla tras implementar correcciones de accesibilidad.

### Página 088 — Accesibilidad: Tipos de respuesta de página
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: clasificar respuestas (200, 301/302, 4XX/5XX) y su impacto en navegación; evitar cadenas de redirección.
- Evidencias: mapa de respuestas y acciones.

- Explicación: los códigos de respuesta HTTP incorrectos fragmentan la experiencia del usuario y afectan el presupuesto de rastreo.
- Análisis: mapear códigos de respuesta por plantilla y ruta; identificar patrones de errores y su impacto en métricas de usuario; detectar cadenas de redirección innecesarias.
- Solución: corregir errores 4XX/5XX críticos, optimizar redirecciones 3XX, eliminar cadenas y asegurar respuestas 200 consistentes en contenido válido.
- Prioridad: A si hay errores en rutas críticas o cadenas largas; B si son casos aislados.
- Definición de Hecho: mapa de respuestas limpio, sin cadenas problemáticas y errores reducidos a casos justificados.

### Página 089 — Accesibilidad: Errores 4XX y 5XX
- Fuente: GA4, Ahrefs
- Acción: inventario de errores actuales y páginas afectadas; priorizar soluciones por impacto.
- Evidencias: lista priorizada.

- Explicación: los errores 4XX y 5XX interrumpen la navegación del usuario y pueden indicar problemas técnicos o de contenido que requieren atención inmediata.
- Análisis: inventariar errores por tipo y frecuencia; medir impacto en tráfico perdido (GA4) y enlaces entrantes afectados (Ahrefs); identificar causas raíz.
- Solución: corregir errores 404 con redirecciones o restauración de contenido, resolver errores 5XX técnicos, implementar monitoreo proactivo.
- Prioridad: A si hay errores en páginas con tráfico alto o enlaces entrantes; B si son páginas de bajo impacto.
- Definición de Hecho: reducción significativa de errores 4XX/5XX y recuperación de tráfico/enlaces perdidos.

### Página 090 — Accesibilidad: Errores 4XX y 5XX históricos
- Fuente: GA4
- Acción: analizar tendencia histórica de errores, determinar causas (migraciones, cambios de rutas) y estabilizar.
- Evidencias: resumen histórico y medidas preventivas.

- Explicación: el análisis histórico de errores revela patrones y causas recurrentes, permitiendo implementar medidas preventivas efectivas.
- Análisis: revisar tendencias de errores en GA4 durante los últimos 6-12 meses; identificar picos relacionados con cambios técnicos, migraciones o actualizaciones.
- Solución: documentar causas identificadas, implementar procesos de testing pre-despliegue, establecer monitoreo automático y protocolos de respuesta rápida.
- Prioridad: A si hay patrones recurrentes que afectan estabilidad; B si son eventos aislados históricos.
- Definición de Hecho: estabilización de errores, procesos preventivos documentados y sistema de monitoreo activo implementado.

## Sección 06 — Accesibilidad avanzada e Indexabilidad (páginas 091–110)

### Página 091 — Accesibilidad: Página 404
- Fuente: GA4, Screaming Frog, Ahrefs, Análisis Manual
- Acción: revisar diseño y utilidad de la 404 (búsqueda, enlaces a categorías populares), evitar indexación; auditar tráfico hacia 404 y fuentes.
- Evidencias: capturas de 404, métricas GA4 y lista de enlaces sugeridos.

- Explicación: una 404 útil reduce frustración y reconduce la navegación; una 404 correctamente servida evita indexación de contenidos inexistentes.
- Análisis: en GA4, medir sesiones que aterrizan en 404 y sus fuentes; en Screaming Frog/Ahrefs, detectar enlaces internos/externos que provocan 404; validar cabecera `404` y ausencia de indexación en GSC.
- Solución: implementar búsqueda y enlaces relevantes en 404, corregir enlaces rotos (internos y externos con redirecciones), asegurar respuesta `404` y evitar que se sirva `200` con plantilla de error.
- Prioridad: A si el tráfico a 404 es alto o hay enlaces entrantes rotos; B en casos aislados.
- Definición de Hecho: reducción del tráfico a 404, enlaces corregidos, cabecera `404` consistente y no indexación en GSC.

### Página 092 — Accesibilidad: 3XX
- Fuente: GA4, Screaming Frog, Ahrefs, Análisis Manual
- Acción: identificar cadenas de redirección, 302 permanentes, bucles; reducir saltos y consolidar a 301 pertinentes.
- Evidencias: export SF (`Redirects`) y plan de corrección.

- Explicación: las cadenas y redirecciones incorrectas degradan experiencia y consumen presupuesto de rastreo.
- Análisis: con Screaming Frog, listar `Redirect Chains` y `Temporary (302)`; verificar impacto en tiempos de carga y pérdida de señales; revisar Ahrefs para detectar enlaces externos a URLs intermedias.
- Solución: consolidar destinos finales con `301`, eliminar saltos intermedios, actualizar enlaces internos a la URL final; convertir `302` persistentes en `301` cuando corresponda.
- Prioridad: A si existen cadenas largas/bucles o rutas críticas afectadas; B si son casos puntuales.
- Definición de Hecho: sin cadenas ni bucles, redirecciones `301` correctas y enlaces internos apuntando a la versión final.

### Página 093 — Accesibilidad: Errores de código Escritorio
- Fuente: GA4, Search Console, Ahrefs, Análisis Manual
- Acción: rastrear errores de JS/CSS en escritorio que impactan renderizado/interacción; cruzar con `Core Web Vitals` si disponibles.
- Evidencias: lista de errores, páginas afectadas y correcciones.

- Explicación: los errores de JavaScript y CSS en escritorio afectan la experiencia del usuario, el renderizado y pueden impactar negativamente en Core Web Vitals y SEO.
- Análisis: usar DevTools para detectar errores de consola en páginas clave; revisar GSC para errores de indexación relacionados con recursos; correlacionar con métricas de CWV y comportamiento en GA4 por dispositivo.
- Solución: corregir errores críticos de JS que bloquean interacción, optimizar CSS para evitar bloqueo de renderizado, implementar fallbacks para funcionalidades críticas y validar recursos externos.
- Prioridad: A si hay errores que afectan funcionalidad crítica o CWV; B si son errores menores sin impacto visible.
- Definición de Hecho: 0 errores críticos en consola de páginas clave, mejora en métricas CWV y estabilidad de funcionalidades.

### Página 094 — Accesibilidad: Navegadores
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: evaluar compatibilidad en navegadores principales; detectar anomalías de comportamiento por navegador.
- Evidencias: reporte GA4 por navegador y pruebas.

- Explicación: la compatibilidad entre navegadores asegura una experiencia consistente para todos los usuarios, independientemente de su elección de navegador.
- Análisis: revisar métricas de GA4 segmentadas por navegador (Chrome, Firefox, Safari, Edge); detectar diferencias en bounce rate, tiempo de sesión y conversiones; realizar pruebas manuales en navegadores principales.
- Solución: implementar polyfills para funcionalidades modernas, ajustar CSS para compatibilidad cross-browser, validar JavaScript en diferentes motores y establecer testing automatizado.
- Prioridad: A si hay diferencias significativas en métricas o errores en navegadores principales; B si son ajustes menores.
- Definición de Hecho: métricas consistentes entre navegadores principales y funcionalidad validada en testing cross-browser.

### Página 095 — Accesibilidad: HTML5
- Fuente: Screaming Frog, Ahrefs, Análisis Manual
- Acción: comprobar uso correcto de etiquetas semánticas (`header`, `main`, `article`, `nav`, `footer`), roles ARIA mínimos.
- Evidencias: checklist semántico por plantilla.

- Explicación: el HTML semántico mejora la accesibilidad, facilita la comprensión por parte de motores de búsqueda y tecnologías asistivas.
- Análisis: auditar estructura HTML con herramientas de accesibilidad; revisar uso de landmarks (`header`, `main`, `nav`, `footer`, `aside`); validar jerarquía de headings y roles ARIA básicos.
- Solución: implementar estructura semántica correcta, añadir roles ARIA donde sea necesario, corregir jerarquía de headings y asegurar navegación por teclado funcional.
- Prioridad: A si la estructura semántica es deficiente en plantillas clave; B si son mejoras incrementales.
- Definición de Hecho: estructura HTML semántica validada, navegación accesible y cumplimiento de estándares WCAG básicos.

### Página 096 — Accesibilidad: HTML5
- Fuente: Ahrefs, Análisis Manual
- Acción: segunda pasada focalizada (elementos multimedia, `alt`, `label`/`for`, focus states, tab order).
- Evidencias: hallazgos y propuestas.

- Explicación: los elementos multimedia y formularios requieren atención especial para accesibilidad, impactando tanto UX como cumplimiento normativo.
- Análisis: auditar atributos `alt` en imágenes, `label`/`for` en formularios, estados de foco visibles, orden de tabulación lógico; revisar transcripciones/subtítulos en videos.
- Solución: completar textos alternativos descriptivos, asociar labels correctamente, implementar focus states visibles, corregir tab order y añadir controles de accesibilidad multimedia.
- Prioridad: A si hay deficiencias en formularios críticos o contenido multimedia importante; B si son mejoras generales.
- Definición de Hecho: 100% de imágenes con `alt` apropiado, formularios completamente accesibles y multimedia con controles de accesibilidad.

### Página 097 — Accesibilidad: Robots.txt
- Fuente: GA4, Análisis Manual
- Acción: validar reglas (`User-agent`, `Disallow`, `Allow`, `Sitemap`), evitar bloqueos imprevistos (CSS/JS); confirmar acceso a recursos críticos.
- Evidencias: contenido `robots.txt` y anotaciones.

- Explicación: `robots.txt` controla el rastreo; una configuración incorrecta puede bloquear recursos esenciales (CSS/JS) y afectar renderizado, indexación y experiencia.
- Análisis: revisar el fichero `robots.txt` y probar acceso a rutas críticas (CSS/JS, imágenes, APIs) mediante navegador y DevTools; en GA4, comprobar señales de errores o caídas vinculadas a secciones bloqueadas.
- Solución: permitir recursos necesarios (`Allow`), evitar bloqueos globales que afecten plantillas; incluir la directiva `Sitemap` apuntando a `sitemap.xml` y mantener reglas específicas por `User-agent` cuando aplique.
- Prioridad: A si se detecta bloqueo de recursos críticos o secciones clave; B si son ajustes de orden.
- Definición de Hecho: `robots.txt` sin bloqueos críticos, renderizado correcto en pruebas manuales y presencia de `Sitemap` válida.

### Página 098 — Accesibilidad: Sitemap.xml
- Fuente: GA4, Ahrefs
- Acción: verificar presencia y ubicación, cobertura de URLs canónicas, tamaño y partición; sincronización con cambios del sitio.
- Evidencias: ejemplo de `sitemap.xml` y cobertura.

- Explicación: el `sitemap.xml` facilita descubrimiento y prioriza el rastreo de URLs canónicas; una cobertura correcta mejora eficiencia de crawl e indexación.
- Análisis: comprobar que existe, su ubicación y que solo incluye URLs `200` válidas y canónicas; revisar tamaño y, si supera límites, particionar por tipo (categorías, productos, blog). Cruzar cobertura con señales de GA4 (tráfico orgánico) y Ahrefs (enlaces) para detectar huecos.
- Solución: generar/ajustar sitemaps por tipo, excluir URLs con `noindex`, estados distintos a `200`, duplicadas o parámetros no deseados; asegurar actualización automática tras cambios relevantes.
- Prioridad: A si falta el sitemap, incluye muchas URLs no válidas o no canónicas; B si requiere optimización menor.
- Definición de Hecho: sitemap(s) accesibles, válidos y enviados en GSC sin errores; cobertura de URLs canónicas actualizada.

### Página 099 — Accesibilidad: Sitemap.xml
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: segunda revisión: detectar URLs no deseadas/duplicadas, estados incorrectos; proponer limpieza y actualización.
- Evidencias: lista de ajustes.

- Explicación: depurar el sitemap elimina ruido, mejora el presupuesto de rastreo y evita estados inconsistentes.
- Análisis: identificar URLs con estados `3XX/4XX/5XX`, duplicadas, parámetros y versiones no preferidas; cruzar con GA4/Ahrefs para confirmar relevancia; revisar coherencia con canónicos y robots.
- Solución: limpiar el sitemap (dejar solo URLs finales `200` canónicas), excluir listados irrelevantes y facetas, consolidar versiones; actualizar y reenviar en GSC.
- Prioridad: A si hay alta proporción de URLs inválidas o duplicadas; B si son casos puntuales.
- Definición de Hecho: sitemap validado sin errores/advertencias en GSC y lista de ajustes aplicada.

### Página 100 — Indexabilidad
- Fuente: Screaming Frog, Análisis Manual
- Acción: auditar estados de indexación (`noindex`, `nofollow`, canónicos), bloqueo por robots; mapear rutas críticas.
- Evidencias: export SF y matriz URL ↔ estado.

- Explicación: la indexabilidad controla qué contenidos aparecen en buscadores; un ajuste fino evita indexar páginas de baja calidad y asegura que las estratégicas estén accesibles.
- Análisis: con Screaming Frog, extraer etiquetas `meta robots`, encabezados `X‑Robots‑Tag`, canónicos y estados; mapear rutas críticas por plantilla y validar en navegador.
- Solución: aplicar `noindex` a páginas de bajo valor (filtros, resultados internos, duplicados), asegurar `index,follow` en estratégicas; corregir canónicos y revisar bloqueos en robots.
- Prioridad: A si páginas clave no son indexables o hay basura indexada; B si es mejora preventiva.
- Definición de Hecho: estados correctos validados en SF y plantillas críticas indexadas según lo esperado.

### Página 101 — Indexabilidad
- Fuente: Ahrefs
- Acción: revisar cobertura de indexación indirecta vía enlaces externos y señales off-page; detectar páginas sin enlaces.
- Evidencias: lista de páginas a impulsar via interlinking/backlinks.

- Explicación: las señales off‑page (backlinks) influyen en la rapidez y estabilidad de indexación; páginas sin enlaces suelen quedar descubiertas o tardan en consolidarse.
- Análisis: en Ahrefs, detectar URLs con pocos o ningún enlace; identificar contenidos estratégicos con baja señal; revisar enlazado interno hacia esas páginas.
- Solución: reforzar interlinking desde hubs relevantes; plan de adquisición de enlaces de calidad hacia contenidos estratégicos; reflejar en sitemap si procede.
- Prioridad: A para páginas estratégicas sin señales; B para optimización general.
- Definición de Hecho: incremento de señales (interlinking/backlinks) y mejora en cobertura observada en GSC.

### Página 102 — Indexabilidad: Google Search Console
- Fuente: Ahrefs, Análisis Manual
- Acción: validar cobertura/estado en GSC (Excluidas/Válidas/Enviadas/Descubiertas), investigar causas y proponer remediación.
- Evidencias: tabla de estados y acciones.

- Explicación: GSC expone el estado de cobertura y motivos de exclusión; es la base para diagnosticar y corregir problemas de indexación.
- Análisis: clasificar URLs por estado (Válidas, Excluidas, Descubiertas, Enviadas) y causa (duplicado, canónico alternativo, bloqueada por robots, rastreada no indexada, etc.); cruzar con señales de Ahrefs para priorizar.
- Solución: por cada causa, aplicar corrección: mejorar calidad/contenido, ajustar canónicos, abrir bloqueo en robots, reforzar interlinking, actualizar sitemaps.
- Prioridad: A en excluidas con potencial y bloqueadas por robots; B en casos con baja prioridad.
- Definición de Hecho: reducción de Excluidas por causa prioritaria y aumento de Válidas, con evidencia en reportes de GSC.

### Página 103 — Indexabilidad: Google Search Console
- Fuente: GA4
- Acción: cruzar indexabilidad con rendimiento GA4 para priorizar qué URLs habilitar/corregir primero.
- Evidencias: lista priorizada.

- Explicación: unir indexación con rendimiento ayuda a enfocar esfuerzos donde hay mayor impacto potencial (tráfico, conversiones).
- Análisis: construir lista de páginas con buen rendimiento GA4 pero estado de cobertura subóptimo; identificar oportunidades por plantilla y ruta.
- Solución: habilitar y corregir primero las páginas con mayor peso en KPIs: abrir bloqueo, ajustar canónicos, reforzar interlinking y actualizar sitemap.
- Prioridad: A en páginas con KPIs altos afectadas; B en el resto.
- Definición de Hecho: estas páginas pasan a estado Válidas en GSC y muestran mejora en sesiones orgánicas.

### Página 104 — Indexabilidad: Google Search Console
- Fuente: GA4, Screaming Frog, Ahrefs
- Acción: correlación entre estado de cobertura, crawl y enlaces; ajustar sitemaps, canónicos e interlinking.
- Evidencias: matriz de correlación y plan.

- Explicación: correlacionar cobertura, crawl y señales off‑page identifica palancas para mejorar indexación y estabilidad.
- Análisis: crear matriz URL con estado GSC, señales de crawl (SF), y backlinks (Ahrefs); detectar desalineaciones (páginas con enlaces pero sin cobertura, páginas crawleadas pero excluidas por duplicidad, etc.).
- Solución: corregir canónicos y sitemaps, reforzar interlinking y enlaces hacia páginas clave, resolver bloqueos y duplicidades.
- Prioridad: A si hay desalineación marcada en rutas críticas; B si es ajuste fino.
- Definición de Hecho: mejoras verificables en la matriz (más Válidas, menos Excluidas), aumento de crawl efectivo y señales coherentes.

### Página 105 — Indexabilidad: Canonicals
- Fuente: Search Console, Ahrefs, Análisis Manual
- Acción: validar `link rel="canonical"` efectivos, evitar self-canonical incorrecto, duplicados y bucles; coherencia con sitemaps.
- Evidencias: listado de casos y correcciones.

- Explicación: los canónicos guían a los motores hacia la versión preferida, evitando duplicidades e inconsistencias.
- Análisis: en GSC, revisar cobertura y detección de URL canónica elegida; extraer canónicos con Screaming Frog o revisión manual; detectar bucles y self-canonical inapropiado (especialmente en listados y variantes).
- Solución: definir canónico a la URL preferida, eliminar bucles, alinear con `sitemap.xml` y reglas de parámetros; actualizar plantillas para coherencia.
- Prioridad: A si hay inconsistencias generalizadas; B si son casos aislados.
- Definición de Hecho: GSC refleja la canónica esperada y Screaming Frog valida canónicos consistentes en las plantillas clave.

### Página 106 — Indexabilidad: WWW
- Fuente: Search Console, Ahrefs
- Acción: definir variante preferida (`www` vs `non-www`), redirecciones consistentes y propiedad GSC correcta.
- Evidencias: pruebas y configuración.

- Explicación: una sola variante de host evita duplicidades y problemas de señalización.
- Análisis: listar accesos a `www` y `non-www`, comprobar redirecciones con `301`, validar propiedad correcta en GSC y coherencia en canónicos.
- Solución: forzar `301` hacia la variante elegida, actualizar canónicos y sitemaps, revisar enlaces internos para apuntar a la preferida.
- Prioridad: A si coexisten ambas variantes indexadas; B si las redirecciones ya son consistentes.
- Definición de Hecho: solo una variante accesible/indexada y redirecciones `301` limpias.

### Página 107 — Indexabilidad: Slash /
- Fuente: GA4, Search Console, Ahrefs
- Acción: normalizar rutas con/ sin slash final; evitar duplicidad de contenido y cadenas de redirección.
- Evidencias: reglas y ejemplos.

- Explicación: el slash final debe tener política consistente para evitar duplicados y saltos innecesarios.
- Análisis: identificar coexistencia de ambas variantes en GSC/Ahrefs; verificar redirecciones en Screaming Frog; medir en GA4 si hay rutas duplicadas en navegación.
- Solución: establecer norma (con slash o sin slash), implementar redirecciones `301` y actualizar canónicos y enlaces internos.
- Prioridad: A si hay duplicados indexados; B si es preventivo.
- Definición de Hecho: una sola versión indexada por ruta y redirecciones sin cadena.

### Página 108 — Indexabilidad: HTTP
- Fuente: Screaming Frog, Análisis Manual
- Acción: forzar HTTPS, eliminar recursos mixtos; revisar certificados y redirecciones.
- Evidencias: export SF y checklist.

- Explicación: HTTPS es un requisito de seguridad y señal SEO, los recursos mixtos afectan experiencia y CWV.
- Análisis: detectar recursos servidos por `http` (Screaming Frog), validar redirecciones `http→https` globales, revisar certificados y HSTS.
- Solución: forzar HTTPS en todo el sitio, corregir enlaces absolutos `http`, activar HSTS si procede y eliminar contenido mixto.
- Prioridad: A si existen recursos mixtos o rutas sin HTTPS; B si es mantenimiento.
- Definición de Hecho: todo el tráfico por HTTPS, sin contenido mixto y redirecciones globales correctas.

### Página 109 — Indexabilidad: Paginaciones
- Fuente: Ahrefs, Análisis Manual
- Acción: revisar implementaciones de paginación (listados), evitar duplicidad y pérdida de señales; anchoring y enlaces `prev/next` si aplica.
- Evidencias: ejemplos y recomendaciones.

- Explicación: las paginaciones mal implementadas generan duplicidades, diluyen señales y afectan el crawl.
- Análisis: revisar HTML de listados y enlaces `prev/next`; comprobar canónicos y estados indexables; usar Ahrefs para detectar enlaces entrantes a páginas intermedias problemáticas.
- Solución: normalizar canónicos, añadir interlinking útil en páginas intermedias, exponer enlaces accesibles (no solo JS) y reglas de redirección si procede.
- Prioridad: A si hay duplicidad/errores de indexación; B si hay mejoras de UX/crawl.
- Definición de Hecho: sin duplicidades en cobertura, paginación accesible y señales consolidadas.

### Página 110 — Mobile Optimization
- Fuente: Ahrefs, Análisis Manual
- Acción: auditar experiencia móvil (responsive, tap targets, font size), performance y carga de recursos; priorizar plantillas críticas.
- Evidencias: checklist móvil y capturas.

- Explicación: la optimización móvil es crítica para SEO y conversiones, especialmente con el mobile-first indexing de Google.
- Análisis: auditar responsive design en dispositivos clave, verificar tap targets (mínimo 44px), evaluar legibilidad de fuentes, medir performance móvil, revisar carga de recursos específicos móviles.
- Solución: corregir problemas de responsive design, optimizar tap targets para usabilidad, ajustar tipografías para legibilidad móvil, implementar lazy loading y optimización de recursos para móvil.
- Prioridad: A en plantillas críticas con problemas de usabilidad móvil; B en optimizaciones incrementales.
- Definición de Hecho: experiencia móvil optimizada con mejora en métricas de usabilidad y performance.

## Sección 07 — Indexabilidad y SEO Off‑Page (páginas 111–129)

### Página 111 — Indexabilidad: WWW
- Fuente: Ahrefs, Análisis Manual
- Acción: asegurar una sola versión (`sin www` o `con www`), 301 a la preferida, sin resultados con `www` indexados.
- Evidencias: búsqueda site con/without `www`, captura de redirecciones, reporte Ahrefs.

- Explicación: consolidar el host mantiene señales y evita duplicidades.
- Análisis: verificar indexación con `site:` en ambas variantes, comprobar redirecciones desde Ahrefs y pruebas en navegador.
- Solución: alinear redirecciones y enlaces internos a la variante preferida, actualizar canónicos.
- Prioridad: A si hay resultados de ambas variantes; B si ya está consolidado.
- Definición de Hecho: resultados indexados solo en la variante seleccionada y redirecciones correctas.

### Página 112 — Indexabilidad: Slash /
- Fuente: Ahrefs, Análisis Manual
- Acción: definir política de slash final y unificar con 301 (URLs con y sin `/` no deben coexistir indexables).
- Evidencias: pruebas con `RedirectPath` y ejemplos de redirecciones correctas.

- Explicación: coherencia de rutas evita duplicidades y mejora el rastreo.
- Análisis: detectar URLs de ambas variantes en Ahrefs y pruebas; revisar si existen cadenas.
- Solución: aplicar regla global y actualizar enlaces internos.
- Prioridad: A si hay coexistencia indexada; B si es ajuste menor.
- Definición de Hecho: una sola variante por ruta y sin cadenas.

### Página 113 — Indexabilidad: HTTP
- Fuente: Screaming Frog, Ahrefs, Análisis Manual
- Acción: forzar HTTPS, eliminar recursos mixtos, revisar que HTTP redirija a HTTPS en todas las rutas.
- Evidencias: export de SF con estados/redirects, listado de URLs HTTP con enlaces entrantes desde Ahrefs.

- Explicación: eliminar accesos por HTTP previene problemas de seguridad, duplicidad y señales negativas.
- Análisis: detectar URLs aún accesibles por `http` y enlaces entrantes apuntando a `http` (Ahrefs); validar redirecciones en SF.
- Solución: redirecciones globales `http→https`, actualizar fuentes de enlaces y corregir recursos mixtos.
- Prioridad: A si hay rutas críticas por `http`; B si es residual.
- Definición de Hecho: todo acceso redirige a `https` y no existen recursos mixtos.

### Página 114 — Indexabilidad: Paginaciones
- Fuente: GA4, Análisis Manual
- Acción: revisar categorías con paginación (`collections/all`, `/special-prices`); asegurar accesibilidad de enlaces de siguiente/anterior o scroll con enlaces internos.
- Evidencias: HTML con enlaces de paginación, capturas y métricas GA4 de navegación por páginas.

- Explicación: la navegación entre páginas de listado debe favorecer descubrimiento y continuidad del usuario.
- Análisis: medir con GA4 el flujo de navegación entre páginas (siguiente/anterior), tasas de abandono y profundidad; revisar que los enlaces sean clicables y visibles.
- Solución: mejorar enlaces de paginación, añadir bloques de categorías/populares, ajustar cantidad de ítems por página según comportamiento.
- Prioridad: A si hay abandono alto o bloqueo de navegación; B si hay margen de mejora moderado.
- Definición de Hecho: aumento de navegación profunda y reducción de abandono en GA4.

### Página 115 — Mobile Optimization (portada)
- Fuente: GA4
- Acción: recopilar métricas móviles (por dispositivo, resolución, engagement) para establecer línea base.
- Evidencias: paneles GA4 segmentados por dispositivo, gráficos y notas.

- Explicación: establecer métricas base móviles permite medir el impacto de optimizaciones y identificar oportunidades de mejora específicas por dispositivo.
- Análisis: segmentar datos GA4 por dispositivo y resolución, analizar engagement móvil vs desktop, identificar patrones de comportamiento por tipo de dispositivo, establecer benchmarks internos.
- Solución: crear dashboards específicos móviles, definir KPIs móviles clave, establecer alertas para cambios significativos en métricas móviles, documentar línea base para comparaciones futuras.
- Prioridad: B como actividad de establecimiento de baseline.
- Definición de Hecho: dashboard móvil configurado con métricas base documentadas y benchmarks establecidos.

### Página 116 — Mobile Optimization (revisión)
- Fuente: GA4, Screaming Frog, Ahrefs, Análisis Manual
- Acción: auditar responsive, navegación, tap targets, tipografías, performance; priorizar plantillas críticas.
- Evidencias: SF con UA móvil, checklist UX móvil y capturas.

- Explicación: la auditoría técnica móvil identifica problemas específicos que afectan la experiencia del usuario y el posicionamiento en mobile-first indexing.
- Análisis: usar Screaming Frog con user agent móvil, auditar responsive design en dispositivos reales, evaluar tap targets y navegación, medir performance móvil específica, priorizar por impacto en conversión.
- Solución: corregir problemas de responsive design, optimizar tap targets para usabilidad, mejorar navegación móvil, implementar optimizaciones específicas de performance móvil.
- Prioridad: A en plantillas críticas con problemas graves; B en optimizaciones incrementales.
- Definición de Hecho: auditoría completa con problemas críticos resueltos y mejora en métricas móviles.

### Página 117 — Core Web Vitals de la Home: No superada
- Fuente: GA4, PageSpeed
- Acción: aplicar correcciones: minimizar trabajo del hilo principal, reducir impacto de terceros, evitar DOM excesivo, optimizar CSS/JS.
- Evidencias: informe PageSpeed (móvil/escritorio), métricas CWV antes/después.

- Explicación: los Core Web Vitals son factores de ranking críticos que impactan directamente en SEO y experiencia del usuario, especialmente en la home.
- Análisis: medir LCP, FID y CLS con PageSpeed Insights, identificar recursos que bloquean el renderizado, analizar impacto de scripts de terceros, evaluar tamaño del DOM.
- Solución: optimizar LCP reduciendo tiempo de carga de elementos principales, mejorar FID minimizando JavaScript bloqueante, estabilizar CLS evitando cambios de layout, implementar lazy loading estratégico.
- Prioridad: A por ser la página más crítica y factor de ranking directo.
- Definición de Hecho: Core Web Vitals en verde (LCP <2.5s, FID <100ms, CLS <0.1) con mejora sostenida.

### Página 118 — Optimización de velocidad (revisión)
- Fuente: GA4, Ahrefs, PageSpeed, Análisis Manual
- Acción: revisar estado de velocidad en móvil/escritorio y rendimiento CDN por regiones; plan de mejoras.
- Evidencias: PageSpeed por plantillas, resultados KeyCDN Performance Test.

- Explicación: la velocidad de carga impacta rankings, conversiones y experiencia del usuario, requiriendo optimización continua y monitoreo por regiones.
- Análisis: auditar velocidad por plantilla con PageSpeed, evaluar rendimiento CDN por regiones geográficas, identificar cuellos de botella específicos, correlacionar velocidad con métricas de conversión.
- Solución: optimizar recursos críticos, configurar CDN para mejor cobertura geográfica, implementar compresión y minificación, establecer monitoreo continuo de performance.
- Prioridad: A en plantillas críticas con problemas de velocidad; B en optimizaciones preventivas.
- Definición de Hecho: mejora medible en velocidad de carga con impacto positivo en métricas de negocio.

### Página 119 — SEO Off‑Page (portada)
- Fuente: Análisis Manual
- Acción: introducción del bloque y alcance: perfil de enlaces, dominios referidos, fuerza, spam, anclas.
- Evidencias: índice del bloque y objetivos.

- Explicación: el SEO off-page evalúa la autoridad y reputación del sitio a través de señales externas, críticas para el posicionamiento competitivo.
- Análisis: definir alcance del análisis off-page, establecer métricas clave a evaluar, identificar competidores para benchmarking, planificar metodología de análisis.
- Solución: crear framework de evaluación off-page, establecer objetivos específicos por área, definir cronograma de análisis, preparar herramientas y accesos necesarios.
- Prioridad: B como actividad de planificación y estructura.
- Definición de Hecho: framework off-page definido con objetivos claros y metodología establecida.

### Página 120 — Perfil de enlaces (visión general)
- Fuente: GA4, Ahrefs
- Acción: validar crecimiento de dominios y enlaces, salud general del perfil.
- Evidencias: export Ahrefs (dominios y enlaces), gráficos de tendencia.

- Explicación: el perfil de enlaces refleja la autoridad y crecimiento orgánico del sitio, siendo fundamental para el posicionamiento competitivo.
- Análisis: evaluar tendencias de crecimiento de dominios referidos y enlaces, analizar velocidad de adquisición, identificar patrones estacionales, comparar con benchmarks del sector.
- Solución: establecer objetivos de crecimiento de enlaces, identificar oportunidades de link building, crear estrategia de adquisición sostenible, implementar monitoreo continuo.
- Prioridad: A si hay problemas en el perfil; B para optimización estratégica.
- Definición de Hecho: perfil de enlaces saludable con crecimiento sostenible y objetivos claros establecidos.

### Página 121 — Dominios Referidos
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: analizar variedad y calidad; proporción dofollow/nofollow; identificar dominios clave.
- Evidencias: tabla de referidos con tipo de enlace; notas de evaluación.

- Explicación: la diversidad y calidad de dominios referidos determina la fortaleza y naturalidad del perfil de enlaces.
- Análisis: evaluar diversidad temática y geográfica de dominios, analizar proporción dofollow/nofollow, identificar dominios de alta autoridad, detectar patrones no naturales.
- Solución: diversificar fuentes de enlaces, mantener proporción natural dofollow/nofollow, cultivar relaciones con dominios de alta autoridad, eliminar enlaces de baja calidad.
- Prioridad: A si hay desequilibrios graves; B para optimización estratégica.
- Definición de Hecho: perfil diversificado con dominios de calidad y proporción natural de tipos de enlace.

### Página 122 — Fuerza de Dominio
- Fuente: Ahrefs, Análisis Manual
- Acción: revisar métricas de autoridad/DR; impacto en posicionamiento; fijar objetivos.
- Evidencias: capturas y valores de DR/UR; comparativa histórica.

- Explicación: las métricas de autoridad de dominio correlacionan con capacidad de posicionamiento y deben monitorearse para establecer objetivos realistas.
- Análisis: evaluar evolución histórica de DR/UR, correlacionar con performance de posicionamiento, identificar factores que impactan autoridad, establecer benchmarks competitivos.
- Solución: definir objetivos de crecimiento de autoridad, implementar estrategias para mejorar DR, monitorear factores que impactan autoridad, crear plan de mejora a largo plazo.
- Prioridad: B como métrica de seguimiento estratégico.
- Definición de Hecho: objetivos de autoridad establecidos con plan de crecimiento y monitoreo implementado.

### Página 123 — Fuerza de Dominio (comparativa)
- Fuente: Ahrefs
- Acción: comparar fuerza con competidores y páginas internas relevantes; detectar gaps.
- Evidencias: tabla comparativa y conclusiones.

- Explicación: el análisis competitivo de autoridad identifica gaps y oportunidades para mejorar posicionamiento relativo.
- Análisis: comparar DR/UR con competidores directos, identificar páginas internas con mayor autoridad, detectar oportunidades de mejora, analizar estrategias competitivas exitosas.
- Solución: cerrar gaps de autoridad identificados, redistribuir autoridad interna estratégicamente, implementar tácticas competitivas exitosas, establecer ventajas competitivas sostenibles.
- Prioridad: A si hay gaps significativos vs competencia; B para optimización estratégica.
- Definición de Hecho: gaps competitivos identificados con plan de acción para cerrar brechas de autoridad.

### Página 124 — Dominios SPAM
- Fuente: GA4, Search Console, Análisis Manual
- Acción: identificar referidos con alto spam score; preparar lista de desautorización si procede.
- Evidencias: listado de dominios con spam elevado y decisiones (keep/disavow).

- Explicación: los enlaces de dominios spam pueden penalizar el sitio y deben identificarse y desautorizarse cuando sea necesario.
- Análisis: identificar dominios con alto spam score, evaluar relevancia y naturalidad de enlaces, analizar impacto potencial en rankings, revisar patrones de enlaces sospechosos.
- Solución: crear lista de desautorización para dominios claramente spam, mantener enlaces de dominios con spam moderado pero relevantes, implementar monitoreo continuo de nuevos enlaces spam.
- Prioridad: A si hay enlaces spam significativos; C si el perfil está limpio.
- Definición de Hecho: perfil limpio de spam con proceso de monitoreo y desautorización implementado.

### Página 125 — Origen Enlaces
- Fuente: Ahrefs, Análisis Manual
- Acción: analizar distribución geográfica de referidos, identificar origen no natural y riesgos.
- Evidencias: mapa/tabla por países y recomendaciones.

- Explicación: la distribución geográfica de enlaces debe ser natural y alineada con el mercado objetivo para evitar penalizaciones.
- Análisis: mapear origen geográfico de enlaces, identificar concentraciones no naturales, evaluar alineación con mercados objetivo, detectar patrones sospechosos por región.
- Solución: diversificar origen geográfico de enlaces, enfocar link building en mercados objetivo, eliminar enlaces de regiones no relevantes con patrones sospechosos.
- Prioridad: A si hay patrones no naturales evidentes; B para optimización estratégica.
- Definición de Hecho: distribución geográfica natural alineada con mercados objetivo.

### Página 126 — Enlaces rotos
- Fuente: Ahrefs, Análisis Manual
- Acción: detectar inbound links a URLs 404 y recuperar con redirecciones o restauración.
- Evidencias: lista de enlaces rotos y estado de corrección.

- Explicación: los enlaces entrantes a páginas 404 representan autoridad perdida que puede recuperarse con redirecciones estratégicas.
- Análisis: identificar enlaces entrantes a URLs 404, evaluar autoridad de dominios referidos, priorizar por impacto potencial, analizar contenido original para redirecciones apropiadas.
- Solución: implementar redirects 301 a contenido relevante, restaurar contenido valioso cuando sea apropiado, contactar webmasters para actualizar enlaces cuando sea posible.
- Prioridad: A en enlaces de alta autoridad a 404s; B en enlaces menores.
- Definición de Hecho: autoridad de enlaces recuperada con redirects implementados y enlaces actualizados.

### Página 127 — Texto de ancla
- Fuente: GA4, Search Console, Ahrefs, Análisis Manual
- Acción: revisar distribución de anchor text; fomentar anchors con keywords sin sobreoptimizar; evitar genéricos excesivos.
- Evidencias: distribución de anchors y acciones propuestas.

- Explicación: la distribución natural de anchor text fortalece relevancia temática sin crear patrones de sobreoptimización que puedan penalizar.
- Análisis: analizar distribución actual de anchor text, identificar sobreoptimización o patrones no naturales, evaluar relevancia temática, comparar con patrones naturales del sector.
- Solución: diversificar anchor text con variaciones naturales, reducir sobreoptimización de keywords exactas, incluir anchors de marca y genéricos en proporción natural.
- Prioridad: A si hay sobreoptimización evidente; B para optimización preventiva.
- Definición de Hecho: distribución natural de anchor text que fortalece relevancia sin riesgos de penalización.

### Página 128 — Dominios perdidos
- Fuente: GA4, Ahrefs, Análisis Manual
- Acción: analizar dominios perdidos; priorizar recuperación/contacto; detectar causas.
- Evidencias: listado de referidos perdidos últimos 3 meses y plan de actuación.

- Explicación: la pérdida de enlaces valiosos impacta autoridad y rankings, requiriendo análisis de causas y estrategias de recuperación.
- Análisis: identificar dominios perdidos recientes, evaluar autoridad e impacto de enlaces perdidos, analizar causas de pérdida, priorizar oportunidades de recuperación.
- Solución: contactar webmasters para recuperar enlaces valiosos, identificar y corregir causas técnicas de pérdida, implementar monitoreo proactivo de enlaces críticos.
- Prioridad: A en enlaces de alta autoridad perdidos; B en enlaces menores.
- Definición de Hecho: enlaces críticos recuperados con sistema de monitoreo implementado para prevenir pérdidas futuras.

### Página 129 — Anchor Text en Dominios Entrantes (tareas)
- Fuente: Ahrefs, SEMrush
- Acción: planificar acciones de mejora de anchor text: mix de marca/keyword, enlaces contextuales, evitar patrones sospechosos.
- Evidencias: checklist de tareas y criterios de evaluación.

- Explicación: la optimización proactiva de anchor text requiere planificación estratégica para mejorar relevancia manteniendo naturalidad.
- Análisis: definir objetivos de distribución de anchor text, identificar oportunidades de mejora, planificar outreach para optimización de anchors, establecer criterios de evaluación.
- Solución: crear plan de outreach para mejorar anchor text, establecer guidelines para nuevos enlaces, implementar monitoreo de distribución de anchors, definir métricas de éxito.
- Prioridad: B como actividad de planificación estratégica.
- Definición de Hecho: plan de optimización de anchor text implementado con criterios claros y monitoreo establecido.

## Sección 08 — Priorización de Tareas (páginas 130–133)

### Página 130 — Tareas Auditoría (SEO Técnico)
- Fuente: GA4, Search Console, Ahrefs
- Acción: compilar backlog de tareas técnicas basadas en hallazgos previos: errores 4XX/5XX, paginaciones, arquitectura SEO, página 404, mobile optimization, menú de navegación, redirecciones 3XX, WPO, optimización de URLs, errores de código, enlazado interno.
- Evidencias: backlog consolidado con referencia a páginas del informe (IDs y URLs), severidad y dependencia.

- Explicación: la consolidación de tareas técnicas permite priorizar y ejecutar mejoras SEO de manera sistemática y eficiente.
- Análisis: revisar todos los hallazgos técnicos identificados, categorizar por tipo de problema, evaluar impacto y esfuerzo requerido, establecer dependencias entre tareas.
- Solución: crear backlog estructurado con referencias específicas, definir criterios de priorización, establecer roadmap de implementación, asignar responsabilidades y recursos.
- Prioridad: B como actividad de consolidación y planificación.
- Definición de Hecho: backlog técnico completo con tareas priorizadas y roadmap de implementación establecido.

### Página 131 — Prioridad de las tareas
- Fuente: GA4, Search Console, Ahrefs
- Acción: priorizar en rangos A/B/C según impacto en negocio (tráfico/conversión), esfuerzo (tiempo/recursos), urgencia y riesgo; se sugiere RICE (Reach, Impact, Confidence, Effort) o ICE.
- Evidencias: tabla de priorización con criterio, puntuación y orden; roadmap y hitos.

- Explicación: la priorización sistemática asegura que los recursos se enfoquen en las mejoras con mayor impacto en el negocio.
- Análisis: aplicar framework de priorización (RICE o ICE), evaluar impacto en métricas de negocio, estimar esfuerzo requerido, considerar urgencia y riesgos, establecer orden de ejecución.
- Solución: implementar sistema de scoring para tareas, crear roadmap temporal con hitos, establecer criterios de revisión y ajuste de prioridades, definir métricas de éxito.
- Prioridad: A como actividad crítica de planificación estratégica.
- Definición de Hecho: sistema de priorización implementado con roadmap claro y criterios de éxito definidos.

### Página 132 — Tareas Auditoría (SEO On‑Page)
- Fuente: GA4, Search Console, Ahrefs
- Acción: compilar backlog de tareas on‑page basadas en hallazgos previos: errores 4XX/5XX, paginaciones, arquitectura SEO, página 404, mobile optimization, menú de navegación, meta tags, headings, contenido, interlinking, imágenes, canibalizaciones, datos estructurados, hreflang, accesibilidad.
- Evidencias: backlog consolidado con referencia a páginas del informe (IDs y URLs), severidad y dependencia.

- Explicación: la consolidación de tareas on-page permite optimizar contenido y estructura de manera coordinada y eficiente.
- Análisis: revisar todos los hallazgos on-page identificados, categorizar por área de optimización, evaluar impacto en posicionamiento, establecer interdependencias entre mejoras.
- Solución: crear backlog on-page estructurado, definir templates de optimización, establecer workflows de implementación, crear sistema de seguimiento y validación.
- Prioridad: B como actividad de consolidación y planificación.
- Definición de Hecho: backlog on-page completo con tareas categorizadas y sistema de implementación establecido.

### Página 133 — Prioridad de las tareas
- Fuente: GA4, Search Console, Ahrefs
- Acción: priorizar en rangos A/B/C según impacto en negocio (tráfico/conversión), esfuerzo (tiempo/recursos), urgencia y riesgo; se sugiere RICE (Reach, Impact, Confidence, Effort) o ICE.
- Evidencias: tabla de priorización con criterio, puntuación y orden; roadmap y hitos.

- Explicación: la priorización de tareas on-page asegura que las optimizaciones de contenido generen el máximo impacto en posicionamiento y conversiones.
- Análisis: aplicar criterios de priorización específicos para on-page, evaluar potencial de mejora en rankings, estimar impacto en tráfico orgánico, considerar recursos de contenido disponibles.
- Solución: crear matriz de priorización on-page, establecer cronograma de optimizaciones, definir métricas de seguimiento específicas, implementar proceso de validación de mejoras.
- Prioridad: A como actividad crítica para maximizar ROI de optimizaciones.
- Definición de Hecho: plan de priorización on-page implementado con cronograma y métricas de seguimiento establecidas.