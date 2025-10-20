<?php
/**
 * Módulo: Keywords Actuales (m2.1)
 * Fase: 2 - Keyword Research
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$metricas = $datosModulo['metricas_principales'] ?? [];
$evolucion = $datosModulo['evolucion_temporal'] ?? [];
$topKeywords = $datosModulo['top_keywords'] ?? [];
$distribucion = $datosModulo['distribucion_posiciones'] ?? [];
$categorias = $datosModulo['keywords_por_categoria'] ?? [];
$competitividad = $datosModulo['analisis_competitividad'] ?? [];
$conclusiones = $datosModulo['conclusiones'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<!-- SECCIÓN EDUCATIVA: ¿Qué es Keyword Research? -->
<div class="audit-page keywords-educativo">
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon"></span>
            <h2>¿Qué es el Keyword Research y Por Qué Determinará el Éxito de Tu Negocio?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                El Keyword Research es el proceso de identificar las palabras exactas que tus clientes potenciales
                escriben en Google cuando buscan villas de lujo en Ibiza. No se trata solo de "tener keywords",
                sino de elegir LAS CORRECTAS que atraigan clientes que realmente reserven.
            </p>
            <div class="analogia-box">
                <div class="analogia-header">
                    <i class="fas fa-info-circle"></i>
                    <strong>Piensa en el Keyword Research como un mapa del tesoro:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>El mapa completo</strong> son todas las búsquedas relacionadas con "villas Ibiza" (miles de keywords)</li>
                    <li><strong>Las X rojas</strong> son las keywords con alto volumen Y alta intención de reserva (las que importan)</li>
                    <li><strong>Los caminos</strong> son las keywords informativas que guían a los usuarios hacia la reserva</li>
                    <li><strong>Los obstáculos</strong> son keywords donde la competencia es brutal y no merece la pena competir</li>
                    <li><strong>El tesoro</strong> son las conversiones: clientes que reservan villas de €3,000-15,000/semana</li>
                </ul>
                <p class="analogia-conclusion">
                    <strong>Sin un buen mapa</strong>, estarás invirtiendo esfuerzo en keywords que no traen clientes de valor.
                    <strong>Con el mapa correcto</strong>, sabrás exactamente qué contenido crear, qué páginas optimizar y dónde
                    invertir tu presupuesto para máximo retorno.
                </p>
            </div>
            <div class="impacto-negocio-grid">
                <div class="impacto-item">
                    <i class="fas fa-bullseye"></i>
                    <h3>Tráfico Cualificado</h3>
                    <p>No cualquier visita vale. Las keywords correctas atraen usuarios que buscan <strong>villas de lujo</strong>,
                    no apartamentos baratos. Esto multiplica tu tasa de conversión por 5-10x.</p>
                </div>
                <div class="impacto-item">
                    <i class="fas fa-dollar-sign"></i>
                    <h3>Rentabilidad Directa</h3>
                    <p>Una keyword como "villa lujo ibiza primera línea" (580 búsquedas/mes) puede generar 2-4 reservas/mes
                    = €15,000-40,000 en ingresos. Una keyword mal elegida genera 0€.</p>
                </div>
                <div class="impacto-item">
                    <span class="impacto-icon">⏱️</span>
                    <h3>Eficiencia en Contenido</h3>
                    <p>Saber qué keywords atacar te dice exactamente qué contenido crear. Sin esto, creas 100 páginas
                    y solo 5 generan resultados. Con esto, 80 de 100 páginas son rentables.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN ENTREGABLES -->
    <section class="entregables-section">
        <div class="entregables-header">
            <span class="entregables-icon"></span>
            <h2>Archivos de Trabajo para Tu Estrategia de Keywords</h2>
        </div>
        <p class="entregables-intro">
            Hemos preparado 3 archivos CSV con análisis detallado de tus keywords actuales y oportunidades.
            Descárgalos, ábrelos en Excel y empieza a trabajar tu estrategia:
        </p>
        <div class="entregables-grid">
            <!-- CSV 1: Keywords Bajo Potencial -->
            <div class="entregable-card priority-warning">
                <div class="entregable-icon">
                    <i class="fas fa-file-csv"></i>
                </div>
                <div class="entregable-content">
                    <h3>Keywords con Bajo Potencial</h3>
                    <p class="entregable-desc">
                        <strong>12 keywords</strong> actuales que estás posicionando pero que no generan resultados.
                        Incluye la keyword mejorada recomendada y ganancia estimada.
                    </p>
                    <div class="entregable-meta">
                        <span class="meta-badge priority">Prioridad: Media</span>
                        <span class="meta-badge impact">Ganancia: +400-550 sesiones/mes cambiando foco</span>
                    </div>
                    <p class="entregable-uso">
                        <strong>Cómo usar:</strong> Revisa las keywords "Keyword_Actual" vs "Keyword_Mejor".
                        Redirige esfuerzo de las actuales a las mejoradas para mejor ROI.
                    </p>
                    <a href="/entregables/keywords/keywords_bajo_potencial.csv" class="btn-download" download>
                        <i class="fas fa-download"></i> Descargar CSV
                    </a>
                </div>
            </div>

            <!-- CSV 2: Keywords Oportunidad -->
            <div class="entregable-card priority-critical">
                <div class="entregable-icon">
                    <i class="fas fa-file-csv"></i>
                </div>
                <div class="entregable-content">
                    <h3>Keywords de Alta Oportunidad</h3>
                    <p class="entregable-desc">
                        <strong>15 keywords</strong> de alto volumen y valor donde NO estás posicionado aún.
                        Cada una incluye: volumen, dificultad, CPC, acción recomendada y valor estimado.
                    </p>
                    <div class="entregable-meta">
                        <span class="meta-badge priority">Prioridad: Muy Alta</span>
                        <span class="meta-badge impact">Ganancia: +850-1,200 sesiones/mes + 15-25 reservas/mes</span>
                    </div>
                    <p class="entregable-uso">
                        <strong>Cómo usar:</strong> Ordena por "Prioridad" y empieza por las "Muy Alta".
                        Sigue la columna "Accion" para implementar. Potencial de €45,000-75,000/mes adicionales.
                    </p>
                    <a href="/entregables/keywords/keywords_oportunidad.csv" class="btn-download" download>
                        <i class="fas fa-download"></i> Descargar CSV
                    </a>
                </div>
            </div>

            <!-- CSV 3: Oportunidades Priorizadas (ya existe) -->
            <div class="entregable-card priority-high">
                <div class="entregable-icon">
                    <i class="fas fa-file-csv"></i>
                </div>
                <div class="entregable-content">
                    <h3>Matriz de Priorización Completa</h3>
                    <p class="entregable-desc">
                        Todas las oportunidades ordenadas por score de priorización.
                        Incluye criterios de volumen, dificultad, relevancia y valor comercial.
                    </p>
                    <div class="entregable-meta">
                        <span class="meta-badge priority">Prioridad: Alta</span>
                        <span class="meta-badge impact">Herramienta: Planificación estratégica</span>
                    </div>
                    <p class="entregable-uso">
                        <strong>Cómo usar:</strong> Utiliza este archivo para tu roadmap trimestral.
                        Las keywords con score >80 deben implementarse en los próximos 30 días.
                    </p>
                    <a href="/entregables/keywords/oportunidades_priorizadas.csv" class="btn-download" download>
                        <i class="fas fa-download"></i> Descargar CSV
                    </a>
                </div>
            </div>
        </div>

        <div class="instrucciones-uso">
            <h3><i class="fas fa-info-circle"></i> Instrucciones de Uso</h3>
            <ol class="instrucciones-list">
                <li>
                    <strong>Descarga los 3 CSVs</strong> y ábrelos en Excel o Google Sheets
                </li>
                <li>
                    <strong>Empieza por Keywords de Oportunidad</strong> - ordena por "Prioridad" y elige las 5 primeras "Muy Alta"
                </li>
                <li>
                    <strong>Implementa la acción recomendada</strong> para cada keyword (crear landing, optimizar existente, etc.)
                </li>
                <li>
                    <strong>Mide resultados</strong> en Google Search Console después de 30-45 días
                </li>
                <li>
                    <strong>Repite el proceso</strong> con las siguientes 5 keywords mientras optimizas las primeras
                </li>
                <li>
                    <strong>Revisa Keywords Bajo Potencial</strong> y redirige recursos hacia las keywords mejoradas
                </li>
            </ol>
        </div>
    </section>

    <!-- COMPARACIÓN ANTES/DESPUÉS -->
    <section class="comparacion-antes-despues">
        <div class="comparacion-main-header">
            <span class="comparacion-main-icon"></span>
            <h2>Situación Actual vs. Estrategia Optimizada</h2>
        </div>
        <div class="comparacion-grid">
            <!-- COLUMNA ANTES -->
            <div class="comparacion-columna antes">
                <div class="comparacion-header error">
                    <span class="badge-estado antes">ANTES - ESTRATEGIA ACTUAL</span>
                    <h3>Enfoque de Keywords Sin Optimizar</h3>
                </div>
                <div class="comparacion-content">
                    <div class="problemas-lista">
                        <h4>Problemas Detectados:</h4>
                        <ul>
                            <li class="problema-item">
                                <span class="icon-error"></span>
                                <div class="problema-texto">
                                    <strong>12 keywords de bajo potencial consumiendo recursos</strong>
                                    <span class="problema-detalle">Posicionamiento en keywords con bajo volumen o muy genéricas sin conversión</span>
                                </div>
                            </li>
                            <li class="problema-item">
                                <span class="icon-error"></span>
                                <div class="problema-texto">
                                    <strong>15 keywords de alto valor sin trabajar</strong>
                                    <span class="problema-detalle">Oportunidades de 850-1,200 sesiones/mes desaprovechadas</span>
                                </div>
                            </li>
                            <li class="problema-item">
                                <span class="icon-error"></span>
                                <div class="problema-texto">
                                    <strong>Falta de keywords long-tail específicas</strong>
                                    <span class="problema-detalle">No hay cobertura de búsquedas como "villa 10 personas piscina privada"</span>
                                </div>
                            </li>
                            <li class="problema-item">
                                <span class="icon-error"></span>
                                <div class="problema-texto">
                                    <strong>Pérdida estimada: 15-25 reservas/mes</strong>
                                    <span class="problema-detalle">Equivalente a €45,000-75,000/mes en ingresos perdidos</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- COLUMNA FLECHA -->
            <div class="comparacion-flecha">
                <div class="flecha-container">
                    <i class="fas fa-arrow-right"></i>
                    <span class="flecha-text">OPTIMIZACIÓN</span>
                </div>
            </div>

            <!-- COLUMNA DESPUÉS -->
            <div class="comparacion-columna despues">
                <div class="comparacion-header success">
                    <span class="badge-estado despues">DESPUÉS - ESTRATEGIA OPTIMIZADA</span>
                    <h3>Enfoque de Keywords Optimizado</h3>
                </div>
                <div class="comparacion-content">
                    <div class="mejoras-lista">
                        <h4>Mejoras Implementadas:</h4>
                        <ul>
                            <li class="mejora-item">
                                <span class="icon-success"></span>
                                <div class="mejora-texto">
                                    <strong>Recursos redirigidos a keywords de alto valor</strong>
                                    <span class="mejora-detalle">Foco en 27 keywords con volumen 180-1,200 búsquedas/mes y alta intención</span>
                                </div>
                            </li>
                            <li class="mejora-item">
                                <span class="icon-success"></span>
                                <div class="mejora-texto">
                                    <strong>15 nuevas páginas optimizadas para oportunidades</strong>
                                    <span class="mejora-detalle">Landings específicas + contenido optimizado + backlinks</span>
                                </div>
                            </li>
                            <li class="mejora-item">
                                <span class="icon-success"></span>
                                <div class="mejora-texto">
                                    <strong>Cobertura completa long-tail</strong>
                                    <span class="mejora-detalle">Keywords específicas tipo "villa lujo san antonio 8 personas"</span>
                                </div>
                            </li>
                            <li class="mejora-item">
                                <span class="icon-success"></span>
                                <div class="mejora-texto">
                                    <strong>Ganancia estimada: +15-25 reservas/mes</strong>
                                    <span class="mejora-detalle">Equivalente a €45,000-75,000/mes en ingresos adicionales</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TABLA DE KPIS -->
    <section class="kpis-esperados-section">
        <div class="section-badge-container">
            <span class="section-badge badge-despues">DESPUÉS - RESULTADOS ESPERADOS</span>
        </div>
        <h2> KPIs y Resultados Esperados con Estrategia Optimizada</h2>
        <div class="tabla-kpis-container">
            <table class="tabla-kpis">
                <thead>
                    <tr>
                        <th class="col-metrica">Métrica</th>
                        <th class="col-antes">ANTES<br><span class="col-subtitle">Estrategia Actual</span></th>
                        <th class="col-despues">DESPUÉS<br><span class="col-subtitle">Con Optimización</span></th>
                        <th class="col-mejora">Mejora</th>
                        <th class="col-impacto">Impacto en Negocio</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- KPI 1 -->
                    <tr class="kpi-row">
                        <td class="metrica-nombre">
                            <strong>Keywords de Alto Valor Posicionadas</strong>
                            <span class="metrica-descripcion">Keywords con volumen >150 y posición top 10</span>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-numero">12</span>
                            <span class="valor-unidad">keywords</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-numero success">27-35</span>
                            <span class="valor-unidad">keywords</span>
                        </td>
                        <td class="valor-mejora">
                            <div class="mejora-badge success">
                                <span class="mejora-porcentaje">+125-192%</span>
                                <span class="mejora-texto">incremento</span>
                            </div>
                        </td>
                        <td class="impacto-texto">
                            Más del doble de keywords generando tráfico cualificado
                        </td>
                    </tr>

                    <!-- KPI 2 -->
                    <tr class="kpi-row">
                        <td class="metrica-nombre">
                            <strong>Tráfico de Keywords Long-Tail</strong>
                            <span class="metrica-descripcion">Búsquedas específicas con alta intención</span>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-numero">320</span>
                            <span class="valor-unidad">sesiones/mes</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-numero success">780-950</span>
                            <span class="valor-unidad">sesiones/mes</span>
                        </td>
                        <td class="valor-mejora">
                            <div class="mejora-badge success">
                                <span class="mejora-porcentaje">+144-197%</span>
                                <span class="mejora-texto">incremento</span>
                            </div>
                        </td>
                        <td class="impacto-texto">
                            +460-630 sesiones/mes de usuarios listos para reservar
                        </td>
                    </tr>

                    <!-- KPI 3 -->
                    <tr class="kpi-row">
                        <td class="metrica-nombre">
                            <strong>Tasa de Conversión de Tráfico Orgánico</strong>
                            <span class="metrica-descripcion">% de visitantes que solicitan reserva</span>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-numero">1.8%</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-numero success">2.8-3.2%</span>
                        </td>
                        <td class="valor-mejora">
                            <div class="mejora-badge success">
                                <span class="mejora-porcentaje">+56-78%</span>
                                <span class="mejora-texto">incremento</span>
                            </div>
                        </td>
                        <td class="impacto-texto">
                            Mejor match keyword-contenido = usuarios más cualificados
                        </td>
                    </tr>

                    <!-- KPI 4 - DESTACADO -->
                    <tr class="kpi-row critical highlight-row">
                        <td class="metrica-nombre">
                            <strong>Tráfico Orgánico Total</strong>
                            <span class="metrica-descripcion">Sesiones mensuales desde búsquedas</span>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-numero">6,850</span>
                            <span class="valor-unidad">sesiones/mes</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-numero success">8,200-9,100</span>
                            <span class="valor-unidad">sesiones/mes</span>
                        </td>
                        <td class="valor-mejora">
                            <div class="mejora-badge success large">
                                <span class="mejora-porcentaje">+20-33%</span>
                                <span class="mejora-texto">incremento</span>
                            </div>
                        </td>
                        <td class="impacto-texto">
                            <strong>+1,350-2,250 sesiones/mes</strong> de tráfico cualificado adicional
                        </td>
                    </tr>

                    <!-- KPI 5 -->
                    <tr class="kpi-row critical">
                        <td class="metrica-nombre">
                            <strong>Reservas desde Búsqueda Orgánica</strong>
                            <span class="metrica-descripcion">Conversiones directas atribuidas a SEO</span>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-numero">12-15</span>
                            <span class="valor-unidad">reservas/mes</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-numero success">27-40</span>
                            <span class="valor-unidad">reservas/mes</span>
                        </td>
                        <td class="valor-mejora">
                            <div class="mejora-badge success large">
                                <span class="mejora-porcentaje">+125-167%</span>
                                <span class="mejora-texto">incremento</span>
                            </div>
                        </td>
                        <td class="impacto-texto">
                            <strong>€45,000-75,000/mes adicionales</strong> en ingresos estimados
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="nota-tiempos">
            <p>
                <i class="fas fa-clock"></i>
                <strong>Nota sobre tiempos:</strong> Las primeras mejoras en posicionamiento se ven en 30-45 días.
                El impacto completo en reservas se materializa en 60-90 días una vez implementada la estrategia completa.
            </p>
        </div>
    </section>
</div>

<div class="audit-page keywords-page">
    <div class="page-header">
        <div class="section-badge-container">
            <span class="section-badge badge-antes">ANTES - SITUACIÓN ACTUAL</span>
        </div>
        <h1 class="page-title">
            <i class="fas fa-key"></i>
            <?php echo htmlspecialchars($datosModulo['titulo']); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo']); ?></p>
        <div class="page-meta">
            <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($datosModulo['periodo']); ?></span>
            <span><i class="fas fa-tools"></i> <?php echo implode(', ', $datosModulo['herramientas']); ?></span>
        </div>
    </div>

    <div class="page-body">

        <!-- Métricas principales -->
        <div class="metrics-grid">
            <?php foreach ($metricas as $metrica): ?>
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas <?php echo $metrica['icono']; ?>"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-label"><?php echo htmlspecialchars($metrica['label']); ?></h3>
                    <p class="metric-value"><?php echo htmlspecialchars($metrica['valor']); ?></p>
                    <?php if (isset($metrica['unidad'])): ?>
                    <small class="metric-unit"><?php echo htmlspecialchars($metrica['unidad']); ?></small>
                    <?php endif; ?>
                    <?php if (isset($metrica['variacion'])): ?>
                    <p class="metric-change <?php echo $metrica['tendencia']; ?>">
                        <i class="fas fa-arrow-<?php echo $metrica['variacion'] >= 0 ? 'up' : 'down'; ?>"></i>
                        <?php echo abs($metrica['variacion']); ?>% vs mes anterior
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Gráfica de evolución temporal -->
        <?php if (!empty($evolucion)): ?>
        <div class="chart-section">
            <h2 class="chart-title"><?php echo htmlspecialchars($evolucion['titulo']); ?></h2>
            <canvas id="evolucion-chart" height="280"></canvas>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('evolucion-chart').getContext('2d');
            new Chart(ctx, {
                type: '<?php echo $evolucion['tipo']; ?>',
                data: {
                    labels: <?php echo json_encode($evolucion['labels']); ?>,
                    datasets: <?php echo json_encode($evolucion['datasets']); ?>
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Keywords'
                            }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<!-- Página 2: Top Keywords -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h2 class="page-title"><?php echo htmlspecialchars($topKeywords['titulo']); ?></h2>
    </div>

    <div class="page-body">
        <table class="keywords-table">
            <thead>
                <tr>
                    <?php foreach ($topKeywords['columnas'] as $columna): ?>
                    <th><?php echo htmlspecialchars($columna); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topKeywords['datos'] as $index => $fila): ?>
                <tr class="<?php echo $index < 3 ? 'top-three' : ''; ?>">
                    <td class="rank-cell">
                        <?php if ($index === 0): ?>
                        <i class="fas fa-crown text-warning"></i>
                        <?php endif; ?>
                        <strong><?php echo $fila[0]; ?></strong>
                    </td>
                    <td class="keyword-cell"><strong><?php echo htmlspecialchars($fila[1]); ?></strong></td>
                    <td class="position-cell">
                        <span class="position-badge pos-<?php echo $fila[2]; ?>">
                            <?php echo $fila[2]; ?>
                        </span>
                    </td>
                    <td class="volume-cell"><?php echo htmlspecialchars($fila[3]); ?></td>
                    <td class="traffic-cell"><strong><?php echo htmlspecialchars($fila[4]); ?></strong></td>
                    <td class="change-cell">
                        <?php
                        $change = $fila[5];
                        $class = $change[0] === '+' ? 'text-success' : ($change[0] === '-' ? 'text-danger' : 'text-muted');
                        $icon = $change[0] === '+' ? 'up' : ($change[0] === '-' ? 'down' : 'minus');
                        ?>
                        <span class="<?php echo $class; ?>">
                            <i class="fas fa-arrow-<?php echo $icon; ?>"></i>
                            <?php echo htmlspecialchars($change); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<!-- Página 3: Distribución y Categorías -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h2 class="page-title">Análisis de Distribución y Categorización</h2>
    </div>

    <div class="page-body">

        <!-- Gráfica de distribución -->
        <?php if (!empty($distribucion)): ?>
        <div class="chart-section">
            <h3 class="chart-title"><?php echo htmlspecialchars($distribucion['titulo']); ?></h3>
            <canvas id="distribucion-chart" height="250"></canvas>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('distribucion-chart').getContext('2d');
            new Chart(ctx, {
                type: '<?php echo $distribucion['tipo']; ?>',
                data: {
                    labels: <?php echo json_encode($distribucion['labels']); ?>,
                    datasets: [{
                        label: 'Keywords',
                        data: <?php echo json_encode($distribucion['valores']); ?>,
                        backgroundColor: <?php echo json_encode($distribucion['colores']); ?>,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Keywords'
                            }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>

        <!-- Keywords por categoría -->
        <?php if (!empty($categorias)): ?>
        <div class="categories-section">
            <h3 class="section-title">
                <i class="fas fa-tags"></i>
                <?php echo htmlspecialchars($categorias['titulo']); ?>
            </h3>
            <div class="categories-grid">
                <?php foreach ($categorias['datos'] as $cat): ?>
                <div class="category-card">
                    <div class="category-header">
                        <h4><?php echo htmlspecialchars($cat['categoria']); ?></h4>
                        <span class="category-percentage"><?php echo $cat['porcentaje']; ?>%</span>
                    </div>
                    <div class="category-stats">
                        <div class="stat-item">
                            <span class="stat-label">Total:</span>
                            <span class="stat-value"><?php echo $cat['total']; ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Top 10:</span>
                            <span class="stat-value highlight"><?php echo $cat['top10']; ?></span>
                        </div>
                    </div>
                    <div class="category-examples">
                        <strong>Ejemplos:</strong>
                        <ul>
                            <?php foreach ($cat['ejemplos'] as $ejemplo): ?>
                            <li><?php echo htmlspecialchars($ejemplo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Competitividad -->
        <?php if (!empty($competitividad)): ?>
        <div class="competitiveness-section">
            <h3 class="section-title">
                <i class="fas fa-chart-pie"></i>
                <?php echo htmlspecialchars($competitividad['titulo']); ?>
            </h3>
            <div class="competitiveness-grid">
                <?php foreach ($competitividad['datos'] as $nivel): ?>
                <div class="competitiveness-card" style="border-left-color: <?php echo $nivel['color']; ?>">
                    <h4 style="color: <?php echo $nivel['color']; ?>">
                        Competitividad <?php echo htmlspecialchars($nivel['nivel']); ?>
                    </h4>
                    <div class="competitiveness-value"><?php echo $nivel['cantidad']; ?></div>
                    <div class="competitiveness-percentage"><?php echo $nivel['porcentaje']; ?>%</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<!-- Página 4: Conclusiones y Recomendaciones -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h2 class="page-title">Conclusiones y Recomendaciones</h2>
    </div>

    <div class="page-body">

        <!-- Conclusiones -->
        <?php if (!empty($conclusiones)): ?>
        <div class="conclusions-section">
            <h3 class="section-title">
                <i class="fas fa-check-circle"></i>
                Conclusiones Principales
            </h3>
            <ul class="conclusions-list">
                <?php foreach ($conclusiones as $conclusion): ?>
                <li>
                    <i class="fas fa-angle-right"></i>
                    <?php echo htmlspecialchars($conclusion); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <div class="recommendations-section">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                Recomendaciones Estratégicas
            </h3>
            <?php foreach ($recomendaciones as $index => $rec): ?>
            <div class="recommendation-card priority-<?php echo strtolower($rec['prioridad']); ?>">
                <div class="recommendation-header">
                    <div class="recommendation-number"><?php echo $index + 1; ?></div>
                    <div class="recommendation-priority">
                        <span class="priority-badge priority-<?php echo strtolower($rec['prioridad']); ?>">
                            <?php echo htmlspecialchars($rec['prioridad']); ?>
                        </span>
                    </div>
                </div>
                <h4 class="recommendation-title"><?php echo htmlspecialchars($rec['titulo']); ?></h4>
                <p class="recommendation-description"><?php echo htmlspecialchars($rec['descripcion']); ?></p>
                <div class="recommendation-meta">
                    <span><strong>Esfuerzo:</strong> <?php echo htmlspecialchars($rec['esfuerzo']); ?></span>
                    <span><strong>Impacto:</strong> <?php echo htmlspecialchars($rec['impacto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos específicos para keywords */
