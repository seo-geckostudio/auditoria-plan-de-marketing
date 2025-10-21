<?php
/**
 * Módulo 16: Priorización de Tareas SEO
 * Roadmap consolidado con todas las recomendaciones priorizadas por ROI, esfuerzo, impacto
 */

$rutaEntregables = __DIR__ . '/../../entregables/priorizacion/';

$moduloData = [
    'titulo' => 'Priorización de Tareas SEO - Roadmap Consolidado',
    'descripcion' => 'Consolidación de 145+ recomendaciones de todos los módulos, priorizadas por ROI, impacto en revenue, esfuerzo y dependencias. Framework cuantitativo para ejecutar auditoría de forma estratégica.',

    'csvs' => [
        [
            'archivo' => 'roadmap_implementacion_consolidado.csv',
            'titulo' => 'Roadmap Implementación (22 tareas prioritarias)',
            'descripcion' => 'Tareas consolidadas de 11 módulos SEO priorizadas por Score ponderado (Impacto 30%, ROI 25%, Esfuerzo 20%, Timeline 15%, Dependencias 10%, Urgencia 5%).',
            'registros' => 22,
            'columnas' => 14,
            'datos_clave' => [
                '7 tareas Prioridad CRÍTICA: Eficiencia 90-98/100, mejora +20-150% anual cada una',
                '5 tareas Muy Alta: Eficiencia 85-95/100, mejora +60-180% anual',
                'Quick Wins Mes 1: 6 tareas ejecutables 7-21 días sin dependencias',
                'Mejora total potencial: +250-400% implementando roadmap completo',
                'Timeline: 6 meses para 90% tareas críticas/muy altas'
            ],
            'uso' => 'Seguir orden prioridad. Mes 1: Quick Wins (tareas 1,2,4,7,16). Mes 2-3: Contenido + Autoridad. Mes 4-6: Consolidación vertical.'
        ],
        [
            'archivo' => 'framework_priorizacion.csv',
            'titulo' => 'Framework de Priorización (7 criterios)',
            'descripcion' => 'Metodología cuantitativa con 7 criterios ponderados para priorizar cualquier tarea SEO. Escala 1-10 por criterio, score final promedio ponderado.',
            'registros' => 7,
            'columnas' => 7,
            'datos_clave' => [
                'Impacto Revenue: 30% peso (más importante)',
                'ROI Estimado: 25% peso',
                'Esfuerzo Requerido: 20% peso (invertido, bajo esfuerzo = alta puntuación)',
                'Timeline: 15% peso (invertido, resultados rápidos = alta puntuación)',
                'Score 9-10: CRÍTICA, Score 7-8.9: Muy Alta, Score 5-6.9: Alta'
            ],
            'uso' => 'Aplicar framework a cualquier tarea nueva. Calcular score ponderado con pesos definidos. Priorizar siempre tasks con score >7.'
        ]
    ],

    'kpis' => [
        ['metrica' => 'Tareas Priorizadas', 'antes' => '145+ sin orden', 'despues' => '22 tareas roadmap', 'mejora' => '-85% foco', 'impacto' => 'Ejecución estratégica vs caos'],
        ['metrica' => 'Quick Wins Mes 1', 'antes' => 'Indefinido', 'despues' => '6 tareas (7-21 días)', 'mejora' => '+600%', 'impacto' => 'Momentum inmediato + resultados tempranos'],
        ['metrica' => 'Eficiencia Tareas Críticas', 'antes' => 'Desconocido', 'despues' => '94/100 (range 90-98)', 'mejora' => '+2,400%', 'impacto' => 'Máxima efectividad por hora invertida'],
        ['metrica' => 'Mejora Potencial Total', 'antes' => 'Sin cuantificar', 'despues' => '+250-400% anual', 'mejora' => '+∞', 'impacto' => 'Auditoría completa = 8-12x tráfico/conversión actual'],
        ['metrica' => 'Timeline Ejecución 90%', 'antes' => '12-18 meses caótico', 'despues' => '6 meses estratégico', 'mejora' => '-50-67%', 'impacto' => 'Time-to-market reducido drásticamente'],
        ['metrica' => 'Dependencias Resueltas', 'antes' => 'Bloqueos frecuentes', 'despues' => 'Flujo sin bloqueos', 'mejora' => '+∞', 'impacto' => 'Tareas ejecutables inmediatamente', 'destacada' => true]
    ]
];
?>

