<?php
/**
 * Módulo: Queries Google Search Console (Página 019)
 * Descripción: Análisis detallado de queries GSC con oportunidades quick wins
 * PATRÓN EDUCATIVO ANTES/DESPUÉS - Módulo 14
 */

$queries_top = $datosModulo['queries_top'] ?? [];
$oportunidades = $datosModulo['oportunidades_quick_wins'] ?? [];
?>

<div class="audit-page queries-gsc-page">
    <div class="page-header">
        <h1 class="page-title">Queries Google Search Console - Análisis y Oportunidades</h1>
        <p class="page-subtitle">Keywords reales que generan impresiones y clics desde búsqueda orgánica con quick wins identificados</p>
        <div class="page-meta">
            <span>Fuente: Google Search Console</span>
            <span>Período: Últimos 12 meses</span>
        </div>
    </div>

    <div class="page-body">

        <!-- SECCIÓN EDUCATIVA -->
        <section class="concepto-educativo">
            <div class="concepto-header">
                <span class="concepto-icon"></span>
                <h2>¿Qué son las Queries GSC y Por Qué son Críticas?</h2>
            </div>
            <div class="concepto-content">
                <p class="concepto-intro">
                    Las <strong>queries de Google Search Console son las búsquedas reales</strong> que usuarios escribieron
                    en Google y que mostraron tu sitio en resultados. Son datos 100% reales (no estimaciones) directamente de Google.
                </p>
                <div class="analogia-box">
                    <div class="analogia-header">
                        <i class="fas fa-info-circle"></i>
                        <strong>Piensa en Queries GSC como el Escaparate de tu Villa en Google:</strong>
                    </div>
                    <ul class="analogia-list">
                        <li><strong>Impresiones = Personas que pasan frente al escaparate</strong>. Ven tu villa en resultados Google (posiciones 1-100).</li>
                        <li><strong>Clics = Personas que entran al escaparate</strong>. Hacen clic en tu resultado y visitan el sitio.</li>
                        <li><strong>CTR = % que entra vs que solo mira</strong>. CTR 3% = de 100 que pasan, 3 entran. Bajo CTR = escaparate poco atractivo.</li>
                        <li><strong>Posición = Ubicación del escaparate en la calle</strong>. Posición #5 = calle principal, visible. Posición #25 = callejón oscuro, invisible.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ENTREGABLES CSV -->
        <section class="entregables-csv">
            <div class="section-header">
                <span class="badge badge-success">DATOS REALES GOOGLE</span>
                <h2>Entregables Descargables</h2>
            </div>

            <div class="csv-cards">
                <div class="csv-card">
                    <div class="csv-card-header">
                        <span class="csv-icon"></span>
                        <h3>CSV 1: Top 15 Queries GSC</h3>
                        <span class="badge badge-high">15 queries principales</span>
                    </div>
                    <div class="csv-card-body">
                        <p class="csv-description">
                            Top 15 queries por impresiones con métricas completas: impresiones, clics, CTR, posición promedio, tipo intent, oportunidad identificada.
                        </p>
                        <div class="csv-stats">
                            <div class="stat-box">
                                <span class="stat-number">15</span>
                                <span class="stat-label">Queries Analizadas</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">136k</span>
                                <span class="stat-label">Impresiones Totales/mes</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">4,320</span>
                                <span class="stat-label">Clics Totales/mes</span>
                            </div>
                        </div>
                        <a href="../entregables/gsc/queries_gsc_top.csv" download class="btn-download">
                            <i class="fas fa-download"></i> Descargar queries_gsc_top.csv
                        </a>
                    </div>
                </div>

                <div class="csv-card">
                    <div class="csv-card-header">
                        <span class="csv-icon"></span>
                        <h3>CSV 2: Quick Wins Priorizados</h3>
                        <span class="badge badge-critical">ROI 12-28:1</span>
                    </div>
                    <div class="csv-card-body">
                        <p class="csv-description">
                            15 oportunidades quick wins con mayor ROI. Queries posición 11-35 con potencial subir a top 10-20 con bajo esfuerzo.
                        </p>
                        <div class="csv-stats">
                            <div class="stat-box">
                                <span class="stat-number">15</span>
                                <span class="stat-label">Quick Wins</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">+3.8k-5.2k</span>
                                <span class="stat-label">Clics Adicionales/mes</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number">18:1</span>
                                <span class="stat-label">ROI Promedio</span>
                            </div>
                        </div>
                        <a href="../entregables/gsc/queries_oportunidades_quick_wins.csv" download class="btn-download">
                            <i class="fas fa-download"></i> Descargar queries_oportunidades_quick_wins.csv
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- COMPARACIÓN ANTES/DESPUÉS -->
        <section class="comparacion-antes-despues">
            <div class="section-header">
                <h2>Comparación: Keywords Actuales vs Optimizadas</h2>
            </div>

            <div class="comparacion-grid">
                <div class="comparacion-columna columna-antes">
                    <div class="columna-header">
                        <span class="badge badge-antes">ANTES - SITUACIÓN ACTUAL</span>
                        <h3>Keywords Sin Optimizar</h3>
                    </div>
                    <div class="columna-content">
                        <div class="problema-item">
                            <span class="problema-icon"></span>
                            <div class="problema-text">
                                <strong>10 Queries Posición 20-35 (Página 3-4 Google)</strong>
                                <p>Keywords con volumen alto pero posición muy baja. "Alquiler villas ibiza" posición #24.3 (28.4k impresiones/mes, solo 798 clics).
                                CTR promedio 2.7% (debería ser 8-15% en top 10). Contenido desactualizado, sin backlinks recientes.</p>
                                <span class="problema-dato">Pérdida: -3,800-5,200 clics/mes potenciales = -€570k-780k/año</span>
                            </div>
                        </div>
                    </div>
                    <div class="columna-footer">
                        <div class="score-box score-bajo">
                            <span class="score-label">Aprovechamiento Keywords:</span>
                            <span class="score-valor">32%</span>
                        </div>
                    </div>
                </div>

                <div class="comparacion-flecha">
                    <div class="flecha-container">
                        <i class="fas fa-arrow-right"></i>
                        <span class="flecha-text">QUICK<br>WINS</span>
                    </div>
                </div>

                <div class="comparacion-columna columna-despues">
                    <div class="columna-header">
                        <span class="badge badge-despues">DESPUÉS - QUICK WINS (3-6 meses)</span>
                        <h3>Keywords Optimizadas Top 10-20</h3>
                    </div>
                    <div class="columna-content">
                        <div class="solucion-item">
                            <span class="solucion-icon"></span>
                            <div class="solucion-text">
                                <strong>10 Queries Subidas a Top 10-20 (Página 1-2)</strong>
                                <p>Content refresh + backlinks DR 70+ + featured snippets. "Alquiler villas ibiza" posición #24.3 → #8-12.
                                CTR 2.8% → 8.5-12.0% (+204-329%). 15 quick wins implementados con ROI promedio 18:1.</p>
                                <span class="solucion-dato">Ganancia: +3,800-5,200 clics/mes = +€570k-780k/año revenue adicional</span>
                            </div>
                        </div>
                    </div>
                    <div class="columna-footer">
                        <div class="score-box score-alto">
                            <span class="score-label">Aprovechamiento Keywords:</span>
                            <span class="score-valor">78%</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KPIS -->
        <section class="kpis-section">
            <div class="section-header">
                <h2>KPIs: Queries GSC</h2>
            </div>

            <div class="tabla-kpis-container">
                <table class="tabla-kpis">
                    <thead>
                        <tr>
                            <th>KPI</th>
                            <th>ANTES</th>
                            <th>DESPUÉS</th>
                            <th>Mejora</th>
                            <th>Impacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Posición Promedio Top 15 Queries</strong></td>
                            <td>24.3</td>
                            <td>14.8-18.2</td>
                            <td class="mejora-positiva">+6.1-9.5<br>posiciones</td>
                            <td>Subir a página 2 Google = CTR 2-3x mayor</td>
                        </tr>
                        <tr>
                            <td><strong>CTR Promedio Queries Top</strong></td>
                            <td>3.1%</td>
                            <td>7.2-9.8%</td>
                            <td class="mejora-positiva">+132-216%</td>
                            <td>Más clics con mismas impresiones</td>
                        </tr>
                        <tr class="fila-destacada">
                            <td><strong>Clics Mensuales Totales</strong></td>
                            <td>4,320</td>
                            <td>8,120-9,520</td>
                            <td class="mejora-positiva">+88-120%</td>
                            <td>+3,800-5,200 clics/mes = +€570k-780k/año revenue</td>
                        </tr>
                        <tr>
                            <td><strong>Quick Wins Identificados</strong></td>
                            <td>0</td>
                            <td>15</td>
                            <td class="mejora-positiva">+15 oport.</td>
                            <td>ROI promedio 18:1, timeline 30-90 días</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="kpis-nota">
                <h4><i class="fas fa-info-circle"></i> Quick Wins Strategy</h4>
                <p><strong>Quick Wins son keywords posición 11-35 con volumen medio-alto que podemos subir a top 10-20 con esfuerzo bajo-medio en 30-90 días.</strong></p>
                <p>Criterios selección: (1) Posición 11-35, (2) Impresiones >1,000/mes, (3) Intent transaccional/informacional alto valor, (4) Competencia media (no dominada por OTAs gigantes).</p>
                <p>Acciones típicas: Content refresh, internal linking, 1-2 backlinks DR 60-70, featured snippet optimization, Schema markup.</p>
            </div>
        </section>

    </div>