.page-meta {
    display: flex;
    gap: 24px;
    margin-top: 12px;
    font-size: 0.95em;
    color: #666;
}

.page-meta i {
    margin-right: 6px;
}

.keywords-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    font-size: 0.9em;
}

.keywords-table thead {
    background: #f8f9fa;
}

.keywords-table th {
    padding: 12px 8px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.keywords-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #e9ecef;
}

.keywords-table tr.top-three {
    background: #f0f7e6;
}

.rank-cell {
    width: 40px;
    text-align: center;
}

.position-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.9em;
}

.position-badge.pos-1,
.position-badge.pos-2,
.position-badge.pos-3 {
    background: #d4edda;
    color: #155724;
}

.position-badge[class*="pos-"]:not(.pos-1):not(.pos-2):not(.pos-3) {
    background: #f0f7e6;
    color: #856404;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.category-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #88B04B;
}

.category-header h4 {
    margin: 0;
    color: #333;
}

.category-percentage {
    font-size: 1.5em;
    font-weight: 700;
    color: #88B04B;
}

.category-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 16px;
}

.stat-item {
    flex: 1;
}

.stat-label {
    color: #666;
    font-size: 0.9em;
}

.stat-value {
    font-size: 1.3em;
    font-weight: 700;
    color: #333;
    margin-left: 6px;
}

