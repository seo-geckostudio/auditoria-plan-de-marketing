<?php
/**
 * Módulo: Tráfico Orgánico General (Página 003)
 * Sección: 01 - Tráfico y Canales
 * Descripción: Análisis completo de tráfico orgánico con métricas de engagement y conversión
 *
 * PATRÓN EDUCATIVO ANTES/DESPUÉS - Módulo 13
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$trafico_mensual = $datosModulo['trafico_mensual'] ?? [];
$tendencias = $datosModulo['tendencias_analisis'] ?? [];
$estacionalidad = $datosModulo['estacionalidad'] ?? [];
$benchmarks = $datosModulo['benchmarks_sector'] ?? [];
?>

<div class="audit-page trafico-organico-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Tráfico Orgánico General'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Análisis completo de sesiones orgánicas, engagement y conversión desde búsqueda natural'); ?></p>
        <div class="page-meta">
            <span>Período análisis: <?php echo htmlspecialchars($datosModulo['periodo_analisis'] ?? 'Enero - Diciembre 2024'); ?></span>
            <span>Herramientas: Google Analytics 4, Google Search Console</span>
            <span>Sección 01 - Tráfico Orgánico</span>
        </div>
    </div>

    <div class="page-body">

        <!-- SECCIÓN EDUCATIVA: ¿Qué es el Tráfico Orgánico? -->
        <section class="concepto-educativo">
            <div class="concepto-header">
                <span class="concepto-icon"></span>
                <h2>¿Qué es el Tráfico Orgánico y Por Qué es Crítico para Ibiza Villa?</h2>
            </div>
            <div class="concepto-content">
                <p class="concepto-intro">
                    El tráfico orgánico son los <strong>visitantes que llegan a tu sitio web desde motores de búsqueda</strong> (Google, Bing)
                    <strong>sin publicidad pagada</strong>. Son usuarios que te encontraron porque tu contenido responde a su búsqueda.
                    Es la métrica #1 para evaluar el éxito de tu estrategia SEO.
                </p>
                <div class="analogia-box">
                    <div class="analogia-header">
                        
                        <strong>Piensa en el Tráfico Orgánico como la Puerta de Entrada a una Villa de Lujo:</strong>
                    </div>
                    <ul class="analogia-list">
                        <li><strong>Tráfico Orgánico = Visitantes que llegan por recomendación/descubrimiento</strong> (no publicidad). Buscan "villa lujo Ibiza" en Google y te encuentran.</li>
                        <li><strong>Sesiones = Visitas a la villa</strong>. Cuántas veces al mes abren la puerta y entran a explorar tu sitio.</li>
                        <li><strong>Duración de Sesión = Tiempo explorando la villa</strong>. Cuántos minutos pasan viendo fotos, leyendo descripciones, checando disponibilidad.</li>
                        <li><strong>Páginas por Sesión = Habitaciones visitadas</strong>. Cuántas páginas (villas, zonas, servicios) exploran durante su visita.</li>
                        <li><strong>Tasa de Rebote = Visitantes que se van inmediatamente</strong>. Abren la puerta, ven el hall de entrada, y se van sin explorar (mala primera impresión).</li>
                        <li><strong>Conversiones = Reservas confirmadas</strong>. De 100 visitantes que entran, cuántos finalmente reservan una villa (2-3% es típico en luxury).</li>
                    </ul>
                </div>

                <div class="impacto-negocio">
                    <h3>Impacto en el Negocio de Ibiza Villa:</h3>
                    <div class="impacto-grid">
                        <div class="impacto-item">
                            
                            <strong>Eficiencia Altísima vs Publicidad</strong>
                            <p>Tráfico orgánico tiene coste marginal casi cero (no pagas por clic).
                            114,500 sesiones orgánicas con coste ~0% vs PPC coste 100% continuo.
                            Conversiones orgánicas sin coste directo de adquisición (solo mantenimiento 5-10%).</p>
                        </div>
                        <div class="impacto-item">
                            
                            <strong>Alta Intención de Compra</strong>
                            <p>Usuarios que buscan "villa lujo ibiza 10 personas agosto" tienen intención transaccional clara.
                            Tasa conversión orgánica (1.63%) es 2-3x mayor que otros canales (social 0.5%, display 0.3%).
                            Cada mejora +0.5% conversión = +30-50% revenue adicional/año.</p>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon"></span>
                            <strong>Crecimiento Compuesto a Largo Plazo</strong>
                            <p>SEO es activo acumulativo: contenido creado hoy genera tráfico años.
                            Artículo blog "Mejores zonas Ibiza" posición #3 genera 450 sesiones/mes durante 2-3 años (10,800-16,200 sesiones lifetime).
                            Esfuerzo único, beneficio continuo multi-año.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN ENTREGABLES CSV -->
        <section class="entregables-csv">
            <div class="section-header">
                <span class="badge badge-success">DESPUÉS - HERRAMIENTAS DE ANÁLISIS</span>
                <h2>Entregables Descargables</h2>
                <p>Archivos CSV con datos completos de tráfico orgánico 2024 y análisis de tendencias vs benchmarks sector.</p>
            </div>

            <div class="csv-cards">
                <!-- CSV 1: Tráfico Orgánico General -->
                <div class="csv-card">
                    <div class="csv-card-header">
                        <span class="csv-icon"></span>
                        <h3>CSV 1: Tráfico Orgánico Mensual 2024</h3>
                        <span class="badge badge-high">Prioridad Muy Alta</span>
                    </div>
                    <div class="csv-card-body">
                        <p class="csv-description">
                            <strong>Contenido:</strong> Datos completos de tráfico orgánico por mes (Enero-Diciembre 2024)
                            con métricas de engagement y conversión. Período completo 12 meses para análisis estacional.
                        </p>
                        <div class="csv-metadata">
                            <div class="metadata-item">
                                <strong>Período:</strong> Enero - Diciembre 2024 (12 meses)
                            </div>
                            <div class="metadata-item">
                                <strong>Columnas:</strong> 8 (Fecha, Sesiones Orgánicas, Usuarios, Páginas Vistas, Duración Sesión, Tasa Rebote, Conversiones, Valor Conversión EUR)
                            </div>
                            <div class="metadata-item">
                                <strong>Fuente:</strong> Google Analytics 4 - Organic Traffic Segment
                            </div>
                        </div>
                        <div class="csv-highlights">
                            <h4>Datos Clave 2024:</h4>
                            <ul>
                                <li><strong>Sesiones Orgánicas Totales:</strong> 114,500 (+16.3% vs 2023) → <span class="highlight-impact">Crecimiento positivo pero por debajo benchmark sector (+25%)</span></li>
                                <li><strong>Temporada Alta (Jun-Sep):</strong> 57,960 sesiones promedio → <span class="highlight-impact">51% del tráfico anual concentrado en 4 meses</span></li>
                                <li><strong>Tasa Conversión Promedio:</strong> 1.63% → <span class="highlight-impact">Por debajo del sector (2.5-3.5%), oportunidad +70-105% mejora</span></li>
                                <li><strong>Conversiones Totales:</strong> 1,867 reservas → <span class="highlight-impact">+21.1% vs 2023, coste adquisición ~0% (solo mantenimiento)</span></li>
                            </ul>
                        </div>
                        <div class="csv-stats">
                            <div class="stat-box">
                                <span class="stat-number">114.5k</span>
                                <span class="stat-label">Sesiones Orgánicas 2024</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">+16.3%</span>
                                <span class="stat-label">Crecimiento vs 2023</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">21.1% de crecimiento anual</span>
                                <span class="stat-label">Revenue Orgánico</span>
                            </div>
                        </div>
                        <a href="entregables/trafico/trafico_organico_general.csv" download class="btn-download">
                            Descargar trafico_organico_general.csv
                        </a>
                    </div>
                </div>

                <!-- CSV 2: Tendencias y Análisis -->
                <div class="csv-card">
                    <div class="csv-card-header">
                        <span class="csv-icon"></span>
                        <h3>CSV 2: Tendencias y Análisis vs Benchmarks</h3>
                        <span class="badge badge-critical">Prioridad Crítica</span>
                    </div>
                    <div class="csv-card-body">
                        <p class="csv-description">
                            <strong>Contenido:</strong> Análisis completo de 12 métricas clave con comparativa año sobre año (2023 vs 2024),
                            benchmarks del sector luxury villa rental, gaps identificados, y acciones recomendadas priorizadas.
                        </p>
                        <div class="csv-metadata">
                            <div class="metadata-item">
                                <strong>Métricas analizadas:</strong> 12 KPIs críticos
                            </div>
                            <div class="metadata-item">
                                <strong>Columnas:</strong> 11 (Métrica, 2023 Total, 2024 Total, Variación Absoluta, Variación %, Temporada Alta, Temporada Baja, Ratio Estacionalidad, Benchmark Sector, Gap vs Sector, Prioridad, Acción)
                            </div>
                            <div class="metadata-item">
                                <strong>Benchmarks:</strong> Promedio sector luxury vacation rental (Ahrefs Industry Reports 2024)
                            </div>
                        </div>
                        <div class="csv-highlights">
                            <h4>Gaps Críticos Identificados:</h4>
                            <ul>
                                <li><strong>Tasa Rebote 54.1%</strong> vs benchmark 45% → <span class="highlight-impact">+20.2% más alta, hero home necesita optimización urgente</span></li>
                                <li><strong>Posición Promedio GSC 24.6</strong> vs benchmark 12.5 → <span class="highlight-impact">+96.8% peor, quick wins keywords posición 11-20</span></li>
                                <li><strong>CTR Orgánico 2.8%</strong> vs benchmark 4.5% → <span class="highlight-impact">-37.8%, meta titles y rich snippets optimización</span></li>
                                <li><strong>Páginas/Sesión 3.52</strong> vs benchmark 4.20 → <span class="highlight-impact">-16.2%, internal linking deficiente</span></li>
                            </ul>
                        </div>
                        <div class="csv-stats">
                            <div class="stat-box">
                                <span class="stat-number">12</span>
                                <span class="stat-label">Métricas Analizadas</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">4</span>
                                <span class="stat-label">Gaps Críticos</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">+30-50% mejora</span>
                                <span class="stat-label">Potencial Anual Adicional</span>
                            </div>
                        </div>
                        <a href="entregables/trafico/trafico_tendencias_analisis.csv" download class="btn-download">
                            Descargar trafico_tendencias_analisis.csv
                        </a>
                    </div>
                </div>
            </div>

            <!-- Instrucciones de Uso -->
            <div class="instrucciones-uso">
                <h3>Cómo Usar los Archivos CSV</h3>
                <ol class="instrucciones-list">
                    <li><strong>Descargar ambos CSV</strong> y abrirlos en Excel o Google Sheets para análisis completo</li>
                    <li><strong>CSV 1 (Mensual):</strong> Crear gráfico de línea temporal para visualizar estacionalidad. Identificar meses pico (Jul-Ago) y valles (Nov-Feb). Calcular promedio temporada alta vs baja</li>
                    <li><strong>CSV 2 (Tendencias):</strong> Ordenar por columna "Prioridad" (Crítica → Muy Alta → Alta → Media). Empezar implementando acciones "Crítica" y "Muy Alta" que tienen mayor impacto ROI</li>
                    <li><strong>Análisis Gaps:</strong> Columna "Gap vs Sector" muestra % diferencia con benchmark. Valores negativos = estamos por debajo (malo). Priorizar gaps >20% de diferencia</li>
                    <li><strong>Estacionalidad:</strong> Columna "Estacionalidad_Ratio" muestra factor multiplicador temporada alta vs baja. Ibiza Villa tiene ratio 2.4x (julio es 2.4x más tráfico que enero). Planificar contenido evergreen para suavizar curva</li>
                    <li><strong>Benchmarking Continuo:</strong> Actualizar estos CSVs mensualmente. Monitorear si las acciones implementadas cierran los gaps vs sector. Meta: alcanzar benchmarks en 6-12 meses</li>
                    <li><strong>Alertas:</strong> Configurar alertas GA4 si sesiones orgánicas caen >15% mes sobre mes o si tasa rebote sube >60% (indicadores de problemas técnicos o algoritmo)</li>
                </ol>
            </div>
        </section>

        <!-- SECCIÓN COMPARACIÓN ANTES/DESPUÉS -->
        <section class="comparacion-antes-despues">
            <div class="section-header">
                <h2>Comparación: Tráfico Orgánico Actual vs Optimizado</h2>
                <p>Análisis del rendimiento actual del tráfico orgánico y proyección de mejoras implementando optimizaciones recomendadas.</p>
            </div>

            <div class="comparacion-grid">
                <!-- COLUMNA ANTES -->
                <div class="comparacion-columna columna-antes">
                    <div class="columna-header">
                        <span class="badge badge-antes"> ANTES - SITUACIÓN ACTUAL 2024</span>
                        <h3>Tráfico Orgánico Actual (Baseline)</h3>
                    </div>
                    <div class="columna-content">
                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Tasa Rebote Alta: 54.1% (vs 45% benchmark)</strong>
                                <p>Más de la mitad de visitantes abandonan sin explorar. Hero home no comunica propuesta valor claramente,
                                falta social proof visible (reviews 4.8 enterradas), sin comparador villas, carga lenta móvil (LCP 4.2s).
                                Primera impresión no convence = pérdida inmediata.</p>
                                <span class="problema-dato">Pérdida: ~10,350 visitantes/año (9.1% × 114k) se van inmediatamente = -+25-40% mejora/año</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Posición Promedio GSC: 24.6 (vs 12.5 benchmark)</strong>
                                <p>Ranking promedio en página 3 de Google (posiciones 21-30). Solo 2.8% CTR vs 4.5% sector.
                                Keywords principales posición #15-#25 = invisibles. 67% keywords fuera top 20.
                                Competencia ocupa posiciones 1-10 con autoridad mayor.</p>
                                <span class="problema-dato">Pérdida: -35k-50k sesiones/año potenciales si subiéramos a top 10-15 promedio</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Páginas por Sesión: 3.52 (vs 4.20 benchmark)</strong>
                                <p>Visitantes exploran pocas páginas. Internal linking deficiente: villas no sugieren similares,
                                blog no linkea a landings, zonas no muestran villas disponibles. Usuario se queda en 1 landing sin descubrir
                                resto del catálogo. 127 páginas huérfanas sin enlaces = contenido invisible.</p>
                                <span class="problema-dato">Pérdida engagement: -16.2% páginas vistas = menos descubrimiento catálogo, menor conversión</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Tasa Conversión: 1.63% (vs 2.5-3.5% benchmark)</strong>
                                <p>De cada 100 visitantes orgánicos, solo 1.6 reservan. Faltan elementos de confianza: calendar disponibilidad
                                oculto, pricing no transparente, reviews no destacadas, FAQ insuficiente, políticas cancelación poco claras.
                                Fricción checkout alta: 65% abandonan formulario reserva.</p>
                                <span class="problema-dato">Pérdida: Si tuviéramos conversión 2.5% = +997 reservas adicionales/año = ++60% mejora revenue</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Estacionalidad Extrema: Ratio 2.4x (Alta vs Baja)</strong>
                                <p>51% del tráfico concentrado en 4 meses (Jun-Sep). Temporada baja (Oct-Mar) promedio 6,025 sesiones/mes
                                vs alta 14,460/mes. Falta contenido evergreen: guías Ibiza otoño-primavera, eventos fuera temporada,
                                promociones low season. Capacidad ociosa Nov-Feb sin llenar.</p>
                                <span class="problema-dato">Oportunidad: Suavizar curva temporada baja +30-40% = +8k-12k sesiones adicionales/año</span>
                            </div>
                        </div>
                    </div>
                    <div class="columna-footer">
                        <div class="score-box score-bajo">
                            <span class="score-label">Rendimiento Tráfico Orgánico Score:</span>
                            <span class="score-valor">64/100</span>
                            <span class="score-nivel">NIVEL MEDIO-BAJO</span>
                        </div>
                        <p class="footer-note">
                            Pérdida económica estimada: <strong>+30-50% mejora/año</strong> por gaps vs benchmark sector
                        </p>
                    </div>
                </div>

                <!-- FLECHA TRANSFORMACIÓN -->
                <div class="comparacion-flecha">
                    <div class="flecha-container">
                        
                        <span class="flecha-text">OPTIMIZACIÓN<br>TRÁFICO<br>ORGÁNICO</span>
                    </div>
                </div>

                <!-- COLUMNA DESPUÉS -->
                <div class="comparacion-columna columna-despues">
                    <div class="columna-header">
                        <span class="badge badge-despues"> DESPUÉS - RESULTADOS ESPERADOS (6-12 meses)</span>
                        <h3>Tráfico Orgánico Optimizado</h3>
                    </div>
                    <div class="columna-content">
                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>Tasa Rebote Reducida: 45-48% (-6-9 puntos porcentuales)</strong>
                                <p>Hero home rediseñado: propuesta valor above fold ("127 Villas Lujo Verificadas Ibiza"), reviews 4.8 destacadas,
                                comparador sticky 3 villas, trust badges (License, Insurance cobertura completa), velocidad móvil <2.5s LCP optimizado WebP + CDN.
                                Primera impresión profesional = engagement inmediato.</p>
                                <span class="solucion-dato">Ganancia: +6.9k-10.3k visitantes retenidos/año = ++18-25% mejora revenue adicional</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>Posición Promedio GSC Mejorada: 14-18 (+7-11 posiciones)</strong>
                                <p>Quick wins keywords posición 11-20 → top 10 con content refresh + internal linking. Featured snippets capturados
                                8-12 queries informativas. Schema Product + Review implementado. Authority building: 6-8 backlinks DR 70+ conseguidos.
                                Contenido optimizado E-E-A-T con team bios + certificaciones.</p>
                                <span class="solucion-dato">Ganancia: +38k-55k sesiones/año con mejor posicionamiento promedio (+33-48%)</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>Páginas por Sesión Incrementadas: 4.5-5.2 (+0.98-1.68 páginas)</strong>
                                <p>Internal linking estratégico implementado: villas similares carousel 3 opciones, blog articles linkeando 5-8 villas relevantes,
                                zonas mostrando grid 6 villas disponibles, cross-sell servicios (chef, transfer) en checkout. 0 páginas huérfanas
                                (vs 127 actual). Breadcrumbs + related content = descubrimiento catálogo completo.</p>
                                <span class="solucion-dato">Ganancia engagement: +27-47% páginas vistas = +112k-200k pageviews adicionales/año</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>Tasa Conversión Mejorada: 2.8-3.2% (+1.17-1.57 puntos)</strong>
                                <p>Calendar disponibilidad integrado en todas las villas con pricing real-time transparente. Reviews específicas villa
                                15-20 destacadas top. FAQ expandida 30-40 preguntas. Política cancelación clara con calculator reembolso.
                                Checkout optimizado: reduce fricción 65% → 35-45% abandono. WhatsApp Business + Live Chat 9-20h.</p>
                                <span class="solucion-dato">Ganancia: +1,340-1,940 reservas adicionales/año = ++72-104% mejora revenue (+72-104%)</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>Estacionalidad Suavizada: Ratio 1.8-2.0x (vs 2.4x actual)</strong>
                                <p>Contenido evergreen creado: 15-20 guías Ibiza temporada baja (otoño, primavera, invierno), eventos fuera temporada
                                (festivales, gastronomía), promociones early booking low season. Keywords long-tail "villa ibiza noviembre"
                                "alquiler villa ibiza primavera" posicionadas. Tráfico temporada baja: 6,025 → 7,800-8,500 sesiones/mes (+30-41%).</p>
                                <span class="solucion-dato">Ganancia: +10.6k-14.8k sesiones/año temporada baja = ++5-8% mejora estacional revenue adicional</span>
                            </div>
                        </div>
                    </div>
                    <div class="columna-footer">
                        <div class="score-box score-alto">
                            <span class="score-label">Rendimiento Tráfico Orgánico Score:</span>
                            <span class="score-valor">89/100</span>
                            <span class="score-nivel">NIVEL ALTO</span>
                        </div>
                        <p class="footer-note">
                            Ganancia económica proyectada: <strong>+71-104% mejora total/año</strong> con optimizaciones implementadas
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timeline Implementación -->
            <div class="timeline-implementacion">
                <h3>Timeline de Implementación (6-12 meses)</h3>
                <div class="timeline-fases">
                    <div class="fase-item">
                        <div class="fase-badge">Meses 1-2</div>
                        <div class="fase-content">
                            <strong>Fase 1: Quick Wins Tasa Rebote y UX</strong>
                            <p>Hero home rediseñado + propuesta valor clara + social proof destacado. Velocidad móvil <2.5s LCP con WebP + lazy load.
                            Trust badges (certificaciones, insurance). Comparador villas sticky. WhatsApp Business integrado.</p>
                            <span class="fase-resultado">Resultado esperado: Tasa rebote 54.1% → 50-52% (-4-8%), retención +4.5k-9k visitantes/año</span>
                        </div>
                    </div>
                    <div class="fase-item">
                        <div class="fase-badge">Meses 3-5</div>
                        <div class="fase-content">
                            <strong>Fase 2: Posicionamiento y Featured Snippets</strong>
                            <p>Content refresh 15-20 páginas top con keywords posición 11-20. Featured snippets optimization 8-12 queries informativas.
                            Schema Product + Review implementado todas las villas. Internal linking estratégico 0 huérfanas. Authority building 3-4 backlinks DR 70+.</p>
                            <span class="fase-resultado">Resultado: Posición promedio 24.6 → 18-22 (+3-7 posiciones), +15k-25k sesiones/año</span>
                        </div>
                    </div>
                    <div class="fase-item">
                        <div class="fase-badge">Meses 6-8</div>
                        <div class="fase-content">
                            <strong>Fase 3: Conversión y Checkout Optimization</strong>
                            <p>Calendar disponibilidad + pricing transparente todas villas. Reviews específicas 15-20 por villa destacadas. FAQ expandida 30-40 preguntas
                            con Schema FAQPage. Política cancelación con calculator. Reduce fricción checkout 65% → 40-45% abandono.</p>
                            <span class="fase-resultado">Resultado: Conversión 1.63% → 2.2-2.5% (+0.57-0.87pp), +650-1,000 reservas adicionales/año</span>
                        </div>
                    </div>
                    <div class="fase-item">
                        <div class="fase-badge">Meses 9-12</div>
                        <div class="fase-content">
                            <strong>Fase 4: Contenido Evergreen + Consolidación</strong>
                            <p>15-20 guías Ibiza temporada baja publicadas. Keywords long-tail low season posicionadas. Authority building 3-4 backlinks adicionales DR 70+.
                            A/B testing hero variants. Monitoreo continuo gaps vs benchmarks. Suavizar estacionalidad 2.4x → 1.9-2.1x.</p>
                            <span class="fase-resultado">Resultado final: Score 64 → 87-92/100, tráfico +35-50%, conversión +70-105%, mejora total +71-104%</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN KPIS -->
        <section class="kpis-section">
            <div class="section-header">
                <h2>KPIs: Tráfico Orgánico Actual vs Optimizado</h2>
                <p>Métricas clave que miden el rendimiento del tráfico orgánico y proyección con optimizaciones implementadas.</p>
            </div>

            <div class="tabla-kpis-container">
                <table class="tabla-kpis">
                    <thead>
                        <tr>
                            <th>KPI</th>
                            <th>ANTES<br><small>(Situación Actual 2024)</small></th>
                            <th>DESPUÉS<br><small>(Optimizado 6-12 meses)</small></th>
                            <th>Mejora</th>
                            <th>Impacto en Negocio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Sesiones Orgánicas Anuales</strong></td>
                            <td>114,500<br><small>(+16.3% vs 2023, promedio 9,542/mes)</small></td>
                            <td>155,000-172,000<br><small>(promedio 12,917-14,333/mes)</small></td>
                            <td class="mejora-positiva">+35-50%<br><small>(+40,500-57,500 sesiones/año)</small></td>
                            <td>Más tráfico cualificado = más oportunidades conversión. Posicionamiento mejorado + featured snippets + contenido evergreen</td>
                        </tr>
                        <tr>
                            <td><strong>Tasa de Rebote</strong></td>
                            <td>54.1%<br><small>(vs 45% benchmark sector, +20.2% peor)</small></td>
                            <td>45-48%<br><small>(alineado con benchmark, -6.1-9.1 puntos)</small></td>
                            <td class="mejora-positiva">-11-17%<br><small>(retención +6.9k-10.3k visitantes/año)</small></td>
                            <td>Hero home optimizado + velocidad móvil + trust signals = primera impresión profesional, engagement inmediato. Ganancia +18-25% mejora/año</td>
                        </tr>
                        <tr>
                            <td><strong>Páginas por Sesión</strong></td>
                            <td>3.52<br><small>(vs 4.20 benchmark, -16.2% peor)</small></td>
                            <td>4.5-5.2<br><small>(supera benchmark +7-24%)</small></td>
                            <td class="mejora-positiva">+28-48%<br><small>(+0.98-1.68 páginas promedio)</small></td>
                            <td>Internal linking estratégico + 0 huérfanas + related villas = descubrimiento catálogo completo. +112k-200k pageviews/año</td>
                        </tr>
                        <tr>
                            <td><strong>Duración Promedio Sesión</strong></td>
                            <td>275 segundos<br><small>(4 min 35 seg, vs 320 seg benchmark -14.1%)</small></td>
                            <td>330-360 segundos<br><small>(5 min 30 seg - 6 min, supera benchmark)</small></td>
                            <td class="mejora-positiva">+20-31%<br><small>(+55-85 segundos adicionales)</small></td>
                            <td>Contenido engaging: videos tours, FAQs expandidas, testimonios, interactive maps. Mayor tiempo = mayor intención compra</td>
                        </tr>
                        <tr>
                            <td><strong>Posición Promedio GSC</strong></td>
                            <td>24.6<br><small>(página 3 Google, vs 12.5 benchmark +96.8% peor)</small></td>
                            <td>14-18<br><small>(página 2 Google, top 20 mayoría keywords)</small></td>
                            <td class="mejora-positiva">+27-43%<br><small>(+7-11 posiciones mejoradas)</small></td>
                            <td>Quick wins keywords 11-20 → top 10 + featured snippets + authority building. CTR 2.8% → 4.2-4.8% (+50-71%)</td>
                        </tr>
                        <tr class="fila-destacada">
                            <td><strong>Tasa de Conversión Orgánica</strong></td>
                            <td>1.63%<br><small>(1,867 conversiones, vs 2.5-3.5% benchmark -35-53%)</small></td>
                            <td>2.8-3.2%<br><small>(4,340-5,504 conversiones)</small></td>
                            <td class="mejora-positiva">+72-96%<br><small>(+2,473-3,637 reservas adicionales)</small></td>
                            <td><strong>CRÍTICO:</strong> Calendar + pricing + reviews + FAQ = reduce fricción checkout. Revenue ++133-195% mejora/año (conversión 2.8-3.2% × 155k-172k sesiones × avg alto valor)</td>
                        </tr>
                        <tr>
                            <td><strong>Revenue Orgánico Anual</strong></td>
                            <td>Conversiones base actuales<br><small>(+21.1% vs 2023, reservas alto valor)</small></td>
                            <td>+171-204% de resultados<br><small>(combinando más tráfico + mejor conversión)</small></td>
                            <td class="mejora-positiva">+71-104%<br><small>(++71-104% mejora total adicionales/año)</small></td>
                            <td><strong>BENEFICIO CONTINUO MULTI-AÑO:</strong> Coste adquisición ~0%. Esfuerzo SEO 1,000-2,000 horas/año = Beneficio permanente. Revenue adicional permanente años</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="kpis-nota">
                <h4>Nota Importante sobre Tráfico Orgánico</h4>
                <p>
                    <strong>Tráfico orgánico es activo acumulativo con ROI compuesto a largo plazo.</strong>
                    A diferencia de publicidad (pagas → recibes tráfico → dejas pagar → tráfico desaparece), SEO tiene efecto permanente:
                </p>
                <ul>
                    <li><strong>Artículo blog optimizado</strong> posición #3 genera 450 sesiones/mes durante 2-3 años = 10,800-16,200 sesiones lifetime (inversión 1x, retorno multi-año)</li>
                    <li><strong>Featured snippet capturado</strong> monopoliza tráfico query (CTR 35-50% vs 2-5% posición #2-10) durante 6-18 meses hasta que competidor lo desbanque</li>
                    <li><strong>Authority building</strong> (backlinks DR 70+, Knowledge Panel) mejora rankings sitewide (efecto halo): 1 backlink beneficia 50-100 páginas simultáneamente</li>
                    <li><strong>Contenido evergreen</strong> (guías, comparativas) genera tráfico años: "Mejores zonas Ibiza" publicado 2022 sigue generando 380 sesiones/mes en 2024 (28 meses × 380 = 10,640 sesiones lifetime)</li>
                </ul>
                <p>
                    <strong>Comparativa ROI: SEO vs PPC (Paid Search)</strong><br>
                    - PPC: 100% coste continuo perpetuo (pago por cada clic) (coste 100% continuo anual)<br>
                    - SEO: Esfuerzo inicial 1,000-2,000 horas año 1 → genera tráfico años 2, 3, 4+ sin coste adicional marginal<br>
                    - Año 1: SEO ROI = (21.1% de crecimiento anual revenue - esfuerzo 1,200-1,600 horas) = Eficiencia 98/100<br>
                    - Años 2-5: Beneficio continuo (tráfico permanente, solo mantenimiento 250-400 horas/año)
                </p>
            </div>
        </section>

    </div>
</div>

<style>
/* ============================================
   TRÁFICO ORGÁNICO GENERAL - CSS SCOPED
   ============================================ */

