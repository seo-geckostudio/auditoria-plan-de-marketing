<?php
/**
 * Módulo 15: Core Web Vitals Detallado
 * Análisis detallado de métricas CWV (LCP, FID, CLS) con patrón educativo ANTES/DESPUÉS
 */

// Ruta base para entregables
$rutaEntregables = __DIR__ . '/../../entregables/performance/';

// Datos del módulo
$moduloData = [
    'titulo' => 'Core Web Vitals Detallado',
    'descripcion' => 'Análisis exhaustivo de métricas Core Web Vitals (LCP, FID, CLS) por tipología de página y dispositivo, con plan de optimización priorizado y estimación de impacto en negocio.',

    'csvs' => [
        [
            'archivo' => 'core_web_vitals_audit.csv',
            'titulo' => 'Auditoría Core Web Vitals por Página',
            'descripcion' => 'Análisis detallado de 14 tipologías de páginas (Home, Villas, Blog, Checkout) con métricas LCP/FID/CLS actuales vs objetivos, separado por Desktop/Mobile.',
            'registros' => 14,
            'columnas' => 13,
            'datos_clave' => [
                'Home Mobile LCP: 4.2s (FALLA, objetivo <2.5s)',
                'Checkout Mobile FID: 248ms (FALLA, objetivo <100ms)',
                'Búsqueda Mobile CLS: 0.58 (FALLA CRÍTICA, objetivo <0.1)',
                '10 de 14 páginas FALLAN en Mobile',
                'Pérdida estimada: €680k-960k/año por CWV malos'
            ],
            'uso' => 'Identificar páginas críticas con peor rendimiento CWV para priorizar optimización. Páginas transaccionales (Checkout, Villas) tienen mayor impacto económico.'
        ],
        [
            'archivo' => 'core_web_vitals_optimization_plan.csv',
            'titulo' => 'Plan de Optimización CWV (15 acciones)',
            'descripcion' => 'Plan priorizado de 15 optimizaciones técnicas con impacto CWV cuantificado, esfuerzo, timeline, ROI estimado, y pasos implementación detallados.',
            'registros' => 15,
            'columnas' => 13,
            'datos_clave' => [
                'Optimizar Hero Home: LCP 4.2s → 1.8s mobile (-57%, ROI 25:1)',
                'Mobile-First Images: LCP -1.2-1.8s (-35-45%, ROI 30:1)',
                'Fix CLS Checkout: 0.44 → 0.06 (-86%, ROI 40:1)',
                'Reducir JS Checkout: FID 248ms → 65ms (-74%, ROI 50:1)',
                'Revenue adicional potencial: €42M-63M/año'
            ],
            'uso' => 'Seguir plan paso a paso. Prioridad Crítica primero (6 optimizaciones), luego Muy Alta (5), luego Alta/Media. Cada optimización incluye pasos técnicos detallados y herramientas necesarias.'
        ]
    ],

    'kpis' => [
        ['metrica' => 'LCP Home Mobile', 'antes' => '4.2s', 'despues' => '1.8s', 'mejora' => '-57%', 'impacto' => 'Bounce rate -15pp = +3,360 sesiones/mes'],
        ['metrica' => 'FID Checkout Mobile', 'antes' => '248ms', 'despues' => '65ms', 'mejora' => '-74%', 'impacto' => 'Abandono -12pp = +€10.4M-15.6M/año'],
        ['metrica' => 'CLS Búsqueda Mobile', 'antes' => '0.58', 'despues' => '0.08', 'mejora' => '-86%', 'impacto' => 'Abandono búsqueda -10pp = +580 sess/mes'],
        ['metrica' => 'Páginas Aprobadas CWV', 'antes' => '4/14 (29%)', 'despues' => '13/14 (93%)', 'mejora' => '+221%', 'impacto' => 'Search Console Core Web Vitals: Good URLs >75%'],
        ['metrica' => 'PageSpeed Score Mobile', 'antes' => '52/100', 'despues' => '88-92/100', 'mejora' => '+69-77%', 'impacto' => 'Rankings +2-4 posiciones promedio'],
        ['metrica' => 'Revenue Protegido/Año', 'antes' => 'Pérdida €680k-960k', 'despues' => 'Ganancia €42M-63M', 'mejora' => '+∞', 'impacto' => 'Optimización CWV = ROI 28:1 promedio', 'destacada' => true]
    ]
];
?>