.stat-value.highlight {
    color: #88B04B;
}

.category-examples ul {
    list-style: none;
    padding: 0;
    margin: 8px 0 0 0;
}

.category-examples li {
    padding: 4px 0;
    color: #666;
    font-size: 0.85em;
}

.competitiveness-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.competitiveness-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.competitiveness-value {
    font-size: 2.5em;
    font-weight: 700;
    color: #333;
    margin: 10px 0;
}

.competitiveness-percentage {
    font-size: 1.2em;
    color: #666;
}

.conclusions-list {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.conclusions-list li {
    padding: 12px 0 12px 30px;
    position: relative;
    border-bottom: 1px solid #e9ecef;
}

.conclusions-list i {
    position: absolute;
    left: 0;
    top: 14px;
    color: #88B04B;
}

.recommendation-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #88B04B;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 16px;
}

.recommendation-card.priority-alta {
    border-left-color: #dc3545;
    background: #fff5f5;
}

.recommendation-card.priority-media {
    border-left-color: #88B04B;
    background: #f0f7e6;
}

.recommendation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.recommendation-number {
    background: #88B04B;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.priority-badge {
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.85em;
    font-weight: 600;
}

.priority-badge.priority-alta {
    background: #dc3545;
    color: white;
}

.priority-badge.priority-media {
    background: #88B04B;
    color: #333;
}

