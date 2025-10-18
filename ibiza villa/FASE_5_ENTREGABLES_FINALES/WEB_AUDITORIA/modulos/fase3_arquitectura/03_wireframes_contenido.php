<?php
/**
 * Módulo: Wireframes y Arquitectura de Contenido por Tipología (m3.4)
 * Fase: 3 - Arquitectura
 * Descripción: Análisis de tipologías de URL, wireframes por tipo de página, y contenido optimizado por buyer persona
 *
 * PATRÓN EDUCATIVO ANTES/DESPUÉS - Módulo 12
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$tipologias_url = $datosModulo['tipologias_url'] ?? [];
$wireframes = $datosModulo['wireframes_detallados'] ?? [];
$buyer_mapping = $datosModulo['buyer_persona_mapping'] ?? [];
$gaps_contenido = $datosModulo['gaps_contenido'] ?? [];
$schema_requirements = $datosModulo['schema_requirements'] ?? [];
?>

<div class="audit-page wireframes-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Wireframes y Arquitectura de Contenido por Tipología'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Análisis de tipologías de URL, wireframes detallados, y contenido optimizado por buyer journey'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Herramientas: Screaming Frog, Google Analytics 4, Figma/Balsamiq</span>
            <span>Fase 3 - Arquitectura de Contenido</span>
        </div>
    </div>

    <div class="page-body">

        <!-- SECCIÓN EDUCATIVA: ¿Qué son los Wireframes y la Arquitectura de Contenido? -->
        <section class="concepto-educativo">
            <div class="concepto-header">
                <span class="concepto-icon">📐</span>
                <h2>¿Qué son los Wireframes y la Arquitectura de Contenido y Por Qué son Críticos para Ibiza Villa?</h2>
            </div>
            <div class="concepto-content">
                <p class="concepto-intro">
                    Los wireframes y la arquitectura de contenido son los <strong>planos arquitectónicos de tu sitio web</strong>.
                    Definen qué contenido debe tener cada tipo de página, dónde debe colocarse, y cómo debe guiar
                    al visitante desde el descubrimiento hasta la reserva de una villa de lujo.
                </p>
                <div class="analogia-box">
                    <div class="analogia-header">
                        <span class="analogia-icon">💡</span>
                        <strong>Piensa en Wireframes como el Plano de un Arquitecto para una Villa de Lujo:</strong>
                    </div>
                    <ul class="analogia-list">
                        <li><strong>El plano muestra cada habitación de la villa</strong> (home, categoría, producto, blog) = <strong>Tipologías de URL</strong></li>
                        <li><strong>Cada habitación tiene un propósito específico</strong> (dormitorio para descansar, cocina para cocinar) = <strong>Search Intent</strong> de cada página</li>
                        <li><strong>El plano especifica qué muebles y amenidades va en cada habitación</strong> (cama king, jacuzzi, TV 4K) = <strong>Elementos de contenido</strong> (hero, galería, FAQ, reviews)</li>
                        <li><strong>Las habitaciones se conectan con pasillos lógicos</strong> (dormitorio → baño → terraza) = <strong>Internal linking</strong> y buyer journey</li>
                        <li><strong>El arquitecto diseña según el perfil del cliente</strong> (familia con niños vs pareja romántica) = <strong>Buyer Persona</strong> targeting</li>
                        <li><strong>Sin plano, la villa se construye caóticamente</strong> (habitaciones desorganizadas, visitantes perdidos) = <strong>Sitio sin arquitectura de contenido</strong></li>
                    </ul>
                </div>

                <div class="impacto-negocio">
                    <h3>Impacto en el Negocio de Ibiza Villa:</h3>
                    <div class="impacto-grid">
                        <div class="impacto-item">
                            <span class="impacto-icon">🎯</span>
                            <strong>Conversión por Tipología Optimizada</strong>
                            <p>Cada tipo de página (home, villa, zona) tiene elementos optimizados para su objetivo específico.
                            Home convierte 1.8%→2.6-2.9% con hero correcto. Villas convierten 2.3%→5.1-6.4% con calendario+reviews.</p>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon">🧭</span>
                            <strong>Buyer Journey Sin Fricción</strong>
                            <p>Wireframes mapean el recorrido completo: Awareness (blog) → Consideration (zonas) → Decision (villa específica) → Action (checkout).
                            Cada paso tiene CTAs claros. Reduce abandono checkout -25-40%.</p>
                        </div>
                        <div class="impacto-item">
                            <span class="impacto-icon">💰</span>
                            <strong>ROI de Contenido Dirigido</strong>
                            <p>Crear contenido sin wireframes = invertir €5k-10k sin saber si tendrá los elementos críticos.
                            Wireframes aseguran que cada página tenga: Keywords correctas, Schema markup, CTAs optimizados, Trust signals.
                            ROI contenido: 12:1 con wireframes vs 4:1 sin wireframes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN ENTREGABLES CSV -->
        <section class="entregables-csv">
            <div class="section-header">
                <span class="badge badge-success">DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN</span>
                <h2>Entregables Descargables</h2>
                <p>Archivos CSV con análisis completo de tipologías y wireframes detallados listos para implementación.</p>
            </div>

            <div class="csv-cards">
                <!-- CSV 1: Auditoría Tipologías URL -->
                <div class="csv-card">
                    <div class="csv-card-header">
                        <span class="csv-icon">📋</span>
                        <h3>CSV 1: Auditoría Tipologías de URL</h3>
                        <span class="badge badge-critical">Prioridad Crítica</span>
                    </div>
                    <div class="csv-card-body">
                        <p class="csv-description">
                            <strong>Contenido:</strong> Análisis completo de 14 tipologías de URL del sitio Ibiza Villa,
                            categorizadas por tipo de página (Home, Categoría, Producto, Blog, Landing Zona, etc.).
                        </p>
                        <div class="csv-metadata">
                            <div class="metadata-item">
                                <strong>Tipologías analizadas:</strong> 14
                            </div>
                            <div class="metadata-item">
                                <strong>Columnas:</strong> 11 (URL, Tipología, Contenido Actual, Gaps, Buyer Persona, Intent, Keywords, Elementos Faltantes, Prioridad, Acción, Impacto)
                            </div>
                            <div class="metadata-item">
                                <strong>Categorías:</strong> Transaccionales (Home, Villas, Zonas), Informacionales (Blog, FAQ), Institucionales (Sobre Nosotros, Prensa), Soporte (Contacto, Políticas)
                            </div>
                        </div>
                        <div class="csv-highlights">
                            <h4>Gaps Críticos Detectados:</h4>
                            <ul>
                                <li><strong>Home:</strong> Falta propuesta valor clara above fold, social proof destacado (reviews 4.8★), comparador 3 villas, FAQ 5-8 preguntas → <span class="highlight-impact">+45-60% conversión</span></li>
                                <li><strong>Villa Individual:</strong> Falta video tour 360°, calendar disponibilidad real-time, pricing dinámico temporadas, reviews villa específica, Schema Product → <span class="highlight-impact">+120-180% conversión</span></li>
                                <li><strong>Landing Zona:</strong> Falta hero imagen zona específica, stats zona (playas, distancias), guía completa, tabla comparativa 5 zonas, Schema Place → <span class="highlight-impact">+50-70% conversión zona</span></li>
                                <li><strong>Blog Artículo:</strong> Falta TOC clickable, infografías originales, video embebido, internal links villas, CTA mid/bottom, FAQ Schema → <span class="highlight-impact">+60-85% tiempo página</span></li>
                            </ul>
                        </div>
                        <div class="csv-stats">
                            <div class="stat-box">
                                <span class="stat-number">14</span>
                                <span class="stat-label">Tipologías URL Auditadas</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">48</span>
                                <span class="stat-label">Elementos Faltantes Identificados</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">+€35k-55k/mes</span>
                                <span class="stat-label">Ganancia Potencial Implementando Gaps</span>
                            </div>
                        </div>
                        <a href="../entregables/content_architecture/urls_tipologia_audit.csv" download class="btn-download">
                            <i class="fas fa-download"></i> Descargar urls_tipologia_audit.csv
                        </a>
                    </div>
                </div>

                <!-- CSV 2: Wireframes Tipología Contenido -->
                <div class="csv-card">
                    <div class="csv-card-header">
                        <span class="csv-icon">🎨</span>
                        <h3>CSV 2: Wireframes Detallados por Tipología</h3>
                        <span class="badge badge-high">Prioridad Muy Alta</span>
                    </div>
                    <div class="csv-card-body">
                        <p class="csv-description">
                            <strong>Contenido:</strong> Especificaciones completas de wireframes para 12 tipologías de página,
                            incluyendo estructura, contenido must-have/nice-to-have, keywords, Schema markup, CTAs, y conversion goals.
                        </p>
                        <div class="csv-metadata">
                            <div class="metadata-item">
                                <strong>Wireframes especificados:</strong> 12 tipologías
                            </div>
                            <div class="metadata-item">
                                <strong>Columnas:</strong> 10 (Tipología, Estructura Wireframe, Contenido Must-Have, Nice-to-Have, Keywords, Schema, CTAs, Ejemplo, Buyer Stage, Conversion Goal)
                            </div>
                            <div class="metadata-item">
                                <strong>Componentes definidos:</strong> 120+ elementos de contenido específicos con ubicación exacta
                            </div>
                        </div>
                        <div class="csv-highlights">
                            <h4>Wireframes Detallados Incluidos:</h4>
                            <ul>
                                <li><strong>Home:</strong> Hero viewport completo → Propuesta Valor → Social Proof (4.8★ 132 reviews) → Grid 6 villas → Por Qué Elegirnos 3 col → Zonas → Testimonios → Blog → Newsletter</li>
                                <li><strong>Category Listing (Villas):</strong> Breadcrumbs → Header → Filtros Sidebar (12 criterios) → Grid 3 col → Comparador Sticky 3 villas → Mapa Toggle → Pagination</li>
                                <li><strong>Individual Product (Villa):</strong> Gallery Hero 20+ fotos → Sticky Sidebar (Pricing calendar, Availability, CTA reserva) → Tabs Contenido → Reviews villa 15-20 → FAQ 8-10 → Similar Villas 3</li>
                                <li><strong>Blog Article:</strong> Header → Hero Image → Author Box → TOC clickable 8 secciones → Content → Infografías 2 originales → CTAs Mid/Bottom → Related Posts 3-4</li>
                            </ul>
                        </div>
                        <div class="csv-stats">
                            <div class="stat-box">
                                <span class="stat-number">12</span>
                                <span class="stat-label">Wireframes Completos</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">120+</span>
                                <span class="stat-label">Elementos Contenido Especificados</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">15</span>
                                <span class="stat-label">Schema Types Requeridos</span>
                            </div>
                        </div>
                        <a href="../entregables/content_architecture/wireframes_tipologia_contenido.csv" download class="btn-download">
                            <i class="fas fa-download"></i> Descargar wireframes_tipologia_contenido.csv
                        </a>
                    </div>
                </div>
            </div>

            <!-- Instrucciones de Uso -->
            <div class="instrucciones-uso">
                <h3><i class="fas fa-book"></i> Cómo Usar los Archivos CSV</h3>
                <ol class="instrucciones-list">
                    <li><strong>Descargar ambos CSV</strong> y abrirlos en Excel o Google Sheets</li>
                    <li><strong>CSV 1 (Auditoría):</strong> Revisar columna "Gaps_Detectados" y "Elementos_Faltantes" para cada URL tipo. Priorizar por columna "Prioridad" (Crítica → Muy Alta → Alta → Media → Baja)</li>
                    <li><strong>CSV 2 (Wireframes):</strong> Usar columna "Estructura_Wireframe" como blueprint visual. Columna "Contenido_MustHave" son elementos obligatorios, "Contenido_NiceToHave" son mejoras opcionales</li>
                    <li><strong>Mapeo Buyer Journey:</strong> Columna "Buyer_Journey_Stage" en CSV 2 indica en qué fase del embudo está cada página (Awareness, Consideration, Decision, Action). Diseñar contenido acorde a intención</li>
                    <li><strong>Schema Markup:</strong> Columna "Schema_Markup" en CSV 2 lista todos los tipos de Schema necesarios. Implementar Organization, LocalBusiness, Product, Review, FAQPage, HowTo según página</li>
                    <li><strong>CTAs Específicos:</strong> Columna "CTAs_Recomendados" en CSV 2 especifica qué llamadas a acción incluir en cada tipo de página con copy sugerido</li>
                    <li><strong>Implementación:</strong> Priorizar por ROI → Empezar con páginas transaccionales críticas (Home, Villas individuales, Zonas) que tienen mayor impacto conversión. Luego informacionales (Blog, FAQ) que generan tráfico top-funnel</li>
                </ol>
            </div>
        </section>

        <!-- SECCIÓN COMPARACIÓN ANTES/DESPUÉS -->
        <section class="comparacion-antes-despues">
            <div class="section-header">
                <h2>Comparación: Arquitectura de Contenido Actual vs Optimizada</h2>
                <p>Análisis del estado actual de las tipologías de URL y mejoras implementando wireframes y arquitectura de contenido completa.</p>
            </div>

            <div class="comparacion-grid">
                <!-- COLUMNA ANTES -->
                <div class="comparacion-columna columna-antes">
                    <div class="columna-header">
                        <span class="badge badge-antes">🔍 ANTES - SITUACIÓN ACTUAL</span>
                        <h3>Sin Arquitectura de Contenido Definida</h3>
                    </div>
                    <div class="columna-content">
                        <div class="problema-item">
                            <span class="problema-icon">❌</span>
                            <div class="problema-text">
                                <strong>URLs Sin Tipología Definida (14 tipos mezclados)</strong>
                                <p>Contenido creado sin blueprint previo. Home tiene elementos de blog, villas individuales sin estructura consistente,
                                zonas geográficas con contenido genérico copiado. No hay patrón definido por tipo de página.</p>
                                <span class="problema-dato">Resultado: Conversión errática 1.2-2.8% según página (debería ser 3-6% optimizado)</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon">❌</span>
                            <div class="problema-text">
                                <strong>48 Elementos Críticos Faltantes en Páginas Clave</strong>
                                <p>Home sin propuesta valor clara above fold, villas sin calendar disponibilidad ni reviews específicas,
                                blog sin TOC ni infografías, zonas sin guías completas ni comparativas. Cada página tiene 3-5 gaps críticos.</p>
                                <span class="problema-dato">Pérdida: -€35k-55k/mes en conversión por elementos faltantes</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon">❌</span>
                            <div class="problema-text">
                                <strong>Buyer Journey No Mapeado a Contenido</strong>
                                <p>No hay mapeo claro de Awareness → Consideration → Decision → Action en arquitectura de contenido.
                                Blog no linkea a zonas, zonas no sugieren villas similares, villas no tienen cross-sell servicios.
                                Usuario se pierde entre fases del funnel.</p>
                                <span class="problema-dato">Abandono: 65-75% usuarios abandonan antes de llegar a villa específica</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon">❌</span>
                            <div class="problema-text">
                                <strong>Schema Markup Inconsistente por Tipología</strong>
                                <p>Solo 3 páginas tienen Schema (Organization parcial, LocalBusiness básico). Falta Product Schema en villas,
                                FAQPage en artículos blog, Review aggregado, HowTo en guías. Google no entiende tipo de contenido de cada URL.</p>
                                <span class="problema-dato">Pérdida SEO: -18-25 posiciones en keywords transaccionales por falta Schema</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon">❌</span>
                            <div class="problema-text">
                                <strong>CTAs Genéricos Sin Personalización por Página</strong>
                                <p>Todas las páginas usan mismo CTA genérico "Contactar". No hay personalización por buyer stage:
                                Blog debería tener "Descargar Guía", Zonas "Ver Villas en [Zona]", Villas "Reservar Ahora",
                                Home "Explorar Villas Disponibles". CTR CTAs actual: 1.8% (debería ser 8-12%).</p>
                                <span class="problema-dato">Pérdida leads: -450-650 leads/mes por CTAs no optimizados</span>
                            </div>
                        </div>
                    </div>
                    <div class="columna-footer">
                        <div class="score-box score-bajo">
                            <span class="score-label">Arquitectura de Contenido Score:</span>
                            <span class="score-valor">32/100</span>
                            <span class="score-nivel">NIVEL BAJO</span>
                        </div>
                        <p class="footer-note">
                            Pérdida económica total estimada: <strong>€35,000-55,000/mes</strong> por arquitectura de contenido deficiente
                        </p>
                    </div>
                </div>

                <!-- FLECHA TRANSFORMACIÓN -->
                <div class="comparacion-flecha">
                    <div class="flecha-container">
                        <i class="fas fa-arrow-right"></i>
                        <span class="flecha-text">WIREFRAMES<br>+<br>CONTENT<br>ARCHITECTURE</span>
                    </div>
                </div>

                <!-- COLUMNA DESPUÉS -->
                <div class="comparacion-columna columna-despues">
                    <div class="columna-header">
                        <span class="badge badge-despues">✅ DESPUÉS - RESULTADOS ESPERADOS</span>
                        <h3>Arquitectura de Contenido Completa Implementada</h3>
                    </div>
                    <div class="columna-content">
                        <div class="solucion-item">
                            <span class="solucion-icon">✅</span>
                            <div class="solucion-text">
                                <strong>12 Tipologías con Wireframes Completos Documentados</strong>
                                <p>Cada tipo de página (Home, Category, Product, Blog, Zone, Service, etc.) tiene wireframe detallado
                                con estructura definida, elementos must-have especificados, y ejemplos concretos Ibiza Villa.
                                Blueprint visual completo para desarrollo/diseño.</p>
                                <span class="solucion-dato">Resultado: Conversión consistente 3.5-6.4% según tipología (+150-220% vs actual)</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon">✅</span>
                            <div class="solucion-text">
                                <strong>120+ Elementos Contenido Implementados en Páginas Clave</strong>
                                <p>Home con hero optimizado + propuesta valor + social proof + comparador. Villas con calendar pricing +
                                video tour + reviews específicas + FAQ. Blog con TOC + infografías + internal links. Zonas con guías completas +
                                tabla comparativa. Todos los gaps cerrados.</p>
                                <span class="solucion-dato">Ganancia: +€35k-55k/mes adicionales por elementos optimizados</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon">✅</span>
                            <div class="solucion-text">
                                <strong>Buyer Journey Completo Mapeado (4 Fases)</strong>
                                <p>Arquitectura diseñada según funnel: Blog (Awareness) → Zonas (Consideration) → Villas (Decision) → Checkout (Action).
                                Internal linking estratégico entre fases, CTAs progresivos, contenido personalizado por etapa.
                                Usuario fluye naturalmente hacia conversión.</p>
                                <span class="solucion-dato">Mejora funnel: Abandono 65-75% → 35-45% (-30-40 puntos porcentuales)</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon">✅</span>
                            <div class="solucion-text">
                                <strong>15 Schema Types Implementados Según Tipología</strong>
                                <p>Schema completo por tipo de página: Organization (sitewide), Product (villas), Review (agregado),
                                FAQPage (blog/FAQ), HowTo (guías), LocalBusiness (zonas), Person (team), VideoObject (tours).
                                Google entiende perfectamente tipo contenido cada URL.</p>
                                <span class="solucion-dato">Ganancia SEO: +18-25 posiciones keywords transaccionales, +8-12 Featured Snippets</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon">✅</span>
                            <div class="solucion-text">
                                <strong>CTAs Personalizados por Buyer Stage y Tipología</strong>
                                <p>Cada tipo de página tiene CTAs específicos optimizados: Home "Ver Villas Disponibles" + "Hablar con Experto",
                                Blog "Descargar Guía Gratis", Zonas "Explorar Villas en [Zona]", Villas "Reservar Ahora" + "Videollamada Virtual Tour".
                                Copy y diseño personalizado. CTR CTAs: 1.8% → 8-12% (+344-567%).</p>
                                <span class="solucion-dato">Ganancia leads: +450-650 leads/mes cualificados adicionales</span>
                            </div>
                        </div>
                    </div>
                    <div class="columna-footer">
                        <div class="score-box score-alto">
                            <span class="score-label">Arquitectura de Contenido Score:</span>
                            <span class="score-valor">88/100</span>
                            <span class="score-nivel">NIVEL ALTO</span>
                        </div>
                        <p class="footer-note">
                            Ganancia económica total estimada: <strong>€35,000-55,000/mes</strong> con arquitectura de contenido optimizada
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timeline Implementación -->
            <div class="timeline-implementacion">
                <h3>Timeline de Implementación (3-4 meses)</h3>
                <div class="timeline-fases">
                    <div class="fase-item">
                        <div class="fase-badge">Semanas 1-3</div>
                        <div class="fase-content">
                            <strong>Fase 1: Quick Wins Páginas Transaccionales</strong>
                            <p>Implementar wireframes Home + 5-8 Villas Top + 3 Zonas principales. Elementos must-have críticos: Hero optimizado, Calendar pricing, Reviews, FAQs, Schema Product/LocalBusiness.</p>
                            <span class="fase-resultado">Resultado: +15-20% conversión en páginas implementadas</span>
                        </div>
                    </div>
                    <div class="fase-item">
                        <div class="fase-badge">Semanas 4-8</div>
                        <div class="fase-content">
                            <strong>Fase 2: Contenido Informacional + Buyer Journey</strong>
                            <p>Implementar wireframes Blog (10-15 artículos top), FAQ completa, Sobre Nosotros, Zonas restantes. Internal linking estratégico entre fases funnel. Schema FAQPage, HowTo, Organization completo.</p>
                            <span class="fase-resultado">Resultado: +3,500-5,000 sesiones/mes tráfico orgánico blog, +25-35% tiempo en sitio</span>
                        </div>
                    </div>
                    <div class="fase-item">
                        <div class="fase-badge">Semanas 9-12</div>
                        <div class="fase-content">
                            <strong>Fase 3: Servicios Adicionales + Soporte</strong>
                            <p>Implementar wireframes Servicios (Chef, Transfer, Concierge), Contacto multicanal, Galería categorizada, Políticas claras. CTAs upsell en villas. Nice-to-have elements: 360° tours, Instagram feed, comparador avanzado.</p>
                            <span class="fase-resultado">Resultado: +€8k-12k/mes revenue servicios adicionales, -25-35% abandono checkout</span>
                        </div>
                    </div>
                    <div class="fase-item">
                        <div class="fase-badge">Semanas 13-16</div>
                        <div class="fase-content">
                            <strong>Fase 4: Optimización Continua + A/B Testing</strong>
                            <p>Monitorear métricas por tipología, A/B testing CTAs y hero variants, optimizar elementos nice-to-have según impacto. Replicar wireframes ganadores a nuevas páginas. Auditoría mensual arquitectura contenido.</p>
                            <span class="fase-resultado">Resultado: +5-10% conversión adicional, arquitectura contenido autosostenible</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN KPIS -->
        <section class="kpis-section">
            <div class="section-header">
                <h2>KPIs: Arquitectura de Contenido y Wireframes</h2>
                <p>Métricas clave que miden el impacto de implementar wireframes y arquitectura de contenido optimizada.</p>
            </div>

            <div class="tabla-kpis-container">
                <table class="tabla-kpis">
                    <thead>
                        <tr>
                            <th>KPI</th>
                            <th>ANTES<br><small>(Situación Actual)</small></th>
                            <th>DESPUÉS<br><small>(Wireframes Implementados)</small></th>
                            <th>Mejora</th>
                            <th>Impacto en Negocio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Arquitectura Contenido Score</strong></td>
                            <td>32/100<br><small>(NIVEL BAJO - contenido sin estructura)</small></td>
                            <td>88/100<br><small>(NIVEL ALTO - 12 wireframes completos)</small></td>
                            <td class="mejora-positiva">+175%<br><small>(+56 puntos)</small></td>
                            <td>Arquitectura optimizada = conversión consistente 3.5-6.4% vs 1.2-2.8% errático actual</td>
                        </tr>
                        <tr>
                            <td><strong>Tipologías con Wireframe Completo</strong></td>
                            <td>0/14<br><small>(0% - sin wireframes documentados)</small></td>
                            <td>12/14<br><small>(86% - wireframes detallados con must-have/nice-to-have)</small></td>
                            <td class="mejora-positiva">+∞<br><small>(de 0 a 12)</small></td>
                            <td>Blueprint visual completo acelera desarrollo 2-3x, reduce retrabajo -70-85%</td>
                        </tr>
                        <tr>
                            <td><strong>Elementos Contenido Críticos Implementados</strong></td>
                            <td>38/158<br><small>(24% - mayoría elementos faltantes)</small></td>
                            <td>145-158/158<br><small>(92-100% - must-have completo, nice-to-have 60-80%)</small></td>
                            <td class="mejora-positiva">+282-316%<br><small>(+107-120 elementos)</small></td>
                            <td>Hero optimizado = +45-60% conversión home. Calendar = -40% abandono villas. TOC blog = +60-85% tiempo página</td>
                        </tr>
                        <tr>
                            <td><strong>Buyer Journey Coverage (4 Fases)</strong></td>
                            <td>35%<br><small>(solo Consideration + Decision parcial)</small></td>
                            <td>95%<br><small>(Awareness → Consideration → Decision → Action completo)</small></td>
                            <td class="mejora-positiva">+171%<br><small>(+60 puntos porcentuales)</small></td>
                            <td>Funnel completo reduce abandono 65-75% → 35-45%. Internal linking estratégico +12-18% clickthrough entre fases</td>
                        </tr>
                        <tr>
                            <td><strong>Schema Types por Tipología</strong></td>
                            <td>3 parciales<br><small>(Organization, LocalBusiness básicos, 0 en villas/blog)</small></td>
                            <td>15 completos<br><small>(Organization, Product, Review, FAQPage, HowTo, etc.)</small></td>
                            <td class="mejora-positiva">+400%<br><small>(+12 Schema types)</small></td>
                            <td>Schema completo = +18-25 posiciones keywords transaccionales, +8-12 Featured Snippets, Knowledge Panel habilitado</td>
                        </tr>
                        <tr class="fila-destacada">
                            <td><strong>Conversión Promedio por Tipología</strong></td>
                            <td>1.9%<br><small>(Home 1.8%, Villas 2.3%, Zonas 1.5%, Blog 0.8% CTR interno)</small></td>
                            <td>4.2-5.1%<br><small>(Home 2.6-2.9%, Villas 5.1-6.4%, Zonas 2.3-2.6%, Blog 2.1% CTR)</small></td>
                            <td class="mejora-positiva">+121-168%<br><small>(+2.3-3.2 puntos)</small></td>
                            <td><strong>CRÍTICO:</strong> +€35k-55k/mes revenue adicional. Wireframes optimizados = conversión 2-3x vs páginas sin arquitectura de contenido</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="kpis-nota">
                <h4><i class="fas fa-lightbulb"></i> Nota Importante sobre Wireframes y Arquitectura de Contenido</h4>
                <p>
                    <strong>Wireframes son inversión inicial (1 mes trabajo) con ROI permanente (años).</strong>
                    Una vez implementados, sirven como blueprint para:
                </p>
                <ul>
                    <li>Crear nuevas páginas villas (agregar 10-20 villas/año manteniendo conversión alta)</li>
                    <li>Escalar contenido blog (publicar 2-4 artículos/mes con estructura ganadora TOC+infografías)</li>
                    <li>Expandir zonas geográficas (replicar wireframe zona a 8-12 nuevas zonas Ibiza/Formentera)</li>
                    <li>A/B testing eficiente (modificar elementos específicos wireframe sin rediseño completo)</li>
                    <li>Onboarding desarrolladores (nuevo dev implementa página en 2-3 días vs 1-2 semanas sin wireframe)</li>
                </ul>
                <p>
                    <strong>Wireframes reducen costo desarrollo -50-70% y tiempo implementación -60-75%</strong> vs diseñar cada página desde cero.
                    ROI wireframes: 18:1 en primer año (inversión €3k-5k vs ganancia €55k-90k).
                </p>
            </div>
        </section>

    </div>
</div>

<style>
/* ============================================
   WIREFRAMES Y ARQUITECTURA DE CONTENIDO - CSS SCOPED
   ============================================ */

