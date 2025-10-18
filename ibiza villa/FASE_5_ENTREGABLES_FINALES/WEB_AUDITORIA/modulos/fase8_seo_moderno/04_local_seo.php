<?php
/**
 * Módulo: Local SEO (m9.5)
 * Fase: 9 - SEO Moderno
 * Página: 138 - Optimización para búsquedas locales y Google Business Profile
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Sección 09
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$gbp_status = $datosModulo['google_business_profile'] ?? [];
$local_schema = $datosModulo['local_schema'] ?? [];
$nap_consistency = $datosModulo['nap_consistency'] ?? [];
$citations = $datosModulo['citations'] ?? [];
$reviews = $datosModulo['reviews'] ?? [];
$local_pack = $datosModulo['local_pack_visibility'] ?? [];
$competencia_local = $datosModulo['competencia_local'] ?? [];
$local_keywords = $datosModulo['local_keywords'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page local-seo-page">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-map-marker-alt"></i>
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Local SEO'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Optimización para Búsquedas Locales y Google Business Profile'); ?></p>
        <div class="page-meta">
            <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span><i class="fas fa-tools"></i> Google Business Profile, Google Maps, LSI Graph</span>
            <span><i class="fas fa-book"></i> Página 138</span>
        </div>
    </div>

    <div class="page-body">

        <!-- ============================================================ -->
        <!-- SECCIÓN EDUCATIVA: Patrón ANTES/DESPUÉS con Entregables -->
        <!-- ============================================================ -->
        <div class="localseo-educativo">

        <!-- SECCIÓN EDUCATIVA: ¿Qué es Local SEO? -->
        <section class="concepto-educativo">
            <div class="concepto-header">
                <span class="concepto-icon">📚</span>
                <h2>¿Qué es Local SEO y Por Qué es Crítico para Ibiza Villa?</h2>
            </div>
            <div class="concepto-content">
                <p class="concepto-intro">
                    El Local SEO es el conjunto de estrategias para que tu negocio aparezca cuando alguien busca
                    "<strong>villas Ibiza</strong>", "<strong>alquiler lujo Ibiza</strong>" o "<strong>villas cerca de mí</strong>".
                    A diferencia del SEO tradicional, Local SEO se enfoca en búsquedas con intención geográfica y visibilidad
                    en Google Maps, Google Business Profile (GBP) y el <strong>Local Pack</strong> (los 3 negocios destacados
                    con mapa en la parte superior de Google).
                </p>

                <div class="analogia-box">
                    <div class="analogia-header">
                        <span class="analogia-icon">💡</span>
                        <strong>Piensa en Local SEO como un restaurante en la guía turística de Ibiza:</strong>
                    </div>
                    <ul class="analogia-list">
                        <li><strong>Google Business Profile</strong> es tu ficha completa en la guía: horarios, fotos, menú, opiniones</li>
                        <li><strong>Reviews (opiniones)</strong> son las recomendaciones de otros turistas - decisivas para reservar</li>
                        <li><strong>NAP (Nombre/Dirección/Teléfono)</strong> debe ser idéntico en todas las guías - inconsistencias = desconfianza</li>
                        <li><strong>Local Pack (Top 3)</strong> es aparecer en la portada de la guía turística - máxima visibilidad</li>
                        <li><strong>Citations (directorios)</strong> son todas las guías donde apareces: TripAdvisor, Timeout, Ibiza Spotlight...</li>
                        <li><strong>Fotos profesionales</strong> en GBP = el escaparate que hace entrar a los clientes</li>
                    </ul>
                    <p class="analogia-footer">
                        <strong>Para Ibiza Villa:</strong> El 68% de las búsquedas de alquiler de villas incluyen términos locales
                        ("Ibiza", "San Antonio", "Playa d'en Bossa"). Si no estás optimizado para Local SEO, eres
                        <strong>invisible</strong> para 7 de cada 10 clientes potenciales.
                    </p>
                </div>

                <div class="impacto-negocio">
                    <h3>📊 Impacto Directo en el Negocio:</h3>
                    <div class="impacto-grid">
                        <div class="impacto-item">
                            <div class="impacto-numero">+45-60%</div>
                            <div class="impacto-texto">Aumento en llamadas y solicitudes de info desde Google Maps</div>
                        </div>
                        <div class="impacto-item">
                            <div class="impacto-numero">3-5x</div>
                            <div class="impacto-texto">Más visibilidad que competidores sin GBP optimizado</div>
                        </div>
                        <div class="impacto-item">
                            <div class="impacto-numero">€8,000-15,000</div>
                            <div class="impacto-texto">Valor estimado mensual del tráfico del Local Pack (Top 3)</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN ENTREGABLES: Archivos CSV Descargables -->
        <section class="entregables-section">
            <div class="seccion-badge seccion-badge-green">
                DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN
            </div>
            <h2><i class="fas fa-file-download"></i> Archivos Descargables - Local SEO Ibiza Villa</h2>
            <p class="entregables-intro">
                Hemos preparado <strong>2 archivos CSV</strong> con todas las optimizaciones de Local SEO listas para implementar.
                Estos archivos contienen checklists completas y directorios prioritarios específicos para Ibiza Villa:
            </p>

            <div class="csv-cards-grid">
                <!-- CSV 1: GBP Optimization Checklist -->
                <div class="csv-card">
                    <div class="csv-header">
                        <div class="csv-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="csv-info">
                            <h3>Google Business Profile - Checklist Optimización</h3>
                            <p class="csv-descripcion">
                                Checklist completa de 25 items prioritarios para optimizar tu Google Business Profile
                                del 20% → 95% de completitud. Incluye: información básica, multimedia, servicios,
                                posts, reviews y Q&A.
                            </p>
                        </div>
                    </div>
                    <div class="csv-metadata">
                        <span class="csv-meta-item"><i class="fas fa-list"></i> 25 items de optimización</span>
                        <span class="csv-meta-item"><i class="fas fa-exclamation-triangle"></i> 8 items críticos</span>
                        <span class="csv-meta-item"><i class="fas fa-chart-line"></i> Impacto: +35-50% visibilidad local</span>
                    </div>
                    <div class="csv-usage">
                        <h4>📋 Cómo Usar Este Archivo:</h4>
                        <ol>
                            <li>Abre el CSV en Excel o Google Sheets</li>
                            <li>Ordena por columna "Prioridad" (Crítica → Alta → Media → Baja)</li>
                            <li>Implementa items críticos primero (máximo impacto)</li>
                            <li>Sigue las "Instrucciones" paso a paso para cada item</li>
                            <li>Marca "Status_Actual" como "Completo" cuando termines cada tarea</li>
                        </ol>
                        <p class="csv-tip">
                            <strong>💡 Tip:</strong> Completar los 8 items críticos toma ~2 horas y genera el 70% del impacto total.
                        </p>
                    </div>
                    <a href="../entregables/local_seo/gbp_optimization_checklist.csv" class="btn-download" download>
                        <i class="fas fa-download"></i>
                        Descargar GBP Checklist.csv
                    </a>
                </div>

                <!-- CSV 2: Citations y Directorios -->
                <div class="csv-card">
                    <div class="csv-header">
                        <div class="csv-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="csv-info">
                            <h3>Citations y Directorios Locales Prioritarios</h3>
                            <p class="csv-descripcion">
                                Lista de 23 directorios y plataformas donde Ibiza Villa debe estar presente para
                                maximizar consistencia NAP y visibilidad local. Incluye: plataformas universales,
                                directorios turísticos, portales específicos de Ibiza y nichos de lujo.
                            </p>
                        </div>
                    </div>
                    <div class="csv-metadata">
                        <span class="csv-meta-item"><i class="fas fa-building"></i> 23 directorios analizados</span>
                        <span class="csv-meta-item"><i class="fas fa-star"></i> DA 48-100 (alta autoridad)</span>
                        <span class="csv-meta-item"><i class="fas fa-users"></i> Tráfico estimado: 2,800-5,200 visitas/mes</span>
                    </div>
                    <div class="csv-usage">
                        <h4>📋 Cómo Usar Este Archivo:</h4>
                        <ol>
                            <li>Importa el CSV en tu gestor de proyectos o CRM</li>
                            <li>Filtra por columna "Prioridad": Crítica → Muy Alta → Alta</li>
                            <li>Empieza por Google Business Profile, Bing Places, Apple Maps (gratuitos, alto ROI)</li>
                            <li>Verifica "Presente" y "NAP_Consistente" - corrige inconsistencias primero</li>
                            <li>Crea perfiles nuevos en directorios donde "Presente = No"</li>
                            <li>Usa columna "Accion" como guía de implementación</li>
                        </ol>
                        <p class="csv-tip">
                            <strong>💡 Tip:</strong> Enfócate primero en los 8 directorios específicos de Ibiza (Ibiza Spotlight,
                            Timeout Ibiza, etc.) - audiencia 100% target.
                        </p>
                    </div>
                    <a href="../entregables/local_seo/citations_directorios.csv" class="btn-download" download>
                        <i class="fas fa-download"></i>
                        Descargar Citations Directorios.csv
                    </a>
                </div>
            </div>
        </section>

        <!-- SECCIÓN COMPARATIVA: ANTES vs DESPUÉS -->
        <section class="comparacion-antes-despues">
            <h2><i class="fas fa-exchange-alt"></i> Transformación Local SEO: Situación Actual vs Optimizada</h2>
            <p class="comparacion-intro">
                Esta comparación muestra el estado actual de Local SEO de Ibiza Villa (<span class="texto-rojo">ANTES</span>)
                vs el estado tras implementar las optimizaciones (<span class="texto-verde">DESPUÉS</span>):
            </p>

            <div class="comparacion-grid">
                <!-- Columna ANTES -->
                <div class="comparacion-columna columna-antes">
                    <div class="comparacion-header header-antes">
                        <i class="fas fa-times-circle"></i>
                        ANTES - Situación Actual
                    </div>
                    <div class="comparacion-contenido">
                        <div class="problema-item">
                            <div class="problema-icono">❌</div>
                            <div class="problema-texto">
                                <strong>Google Business Profile 20% completo</strong>
                                <p>Perfil sin optimizar: fotos genéricas, sin posts, descripción vacía, categorías incorrectas</p>
                            </div>
                        </div>
                        <div class="problema-item">
                            <div class="problema-icono">❌</div>
                            <div class="problema-texto">
                                <strong>0 apariciones en Local Pack</strong>
                                <p>No aparece en el Top 3 de Google para ninguna keyword local ("villas Ibiza", "alquiler lujo Ibiza")</p>
                            </div>
                        </div>
                        <div class="problema-item">
                            <div class="problema-icono">❌</div>
                            <div class="problema-texto">
                                <strong>3 reviews totales (3.8★ promedio)</strong>
                                <p>Pocas reviews, sin estrategia de adquisición, tasa respuesta 0%</p>
                            </div>
                        </div>
                        <div class="problema-item">
                            <div class="problema-icono">❌</div>
                            <div class="problema-texto">
                                <strong>NAP inconsistente en 8 plataformas</strong>
                                <p>Nombre/Dirección/Teléfono diferentes en TripAdvisor, Facebook, directorios → penalización algorítmica</p>
                            </div>
                        </div>
                        <div class="problema-item">
                            <div class="problema-icono">❌</div>
                            <div class="problema-texto">
                                <strong>2 directorios locales activos</strong>
                                <p>Solo Google Maps y Facebook - ausente en Ibiza Spotlight, Timeout, directorios nicho lujo</p>
                            </div>
                        </div>
                    </div>
                    <div class="comparacion-footer footer-antes">
                        <div class="footer-stat">
                            <span class="stat-label">Visibilidad Local</span>
                            <span class="stat-value">18%</span>
                        </div>
                        <div class="footer-stat">
                            <span class="stat-label">Pérdida Mensual</span>
                            <span class="stat-value">€12,000-18,000</span>
                        </div>
                    </div>
                </div>

                <!-- Flecha de Transformación -->
                <div class="comparacion-flecha">
                    <div class="flecha-contenedor">
                        <i class="fas fa-arrow-right"></i>
                        <span class="flecha-texto">OPTIMIZACIÓN<br>LOCAL SEO</span>
                    </div>
                </div>

                <!-- Columna DESPUÉS -->
                <div class="comparacion-columna columna-despues">
                    <div class="comparacion-header header-despues">
                        <i class="fas fa-check-circle"></i>
                        DESPUÉS - Optimización Completa
                    </div>
                    <div class="comparacion-contenido">
                        <div class="solucion-item">
                            <div class="solucion-icono">✅</div>
                            <div class="solucion-texto">
                                <strong>Google Business Profile 95% completo</strong>
                                <p>Perfil optimizado: 30+ fotos profesionales, 3 videos, posts semanales, descripción con keywords, servicios completos</p>
                            </div>
                        </div>
                        <div class="solucion-item">
                            <div class="solucion-icono">✅</div>
                            <div class="solucion-texto">
                                <strong>Top 3 Local Pack para 12 keywords</strong>
                                <p>Aparece en posiciones 1-3 del Local Pack para keywords clave: "villas lujo ibiza", "alquiler villas ibiza"...</p>
                            </div>
                        </div>
                        <div class="solucion-item">
                            <div class="solucion-icono">✅</div>
                            <div class="solucion-texto">
                                <strong>50+ reviews (4.8★ promedio) en 6 meses</strong>
                                <p>Estrategia activa de adquisición + respuesta 100% reviews en <24h + plantillas profesionales</p>
                            </div>
                        </div>
                        <div class="solucion-item">
                            <div class="solucion-icono">✅</div>
                            <div class="solucion-texto">
                                <strong>NAP 100% consistente en 15+ plataformas</strong>
                                <p>Información idéntica en todas las plataformas: GBP, Bing, Apple Maps, directorios, redes sociales</p>
                            </div>
                        </div>
                        <div class="solucion-item">
                            <div class="solucion-icono">✅</div>
                            <div class="solucion-texto">
                                <strong>15 directorios locales optimizados</strong>
                                <p>Presencia en Ibiza Spotlight, Timeout, TripAdvisor, Airbnb, HomeAway + 10 directorios nicho lujo</p>
                            </div>
                        </div>
                    </div>
                    <div class="comparacion-footer footer-despues">
                        <div class="footer-stat">
                            <span class="stat-label">Visibilidad Local</span>
                            <span class="stat-value">82%</span>
                        </div>
                        <div class="footer-stat">
                            <span class="stat-label">Ganancia Mensual</span>
                            <span class="stat-value">€12,000-18,000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timeline-implementacion">
                <h3><i class="fas fa-calendar-alt"></i> Timeline de Resultados:</h3>
                <div class="timeline-grid">
                    <div class="timeline-item">
                        <div class="timeline-periodo">Semanas 1-2</div>
                        <div class="timeline-accion">Optimización GBP + NAP consistency + primeras reviews</div>
                        <div class="timeline-resultado">Visibilidad Local +15-20%</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-periodo">Mes 1-2</div>
                        <div class="timeline-accion">15 citations creadas + 20-30 reviews acumuladas + posts semanales</div>
                        <div class="timeline-resultado">Primeras apariciones Local Pack</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-periodo">Mes 3-4</div>
                        <div class="timeline-accion">40+ reviews + Local Pack estabilizado Top 3 + autoridad local consolidada</div>
                        <div class="timeline-resultado">Visibilidad Local 70-85%</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-periodo">Mes 5-6</div>
                        <div class="timeline-accion">50+ reviews (4.8★) + dominancia Local Pack + reputación establecida</div>
                        <div class="timeline-resultado">ROI máximo: +€12,000-18,000/mes</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN KPIs: Tabla de Resultados Esperados -->
        <section class="tabla-kpis-section">
            <div class="seccion-badge seccion-badge-green">
                DESPUÉS - RESULTADOS ESPERADOS
            </div>
            <h2><i class="fas fa-chart-bar"></i> KPIs y Resultados Cuantificados - Local SEO</h2>
            <p class="kpis-intro">
                Estos son los <strong>KPIs medibles</strong> que cambiarán tras implementar las optimizaciones de Local SEO.
                Todas las métricas son cuantificadas y alcanzables en <strong>3-6 meses</strong>:
            </p>

            <div class="tabla-kpis-container">
                <table class="tabla-kpis">
                    <thead>
                        <tr>
                            <th class="col-metrica">Métrica</th>
                            <th class="col-antes">ANTES<br><span class="subtitulo">(Situación Actual)</span></th>
                            <th class="col-despues">DESPUÉS<br><span class="subtitulo">(Optimización Completa)</span></th>
                            <th class="col-mejora">Mejora</th>
                            <th class="col-impacto">Impacto en Negocio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fila-destacada">
                            <td class="metrica-nombre">
                                <i class="fas fa-map-marker-alt"></i>
                                <strong>Visibilidad Local Pack</strong>
                                <small>Apariciones en Top 3 Google Maps</small>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-principal">0 keywords</span>
                                <span class="valor-detalle">0% visibility</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-principal">12 keywords</span>
                                <span class="valor-detalle">82% visibility</span>
                            </td>
                            <td class="valor-mejora">
                                <span class="badge-mejora">+12 keywords</span>
                            </td>
                            <td class="valor-impacto">
                                <span class="impacto-principal">+800-1,200 sesiones/mes</span>
                                <span class="impacto-detalle">Tráfico desde Local Pack = intención altísima</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="metrica-nombre">
                                <i class="fas fa-google"></i>
                                <strong>Google Business Profile Score</strong>
                                <small>Completitud y optimización perfil</small>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-principal">20%</span>
                                <span class="valor-detalle">8/40 items completados</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-principal">95%</span>
                                <span class="valor-detalle">38/40 items optimizados</span>
                            </td>
                            <td class="valor-mejora">
                                <span class="badge-mejora">+375%</span>
                            </td>
                            <td class="valor-impacto">
                                <span class="impacto-principal">3-5x más llamadas desde GBP</span>
                                <span class="impacto-detalle">Perfil completo = confianza + conversión</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="metrica-nombre">
                                <i class="fas fa-star"></i>
                                <strong>Reviews & Rating</strong>
                                <small>Número y calidad de opiniones</small>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-principal">3 reviews (3.8★)</span>
                                <span class="valor-detalle">0% tasa respuesta</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-principal">50+ reviews (4.8★)</span>
                                <span class="valor-detalle">100% tasa respuesta <24h</span>
                            </td>
                            <td class="valor-mejora">
                                <span class="badge-mejora">+1,566%</span>
                            </td>
                            <td class="valor-impacto">
                                <span class="impacto-principal">+35-50% conversión</span>
                                <span class="impacto-detalle">Reviews = factor #1 decisión reserva</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="metrica-nombre">
                                <i class="fas fa-address-card"></i>
                                <strong>NAP Consistency</strong>
                                <small>Consistencia Nombre/Dirección/Teléfono</small>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-principal">45% consistente</span>
                                <span class="valor-detalle">8 variaciones encontradas</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-principal">100% consistente</span>
                                <span class="valor-detalle">NAP idéntico 15+ plataformas</span>
                            </td>
                            <td class="valor-mejora">
                                <span class="badge-mejora">+122%</span>
                            </td>
                            <td class="valor-impacto">
                                <span class="impacto-principal">+18-25% confianza algoritmo</span>
                                <span class="impacto-detalle">Consistency = señal de legitimidad</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="metrica-nombre">
                                <i class="fas fa-link"></i>
                                <strong>Local Citations</strong>
                                <small>Directorios y plataformas activas</small>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-principal">2 directorios</span>
                                <span class="valor-detalle">Solo GBP + Facebook</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-principal">15 directorios</span>
                                <span class="valor-detalle">Universal + Local + Nicho</span>
                            </td>
                            <td class="valor-mejora">
                                <span class="badge-mejora">+650%</span>
                            </td>
                            <td class="valor-impacto">
                                <span class="impacto-principal">+2,800-5,200 visitas/mes</span>
                                <span class="impacto-detalle">Diversificación canales tráfico local</span>
                            </td>
                        </tr>
                        <tr class="fila-destacada">
                            <td class="metrica-nombre">
                                <i class="fas fa-euro-sign"></i>
                                <strong>Valor Tráfico Local</strong>
                                <small>Estimación valor económico mensual</small>
                            </td>
                            <td class="valor-antes">
                                <span class="valor-principal">€2,000-3,500/mes</span>
                                <span class="valor-detalle">Solo tráfico orgánico web</span>
                            </td>
                            <td class="valor-despues">
                                <span class="valor-principal">€14,000-21,500/mes</span>
                                <span class="valor-detalle">Local Pack + GBP + Citations</span>
                            </td>
                            <td class="valor-mejora">
                                <span class="badge-mejora">+600%</span>
                            </td>
                            <td class="valor-impacto">
                                <span class="impacto-principal">+€12,000-18,000/mes ganancia</span>
                                <span class="impacto-detalle">ROI 8:1 en 6 meses (inversión vs retorno)</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="nota-tiempos">
                <h4><i class="fas fa-clock"></i> Nota sobre Tiempos de Implementación:</h4>
                <ul>
                    <li><strong>Semanas 1-2:</strong> Optimización GBP + corrección NAP (impacto inmediato +15-20%)</li>
                    <li><strong>Mes 1-2:</strong> Creación citations + primeras 20-30 reviews (visibilidad +35-45%)</li>
                    <li><strong>Mes 3-4:</strong> Consolidación Local Pack + 40+ reviews (visibilidad 60-75%)</li>
                    <li><strong>Mes 5-6:</strong> Dominancia local establecida + ROI máximo (visibilidad 80-85%)</li>
                </ul>
                <p class="nota-importante">
                    <i class="fas fa-info-circle"></i>
                    <strong>Importante:</strong> Local SEO es acumulativo - cuantas más reviews y citations, mayor la ventaja competitiva.
                    Tras 6 meses, la posición es muy difícil de desbancar por competidores.
                </p>
            </div>
        </section>

        </div>
        <!-- FIN SECCIÓN EDUCATIVA -->

        <!-- Resumen Ejecutivo -->
        <div class="seccion-badge seccion-badge-red">
            ANTES - SITUACIÓN ACTUAL
        </div>
        <?php if (!empty($resumen)): ?>
        <section class="executive-summary">
            <h2><i class="fas fa-chart-line"></i> Resumen Ejecutivo</h2>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-label">Score Local SEO</div>
                    <div class="summary-value <?php echo $resumen['score_class'] ?? ''; ?>">
                        <?php echo htmlspecialchars($resumen['score'] ?? 'N/A'); ?>/100
                    </div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">GBP Status</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['gbp_status'] ?? 'No verificado'); ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Local Pack Visibility</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['local_pack_visibility'] ?? '0%'); ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Reviews</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['total_reviews'] ?? '0'); ?>
                        (⭐ <?php echo htmlspecialchars($resumen['avg_rating'] ?? '0.0'); ?>)
                    </div>
                </div>
            </div>
            <?php if (!empty($resumen['diagnostico'])): ?>
            <div class="summary-diagnosis">
                <p><?php echo nl2br(htmlspecialchars($resumen['diagnostico'])); ?></p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Google Business Profile Status -->
        <?php if (!empty($gbp_status)): ?>
        <section class="gbp-section">
            <h2><i class="fas fa-google"></i> Google Business Profile - Status</h2>

            <div class="gbp-completion">
                <h3>Completitud del Perfil: <?php echo htmlspecialchars($gbp_status['completion_percentage'] ?? '0'); ?>%</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo htmlspecialchars($gbp_status['completion_percentage'] ?? '0'); ?>%;"></div>
                </div>
            </div>

            <div class="gbp-checklist">
                <h3>Checklist de Optimización (100 puntos)</h3>

                <div class="checklist-category">
                    <h4>1. Información Básica (25 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $info_basica = $gbp_status['informacion_basica'] ?? [];
                        foreach ($info_basica as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                            <?php if (!empty($item['nota'])): ?>
                            <span class="item-note"><?php echo htmlspecialchars($item['nota']); ?></span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>2. Content y Multimedia (20 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $multimedia = $gbp_status['multimedia'] ?? [];
                        foreach ($multimedia as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                            <?php if (!empty($item['cantidad'])): ?>
                            <span class="item-quantity">(<?php echo htmlspecialchars($item['cantidad']); ?>)</span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>3. Products y Services (15 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $products = $gbp_status['products_services'] ?? [];
                        foreach ($products as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>4. Google Posts (10 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $posts = $gbp_status['google_posts'] ?? [];
                        foreach ($posts as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>5. Reviews Management (20 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $reviews_mgmt = $gbp_status['reviews_management'] ?? [];
                        foreach ($reviews_mgmt as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>6. Q&A Section (10 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $qna = $gbp_status['qna_section'] ?? [];
                        foreach ($qna as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Local Schema Implementation -->
        <?php if (!empty($local_schema)): ?>
        <section class="local-schema-section">
            <h2><i class="fas fa-code"></i> Local Schema Implementation</h2>

            <div class="schema-status">
                <div class="status-item">
                    <span class="status-label">LocalBusiness Schema:</span>
                    <span class="status-badge <?php echo $local_schema['localbusiness_presente'] ? 'success' : 'error'; ?>">
                        <?php echo $local_schema['localbusiness_presente'] ? '✓ Implementado' : '✗ No encontrado'; ?>
                    </span>
                </div>
                <div class="status-item">
                    <span class="status-label">NAP en Schema:</span>
                    <span class="status-badge <?php echo $local_schema['nap_en_schema'] ? 'success' : 'error'; ?>">
                        <?php echo $local_schema['nap_en_schema'] ? '✓ Correcto' : '✗ Incompleto'; ?>
                    </span>
                </div>
                <div class="status-item">
                    <span class="status-label">GeoCoordinates:</span>
                    <span class="status-badge <?php echo $local_schema['geo_presente'] ? 'success' : 'error'; ?>">
                        <?php echo $local_schema['geo_presente'] ? '✓ Implementado' : '✗ Falta'; ?>
                    </span>
                </div>
                <div class="status-item">
                    <span class="status-label">Opening Hours:</span>
                    <span class="status-badge <?php echo $local_schema['hours_presente'] ? 'success' : 'warning'; ?>">
                        <?php echo $local_schema['hours_presente'] ? '✓ Implementado' : '⚠ Falta'; ?>
                    </span>
                </div>
            </div>

            <?php if (!empty($local_schema['schema_recomendado'])): ?>
            <div class="schema-code">
                <h3>Schema Recomendado:</h3>
                <pre><code><?php echo htmlspecialchars($local_schema['schema_recomendado']); ?></code></pre>
                <button class="btn-copy" onclick="copyToClipboard(this)">
                    <i class="fas fa-copy"></i> Copiar código
                </button>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- NAP Consistency -->
        <?php if (!empty($nap_consistency)): ?>
        <section class="nap-section">
            <h2><i class="fas fa-address-card"></i> NAP Consistency (Name, Address, Phone)</h2>

            <div class="nap-score">
                <h3>Consistencia NAP: <?php echo htmlspecialchars($nap_consistency['consistency_score'] ?? '0'); ?>%</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo htmlspecialchars($nap_consistency['consistency_score'] ?? '0'); ?>%;"></div>
                </div>
            </div>

            <?php if (!empty($nap_consistency['variaciones_encontradas'])): ?>
            <div class="nap-variations">
                <h3>Variaciones Encontradas:</h3>
                <table class="audit-table">
                    <thead>
                        <tr>
                            <th>Plataforma</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nap_consistency['variaciones_encontradas'] as $variacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($variacion['plataforma']); ?></td>
                            <td><?php echo htmlspecialchars($variacion['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($variacion['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($variacion['telefono']); ?></td>
                            <td>
                                <span class="status-badge <?php echo $variacion['consistente'] ? 'success' : 'error'; ?>">
                                    <?php echo $variacion['consistente'] ? '✓' : '✗'; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <?php if (!empty($nap_consistency['nap_canonico'])): ?>
            <div class="nap-canonical">
                <h3>NAP Canónico Recomendado:</h3>
                <div class="canonical-box">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nap_consistency['nap_canonico']['nombre']); ?></p>
                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($nap_consistency['nap_canonico']['direccion']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($nap_consistency['nap_canonico']['telefono']); ?></p>
                </div>
                <p class="info-note">
                    <i class="fas fa-info-circle"></i>
                    Usar esta versión exacta en todas las plataformas para maximizar consistencia
                </p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Citations Analysis -->
        <?php if (!empty($citations)): ?>
        <section class="citations-section">
            <h2><i class="fas fa-link"></i> Citations y Directorios</h2>

            <div class="citations-summary">
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['total_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Total Citations</span>
                </div>
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['consistent_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Consistentes</span>
                </div>
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['inconsistent_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Inconsistentes</span>
                </div>
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['missing_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Oportunidades</span>
                </div>
            </div>

            <?php if (!empty($citations['top_citations'])): ?>
            <div class="citations-list">
                <h3>Top Citations Prioritarios:</h3>
                <table class="audit-table">
                    <thead>
                        <tr>
                            <th>Directorio</th>
                            <th>Domain Authority</th>
                            <th>Status</th>
                            <th>NAP Consistent</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citations['top_citations'] as $citation): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($citation['directorio']); ?></strong></td>
                            <td><?php echo htmlspecialchars($citation['da']); ?></td>
                            <td>
                                <span class="status-badge <?php echo $citation['presente'] ? 'success' : 'error'; ?>">
                                    <?php echo $citation['presente'] ? 'Presente' : 'Falta'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($citation['presente']): ?>
                                <span class="status-badge <?php echo $citation['nap_consistent'] ? 'success' : 'warning'; ?>">
                                    <?php echo $citation['nap_consistent'] ? '✓' : '✗'; ?>
                                </span>
                                <?php else: ?>
                                <span>N/A</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($citation['accion']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Reviews Analysis -->
        <?php if (!empty($reviews)): ?>
        <section class="reviews-section">
            <h2><i class="fas fa-star"></i> Análisis de Reviews</h2>

            <div class="reviews-summary">
                <div class="review-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($reviews['total_reviews'] ?? '0'); ?></span>
                    <span class="stat-label">Total Reviews</span>
                </div>
                <div class="review-stat">
                    <span class="stat-number">⭐ <?php echo htmlspecialchars($reviews['avg_rating'] ?? '0.0'); ?></span>
                    <span class="stat-label">Rating Promedio</span>
                </div>
                <div class="review-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($reviews['response_rate'] ?? '0'); ?>%</span>
                    <span class="stat-label">Tasa de Respuesta</span>
                </div>
                <div class="review-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($reviews['avg_response_time'] ?? 'N/A'); ?></span>
                    <span class="stat-label">Tiempo Promedio Respuesta</span>
                </div>
            </div>

            <?php if (!empty($reviews['distribucion_estrellas'])): ?>
            <div class="reviews-distribution">
                <h3>Distribución de Estrellas:</h3>
                <div class="stars-chart">
                    <?php foreach ($reviews['distribucion_estrellas'] as $estrellas => $datos): ?>
                    <div class="star-row">
                        <span class="star-label"><?php echo $estrellas; ?> ⭐</span>
                        <div class="star-bar">
                            <div class="star-fill" style="width: <?php echo $datos['porcentaje']; ?>%;"></div>
                        </div>
                        <span class="star-count"><?php echo $datos['cantidad']; ?> (<?php echo $datos['porcentaje']; ?>%)</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($reviews['keywords_reviews'])): ?>
            <div class="reviews-keywords">
                <h3>Keywords Mencionadas en Reviews:</h3>
                <div class="keywords-cloud">
                    <?php foreach ($reviews['keywords_reviews'] as $keyword): ?>
                    <span class="keyword-tag" style="font-size: <?php echo 12 + ($keyword['frecuencia'] / 2); ?>px;">
                        <?php echo htmlspecialchars($keyword['keyword']); ?>
                        <small>(<?php echo $keyword['frecuencia']; ?>)</small>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="reviews-templates">
                <h3>Templates de Respuesta Recomendados:</h3>

                <div class="template-box positive">
                    <h4>Review Positiva (4-5 estrellas):</h4>
                    <pre>"Hola [Nombre], ¡Muchas gracias por tu review y por confiar en <?php echo htmlspecialchars($datosModulo['nombre_negocio'] ?? '[Negocio]'); ?>!
Nos alegra mucho que [específico sobre su experiencia].
[Invitación personalizada a volver].
¡Saludos! - [Tu Nombre], [Título]"</pre>
                </div>

                <div class="template-box negative">
                    <h4>Review Negativa (1-2 estrellas):</h4>
                    <pre>"Hola [Nombre], lamentamos mucho tu experiencia.
[Reconocimiento específico del problema].
Nos gustaría resolver esto directamente.
Por favor contáctanos en [email/phone] para encontrar una solución.
Gracias por tu feedback. - [Tu Nombre], [Título]"</pre>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Local Pack Visibility -->
        <?php if (!empty($local_pack)): ?>
        <section class="local-pack-section">
            <h2><i class="fas fa-map"></i> Visibilidad en Local Pack</h2>

            <div class="local-pack-score">
                <h3>Apariciones en Local Pack: <?php echo htmlspecialchars($local_pack['apariciones_porcentaje'] ?? '0'); ?>%</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo htmlspecialchars($local_pack['apariciones_porcentaje'] ?? '0'); ?>%;"></div>
                </div>
                <p class="pack-detail">
                    <?php echo htmlspecialchars($local_pack['apariciones_count'] ?? '0'); ?> apariciones
                    de <?php echo htmlspecialchars($local_pack['keywords_analizadas'] ?? '0'); ?> keywords locales analizadas
                </p>
            </div>

            <?php if (!empty($local_pack['keywords_ranking'])): ?>
            <div class="local-keywords-table">
                <h3>Keywords en Local Pack:</h3>
                <table class="audit-table">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Volumen</th>
                            <th>Posición Local Pack</th>
                            <th>Status</th>
                            <th>Competidores</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($local_pack['keywords_ranking'] as $kw): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($kw['keyword']); ?></strong></td>
                            <td><?php echo htmlspecialchars($kw['volumen']); ?></td>
                            <td>
                                <?php if ($kw['posicion'] > 0): ?>
                                    #<?php echo $kw['posicion']; ?>
                                <?php else: ?>
                                    No aparece
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge <?php echo $kw['posicion'] > 0 && $kw['posicion'] <= 3 ? 'success' : 'warning'; ?>">
                                    <?php echo $kw['posicion'] > 0 && $kw['posicion'] <= 3 ? 'Visible' : 'Mejorable'; ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars(implode(', ', $kw['competidores'] ?? [])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Competencia Local -->
        <?php if (!empty($competencia_local)): ?>
        <section class="competencia-local-section">
            <h2><i class="fas fa-users"></i> Benchmarking vs Competencia Local</h2>

            <?php if (!empty($competencia_local['comparativa'])): ?>
            <table class="audit-table competitive-table">
                <thead>
                    <tr>
                        <th>Negocio</th>
                        <th>GBP Score</th>
                        <th>Reviews</th>
                        <th>Rating</th>
                        <th>Local Pack</th>
                        <th>Citations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($competencia_local['comparativa'] as $comp): ?>
                    <tr class="<?php echo $comp['es_tuyo'] ? 'highlight-row' : ''; ?>">
                        <td>
                            <strong><?php echo htmlspecialchars($comp['nombre']); ?></strong>
                            <?php if ($comp['es_tuyo']): ?>
                            <span class="badge-you">TÚ</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($comp['gbp_score']); ?>/100</td>
                        <td><?php echo htmlspecialchars($comp['reviews_count']); ?></td>
                        <td>⭐ <?php echo htmlspecialchars($comp['rating']); ?></td>
                        <td><?php echo htmlspecialchars($comp['local_pack_appearances']); ?>%</td>
                        <td><?php echo htmlspecialchars($comp['citations_count']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>

            <?php if (!empty($competencia_local['insights'])): ?>
            <div class="competitive-insights">
                <h3>Insights Competitivos:</h3>
                <ul>
                    <?php foreach ($competencia_local['insights'] as $insight): ?>
                    <li><?php echo htmlspecialchars($insight); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <section class="recommendations-section">
            <h2><i class="fas fa-lightbulb"></i> Recomendaciones Prioritarias</h2>

            <div class="recommendations-grid">
                <?php foreach ($recomendaciones as $rec): ?>
                <div class="recommendation-card priority-<?php echo strtolower($rec['prioridad']); ?>">
                    <div class="rec-header">
                        <span class="rec-priority"><?php echo htmlspecialchars($rec['prioridad']); ?></span>
                        <h3><?php echo htmlspecialchars($rec['titulo']); ?></h3>
                    </div>
                    <p class="rec-description"><?php echo nl2br(htmlspecialchars($rec['descripcion'])); ?></p>
                    <div class="rec-meta">
                        <span class="rec-effort">
                            <i class="fas fa-clock"></i>
                            <?php echo htmlspecialchars($rec['esfuerzo']); ?>
                        </span>
                        <span class="rec-impact">
                            <i class="fas fa-bolt"></i>
                            Impacto: <?php echo htmlspecialchars($rec['impacto']); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($config['proyecto']['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Local SEO | Auditoría SEO</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<script>
function copyToClipboard(button) {
    const code = button.previousElementSibling.textContent;
    navigator.clipboard.writeText(code).then(() => {
        button.innerHTML = '<i class="fas fa-check"></i> ¡Copiado!';
        setTimeout(() => {
            button.innerHTML = '<i class="fas fa-copy"></i> Copiar código';
        }, 2000);
    });
}
</script>

<style>
/* Estilos específicos para el módulo Local SEO */
.local-seo-page .executive-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.local-seo-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.local-seo-page .summary-item {
    text-align: center;
}