.recommendation-title {
    font-size: 1.2em;
    color: #333;
    margin: 12px 0;
}

.recommendation-description {
    color: #666;
    line-height: 1.6;
    margin: 12px 0;
}

.recommendation-meta {
    display: flex;
    gap: 24px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #e9ecef;
    font-size: 0.9em;
}

@media print {
    .audit-page {
        page-break-after: always;
    }
}

/* ============================================
   PATRÓN EDUCATIVO - CSS COMPLETO KEYWORDS
   ============================================ */

/* Contenedor principal del patrón educativo */
.keywords-educativo .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.keywords-educativo .concepto-header {
    text-align: center;
    margin-bottom: 25px;
}

.keywords-educativo .concepto-icon {
    font-size: 48px;
    display: block;
    margin-bottom: 15px;
}

.keywords-educativo .concepto-header h2 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
}

.keywords-educativo .concepto-intro {
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 25px;
    text-align: center;
}

/* Analogía Box */
.keywords-educativo .analogia-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 25px;
    margin: 25px 0;
}

.keywords-educativo .analogia-header {
    font-size: 20px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.keywords-educativo .analogia-icon {
    font-size: 28px;
}

.keywords-educativo .analogia-list {
    list-style: none;
    padding: 0;
    margin: 15px 0;
}

.keywords-educativo .analogia-list li {
    padding: 10px 0;
    padding-left: 30px;
    position: relative;
    font-size: 16px;
    line-height: 1.6;
}

.keywords-educativo .analogia-list li::before {
    content: "→";
    position: absolute;
    left: 0;
    font-size: 20px;
    color: #ffd700;
}

.keywords-educativo .analogia-conclusion {
    margin-top: 20px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    border-left: 4px solid #ffd700;
    font-size: 16px;
    line-height: 1.6;
}

/* Grid de Impacto en Negocio */
.keywords-educativo .impacto-negocio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 30px;
}

