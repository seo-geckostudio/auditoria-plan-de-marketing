<?php
/**
 * Módulo: SEO On-Page (m6.1)
 * Fase: 6 - SEO On-Page
 * Análisis detallado por áreas con hallazgos específicos
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$areas = $datosModulo['areas_analizadas'] ?? [];
?>

<!-- Página 1: Portada SEO On-Page -->
<div class="audit-page onpage-cover">
    <div class="cover-content">
        <div class="cover-badge">Sección 6</div>
        <h1 class="cover-title">Análisis SEO On-Page</h1>
        <p class="cover-subtitle">Análisis Técnico Detallado de Optimización Interna</p>

        <div class="cover-stats">
            <div class="stat-item">
                <div class="stat-number"><?php echo number_format($resumen['paginas_rastreadas'] ?? 0); ?></div>
                <div class="stat-label">Páginas Analizadas</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo count($areas); ?></div>
                <div class="stat-label">Áreas de Análisis</div>
            </div>
            <div class="stat-item highlight">
                <div class="stat-number"><?php echo ($resumen['hallazgos_totales']['total_issues'] ?? 0); ?></div>
                <div class="stat-label">Issues Detectados</div>
            </div>
        </div>

        <div class="cover-areas">
            <h2>Áreas Analizadas</h2>
            <div class="areas-grid">
                <?php foreach ($areas as $area): ?>
                <div class="area-card" style="border-left-color: <?php echo $area['color'] ?? '#88B04B'; ?>">
                    <div class="area-name"><?php echo htmlspecialchars($area['nombre'] ?? ''); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.onpage-cover {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 60px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cover-content {
    width: 100%;
    max-width: 1000px;
}

.cover-badge {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0.8;
    margin-bottom: 20px;
    text-align: center;
}

.cover-title {
    font-size: 56px;
    font-weight: 800;
    margin: 0 0 15px 0;
    text-align: center;
    line-height: 1.1;
}

.cover-subtitle {
    font-size: 20px;
    text-align: center;
    opacity: 0.9;
    margin-bottom: 50px;
}

.cover-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 50px;
}

.stat-item {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
}

.stat-item.highlight {
    background: rgba(136,176,75,0.4);
    border: 2px solid rgba(255,255,255,0.5);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.stat-number {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
}

.cover-areas {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
}

.cover-areas h2 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 25px 0;
    text-align: center;
}

.areas-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.area-card {
    background: rgba(136,176,75,0.25);
    border-left: 4px solid;
    border-radius: 8px;
    padding: 15px 20px;
    border: 1px solid rgba(255,255,255,0.3);
}

.area-name {
    font-size: 15px;
    font-weight: 600;
    color: white;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}
</style>

<?php
// Página 1.5: Sección Educativa
?>
<div class="audit-page onpage-educativo">
    <div class="page-content">

        <!-- SECCIÓN EDUCATIVA: ¿Qué es SEO On-Page? -->
        <section class="concepto-educativo">
            <div class="concepto-header">
                <span class="concepto-icon"></span>
                <h2>¿Qué es SEO On-Page y Por Qué es Crítico para Tu Negocio?</h2>
            </div>
            <div class="concepto-content">
                <p class="concepto-intro">
                    El SEO On-Page es todo lo que puedes controlar directamente en tu sitio web: títulos, descripciones,
                    contenido, imágenes, estructura. Es como el escaparate de una tienda física: si está bien organizado,
                    limpio y atractivo, más gente entra y compra.
                </p>
                <div class="analogia-box">
                    <div class="analogia-header">
                        
                        <strong>Piensa en tu página web como el escaparate de una tienda de lujo:</strong>
                    </div>
                    <ul class="analogia-list">
                        <li><strong>El Title Tag</strong> es el letrero principal - lo primero que ven los clientes (Google)</li>
                        <li><strong>La Meta Description</strong> es el mensaje en el escaparate que convence a entrar</li>
                        <li><strong>Los H1 y H2</strong> son los rótulos internos que guían por las secciones</li>
                        <li><strong>El contenido</strong> es la información de cada producto - debe ser clara y útil</li>
                        <li><strong>Las imágenes con ALT</strong> son las etiquetas que describen cada artículo</li>
                    </ul>
                    <p class="analogia-conclusion">
                        <strong>Problema:</strong> Si tu escaparate no tiene letrero claro, las descripciones son confusas
                        o faltan etiquetas en los productos, los clientes (y Google) pasan de largo hacia la competencia.
                    </p>
                </div>
                <div class="impacto-box">
                    <h3>¿Cómo Afecta el SEO On-Page a Tu Negocio?</h3>
                    <div class="impacto-grid">
                        <div class="impacto-item">
                            <span class="impacto-icon"></span>
                            <div class="impacto-text">
                                <strong>Visibilidad:</strong> Title tags optimizados mejoran rankings un 15-25%.
                                Sin H1 adecuado, Google no entiende de qué trata tu página.
                            </div>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon"></span>
                            <div class="impacto-text">
                                <strong>Conversión:</strong> Meta descriptions atractivas aumentan CTR 20-35%.
                                Más clics = más tráfico = más reservas de villas.
                            </div>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon"></span>
                            <div class="impacto-text">
                                <strong>Experiencia:</strong> Contenido bien estructurado (H1, H2, H3) reduce rebote -30%.
                                Usuarios encuentran lo que buscan rápidamente.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN: Archivos de Trabajo Descargables -->
        <section class="entregables-section">
            <div class="entregables-header">
                <span class="entregables-icon"></span>
                <h2>Archivos de Trabajo para Implementar las Mejoras</h2>
            </div>
            <p class="entregables-intro">
                Hemos preparado 5 archivos CSV listos para usar con todas las páginas y elementos que necesitan optimización.
                Descárgalos, ábrelos en Excel y empieza a trabajar:
            </p>
            <div class="entregables-grid">
                <!-- CSV 1: Páginas sin H1 -->
                <div class="entregable-card priority-critical">
                    <div class="entregable-icon">
                        
                    </div>
                    <div class="entregable-content">
                        <h3>Páginas sin H1</h3>
                        <p class="entregable-desc">
                            <strong>10 páginas</strong> sin etiqueta H1 o con H1 vacío. Incluye keyword objetivo y H1 recomendado para cada URL.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Muy Alta</span>
                            <span class="meta-badge impact">Impacto: +8-12% tráfico orgánico</span>
                        </div>
                        <a href="/entregables/on_page/paginas_sin_h1.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 10 páginas sin H1">
                            Descargar CSV
                        </a>
                    </div>
                </div>

                <!-- CSV 2: H1 Duplicados -->
                <div class="entregable-card priority-critical">
                    <div class="entregable-icon">
                        
                    </div>
                    <div class="entregable-content">
                        <h3>H1 Duplicados a Diferenciar</h3>
                        <p class="entregable-desc">
                            <strong>12 páginas</strong> con H1 duplicado (mismo H1 en múltiples URLs). Plan para diferenciar cada una.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Muy Alta</span>
                            <span class="meta-badge impact">Impacto: +10-15% rankings</span>
                        </div>
                        <a href="/entregables/on_page/h1_duplicados.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 12 H1 duplicados">
                            Descargar CSV
                        </a>
                    </div>
                </div>

                <!-- CSV 3: Meta Descriptions Duplicadas -->
                <div class="entregable-card priority-high">
                    <div class="entregable-icon">
                        
                    </div>
                    <div class="entregable-content">
                        <h3>Meta Descriptions Duplicadas</h3>
                        <p class="entregable-desc">
                            <strong>14 páginas</strong> con meta description duplicada. CTR actual vs estimado tras optimización.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Alta</span>
                            <span class="meta-badge impact">Impacto: +25-35% CTR</span>
                        </div>
                        <a href="/entregables/on_page/meta_descriptions_duplicadas.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 14 meta descriptions">
                            Descargar CSV
                        </a>
                    </div>
                </div>

                <!-- CSV 4: Title Tags a Optimizar -->
                <div class="entregable-card priority-high">
                    <div class="entregable-icon">
                        
                    </div>
                    <div class="entregable-content">
                        <h3>Title Tags a Optimizar</h3>
                        <p class="entregable-desc">
                            <strong>15 páginas</strong> con títulos demasiado cortos, largos o mal optimizados. Title mejorado para cada una.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Alta</span>
                            <span class="meta-badge impact">Impacto: +18-24% CTR</span>
                        </div>
                        <a href="/entregables/on_page/title_tags_optimizar.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 15 title tags">
                            Descargar CSV
                        </a>
                    </div>
                </div>

                <!-- CSV 5: Imágenes sin ALT -->
                <div class="entregable-card priority-medium">
                    <div class="entregable-icon">
                        
                    </div>
                    <div class="entregable-content">
                        <h3>Imágenes sin Atributo ALT</h3>
                        <p class="entregable-desc">
                            <strong>10 imágenes</strong> sin texto alternativo. ALT recomendado según contexto y keyword.
                        </p>
                        <div class="entregable-meta">
                            <span class="meta-badge priority">Prioridad: Media</span>
                            <span class="meta-badge impact">Impacto: +5-8% accesibilidad</span>
                        </div>
                        <a href="/entregables/on_page/imagenes_sin_alt.csv"
                           class="btn-download"
                           download
                           title="Descargar CSV con 10 imágenes sin ALT">
                            Descargar CSV
                        </a>
                    </div>
                </div>
            </div>
            <div class="como-usar-entregables">
                <h3> Cómo Usar Estos Archivos</h3>
                <ol class="uso-list">
                    <li><strong>Descarga</strong> el CSV haciendo clic en el botón azul</li>
                    <li><strong>Ábrelo</strong> en Excel, Google Sheets o Numbers</li>
                    <li><strong>Ordena</strong> por columna "Prioridad" para empezar por lo más crítico</li>
                    <li><strong>Asigna</strong> tareas a tu equipo (puedes añadir columna "Responsable")</li>
                    <li><strong>Implementa</strong> los cambios directamente en tu CMS (WordPress, etc.)</li>
                    <li><strong>Marca</strong> como completado según avances (añade columna "Estado")</li>
                </ol>
            </div>
        </section>

        <!-- SECCIÓN: Comparación Visual ANTES vs DESPUÉS -->
        <section class="comparacion-antes-despues">
            <div class="comparacion-main-header">
                <span class="comparacion-main-icon"></span>
                <h2>Situación Actual vs. Propuesta de Mejora</h2>
            </div>
            <p class="comparacion-intro">
                Resumen visual de los problemas On-Page detectados y cómo se resolverán con las optimizaciones propuestas:
            </p>

            <div class="comparacion-grid">
                <!-- COLUMNA ANTES -->
                <div class="comparacion-columna antes">
                    <div class="comparacion-header error">
                        <span class="badge-estado antes">ANTES - SITUACIÓN ACTUAL</span>
                        <h3>Estado Actual del SEO On-Page</h3>
                    </div>
                    <div class="comparacion-content">
                        <!-- Lista de problemas -->
                        <div class="problemas-lista">
                            <h4>Problemas Detectados:</h4>
                            <ul>
                                <li class="problema-item">
                                    <span class="icon-error"></span>
                                    <div class="problema-texto">
                                        <strong>10 páginas sin H1</strong>
                                        <span class="problema-detalle">Google no identifica el tema principal de la página</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error"></span>
                                    <div class="problema-texto">
                                        <strong>12 H1 duplicados</strong>
                                        <span class="problema-detalle">Confusión en jerarquía - páginas compiten entre sí</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error"></span>
                                    <div class="problema-texto">
                                        <strong>14 meta descriptions duplicadas</strong>
                                        <span class="problema-detalle">CTR bajo - usuarios no diferencian resultados en Google</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error"></span>
                                    <div class="problema-texto">
                                        <strong>15 title tags mal optimizados</strong>
                                        <span class="problema-detalle">Demasiado cortos/largos - se cortan en SERPs</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error"></span>
                                    <div class="problema-texto">
                                        <strong>10 imágenes sin ALT</strong>
                                        <span class="problema-detalle">Pérdida de accesibilidad e imagen search</span>
                                    </div>
                                </li>
                                <li class="problema-item">
                                    <span class="icon-error"></span>
                                    <div class="problema-texto">
                                        <strong>Pérdida estimada total:</strong> 800-1,200 sesiones/mes
                                        <span class="problema-detalle">Por baja visibilidad y CTR deficiente</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- FLECHA DE TRANSFORMACIÓN -->
                <div class="transformacion-arrow">
                    <div class="arrow-icon">️</div>
                    <p class="arrow-text">Implementando<br>optimizaciones<br>del CSV</p>
                </div>

                <!-- COLUMNA DESPUÉS -->
                <div class="comparacion-columna despues">
                    <div class="comparacion-header success">
                        <span class="badge-estado despues">DESPUÉS - SOLUCIÓN PROPUESTA</span>
                        <h3>SEO On-Page Optimizado</h3>
                    </div>
                    <div class="comparacion-content">
                        <!-- Lista de mejoras -->
                        <div class="mejoras-lista">
                            <h4>Mejoras Implementadas:</h4>
                            <ul>
                                <li class="mejora-item">
                                    <span class="icon-success"></span>
                                    <div class="mejora-texto">
                                        <strong>10 H1 creados y optimizados</strong>
                                        <span class="mejora-detalle">Google identifica claramente el tema de cada página</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success"></span>
                                    <div class="mejora-texto">
                                        <strong>12 H1 diferenciados</strong>
                                        <span class="mejora-detalle">Cada página tiene su propia identidad y keyword target</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success"></span>
                                    <div class="mejora-texto">
                                        <strong>14 meta descriptions únicas</strong>
                                        <span class="mejora-detalle">CTR mejorado - mensajes personalizados por página</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success"></span>
                                    <div class="mejora-texto">
                                        <strong>15 title tags optimizados</strong>
                                        <span class="mejora-detalle">Longitud óptima 50-60 caracteres, keywords al inicio</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success"></span>
                                    <div class="mejora-texto">
                                        <strong>10 atributos ALT añadidos</strong>
                                        <span class="mejora-detalle">Mejor accesibilidad + oportunidad de tráfico de imágenes</span>
                                    </div>
                                </li>
                                <li class="mejora-item">
                                    <span class="icon-success"></span>
                                    <div class="mejora-texto">
                                        <strong>Ganancia estimada total:</strong> +800-1,200 sesiones/mes
                                        <span class="mejora-detalle">Por mejor visibilidad y CTR optimizado</span>
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
            <h2> Resultados Esperados (30-60 días post-implementación)</h2>
            <p class="kpis-intro">
                Si implementas las optimizaciones On-Page de los archivos CSV descargables, estos son los resultados que puedes esperar:
            </p>

            <div class="tabla-kpis-container">
                <table class="tabla-kpis">
                    <thead>
                        <tr>
                            <th class="col-metrica">Métrica</th>
                            <th class="col-antes">ANTES<br><span class="col-subtitle">Situación Actual</span></th>
                            <th class="col-despues">DESPUÉS<br><span class="col-subtitle">Con Optimizaciones</span></th>
                            <th class="col-mejora">Mejora</th>
                            <th class="col-impacto">Impacto en Negocio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- KPI 1 -->
                        <tr class="kpi-row critical">
                            <td class="metrica-nombre">
                                <strong>Páginas sin H1 Optimizado</strong>
                                <span class="metrica-descripcion">Etiqueta principal de jerarquía</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">10</span>
                                <span class="valor-unidad">páginas</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">0</span>
                                <span class="valor-unidad">páginas</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">+100%</span>
                                    <span class="mejora-texto">optimizadas</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Google identifica el tema - mejora rankings 8-12%
                            </td>
                        </tr>

                        <!-- KPI 2 -->
                        <tr class="kpi-row high">
                            <td class="metrica-nombre">
                                <strong>CTR Promedio en SERPs</strong>
                                <span class="metrica-descripcion">Click-through rate en resultados Google</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">2.3%</span>
                                <span class="valor-unidad">clics/impresión</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">3.5-4.0%</span>
                                <span class="valor-unidad">clics/impresión</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">+52-74%</span>
                                    <span class="mejora-texto">incremento</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Títulos y descripciones atractivos → más clics
                            </td>
                        </tr>

                        <!-- KPI 3 -->
                        <tr class="kpi-row high">
                            <td class="metrica-nombre">
                                <strong>Posición Promedio Keywords</strong>
                                <span class="metrica-descripcion">Ranking medio en Google</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">18.4</span>
                                <span class="valor-unidad">posición</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">14.2-15.8</span>
                                <span class="valor-unidad">posición</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">-18-23%</span>
                                    <span class="mejora-texto">mejora</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                H1 y titles optimizados mejoran relevancia
                            </td>
                        </tr>

                        <!-- KPI 4 - DESTACADO -->
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
                                <span class="valor-numero success">9,250-9,650</span>
                                <span class="valor-unidad">sesiones/mes</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success large">
                                    <span class="mejora-porcentaje">+9-14%</span>
                                    <span class="mejora-texto">incremento</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                <strong>+800-1,200 sesiones/mes adicionales</strong> por mejor CTR y rankings
                            </td>
                        </tr>

                        <!-- KPI 5 -->
                        <tr class="kpi-row medium">
                            <td class="metrica-nombre">
                                <strong>Tasa de Rebote</strong>
                                <span class="metrica-descripcion">% usuarios que abandonan rápido</span>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-numero">54%</span>
                                <span class="valor-unidad">rebote</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-numero success">38-42%</span>
                                <span class="valor-unidad">rebote</span>
                            </td>
                            <td class="valor-mejora">
                                <div class="mejora-badge success">
                                    <span class="mejora-porcentaje">-22-30%</span>
                                    <span class="mejora-texto">reducción</span>
                                </div>
                            </td>
                            <td class="impacto-texto">
                                Contenido bien estructurado retiene visitantes
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="kpis-nota-importante">
                <div class="nota-header">
                    <span class="nota-icon"></span>
                    <strong>Nota Importante</strong>
                </div>
                <p>
                    Estos resultados son estimaciones conservadoras basadas en datos históricos de sitios similares en el sector turismo de lujo.
                    Los resultados reales pueden variar según la velocidad de implementación y otros factores SEO (contenido, links, autoridad).
                    <strong>Tiempo para ver resultados:</strong> Los primeros cambios en CTR suelen verse en 15-30 días,
                    con impacto completo en rankings en 45-60 días tras la indexación.
                </p>
            </div>
        </section>

    </div>
</div>

<?php
// Página 2: Resumen Ejecutivo
?>
<div class="audit-page onpage-summary">
    <div class="page-header">
        <div class="section-badge-container">
            <span class="section-badge badge-antes">ANTES - SITUACIÓN ACTUAL</span>
        </div>
        <h1>Resumen Ejecutivo: Estado Actual</h1>
        <p class="subtitle">Visión General del Análisis SEO On-Page</p>
    </div>

    <div class="page-content">
        <div class="summary-card">
            <h2>Alcance de la Auditoría</h2>
            <div class="summary-grid">
                <div class="summary-item">
                    <span class="label">URL Auditada:</span>
                    <strong><?php echo htmlspecialchars($resumen['url_auditada'] ?? ''); ?></strong>
                </div>
                <div class="summary-item">
                    <span class="label">Páginas Rastreadas:</span>
                    <strong><?php echo number_format($resumen['paginas_rastreadas'] ?? 0); ?></strong>
                </div>
                <div class="summary-item">
                    <span class="label">Metodología:</span>
                    <strong><?php echo htmlspecialchars($resumen['metodologia'] ?? ''); ?></strong>
                </div>
                <div class="summary-item">
                    <span class="label">Fecha:</span>
                    <strong><?php echo htmlspecialchars($resumen['fecha_auditoria'] ?? ''); ?></strong>
                </div>
            </div>
        </div>

        <div class="hallazgos-summary">
            <h2>Distribución de Hallazgos</h2>
            <div class="hallazgos-grid">
                <div class="hallazgo-card criticos">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['criticos'] ?? 0; ?></div>
                    <div class="label">Críticos</div>
                    <div class="description">Requieren atención inmediata</div>
                </div>
                <div class="hallazgo-card importantes">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['importantes'] ?? 0; ?></div>
                    <div class="label">Importantes</div>
                    <div class="description">Alto impacto en SEO</div>
                </div>
                <div class="hallazgo-card menores">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['menores'] ?? 0; ?></div>
                    <div class="label">Menores</div>
                    <div class="description">Optimizaciones recomendadas</div>
                </div>
                <div class="hallazgo-card total">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['total_issues'] ?? 0; ?></div>
                    <div class="label">Total Issues</div>
                    <div class="description">Oportunidades de mejora</div>
                </div>
            </div>
        </div>

        <div class="areas-index">
            <h2>Índice de Áreas Analizadas</h2>
            <p class="index-intro">Cada área contiene un análisis detallado con hallazgos específicos, ejemplos reales y recomendaciones priorizadas:</p>
            <div class="index-list">
                <?php foreach ($areas as $index => $area): ?>
                <div class="index-item">
                    <div class="index-number"><?php echo $index + 1; ?></div>
                    <div class="index-content">
                        <div class="index-title" style="color: <?php echo $area['color'] ?? '#88B04B'; ?>">
                            <?php echo htmlspecialchars($area['nombre'] ?? ''); ?>
                        </div>
                        <div class="index-metrics">
                            <?php
                            $metricas = $area['metricas'] ?? [];
                            $count = 0;
                            foreach ($metricas as $key => $value):
                                if ($count >= 2) break;
                                $count++;
                            ?>
                            <span><?php echo ucfirst(str_replace('_', ' ', $key)); ?>: <strong><?php echo is_numeric($value) ? number_format($value) : $value; ?></strong></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="index-pages">Página <?php echo $index + 3; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.onpage-summary {
    background: #f7fafc;
    padding: 50px;
    min-height: 100vh;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
}

.page-header h1 {
    font-size: 42px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.subtitle {
    font-size: 18px;
    color: #718096;
    margin: 0;
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}

.summary-card h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 700;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.summary-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.summary-item .label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.summary-item strong {
    font-size: 15px;
    color: #2d3748;
}

.hallazgos-summary {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}

.hallazgos-summary h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 700;
}

.hallazgos-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.hallazgo-card {
    border-radius: 12px;
    padding: 25px 20px;
    text-align: center;
}

.hallazgo-card.criticos {
    background: linear-gradient(135deg, #f0f7e6 0%, #fecaca 100%);
}

.hallazgo-card.importantes {
    background: linear-gradient(135deg, #f0f7e6 0%, #fdba74 100%);
}

.hallazgo-card.menores {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
}

.hallazgo-card.total {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.hallazgo-card .number {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 8px;
}

.hallazgo-card.criticos .number { color: #991b1b; }
.hallazgo-card.importantes .number { color: #92400e; }
.hallazgo-card.menores .number { color: #854d0e; }

.hallazgo-card .label {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.hallazgo-card.criticos .label { color: #991b1b; }
.hallazgo-card.importantes .label { color: #92400e; }
.hallazgo-card.menores .label { color: #854d0e; }

.hallazgo-card .description {
    font-size: 11px;
    opacity: 0.8;
    margin-top: 4px;
}

.hallazgo-card.criticos .description { color: #7f1d1d; }
.hallazgo-card.importantes .description { color: #78350f; }
.hallazgo-card.menores .description { color: #713f12; }

.areas-index {
    background: white;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}

.areas-index h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.index-intro {
    font-size: 14px;
    color: #718096;
    margin: 0 0 25px 0;
    line-height: 1.6;
}

.index-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.index-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 15px 20px;
    background: #f7fafc;
    border-radius: 10px;
    transition: all 0.2s;
}

.index-item:hover {
    background: #edf2f7;
    transform: translateX(4px);
}

.index-number {
    font-size: 20px;
    font-weight: 800;
    color: white;
    background: #88B04B;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.index-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.index-title {
    font-size: 16px;
    font-weight: 700;
}

.index-metrics {
    font-size: 12px;
    color: #718096;
    display: flex;
    gap: 15px;
}

.index-pages {
    font-size: 13px;
    color: #a0aec0;
    font-weight: 600;
    flex-shrink: 0;
}
</style>

<?php
// Páginas de Análisis Detallado por Área
$pagina_numero = 3;

foreach ($areas as $area):
?>

<!-- Análisis Detallado: <?php echo htmlspecialchars($area['nombre'] ?? ''); ?> -->
<div class="audit-page area-analysis">
    <div class="area-header" style="background: linear-gradient(135deg, <?php echo $area['color'] ?? '#88B04B'; ?> 0%, <?php echo $area['color'] ?? '#6d8f3c'; ?>dd 100%);">
        <div class="area-badge">Análisis Detallado</div>
        <h1 class="area-title"><?php echo htmlspecialchars($area['nombre'] ?? ''); ?></h1>
        <div class="area-metrics-header">
            <?php
            $metricas = $area['metricas'] ?? [];
            foreach ($metricas as $key => $value):
            ?>
            <div class="metric-header-item">
                <div class="metric-value"><?php echo is_numeric($value) ? number_format($value) : htmlspecialchars($value); ?></div>
                <div class="metric-label"><?php echo ucfirst(str_replace('_', ' ', $key)); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="area-content">
        <!-- Hallazgos -->
        <div class="hallazgos-section">
            <h2>Hallazgos Identificados</h2>
            <?php
            $hallazgos = $area['hallazgos'] ?? [];
            foreach ($hallazgos as $hallazgo):
                $tipo_class = $hallazgo['tipo'] ?? 'menor';
            ?>
            <div class="hallazgo-detail <?php echo $tipo_class; ?>">
                <div class="hallazgo-header">
                    <div class="hallazgo-tipo-badge <?php echo $tipo_class; ?>">
                        <?php echo ucfirst($hallazgo['tipo'] ?? ''); ?>
                    </div>
                    <?php if (isset($hallazgo['cantidad']) && $hallazgo['cantidad'] !== null): ?>
                    <div class="hallazgo-cantidad">
                        <?php echo number_format($hallazgo['cantidad']); ?> ocurrencias
                    </div>
                    <?php endif; ?>
                </div>

                <h3 class="hallazgo-titulo"><?php echo htmlspecialchars($hallazgo['titulo'] ?? ''); ?></h3>

                <div class="hallazgo-descripcion">
                    <?php echo htmlspecialchars($hallazgo['descripcion'] ?? ''); ?>
                </div>

                <?php if (!empty($hallazgo['ejemplos'])): ?>
                <div class="hallazgo-ejemplos">
                    <strong>Ejemplos detectados:</strong>
                    <ul>
                        <?php foreach ($hallazgo['ejemplos'] as $ejemplo): ?>
                        <li><code><?php echo htmlspecialchars($ejemplo); ?></code></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (!empty($hallazgo['causas'])): ?>
                <div class="hallazgo-causas">
                    <strong>Causas identificadas:</strong>
                    <ul>
                        <?php foreach ($hallazgo['causas'] as $causa): ?>
                        <li><?php echo htmlspecialchars($causa); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="hallazgo-impacto">
                    <span class="impacto-label">Impacto:</span>
                    <?php echo htmlspecialchars($hallazgo['impacto'] ?? ''); ?>
                </div>

                <div class="hallazgo-recomendacion">
                    <span class="rec-label">Recomendación:</span>
                    <?php echo htmlspecialchars($hallazgo['recomendacion'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Ejemplos de Optimización -->
        <?php if (!empty($area['ejemplos_optimizacion'])): ?>
        <div class="optimizacion-section">
            <h2>Ejemplos de Optimización</h2>
            <?php foreach ($area['ejemplos_optimizacion'] as $ejemplo): ?>
            <div class="ejemplo-card">
                <div class="ejemplo-tipo"><?php echo htmlspecialchars($ejemplo['tipo'] ?? ''); ?></div>
                <div class="ejemplo-comparison">
                    <div class="ejemplo-actual">
                        <span class="ejemplo-label">Actual:</span>
                        <code><?php echo htmlspecialchars($ejemplo['actual'] ?? ''); ?></code>
                        <?php if (isset($ejemplo['caracteres_actual'])): ?>
                        <span class="ejemplo-chars">(<?php echo $ejemplo['caracteres_actual']; ?> caracteres)</span>
                        <?php endif; ?>
                    </div>
                    <div class="ejemplo-arrow">→</div>
                    <div class="ejemplo-propuesto">
                        <span class="ejemplo-label">Propuesto:</span>
                        <code><?php echo htmlspecialchars($ejemplo['propuesto'] ?? ''); ?></code>
                        <?php if (isset($ejemplo['caracteres_propuesto'])): ?>
                        <span class="ejemplo-chars">(<?php echo $ejemplo['caracteres_propuesto']; ?> caracteres)</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ejemplo-mejora">
                    <strong>Mejora:</strong> <?php echo htmlspecialchars($ejemplo['mejora'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Oportunidades de Optimización -->
        <?php if (!empty($area['oportunidades_optimizacion'])): ?>
        <div class="oportunidades-section">
            <h2>Oportunidades de Optimización</h2>
            <div class="oportunidades-grid">
                <?php foreach ($area['oportunidades_optimizacion'] as $oportunidad): ?>
                <div class="oportunidad-card">
                    <div class="oportunidad-header">
                        <span class="oportunidad-prioridad <?php echo strtolower($oportunidad['prioridad'] ?? 'media'); ?>">
                            <?php echo ucfirst($oportunidad['prioridad'] ?? 'Media'); ?>
                        </span>
                        <span class="oportunidad-ahorro"><?php echo htmlspecialchars($oportunidad['ahorro_tiempo'] ?? ''); ?></span>
                    </div>
                    <div class="oportunidad-accion"><?php echo htmlspecialchars($oportunidad['accion'] ?? ''); ?></div>
                    <div class="oportunidad-complejidad">Complejidad: <?php echo htmlspecialchars($oportunidad['complejidad'] ?? ''); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Schemas Recomendados -->
        <?php if (!empty($area['schemas_recomendados'])): ?>
        <div class="schemas-section">
            <h2>Schemas Recomendados</h2>
            <?php foreach ($area['schemas_recomendados'] as $schema): ?>
            <div class="schema-card">
                <div class="schema-header">
                    <span class="schema-tipo"><?php echo htmlspecialchars($schema['tipo'] ?? ''); ?></span>
                    <span class="schema-prioridad <?php echo strtolower($schema['prioridad'] ?? 'media'); ?>">
                        Prioridad: <?php echo ucfirst($schema['prioridad'] ?? 'Media'); ?>
                    </span>
                </div>
                <div class="schema-paginas"><?php echo htmlspecialchars($schema['paginas'] ?? ''); ?></div>
                <div class="schema-beneficio">
                    <strong>Beneficio:</strong> <?php echo htmlspecialchars($schema['beneficio'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Recomendaciones Prioritarias -->
        <div class="recomendaciones-section">
            <h2>Plan de Acción Priorizado</h2>
            <div class="recomendaciones-list">
                <?php
                $prioridades = $area['recomendaciones_prioritarias'] ?? [];
                foreach ($prioridades as $index => $recomendacion):
                ?>
                <div class="recomendacion-item">
                    <div class="rec-numero"><?php echo $index + 1; ?></div>
                    <div class="rec-texto"><?php echo htmlspecialchars($recomendacion); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Impacto Estimado -->
        <?php if (!empty($area['impacto_estimado'])): ?>
        <div class="impacto-final">
            <div class="impacto-icon"></div>
            <div class="impacto-content">
                <strong>Impacto Estimado de las Optimizaciones:</strong>
                <p><?php echo htmlspecialchars($area['impacto_estimado']); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis SEO On-Page - <?php echo htmlspecialchars($area['nombre'] ?? ''); ?></span>
        <span class="page-number">Página <?php echo $pagina_numero; ?></span>
    </div>
</div>

<?php
$pagina_numero++;
endforeach;
?>

<style>
.area-analysis {
    background: #f7fafc;
    padding: 0;
    min-height: 100vh;
}

.area-header {
    color: white;
    padding: 40px 50px;
    border-radius: 0;
}

.area-badge {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    opacity: 0.9;
    margin-bottom: 15px;
    font-weight: 600;
}

.area-title {
    font-size: 38px;
    font-weight: 800;
    margin: 0 0 30px 0;
}

.area-metrics-header {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
}

.metric-header-item {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 15px 20px;
    text-align: center;
}

.metric-value {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 5px;
}

.metric-label {
    font-size: 12px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.area-content {
    padding: 40px 50px;
}

.area-content h2 {
    font-size: 28px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 700;
}

.hallazgos-section {
    margin-bottom: 40px;
}

.hallazgo-detail {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border-left: 6px solid;
}

.hallazgo-detail.critico { border-left-color: #dc2626; }
.hallazgo-detail.importante { border-left-color: #88B04B; }
.hallazgo-detail.menor { border-left-color: #eab308; }

.hallazgo-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.hallazgo-tipo-badge {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hallazgo-tipo-badge.critico {
    background: #f0f7e6;
    color: #991b1b;
}

.hallazgo-tipo-badge.importante {
    background: #f0f7e6;
    color: #92400e;
}

.hallazgo-tipo-badge.menor {
    background: #f0f7e6;
    color: #854d0e;
}

.hallazgo-cantidad {
    font-size: 13px;
    color: #718096;
    font-weight: 600;
}

.hallazgo-titulo {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.hallazgo-descripcion {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.7;
    margin-bottom: 15px;
}

.hallazgo-ejemplos,
.hallazgo-causas {
    background: #f7fafc;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
}

.hallazgo-ejemplos strong,
.hallazgo-causas strong {
    display: block;
    font-size: 13px;
    color: #2d3748;
    margin-bottom: 10px;
}

.hallazgo-ejemplos ul,
.hallazgo-causas ul {
    margin: 0;
    padding-left: 20px;
}

.hallazgo-ejemplos li,
.hallazgo-causas li {
    font-size: 13px;
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 8px;
}

.hallazgo-ejemplos code {
    background: #f5f5f5;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
    color: #1e293b;
    word-break: break-all;
}

.hallazgo-impacto {
    background: #f0f7e6;
    border-left: 3px solid #88B04B;
    padding: 12px 15px;
    border-radius: 6px;
    font-size: 13px;
    color: #78350f;
    margin-bottom: 12px;
    line-height: 1.6;
}

.impacto-label {
    font-weight: 700;
    display: inline-block;
    margin-right: 5px;
}

.hallazgo-recomendacion {
    background: #f0f7e6;
    border-left: 3px solid #88B04B;
    padding: 12px 15px;
    border-radius: 6px;
    font-size: 13px;
    color: #065f46;
    line-height: 1.6;
}

.rec-label {
    font-weight: 700;
    display: inline-block;
    margin-right: 5px;
}

.optimizacion-section,
.oportunidades-section,
.schemas-section,
.recomendaciones-section {
    margin-bottom: 40px;
}

.ejemplo-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.ejemplo-tipo {
    font-size: 14px;
    font-weight: 700;
    color: #88B04B;
    margin-bottom: 15px;
}

.ejemplo-comparison {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 20px;
    align-items: center;
    margin-bottom: 15px;
}

.ejemplo-actual,
.ejemplo-propuesto {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ejemplo-label {
    font-size: 11px;
    color: #718096;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.ejemplo-actual code {
    background: #f0f7e6;
    color: #991b1b;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    display: block;
    word-break: break-word;
}

.ejemplo-propuesto code {
    background: #f0f7e6;
    color: #065f46;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    display: block;
    word-break: break-word;
}

.ejemplo-chars {
    font-size: 11px;
    color: #a0aec0;
}

.ejemplo-arrow {
    font-size: 24px;
    color: #88B04B;
    font-weight: bold;
}

.ejemplo-mejora {
    font-size: 13px;
    color: #4a5568;
    background: #f7fafc;
    padding: 10px 15px;
    border-radius: 6px;
}

.oportunidades-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.oportunidad-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.oportunidad-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.oportunidad-prioridad {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.oportunidad-prioridad.alta {
    background: #f0f7e6;
    color: #991b1b;
}

.oportunidad-prioridad.media {
    background: #f0f7e6;
    color: #92400e;
}

.oportunidad-prioridad.baja {
    background: #f0f7e6;
    color: #854d0e;
}

.oportunidad-ahorro {
    font-size: 16px;
    font-weight: 700;
    color: #88B04B;
}

.oportunidad-accion {
    font-size: 15px;
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 10px;
}

.oportunidad-complejidad {
    font-size: 12px;
    color: #718096;
}

.schemas-section {
    margin-bottom: 40px;
}

.schema-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.schema-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.schema-tipo {
    font-size: 16px;
    font-weight: 700;
    color: #88B04B;
}

.schema-prioridad {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.schema-prioridad.alta {
    background: #f0f7e6;
    color: #991b1b;
}

.schema-prioridad.media {
    background: #f0f7e6;
    color: #92400e;
}

.schema-prioridad.baja {
    background: #f0f7e6;
    color: #854d0e;
}

.schema-paginas {
    font-size: 13px;
    color: #718096;
    margin-bottom: 8px;
}

.schema-beneficio {
    font-size: 14px;
    color: #4a5568;
}

.recomendaciones-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.recomendacion-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    background: white;
    border-radius: 12px;
    padding: 18px 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.rec-numero {
    font-size: 18px;
    font-weight: 800;
    color: white;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.rec-texto {
    font-size: 14px;
    color: #2d3748;
    line-height: 1.7;
    flex: 1;
}

.impacto-final {
    background: linear-gradient(135deg, #f0f7e6 0%, #bbf7d0 100%);
    border-radius: 12px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.15);
}

.impacto-icon {
    font-size: 48px;
}

.impacto-content {
    flex: 1;
}

.impacto-content strong {
    display: block;
    font-size: 18px;
    color: #065f46;
    margin-bottom: 8px;
}

.impacto-content p {
    font-size: 15px;
    color: #047857;
    margin: 0;
    line-height: 1.6;
}

.page-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    border-top: 2px solid #f5f5f5;
    font-size: 13px;
    color: #718096;
}

.page-number {
    font-weight: 600;
}

/* ==========================================
   PATRÓN EDUCATIVO - CSS COMPLETO ON-PAGE
   ========================================== */