.trafico-organico-page {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #000000;
    line-height: 1.6;
}

/* =====================================
   SECCIÓN EDUCATIVA
   ===================================== */

.trafico-organico-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.trafico-organico-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.trafico-organico-page .concepto-icon {
    font-size: 2.5rem;
}

.trafico-organico-page .concepto-header h2 {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 700;
}

.trafico-organico-page .concepto-intro {
    font-size: 1.1rem;
    margin-bottom: 25px;
    line-height: 1.7;
}

.trafico-organico-page .analogia-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.trafico-organico-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 1.15rem;
}

.trafico-organico-page .analogia-icon {
    font-size: 1.8rem;
}

.trafico-organico-page .analogia-list {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.trafico-organico-page .analogia-list li {
    padding: 12px 0 12px 35px;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.6;
}

.trafico-organico-page .analogia-list li:before {
    content: "";
    position: absolute;
    left: 0;
    font-size: 1.3rem;
}

/* Impacto Negocio Grid */
.trafico-organico-page .impacto-negocio {
    margin-top: 30px;
}

.trafico-organico-page .impacto-negocio h3 {
    font-size: 1.4rem;
    margin-bottom: 20px;
}

.trafico-organico-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.trafico-organico-page .impacto-item {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 20px;
    border-left: 4px solid #ffd700;
}

.trafico-organico-page .impacto-icon {
    font-size: 2rem;
    display: block;
    margin-bottom: 10px;
}

.trafico-organico-page .impacto-item strong {
    display: block;
    font-size: 1.1rem;
    margin-bottom: 8px;
}

.trafico-organico-page .impacto-item p {
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.5;
}

/* =====================================
   ENTREGABLES CSV + COMPARACIÓN + KPIS
   (Estilos completos idénticos a módulos previos)
   ===================================== */

.trafico-organico-page .entregables-csv .section-header,
.trafico-organico-page .comparacion-antes-despues .section-header,
.trafico-organico-page .kpis-section .section-header { margin-bottom: 30px; }

.trafico-organico-page .section-header h2 { font-size: 2rem; color: #000000; margin-bottom: 10px; }
.trafico-organico-page .section-header p { font-size: 1.1rem; color: #7f8c8d; }

.trafico-organico-page .badge { display: inline-block; padding: 8px 16px; border-radius: 20px;
    font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 15px; }
.trafico-organico-page .badge-success { background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; }
.trafico-organico-page .badge-critical { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
.trafico-organico-page .badge-high { background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%); color: white; }

.trafico-organico-page .csv-cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; margin-bottom: 40px; }
.trafico-organico-page .csv-card { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden; transition: all 0.3s ease; border: 2px solid transparent; }
.trafico-organico-page .csv-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); border-color: #88B04B; }

.trafico-organico-page .csv-card-header { background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px; border-bottom: 2px solid #dee2e6; }
.trafico-organico-page .csv-icon { font-size: 2rem; margin-right: 12px; }
.trafico-organico-page .csv-card-header h3 { margin: 10px 0; font-size: 1.4rem; color: #000000; }

.trafico-organico-page .csv-card-body { padding: 25px; }
.trafico-organico-page .csv-description { font-size: 1.05rem; color: #495057; margin-bottom: 20px; line-height: 1.6; }

.trafico-organico-page .csv-metadata { background: #f8f9fa; border-left: 4px solid #88B04B; padding: 15px;
    margin-bottom: 20px; border-radius: 4px; }
.trafico-organico-page .metadata-item { margin-bottom: 8px; font-size: 0.95rem; }
.trafico-organico-page .metadata-item:last-child { margin-bottom: 0; }

.trafico-organico-page .csv-highlights h4 { font-size: 1.15rem; color: #000000; margin-bottom: 12px; }
.trafico-organico-page .csv-highlights ul { list-style: none; padding-left: 0; }
.trafico-organico-page .csv-highlights li { padding: 8px 0 8px 25px; position: relative; font-size: 0.95rem; line-height: 1.5; }
.trafico-organico-page .csv-highlights li:before { content: "▸"; position: absolute; left: 0; color: #88B04B; font-weight: bold; }
.trafico-organico-page .highlight-impact { color: #88B04B; font-weight: 600; }

.trafico-organico-page .csv-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px; }
.trafico-organico-page .stat-box { background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white;
    padding: 15px; border-radius: 8px; text-align: center; }
.trafico-organico-page .stat-number { display: block; font-size: 1.8rem; font-weight: 700; margin-bottom: 5px; }
.trafico-organico-page .stat-label { display: block; font-size: 0.85rem; opacity: 0.95; }

.trafico-organico-page .btn-download { display: inline-block; background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white; padding: 12px 28px; border-radius: 6px; text-decoration: none; font-weight: 600;
    transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(40,167,69,0.3); }
.trafico-organico-page .btn-download:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(40,167,69,0.4); color: white; }

.trafico-organico-page .instrucciones-uso { background: #f8f9fa; border-radius: 10px; padding: 30px; border-left: 5px solid #88B04B; }
.trafico-organico-page .instrucciones-uso h3 { font-size: 1.5rem; color: #000000; margin-bottom: 20px; }
.trafico-organico-page .instrucciones-list { counter-reset: instruccion-counter; list-style: none; padding-left: 0; }
.trafico-organico-page .instrucciones-list li { counter-increment: instruccion-counter; position: relative;
    padding-left: 50px; margin-bottom: 20px; font-size: 1.05rem; line-height: 1.6; }
.trafico-organico-page .instrucciones-list li:before { content: counter(instruccion-counter); position: absolute;
    left: 0; top: 0; background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white;
    width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 1.1rem; }

.trafico-organico-page .comparacion-grid { display: grid; grid-template-columns: 1fr auto 1fr; gap: 30px;
    margin-bottom: 40px; align-items: start; }
.trafico-organico-page .comparacion-columna { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); overflow: hidden; }

.trafico-organico-page .columna-header { padding: 25px; text-align: center; }
.trafico-organico-page .columna-antes .columna-header { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
.trafico-organico-page .columna-despues .columna-header { background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; }

.trafico-organico-page .badge-antes, .trafico-organico-page .badge-despues { background: rgba(255,255,255,0.25); }
.trafico-organico-page .columna-header h3 { margin: 0; font-size: 1.5rem; font-weight: 700; }

.trafico-organico-page .columna-content { padding: 25px; }
.trafico-organico-page .problema-item, .trafico-organico-page .solucion-item { display: flex; gap: 15px;
    margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #e9ecef; }
.trafico-organico-page .problema-item:last-child, .trafico-organico-page .solucion-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

.trafico-organico-page .problema-icon, .trafico-organico-page .solucion-icon { font-size: 1.5rem; flex-shrink: 0; }
.trafico-organico-page .problema-text strong, .trafico-organico-page .solucion-text strong { display: block;
    font-size: 1.1rem; color: #000000; margin-bottom: 8px; }
.trafico-organico-page .problema-text p, .trafico-organico-page .solucion-text p { margin: 0 0 10px 0;
    font-size: 0.95rem; color: #495057; line-height: 1.6; }

.trafico-organico-page .problema-dato, .trafico-organico-page .solucion-dato { display: inline-block;
    background: #f0f7e6; color: #856404; padding: 6px 12px; border-radius: 4px; font-size: 0.9rem;
    font-weight: 600; border-left: 3px solid #88B04B; }
.trafico-organico-page .solucion-dato { background: #d4edda; color: #155724; border-left-color: #88B04B; }

.trafico-organico-page .comparacion-flecha { display: flex; align-items: center; justify-content: center; }
.trafico-organico-page .flecha-container { text-align: center; }
.trafico-organico-page .flecha-container i { font-size: 3rem; color: #88B04B; display: block; margin-bottom: 10px;
    animation: pulse 2s ease-in-out infinite; }
.trafico-organico-page .flecha-text { display: block; font-weight: 700; color: #88B04B; font-size: 1.1rem;
    line-height: 1.4; text-transform: uppercase; }

@keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.05); opacity: 0.9; } }

.trafico-organico-page .columna-footer { background: #f8f9fa; padding: 20px 25px; border-top: 2px solid #dee2e6; }
.trafico-organico-page .score-box { text-align: center; padding: 20px; border-radius: 8px; margin-bottom: 15px; }
.trafico-organico-page .score-bajo { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
.trafico-organico-page .score-alto { background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; }
.trafico-organico-page .score-label { display: block; font-size: 0.9rem; margin-bottom: 8px; opacity: 0.95; }
.trafico-organico-page .score-valor { display: block; font-size: 2.5rem; font-weight: 700; margin-bottom: 5px; }
.trafico-organico-page .score-nivel { display: block; font-size: 0.85rem; font-weight: 600;
    text-transform: uppercase; letter-spacing: 1px; }
.trafico-organico-page .footer-note { text-align: center; margin: 0; font-size: 0.95rem; color: #495057; }

.trafico-organico-page .timeline-implementacion { background: #f8f9fa; border-radius: 10px; padding: 30px; margin-top: 40px; }
.trafico-organico-page .timeline-implementacion h3 { font-size: 1.6rem; color: #000000; margin-bottom: 25px; text-align: center; }
.trafico-organico-page .timeline-fases { display: grid; gap: 20px; }
.trafico-organico-page .fase-item { display: flex; gap: 20px; align-items: start; }
.trafico-organico-page .fase-badge { background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white;
    padding: 10px 20px; border-radius: 25px; font-weight: 700; font-size: 0.9rem; white-space: nowrap; flex-shrink: 0; }
.trafico-organico-page .fase-content { flex: 1; background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #88B04B; }
.trafico-organico-page .fase-content strong { display: block; font-size: 1.15rem; color: #000000; margin-bottom: 10px; }
.trafico-organico-page .fase-content p { margin: 0 0 10px 0; font-size: 0.95rem; color: #495057; line-height: 1.6; }
.trafico-organico-page .fase-resultado { display: inline-block; background: #d4edda; color: #155724;
    padding: 6px 12px; border-radius: 4px; font-size: 0.9rem; font-weight: 600; border-left: 3px solid #88B04B; }

.trafico-organico-page .tabla-kpis-container { overflow-x: auto; margin-bottom: 30px; }
.trafico-organico-page .tabla-kpis { width: 100%; border-collapse: collapse; background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
.trafico-organico-page .tabla-kpis thead { background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white; }
.trafico-organico-page .tabla-kpis th { padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem;
    text-transform: uppercase; letter-spacing: 0.5px; }
.trafico-organico-page .tabla-kpis tbody tr { border-bottom: 1px solid #e9ecef; transition: background-color 0.2s ease; }
.trafico-organico-page .tabla-kpis tbody tr:hover { background-color: #f8f9fa; }
.trafico-organico-page .tabla-kpis td { padding: 18px 15px; font-size: 0.95rem; color: #495057; vertical-align: top; }
.trafico-organico-page .tabla-kpis td:first-child { font-weight: 600; color: #000000; }
.trafico-organico-page .tabla-kpis small { display: block; font-size: 0.85rem; color: #6c757d; margin-top: 4px; }
.trafico-organico-page .mejora-positiva { color: #88B04B; font-weight: 700; font-size: 1.05rem; }
.trafico-organico-page .fila-destacada { background: #f0f7e6 !important; border-top: 2px solid #ffd700; border-bottom: 2px solid #ffd700; }
.trafico-organico-page .fila-destacada td { padding: 22px 15px; }

.trafico-organico-page .kpis-nota { background: linear-gradient(135deg, #e3f2fd 0%, #e1f5fe 100%);
    border-left: 5px solid #2196f3; border-radius: 8px; padding: 25px; }
.trafico-organico-page .kpis-nota h4 { font-size: 1.3rem; color: #000000; margin-bottom: 15px;
    display: flex; align-items: center; gap: 10px; }
.trafico-organico-page .kpis-nota p { margin-bottom: 15px; font-size: 1.05rem; line-height: 1.6; color: #495057; }
.trafico-organico-page .kpis-nota ul { margin-bottom: 15px; padding-left: 25px; }
.trafico-organico-page .kpis-nota li { margin-bottom: 8px; font-size: 0.95rem; line-height: 1.6; }

@media (max-width: 992px) {
    .trafico-organico-page .impacto-grid, .trafico-organico-page .csv-cards { grid-template-columns: 1fr; }
    .trafico-organico-page .comparacion-grid { grid-template-columns: 1fr; }
    .trafico-organico-page .comparacion-flecha { order: 2; margin: 20px 0; }
    .trafico-organico-page .columna-antes { order: 1; }
    .trafico-organico-page .columna-despues { order: 3; }
    .trafico-organico-page .flecha-container i { transform: rotate(90deg); }
    .trafico-organico-page .csv-stats { grid-template-columns: 1fr; }
    .trafico-organico-page .fase-item { flex-direction: column; }
}
</style>