@media (max-width: 768px) {
    .keywords-educativo .impacto-negocio-grid {
        grid-template-columns: 1fr;
    }
}

.keywords-educativo .impacto-item {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.2s;
}

.keywords-educativo .impacto-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.keywords-educativo .impacto-icon {
    font-size: 42px;
    display: block;
    margin-bottom: 15px;
}

.keywords-educativo .impacto-item h3 {
    margin: 0 0 12px 0;
    font-size: 20px;
    color: #88B04B;
}

.keywords-educativo .impacto-item p {
    margin: 0;
    font-size: 15px;
    line-height: 1.6;
    color: #555;
}

/* Sección Entregables */
.keywords-educativo .entregables-section {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 12px;
    margin-bottom: 40px;
}

.keywords-educativo .entregables-header {
    text-align: center;
    margin-bottom: 20px;
}

.keywords-educativo .entregables-icon {
    font-size: 48px;
    display: block;
    margin-bottom: 15px;
    color: #88B04B;
}

.keywords-educativo .entregables-header h2 {
    margin: 0;
    color: #333;
    font-size: 28px;
}

.keywords-educativo .entregables-intro {
    text-align: center;
    font-size: 16px;
    color: #666;
    margin-bottom: 30px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.keywords-educativo .entregables-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-bottom: 30px;
}

