<?php
/**
 * Módulo: Análisis de Arquitectura Actual (m3.1)
 * Fase: 3 - Arquitectura
 * Descripción: Evaluar estructura web actual, jerarquía de contenido y crawl efficiency
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 3
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$estructura_actual = $datosModulo['estructura_actual'] ?? [];
$metricas_crawl = $datosModulo['metricas_crawl'] ?? [];
$profundidad_paginas = $datosModulo['profundidad_paginas'] ?? [];
$categorias = $datosModulo['analisis_categorias'] ?? [];
$distribucion_contenido = $datosModulo['distribucion_contenido'] ?? [];
$problemas_arquitectura = $datosModulo['problemas_detectados'] ?? [];
$benchmark_competencia = $datosModulo['benchmark_competencia'] ?? [];
$oportunidades = $datosModulo['oportunidades_mejora'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page arquitectura-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Análisis de Arquitectura Actual'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Evaluación de estructura web, jerarquía y crawl efficiency'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Herramientas: Screaming Frog, Google Analytics 4, Google Search Console</span>
            <span>Fase 3 - Arquitectura</span>
        </div>
    </div>

    <div class="page-body">

        <!-- SECCIÓN EDUCATIVA: ¿Qué es la Arquitectura Web? -->
        <section class="concepto-educativo">
            <div class="concepto-header">
                <span class="concepto-icon">📚</span>
                <h2>¿Qué es la Arquitectura Web y Por Qué es Importante?</h2>
            </div>
            <div class="concepto-content">
                <p class="concepto-intro">
                    La arquitectura web es la forma en que organizas y estructuras todas las páginas de tu sitio.
                    Es como diseñar un edificio: necesitas que los visitantes (y Google) puedan navegar fácilmente
                    de una habitación a otra sin perderse.
                </p>
                <div class="analogia-box">
                    <div class="analogia-header">
                        <span class="analogia-icon">💡</span>
                        <strong>Piensa en tu sitio web como un edificio de apartamentos:</strong>
                    </div>
                    <ul class="analogia-list">
                        <li><strong>La home (nivel 0)</strong> es la recepción principal - el primer punto de contacto</li>
                        <li><strong>Las categorías (nivel 1)</strong> son los diferentes pisos del edificio</li>
                        <li><strong>Las subcategorías (nivel 2)</strong> son los pasillos de cada piso</li>
                        <li><strong>Las páginas individuales (nivel 3+)</strong> son las habitaciones</li>
                    </ul>
                    <p class="analogia-conclusion">
                        <strong>Problema:</strong> Si una habitación está demasiado lejos de la recepción (más de 4 "pisos" de distancia),
                        los visitantes se cansarán de buscar y Google raramente llegará hasta allí.
                    </p>
                </div>
                <div class="impacto-box">
                    <h3>¿Cómo Afecta la Arquitectura a Tu Negocio?</h3>
                    <div class="impacto-grid">
                        <div class="impacto-item">
                            <span class="impacto-icon">🔍</span>
                            <div class="impacto-text">
                                <strong>SEO:</strong> Google rastrea mejor sitios bien organizados. Páginas a >3 clics pierden 40-60% de visibilidad.
                            </div>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon">👥</span>
                            <div class="impacto-text">
                                <strong>Usuarios:</strong> Cada clic adicional = -10% tasa de conversión. Simplicidad = más reservas.
                            </div>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon">⚡</span>
                            <div class="impacto-text">
                                <strong>Crawl Budget:</strong> Google tiene tiempo limitado. Arquitectura eficiente = más páginas indexadas.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN: Archivos de Trabajo Descargables -->
        <section class="entregables-section">
            <div class="entregables-header">
                <span class="entregables-icon">📄</span>
                <h2>Archivos de Trabajo para Implementar las Mejoras</h2>
            </div>
            <p class="entregables-intro">
                Hemos preparado archivos CSV listos para usar con todas las URLs que necesitan corrección.
                Descárgalos, ábrelos en Excel y empieza a trabajar:
            </p>
            <div class="entregables-grid">
                <div class="entregable-card priority-critical">
                    <div class="entregable-icon">
                        <i class="fas fa-file-csv"></i>
                    </div>
                    <div class="entregable-content">
                        <h3>URLs Huérfanas a Enlazar</h3>
                        <p class="entregable-desc">
                            <strong>127 páginas</strong> sin enlaces internos. Incluye desde dónde enlazar y acción específica para cada URL.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Muy Alta</span>
                            <span class="meta-badge impact">Impacto: +1,200-1,500 sesiones/mes</span>
                        </div>
                        <a href="/entregables/arquitectura/urls_huerfanas_corregir.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 127 URLs huérfanas">
                            <i class="fas fa-download"></i> Descargar CSV
                        </a>
                    </div>
                </div>
                <div class="entregable-card priority-high">
                    <div class="entregable-icon">
                        <i class="fas fa-file-csv"></i>
                    </div>
                    <div class="entregable-content">
                        <h3>URLs Profundas a Reducir</h3>
                        <p class="entregable-desc">
                            <strong>26 páginas</strong> a >4 clics con alto tráfico. Plan para reducir su profundidad a 2-3 clics.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Alta</span>
                            <span class="meta-badge impact">Impacto: +800-1,200 sesiones/mes</span>
                        </div>
                        <a href="/entregables/arquitectura/urls_profundas_reducir.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 26 URLs profundas">
                            <i class="fas fa-download"></i> Descargar CSV
                        </a>
                    </div>
                </div>
            </div>
            <div class="como-usar-entregables">
                <h3>💡 Cómo Usar Estos Archivos</h3>
                <ol class="uso-list">
                    <li><strong>Descarga</strong> el CSV haciendo clic en el botón azul</li>
                    <li><strong>Ábrelo</strong> en Excel, Google Sheets o Numbers</li>
                    <li><strong>Ordena</strong> por columna "Prioridad" para empezar por lo más importante</li>
                    <li><strong>Asigna</strong> tareas a tu equipo (puedes añadir columna "Responsable")</li>
                    <li><strong>Marca</strong> como completado según avances (añade columna "Estado")</li>
                </ol>
            </div>
        </section>

        <!-- SECCIÓN: Comparación Visual ANTES vs DESPUÉS -->
        <section class="comparacion-antes-despues">
            <div class="comparacion-main-header">
                <span class="comparacion-main-icon">🔍</span>
                <h2>Situación Actual vs. Propuesta de Mejora</h2>
            </div>
            <p class="comparacion-intro">
                A continuación mostramos un resumen visual de los problemas detectados y cómo se resolverán con las acciones del plan:
            </p>

            <div class="comparacion-grid">
                <!-- COLUMNA ANTES -->
                <div class="comparacion-columna antes">
                    <div class="comparacion-header error">
                        <span class="badge-estado antes">ANTES - SITUACIÓN ACTUAL</span>
                        <h3>Estado Actual de la Arquitectura</h3>
                    </div>
                    <div class="comparacion-content">
                        <!-- Diagrama visual simplificado -->
                        <div class="arquitectura-visual">
                            <div class="arq-nivel nivel-0">
                                <div class="arq-nodo home">🏠 Home</div>
                            </div>
                            <div class="arq-nivel nivel-1">
                                <div class="arq-nodo categoria">Villas</div>
                                <div class="arq-nodo categoria">Blog</div>
                                <div class="arq-nodo categoria">Servicios</div>
                            </div>
                            <div class="arq-nivel nivel-2">
                                <div class="arq-nodo subcategoria">Por Zona</div>
                                <div class="arq-nodo subcategoria">Artículos</div>
                                <div class="arq-nodo subcategoria">Extras</div>
                            </div>
                            <div class="arq-nivel nivel-3-plus">
                                <div class="arq-nodo pagina profunda">26 páginas a >4 clics</div>
                            </div>
                            <div class="arq-huerfanas">
                                <div class="arq-nodo huerfana">127 páginas huérfanas</div>
                            </div>
                        </div>

                        <!-- Lista de problemas -->
                        <div class="problemas-lista">
                            <h4>Problemas Detectados:</h4>
                            <ul>
                                <li class="problema-item">
                                    <span class="icon-error">❌</span>
                                    <div class="problema-texto">
                                        <strong>127 páginas huérfanas</strong> sin enlaces internos
                                        <span class="problema-detalle">No reciben autoridad ni tráfico</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error">❌</span>
                                    <div class="problema-texto">
                                        <strong>26 páginas a >4 clics</strong> de profundidad excesiva
                                        <span class="problema-detalle">Google raramente las rastrea</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error">❌</span>
                                    <div class="problema-texto">
                                        <strong>Profundidad media: 3.8 clics</strong>
                                        <span class="problema-detalle">Objetivo: ≤3 clics para páginas clave</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error">❌</span>
                                    <div class="problema-texto">
                                        <strong>Pérdida estimada:</strong> 1,200-1,500 sesiones/mes
                                        <span class="problema-detalle">Por baja visibilidad de contenido valioso</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- FLECHA DE TRANSFORMACIÓN -->
                <div class="transformacion-arrow">
                    <div class="arrow-icon">➡️</div>
                    <p class="arrow-text">Implementando<br>las acciones<br>del CSV</p>
                </div>

                <!-- COLUMNA DESPUÉS -->
                <div class="comparacion-columna despues">
                    <div class="comparacion-header success">
                        <span class="badge-estado despues">DESPUÉS - SOLUCIÓN PROPUESTA</span>
                        <h3>Arquitectura Optimizada</h3>
                    </div>
                    <div class="comparacion-content">
                        <!-- Diagrama visual mejorado -->
                        <div class="arquitectura-visual">
                            <div class="arq-nivel nivel-0">
                                <div class="arq-nodo home">🏠 Home</div>
                            </div>
                            <div class="arq-nivel nivel-1">
                                <div class="arq-nodo categoria mejorado">Villas</div>
                                <div class="arq-nodo categoria mejorado">Blog</div>
                                <div class="arq-nodo categoria mejorado">Servicios</div>
                            </div>
                            <div class="arq-nivel nivel-2">
                                <div class="arq-nodo subcategoria mejorado">Por Zona</div>
                                <div class="arq-nodo subcategoria mejorado">Artículos</div>
                                <div class="arq-nodo subcategoria mejorado">Extras</div>
                            </div>
                            <div class="arq-nivel nivel-3-plus">
                                <div class="arq-nodo pagina mejorado">Todas a ≤3 clics</div>
                            </div>
                            <div class="arq-nota-mejora">
                                ✅ Todas las páginas enlazadas desde categorías relevantes
                            </div>
                        </div>

                        <!-- Lista de mejoras -->
                        <div class="mejoras-lista">
                            <h4>Mejoras Implementadas:</h4>
                            <ul>
                                <li class="mejora-item">
                                    <span class="icon-success">✅</span>
                                    <div class="mejora-texto">
                                        <strong>127 páginas enlazadas</strong> desde categorías relevantes
                                        <span class="mejora-detalle">Reciben autoridad y son rastreables</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success">✅</span>
                                    <div class="mejora-texto">
                                        <strong>26 páginas reducidas</strong> a ≤3 clics de profundidad
                                        <span class="mejora-detalle">Google las rastrea regularmente</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success">✅</span>
                                    <div class="mejora-texto">
                                        <strong>Profundidad media: 2.1 clics</strong>
                                        <span class="mejora-detalle">Reducción del 45%</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success">✅</span>
                                    <div class="mejora-texto">
                                        <strong>Ganancia estimada:</strong> +1,200-1,500 sesiones/mes
                                        <span class="mejora-detalle">Contenido valioso ahora es visible</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN: Tabla de KPIs y Resultados Esperados -->
        <section class="kpis-esperados-section">
            <div class="section-badge-container">
                <span class="section-badge badge-despues">DESPUÉS - RESULTADOS ESPERADOS</span>
            </div>
            <h2>📈 Resultados Esperados (30-90 días post-implementación)</h2>
            <p class="kpis-intro">
                Si implementas las acciones de los archivos CSV descargables, estos son los resultados que puedes esperar ver en tu sitio:
            </p>

            <div class="tabla-kpis-container">
                <table class="tabla-kpis">
                    <thead>
                        <tr>
                            <th class="col-metrica">Métrica</th>
                            <th class="col-antes">ANTES<br><span class="col-subtitle">Situación Actual</span></th>
                            <th class="col-despues">DESPUÉS<br><span class="col-subtitle">Con Mejoras</span></th>
                            <th class="col-mejora">Mejora</th>
                            <th class="col-impacto">Impacto en Negocio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="kpi-row critical">
                            <td class="metrica-nombre">
                                <strong>Páginas Huérfanas</strong>
                                <span class="metrica-descripcion">Páginas sin enlaces internos</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">127</span>
                                <span class="valor-unidad">páginas</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">0</span>
                                <span class="valor-unidad">páginas</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">+100%</span>
                                    <span class="mejora-texto">enlazadas</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Todas las páginas ahora reciben autoridad y son rastreables por Google
                            </td>
                        </tr>
                        <tr class="kpi-row high">
                            <td class="metrica-nombre">
                                <strong>Profundidad Promedio</strong>
                                <span class="metrica-descripcion">Clics desde home a páginas</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">3.8</span>
                                <span class="valor-unidad">clics</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">2.1</span>
                                <span class="valor-unidad">clics</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">-45%</span>
                                    <span class="mejora-texto">reducción</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Páginas más accesibles mejoran experiencia de usuario y rastreo de Google
                            </td>
                        </tr>
                        <tr class="kpi-row high">
                            <td class="metrica-nombre">
                                <strong>Páginas a >3 Clics</strong>
                                <span class="metrica-descripcion">Páginas con profundidad excesiva</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">26</span>
                                <span class="valor-unidad">páginas</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">0</span>
                                <span class="valor-unidad">páginas</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">-100%</span>
                                    <span class="mejora-texto">eliminadas</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Contenido clave ahora es fácilmente descubrible
                            </td>
                        </tr>
                        <tr class="kpi-row critical highlight-row">
                            <td class="metrica-nombre">
                                <strong>Tráfico Orgánico Mensual</strong>
                                <span class="metrica-descripcion">Sesiones desde Google</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">8,450</span>
                                <span class="valor-unidad">sesiones/mes</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">9,650-9,950</span>
                                <span class="valor-unidad">sesiones/mes</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success large">
                                    <span class="mejora-porcentaje">+14-18%</span>
                                    <span class="mejora-texto">incremento</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                <strong>+1,200-1,500 sesiones/mes adicionales</strong> de contenido ahora visible
                            </td>
                        </tr>
                        <tr class="kpi-row medium">
                            <td class="metrica-nombre">
                                <strong>Crawl Efficiency</strong>
                                <span class="metrica-descripcion">% de páginas rastreadas</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">68%</span>
                                <span class="valor-unidad">rastreadas</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">92%</span>
                                <span class="valor-unidad">rastreadas</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">+24pp</span>
                                    <span class="mejora-texto">mejora</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Google dedica más tiempo a rastrear contenido valioso
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="kpis-nota-importante">
                <div class="nota-header">
                    <span class="nota-icon">💡</span>
                    <strong>Nota Importante</strong>
                </div>
                <p>
                    Estos resultados son estimaciones conservadoras basadas en datos históricos de sitios similares.
                    Los resultados reales pueden variar según la velocidad de implementación y otros factores SEO.
                    <strong>Tiempo para ver resultados:</strong> Los primeros cambios en tráfico suelen verse en 30-45 días,
                    con impacto completo en 60-90 días.
                </p>
            </div>
        </section>

        <!-- Resumen Ejecutivo -->
        <?php if (!empty($resumen)): ?>
        <section class="executive-summary situacion-actual-section">
            <div class="section-badge-container">
                <span class="section-badge badge-antes">ANTES - SITUACIÓN ACTUAL</span>
            </div>
            <h2>Resumen Ejecutivo: Estado Actual</h2>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Score Arquitectura</div>
                    <div class="summary-value <?php echo $resumen['score_class'] ?? ''; ?>">
                        <?php echo htmlspecialchars($resumen['score'] ?? 'N/A'); ?>/100
                    </div>
                    <div class="summary-detail"><?php echo htmlspecialchars($resumen['score_description'] ?? ''); ?></div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Total URLs</div>
                    <div class="summary-value">
                        <?php echo number_format($resumen['total_urls'] ?? 0); ?>
                    </div>
                    <div class="summary-detail"><?php echo htmlspecialchars($resumen['urls_indexables'] ?? '0'); ?> indexables</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Profundidad Media</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['profundidad_media'] ?? 'N/A'); ?> clics
                    </div>
                    <div class="summary-detail">Óptimo: ≤3 clics</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Crawl Efficiency</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['crawl_efficiency'] ?? 'N/A'); ?>%
                    </div>
                    <div class="summary-detail"><?php echo htmlspecialchars($resumen['efficiency_status'] ?? ''); ?></div>
                </div>
            </div>
            <?php if (!empty($resumen['diagnostico'])): ?>
            <div class="summary-diagnosis">
                <h3>Diagnóstico General</h3>
                <p><?php echo nl2br(htmlspecialchars($resumen['diagnostico'])); ?></p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Estructura Actual -->
        <?php if (!empty($estructura_actual)): ?>
        <section class="estructura-section">
            <h2>Estructura de Navegación Actual</h2>

            <div class="estructura-overview">
                <h3>Jerarquía de Niveles</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nivel</th>
                            <th>Descripción</th>
                            <th>URLs</th>
                            <th>% Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estructura_actual['niveles'] ?? [] as $nivel): ?>
                        <tr>
                            <td><strong>Nivel <?php echo htmlspecialchars($nivel['numero']); ?></strong></td>
                            <td><?php echo htmlspecialchars($nivel['descripcion']); ?></td>
                            <td><?php echo number_format($nivel['urls']); ?></td>
                            <td><?php echo number_format($nivel['porcentaje'], 1); ?>%</td>
                            <td>
                                <span class="status-badge <?php echo $nivel['estado_class']; ?>">
                                    <?php echo htmlspecialchars($nivel['estado']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($estructura_actual['mapa_sitio'])): ?>
            <div class="sitemap-structure">
                <h3>Mapa de Estructura Principal</h3>
                <div class="sitemap-tree">
                    <?php echo $estructura_actual['mapa_sitio']; ?>
                </div>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Métricas de Crawl -->
        <?php if (!empty($metricas_crawl)): ?>
        <section class="crawl-metrics-section">
            <h2>Métricas de Crawl Efficiency</h2>

            <div class="metrics-grid">
                <div class="metric-box">
                    <div class="metric-header">Total URLs Crawleadas</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['total_crawled'] ?? 0); ?></div>
                    <div class="metric-footer">
                        <?php echo number_format($metricas_crawl['total_indexable'] ?? 0); ?> indexables
                    </div>
                </div>
                <div class="metric-box">
                    <div class="metric-header">URLs Duplicadas</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['duplicadas'] ?? 0); ?></div>
                    <div class="metric-footer">
                        <?php echo number_format($metricas_crawl['porcentaje_duplicadas'] ?? 0, 1); ?>% del total
                    </div>
                </div>
                <div class="metric-box">
                    <div class="metric-header">URLs Huérfanas</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['huerfanas'] ?? 0); ?></div>
                    <div class="metric-footer">
                        Sin enlaces internos
                    </div>
                </div>
                <div class="metric-box">
                    <div class="metric-header">Tiempo Medio Carga</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['tiempo_medio_carga'] ?? 0, 2); ?>s</div>
                    <div class="metric-footer">
                        Objetivo: &lt;3s
                    </div>
                </div>
            </div>

            <?php if (!empty($metricas_crawl['distribucion_status'])): ?>
            <div class="status-distribution">
                <h3>Distribución de Status Codes</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Status Code</th>
                            <th>Cantidad</th>
                            <th>% Total</th>
                            <th>Impacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($metricas_crawl['distribucion_status'] as $status): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($status['code']); ?></strong></td>
                            <td><?php echo number_format($status['cantidad']); ?></td>
                            <td><?php echo number_format($status['porcentaje'], 1); ?>%</td>
                            <td><?php echo htmlspecialchars($status['impacto']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Profundidad de Páginas -->
        <?php if (!empty($profundidad_paginas)): ?>
        <section class="profundidad-section">
            <h2>Análisis de Profundidad de Páginas</h2>

            <div class="profundidad-chart">
                <h3>Distribución por Nivel de Profundidad</h3>
                <div class="profundidad-bars">
                    <?php foreach ($profundidad_paginas['distribucion'] ?? [] as $prof): ?>
                    <div class="profundidad-row">
                        <div class="prof-label">
                            <?php echo htmlspecialchars($prof['nivel']); ?> clics
                        </div>
                        <div class="prof-bar-container">
                            <div class="prof-bar" style="width: <?php echo $prof['porcentaje']; ?>%;">
                                <span class="prof-bar-text">
                                    <?php echo number_format($prof['urls']); ?> URLs (<?php echo number_format($prof['porcentaje'], 1); ?>%)
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (!empty($profundidad_paginas['paginas_profundas'])): ?>
            <div class="paginas-profundas">
                <h3>URLs Críticas con Excesiva Profundidad (>4 clics)</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>Profundidad</th>
                            <th>Tráfico Orgánico</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($profundidad_paginas['paginas_profundas'] as $pagina): ?>
                        <tr>
                            <td class="url-cell"><?php echo htmlspecialchars($pagina['url']); ?></td>
                            <td><?php echo htmlspecialchars($pagina['profundidad']); ?> clics</td>
                            <td><?php echo number_format($pagina['trafico_organico']); ?> sesiones/mes</td>
                            <td>
                                <span class="priority-badge priority-<?php echo strtolower($pagina['prioridad']); ?>">
                                    <?php echo htmlspecialchars($pagina['prioridad']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <div class="profundidad-insight">
                <h3>Insight Clave</h3>
                <p><?php echo nl2br(htmlspecialchars($profundidad_paginas['insight'] ?? '')); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- Análisis de Categorías -->
        <?php if (!empty($categorias)): ?>
        <section class="categorias-section">
            <h2>Análisis de Categorías y Secciones</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>URLs</th>
                        <th>Tráfico Orgánico</th>
                        <th>Profundidad Media</th>
                        <th>Enlaces Internos</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias['secciones'] ?? [] as $seccion): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($seccion['nombre']); ?></strong></td>
                        <td><?php echo number_format($seccion['urls']); ?></td>
                        <td><?php echo number_format($seccion['trafico']); ?> sesiones/mes</td>
                        <td><?php echo number_format($seccion['profundidad_media'], 1); ?> clics</td>
                        <td><?php echo number_format($seccion['enlaces_internos']); ?></td>
                        <td>
                            <span class="status-badge <?php echo $seccion['estado_class']; ?>">
                                <?php echo htmlspecialchars($seccion['estado']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($categorias['recomendaciones'])): ?>
            <div class="categorias-recommendations">
                <h3>Recomendaciones por Categoría</h3>
                <ul class="recommendations-list">
                    <?php foreach ($categorias['recomendaciones'] as $rec): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($rec['categoria']); ?>:</strong>
                        <?php echo htmlspecialchars($rec['recomendacion']); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Distribución de Contenido -->
        <?php if (!empty($distribucion_contenido)): ?>
        <section class="distribucion-section">
            <h2>Distribución de Contenido por Tipo</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tipo de Contenido</th>
                        <th>Cantidad</th>
                        <th>% Total</th>
                        <th>Tráfico Promedio</th>
                        <th>Evaluación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($distribucion_contenido['tipos'] ?? [] as $tipo): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($tipo['nombre']); ?></strong></td>
                        <td><?php echo number_format($tipo['cantidad']); ?></td>
                        <td><?php echo number_format($tipo['porcentaje'], 1); ?>%</td>
                        <td><?php echo number_format($tipo['trafico_promedio']); ?> sesiones</td>
                        <td><?php echo htmlspecialchars($tipo['evaluacion']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="distribucion-insight">
                <h3>Análisis de Balance de Contenido</h3>
                <p><?php echo nl2br(htmlspecialchars($distribucion_contenido['analisis'] ?? '')); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- Problemas Detectados -->
        <?php if (!empty($problemas_arquitectura)): ?>
        <section class="problemas-section">
            <h2>Problemas de Arquitectura Detectados</h2>

            <?php foreach ($problemas_arquitectura as $problema): ?>
            <div class="problema-card severity-<?php echo strtolower($problema['severidad']); ?>">
                <div class="problema-header">
                    <span class="problema-severidad"><?php echo htmlspecialchars($problema['severidad']); ?></span>
                    <h3><?php echo htmlspecialchars($problema['titulo']); ?></h3>
                </div>
                <div class="problema-body">
                    <div class="problema-description">
                        <strong>Descripción:</strong>
                        <p><?php echo nl2br(htmlspecialchars($problema['descripcion'])); ?></p>
                    </div>
                    <div class="problema-impact">
                        <strong>Impacto SEO:</strong>
                        <p><?php echo nl2br(htmlspecialchars($problema['impacto'])); ?></p>
                    </div>
                    <div class="problema-urls">
                        <strong>URLs Afectadas:</strong> <?php echo number_format($problema['urls_afectadas']); ?>
                    </div>
                    <?php if (!empty($problema['ejemplos'])): ?>
                    <div class="problema-ejemplos">
                        <strong>Ejemplos:</strong>
                        <ul>
                            <?php foreach ($problema['ejemplos'] as $ejemplo): ?>
                            <li><?php echo htmlspecialchars($ejemplo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <!-- Benchmark Competencia -->
        <?php if (!empty($benchmark_competencia)): ?>
        <section class="benchmark-section">
            <h2>Benchmark vs Competencia</h2>

            <table class="data-table competitive-table">
                <thead>
                    <tr>
                        <th>Sitio</th>
                        <th>Total URLs</th>
                        <th>Profundidad Media</th>
                        <th>Niveles Jerarquía</th>
                        <th>Crawl Efficiency</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($benchmark_competencia['sitios'] ?? [] as $sitio): ?>
                    <tr class="<?php echo $sitio['es_tuyo'] ? 'highlight-row' : ''; ?>">
                        <td>
                            <strong><?php echo htmlspecialchars($sitio['nombre']); ?></strong>
                            <?php if ($sitio['es_tuyo']): ?>
                            <span class="badge-current">TU SITIO</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo number_format($sitio['total_urls']); ?></td>
                        <td><?php echo number_format($sitio['profundidad_media'], 1); ?> clics</td>
                        <td><?php echo htmlspecialchars($sitio['niveles_jerarquia']); ?></td>
                        <td><?php echo number_format($sitio['crawl_efficiency'], 1); ?>%</td>
                        <td>
                            <span class="score-badge score-<?php echo $sitio['score_class']; ?>">
                                <?php echo htmlspecialchars($sitio['score']); ?>/100
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($benchmark_competencia['insights'])): ?>
            <div class="benchmark-insights">
                <h3>Insights Competitivos</h3>
                <ul>
                    <?php foreach ($benchmark_competencia['insights'] as $insight): ?>
                    <li><?php echo htmlspecialchars($insight); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Oportunidades de Mejora -->
        <?php if (!empty($oportunidades)): ?>
        <section class="oportunidades-section">
            <h2>Oportunidades de Mejora Identificadas</h2>

            <div class="oportunidades-grid">
                <?php foreach ($oportunidades as $oportunidad): ?>
                <div class="oportunidad-card">
                    <div class="oportunidad-header">
                        <h3><?php echo htmlspecialchars($oportunidad['titulo']); ?></h3>
                        <span class="impact-badge impact-<?php echo strtolower($oportunidad['impacto']); ?>">
                            Impacto: <?php echo htmlspecialchars($oportunidad['impacto']); ?>
                        </span>
                    </div>
                    <div class="oportunidad-body">
                        <p><?php echo nl2br(htmlspecialchars($oportunidad['descripcion'])); ?></p>
                    </div>
                    <div class="oportunidad-footer">
                        <span class="effort-label">Esfuerzo: <?php echo htmlspecialchars($oportunidad['esfuerzo']); ?></span>
                        <span class="benefit-label">Beneficio potencial: <?php echo htmlspecialchars($oportunidad['beneficio']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <section class="recommendations-section">
            <h2>Recomendaciones Prioritarias</h2>

            <?php
            $prioridades = ['A' => 'Alta', 'B' => 'Media', 'C' => 'Baja'];
            foreach ($prioridades as $prioridad => $label):
                $recs_prioridad = array_filter($recomendaciones, function($r) use ($prioridad) {
                    return $r['prioridad'] === $prioridad;
                });
                if (empty($recs_prioridad)) continue;
            ?>
            <div class="priority-group">
                <h3 class="priority-header priority-<?php echo strtolower($prioridad); ?>">
                    Prioridad <?php echo $prioridad; ?> - <?php echo $label; ?>
                </h3>
                <div class="recommendations-list">
                    <?php foreach ($recs_prioridad as $rec): ?>
                    <div class="recommendation-item">
                        <div class="rec-title"><?php echo htmlspecialchars($rec['titulo']); ?></div>
                        <div class="rec-description"><?php echo nl2br(htmlspecialchars($rec['descripcion'])); ?></div>
                        <div class="rec-meta">
                            <span>Esfuerzo: <?php echo htmlspecialchars($rec['esfuerzo']); ?></span>
                            <span>Impacto: <?php echo htmlspecialchars($rec['impacto_esperado']); ?></span>
                            <?php if (!empty($rec['kpis'])): ?>
                            <span>KPIs: <?php echo htmlspecialchars($rec['kpis']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($config['proyecto']['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Análisis de Arquitectura | Auditoría SEO</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos profesionales para Análisis de Arquitectura - Color corporativo #88B04B */