<div class="core-web-vitals-page">
    <!-- Título del Módulo -->
    <div class="modulo-header">
        <h1><?= $moduloData['titulo'] ?></h1>
        <p class="descripcion"><?= $moduloData['descripcion'] ?></p>
    </div>

    <!-- Sección Educativa: ¿Qué son Core Web Vitals? -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="icono-concepto">⚡</span>
            <h2>¿Qué son Core Web Vitals? (Explicación Simple)</h2>
        </div>

        <div class="analogia-box">
            <div class="analogia-header">
                <span class="analogia-icon">💡</span>
                <strong>Piensa en Core Web Vitals como la Velocidad de Servicio en un Restaurante de Lujo:</strong>
            </div>
            <ul class="analogia-list">
                <li><strong>LCP (Largest Contentful Paint) = Tiempo que tarda el plato principal</strong>. El cliente pide, ¿cuánto tarda en llegar? Si tarda >4s = cliente impaciente se va. Objetivo: <2.5s.</li>
                <li><strong>FID (First Input Delay) = Tiempo que tarda el camarero en responder</strong>. Cliente llama al camarero, ¿cuánto tarda en atender? >300ms = cliente frustrado. Objetivo: <100ms.</li>
                <li><strong>CLS (Cumulative Layout Shift) = Platos/vasos moviéndose en la mesa</strong>. Layout que salta = experiencia caótica, cliente derrama vino. Objetivo: <0.1.</li>
            </ul>
            <p class="concepto-explicacion">
                <strong>En Ibiza Villa:</strong> Usuario móvil busca villa → Hero tarda 4.2s (LCP FALLA) → intenta hacer clic pero botón se mueve (CLS 0.31) → frustra y cierra página = pierdes reserva €3,000-15,000.
            </p>
        </div>

        <div class="impacto-negocio">
            <h3>¿Por Qué CWV Son Críticos para Ibiza Villa?</h3>
            <div class="impacto-grid">
                <div class="impacto-item">
                    <div class="impacto-numero">58%</div>
                    <div class="impacto-texto">Tráfico desde Mobile (22.4k usuarios/mes)</div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-numero">-28%</div>
                    <div class="impacto-texto">Bounce Rate adicional si LCP >4s mobile</div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-numero">€680k-960k</div>
                    <div class="impacto-texto">Pérdida anual actual por CWV malos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resumen Ejecutivo ANTES -->
    <section class="resumen-ejecutivo">
        <div class="badge-seccion badge-antes">🔍 ANTES - SITUACIÓN ACTUAL</div>
        <h2>Resumen Ejecutivo: Core Web Vitals Ibiza Villa</h2>

        <div class="situacion-actual">
            <h3>Problemas Críticos Detectados:</h3>
            <ul class="problemas-lista">
                <li><strong>Home Mobile LCP 4.2s</strong> (objetivo <2.5s, FALLA -68%): Hero image 1.2MB sin optimizar, bounce rate +28%</li>
                <li><strong>Checkout Mobile FID 248ms</strong> (objetivo <100ms, FALLA -148%): JavaScript bloqueante 520KB, abandono checkout +12pp = pérdida €10.4M-15.6M/año</li>
                <li><strong>Búsqueda Mobile CLS 0.58</strong> (objetivo <0.1, FALLA -480%): Layout completo cambia al cargar resultados, abandono 72%</li>
                <li><strong>10 de 14 páginas FALLAN Mobile</strong> (71% falla rate): Solo 4 aprobadas (Blog, Contacto), críticas transaccionales todas fallan</li>
                <li><strong>PageSpeed Score Mobile 52/100</strong>: Por debajo mínimo recomendado (75+), impacta rankings negativamente</li>
            </ul>
        </div>
    </section>

    <!-- Entregables CSV -->
    <section class="entregables-seccion">
        <div class="badge-seccion badge-despues">📊 DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN</div>
        <h2>Entregables CSV Descargables</h2>

        <div class="csv-grid">
            <?php foreach ($moduloData['csvs'] as $csv): ?>
            <div class="csv-card">
                <div class="csv-header">
                    <span class="csv-icon">📄</span>
                    <h3><?= $csv['titulo'] ?></h3>
                </div>
                <p class="csv-descripcion"><?= $csv['descripcion'] ?></p>

                <div class="csv-stats">
                    <div class="stat-item">
                        <span class="stat-numero"><?= $csv['registros'] ?></span>
                        <span class="stat-label">Registros</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-numero"><?= $csv['columnas'] ?></span>
                        <span class="stat-label">Columnas</span>
                    </div>
                </div>

                <div class="datos-clave">
                    <strong>Datos Clave:</strong>
                    <ul>
                        <?php foreach ($csv['datos_clave'] as $dato): ?>
                        <li><?= $dato ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="uso-recomendado">
                    <strong>Cómo Usar:</strong>
                    <p><?= $csv['uso'] ?></p>
                </div>

                <a href="<?= $rutaEntregables . $csv['archivo'] ?>" class="btn-descargar" download>
                    ⬇️ Descargar CSV
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="instrucciones-uso">
            <h3>📋 Instrucciones de Uso:</h3>
            <ol>
                <li><strong>Descarga ambos CSVs</strong> y ábrelos en Excel/Google Sheets</li>
                <li><strong>Auditoría CWV:</strong> Identifica páginas con estado "Falla" (10 páginas críticas)</li>
                <li><strong>Prioriza por impacto negocio:</strong> Checkout/Villas/Búsqueda tienen mayor revenue potencial</li>
                <li><strong>Plan Optimización:</strong> Implementa 6 optimizaciones Prioridad Crítica primero (ROI 25-50:1)</li>
                <li><strong>Sigue pasos implementación:</strong> Cada optimización tiene 5 pasos técnicos detallados</li>
                <li><strong>Valida con herramientas:</strong> PageSpeed Insights, Search Console, Chrome DevTools</li>
                <li><strong>Monitoreo continuo:</strong> Test CWV cada 2 semanas, track mejoras en Search Console</li>
            </ol>
        </div>
    </section>

    <!-- Comparación ANTES vs DESPUÉS -->
    <section class="comparacion-antes-despues">
        <h2>Comparación: ANTES vs DESPUÉS</h2>

        <div class="comparacion-grid">
            <div class="columna-antes">
                <div class="columna-header antes">❌ ANTES</div>
                <h3>Situación Actual CWV</h3>
                <ul class="lista-problemas">
                    <li><strong>LCP Home Mobile: 4.2s</strong> (FALLA -68% objetivo)</li>
                    <li><strong>FID Checkout: 248ms</strong> (FALLA -148% objetivo)</li>
                    <li><strong>CLS Búsqueda: 0.58</strong> (FALLA -480% objetivo)</li>
                    <li><strong>10/14 páginas FALLAN Mobile</strong> (71% falla rate)</li>
                    <li><strong>Hero 1.2MB sin WebP</strong>, tarda 4.2s mobile</li>
                    <li><strong>JavaScript bloqueante 520KB</strong>, FID masivo</li>
                    <li><strong>Pérdida: €680k-960k/año</strong> por CWV malos</li>
                </ul>
            </div>

            <div class="flecha-transformacion">
                <div class="flecha-contenido">⚡</div>
                <div class="flecha-texto">OPTIMIZACIÓN CWV</div>
            </div>

            <div class="columna-despues">
                <div class="columna-header despues">✅ DESPUÉS</div>
                <h3>Resultado Optimización (3-4 meses)</h3>
                <ul class="lista-mejoras">
                    <li><strong>LCP Home Mobile: 1.8s</strong> (-57%, APROBADO <2.5s)</li>
                    <li><strong>FID Checkout: 65ms</strong> (-74%, APROBADO <100ms)</li>
                    <li><strong>CLS Búsqueda: 0.08</strong> (-86%, APROBADO <0.1)</li>
                    <li><strong>13/14 páginas APROBADAS</strong> (93% aprobación)</li>
                    <li><strong>Hero WebP 300KB</strong>, carga 1.8s mobile</li>
                    <li><strong>JavaScript async/defer</strong>, FID <100ms</li>
                    <li><strong>Ganancia: €42M-63M/año</strong> revenue adicional</li>
                </ul>
            </div>
        </div>

        <div class="timeline-implementacion">
            <h3>Timeline Implementación CWV:</h3>
            <div class="timeline-items">
                <div class="timeline-item"><span class="badge-tiempo">Semanas 1-3</span> Quick Wins (Hero WebP, Dimensiones, Lazy Load) → +25-30% mejora</div>
                <div class="timeline-item"><span class="badge-tiempo">Mes 1-2</span> JavaScript Optimization (Code splitting, Defer) → +35-45% mejora</div>
                <div class="timeline-item"><span class="badge-tiempo">Mes 2-3</span> Mobile-First Images + CDN → +15-20% mejora adicional</div>
                <div class="timeline-item"><span class="badge-tiempo">Mes 3-4</span> Consolidación + Monitoreo → 93% páginas aprobadas CWV</div>
            </div>
        </div>
    </section>

    <!-- Tabla de KPIs -->
    <section class="kpis-seccion">
        <div class="badge-seccion badge-despues">📈 DESPUÉS - RESULTADOS ESPERADOS</div>
        <h2>KPIs Core Web Vitals: Impacto Cuantificado</h2>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th>Métrica CWV</th>
                    <th>ANTES (Actual)</th>
                    <th>DESPUÉS (3-4 meses)</th>
                    <th>Mejora %</th>
                    <th>Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($moduloData['kpis'] as $kpi): ?>
                <tr<?= isset($kpi['destacada']) ? ' class="fila-destacada"' : '' ?>>
                    <td><strong><?= $kpi['metrica'] ?></strong></td>
                    <td><?= $kpi['antes'] ?></td>
                    <td><?= $kpi['despues'] ?></td>
                    <td class="mejora-positiva"><?= $kpi['mejora'] ?></td>
                    <td><?= $kpi['impacto'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="nota-importante">
            <strong>⚠️ Nota Importante:</strong> Core Web Vitals son factor ranking oficial Google desde 2021 (Page Experience Update).
            Sitios con CWV buenos reciben boost +2-4 posiciones promedio en keywords competitivas.
            Mobile-first indexing = CWV Mobile son CRÍTICOS (58% tráfico desde mobile).
            Optimización CWV = Mejora UX + Rankings + Conversión simultáneamente (efecto triple).
        </div>
    </section>
</div>

<style>
.core-web-vitals-page {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    line-height: 1.6;
    color: #2c3e50;
}

/* Sección educativa */
.concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.icono-concepto {
    font-size: 48px;
}

.analogia-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 25px;
    border-radius: 8px;
    margin: 20px 0;
}