@media (max-width: 992px) {
    .keywords-educativo .entregables-grid {
        grid-template-columns: 1fr;
    }
}

.keywords-educativo .entregable-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 2px solid #e0e0e0;
    transition: all 0.3s;
}

.keywords-educativo .entregable-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 12px rgba(102,126,234,0.15);
    transform: translateY(-2px);
}

.keywords-educativo .entregable-card.priority-critical {
    border-left: 5px solid #dc3545;
}

.keywords-educativo .entregable-card.priority-high {
    border-left: 5px solid #88B04B;
}

.keywords-educativo .entregable-card.priority-warning {
    border-left: 5px solid #ff9800;
}

.keywords-educativo .entregable-icon {
    font-size: 48px;
    color: #88B04B;
    text-align: center;
    margin-bottom: 15px;
}

.keywords-educativo .entregable-content h3 {
    margin: 0 0 12px 0;
    font-size: 20px;
    color: #333;
}

.keywords-educativo .entregable-desc {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 15px;
}

.keywords-educativo .entregable-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 15px;
}

.keywords-educativo .meta-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}

.keywords-educativo .meta-badge.priority {
    background: #e3f2fd;
    color: #1976d2;
}

.keywords-educativo .meta-badge.impact {
    background: #e8f5e9;
    color: #388e3c;
}