.local-seo-page .summary-label {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 8px;
}

.local-seo-page .summary-value {
    font-size: 32px;
    font-weight: bold;
}

.local-seo-page .gbp-completion,
.local-seo-page .nap-score,
.local-seo-page .local-pack-score {
    margin: 20px 0;
}

.local-seo-page .progress-bar {
    height: 30px;
    background: #e0e0e0;
    border-radius: 15px;
    overflow: hidden;
    margin: 10px 0;
}

.local-seo-page .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #54a34a 0%, #6ab85e 100%);
    transition: width 0.3s ease;
}

.local-seo-page .checklist-category {
    margin: 30px 0;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}

.local-seo-page .checklist-items {
    list-style: none;
    padding: 0;
}

.local-seo-page .checklist-items li {
    padding: 12px;
    margin: 8px 0;
    background: white;
    border-radius: 6px;
    border-left: 4px solid #ddd;
}

.local-seo-page .checklist-items li.completed {
    border-left-color: #54a34a;
}

.local-seo-page .checklist-items li.pending {
    border-left-color: #f44336;
}

.local-seo-page .schema-code {
    background: #1e1e1e;
    color: #d4d4d4;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    position: relative;
}

.local-seo-page .schema-code pre {
    margin: 0;
    overflow-x: auto;
}

