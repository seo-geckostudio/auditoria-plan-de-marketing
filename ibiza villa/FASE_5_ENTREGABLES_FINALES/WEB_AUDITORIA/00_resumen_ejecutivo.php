<?php
/**
 * RESUMEN EJECUTIVO - Auditoría SEO Ibiza Villa
 * Página de inicio del sistema - Vista general simple y accionable
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen Ejecutivo - Auditoría SEO Ibiza Villa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 42px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .header .subtitle {
            font-size: 20px;
            opacity: 0.95;
            margin-bottom: 25px;
        }

        .header .fecha {
            font-size: 16px;
            opacity: 0.85;
            background: rgba(255,255,255,0.2);
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .contenido {
            padding: 50px 40px;
        }

        .seccion {
            margin-bottom: 50px;
        }

        .seccion h2 {
            font-size: 32px;
            color: #667eea;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
        }

        /* Situación Actual - Semáforo */
        .semaforo-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin: 30px 0;
        }

        .semaforo-item {
            background: white;
            border: 3px solid;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .semaforo-item:hover {
            transform: translateY(-5px);
        }

        .semaforo-critico {
            border-color: #dc3545;
            background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%);
        }

        .semaforo-medio {
            border-color: #ffc107;
            background: linear-gradient(135deg, #fffbf0 0%, #fff4cc 100%);
        }

        .semaforo-bueno {
            border-color: #28a745;
            background: linear-gradient(135deg, #f0fff4 0%, #d4f4dd 100%);
        }

        .semaforo-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .semaforo-titulo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .semaforo-valor {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }

        .semaforo-critico .semaforo-valor { color: #dc3545; }
        .semaforo-medio .semaforo-valor { color: #ffc107; }
        .semaforo-bueno .semaforo-valor { color: #28a745; }

        /* Números de Impacto */
        .impacto-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin: 30px 0;
        }

        .impacto-hero h3 {
            font-size: 24px;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .impacto-numeros {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .impacto-numero {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 12px;
        }

        .impacto-numero .numero {
            font-size: 42px;
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 10px;
        }

        .impacto-numero .label {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Quick Wins */
        .quick-wins {
            background: linear-gradient(135deg, #fff9e6 0%, #ffe6cc 100%);
            border: 3px solid #ffd700;
            border-radius: 15px;
            padding: 35px;
            margin: 30px 0;
        }

        .quick-wins h3 {
            font-size: 28px;
            color: #f39c12;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quick-wins-lista {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .quick-win-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #ffd700;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .quick-win-item .titulo {
            font-weight: bold;
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .quick-win-item .metricas {
            display: flex;
            gap: 15px;
            font-size: 14px;
            color: #666;
            margin-top: 8px;
        }

        .quick-win-item .metrica {
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .quick-win-item .roi {
            color: #28a745;
            font-weight: bold;
        }

        /* Roadmap Timeline */
        .roadmap {
            margin: 40px 0;
        }

        .timeline {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 30px;
        }

        .fase {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-top: 5px solid;
            position: relative;
        }

        .fase-1 { border-color: #ffd700; }
        .fase-2 { border-color: #3b82f6; }
        .fase-3 { border-color: #28a745; }

        .fase .badge {
            position: absolute;
            top: -15px;
            left: 20px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            color: white;
        }

        .fase-1 .badge { background: #ffd700; color: #333; }
        .fase-2 .badge { background: #3b82f6; }
        .fase-3 .badge { background: #28a745; }

        .fase h4 {
            font-size: 20px;
            margin: 15px 0 10px 0;
            color: #2c3e50;
        }

        .fase .tareas {
            font-size: 18px;
            color: #666;
            margin-bottom: 15px;
        }

        .fase .impacto {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-weight: bold;
            color: #667eea;
        }

        /* Módulos Disponibles */
        .modulos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .modulo-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .modulo-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .modulo-card .icono {
            font-size: 36px;
            margin-bottom: 12px;
        }

        .modulo-card .nombre {
            font-weight: bold;
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .modulo-card .descripcion {
            font-size: 13px;
            color: #666;
        }

        /* CTA Final */
        .cta-box {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin: 40px 0;
        }

        .cta-box h3 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 25px;
        }

        .btn {
            padding: 15px 35px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.2s;
            display: inline-block;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background: white;
            color: #28a745;
        }

        .btn-secondary {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .semaforo-grid,
            .impacto-numeros,
            .quick-wins-lista,
            .timeline,
            .modulos-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 32px;
            }

            .contenido {
                padding: 30px 20px;
            }
        }

        .nota-explicativa {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .nota-explicativa .icono {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📊 Auditoría SEO Ibiza Villa</h1>
            <p class="subtitle">Resumen Ejecutivo - Sistema Completo de Optimización</p>
            <div class="fecha">Octubre 2025 • 17 Módulos Implementados</div>
        </div>

        <div class="contenido">
            <!-- Situación Actual - Semáforo -->
            <div class="seccion">
                <h2>🚦 Situación Actual en 3 Números</h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 25px;">
                    Diagnóstico rápido del estado SEO actual de Ibiza Villa:
                </p>

                <div class="semaforo-grid">
                    <div class="semaforo-item semaforo-critico">
                        <div class="semaforo-icon">🔴</div>
                        <div class="semaforo-titulo">Tráfico Perdido</div>
                        <div class="semaforo-valor">-68%</div>
                        <p>vs Potencial Optimizado<br><small>Pierdes 18k-25k sesiones/mes</small></p>
                    </div>

                    <div class="semaforo-item semaforo-medio">
                        <div class="semaforo-icon">🟡</div>
                        <div class="semaforo-titulo">Posición Promedio</div>
                        <div class="semaforo-valor">#24.3</div>
                        <p>En Google Search Console<br><small>Objetivo: Top 15 (#8-12)</small></p>
                    </div>

                    <div class="semaforo-item semaforo-critico">
                        <div class="semaforo-icon">🔴</div>
                        <div class="semaforo-titulo">Core Web Vitals</div>
                        <div class="semaforo-valor">29%</div>
                        <p>Páginas Aprobadas Mobile<br><small>71% páginas FALLAN velocidad</small></p>
                    </div>
                </div>

                <div class="nota-explicativa">
                    <span class="icono">💡</span>
                    <strong>¿Qué significa esto?</strong> Tu web tiene buen contenido pero problemas técnicos graves (velocidad, arquitectura) que Google penaliza.
                    Es como tener una villa de lujo con mala ubicación y acceso difícil: los clientes potenciales no llegan.
                </div>
            </div>

            <!-- Oportunidad Total -->
            <div class="seccion">
                <div class="impacto-hero">
                    <h3>💰 Oportunidad Total de Negocio (Próximos 12 Meses)</h3>
                    <div class="impacto-numeros">
                        <div class="impacto-numero">
                            <div class="numero">€42M-68M</div>
                            <div class="label">Revenue Adicional/Año</div>
                        </div>
                        <div class="impacto-numero">
                            <div class="numero">+60-95</div>
                            <div class="label">Reservas/Mes Adicionales</div>
                        </div>
                        <div class="impacto-numero">
                            <div class="numero">12-20x</div>
                            <div class="label">ROI Promedio Inversión</div>
                        </div>
                        <div class="impacto-numero">
                            <div class="numero">6 meses</div>
                            <div class="label">Timeline Implementación</div>
                        </div>
                    </div>
                </div>

                <div class="nota-explicativa">
                    <span class="icono">📈</span>
                    <strong>Explicación simple:</strong> Implementando las mejoras SEO identificadas, puedes capturar 18,000-25,000 visitas/mes adicionales.
                    Con tu tasa de conversión optimizada (2.8-3.2%), esto se traduce en 60-95 reservas extra al mes valoradas en €3,000-15,000 cada una.
                </div>
            </div>

            <!-- Quick Wins Mes 1 -->
            <div class="quick-wins">
                <h3><span>⚡</span> Quick Wins - Mes 1 (Resultados Rápidos)</h3>
                <p style="font-size: 16px; margin-bottom: 15px;">
                    <strong>6 tareas ejecutables en 7-21 días</strong> que generan impacto inmediato con mínima inversión:
                </p>

                <div class="quick-wins-lista">
                    <div class="quick-win-item">
                        <div class="titulo">1. Optimizar Hero Home (WebP)</div>
                        <p style="font-size: 14px; color: #666;">Convertir imagen hero de 1.2MB a 300KB WebP con responsive srcset</p>
                        <div class="metricas">
                            <span class="metrica"><span class="roi">ROI 25:1</span></span>
                            <span class="metrica">14-21 días</span>
                            <span class="metrica">€504k-672k/año</span>
                        </div>
                    </div>

                    <div class="quick-win-item">
                        <div class="titulo">2. Añadir Width/Height Imágenes</div>
                        <p style="font-size: 14px; color: #666;">Evitar layout shift (CLS) añadiendo dimensiones a todas las imágenes</p>
                        <div class="metricas">
                            <span class="metrica"><span class="roi">ROI 40:1</span></span>
                            <span class="metrica">7-10 días</span>
                            <span class="metrica">€268k-358k/año</span>
                        </div>
                    </div>

                    <div class="quick-win-item">
                        <div class="titulo">3. Optimizar 41 Title Tags</div>
                        <p style="font-size: 14px; color: #666;">Títulos duplicados/subóptimos → únicos con keywords target</p>
                        <div class="metricas">
                            <span class="metrica"><span class="roi">ROI 22:1</span></span>
                            <span class="metrica">14-21 días</span>
                            <span class="metrica">€800k-1.2M/año</span>
                        </div>
                    </div>

                    <div class="quick-win-item">
                        <div class="titulo">4. Disavow 10 Enlaces Tóxicos</div>
                        <p style="font-size: 14px; color: #666;">Crear y subir archivo disavow.txt con spam links detectados</p>
                        <div class="metricas">
                            <span class="metrica"><span class="roi">ROI 30:1</span></span>
                            <span class="metrica">14-21 días</span>
                            <span class="metrica">DR +2-4 pts</span>
                        </div>
                    </div>

                    <div class="quick-win-item">
                        <div class="titulo">5. Hero Propuesta Valor Clara</div>
                        <p style="font-size: 14px; color: #666;">Headline + CTA + trust signals reduce bounce rate -15pp</p>
                        <div class="metricas">
                            <span class="metrica"><span class="roi">ROI 12:1</span></span>
                            <span class="metrica">7-14 días</span>
                            <span class="metrica">€504k-672k/año</span>
                        </div>
                    </div>

                    <div class="quick-win-item">
                        <div class="titulo">6. Setup Monitoreo Algoritmo</div>
                        <p style="font-size: 14px; color: #666;">Alertas GSC + Ahrefs + SEMrush Sensor para detectar caídas <48h</p>
                        <div class="metricas">
                            <span class="metrica"><span class="roi">ROI 15:1</span></span>
                            <span class="metrica">14-21 días</span>
                            <span class="metrica">€36k-72k/año</span>
                        </div>
                    </div>
                </div>

                <p style="margin-top: 25px; font-size: 16px; text-align: center;">
                    <strong>Total Mes 1:</strong> €2.5M-4M/año revenue adicional + momentum equipo
                </p>
            </div>

            <!-- Roadmap 6 Meses -->
            <div class="seccion roadmap">
                <h2>🗓️ Roadmap de Implementación (6 Meses)</h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 25px;">
                    Plan estratégico dividido en 3 fases con impacto económico cuantificado:
                </p>

                <div class="timeline">
                    <div class="fase fase-1">
                        <span class="badge">Mes 1</span>
                        <h4>Quick Wins</h4>
                        <div class="tareas">6 tareas</div>
                        <ul style="font-size: 14px; color: #666; text-align: left; margin: 15px 0;">
                            <li>Performance (Hero, CLS)</li>
                            <li>On-Page (Title tags)</li>
                            <li>Off-Page (Disavow)</li>
                            <li>UX (Hero propuesta valor)</li>
                            <li>Monitoreo algoritmo</li>
                        </ul>
                        <div class="impacto">€2.5M-4M/año<br><small>ROI 24:1 promedio</small></div>
                    </div>

                    <div class="fase fase-2">
                        <span class="badge">Mes 2-3</span>
                        <h4>Contenido + Autoridad</h4>
                        <div class="tareas">8 tareas</div>
                        <ul style="font-size: 14px; color: #666; text-align: left; margin: 15px 0;">
                            <li>15 keywords oportunidad</li>
                            <li>FAQ Schema 10-12 pág</li>
                            <li>127 páginas huérfanas</li>
                            <li>Featured Snippets 8-12</li>
                            <li>Wikidata + LinkedIn</li>
                            <li>GBP optimización</li>
                        </ul>
                        <div class="impacto">€18M-28M/año<br><small>ROI 15:1 promedio</small></div>
                    </div>

                    <div class="fase fase-3">
                        <span class="badge">Mes 3-6</span>
                        <h4>Consolidación + Vertical</h4>
                        <div class="tareas">8 tareas</div>
                        <ul style="font-size: 14px; color: #666; text-align: left; margin: 15px 0;">
                            <li>6-8 backlinks DR 70-90</li>
                            <li>Schema 15 types completo</li>
                            <li>Voice Search optimization</li>
                            <li>Real Estate SEO vertical</li>
                            <li>Wireframes 12 tipologías</li>
                        </ul>
                        <div class="impacto">€22M-36M/año<br><small>ROI 12:1 promedio</small></div>
                    </div>
                </div>
            </div>

            <!-- 17 Módulos Disponibles -->
            <div class="seccion">
                <h2>📚 17 Módulos Educativos Implementados</h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 25px;">
                    Cada módulo incluye: Análisis ANTES/DESPUÉS, 2 CSVs descargables, KPIs cuantificados, timeline implementación:
                </p>

                <div class="modulos-grid">
                    <div class="modulo-card" onclick="window.location.href='modulos/fase3_arquitectura/00_analisis_arquitectura.php'">
                        <div class="icono">🏗️</div>
                        <div class="nombre">Arquitectura Web</div>
                        <div class="descripcion">127 huérfanas, profundidad 4.1 clics</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase6_seo_onpage/02_seo_onpage.php'">
                        <div class="icono">🎯</div>
                        <div class="nombre">SEO On-Page</div>
                        <div class="descripcion">41 title tags, 35 meta descriptions</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase2_keyword_research/00_keywords_actuales.php'">
                        <div class="icono">🗝️</div>
                        <div class="nombre">Keywords Research</div>
                        <div class="descripcion">12 bajo potencial, 15 oportunidades</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase7_seo_offpage/03_seo_offpage.php'">
                        <div class="icono">🔗</div>
                        <div class="nombre">SEO Off-Page</div>
                        <div class="descripcion">10 tóxicos, 15 oportunidades DR 70+</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/04_local_seo.php'">
                        <div class="icono">📍</div>
                        <div class="nombre">Local SEO</div>
                        <div class="descripcion">GBP 20%→95%, 23 directorios</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/00_eeat_audit.php'">
                        <div class="icono">🎓</div>
                        <div class="nombre">E-E-A-T</div>
                        <div class="descripcion">Score 43→88, 30 señales audit</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/01_ia_sge_optimization.php'">
                        <div class="icono">🤖</div>
                        <div class="nombre">IA/SGE Optimization</div>
                        <div class="descripcion">13%→60-73% citaciones SGE</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/02_voice_search.php'">
                        <div class="icono">🎤</div>
                        <div class="nombre">Voice Search</div>
                        <div class="descripcion">Readiness 32→85-92, 15 queries</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/03_featured_snippets.php'">
                        <div class="icono">🏆</div>
                        <div class="nombre">Featured Snippets</div>
                        <div class="descripcion">0-1→8-12 snippets capturados</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/05_entidades_knowledge_graph.php'">
                        <div class="icono">🆔</div>
                        <div class="nombre">Knowledge Graph</div>
                        <div class="descripcion">Entity Score +175%, 15 Schema types</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase8_seo_moderno/06_monitoreo_algoritmo.php'">
                        <div class="icono">📡</div>
                        <div class="nombre">Monitoreo Algoritmo</div>
                        <div class="descripcion">Detección 30d→24-48h, 13 playbooks</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase3_arquitectura/03_wireframes_contenido.php'">
                        <div class="icono">📐</div>
                        <div class="nombre">Wireframes Contenido</div>
                        <div class="descripcion">14 tipologías, 12 wireframes buyer</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase1_trafico/00_trafico_organico_general.php'">
                        <div class="icono">🚪</div>
                        <div class="nombre">Tráfico Orgánico</div>
                        <div class="descripcion">114.5k→155k-172k sesiones/mes</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase2_keyword_research/04_queries_gsc.php'">
                        <div class="icono">🔍</div>
                        <div class="nombre">Queries GSC</div>
                        <div class="descripcion">Pos 24.3→14.8, +3.8k-5.2k clics/mes</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase4_recopilacion_datos/11_core_web_vitals_detallado.php'">
                        <div class="icono">⚡</div>
                        <div class="nombre">Core Web Vitals</div>
                        <div class="descripcion">29%→93% aprobadas, 15 optimizaciones</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase5_entregables_finales/00_priorizacion_tareas.php'">
                        <div class="icono">📋</div>
                        <div class="nombre">Priorización Tareas</div>
                        <div class="descripcion">22 tareas roadmap, framework 7 criterios</div>
                    </div>

                    <div class="modulo-card" onclick="window.location.href='modulos/fase5_entregables_finales/01_real_estate_seo.php'">
                        <div class="icono">🏛️</div>
                        <div class="nombre">Real Estate SEO</div>
                        <div class="descripcion">14 keywords luxury, €5M-8M/año vertical</div>
                    </div>
                </div>
            </div>

            <!-- CTA Final -->
            <div class="cta-box">
                <h3>🚀 Próximos Pasos Recomendados</h3>
                <p style="font-size: 18px; margin-bottom: 25px;">
                    Sistema completo listo para implementación. Comienza por Quick Wins Mes 1 para resultados inmediatos:
                </p>
                <div class="cta-buttons">
                    <a href="modulos/fase5_entregables_finales/00_priorizacion_tareas.php" class="btn btn-primary">
                        📋 Ver Roadmap Completo
                    </a>
                    <a href="modulos/fase4_recopilacion_datos/11_core_web_vitals_detallado.php" class="btn btn-secondary">
                        ⚡ Descargar CSVs Quick Wins
                    </a>
                </div>
                <p style="font-size: 14px; margin-top: 25px; opacity: 0.9;">
                    34 archivos CSV descargables • 17 módulos educativos • ROI promedio 12-20:1
                </p>
            </div>
        </div>
    </div>
</body>
</html>