.keywords-educativo .entregable-uso {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 15px;
    border-left: 3px solid #88B04B;
}

.keywords-educativo .btn-download {
    display: block;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    text-align: center;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.keywords-educativo .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(102,126,234,0.3);
    color: white;
}

.keywords-educativo .btn-download i {
    margin-right: 8px;
}

/* Instrucciones de uso */
.keywords-educativo .instrucciones-uso {
    background: white;
    padding: 25px;
    border-radius: 12px;
    border: 2px solid #88B04B;
}

.keywords-educativo .instrucciones-uso h3 {
    margin: 0 0 20px 0;
    color: #88B04B;
    font-size: 22px;
}

.keywords-educativo .instrucciones-list {
    margin: 0;
    padding-left: 25px;
}

.keywords-educativo .instrucciones-list li {
    margin: 12px 0;
    font-size: 15px;
    line-height: 1.6;
    color: #555;
}

/* Comparación ANTES/DESPUÉS */
.keywords-educativo .comparacion-antes-despues {
    background: white;
    padding: 40px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.keywords-educativo .comparacion-main-header {
    text-align: center;
    margin-bottom: 30px;
}

.keywords-educativo .comparacion-main-icon {
    font-size: 48px;
    display: block;
    margin-bottom: 15px;
}

.keywords-educativo .comparacion-main-header h2 {
    margin: 0;
    color: #333;
    font-size: 28px;
}

.keywords-educativo .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
}

@media (max-width: 992px) {
    .keywords-educativo .comparacion-grid {
        grid-template-columns: 1fr;
    }
    .keywords-educativo .comparacion-flecha {
        order: 2;
    }
    .keywords-educativo .comparacion-columna.despues {
        order: 3;
    }
}