.arquitectura-page {
    font-family: 'Hanken Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #333;
    line-height: 1.6;
}

.arquitectura-page .page-header {
    border-bottom: 3px solid #88B04B;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.arquitectura-page .page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 10px 0;
}

.arquitectura-page .page-subtitle {
    font-size: 16px;
    color: #666;
    margin: 0 0 15px 0;
}

.arquitectura-page .page-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 14px;
    color: #888;
}

.arquitectura-page .page-meta span {
    padding: 4px 0;
}

/* Executive Summary */
.arquitectura-page .executive-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 40px;
}

.arquitectura-page .executive-summary h2 {
    margin: 0 0 20px 0;
    font-size: 22px;
    font-weight: 600;
}

.arquitectura-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.arquitectura-page .summary-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px;
    border-radius: 6px;
    text-align: center;
}

.arquitectura-page .summary-label {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    opacity: 0.9;
}

.arquitectura-page .summary-value {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
}

.arquitectura-page .summary-detail {
    font-size: 13px;
    opacity: 0.85;
}

.arquitectura-page .summary-diagnosis {
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 6px;
    margin-top: 20px;
}

.arquitectura-page .summary-diagnosis h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    font-weight: 600;
}

.arquitectura-page .summary-diagnosis p {
    margin: 0;
    line-height: 1.7;
}