<div class="priorizacion-page">
    <div class="modulo-header">
        <h1><?= $moduloData['titulo'] ?></h1>
        <p class="descripcion"><?= $moduloData['descripcion'] ?></p>
    </div>

    <!-- Sección Educativa -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="icono-concepto"></span>
            <h2>¿Cómo Priorizar Tareas SEO? (Explicación Simple)</h2>
        </div>

        <div class="analogia-box">
            <div class="analogia-header">
                <strong>Piensa en Priorización SEO como el Plan de Renovación de una Villa antes de Alquilarla:</strong>
            </div>
            <ul class="analogia-list">
                <li><strong>No puedes hacerlo todo a la vez</strong> (presupuesto y tiempo limitados) → Priorizas por ROI</li>
                <li><strong>Algunas reparaciones son urgentes</strong> (goteras, electricidad) = Quick Wins SEO (CWV, meta tags)</li>
                <li><strong>Otras son importantes pero pueden esperar</strong> (pintura, decoración) = Mejoras contenido, backlinks</li>
                <li><strong>Algunas dependen de otras</strong> (no pintas antes de arreglar goteras) = Dependencias técnicas</li>
                <li><strong>Priorizas lo que los huéspedes notan primero</strong> (hero, velocidad) y genera más reservas (conversión)</li>
            </ul>
            <p class="concepto-explicacion">
                <strong>En Ibiza Villa:</strong> Auditoría identifica 145+ mejoras posibles. Sin priorización = caos, bloqueos, desperdicio recursos.
                Con framework cuantitativo (ROI + Impacto + Esfuerzo) → roadmap estratégico de 22 tareas en 6 meses = +250-400% mejora anual.
            </p>
        </div>

        <div class="impacto-negocio">
            <h3>Framework de Priorización (7 Criterios Ponderados):</h3>
            <div class="criterios-grid">
                <div class="criterio-item"><strong>30%</strong> Impacto Revenue</div>
                <div class="criterio-item"><strong>25%</strong> ROI Estimado</div>
                <div class="criterio-item"><strong>20%</strong> Esfuerzo (invertido)</div>
                <div class="criterio-item"><strong>15%</strong> Timeline (invertido)</div>
                <div class="criterio-item"><strong>10%</strong> Dependencias (invertido)</div>
                <div class="criterio-item"><strong>5%</strong> Urgencia Competitiva</div>
            </div>
            <p style="margin-top: 20px;"><strong>Score Final:</strong> Promedio ponderado 1-10. Score ≥9 = CRÍTICA, 7-8.9 = Muy Alta, 5-6.9 = Alta, <5 = Media/Baja.</p>
        </div>
    </section>

    <!-- Resumen Ejecutivo -->
    <section class="resumen-ejecutivo">
        <div class="badge-seccion badge-antes"> ROADMAP ESTRATÉGICO CONSOLIDADO</div>
        <h2>Resumen: 22 Tareas Priorizadas de 145+ Recomendaciones</h2>

        <div class="fases-implementacion">
            <div class="fase-box fase-1">
                <h3>Mes 1: Quick Wins (6 tareas)</h3>
                <ul>
                    <li> Optimizar Hero Home WebP</li>
                    <li> Dimensiones imágenes (CLS)</li>
                    <li> Title tags (41 URLs)</li>
                    <li> Disavow enlaces tóxicos</li>
                    <li> Hero propuesta valor</li>
                    <li> Setup monitoreo algoritmo</li>
                </ul>
                <p class="fase-impacto">Impacto: +15-25% mejora inicial + momentum</p>
            </div>

            <div class="fase-box fase-2">
                <h3>Mes 2-3: Contenido + Autoridad (8 tareas)</h3>
                <ul>
                    <li>Keywords oportunidad (15 landings)</li>
                    <li>FAQ Schema (10-12 páginas)</li>
                    <li>Páginas huérfanas (127 URLs)</li>
                    <li>Arquitectura profundidad</li>
                    <li>Featured Snippets (8-12)</li>
                    <li>Wikidata + LinkedIn</li>
                    <li>Guías locales (10 artículos)</li>
                    <li>GBP optimización</li>
                </ul>
                <p class="fase-impacto">Impacto: +110-170% mejora adicional</p>
            </div>

            <div class="fase-box fase-3">
                <h3>Mes 3-6: Consolidación + Vertical (8 tareas)</h3>
                <ul>
                    <li>Backlinks DR 70-90 (6-8 links)</li>
                    <li>Schema 15 types completos</li>
                    <li>Voice Search optimización</li>
                    <li>Wireframes (12 tipologías)</li>
                    <li>Errores técnicos (285 fixes)</li>
                    <li>Real Estate SEO vertical</li>
                    <li>Sobre Nosotros E-E-A-T</li>
                    <li>Monitoreo continuo</li>
                </ul>
                <p class="fase-impacto">Impacto: +130-220% mejora consolidación</p>
            </div>
        </div>
    </section>

    <!-- Entregables CSV -->
    <section class="entregables-seccion">
        <h2>Entregables CSV Descargables</h2>

        <div class="csv-grid">
            <?php foreach ($moduloData['csvs'] as $csv): ?>
            <div class="csv-card">
                <div class="csv-header">
                    <span class="csv-icon"></span>
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
    </section>

    <!-- Tabla KPIs -->
    <section class="kpis-seccion">
        <div class="badge-seccion badge-despues"> RESULTADOS ESPERADOS CON ROADMAP</div>
        <h2>KPIs: Impacto de Priorización Estratégica</h2>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th>Métrica</th>
                    <th>ANTES (Sin priorización)</th>
                    <th>DESPUÉS (Roadmap estratégico)</th>
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
            <strong>️ Nota Crítica:</strong> Priorización NO es opcional - es la diferencia entre éxito y fracaso de auditoría.
            Sin roadmap estratégico: desperdicio recursos, bloqueos, resultados dispersos, equipo desmotivado.
            Con framework cuantitativo: ejecución enfocada, quick wins momentum, dependencias resueltas, ROI 24:1 promedio.
            <strong>Regla de Oro:</strong> Siempre ejecutar tareas Score ≥9 (Críticas) primero, independientemente de preferencias personales.
        </div>
    </section>