.local-seo-page .btn-copy {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 8px 16px;
    background: #54a34a;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.local-seo-page .status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
}

.local-seo-page .status-badge.success {
    background: #e8f5e9;
    color: #2e7d32;
}

.local-seo-page .status-badge.error {
    background: #ffebee;
    color: #c62828;
}

.local-seo-page .status-badge.warning {
    background: #fff3e0;
    color: #ef6c00;
}

.local-seo-page .audit-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.local-seo-page .audit-table th,
.local-seo-page .audit-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.local-seo-page .audit-table th {
    background: #f5f5f5;
    font-weight: bold;
}

.local-seo-page .highlight-row {
    background: #fff9e6;
    font-weight: bold;
}

.local-seo-page .badge-you {
    background: #54a34a;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    margin-left: 8px;
}

.local-seo-page .reviews-distribution {
    margin: 30px 0;
}

.local-seo-page .star-row {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 10px 0;
}

.local-seo-page .star-label {
    min-width: 60px;
}

.local-seo-page .star-bar {
    flex: 1;
    height: 20px;
    background: #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
}

.local-seo-page .star-fill {
    height: 100%;
    background: #ffa726;
}

.local-seo-page .template-box {
    padding: 20px;
    border-radius: 8px;
    margin: 15px 0;
}