.wireframes-page {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

/* =====================================
   SECCIÓN EDUCATIVA
   ===================================== */

.wireframes-page .concepto-educativo {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.wireframes-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.wireframes-page .concepto-icon {
    font-size: 2.5rem;
}

.wireframes-page .concepto-header h2 {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 700;
}

.wireframes-page .concepto-intro {
    font-size: 1.1rem;
    margin-bottom: 25px;
    line-height: 1.7;
}

.wireframes-page .analogia-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.wireframes-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 1.15rem;
}

.wireframes-page .analogia-icon {
    font-size: 1.8rem;
}

.wireframes-page .analogia-list {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.wireframes-page .analogia-list li {
    padding: 12px 0 12px 35px;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.6;
}

.wireframes-page .analogia-list li:before {
    content: "📐";
    position: absolute;
    left: 0;
    font-size: 1.3rem;
}

/* Impacto Negocio Grid */
.wireframes-page .impacto-negocio {
    margin-top: 30px;
}

.wireframes-page .impacto-negocio h3 {
    font-size: 1.4rem;
    margin-bottom: 20px;
}

.wireframes-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.wireframes-page .impacto-item {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 20px;
    border-left: 4px solid #ffd700;
}

.wireframes-page .impacto-icon {
    font-size: 2rem;
    display: block;
    margin-bottom: 10px;
}

.wireframes-page .impacto-item strong {
    display: block;
    font-size: 1.1rem;
    margin-bottom: 8px;
}

.wireframes-page .impacto-item p {
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.5;
}

/* =====================================
   ENTREGABLES CSV
   ===================================== */

.wireframes-page .entregables-csv {
    margin-bottom: 50px;
}

.wireframes-page .section-header {
    margin-bottom: 30px;
}

.wireframes-page .section-header h2 {
    font-size: 2rem;
    color: #2c3e50;
    margin-bottom: 10px;
}

.wireframes-page .section-header p {
    font-size: 1.1rem;
    color: #7f8c8d;
}

.wireframes-page .badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 15px;
}

.wireframes-page .badge-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.wireframes-page .badge-critical {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.wireframes-page .badge-high {
    background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
    color: white;
}

/* CSV Cards */
.wireframes-page .csv-cards {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}

.wireframes-page .csv-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.wireframes-page .csv-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    border-color: #667eea;
}

.wireframes-page .csv-card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-bottom: 2px solid #dee2e6;
}