.analogia-list {
    list-style: none;
    padding-left: 0;
}

.analogia-list li {
    padding: 12px 0;
    padding-left: 30px;
    position: relative;
}

.analogia-list li::before {
    content: "⚡";
    position: absolute;
    left: 0;
    font-size: 20px;
}

.impacto-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-top: 25px;
}

.impacto-item {
    text-align: center;
    padding: 20px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
}

.impacto-numero {
    font-size: 36px;
    font-weight: bold;
    color: #ffd700;
}

/* CSV Cards */
.csv-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin: 30px 0;
}

.csv-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 25px;
    transition: all 0.3s ease;
}

.csv-card:hover {
    border-color: #88B04B;
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
}

.btn-descargar {
    display: block;
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    margin-top: 20px;
    transition: transform 0.2s;
}

.btn-descargar:hover {
    transform: scale(1.05);
}

/* Comparación ANTES/DESPUÉS */
.comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    margin: 30px 0;
}

.columna-antes, .columna-despues {
    padding: 25px;
    border-radius: 12px;
}

.columna-antes {
    background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%);
    border-left: 5px solid #dc3545;
}

.columna-despues {
    background: linear-gradient(135deg, #f0fff4 0%, #d4f4dd 100%);
    border-left: 5px solid #28a745;
}

.flecha-transformacion {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Tabla KPIs */
.tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    background: white;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.tabla-kpis th, .tabla-kpis td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.fila-destacada {
    background: linear-gradient(135deg, #fff9e6 0%, #ffe6cc 100%);
    border-left: 4px solid #ffd700;
    font-weight: bold;
}

.mejora-positiva {
    color: #28a745;
    font-weight: bold;
}

@media (max-width: 992px) {
    .comparacion-grid {
        grid-template-columns: 1fr;
    }

    .flecha-transformacion {
        transform: rotate(90deg);
        margin: 20px 0;
    }

    .csv-grid, .impacto-grid {
        grid-template-columns: 1fr;
    }
}
</style>