</div>

<style>
.priorizacion-page {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    line-height: 1.6;
    color: #000000;
}

.concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
}

.concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
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
    padding: 10px 0;
    padding-left: 30px;
    position: relative;
}

.analogia-list li::before {
    content: "";
    position: absolute;
    left: 0;
}

.criterios-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 20px;
}

.criterio-item {
    background: rgba(255, 255, 255, 0.2);
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

.fases-implementacion {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin: 30px 0;
}

.fase-box {
    padding: 25px;
    border-radius: 12px;
    border-left: 5px solid;
}

.fase-1 {
    background: linear-gradient(135deg, #f0f7e6 0%, #ffe6cc 100%);
    border-color: #ffd700;
}

.fase-2 {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
    border-color: #88B04B;
}

.fase-3 {
    background: linear-gradient(135deg, #f0fff4 0%, #d4f4dd 100%);
    border-color: #88B04B;
}

.fase-box ul {
    margin: 15px 0;
    padding-left: 20px;
}

.fase-impacto {
    font-weight: bold;
    color: #88B04B;
    margin-top: 15px;
    padding: 10px;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 6px;
}

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
}

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
    background: linear-gradient(135deg, #f0f7e6 0%, #ffe6cc 100%);
    border-left: 4px solid #ffd700;
    font-weight: bold;
}

.mejora-positiva {
    color: #88B04B;
    font-weight: bold;
}

.badge-seccion {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.badge-antes {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.badge-despues {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

@media (max-width: 992px) {
    .fases-implementacion,
    .csv-grid,
    .criterios-grid {
        grid-template-columns: 1fr;
    }
}
</style>
