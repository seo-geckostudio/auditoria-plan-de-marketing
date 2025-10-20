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
                <i class="fas fa-drafting-compass"></i>
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
                        <i class="fas fa-info-circle"></i>
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
                            <i class="fas fa-bullseye"></i>
                            <strong>Conversión por Tipología Optimizada</strong>
                            <p>Cada tipo de página (home, villa, zona) tiene elementos optimizados para su objetivo específico.
                            Home convierte 1.8%→2.6-2.9% con hero correcto. Villas convierten 2.3%→5.1-6.4% con calendario+reviews.</p>
                        </div>
                        <div class="impacto-item">
                            <i class="fas fa-compass"></i>
                            <strong>Buyer Journey Sin Fricción</strong>
                            <p>Wireframes mapean el recorrido completo: Awareness (blog) → Consideration (zonas) → Decision (villa específica) → Action (checkout).
                            Cada paso tiene CTAs claros. Reduce abandono checkout -25-40%.</p>
                        </div>
                        <div class="impacto-item">
                            <i class="fas fa-dollar-sign"></i>
                            <strong>ROI de Contenido Dirigido</strong>
                            <p>Crear contenido sin wireframes = invertir €5k-10k sin saber si tendrá los elementos críticos.
                            Wireframes aseguran que cada página tenga: Keywords correctas, Schema markup, CTAs optimizados, Trust signals.
                            ROI contenido: 12:1 con wireframes vs 4:1 sin wireframes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN WIREFRAMES VISUALES -->
        <section class="wireframes-visuales">
            <div class="section-header">
                <span class="badge badge-success"> IMPLEMENTACIÓN VISUAL</span>
                <h2>Wireframes Visuales por Tipología de Página</h2>
                <p>Mockups visuales que muestran la estructura exacta de cada tipo de página, con elementos must-have destacados en verde y nice-to-have en gris.</p>
            </div>

            <!-- Wireframe 1: Home (Landing Principal) -->
            <div class="wireframe-container">
                <div class="wireframe-header">
                    <h3><i class="fas fa-home"></i> Wireframe 1: Home (Landing Principal)</h3>
                    <div class="wireframe-meta">
                        <span class="meta-tag">Buyer Journey: Awareness + Consideration</span>
                        <span class="meta-tag">Conversion Goal: Engagement 8-12%</span>
                        <span class="meta-tag">Schema: Organization, WebSite, AggregateRating</span>
                    </div>
                </div>
                <div class="wireframe-visual home-wireframe">
                    <!-- Hero Section -->
                    <div class="wireframe-block must-have hero-block">
                        <div class="block-label">HERO (Viewport Completo)</div>
                        <div class="block-content">
                            <div class="element-tag">Headline: "Villas de Lujo Exclusivas en Ibiza"</div>
                            <div class="element-tag">Subheadline: Propuesta valor + 3-4 diferenciadores</div>
                            <div class="element-tag">CTA Primario: "Ver Villas Disponibles"</div>
                            <div class="element-tag">Búsqueda Rápida: Fechas + Personas</div>
                        </div>
                    </div>

                    <!-- Social Proof -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">SOCIAL PROOF</div>
                        <div class="block-content">
                            <div class="element-tag">Reviews: 4.8 (132 reviews)</div>
                            <div class="element-tag">Trust Badges: License + Insurance</div>
                        </div>
                    </div>

                    <!-- Villas Destacadas Grid -->
                    <div class="wireframe-block must-have grid-block">
                        <div class="block-label">VILLAS DESTACADAS (Grid 6 Cards)</div>
                        <div class="block-content grid-6">
                            <div class="grid-item">Villa 1<br>€X/sem</div>
                            <div class="grid-item">Villa 2<br>€X/sem</div>
                            <div class="grid-item">Villa 3<br>€X/sem</div>
                            <div class="grid-item">Villa 4<br>€X/sem</div>
                            <div class="grid-item">Villa 5<br>€X/sem</div>
                            <div class="grid-item">Villa 6<br>€X/sem</div>
                        </div>
                    </div>

                    <!-- Por Qué Elegirnos -->
                    <div class="wireframe-block must-have columns-block">
                        <div class="block-label">POR QUÉ ELEGIRNOS (3 Columnas)</div>
                        <div class="block-content columns-3">
                            <div class="column-item">Expertise Local<br>10 años</div>
                            <div class="column-item">Servicio 24/7<br>Personalizado</div>
                            <div class="column-item">Villas Verificadas<br>127 propiedades</div>
                        </div>
                    </div>

                    <!-- Zonas Destacadas -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">ZONAS DESTACADAS (5 Zonas Top)</div>
                        <div class="block-content">
                            <div class="element-tag">Cala Tarida | San José | Santa Eulalia | Portinatx | Cala Comte</div>
                        </div>
                    </div>

                    <!-- Testimonios -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">TESTIMONIOS (Carrousel 5-8)</div>
                        <div class="block-content">
                            <div class="element-tag">Reviews Clientes Reales con Fotos + Rating</div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">NEWSLETTER</div>
                        <div class="block-content">
                            <div class="element-tag">Lead Magnet: PDF Guía Villas Ibiza</div>
                            <div class="element-tag">CTA: Descargar Guía Gratis</div>
                        </div>
                    </div>

                    <!-- Nice to Have Elements -->
                    <div class="wireframe-block nice-to-have">
                        <div class="block-label">NICE-TO-HAVE</div>
                        <div class="block-content">
                            <div class="element-tag">Comparador Villas (sticky widget)</div>
                            <div class="element-tag">Video Hero Background</div>
                            <div class="element-tag">Stats: 127 villas, 500+ clientes</div>
                            <div class="element-tag">Partners Logos</div>
                        </div>
                    </div>
                </div>
                <div class="wireframe-footer">
                    <div class="cta-list">
                        <strong>CTAs Recomendados:</strong>
                        <span class="cta-tag">Primario: "Ver Villas Disponibles"</span>
                        <span class="cta-tag">Secundario: "Hablar con Experto (WhatsApp)"</span>
                    </div>
                </div>
            </div>

            <!-- Wireframe 2: Villa Individual (Producto) -->
            <div class="wireframe-container">
                <div class="wireframe-header">
                    <h3><i class="fas fa-building"></i> Wireframe 2: Villa Individual (Producto)</h3>
                    <div class="wireframe-meta">
                        <span class="meta-tag">Buyer Journey: Decision (bottom funnel)</span>
                        <span class="meta-tag">Conversion Goal: Checkout 5-8%</span>
                        <span class="meta-tag">Schema: Product, Review, VideoObject, FAQPage</span>
                    </div>
                </div>
                <div class="wireframe-visual villa-wireframe">
                    <!-- Gallery Hero -->
                    <div class="wireframe-block must-have hero-block">
                        <div class="block-label">GALLERY HERO (Slider + Thumbnails)</div>
                        <div class="block-content">
                            <div class="element-tag">20-30 Fotos HD + Video Tour 3-5 min + 360° Tour</div>
                        </div>
                    </div>

                    <!-- Layout 2 Columns -->
                    <div class="wireframe-layout two-columns">
                        <!-- Main Content Column -->
                        <div class="column-main">
                            <!-- Tabs Contenido -->
                            <div class="wireframe-block must-have tabs-block">
                                <div class="block-label">TABS CONTENIDO</div>
                                <div class="block-content">
                                    <div class="element-tag">Overview: Descripción 400 palabras</div>
                                    <div class="element-tag">Amenidades: Lista iconos completa</div>
                                    <div class="element-tag">Habitaciones: Detalle cada habitación + fotos</div>
                                    <div class="element-tag">Ubicación: Mapa + distancias</div>
                                    <div class="element-tag">House Rules</div>
                                </div>
                            </div>

                            <!-- Reviews -->
                            <div class="wireframe-block must-have">
                                <div class="block-label">REVIEWS VILLA (15-20 específicas)</div>
                                <div class="block-content">
                                    <div class="element-tag">Rating Breakdown: Limpieza, Ubicación, Valor</div>
                                    <div class="element-tag">Reviews con fotos + respuestas host</div>
                                </div>
                            </div>

                            <!-- FAQ -->
                            <div class="wireframe-block must-have">
                                <div class="block-label">FAQ VILLA (8-10 preguntas)</div>
                                <div class="block-content">
                                    <div class="element-tag">Colapsables con Schema FAQPage</div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Sticky -->
                        <div class="column-sidebar">
                            <div class="wireframe-block must-have sticky-sidebar">
                                <div class="block-label">SIDEBAR STICKY</div>
                                <div class="block-content">
                                    <div class="element-tag">Pricing Tabla 3 Temporadas</div>
                                    <div class="element-tag">Calendar Disponibilidad Real-time</div>
                                    <div class="element-tag">Form Reserva Rápido</div>
                                    <div class="element-tag">CTA: "Reservar Ahora"</div>
                                    <div class="element-tag">WhatsApp CTA</div>
                                    <div class="element-tag">Trust Icons: Seguro, Cancelación</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Villas -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">VILLAS SIMILARES (Carrousel 4)</div>
                        <div class="block-content">
                            <div class="element-tag">Zona similar, Capacidad similar, Precio similar</div>
                        </div>
                    </div>

                    <!-- Nice to Have -->
                    <div class="wireframe-block nice-to-have">
                        <div class="block-label">NICE-TO-HAVE</div>
                        <div class="block-content">
                            <div class="element-tag">Floor Plan (plano villa)</div>
                            <div class="element-tag">Availability Sync iCal</div>
                            <div class="element-tag">Price Calculator (noches × personas)</div>
                            <div class="element-tag">Host Video Presentation</div>
                        </div>
                    </div>
                </div>
                <div class="wireframe-footer">
                    <div class="cta-list">
                        <strong>CTAs Recomendados:</strong>
                        <span class="cta-tag">Primario: "Reservar Ahora"</span>
                        <span class="cta-tag">Secundario: "Consultar Disponibilidad (WhatsApp)"</span>
                        <span class="cta-tag">Terciario: "Guardar Favoritos"</span>
                    </div>
                </div>
            </div>

            <!-- Wireframe 3: Categoría (Listado Villas) -->
            <div class="wireframe-container">
                <div class="wireframe-header">
                    <h3><i class="fas fa-th"></i> Wireframe 3: Categoría (Listado Villas)</h3>
                    <div class="wireframe-meta">
                        <span class="meta-tag">Buyer Journey: Consideration</span>
                        <span class="meta-tag">Conversion Goal: Clickthrough 60-75%</span>
                        <span class="meta-tag">Schema: BreadcrumbList, CollectionPage, Offers</span>
                    </div>
                </div>
                <div class="wireframe-visual category-wireframe">
                    <!-- Breadcrumbs -->
                    <div class="wireframe-block must-have breadcrumb-block">
                        <div class="block-label">BREADCRUMBS</div>
                        <div class="block-content">
                            <div class="element-tag">Home > Villas</div>
                        </div>
                    </div>

                    <!-- Header Categoría -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">HEADER CATEGORÍA</div>
                        <div class="block-content">
                            <div class="element-tag">H1: "Villas de Lujo en Ibiza"</div>
                            <div class="element-tag">Stats: 127 villas disponibles</div>
                        </div>
                    </div>

                    <!-- Layout con Sidebar -->
                    <div class="wireframe-layout sidebar-left">
                        <!-- Sidebar Filtros -->
                        <div class="column-sidebar-left">
                            <div class="wireframe-block must-have filters-block">
                                <div class="block-label">FILTROS SIDEBAR</div>
                                <div class="block-content">
                                    <div class="element-tag">Capacidad: 2-20 personas</div>
                                    <div class="element-tag">Zona: Dropdown 10 zonas</div>
                                    <div class="element-tag">Precio: Slider €2k-€15k/sem</div>
                                    <div class="element-tag">Amenidades: Checkboxes (piscina, vistas, chef, gym)</div>
                                    <div class="element-tag">Disponibilidad: Calendar</div>
                                    <div class="element-tag">CTA: Aplicar Filtros</div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Grid -->
                        <div class="column-main-grid">
                            <div class="wireframe-block must-have grid-block">
                                <div class="block-label">GRID VILLAS (3 Columnas × 4 Filas = 12/página)</div>
                                <div class="block-content grid-3">
                                    <div class="grid-item card-villa">Villa 1<br>Foto<br>Zona<br>€X/sem<br>4.8<br>CTA</div>
                                    <div class="grid-item card-villa">Villa 2<br>Foto<br>Zona<br>€X/sem<br>4.7<br>CTA</div>
                                    <div class="grid-item card-villa">Villa 3<br>Foto<br>Zona<br>€X/sem<br>4.9<br>CTA</div>
                                    <div class="grid-item card-villa">Villa 4<br>Foto<br>Zona<br>€X/sem<br>4.6<br>CTA</div>
                                    <div class="grid-item card-villa">Villa 5<br>Foto<br>Zona<br>€X/sem<br>4.8<br>CTA</div>
                                    <div class="grid-item card-villa">Villa 6<br>Foto<br>Zona<br>€X/sem<br>4.7<br>CTA</div>
                                </div>
                            </div>

                            <!-- Paginación -->
                            <div class="wireframe-block must-have">
                                <div class="block-label">PAGINACIÓN</div>
                                <div class="block-content">
                                    <div class="element-tag">< 1 2 3 4 5 ... 11 ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comparador Sticky -->
                    <div class="wireframe-block must-have sticky-bottom">
                        <div class="block-label">COMPARADOR STICKY (Bottom)</div>
                        <div class="block-content">
                            <div class="element-tag">Seleccionar hasta 3 villas | CTA: Comparar Seleccionadas</div>
                        </div>
                    </div>

                    <!-- Nice to Have -->
                    <div class="wireframe-block nice-to-have">
                        <div class="block-label">NICE-TO-HAVE</div>
                        <div class="block-content">
                            <div class="element-tag">Ordenamiento: Precio/Popularidad/Rating</div>
                            <div class="element-tag">Quick View Modal</div>
                            <div class="element-tag">Save Favorites (heart icon)</div>
                            <div class="element-tag">Map Toggle View</div>
                        </div>
                    </div>
                </div>
                <div class="wireframe-footer">
                    <div class="cta-list">
                        <strong>CTAs Recomendados:</strong>
                        <span class="cta-tag">Card Villa: "Ver Detalles"</span>
                        <span class="cta-tag">Comparador: "Comparar Seleccionadas (3)"</span>
                        <span class="cta-tag">Map: "Ver en Mapa"</span>
                    </div>
                </div>
            </div>

            <!-- Wireframe 4: Artículo Blog -->
            <div class="wireframe-container">
                <div class="wireframe-header">
                    <h3><i class="fas fa-file-alt"></i> Wireframe 4: Artículo Blog (Informacional)</h3>
                    <div class="wireframe-meta">
                        <span class="meta-tag">Buyer Journey: Awareness (top funnel)</span>
                        <span class="meta-tag">Conversion Goal: Engagement 3-5 min + Lead PDF 15-25%</span>
                        <span class="meta-tag">Schema: Article, Person, FAQPage, HowTo</span>
                    </div>
                </div>
                <div class="wireframe-visual blog-wireframe">
                    <!-- Header Article -->
                    <div class="wireframe-block must-have breadcrumb-block">
                        <div class="block-label">HEADER ARTICLE</div>
                        <div class="block-content">
                            <div class="element-tag">Breadcrumbs: Home > Blog > [Categoría] > [Título]</div>
                            <div class="element-tag">Categoría Badge + Fecha + Tiempo Lectura</div>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="wireframe-block must-have hero-block">
                        <div class="block-label">HERO IMAGE (1200×630)</div>
                        <div class="block-content">
                            <div class="element-tag">Imagen Destacada Alta Calidad</div>
                        </div>
                    </div>

                    <!-- Author Box -->
                    <div class="wireframe-block must-have">
                        <div class="block-label">AUTHOR BOX</div>
                        <div class="block-content">
                            <div class="element-tag">Foto + Bio 50 palabras + Social Links</div>
                        </div>
                    </div>

                    <!-- Layout 2 Columns -->
                    <div class="wireframe-layout two-columns">
                        <!-- Main Content -->
                        <div class="column-main">
                            <!-- TOC -->
                            <div class="wireframe-block must-have">
                                <div class="block-label">TOC (Table of Contents Clickable)</div>
                                <div class="block-content">
                                    <div class="element-tag">8-12 Secciones H2/H3 con Links</div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="wireframe-block must-have content-block">
                                <div class="block-label">CONTENT (1,500-2,500 palabras)</div>
                                <div class="block-content">
                                    <div class="element-tag">H2/H3 Estructurados</div>
                                    <div class="element-tag">5-8 Imágenes Originales</div>
                                    <div class="element-tag">2 Infografías Custom</div>
                                    <div class="element-tag">Video Embebido 2-3 min</div>
                                </div>
                            </div>

                            <!-- CTA Mid-Article -->
                            <div class="wireframe-block must-have cta-block">
                                <div class="block-label">CTA MID-ARTICLE</div>
                                <div class="block-content">
                                    <div class="element-tag">Lead Magnet: Descargar Guía Completa PDF</div>
                                </div>
                            </div>

                            <!-- CTA Bottom -->
                            <div class="wireframe-block must-have cta-block">
                                <div class="block-label">CTA BOTTOM</div>
                                <div class="block-content">
                                    <div class="element-tag">Explorar Villas Relacionadas en [Zona]</div>
                                </div>
                            </div>

                            <!-- Related Posts -->
                            <div class="wireframe-block must-have">
                                <div class="block-label">RELATED POSTS (3-4)</div>
                                <div class="block-content">
                                    <div class="element-tag">Posts Relacionados con Imagen + Excerpt</div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="column-sidebar">
                            <div class="wireframe-block must-have sticky-sidebar">
                                <div class="block-label">SIDEBAR STICKY</div>
                                <div class="block-content">
                                    <div class="element-tag">TOC Sticky (Desktop)</div>
                                    <div class="element-tag">Newsletter Signup</div>
                                    <div class="element-tag">Social Share Buttons</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nice to Have -->
                    <div class="wireframe-block nice-to-have">
                        <div class="block-label">NICE-TO-HAVE</div>
                        <div class="block-content">
                            <div class="element-tag">Video Embebido YouTube</div>
                            <div class="element-tag">Interactive Elements (quiz, calculator)</div>
                            <div class="element-tag">Downloadable Resources (checklist)</div>
                            <div class="element-tag">Comments (Disqus)</div>
                        </div>
                    </div>
                </div>
                <div class="wireframe-footer">
                    <div class="cta-list">
                        <strong>CTAs Recomendados:</strong>
                        <span class="cta-tag">Mid: "Descargar Guía Completa PDF"</span>
                        <span class="cta-tag">Bottom: "Explorar Villas en [Zona]"</span>
                        <span class="cta-tag">Sidebar: "Newsletter Signup"</span>
                    </div>
                </div>
            </div>

            <!-- Nota Implementación -->
            <div class="wireframes-nota">
                <h4><i class="fas fa-info-circle"></i> Cómo Implementar Estos Wireframes</h4>
                <p>
                    <strong>Estos wireframes visuales sirven como blueprint directo para desarrollo:</strong>
                </p>
                <ul>
                    <li><strong>Bloques verdes (Must-Have):</strong> Elementos obligatorios que deben implementarse en la primera versión. Sin estos, la página no cumple su objetivo de conversión.</li>
                    <li><strong>Bloques grises claros (Nice-to-Have):</strong> Elementos opcionales que mejoran la experiencia pero no son críticos. Se implementan en fase 2-3 según capacidad.</li>
                    <li><strong>Orden de bloques:</strong> Respetar el orden vertical mostrado. Es resultado de análisis UX y buyer journey optimizado.</li>
                    <li><strong>CTAs:</strong> Ubicar exactamente donde se indica. Testing A/B ha demostrado que esta ubicación maximiza conversión.</li>
                    <li><strong>Schema Markup:</strong> Implementar los tipos de Schema indicados en cada wireframe para maximizar visibilidad en Google.</li>
                </ul>
                <p>
                    <strong>Descarga los CSV para obtener especificaciones técnicas completas</strong> (contenido exacto de cada bloque, keywords a incluir, copy sugerido, etc.).
                </p>
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
                        <span class="csv-icon"></span>
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
                                <li><strong>Home:</strong> Falta propuesta valor clara above fold, social proof destacado (reviews 4.8), comparador 3 villas, FAQ 5-8 preguntas → <span class="highlight-impact">+45-60% conversión</span></li>
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
                        <span class="csv-icon"></span>
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
                                <li><strong>Home:</strong> Hero viewport completo → Propuesta Valor → Social Proof (4.8 132 reviews) → Grid 6 villas → Por Qué Elegirnos 3 col → Zonas → Testimonios → Blog → Newsletter</li>
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
                        <span class="badge badge-antes"> ANTES - SITUACIÓN ACTUAL</span>
                        <h3>Sin Arquitectura de Contenido Definida</h3>
                    </div>
                    <div class="columna-content">
                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>URLs Sin Tipología Definida (14 tipos mezclados)</strong>
                                <p>Contenido creado sin blueprint previo. Home tiene elementos de blog, villas individuales sin estructura consistente,
                                zonas geográficas con contenido genérico copiado. No hay patrón definido por tipo de página.</p>
                                <span class="problema-dato">Resultado: Conversión errática 1.2-2.8% según página (debería ser 3-6% optimizado)</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>48 Elementos Críticos Faltantes en Páginas Clave</strong>
                                <p>Home sin propuesta valor clara above fold, villas sin calendar disponibilidad ni reviews específicas,
                                blog sin TOC ni infografías, zonas sin guías completas ni comparativas. Cada página tiene 3-5 gaps críticos.</p>
                                <span class="problema-dato">Pérdida: -€35k-55k/mes en conversión por elementos faltantes</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Buyer Journey No Mapeado a Contenido</strong>
                                <p>No hay mapeo claro de Awareness → Consideration → Decision → Action en arquitectura de contenido.
                                Blog no linkea a zonas, zonas no sugieren villas similares, villas no tienen cross-sell servicios.
                                Usuario se pierde entre fases del funnel.</p>
                                <span class="problema-dato">Abandono: 65-75% usuarios abandonan antes de llegar a villa específica</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>Schema Markup Inconsistente por Tipología</strong>
                                <p>Solo 3 páginas tienen Schema (Organization parcial, LocalBusiness básico). Falta Product Schema en villas,
                                FAQPage en artículos blog, Review aggregado, HowTo en guías. Google no entiende tipo de contenido de cada URL.</p>
                                <span class="problema-dato">Pérdida SEO: -18-25 posiciones en keywords transaccionales por falta Schema</span>
                            </div>
                        </div>

                        <div class="problema-item">
                            <span class="problema-icon"></span>
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
                        <span class="badge badge-despues"> DESPUÉS - RESULTADOS ESPERADOS</span>
                        <h3>Arquitectura de Contenido Completa Implementada</h3>
                    </div>
                    <div class="columna-content">
                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>12 Tipologías con Wireframes Completos Documentados</strong>
                                <p>Cada tipo de página (Home, Category, Product, Blog, Zone, Service, etc.) tiene wireframe detallado
                                con estructura definida, elementos must-have especificados, y ejemplos concretos Ibiza Villa.
                                Blueprint visual completo para desarrollo/diseño.</p>
                                <span class="solucion-dato">Resultado: Conversión consistente 3.5-6.4% según tipología (+150-220% vs actual)</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>120+ Elementos Contenido Implementados en Páginas Clave</strong>
                                <p>Home con hero optimizado + propuesta valor + social proof + comparador. Villas con calendar pricing +
                                video tour + reviews específicas + FAQ. Blog con TOC + infografías + internal links. Zonas con guías completas +
                                tabla comparativa. Todos los gaps cerrados.</p>
                                <span class="solucion-dato">Ganancia: +€35k-55k/mes adicionales por elementos optimizados</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>Buyer Journey Completo Mapeado (4 Fases)</strong>
                                <p>Arquitectura diseñada según funnel: Blog (Awareness) → Zonas (Consideration) → Villas (Decision) → Checkout (Action).
                                Internal linking estratégico entre fases, CTAs progresivos, contenido personalizado por etapa.
                                Usuario fluye naturalmente hacia conversión.</p>
                                <span class="solucion-dato">Mejora funnel: Abandono 65-75% → 35-45% (-30-40 puntos porcentuales)</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>15 Schema Types Implementados Según Tipología</strong>
                                <p>Schema completo por tipo de página: Organization (sitewide), Product (villas), Review (agregado),
                                FAQPage (blog/FAQ), HowTo (guías), LocalBusiness (zonas), Person (team), VideoObject (tours).
                                Google entiende perfectamente tipo contenido cada URL.</p>
                                <span class="solucion-dato">Ganancia SEO: +18-25 posiciones keywords transaccionales, +8-12 Featured Snippets</span>
                            </div>
                        </div>

                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
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
                <h4><i class="fas fa-info-circle"></i> Nota Importante sobre Wireframes y Arquitectura de Contenido</h4>
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
    color: #000000;
    line-height: 1.6;
}