/* Secciones */
.arquitectura-page section {
    margin-bottom: 40px;
}

.arquitectura-page section h2 {
    font-size: 22px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #88B04B;
}

.arquitectura-page section h3 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 20px 0 15px 0;
}

/* Tablas */
.arquitectura-page .data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: white;
    border: 1px solid #e0e0e0;
}

.arquitectura-page .data-table thead {
    background: #f5f5f5;
}

.arquitectura-page .data-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #555;
    border-bottom: 2px solid #88B04B;
}

.arquitectura-page .data-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

.arquitectura-page .data-table tbody tr:hover {
    background: #f9f9f9;
}

.arquitectura-page .url-cell {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    max-width: 400px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.arquitectura-page .highlight-row {
    background: #f0f7ee;
    font-weight: 600;
}

/* Badges */
.arquitectura-page .status-badge,
.arquitectura-page .priority-badge,
.arquitectura-page .score-badge,
.arquitectura-page .impact-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.arquitectura-page .status-badge.success,
.arquitectura-page .score-badge.score-high {
    background: #e8f5e9;
    color: #2e7d32;
}

.arquitectura-page .status-badge.warning,
.arquitectura-page .score-badge.score-medium {
    background: #fff3e0;
    color: #ef6c00;
}

.arquitectura-page .status-badge.error,
.arquitectura-page .score-badge.score-low {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .priority-badge.priority-a,
.arquitectura-page .impact-badge.impact-alto {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .priority-badge.priority-b,
.arquitectura-page .impact-badge.impact-medio {
    background: #fff3e0;
    color: #ef6c00;
}

.arquitectura-page .priority-badge.priority-c,
.arquitectura-page .impact-badge.impact-bajo {
    background: #e3f2fd;
    color: #1565c0;
}

.arquitectura-page .badge-current {
    background: #88B04B;
    color: white;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 10px;
    margin-left: 8px;
}

/* Metrics Grid */
.arquitectura-page .metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.arquitectura-page .metric-box {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #88B04B;
    padding: 20px;
    border-radius: 4px;
}

.arquitectura-page .metric-header {
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.arquitectura-page .metric-number {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 5px;
}

.arquitectura-page .metric-footer {
    font-size: 12px;
    color: #888;
}

/* Profundidad Bars */
.arquitectura-page .profundidad-bars {
    margin: 20px 0;
}

.arquitectura-page .profundidad-row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.arquitectura-page .prof-label {
    width: 80px;
    font-size: 13px;
    font-weight: 600;
    color: #555;
}

.arquitectura-page .prof-bar-container {
    flex: 1;
    background: #f0f0f0;
    border-radius: 4px;
    overflow: hidden;
    height: 32px;
}

.arquitectura-page .prof-bar {
    background: linear-gradient(90deg, #88B04B 0%, #6d8f3c 100%);
    height: 100%;
    display: flex;
    align-items: center;
    padding: 0 10px;
    transition: width 0.3s ease;
}

.arquitectura-page .prof-bar-text {
    color: white;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

/* Problemas Cards */
.arquitectura-page .problema-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 20px;
    overflow: hidden;
}

.arquitectura-page .problema-card.severity-alta {
    border-left: 4px solid #c62828;
}

.arquitectura-page .problema-card.severity-media {
    border-left: 4px solid #ef6c00;
}

.arquitectura-page .problema-card.severity-baja {
    border-left: 4px solid #1565c0;
}

.arquitectura-page .problema-header {
    background: #f5f5f5;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.arquitectura-page .problema-severidad {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .problema-header h3 {
    margin: 0;
    font-size: 16px;
}

.arquitectura-page .problema-body {
    padding: 20px;
}

.arquitectura-page .problema-body > div {
    margin-bottom: 15px;
}

.arquitectura-page .problema-body strong {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-size: 13px;
}

.arquitectura-page .problema-ejemplos ul {
    margin: 5px 0 0 0;
    padding-left: 20px;
}

.arquitectura-page .problema-ejemplos li {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    margin-bottom: 3px;
}

/* Oportunidades Grid */
.arquitectura-page .oportunidades-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.arquitectura-page .oportunidad-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    overflow: hidden;
}

.arquitectura-page .oportunidad-header {
    background: #f9f9f9;
    padding: 15px 20px;
    border-bottom: 1px solid #e0e0e0;
}

.arquitectura-page .oportunidad-header h3 {
    margin: 0 0 8px 0;
    font-size: 16px;
}

.arquitectura-page .oportunidad-body {
    padding: 15px 20px;
}

.arquitectura-page .oportunidad-footer {
    padding: 12px 20px;
    background: #f5f5f5;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #666;
}

/* Recommendations */
.arquitectura-page .priority-group {
    margin-bottom: 30px;
}

.arquitectura-page .priority-header {
    background: #f5f5f5;
    padding: 12px 20px;
    margin: 0 0 15px 0;
    border-radius: 4px;
    font-size: 16px;
}

.arquitectura-page .priority-header.priority-a {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .priority-header.priority-b {
    background: #fff3e0;
    color: #ef6c00;
}

.arquitectura-page .priority-header.priority-c {
    background: #e3f2fd;
    color: #1565c0;
}

.arquitectura-page .recommendation-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 3px solid #88B04B;
    padding: 15px 20px;
    margin-bottom: 12px;
    border-radius: 4px;
}

.arquitectura-page .rec-title {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 8px;
    color: #1a1a1a;
}

.arquitectura-page .rec-description {
    margin-bottom: 10px;
    color: #555;
    line-height: 1.6;
}

.arquitectura-page .rec-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 12px;
    color: #888;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
}

.arquitectura-page .rec-meta span {
    display: inline-block;
}

/* Insight boxes */
.arquitectura-page .profundidad-insight,
.arquitectura-page .distribucion-insight,
.arquitectura-page .benchmark-insights {
    background: #f9f9f9;
    border-left: 4px solid #88B04B;
    padding: 20px;
    margin: 20px 0;
    border-radius: 4px;
}

.arquitectura-page .recommendations-list ul {
    margin: 0;
    padding-left: 20px;
}

.arquitectura-page .recommendations-list li {
    margin-bottom: 10px;
    line-height: 1.6;
}

/* Sitemap structure */
.arquitectura-page .sitemap-tree {
    background: #fafafa;
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.8;
    overflow-x: auto;
}

/* Page footer */
.arquitectura-page .page-footer {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #888;
}

/* Sección Educativa */
.arquitectura-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.arquitectura-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.arquitectura-page .concepto-icon {
    font-size: 32px;
}

.arquitectura-page .concepto-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    border: none;
    padding: 0;
    color: white;
}

.arquitectura-page .concepto-intro {
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 25px;
}

.arquitectura-page .analogia-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-left: 4px solid #ffd700;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.arquitectura-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 16px;
}

.arquitectura-page .analogia-icon {
    font-size: 24px;
}

.arquitectura-page .analogia-list {
    margin: 15px 0;
    padding-left: 25px;
    list-style: none;
}

.arquitectura-page .analogia-list li {
    margin-bottom: 12px;
    padding-left: 20px;
    position: relative;
}

.arquitectura-page .analogia-list li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #ffd700;
    font-weight: bold;
}