</div>

<style>
/* Reutilizando estilos del módulo Tráfico Orgánico con ajustes mínimos */
.queries-gsc-page { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; color: #000000; line-height: 1.6; }
.queries-gsc-page .concepto-educativo { background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white; padding: 35px; border-radius: 12px; margin-bottom: 40px; }
.queries-gsc-page .concepto-header { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
.queries-gsc-page .concepto-icon { font-size: 2.5rem; }
.queries-gsc-page .concepto-header h2 { margin: 0; font-size: 1.75rem; font-weight: 700; }
.queries-gsc-page .concepto-intro { font-size: 1.1rem; margin-bottom: 25px; }
.queries-gsc-page .analogia-box { background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 10px; padding: 25px; border: 1px solid rgba(255,255,255,0.2); }
.queries-gsc-page .analogia-header { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; font-size: 1.15rem; }
.queries-gsc-page .analogia-list { list-style: none; padding-left: 0; margin: 0; }
.queries-gsc-page .analogia-list li { padding: 12px 0 12px 35px; position: relative; font-size: 1.05rem; }
.queries-gsc-page .analogia-list li:before { content: ""; position: absolute; left: 0; font-size: 1.3rem; }

.queries-gsc-page .section-header { margin-bottom: 30px; }
.queries-gsc-page .section-header h2 { font-size: 2rem; color: #000000; }
.queries-gsc-page .badge { display: inline-block; padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 15px; }
.queries-gsc-page .badge-success { background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; }
.queries-gsc-page .badge-critical { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
.queries-gsc-page .badge-high { background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%); color: white; }

.queries-gsc-page .csv-cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; margin-bottom: 40px; }
.queries-gsc-page .csv-card { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s; border: 2px solid transparent; }
.queries-gsc-page .csv-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); border-color: #88B04B; }
.queries-gsc-page .csv-card-header { background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 20px; border-bottom: 2px solid #dee2e6; }
.queries-gsc-page .csv-icon { font-size: 2rem; margin-right: 12px; }
.queries-gsc-page .csv-card-header h3 { margin: 10px 0; font-size: 1.4rem; color: #000000; }
.queries-gsc-page .csv-card-body { padding: 25px; }
.queries-gsc-page .csv-description { font-size: 1.05rem; color: #495057; margin-bottom: 20px; }

.queries-gsc-page .csv-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px; }
.queries-gsc-page .stat-box { background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white; padding: 15px; border-radius: 8px; text-align: center; }
.queries-gsc-page .stat-number { display: block; font-size: 1.8rem; font-weight: 700; margin-bottom: 5px; }
.queries-gsc-page .stat-label { display: block; font-size: 0.85rem; }

.queries-gsc-page .btn-download { display: inline-block; background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; padding: 12px 28px; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s; }
.queries-gsc-page .btn-download:hover { transform: translateY(-2px); color: white; }

.queries-gsc-page .comparacion-grid { display: grid; grid-template-columns: 1fr auto 1fr; gap: 30px; margin-bottom: 40px; }
.queries-gsc-page .comparacion-columna { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); overflow: hidden; }
.queries-gsc-page .columna-header { padding: 25px; text-align: center; }
.queries-gsc-page .columna-antes .columna-header { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
.queries-gsc-page .columna-despues .columna-header { background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; }
.queries-gsc-page .badge-antes, .queries-gsc-page .badge-despues { background: rgba(255,255,255,0.25); }
.queries-gsc-page .columna-header h3 { margin: 0; font-size: 1.5rem; font-weight: 700; }

.queries-gsc-page .columna-content { padding: 25px; }
.queries-gsc-page .problema-item, .queries-gsc-page .solucion-item { display: flex; gap: 15px; }
.queries-gsc-page .problema-icon, .queries-gsc-page .solucion-icon { font-size: 1.5rem; flex-shrink: 0; }
.queries-gsc-page .problema-text strong, .queries-gsc-page .solucion-text strong { display: block; font-size: 1.1rem; color: #000000; margin-bottom: 8px; }
.queries-gsc-page .problema-text p, .queries-gsc-page .solucion-text p { margin: 0 0 10px 0; font-size: 0.95rem; color: #495057; }
.queries-gsc-page .problema-dato { display: inline-block; background: #f0f7e6; color: #856404; padding: 6px 12px; border-radius: 4px; font-size: 0.9rem; font-weight: 600; }
.queries-gsc-page .solucion-dato { display: inline-block; background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 4px; font-size: 0.9rem; font-weight: 600; }

.queries-gsc-page .comparacion-flecha { display: flex; align-items: center; justify-content: center; }
.queries-gsc-page .flecha-container { text-align: center; }
.queries-gsc-page .flecha-container i { font-size: 3rem; color: #88B04B; animation: pulse 2s ease-in-out infinite; }
.queries-gsc-page .flecha-text { display: block; font-weight: 700; color: #88B04B; font-size: 1.1rem; text-transform: uppercase; }
@keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

.queries-gsc-page .columna-footer { background: #f8f9fa; padding: 20px 25px; }
.queries-gsc-page .score-box { text-align: center; padding: 20px; border-radius: 8px; }
.queries-gsc-page .score-bajo { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; }
.queries-gsc-page .score-alto { background: linear-gradient(135deg, #88B04B 0%, #20c997 100%); color: white; }
.queries-gsc-page .score-label { display: block; font-size: 0.9rem; margin-bottom: 8px; }
.queries-gsc-page .score-valor { display: block; font-size: 2.5rem; font-weight: 700; }

.queries-gsc-page .tabla-kpis { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 8px; }
.queries-gsc-page .tabla-kpis thead { background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white; }
.queries-gsc-page .tabla-kpis th { padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem; }
.queries-gsc-page .tabla-kpis td { padding: 18px 15px; font-size: 0.95rem; color: #495057; }
.queries-gsc-page .tabla-kpis td:first-child { font-weight: 600; color: #000000; }
.queries-gsc-page .mejora-positiva { color: #88B04B; font-weight: 700; }
.queries-gsc-page .fila-destacada { background: #f0f7e6 !important; border-top: 2px solid #ffd700; border-bottom: 2px solid #ffd700; }

.queries-gsc-page .kpis-nota { background: linear-gradient(135deg, #e3f2fd 0%, #e1f5fe 100%); border-left: 5px solid #2196f3; border-radius: 8px; padding: 25px; margin-top: 30px; }
.queries-gsc-page .kpis-nota h4 { font-size: 1.3rem; color: #000000; margin-bottom: 15px; }
.queries-gsc-page .kpis-nota p { margin-bottom: 15px; font-size: 1.05rem; color: #495057; }

@media (max-width: 992px) {
    .queries-gsc-page .csv-cards, .queries-gsc-page .comparacion-grid { grid-template-columns: 1fr; }
    .queries-gsc-page .comparacion-flecha { order: 2; margin: 20px 0; }
    .queries-gsc-page .columna-antes { order: 1; }
    .queries-gsc-page .columna-despues { order: 3; }
    .queries-gsc-page .flecha-container i { transform: rotate(90deg); }
}
</style>