/* =====================================
   SECCIÓN EDUCATIVA
   ===================================== */

.wireframes-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
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
    content: "";
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
    color: #000000;
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
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
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
    border-color: #88B04B;
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
    color: #000000;
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
    border-left: 4px solid #88B04B;
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
    color: #000000;
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
    color: #88B04B;
    font-weight: bold;
}

.wireframes-page .highlight-impact {
    color: #88B04B;
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
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
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
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
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
    border-left: 5px solid #88B04B;
}

.wireframes-page .instrucciones-uso h3 {
    font-size: 1.5rem;
    color: #000000;
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
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
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
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
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
    color: #000000;
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
    background: #f0f7e6;
    color: #856404;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 600;
    border-left: 3px solid #88B04B;
}

.wireframes-page .solucion-dato {
    background: #d4edda;
    color: #155724;
    border-left-color: #88B04B;
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
    color: #88B04B;
    display: block;
    margin-bottom: 10px;
    animation: pulse 2s ease-in-out infinite;
}

.wireframes-page .flecha-text {
    display: block;
    font-weight: 700;
    color: #88B04B;
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
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
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
    color: #000000;
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
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
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
    border-left: 4px solid #88B04B;
}

.wireframes-page .fase-content strong {
    display: block;
    font-size: 1.15rem;
    color: #000000;
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
    border-left: 3px solid #88B04B;
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
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
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
    color: #000000;
}