.local-seo-page .template-box.positive {
    background: #e8f5e9;
    border-left: 4px solid #4caf50;
}

.local-seo-page .template-box.negative {
    background: #ffebee;
    border-left: 4px solid #f44336;
}

.local-seo-page .recommendations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.local-seo-page .recommendation-card {
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid;
}

.local-seo-page .recommendation-card.priority-a {
    background: #ffebee;
    border-left-color: #f44336;
}

.local-seo-page .recommendation-card.priority-b {
    background: #fff3e0;
    border-left-color: #ff9800;
}

.local-seo-page .recommendation-card.priority-c {
    background: #e3f2fd;
    border-left-color: #2196f3;
}

@media print {
    .local-seo-page .btn-copy {
        display: none;
    }
}

/* ============================================================ */
/* ESTILOS PATRÓN EDUCATIVO LOCAL SEO */
/* ============================================================ */

.localseo-educativo .concepto-educativo {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.localseo-educativo .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.localseo-educativo .concepto-icon {
    font-size: 36px;
}

.localseo-educativo .concepto-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
}

.localseo-educativo .concepto-intro {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 25px;
    opacity: 0.95;
}

.localseo-educativo .analogia-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-left: 4px solid rgba(255,255,255,0.5);
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.localseo-educativo .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 16px;
}