.keywords-educativo .comparacion-columna {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.keywords-educativo .comparacion-header {
    padding: 20px;
    text-align: center;
}

.keywords-educativo .comparacion-header.error {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.keywords-educativo .comparacion-header.success {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.keywords-educativo .badge-estado {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
}

.keywords-educativo .badge-estado.antes {
    background: rgba(255, 255, 255, 0.3);
}

.keywords-educativo .badge-estado.despues {
    background: rgba(255, 255, 255, 0.3);
}

.keywords-educativo .comparacion-header h3 {
    margin: 0;
    font-size: 20px;
}

.keywords-educativo .comparacion-content {
    background: #f8f9fa;
    padding: 25px;
    min-height: 400px;
}

.keywords-educativo .problemas-lista h4,
.keywords-educativo .mejoras-lista h4 {
    margin: 0 0 20px 0;
    font-size: 18px;
    color: #333;
}

.keywords-educativo .problemas-lista ul,
.keywords-educativo .mejoras-lista ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.keywords-educativo .problema-item,
.keywords-educativo .mejora-item {
    display: flex;
    gap: 15px;
    padding: 15px;
    background: white;
    border-radius: 8px;
    margin-bottom: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.keywords-educativo .icon-error {
    font-size: 24px;
    flex-shrink: 0;
}

.keywords-educativo .icon-success {
    font-size: 24px;
    flex-shrink: 0;
}

.keywords-educativo .problema-texto,
.keywords-educativo .mejora-texto {
    flex: 1;
}

.keywords-educativo .problema-texto strong,
.keywords-educativo .mejora-texto strong {
    display: block;
    color: #333;
    margin-bottom: 5px;
    font-size: 15px;
}

.keywords-educativo .problema-detalle,
.keywords-educativo .mejora-detalle {
    display: block;
    color: #666;
    font-size: 14px;
    line-height: 1.5;
}

/* Flecha de transformación */
.keywords-educativo .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
}

.keywords-educativo .flecha-container {
    text-align: center;
}

.keywords-educativo .flecha-container i {
    font-size: 48px;
    color: #88B04B;
    display: block;
    margin-bottom: 10px;
    animation: pulse 2s infinite;
}

.keywords-educativo .flecha-text {
    display: block;
    font-weight: 700;
    color: #88B04B;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1px;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
}

/* Sección KPIs */
.keywords-educativo .kpis-esperados-section {
    background: white;
    padding: 40px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.keywords-educativo .section-badge-container {
    text-align: center;
    margin-bottom: 20px;
}

.keywords-educativo .section-badge {
    display: inline-block;
    padding: 10px 24px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.keywords-educativo .section-badge.badge-antes {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 2px 4px rgba(220,53,69,0.3);
}

.keywords-educativo .section-badge.badge-despues {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    box-shadow: 0 2px 4px rgba(40,167,69,0.3);
}

.keywords-educativo .kpis-esperados-section h2 {
    margin: 0 0 30px 0;
    text-align: center;
    color: #333;
    font-size: 28px;
}

.keywords-educativo .tabla-kpis-container {
    overflow-x: auto;
}

.keywords-educativo .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.keywords-educativo .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.keywords-educativo .tabla-kpis th {
    padding: 15px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.keywords-educativo .col-subtitle {
    display: block;
    font-size: 11px;
    opacity: 0.9;
    font-weight: 400;
    margin-top: 4px;
}

.keywords-educativo .tabla-kpis tbody tr {
    border-bottom: 1px solid #e9ecef;
}

.keywords-educativo .tabla-kpis tbody tr:hover {
    background: #f8f9fa;
}

.keywords-educativo .tabla-kpis tbody tr.highlight-row {
    background: #f0f7e6;
}

.keywords-educativo .tabla-kpis tbody tr.highlight-row:hover {
    background: #ffe69c;
}

.keywords-educativo .tabla-kpis td {
    padding: 18px 12px;
    vertical-align: top;
}

.keywords-educativo .metrica-nombre {
    font-weight: 600;
    color: #333;
}

.keywords-educativo .metrica-descripcion {
    display: block;
    font-size: 13px;
    color: #666;
    font-weight: 400;
    margin-top: 4px;
}

.keywords-educativo .valor-antes,
.keywords-educativo .valor-despues {
    text-align: center;
}

.keywords-educativo .valor-numero {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #333;
}

.keywords-educativo .valor-numero.success {
    color: #88B04B;
}

.keywords-educativo .valor-unidad {
    display: block;
    font-size: 12px;
    color: #666;
    margin-top: 4px;
}

.keywords-educativo .valor-mejora {
    text-align: center;
}

.keywords-educativo .mejora-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 8px;
    background: #d4edda;
    color: #155724;
    font-weight: 700;
}

.keywords-educativo .mejora-badge.success {
    background: #d4edda;
    color: #155724;
}

.keywords-educativo .mejora-badge.large {
    padding: 12px 20px;
}

.keywords-educativo .mejora-porcentaje {
    display: block;
    font-size: 20px;
}

.keywords-educativo .mejora-badge.large .mejora-porcentaje {
    font-size: 24px;
}

.keywords-educativo .mejora-texto {
    display: block;
    font-size: 11px;
    margin-top: 2px;
    text-transform: uppercase;
}

.keywords-educativo .impacto-texto {
    color: #555;
    font-size: 14px;
    line-height: 1.6;
}

.keywords-educativo .nota-tiempos {
    margin-top: 25px;
    padding: 20px;
    background: #e7f3ff;
    border-left: 4px solid #2196f3;
    border-radius: 8px;
}

.keywords-educativo .nota-tiempos p {
    margin: 0;
    color: #333;
    font-size: 14px;
    line-height: 1.6;
}

.keywords-educativo .nota-tiempos i {
    color: #2196f3;
    margin-right: 8px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .keywords-educativo .tabla-kpis {
        font-size: 13px;
    }

    .keywords-educativo .valor-numero {
        font-size: 20px;
    }

    .keywords-educativo .mejora-porcentaje {
        font-size: 18px;
    }
}
</style>