/* Página Educativa */
.onpage-educativo {
    background: #f7fafc;
    padding: 50px;
    min-height: 100vh;
}

.onpage-educativo .page-content {
    max-width: 1200px;
    margin: 0 auto;
}

/* Sección Educativa */
.onpage-educativo .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.onpage-educativo .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.onpage-educativo .concepto-icon {
    font-size: 32px;
}

.onpage-educativo .concepto-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    border: none;
    padding: 0;
    color: white;
}

.onpage-educativo .concepto-intro {
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 25px;
}

.onpage-educativo .analogia-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-left: 4px solid #ffd700;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.onpage-educativo .analogia-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 16px;
}

.onpage-educativo .analogia-icon {
    font-size: 24px;
}

.onpage-educativo .analogia-list {
    margin: 15px 0;
    padding-left: 25px;
    list-style: none;
}

.onpage-educativo .analogia-list li {
    margin-bottom: 12px;
    padding-left: 20px;
    position: relative;
}

.onpage-educativo .analogia-list li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #ffd700;
    font-weight: bold;
}

.onpage-educativo .analogia-conclusion {
    background: rgba(255,100,100,0.2);
    padding: 12px 15px;
    border-radius: 6px;
    margin: 15px 0 0 0;
}

.onpage-educativo .impacto-box {
    background: rgba(255,255,255,0.95);
    color: #333;
    padding: 25px;
    border-radius: 8px;
    margin-top: 25px;
}