.arquitectura-page .analogia-conclusion {
    background: rgba(255,100,100,0.2);
    padding: 12px 15px;
    border-radius: 6px;
    margin: 15px 0 0 0;
}

.arquitectura-page .impacto-box {
    background: rgba(255,255,255,0.95);
    color: #333;
    padding: 25px;
    border-radius: 8px;
    margin-top: 25px;
}

.arquitectura-page .impacto-box h3 {
    margin: 0 0 20px 0;
    color: #1a1a1a;
    font-size: 18px;
    font-weight: 600;
}

.arquitectura-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.arquitectura-page .impacto-item {
    display: flex;
    gap: 15px;
    align-items: start;
    background: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
}

.arquitectura-page .impacto-icon {
    font-size: 28px;
    flex-shrink: 0;
}

.arquitectura-page .impacto-text {
    line-height: 1.6;
    font-size: 14px;
}

/* Sección Entregables */
.arquitectura-page .entregables-section {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.arquitectura-page .entregables-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.arquitectura-page .entregables-icon {
    font-size: 32px;
}

.arquitectura-page .entregables-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 22px;
    font-weight: 600;
    border: none;
    padding: 0;
}

.arquitectura-page .entregables-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}

.arquitectura-page .entregables-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.arquitectura-page .entregable-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 25px;
    display: flex;
    gap: 20px;
    transition: all 0.3s ease;
}