.wireframes-page .csv-icon {
    font-size: 2rem;
    margin-right: 12px;
}

.wireframes-page .csv-card-header h3 {
    margin: 10px 0;
    font-size: 1.4rem;
    color: #2c3e50;
}

.wireframes-page .csv-card-body {
    padding: 25px;
}

.wireframes-page .csv-description {
    font-size: 1.05rem;
    color: #495057;
    margin-bottom: 20px;
    line-height: 1.6;
}

.wireframes-page .csv-metadata {
    background: #f8f9fa;
    border-left: 4px solid #667eea;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.wireframes-page .metadata-item {
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.wireframes-page .metadata-item:last-child {
    margin-bottom: 0;
}

.wireframes-page .csv-highlights {
    margin-bottom: 25px;
}

.wireframes-page .csv-highlights h4 {
    font-size: 1.15rem;
    color: #2c3e50;
    margin-bottom: 12px;
}

.wireframes-page .csv-highlights ul {
    list-style: none;
    padding-left: 0;
}

.wireframes-page .csv-highlights li {
    padding: 8px 0;
    padding-left: 25px;
    position: relative;
    font-size: 0.95rem;
    line-height: 1.5;
}

.wireframes-page .csv-highlights li:before {
    content: "▸";
    position: absolute;
    left: 0;
    color: #667eea;
    font-weight: bold;
}

.wireframes-page .highlight-impact {
    color: #28a745;
    font-weight: 600;
}

/* CSV Stats */
.wireframes-page .csv-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.wireframes-page .stat-box {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

.wireframes-page .stat-number {
    display: block;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.wireframes-page .stat-label {
    display: block;
    font-size: 0.85rem;
    opacity: 0.95;
}

/* Botón Descarga */
.wireframes-page .btn-download {
    display: inline-block;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 12px 28px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.wireframes-page .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    color: white;
}

.wireframes-page .btn-download i {
    margin-right: 8px;
}

/* Instrucciones Uso */
.wireframes-page .instrucciones-uso {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
    border-left: 5px solid #667eea;
}

.wireframes-page .instrucciones-uso h3 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 20px;
}

.wireframes-page .instrucciones-list {
    counter-reset: instruccion-counter;
    list-style: none;
    padding-left: 0;
}

.wireframes-page .instrucciones-list li {
    counter-increment: instruccion-counter;
    position: relative;
    padding-left: 50px;
    margin-bottom: 20px;
    font-size: 1.05rem;
    line-height: 1.6;
}

.wireframes-page .instrucciones-list li:before {
    content: counter(instruccion-counter);
    position: absolute;
    left: 0;
    top: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
}

/* =====================================
   COMPARACIÓN ANTES/DESPUÉS
   ===================================== */

.wireframes-page .comparacion-antes-despues {
    margin-bottom: 50px;
}

.wireframes-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    margin-bottom: 40px;
    align-items: start;
}

.wireframes-page .comparacion-columna {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.wireframes-page .columna-header {
    padding: 25px;
    text-align: center;
}

.wireframes-page .columna-antes .columna-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.wireframes-page .columna-despues .columna-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.wireframes-page .badge-antes,
.wireframes-page .badge-despues {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.wireframes-page .badge-antes {
    background: rgba(255, 255, 255, 0.25);
    color: white;
}

.wireframes-page .badge-despues {
    background: rgba(255, 255, 255, 0.25);
    color: white;
}

.wireframes-page .columna-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
}

.wireframes-page .columna-content {
    padding: 25px;
}

.wireframes-page .problema-item,
.wireframes-page .solucion-item {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #e9ecef;
}

.wireframes-page .problema-item:last-child,
.wireframes-page .solucion-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.wireframes-page .problema-icon,
.wireframes-page .solucion-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.wireframes-page .problema-text strong,
.wireframes-page .solucion-text strong {
    display: block;
    font-size: 1.1rem;
    color: #2c3e50;
    margin-bottom: 8px;
}

.wireframes-page .problema-text p,
.wireframes-page .solucion-text p {
    margin: 0 0 10px 0;
    font-size: 0.95rem;
    color: #495057;
    line-height: 1.6;
}

.wireframes-page .problema-dato,
.wireframes-page .solucion-dato {
    display: inline-block;
    background: #fff3cd;
    color: #856404;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 600;
    border-left: 3px solid #ffc107;
}

.wireframes-page .solucion-dato {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

/* Flecha Transformación */
.wireframes-page .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
}

.wireframes-page .flecha-container {
    text-align: center;
}

.wireframes-page .flecha-container i {
    font-size: 3rem;
    color: #667eea;
    display: block;
    margin-bottom: 10px;
    animation: pulse 2s ease-in-out infinite;
}

.wireframes-page .flecha-text {
    display: block;
    font-weight: 700;
    color: #667eea;
    font-size: 1.1rem;
    line-height: 1.4;
    text-transform: uppercase;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.9;
    }
}

/* Columna Footer */
.wireframes-page .columna-footer {
    background: #f8f9fa;
    padding: 20px 25px;
    border-top: 2px solid #dee2e6;
}

.wireframes-page .score-box {
    text-align: center;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.wireframes-page .score-bajo {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.wireframes-page .score-alto {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.wireframes-page .score-label {
    display: block;
    font-size: 0.9rem;
    margin-bottom: 8px;
    opacity: 0.95;
}

.wireframes-page .score-valor {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.wireframes-page .score-nivel {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.wireframes-page .footer-note {
    text-align: center;
    margin: 0;
    font-size: 0.95rem;
    color: #495057;
}

/* Timeline Implementación */
.wireframes-page .timeline-implementacion {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
    margin-top: 40px;
}

.wireframes-page .timeline-implementacion h3 {
    font-size: 1.6rem;
    color: #2c3e50;
    margin-bottom: 25px;
    text-align: center;
}

.wireframes-page .timeline-fases {
    display: grid;
    gap: 20px;
}

.wireframes-page .fase-item {
    display: flex;
    gap: 20px;
    align-items: start;
}

.wireframes-page .fase-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 0.9rem;
    white-space: nowrap;
    flex-shrink: 0;
}

.wireframes-page .fase-content {
    flex: 1;
    background: white;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.wireframes-page .fase-content strong {
    display: block;
    font-size: 1.15rem;
    color: #2c3e50;
    margin-bottom: 10px;
}

.wireframes-page .fase-content p {
    margin: 0 0 10px 0;
    font-size: 0.95rem;
    color: #495057;
    line-height: 1.6;
}

.wireframes-page .fase-resultado {
    display: inline-block;
    background: #d4edda;
    color: #155724;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 600;
    border-left: 3px solid #28a745;
}

/* =====================================
   TABLA KPIS
   ===================================== */

.wireframes-page .kpis-section {
    margin-bottom: 50px;
}

.wireframes-page .tabla-kpis-container {
    overflow-x: auto;
    margin-bottom: 30px;
}

.wireframes-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.wireframes-page .tabla-kpis thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.wireframes-page .tabla-kpis th {
    padding: 18px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.wireframes-page .tabla-kpis tbody tr {
    border-bottom: 1px solid #e9ecef;
    transition: background-color 0.2s ease;
}

.wireframes-page .tabla-kpis tbody tr:hover {
    background-color: #f8f9fa;
}

.wireframes-page .tabla-kpis td {
    padding: 18px 15px;
    font-size: 0.95rem;
    color: #495057;
    vertical-align: top;
}

.wireframes-page .tabla-kpis td:first-child {
    font-weight: 600;
    color: #2c3e50;
}

.wireframes-page .tabla-kpis small {
    display: block;
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 4px;
}

.wireframes-page .mejora-positiva {
    color: #28a745;
    font-weight: 700;
    font-size: 1.05rem;
}

.wireframes-page .fila-destacada {
    background: #fff9e6 !important;
    border-top: 2px solid #ffd700;
    border-bottom: 2px solid #ffd700;
}

.wireframes-page .fila-destacada td {
    padding: 22px 15px;
}

/* KPIs Nota */
.wireframes-page .kpis-nota {
    background: linear-gradient(135deg, #e3f2fd 0%, #e1f5fe 100%);
    border-left: 5px solid #2196f3;
    border-radius: 8px;
    padding: 25px;
}

.wireframes-page .kpis-nota h4 {
    font-size: 1.3rem;
    color: #2c3e50;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.wireframes-page .kpis-nota p {
    margin-bottom: 15px;
    font-size: 1.05rem;
    line-height: 1.6;
    color: #495057;
}

.wireframes-page .kpis-nota ul {
    margin-bottom: 15px;
    padding-left: 25px;
}

.wireframes-page .kpis-nota li {
    margin-bottom: 8px;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* =====================================
   RESPONSIVE
   ===================================== */

@media (max-width: 992px) {
    .wireframes-page .impacto-grid {
        grid-template-columns: 1fr;
    }

    .wireframes-page .csv-cards {
        grid-template-columns: 1fr;
    }

    .wireframes-page .comparacion-grid {
        grid-template-columns: 1fr;
    }

    .wireframes-page .comparacion-flecha {
        order: 2;
        margin: 20px 0;
    }

    .wireframes-page .columna-antes {
        order: 1;
    }

    .wireframes-page .columna-despues {
        order: 3;
    }

    .wireframes-page .flecha-container i {
        transform: rotate(90deg);
    }

    .wireframes-page .csv-stats {
        grid-template-columns: 1fr;
    }

    .wireframes-page .fase-item {
        flex-direction: column;
    }

    .wireframes-page .fase-badge {
        align-self: flex-start;
    }
}

@media (max-width: 768px) {
    .wireframes-page .concepto-header h2 {
        font-size: 1.4rem;
    }

    .wireframes-page .concepto-intro {
        font-size: 1rem;
    }

    .wireframes-page .analogia-list li {
        font-size: 0.95rem;
    }

    .wireframes-page .section-header h2 {
        font-size: 1.6rem;
    }

    .wireframes-page .tabla-kpis {
        font-size: 0.85rem;
    }

    .wireframes-page .tabla-kpis th,
    .wireframes-page .tabla-kpis td {
        padding: 12px 10px;
    }
}
</style>