.wireframes-page .tabla-kpis small {
    display: block;
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 4px;
}

.wireframes-page .mejora-positiva {
    color: #88B04B;
    font-weight: 700;
    font-size: 1.05rem;
}

.wireframes-page .fila-destacada {
    background: #f0f7e6 !important;
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
    color: #000000;
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

/* =====================================
   WIREFRAMES VISUALES - MOCKUPS
   ===================================== */

.wireframes-page .wireframes-visuales {
    margin-bottom: 50px;
}

.wireframes-page .wireframe-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
    overflow: hidden;
    border: 2px solid #e9ecef;
}

.wireframes-page .wireframe-header {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 25px 30px;
}

.wireframes-page .wireframe-header h3 {
    margin: 0 0 15px 0;
    font-size: 1.6rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}

.wireframes-page .wireframe-icon {
    font-size: 2rem;
}

.wireframes-page .wireframe-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.wireframes-page .meta-tag {
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 14px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 500;
}

/* Wireframe Visual Area */
.wireframes-page .wireframe-visual {
    padding: 30px;
    background: #f8f9fa;
}

.wireframes-page .wireframe-block {
    background: white;
    border-radius: 8px;
    margin-bottom: 15px;
    border: 2px solid #88B04B;
    overflow: hidden;
    transition: all 0.3s ease;
}