.arquitectura-page .entregable-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 12px rgba(102,126,234,0.15);
    transform: translateY(-2px);
}

.arquitectura-page .entregable-card.priority-critical {
    border-left: 5px solid #dc3545;
}

.arquitectura-page .entregable-card.priority-high {
    border-left: 5px solid #88B04B;
}

.arquitectura-page .entregable-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.arquitectura-page .entregable-content h3 {
    margin: 0 0 12px 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.arquitectura-page .entregable-desc {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 15px;
}

.arquitectura-page .entregable-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.arquitectura-page .meta-badge {
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.arquitectura-page .meta-badge.priority {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .meta-badge.impact {
    background: #e8f5e9;
    color: #2e7d32;
}

.arquitectura-page .btn-download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #88B04B;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.arquitectura-page .btn-download:hover {
    background: #5568d3;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(102,126,234,0.3);
}

.arquitectura-page .btn-download i {
    font-size: 16px;
}

.arquitectura-page .como-usar-entregables {
    background: #f9f9f9;
    border-left: 4px solid #88B04B;
    padding: 20px;
    border-radius: 8px;
}

.arquitectura-page .como-usar-entregables h3 {
    margin: 0 0 15px 0;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.arquitectura-page .uso-list {
    margin: 0;
    padding-left: 25px;
}

.arquitectura-page .uso-list li {
    margin-bottom: 10px;
    line-height: 1.6;
    font-size: 14px;
}

/* Sección Comparación ANTES vs DESPUÉS */
.arquitectura-page .comparacion-antes-despues {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 12px;
    margin: 40px 0;
}

.arquitectura-page .comparacion-main-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.arquitectura-page .comparacion-main-icon {
    font-size: 32px;
}

.arquitectura-page .comparacion-main-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 24px;
    font-weight: 600;
    border: none;
    padding: 0;
}

.arquitectura-page .comparacion-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 30px;
    line-height: 1.6;
}

.arquitectura-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 25px;
    align-items: start;
}