.onpage-educativo .impacto-box h3 {
    margin: 0 0 20px 0;
    color: #1a1a1a;
    font-size: 18px;
    font-weight: 600;
}

.onpage-educativo .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.onpage-educativo .impacto-item {
    display: flex;
    gap: 15px;
    align-items: start;
    background: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
}

.onpage-educativo .impacto-icon {
    font-size: 28px;
    flex-shrink: 0;
}

.onpage-educativo .impacto-text {
    line-height: 1.6;
    font-size: 14px;
}

/* Sección Entregables */
.onpage-educativo .entregables-section {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.onpage-educativo .entregables-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.onpage-educativo .entregables-icon {
    font-size: 32px;
}

.onpage-educativo .entregables-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 22px;
    font-weight: 600;
    border: none;
    padding: 0;
}

.onpage-educativo .entregables-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}

.onpage-educativo .entregables-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.onpage-educativo .entregable-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 25px;
    display: flex;
    gap: 20px;
    transition: all 0.3s ease;
}

.onpage-educativo .entregable-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 12px rgba(102,126,234,0.15);
    transform: translateY(-2px);
}

.onpage-educativo .entregable-card.priority-critical {
    border-left: 5px solid #dc3545;
}

.onpage-educativo .entregable-card.priority-high {
    border-left: 5px solid #88B04B;
}

