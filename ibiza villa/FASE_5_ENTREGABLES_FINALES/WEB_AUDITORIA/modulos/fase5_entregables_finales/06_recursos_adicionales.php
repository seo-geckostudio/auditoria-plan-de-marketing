<!--
   RECURSOS ADICIONALES
   Documentación complementaria, herramientas y enlaces útiles
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos Adicionales - Auditoría SEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #88B04B;
            --primary-dark: #6d8f3c;
            --secondary: #2563eb;
            --accent: #f0f7e6;
        }

        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-section {
            background: white;
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 20px;
            color: #64748b;
            margin: 0;
        }

        .section-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
        }

        .section-description {
            color: #64748b;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .resource-card {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }

        .resource-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .resource-card.external .resource-icon {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }

        .resource-card.tool .resource-icon {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
        }

        .resource-card.guide .resource-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .resource-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .resource-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .resource-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .resource-link:hover {
            gap: 12px;
            color: var(--primary-dark);
        }

        .badge-tag {
            display: inline-block;
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            margin: 5px 5px 0 0;
        }

        .badge-tag.internal {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-tag.external {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-tag.free {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-tag.paid {
            background: #fee2e2;
            color: #991b1b;
        }

        .quick-access {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .quick-access h3 {
            color: #78350f;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .quick-link {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #1e293b;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        .quick-link:hover {
            border-color: var(--primary);
            transform: translateX(5px);
        }

        .quick-link i {
            color: var(--primary);
            font-size: 20px;
        }

        .quick-link-text {
            font-weight: 600;
            font-size: 15px;
        }

        @media print {
            body {
                background: white;
            }

            .resource-card {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1><i class="fas fa-book-open"></i> Recursos Adicionales</h1>
            <p>Documentación complementaria, herramientas SEO y guías prácticas para implementar las recomendaciones de esta auditoría</p>
        </div>

        <!-- Acceso Rápido a Documentos Internos -->
        <div class="quick-access">
            <h3><i class="fas fa-bolt"></i> Acceso Rápido a Documentos de Esta Auditoría</h3>
            <div class="quick-links">
                <a href="01_resumen_ejecutivo.php" class="quick-link" target="_blank">
                    <i class="fas fa-file-alt"></i>
                    <span class="quick-link-text">Resumen Ejecutivo</span>
                </a>
                <a href="02_informe_tecnico.php" class="quick-link" target="_blank">
                    <i class="fas fa-file-code"></i>
                    <span class="quick-link-text">Informe Técnico</span>
                </a>
                <a href="03_plan_accion_seo.php" class="quick-link" target="_blank">
                    <i class="fas fa-tasks"></i>
                    <span class="quick-link-text">Plan de Acción SEO</span>
                </a>
                <a href="04_sistema_mediciones.php" class="quick-link" target="_blank">
                    <i class="fas fa-chart-line"></i>
                    <span class="quick-link-text">Sistema de Mediciones</span>
                </a>
                <a href="05_gestion_tareas_post_auditoria.php" class="quick-link" target="_blank">
                    <i class="fas fa-calendar-check"></i>
                    <span class="quick-link-text">Gestión de Tareas</span>
                </a>
                <a href="00_presentacion_resultados.php" class="quick-link" target="_blank">
                    <i class="fas fa-presentation"></i>
                    <span class="quick-link-text">Presentación Resultados</span>
                </a>
            </div>
        </div>

        <!-- Documentos para Imprimir/PDF -->
        <div class="section-card">
            <h2 class="section-title">
                <i class="fas fa-file-pdf"></i>
                Exportar a PDF
            </h2>
            <p class="section-description">
                Cada documento de esta auditoría puede ser exportado a PDF. Simplemente abre el documento que desees guardar y usa <strong>Ctrl+P</strong> (Windows) o <strong>Cmd+P</strong> (Mac), luego selecciona "Guardar como PDF" como destino.
            </p>

            <div class="resource-grid">
                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fas fa-print"></i></div>
                    <div class="resource-title">Guía de Impresión Optimizada</div>
                    <div class="resource-description">
                        Todos los documentos están optimizados para impresión. Recomendamos:
                        <ul style="margin-top: 10px; color: #475569; font-size: 13px;">
                            <li>Formato: A4 Vertical</li>
                            <li>Márgenes: Por defecto</li>
                            <li>Colores: Activados (para gráficos)</li>
                            <li>Fondo: Desactivado (ahorra tinta)</li>
                        </ul>
                    </div>
                    <span class="badge-tag internal">Interno</span>
                    <span class="badge-tag free">Gratis</span>
                </div>

                <div class="resource-card">
                    <div class="resource-icon"><i class="fas fa-file-download"></i></div>
                    <div class="resource-title">Paquete Completo de Auditoría</div>
                    <div class="resource-description">
                        Si necesitas todos los documentos en PDF, puedes:
                        <ol style="margin-top: 10px; color: #475569; font-size: 13px;">
                            <li>Abrir cada documento</li>
                            <li>Ctrl+P → Guardar como PDF</li>
                            <li>Nombrarlo (ej: ibizavilla_resumen_ejecutivo.pdf)</li>
                            <li>Repetir para cada documento</li>
                        </ol>
                    </div>
                    <span class="badge-tag internal">Interno</span>
                </div>
            </div>
        </div>

        <!-- Herramientas SEO Esenciales -->
        <div class="section-card">
            <h2 class="section-title">
                <i class="fas fa-tools"></i>
                Herramientas SEO Esenciales
            </h2>
            <p class="section-description">
                Herramientas profesionales utilizadas en esta auditoría y recomendadas para el seguimiento continuo de tu estrategia SEO.
            </p>

            <div class="resource-grid">
                <div class="resource-card tool">
                    <div class="resource-icon"><i class="fab fa-google"></i></div>
                    <div class="resource-title">Google Search Console</div>
                    <div class="resource-description">
                        Herramienta gratuita de Google para monitorear el rendimiento de tu sitio en los resultados de búsqueda. Fundamental para detectar problemas de indexación.
                    </div>
                    <a href="https://search.google.com/search-console" target="_blank" class="resource-link">
                        Abrir herramienta <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card tool">
                    <div class="resource-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="resource-title">Google Analytics 4</div>
                    <div class="resource-description">
                        Plataforma de analítica web para medir tráfico, comportamiento de usuarios y conversiones. Imprescindible para medir el ROI de SEO.
                    </div>
                    <a href="https://analytics.google.com" target="_blank" class="resource-link">
                        Abrir herramienta <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card tool">
                    <div class="resource-icon"><i class="fas fa-link"></i></div>
                    <div class="resource-title">Ahrefs</div>
                    <div class="resource-description">
                        Herramienta profesional para análisis de backlinks, keyword research y análisis competitivo. Usada en esta auditoría para análisis de enlaces.
                    </div>
                    <a href="https://ahrefs.com" target="_blank" class="resource-link">
                        Abrir herramienta <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag paid">De pago</span>
                    </div>
                </div>

                <div class="resource-card tool">
                    <div class="resource-icon"><i class="fas fa-spider"></i></div>
                    <div class="resource-title">Screaming Frog SEO Spider</div>
                    <div class="resource-description">
                        Crawler desktop para auditorías técnicas SEO. Permite analizar estructura del sitio, detectar errores 404, canonicals, títulos duplicados, etc.
                    </div>
                    <a href="https://www.screamingfrog.co.uk/seo-spider/" target="_blank" class="resource-link">
                        Abrir herramienta <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag">Freemium</span>
                    </div>
                </div>

                <div class="resource-card tool">
                    <div class="resource-icon"><i class="fas fa-tachometer-alt"></i></div>
                    <div class="resource-title">PageSpeed Insights</div>
                    <div class="resource-description">
                        Herramienta de Google para medir el rendimiento y Core Web Vitals de tu sitio. Proporciona recomendaciones específicas de optimización.
                    </div>
                    <a href="https://pagespeed.web.dev" target="_blank" class="resource-link">
                        Abrir herramienta <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card tool">
                    <div class="resource-icon"><i class="fas fa-code"></i></div>
                    <div class="resource-title">Google Tag Manager</div>
                    <div class="resource-description">
                        Sistema de gestión de etiquetas para implementar GA4, eventos de conversión y píxeles de tracking sin modificar el código del sitio.
                    </div>
                    <a href="https://tagmanager.google.com" target="_blank" class="resource-link">
                        Abrir herramienta <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guías y Documentación -->
        <div class="section-card">
            <h2 class="section-title">
                <i class="fas fa-graduation-cap"></i>
                Guías y Documentación Oficial
            </h2>
            <p class="section-description">
                Recursos educativos y documentación oficial de Google y otras fuentes autorizadas para profundizar en SEO.
            </p>

            <div class="resource-grid">
                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fab fa-google"></i></div>
                    <div class="resource-title">Guía de Inicio SEO de Google</div>
                    <div class="resource-description">
                        Documentación oficial de Google sobre las mejores prácticas de SEO. Lectura esencial para entender los fundamentos.
                    </div>
                    <a href="https://developers.google.com/search/docs/fundamentals/seo-starter-guide" target="_blank" class="resource-link">
                        Leer guía <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fas fa-heartbeat"></i></div>
                    <div class="resource-title">Core Web Vitals - Web.dev</div>
                    <div class="resource-description">
                        Guía completa sobre métricas de rendimiento web: LCP, FID, CLS. Incluye tutoriales de optimización paso a paso.
                    </div>
                    <a href="https://web.dev/vitals/" target="_blank" class="resource-link">
                        Leer guía <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fas fa-sitemap"></i></div>
                    <div class="resource-title">Schema.org - Structured Data</div>
                    <div class="resource-description">
                        Documentación oficial de Schema.org sobre datos estructurados. Aprende a implementar rich snippets y mejorar la visibilidad en SERP.
                    </div>
                    <a href="https://schema.org" target="_blank" class="resource-link">
                        Visitar Schema.org <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fas fa-book"></i></div>
                    <div class="resource-title">Moz - Guía para Principiantes</div>
                    <div class="resource-description">
                        Guía completa y accesible sobre SEO, desde conceptos básicos hasta técnicas avanzadas. Actualizada regularmente.
                    </div>
                    <a href="https://moz.com/beginners-guide-to-seo" target="_blank" class="resource-link">
                        Leer guía <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="resource-title">E-E-A-T Guidelines</div>
                    <div class="resource-description">
                        Guías de Google sobre Experience, Expertise, Authoritativeness y Trustworthiness para contenido de calidad.
                    </div>
                    <a href="https://developers.google.com/search/docs/fundamentals/creating-helpful-content" target="_blank" class="resource-link">
                        Leer guía <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>

                <div class="resource-card guide">
                    <div class="resource-icon"><i class="fas fa-mobile-alt"></i></div>
                    <div class="resource-title">Mobile-First Indexing</div>
                    <div class="resource-description">
                        Documentación sobre el índice mobile-first de Google y cómo optimizar tu sitio para dispositivos móviles.
                    </div>
                    <a href="https://developers.google.com/search/mobile-sites" target="_blank" class="resource-link">
                        Leer guía <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div style="margin-top: 10px;">
                        <span class="badge-tag external">Externa</span>
                        <span class="badge-tag free">Gratis</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de Contacto y Soporte -->
        <div class="section-card" style="background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white;">
            <h2 class="section-title" style="color: white;">
                <i class="fas fa-headset"></i>
                Soporte y Consultoría
            </h2>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px;">
                ¿Necesitas ayuda para implementar las recomendaciones de esta auditoría? Nuestro equipo está disponible para consultoría continua, soporte técnico y gestión completa de proyectos SEO.
            </p>
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 20px; border-radius: 12px;">
                <p style="margin: 0 0 10px 0;"><strong>📧 Email:</strong> miguelangel@geckostudio.es</p>
                <p style="margin: 0 0 10px 0;"><strong>🌐 Web:</strong> www.geckostudio.es</p>
                <p style="margin: 0;"><strong>📞 Teléfono:</strong> +34 871 00 60 52</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