.arquitectura-page .comparacion-columna {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.arquitectura-page .comparacion-header {
    padding: 20px;
    color: white;
}

.arquitectura-page .comparacion-header.error {
    background: linear-gradient(135deg, #dc3545, #c82333);
}

.arquitectura-page .comparacion-header.success {
    background: linear-gradient(135deg, #88B04B, #6d8f3c);
}

.arquitectura-page .comparacion-header h3 {
    margin: 10px 0 0 0;
    font-size: 18px;
    font-weight: 600;
    color: white;
}

.arquitectura-page .badge-estado {
    display: inline-block;
    padding: 5px 12px;
    background: rgba(255,255,255,0.25);
    border-radius: 20px;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.arquitectura-page .comparacion-content {
    padding: 25px;
}

/* Diagrama de Arquitectura Visual */
.arquitectura-page .arquitectura-visual {
    background: #fafafa;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
    min-height: 280px;
}

.arquitectura-page .arq-nivel {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
}

.arquitectura-page .arq-nodo {
    padding: 10px 15px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    border: 2px solid;
    transition: all 0.3s ease;
}

.arquitectura-page .arq-nodo.home {
    background: #88B04B;
    color: white;
    border-color: #5568d3;
    font-size: 14px;
    padding: 12px 20px;
}

.arquitectura-page .arq-nodo.categoria {
    background: #f8f9fa;
    color: #333;
    border-color: #dee2e6;
}

.arquitectura-page .arq-nodo.categoria.mejorado {
    background: #d4edda;
    border-color: #88B04B;
    color: #155724;
}

.arquitectura-page .arq-nodo.subcategoria {
    background: #fff;
    color: #666;
    border-color: #e0e0e0;
    font-size: 11px;
}

.arquitectura-page .arq-nodo.subcategoria.mejorado {
    background: #d1ecf1;
    border-color: #17a2b8;
    color: #0c5460;
}

.arquitectura-page .arq-nodo.pagina {
    background: #fff;
    color: #888;
    border-color: #ddd;
    font-size: 10px;
}

.arquitectura-page .arq-nodo.pagina.mejorado {
    background: #d4edda;
    border-color: #88B04B;
    color: #155724;
}

.arquitectura-page .arq-nodo.profunda {
    background: #f8d7da;
    border-color: #dc3545;
    color: #721c24;
}

.arquitectura-page .arq-nodo.huerfana {
    background: #f8d7da;
    border-color: #dc3545;
    color: #721c24;
    animation: float 2s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.arquitectura-page .arq-huerfanas {
    margin-top: 20px;
    text-align: center;
}

.arquitectura-page .arq-nota-mejora {
    text-align: center;
    margin-top: 20px;
    padding: 12px;
    background: #d4edda;
    border-radius: 6px;
    color: #155724;
    font-weight: 600;
    font-size: 13px;
}

/* Listas de Problemas y Mejoras */
.arquitectura-page .problemas-lista h4,
.arquitectura-page .mejoras-lista h4 {
    margin: 0 0 15px 0;
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
}

.arquitectura-page .problemas-lista ul,
.arquitectura-page .mejoras-lista ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.arquitectura-page .problema-item,
.arquitectura-page .mejora-item {
    display: flex;
    gap: 12px;
    align-items: start;
    margin-bottom: 15px;
    padding: 12px;
    background: #f9f9f9;
    border-radius: 6px;
}

.arquitectura-page .problema-item {
    border-left: 3px solid #dc3545;
}

.arquitectura-page .mejora-item {
    border-left: 3px solid #88B04B;
}

.arquitectura-page .icon-error,
.arquitectura-page .icon-success {
    font-size: 20px;
    flex-shrink: 0;
    line-height: 1;
}

.arquitectura-page .problema-texto,
.arquitectura-page .mejora-texto {
    flex: 1;
}

.arquitectura-page .problema-texto strong,
.arquitectura-page .mejora-texto strong {
    display: block;
    margin-bottom: 4px;
    color: #1a1a1a;
    font-size: 14px;
}

.arquitectura-page .problema-detalle,
.arquitectura-page .mejora-detalle {
    display: block;
    font-size: 12px;
    color: #666;
    font-style: italic;
}

/* Flecha de Transformación */
.arquitectura-page .transformacion-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.arquitectura-page .arrow-icon {
    font-size: 48px;
    margin-bottom: 10px;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.arquitectura-page .arrow-text {
    text-align: center;
    font-size: 13px;
    font-weight: 600;
    color: #88B04B;
    line-height: 1.4;
    margin: 0;
}

/* Responsive para comparación */
@media (max-width: 1200px) {
    .arquitectura-page .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .arquitectura-page .transformacion-arrow {
        transform: rotate(90deg);
        padding: 20px 0;
    }

    .arquitectura-page .arrow-text br {
        display: none;
    }
}

/* Badges de Sección ANTES/DESPUÉS */
.arquitectura-page .section-badge-container {
    margin-bottom: 15px;
}

.arquitectura-page .section-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.arquitectura-page .section-badge.badge-antes {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    box-shadow: 0 2px 4px rgba(220,53,69,0.3);
}

.arquitectura-page .section-badge.badge-despues {
    background: linear-gradient(135deg, #88B04B, #6d8f3c);
    color: white;
    box-shadow: 0 2px 4px rgba(40,167,69,0.3);
}

/* Sección KPIs Esperados */
.arquitectura-page .kpis-esperados-section {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.arquitectura-page .kpis-esperados-section h2 {
    color: #1a1a1a;
    font-size: 22px;
    font-weight: 600;
    margin: 10px 0 15px 0;
    border: none;
    padding: 0;
}

.arquitectura-page .kpis-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}

.arquitectura-page .tabla-kpis-container {
    overflow-x: auto;
    margin: 25px 0;
}

.arquitectura-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
}

.arquitectura-page .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.arquitectura-page .tabla-kpis th {
    padding: 15px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.arquitectura-page .tabla-kpis .col-subtitle {
    display: block;
    font-size: 10px;
    font-weight: normal;
    text-transform: none;
    margin-top: 3px;
    opacity: 0.9;
}

.arquitectura-page .tabla-kpis .col-antes {
    background: rgba(220,53,69,0.2);
}

.arquitectura-page .tabla-kpis .col-despues {
    background: rgba(40,167,69,0.2);
}

.arquitectura-page .tabla-kpis .col-mejora {
    background: rgba(255,193,7,0.15);
    text-align: center;
}

.arquitectura-page .tabla-kpis tbody tr {
    border-bottom: 1px solid #e0e0e0;
    transition: background 0.2s ease;
}

.arquitectura-page .tabla-kpis tbody tr:hover {
    background: #f9f9f9;
}

.arquitectura-page .tabla-kpis tbody tr.highlight-row {
    background: #f0f7e6;
    border-left: 4px solid #88B04B;
}

.arquitectura-page .tabla-kpis tbody tr.highlight-row:hover {
    background: #fff5d6;
}

.arquitectura-page .tabla-kpis td {
    padding: 15px 12px;
    vertical-align: top;
}

.arquitectura-page .metrica-nombre {
    min-width: 180px;
}

.arquitectura-page .metrica-nombre strong {
    display: block;
    color: #1a1a1a;
    font-size: 14px;
    margin-bottom: 4px;
}

.arquitectura-page .metrica-descripcion {
    display: block;
    font-size: 12px;
    color: #888;
    font-style: italic;
}

.arquitectura-page .valor-antes,
.arquitectura-page .valor-despues {
    text-align: center;
    min-width: 120px;
}

.arquitectura-page .valor-numero {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2px;
}

.arquitectura-page .valor-numero.success {
    color: #88B04B;
}

.arquitectura-page .valor-unidad {
    display: block;
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.arquitectura-page .valor-mejora {
    text-align: center;
    min-width: 130px;
}

.arquitectura-page .mejora-badge {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 6px;
    text-align: center;
}

.arquitectura-page .mejora-badge.success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 2px solid #88B04B;
}

.arquitectura-page .mejora-badge.large {
    padding: 10px 15px;
}

.arquitectura-page .mejora-porcentaje {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #88B04B;
    margin-bottom: 2px;
}

.arquitectura-page .mejora-badge.large .mejora-porcentaje {
    font-size: 24px;
}

.arquitectura-page .mejora-texto {
    display: block;
    font-size: 11px;
    color: #155724;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.arquitectura-page .impacto-texto {
    font-size: 13px;
    color: #555;
    line-height: 1.5;
}

.arquitectura-page .kpis-nota-importante {
    background: #e7f3ff;
    border-left: 4px solid #2196f3;
    padding: 20px;
    border-radius: 8px;
    margin-top: 25px;
}

.arquitectura-page .nota-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.arquitectura-page .nota-icon {
    font-size: 24px;
}

.arquitectura-page .nota-header strong {
    font-size: 15px;
    color: #1a1a1a;
}

.arquitectura-page .kpis-nota-importante p {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: #555;
}

@media print {
    .arquitectura-page {
        page-break-before: always;
    }

    .arquitectura-page .problema-card,
    .arquitectura-page .oportunidad-card,
    .arquitectura-page .recommendation-item {
        page-break-inside: avoid;
    }

    .arquitectura-page .concepto-educativo,
    .arquitectura-page .entregables-section {
        page-break-inside: avoid;
    }
}
</style>