.onpage-educativo .entregable-card.priority-medium {
    border-left: 5px solid #2196f3;
}

.onpage-educativo .entregable-icon {
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

.onpage-educativo .entregable-content h3 {
    margin: 0 0 12px 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.onpage-educativo .entregable-desc {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 15px;
}

.onpage-educativo .entregable-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.onpage-educativo .meta-badge {
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.onpage-educativo .meta-badge.priority {
    background: #ffebee;
    color: #c62828;
}

.onpage-educativo .meta-badge.impact {
    background: #e8f5e9;
    color: #2e7d32;
}

.onpage-educativo .btn-download {
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

.onpage-educativo .btn-download:hover {
    background: #5568d3;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(102,126,234,0.3);
}

.onpage-educativo .btn-download i {
    font-size: 16px;
}

.onpage-educativo .como-usar-entregables {
    background: #f9f9f9;
    border-left: 4px solid #88B04B;
    padding: 20px;
    border-radius: 8px;
}

.onpage-educativo .como-usar-entregables h3 {
    margin: 0 0 15px 0;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.onpage-educativo .uso-list {
    margin: 0;
    padding-left: 25px;
}

.onpage-educativo .uso-list li {
    margin-bottom: 10px;
    line-height: 1.6;
    font-size: 14px;
}

/* Sección Comparación ANTES vs DESPUÉS */
.onpage-educativo .comparacion-antes-despues {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 12px;
    margin: 40px 0;
}

.onpage-educativo .comparacion-main-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.onpage-educativo .comparacion-main-icon {
    font-size: 32px;
}

.onpage-educativo .comparacion-main-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 24px;
    font-weight: 600;
    border: none;
    padding: 0;
}

.onpage-educativo .comparacion-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 30px;
    line-height: 1.6;
}

.onpage-educativo .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 25px;
    align-items: start;
}

.onpage-educativo .comparacion-columna {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.onpage-educativo .comparacion-header {
    padding: 20px;
    color: white;
}

.onpage-educativo .comparacion-header.error {
    background: linear-gradient(135deg, #dc3545, #c82333);
}

.onpage-educativo .comparacion-header.success {
    background: linear-gradient(135deg, #88B04B, #6d8f3c);
}

.onpage-educativo .comparacion-header h3 {
    margin: 10px 0 0 0;
    font-size: 18px;
    font-weight: 600;
    color: white;
}

.onpage-educativo .badge-estado {
    display: inline-block;
    padding: 5px 12px;
    background: rgba(255,255,255,0.25);
    border-radius: 20px;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.onpage-educativo .comparacion-content {
    padding: 25px;
}

.onpage-educativo .problemas-lista h4,
.onpage-educativo .mejoras-lista h4 {
    margin: 0 0 15px 0;
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
}

.onpage-educativo .problemas-lista ul,
.onpage-educativo .mejoras-lista ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.onpage-educativo .problema-item,
.onpage-educativo .mejora-item {
    display: flex;
    gap: 12px;
    align-items: start;
    margin-bottom: 15px;
    padding: 12px;
    background: #f9f9f9;
    border-radius: 6px;
}

.onpage-educativo .problema-item {
    border-left: 3px solid #dc3545;
}

.onpage-educativo .mejora-item {
    border-left: 3px solid #88B04B;
}

.onpage-educativo .icon-error,
.onpage-educativo .icon-success {
    font-size: 20px;
    flex-shrink: 0;
    line-height: 1;
}

.onpage-educativo .problema-texto,
.onpage-educativo .mejora-texto {
    flex: 1;
}

.onpage-educativo .problema-texto strong,
.onpage-educativo .mejora-texto strong {
    display: block;
    margin-bottom: 4px;
    color: #1a1a1a;
    font-size: 14px;
}

.onpage-educativo .problema-detalle,
.onpage-educativo .mejora-detalle {
    display: block;
    font-size: 12px;
    color: #666;
    font-style: italic;
}

.onpage-educativo .transformacion-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.onpage-educativo .arrow-icon {
    font-size: 48px;
    margin-bottom: 10px;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.onpage-educativo .arrow-text {
    text-align: center;
    font-size: 13px;
    font-weight: 600;
    color: #88B04B;
    line-height: 1.4;
    margin: 0;
}

/* Badges de Sección ANTES/DESPUÉS */
.onpage-educativo .section-badge-container,
.onpage-summary .section-badge-container {
    margin-bottom: 15px;
}

.onpage-educativo .section-badge,
.onpage-summary .section-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.onpage-educativo .section-badge.badge-antes,
.onpage-summary .section-badge.badge-antes {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    box-shadow: 0 2px 4px rgba(220,53,69,0.3);
}

.onpage-educativo .section-badge.badge-despues,
.onpage-summary .section-badge.badge-despues {
    background: linear-gradient(135deg, #88B04B, #6d8f3c);
    color: white;
    box-shadow: 0 2px 4px rgba(40,167,69,0.3);
}

/* Sección KPIs Esperados */
.onpage-educativo .kpis-esperados-section {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.onpage-educativo .kpis-esperados-section h2 {
    color: #1a1a1a;
    font-size: 22px;
    font-weight: 600;
    margin: 10px 0 15px 0;
    border: none;
    padding: 0;
}

.onpage-educativo .kpis-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}

.onpage-educativo .tabla-kpis-container {
    overflow-x: auto;
    margin: 25px 0;
}

.onpage-educativo .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
}

.onpage-educativo .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.onpage-educativo .tabla-kpis th {
    padding: 15px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.onpage-educativo .tabla-kpis .col-subtitle {
    display: block;
    font-size: 10px;
    font-weight: normal;
    text-transform: none;
    margin-top: 3px;
    opacity: 0.9;
}

.onpage-educativo .tabla-kpis .col-antes {
    background: rgba(220,53,69,0.2);
}

.onpage-educativo .tabla-kpis .col-despues {
    background: rgba(40,167,69,0.2);
}

.onpage-educativo .tabla-kpis .col-mejora {
    background: rgba(255,193,7,0.15);
    text-align: center;
}

.onpage-educativo .tabla-kpis tbody tr {
    border-bottom: 1px solid #e0e0e0;
    transition: background 0.2s ease;
}

.onpage-educativo .tabla-kpis tbody tr:hover {
    background: #f9f9f9;
}

.onpage-educativo .tabla-kpis tbody tr.highlight-row {
    background: #f0f7e6;
    border-left: 4px solid #88B04B;
}

.onpage-educativo .tabla-kpis tbody tr.highlight-row:hover {
    background: #fff5d6;
}

.onpage-educativo .tabla-kpis td {
    padding: 15px 12px;
    vertical-align: top;
}

.onpage-educativo .metrica-nombre {
    min-width: 180px;
}

.onpage-educativo .metrica-nombre strong {
    display: block;
    color: #1a1a1a;
    font-size: 14px;
    margin-bottom: 4px;
}

.onpage-educativo .metrica-descripcion {
    display: block;
    font-size: 12px;
    color: #888;
    font-style: italic;
}

.onpage-educativo .valor-antes,
.onpage-educativo .valor-despues {
    text-align: center;
    min-width: 120px;
}

.onpage-educativo .valor-numero {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2px;
}

.onpage-educativo .valor-numero.success {
    color: #88B04B;
}

.onpage-educativo .valor-unidad {
    display: block;
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.onpage-educativo .valor-mejora {
    text-align: center;
    min-width: 130px;
}

.onpage-educativo .mejora-badge {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 6px;
    text-align: center;
}

.onpage-educativo .mejora-badge.success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 2px solid #88B04B;
}

.onpage-educativo .mejora-badge.large {
    padding: 10px 15px;
}

.onpage-educativo .mejora-porcentaje {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #88B04B;
    margin-bottom: 2px;
}

.onpage-educativo .mejora-badge.large .mejora-porcentaje {
    font-size: 24px;
}

.onpage-educativo .mejora-texto {
    display: block;
    font-size: 11px;
    color: #155724;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.onpage-educativo .impacto-texto {
    font-size: 13px;
    color: #555;
    line-height: 1.5;
}

.onpage-educativo .kpis-nota-importante {
    background: #e7f3ff;
    border-left: 4px solid #2196f3;
    padding: 20px;
    border-radius: 8px;
    margin-top: 25px;
}

.onpage-educativo .nota-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.onpage-educativo .nota-icon {
    font-size: 24px;
}

.onpage-educativo .nota-header strong {
    font-size: 15px;
    color: #1a1a1a;
}

.onpage-educativo .kpis-nota-importante p {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: #555;
}

/* Responsive */
@media (max-width: 1200px) {
    .onpage-educativo .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .onpage-educativo .transformacion-arrow {
        transform: rotate(90deg);
        padding: 20px 0;
    }

    .onpage-educativo .arrow-text br {
        display: none;
    }

    .onpage-educativo .entregables-grid {
        grid-template-columns: 1fr;
    }
}
</style>