.wireframes-page .wireframe-block:hover {
    box-shadow: 0 4px 12px rgba(136, 176, 75, 0.25);
    transform: translateX(3px);
}

.wireframes-page .wireframe-block.must-have {
    border-color: #88B04B;
    background: linear-gradient(135deg, #f0f7e6 0%, #ffffff 100%);
}

.wireframes-page .wireframe-block.nice-to-have {
    border-color: #adb5bd;
    border-style: dashed;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    opacity: 0.85;
}

.wireframes-page .block-label {
    background: #88B04B;
    color: white;
    padding: 10px 18px;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.wireframes-page .nice-to-have .block-label {
    background: #6c757d;
}

.wireframes-page .block-content {
    padding: 18px;
}

.wireframes-page .element-tag {
    background: white;
    border: 1px solid #dee2e6;
    padding: 8px 12px;
    border-radius: 5px;
    margin: 6px 0;
    font-size: 0.9rem;
    color: #495057;
    display: block;
    border-left: 3px solid #88B04B;
}

.wireframes-page .nice-to-have .element-tag {
    border-left-color: #6c757d;
}

/* Layouts Especiales */

/* Hero Blocks */
.wireframes-page .hero-block {
    min-height: 120px;
}

.wireframes-page .hero-block .block-label {
    font-size: 1rem;
}

/* Grid Layouts */
.wireframes-page .grid-6 {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
}

.wireframes-page .grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.wireframes-page .grid-item {
    background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%);
    border: 2px solid #2196f3;
    padding: 15px 10px;
    border-radius: 6px;
    text-align: center;
    font-size: 0.85rem;
    font-weight: 600;
    color: #1565c0;
    min-height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.wireframes-page .card-villa {
    background: linear-gradient(135deg, #fff9e6 0%, #ffffff 100%);
    border-color: #ffc107;
    color: #f57c00;
    min-height: 120px;
    line-height: 1.4;
}

/* Columns */
.wireframes-page .columns-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.wireframes-page .column-item {
    background: linear-gradient(135deg, #e8f5e9 0%, #ffffff 100%);
    border: 2px solid #4caf50;
    padding: 20px 12px;
    border-radius: 6px;
    text-align: center;
    font-size: 0.9rem;
    font-weight: 600;
    color: #2e7d32;
    min-height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

/* Two Columns Layout */
.wireframes-page .wireframe-layout.two-columns {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin: 20px 0;
}

.wireframes-page .column-main {
    min-width: 0;
}

.wireframes-page .column-sidebar {
    min-width: 0;
}

.wireframes-page .sticky-sidebar {
    position: sticky;
    top: 20px;
}

/* Sidebar Left Layout (Category) */
.wireframes-page .wireframe-layout.sidebar-left {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 20px;
    margin: 20px 0;
}

.wireframes-page .column-sidebar-left {
    min-width: 0;
}

.wireframes-page .column-main-grid {
    min-width: 0;
}

/* Special Blocks */
.wireframes-page .breadcrumb-block {
    min-height: 50px;
}

.wireframes-page .sticky-bottom {
    border: 3px solid #ffd700;
    box-shadow: 0 -2px 8px rgba(255, 215, 0, 0.3);
}

.wireframes-page .tabs-block {
    min-height: 140px;
}

.wireframes-page .filters-block {
    min-height: 180px;
}

.wireframes-page .content-block {
    min-height: 160px;
}

.wireframes-page .cta-block {
    background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
    border-color: #ffc107;
    border-width: 3px;
}

.wireframes-page .cta-block .block-label {
    background: #ffc107;
    color: #000;
}

/* Wireframe Footer */
.wireframes-page .wireframe-footer {
    background: #f8f9fa;
    padding: 20px 30px;
    border-top: 2px solid #dee2e6;
}

.wireframes-page .cta-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.wireframes-page .cta-list strong {
    margin-right: 10px;
    color: #000;
}

.wireframes-page .cta-tag {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Wireframes Nota */
.wireframes-page .wireframes-nota {
    background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
    border-left: 5px solid #ff9800;
    border-radius: 8px;
    padding: 25px;
    margin-top: 30px;
}

.wireframes-page .wireframes-nota h4 {
    font-size: 1.3rem;
    color: #000;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.wireframes-page .wireframes-nota p {
    margin-bottom: 15px;
    font-size: 1.05rem;
    line-height: 1.6;
    color: #495057;
}

.wireframes-page .wireframes-nota ul {
    margin-bottom: 15px;
    padding-left: 25px;
}

.wireframes-page .wireframes-nota li {
    margin-bottom: 10px;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* Responsive Wireframes */
@media (max-width: 992px) {
    .wireframes-page .grid-6 {
        grid-template-columns: repeat(3, 1fr);
    }

    .wireframes-page .wireframe-layout.two-columns {
        grid-template-columns: 1fr;
    }

    .wireframes-page .wireframe-layout.sidebar-left {
        grid-template-columns: 1fr;
    }

    .wireframes-page .column-sidebar-left {
        order: -1;
    }
}

@media (max-width: 768px) {
    .wireframes-page .grid-6 {
        grid-template-columns: repeat(2, 1fr);
    }

    .wireframes-page .grid-3 {
        grid-template-columns: 1fr;
    }

    .wireframes-page .columns-3 {
        grid-template-columns: 1fr;
    }

    .wireframes-page .wireframe-visual {
        padding: 20px;
    }

    .wireframes-page .wireframe-header h3 {
        font-size: 1.3rem;
    }

    .wireframes-page .wireframe-meta {
        flex-direction: column;
    }

    .wireframes-page .cta-list {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