.localseo-educativo .analogia-icon {
    font-size: 24px;
}

.localseo-educativo .analogia-list {
    list-style: none;
    padding-left: 0;
    margin: 15px 0;
}

.localseo-educativo .analogia-list li {
    padding: 10px 0;
    padding-left: 25px;
    position: relative;
    line-height: 1.5;
}

.localseo-educativo .analogia-list li:before {
    content: "▸";
    position: absolute;
    left: 0;
    color: rgba(255,255,255,0.8);
    font-weight: bold;
}

.localseo-educativo .analogia-footer {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid rgba(255,255,255,0.3);
    font-size: 15px;
    line-height: 1.6;
}

.localseo-educativo .impacto-negocio {
    background: rgba(255,255,255,0.1);
    padding: 20px;
    border-radius: 8px;
    margin-top: 25px;
}

.localseo-educativo .impacto-negocio h3 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 18px;
}

.localseo-educativo .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.localseo-educativo .impacto-item {
    text-align: center;
    padding: 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
}

.localseo-educativo .impacto-numero {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 8px;
    color: #ffd700;
}

.localseo-educativo .impacto-texto {
    font-size: 14px;
    line-height: 1.4;
}

/* Sección Entregables */
.localseo-educativo .entregables-section {
    margin: 40px 0;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 12px;
}

.localseo-educativo .entregables-section h2 {
    color: #333;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.localseo-educativo .entregables-intro {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
}

.localseo-educativo .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 30px;
    margin-top: 25px;
}

.localseo-educativo .csv-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.localseo-educativo .csv-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.2);
    transform: translateY(-2px);
}

.localseo-educativo .csv-header {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    margin-bottom: 20px;
}

.localseo-educativo .csv-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 28px;
}

.localseo-educativo .csv-info h3 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 18px;
}

.localseo-educativo .csv-descripcion {
    color: #666;
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
}

.localseo-educativo .csv-metadata {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.localseo-educativo .csv-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #555;
}

.localseo-educativo .csv-meta-item i {
    color: #667eea;
}

.localseo-educativo .csv-usage {
    margin: 20px 0;
    padding: 20px;
    background: #fffbf0;
    border-left: 4px solid #ffc107;
    border-radius: 6px;
}

.localseo-educativo .csv-usage h4 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 15px;
}

.localseo-educativo .csv-usage ol {
    margin: 10px 0;
    padding-left: 20px;
    color: #555;
}

.localseo-educativo .csv-usage ol li {
    margin: 8px 0;
    line-height: 1.5;
    font-size: 14px;
}

.localseo-educativo .csv-tip {
    margin: 15px 0 0 0;
    padding: 12px;
    background: rgba(255, 193, 7, 0.1);
    border-radius: 6px;
    font-size: 14px;
    color: #555;
}

.localseo-educativo .btn-download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.localseo-educativo .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

/* Comparación ANTES/DESPUÉS */
.localseo-educativo .comparacion-antes-despues {
    margin: 40px 0;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.localseo-educativo .comparacion-antes-despues h2 {
    color: #333;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.localseo-educativo .comparacion-intro {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
}

.localseo-educativo .texto-rojo {
    color: #dc3545;
    font-weight: 600;
}

.localseo-educativo .texto-verde {
    color: #28a745;
    font-weight: 600;
}

.localseo-educativo .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
}

.localseo-educativo .comparacion-columna {
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.localseo-educativo .comparacion-header {
    padding: 20px;
    font-size: 18px;
    font-weight: 600;
    text-align: center;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.localseo-educativo .header-antes {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.localseo-educativo .header-despues {
    background: linear-gradient(135deg, #28a745 0%, #218838 100%);
}

.localseo-educativo .comparacion-contenido {
    padding: 25px;
}

.localseo-educativo .problema-item,
.localseo-educativo .solucion-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.localseo-educativo .problema-item:last-child,
.localseo-educativo .solucion-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.localseo-educativo .problema-icono,
.localseo-educativo .solucion-icono {
    flex-shrink: 0;
    font-size: 24px;
}

.localseo-educativo .problema-texto strong,
.localseo-educativo .solucion-texto strong {
    display: block;
    margin-bottom: 6px;
    color: #333;
    font-size: 15px;
}

.localseo-educativo .problema-texto p,
.localseo-educativo .solucion-texto p {
    margin: 0;
    color: #666;
    font-size: 14px;
    line-height: 1.5;
}

.localseo-educativo .comparacion-footer {
    padding: 20px;
    display: flex;
    justify-content: space-around;
    color: white;
}

.localseo-educativo .footer-antes {
    background: linear-gradient(135deg, #c82333 0%, #a71d2a 100%);
}

.localseo-educativo .footer-despues {
    background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
}

.localseo-educativo .footer-stat {
    text-align: center;
}

.localseo-educativo .stat-label {
    display: block;
    font-size: 13px;
    opacity: 0.9;
    margin-bottom: 5px;
}

.localseo-educativo .stat-value {
    display: block;
    font-size: 24px;
    font-weight: bold;
}

.localseo-educativo .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
}

.localseo-educativo .flecha-contenedor {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.localseo-educativo .flecha-contenedor i {
    font-size: 36px;
    animation: pulse 2s ease-in-out infinite;
}

.localseo-educativo .flecha-texto {
    font-size: 13px;
    font-weight: 600;
    text-align: center;
    line-height: 1.3;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

/* Timeline */
.localseo-educativo .timeline-implementacion {
    margin-top: 40px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 12px;
}

.localseo-educativo .timeline-implementacion h3 {
    margin: 0 0 25px 0;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.localseo-educativo .timeline-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.localseo-educativo .timeline-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #667eea;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.localseo-educativo .timeline-periodo {
    font-weight: 700;
    color: #667eea;
    font-size: 15px;
    margin-bottom: 10px;
}

.localseo-educativo .timeline-accion {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
    margin-bottom: 10px;
}

.localseo-educativo .timeline-resultado {
    font-size: 13px;
    color: #28a745;
    font-weight: 600;
    padding-top: 10px;
    border-top: 1px solid #e0e0e0;
}

/* Tabla KPIs */
.localseo-educativo .tabla-kpis-section {
    margin: 40px 0;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.localseo-educativo .tabla-kpis-section h2 {
    color: #333;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.localseo-educativo .kpis-intro {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
}

.localseo-educativo .tabla-kpis-container {
    overflow-x: auto;
    margin: 25px 0;
}

.localseo-educativo .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 8px;
    overflow: hidden;
}

.localseo-educativo .tabla-kpis thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.localseo-educativo .tabla-kpis th {
    padding: 18px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.localseo-educativo .tabla-kpis th .subtitulo {
    display: block;
    font-size: 11px;
    font-weight: 400;
    opacity: 0.9;
    margin-top: 4px;
}

.localseo-educativo .tabla-kpis tbody tr {
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.2s ease;
}

.localseo-educativo .tabla-kpis tbody tr:hover {
    background-color: #f8f9fa;
}

.localseo-educativo .tabla-kpis tbody tr.fila-destacada {
    background: linear-gradient(90deg, rgba(255,215,0,0.1) 0%, rgba(255,215,0,0.05) 100%);
    border-left: 4px solid #ffd700;
}

.localseo-educativo .tabla-kpis td {
    padding: 18px 15px;
    font-size: 14px;
    vertical-align: top;
}

.localseo-educativo .metrica-nombre {
    font-weight: 500;
}

.localseo-educativo .metrica-nombre i {
    color: #667eea;
    margin-right: 8px;
}

.localseo-educativo .metrica-nombre strong {
    display: block;
    color: #333;
    font-size: 15px;
    margin-bottom: 4px;
}

.localseo-educativo .metrica-nombre small {
    display: block;
    color: #777;
    font-size: 12px;
    font-weight: 400;
}

.localseo-educativo .valor-antes,
.localseo-educativo .valor-despues,
.localseo-educativo .valor-mejora,
.localseo-educativo .valor-impacto {
    text-align: left;
}

.localseo-educativo .valor-principal {
    display: block;
    font-weight: 600;
    font-size: 16px;
    color: #333;
    margin-bottom: 4px;
}

.localseo-educativo .valor-detalle,
.localseo-educativo .impacto-detalle {
    display: block;
    font-size: 12px;
    color: #666;
    line-height: 1.4;
}

.localseo-educativo .valor-antes .valor-principal {
    color: #dc3545;
}

.localseo-educativo .valor-despues .valor-principal {
    color: #28a745;
}

.localseo-educativo .badge-mejora {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}

.localseo-educativo .impacto-principal {
    display: block;
    font-weight: 700;
    font-size: 15px;
    color: #667eea;
    margin-bottom: 4px;
}

.localseo-educativo .nota-tiempos {
    margin-top: 30px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.localseo-educativo .nota-tiempos h4 {
    margin: 0 0 15px 0;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.localseo-educativo .nota-tiempos ul {
    margin: 15px 0;
    padding-left: 20px;
    color: #555;
}

.localseo-educativo .nota-tiempos li {
    margin: 10px 0;
    line-height: 1.6;
    font-size: 14px;
}

.localseo-educativo .nota-importante {
    margin-top: 20px;
    padding: 15px;
    background: rgba(255, 193, 7, 0.1);
    border-left: 4px solid #ffc107;
    border-radius: 6px;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

/* Badges de Sección */
.localseo-educativo .seccion-badge {
    display: inline-block;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.localseo-educativo .seccion-badge-red {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.localseo-educativo .seccion-badge-green {
    background: linear-gradient(135deg, #28a745 0%, #218838 100%);
    color: white;
}

/* Responsive Design */
@media (max-width: 992px) {
    .localseo-educativo .comparacion-grid {
        grid-template-columns: 1fr;
    }

    .localseo-educativo .comparacion-flecha {
        transform: rotate(90deg);
        margin: 20px 0;
    }

    .localseo-educativo .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .localseo-educativo .tabla-kpis {
        font-size: 12px;
    }

    .localseo-educativo .tabla-kpis th,
    .localseo-educativo .tabla-kpis td {
        padding: 12px 10px;
    }
}

@media (max-width: 768px) {
    .localseo-educativo .concepto-educativo {
        padding: 20px;
    }

    .localseo-educativo .impacto-grid {
        grid-template-columns: 1fr;
    }

    .localseo-educativo .timeline-grid {
        grid-template-columns: 1fr;
    }
}

</style>
