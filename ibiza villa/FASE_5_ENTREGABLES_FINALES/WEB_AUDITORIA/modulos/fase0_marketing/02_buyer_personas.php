<?php
/**
 * Módulo m0.3 - Buyer Personas
 * Perfiles detallados de clientes ideales para villas de lujo en Ibiza
 *
 * Estructura: 4 páginas
 * - Página 1: Portada con overview de las 4 personas
 * - Página 2: Persona 1 - Familia Pudiente Internacional (detalle completo)
 * - Página 3: Persona 2 - Pareja DINK + Persona 3 - Grupo Millennials
 * - Página 4: Persona 4 - Emprendedor Digital + Estrategia de Marketing
 */

// Cargar datos del JSON
$jsonPath = __DIR__ . '/../../data/fase0/buyer_personas.json';
$jsonContent = file_get_contents($jsonPath);
$datosModulo = json_decode($jsonContent, true);

$modulo = $datosModulo['modulo'];
$paginas = $datosModulo['paginas'];
?>

<!-- PÁGINA 1: PORTADA BUYER PERSONAS -->
<div class="audit-page personas-cover-page">
    <div class="page-header">
        <div class="module-badge">Fase 0 - Marketing Digital</div>
        <h1><?php echo htmlspecialchars($paginas[0]['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($paginas[0]['subtitulo']); ?></p>
    </div>

    <?php
    $portada = $paginas[0]['contenido']['datos'];
    ?>

    <div class="page-content">
        <!-- Resumen Ejecutivo -->
        <div class="personas-summary">
            <div class="summary-stat">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <div class="stat-value"><?php echo $portada['personas_identificadas']; ?></div>
                    <div class="stat-label">Buyer Personas Identificadas</div>
                </div>
            </div>
        </div>

        <!-- Metodología -->
        <div class="methodology-section">
            <h2><i class="fas fa-microscope"></i> Metodología de Investigación</h2>
            <div class="methodology-grid">
                <?php foreach ($portada['metodologia'] as $metodo): ?>
                <div class="method-card">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo htmlspecialchars($metodo); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Segmentos Principales -->
        <div class="segments-section">
            <h2><i class="fas fa-chart-pie"></i> Distribución de Segmentos</h2>

            <div class="segments-grid">
                <?php foreach ($portada['segmentos_principales'] ?? [] as $segmento): ?>
                <div class="segment-card" style="border-left-color: <?php echo $segmento['color']; ?>">
                    <div class="segment-header">
                        <h3><?php echo $segmento['nombre']; ?></h3>
                        <span class="segment-percentage" style="background: <?php echo $segmento['color']; ?>">
                            <?php echo $segmento['porcentaje']; ?>%
                        </span>
                    </div>
                    <div class="segment-bar">
                        <div class="segment-fill" style="width: <?php echo $segmento['porcentaje']; ?>%; background: <?php echo $segmento['color']; ?>"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Origen Geográfico -->
        <div class="origin-section">
            <h2><i class="fas fa-globe-europe"></i> Origen Geográfico de Clientes</h2>

            <div class="origin-chart">
                <canvas id="origin-chart"></canvas>
            </div>

            <div class="origin-list">
                <?php foreach ($portada['pais_origen_principal'] ?? [] as $pais): ?>
                <div class="origin-item">
                    <span class="origin-country"><?php echo $pais['pais']; ?></span>
                    <div class="origin-bar-container">
                        <div class="origin-bar" style="width: <?php echo $pais['porcentaje']; ?>%"></div>
                    </div>
                    <span class="origin-percent"><?php echo $pais['porcentaje']; ?>%</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Fase 0 - Marketing Digital</span>
        <span>Página 1/3</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('origin-chart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($portada['pais_origen_principal'] ?? [], 'pais')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($portada['pais_origen_principal'] ?? [], 'porcentaje')); ?>,
                    backgroundColor: ['#88B04B', '#88B04B', '#88B04B', '#88B04B', '#94a3b8'],
                    borderWidth: 3,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>

<!-- PÁGINA 2: PERSONA 1 - FAMILIA PUDIENTE -->
<div class="audit-page persona-detail-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($paginas[1]['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($paginas[1]['subtitulo']); ?></p>
    </div>

    <?php
    $datos = $paginas[1]['contenido']['datos'];
    $persona = $datos['persona'] ?? [];
    $demografia = $datos['demografia'] ?? [];
    $psicografia = $datos['psicografia'] ?? [];
    $comportamiento = $datos['comportamiento_compra'] ?? [];
    $painPoints = $datos['pain_points'] ?? [];
    $goals = $datos['goals'] ?? [];
    $mensajes = $datos['mensajes_clave'] ?? [];
    $keywords = $datos['keywords_interes'] ?? [];
    ?>

    <div class="page-content">
        <!-- Tarjeta de Persona -->
        <div class="persona-card">
            <div class="persona-avatar">
                <div class="avatar-emoji"><?php echo $persona['foto_emoji'] ?? ''; ?></div>
            </div>
            <div class="persona-info">
                <h2><?php echo $persona['nombre'] ?? 'Nombre no disponible'; ?></h2>
                <div class="persona-details">
                    <div class="detail-item">
                        <i class="fas fa-birthday-cake"></i>
                        <span><?php echo $persona['edad'] ?? 'N/A'; ?></span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo $persona['ubicacion'] ?? 'N/A'; ?></span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-briefcase"></i>
                        <span><?php echo $persona['ocupacion'] ?? 'N/A'; ?></span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-euro-sign"></i>
                        <span><?php echo $persona['ingresos_anuales'] ?? 'N/A'; ?></span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-heart"></i>
                        <span><?php echo $persona['estado_civil'] ?? 'N/A'; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demografía -->
        <div class="section-block demografia-block">
            <h3><i class="fas fa-chart-bar"></i> Demografía</h3>
            <div class="demo-grid">
                <?php foreach ($demografia as $key => $value): ?>
                <div class="demo-item">
                    <strong><?php echo ucwords(str_replace('_', ' ', $key)); ?>:</strong>
                    <span><?php echo is_array($value) ? implode(', ', $value) : $value; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Psicografía -->
        <div class="section-block psico-block">
            <h3><i class="fas fa-brain"></i> Psicografía</h3>

            <div class="psico-columns">
                <div class="psico-column">
                    <h4>Valores</h4>
                    <ul>
                        <?php foreach ($psicografia['valores'] ?? [] as $valor): ?>
                        <li><?php echo htmlspecialchars($valor); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="psico-column">
                    <h4>Estilo de Vida</h4>
                    <ul>
                        <?php foreach ($psicografia['estilo_vida'] ?? [] as $estilo): ?>
                        <li><?php echo htmlspecialchars($estilo); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="psico-column">
                    <h4>Intereses</h4>
                    <ul>
                        <?php foreach ($psicografia['intereses'] ?? [] as $interes): ?>
                        <li><?php echo htmlspecialchars($interes); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Comportamiento de Compra -->
        <div class="section-block behavior-block">
            <h3><i class="fas fa-shopping-cart"></i> Comportamiento de Compra</h3>

            <div class="behavior-grid">
                <div class="behavior-item">
                    <h4>Proceso de Decisión</h4>
                    <p><?php echo $comportamiento['proceso_decision'] ?? 'N/A'; ?></p>
                </div>

                <div class="behavior-item">
                    <h4>Influenciadores</h4>
                    <p><?php echo $comportamiento['influenciadores'] ?? 'N/A'; ?></p>
                </div>

                <div class="behavior-item highlight">
                    <h4>Presupuesto</h4>
                    <p class="budget"><?php echo $comportamiento['presupuesto'] ?? 'N/A'; ?></p>
                </div>

                <div class="behavior-item">
                    <h4>Duración Estancia</h4>
                    <p><?php echo $comportamiento['duracion_estancia'] ?? 'N/A'; ?></p>
                </div>
            </div>

            <div class="criteria-section">
                <h4>Criterios de Selección</h4>
                <div class="criteria-grid">
                    <?php foreach ($comportamiento['criterios_seleccion'] ?? [] as $index => $criterio): ?>
                    <div class="criterion-card">
                        <div class="criterion-number"><?php echo $index + 1; ?></div>
                        <p><?php echo htmlspecialchars($criterio); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Pain Points & Goals -->
        <div class="pain-goals-grid">
            <div class="section-block pain-block">
                <h3><i class="fas fa-exclamation-triangle"></i> Pain Points</h3>
                <ul>
                    <?php foreach ($painPoints as $pain): ?>
                    <li><?php echo htmlspecialchars($pain); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="section-block goals-block">
                <h3><i class="fas fa-bullseye"></i> Objetivos</h3>
                <ul>
                    <?php foreach ($goals as $goal): ?>
                    <li><?php echo htmlspecialchars($goal); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Mensajes Clave -->
        <div class="section-block messages-block">
            <h3><i class="fas fa-comment-dots"></i> Mensajes Clave para Esta Persona</h3>
            <div class="messages-grid">
                <?php foreach ($mensajes ?? [] as $mensaje): ?>
                <div class="message-card">
                    <i class="fas fa-quote-left"></i>
                    <p><?php echo htmlspecialchars($mensaje); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Keywords -->
        <div class="keywords-block">
            <h4><i class="fas fa-search"></i> Keywords de Interés</h4>
            <div class="keywords-tags">
                <?php foreach ($keywords ?? [] as $keyword): ?>
                <span class="keyword-tag"><?php echo htmlspecialchars($keyword); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Fase 0 - Marketing Digital</span>
        <span>Página 2/3</span>
    </div>
</div>

<!-- PÁGINA 3: PERSONA 2 & 3 -->
<div class="audit-page dual-personas-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($paginas[2]['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($paginas[2]['subtitulo']); ?></p>
    </div>

    <?php
    $dual = $paginas[2]['contenido']['datos'] ?? [];
    $persona2 = $dual['persona_2'] ?? [];
    $persona3 = $dual['persona_3'] ?? [];
    ?>

    <div class="page-content">
        <!-- Persona 2: Pareja DINK -->
        <div class="compact-persona">
            <div class="compact-header">
                <div class="compact-avatar"><?php echo $persona2['foto_emoji'] ?? ''; ?></div>
                <div class="compact-title">
                    <h2>Persona 2: <?php echo $persona2['nombre'] ?? 'N/A'; ?></h2>
                    <p class="compact-subtitle"><?php echo ($persona2['edad'] ?? 'N/A') . ' | ' . ($persona2['ubicacion'] ?? 'N/A'); ?></p>
                    <p class="compact-subtitle"><?php echo $persona2['ocupacion'] ?? 'N/A'; ?></p>
                </div>
                <div class="compact-percentage">
                    <div class="percent-value"><?php echo $persona2['porcentaje_clientes'] ?? '0%'; ?></div>
                    <div class="percent-label">de clientes</div>
                </div>
            </div>

            <div class="compact-content">
                <div class="compact-section">
                    <h4><i class="fas fa-star"></i> Características Clave</h4>
                    <ul class="compact-list">
                        <?php foreach ($persona2['caracteristicas_clave'] ?? [] as $car): ?>
                        <li><?php echo htmlspecialchars($car); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="compact-columns">
                    <div class="compact-column">
                        <h4><i class="fas fa-exclamation-circle"></i> Pain Points</h4>
                        <ul class="compact-list">
                            <?php foreach ($persona2['pain_points'] ?? [] as $pain): ?>
                            <li><?php echo htmlspecialchars($pain); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="compact-column">
                        <h4><i class="fas fa-bullseye"></i> Objetivos</h4>
                        <ul class="compact-list">
                            <?php foreach ($persona2['goals'] ?? [] as $goal): ?>
                            <li><?php echo htmlspecialchars($goal); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="compact-messages">
                    <h4><i class="fas fa-comment"></i> Mensajes Clave</h4>
                    <div class="compact-messages-grid">
                        <?php foreach ($persona2['mensajes_clave'] ?? [] as $msg): ?>
                        <div class="compact-message"><?php echo htmlspecialchars($msg); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persona 3: Grupo Millennials -->
        <div class="compact-persona">
            <div class="compact-header">
                <div class="compact-avatar"><?php echo $persona3['foto_emoji'] ?? ''; ?></div>
                <div class="compact-title">
                    <h2>Persona 3: <?php echo $persona3['nombre'] ?? 'N/A'; ?></h2>
                    <p class="compact-subtitle"><?php echo ($persona3['edad'] ?? 'N/A') . ' | ' . ($persona3['ubicacion'] ?? 'N/A'); ?></p>
                    <p class="compact-subtitle"><?php echo $persona3['ocupacion'] ?? 'N/A'; ?></p>
                </div>
                <div class="compact-percentage">
                    <div class="percent-value"><?php echo $persona3['porcentaje_clientes'] ?? '0%'; ?></div>
                    <div class="percent-label">de clientes</div>
                </div>
            </div>

            <div class="compact-content">
                <div class="compact-section">
                    <h4><i class="fas fa-star"></i> Características Clave</h4>
                    <ul class="compact-list">
                        <?php foreach ($persona3['caracteristicas_clave'] ?? [] as $car): ?>
                        <li><?php echo htmlspecialchars($car); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="compact-columns">
                    <div class="compact-column">
                        <h4><i class="fas fa-exclamation-circle"></i> Pain Points</h4>
                        <ul class="compact-list">
                            <?php foreach ($persona3['pain_points'] ?? [] as $pain): ?>
                            <li><?php echo htmlspecialchars($pain); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="compact-column">
                        <h4><i class="fas fa-bullseye"></i> Objetivos</h4>
                        <ul class="compact-list">
                            <?php foreach ($persona3['goals'] ?? [] as $goal): ?>
                            <li><?php echo htmlspecialchars($goal); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="compact-messages">
                    <h4><i class="fas fa-comment"></i> Mensajes Clave</h4>
                    <div class="compact-messages-grid">
                        <?php foreach ($persona3['mensajes_clave'] ?? [] as $msg): ?>
                        <div class="compact-message"><?php echo htmlspecialchars($msg); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Fase 0 - Marketing Digital</span>
        <span>Página 3/3</span>
    </div>
</div>


<style>
/* ===================================================================
   SOBRESCRITURA PRIORITARIA DE ESTILOS GLOBALES - BUYER PERSONAS
   Estos selectores tienen MÁXIMA especificidad para evitar herencia
   ================================================================== */

/* Sobrescribir .page-header .subtitle del sistema (styles.css)
   Sistema usa: .page-header .subtitle { color: var(--text-secondary); }
   Forzamos colores específicos del módulo */
.personas-cover-page .page-header,
.personas-cover-page .page-header h1,
.personas-cover-page .page-header .subtitle,
.persona-detail-page .page-header,
.persona-detail-page .page-header h1,
.persona-detail-page .page-header .subtitle,
.dual-personas-page .page-header,
.dual-personas-page .page-header h1,
.dual-personas-page .page-header .subtitle,
.strategy-personas-page .page-header,
.strategy-personas-page .page-header h1,
.strategy-personas-page .page-header .subtitle {
    background: transparent !important;
}

/* Forzar colores específicos en subtítulos */
.personas-cover-page .subtitle,
.persona-detail-page .subtitle,
.dual-personas-page .subtitle,
.strategy-personas-page .subtitle {
    color: #6d8f3c !important;
    font-weight: 600;
}

/* Sobrescribir tablas si las hay */
.personas-cover-page table thead,
.persona-detail-page table thead,
.dual-personas-page table thead,
.strategy-personas-page table thead {
    background: #88B04B !important;
    color: #ffffff !important;
}

/* ========================================
   ESTILOS PÁGINA 1: PORTADA PERSONAS
   ======================================== */
.personas-cover-page {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
    padding: 60px;
    min-height: 100vh;
}

.personas-cover-page .module-badge {
    font-size: 14px;
    color: #6d8f3c;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.personas-cover-page .page-header h1 {
    font-size: 42px;
    color: #881337;
    margin: 15px 0;
    font-weight: 700;
}

.personas-cover-page .subtitle {
    font-size: 18px;
    color: #6d8f3c;
    margin-top: 10px;
}

.personas-cover-page .personas-summary {
    text-align: center;
    margin-bottom: 40px;
}

.personas-cover-page .summary-stat {
    display: inline-flex;
    align-items: center;
    gap: 20px;
    background: white;
    padding: 30px 50px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.personas-cover-page .stat-icon {
    font-size: 60px;
    color: #88B04B;
}

.personas-cover-page .stat-value {
    font-size: 64px;
    font-weight: 700;
    color: #881337;
    line-height: 1;
}

.personas-cover-page .stat-label {
    font-size: 16px;
    color: #6d8f3c;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.methodology-section,
.segments-section,
.personas-cover-page .origin-section {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.methodology-section h2,
.segments-section h2,
.personas-cover-page .origin-section h2 {
    font-size: 24px;
    color: #881337;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.personas-cover-page .methodology-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.personas-cover-page .method-card {
    background: #f0f7e6;
    padding: 15px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-left: 3px solid #88B04B;
}

.personas-cover-page .method-card i {
    color: #88B04B;
    font-size: 20px;
}

.personas-cover-page .segments-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.personas-cover-page .segment-card {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid;
}

.personas-cover-page .segment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.personas-cover-page .segment-header h3 {
    font-size: 18px;
    color: #1e293b;
    margin: 0;
}

.personas-cover-page .segment-percentage {
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 16px;
}

.personas-cover-page .segment-bar {
    height: 12px;
    background: #f5f5f5;
    border-radius: 6px;
    overflow: hidden;
}

.personas-cover-page .segment-fill {
    height: 100%;
    transition: width 0.3s ease;
}

.personas-cover-page .origin-chart {
    height: 300px;
    margin-bottom: 30px;
}

.personas-cover-page .origin-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.personas-cover-page .origin-item {
    display: grid;
    grid-template-columns: 150px 1fr 60px;
    align-items: center;
    gap: 15px;
}

.personas-cover-page .origin-country {
    font-weight: 600;
    color: #1e293b;
}

.personas-cover-page .origin-bar-container {
    height: 24px;
    background: #f5f5f5;
    border-radius: 12px;
    overflow: hidden;
}

.personas-cover-page .origin-bar {
    height: 100%;
    background: linear-gradient(90deg, #88B04B 0%, #6d8f3c 100%);
    border-radius: 12px;
    transition: width 0.3s ease;
}

.personas-cover-page .origin-percent {
    font-weight: 700;
    color: #881337;
    text-align: right;
}

/* ========================================
   ESTILOS PÁGINA 2: PERSONA DETALLE
   ======================================== */
.persona-detail-page {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
    padding: 60px;
    min-height: 100vh;
}

.personas-cover-page .persona-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    display: flex;
    gap: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.personas-cover-page .persona-avatar {
    flex-shrink: 0;
}

.personas-cover-page .avatar-emoji {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 60px;
}

.personas-cover-page .persona-info {
    flex: 1;
}

.personas-cover-page .persona-info h2 {
    font-size: 32px;
    color: #1e40af;
    margin-bottom: 20px;
}

.personas-cover-page .persona-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.personas-cover-page .detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

.personas-cover-page .detail-item i {
    color: #88B04B;
    width: 20px;
}

.personas-cover-page .section-block {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.personas-cover-page .section-block h3 {
    font-size: 20px;
    color: #1e40af;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.personas-cover-page .demo-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.personas-cover-page .demo-item {
    padding: 12px;
    background: #f5f5f5;
    border-radius: 6px;
    font-size: 14px;
}

.personas-cover-page .demo-item strong {
    color: #1e40af;
    display: block;
    margin-bottom: 5px;
}

.personas-cover-page .psico-columns {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.personas-cover-page .psico-column h4 {
    font-size: 16px;
    color: #1e40af;
    margin-bottom: 10px;
}

.personas-cover-page .psico-column ul {
    list-style: none;
    padding: 0;
}

.personas-cover-page .psico-column li {
    padding: 8px 0;
    border-bottom: 1px solid #f5f5f5;
    padding-left: 20px;
    position: relative;
    font-size: 13px;
}

.personas-cover-page .psico-column li:before {
    content: "•";
    position: absolute;
    left: 0;
    color: #88B04B;
    font-size: 18px;
}

.personas-cover-page .behavior-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.personas-cover-page .behavior-item {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

.personas-cover-page .behavior-item.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.personas-cover-page .behavior-item h4 {
    font-size: 13px;
    margin-bottom: 8px;
}

.personas-cover-page .budget {
    font-size: 18px;
    font-weight: 700;
}

.personas-cover-page .criteria-section {
    margin-top: 20px;
}

.personas-cover-page .criteria-section h4 {
    font-size: 16px;
    color: #1e40af;
    margin-bottom: 15px;
}

.personas-cover-page .criteria-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.personas-cover-page .criterion-card {
    background: #eff6ff;
    padding: 15px;
    border-radius: 8px;
    display: flex;
    gap: 10px;
    align-items: start;
    border-left: 3px solid #88B04B;
}

.personas-cover-page .criterion-number {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #88B04B;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
}

.personas-cover-page .criterion-card p {
    margin: 0;
    font-size: 13px;
    line-height: 1.5;
}

.personas-cover-page .pain-goals-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.personas-cover-page .pain-block {
    border-left: 4px solid #88B04B;
}

.personas-cover-page .goals-block {
    border-left: 4px solid #88B04B;
}

.personas-cover-page .pain-block h3 {
    color: #88B04B;
}

.personas-cover-page .goals-block h3 {
    color: #88B04B;
}

.pain-block ul,
.personas-cover-page .goals-block ul {
    list-style: none;
    padding: 0;
}

.pain-block li,
.personas-cover-page .goals-block li {
    padding: 10px 0;
    border-bottom: 1px solid #f5f5f5;
    padding-left: 25px;
    position: relative;
    font-size: 14px;
}

.personas-cover-page .pain-block li:before {
    content: "";
    position: absolute;
    left: 0;
    color: #88B04B;
}

.personas-cover-page .goals-block li:before {
    content: "";
    position: absolute;
    left: 0;
    color: #88B04B;
}

.personas-cover-page .messages-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.personas-cover-page .message-card {
    background: #eff6ff;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #88B04B;
    position: relative;
}

.personas-cover-page .message-card i {
    position: absolute;
    top: 15px;
    left: 15px;
    color: #88B04B;
    font-size: 24px;
    opacity: 0.2;
}

.personas-cover-page .message-card p {
    margin: 0;
    padding-left: 35px;
    font-size: 14px;
    font-style: italic;
    color: #1e40af;
    line-height: 1.6;
}

.personas-cover-page .keywords-block {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.personas-cover-page .keywords-block h4 {
    font-size: 18px;
    color: #1e40af;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.personas-cover-page .keywords-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.personas-cover-page .keyword-tag {
    background: #88B04B;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

/* ========================================
   ESTILOS PÁGINA 3: DUAL PERSONAS
   ======================================== */
.dual-personas-page {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
    padding: 60px;
    min-height: 100vh;
}

.personas-cover-page .compact-persona {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.personas-cover-page .compact-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f7e6;
}

.personas-cover-page .compact-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #88B04B 0%, #d97706 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    flex-shrink: 0;
}

.personas-cover-page .compact-title {
    flex: 1;
}

.personas-cover-page .compact-title h2 {
    font-size: 24px;
    color: #78350f;
    margin-bottom: 8px;
}

.personas-cover-page .compact-subtitle {
    font-size: 14px;
    color: #92400e;
    margin: 3px 0;
}

.personas-cover-page .compact-percentage {
    text-align: center;
}

.personas-cover-page .percent-value {
    font-size: 36px;
    font-weight: 700;
    color: #88B04B;
    line-height: 1;
}

.personas-cover-page .percent-label {
    font-size: 12px;
    color: #92400e;
}

.personas-cover-page .compact-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.compact-section h4,
.compact-column h4,
.personas-cover-page .compact-messages h4 {
    font-size: 16px;
    color: #78350f;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.personas-cover-page .compact-list {
    list-style: none;
    padding: 0;
}

.personas-cover-page .compact-list li {
    padding: 8px 0;
    border-bottom: 1px solid #f0f7e6;
    padding-left: 20px;
    position: relative;
    font-size: 13px;
}

.personas-cover-page .compact-list li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.personas-cover-page .compact-columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.personas-cover-page .compact-messages-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.personas-cover-page .compact-message {
    background: #f0f7e6;
    padding: 12px;
    border-radius: 6px;
    font-size: 12px;
    font-style: italic;
    color: #78350f;
    border-left: 3px solid #88B04B;
}

/* ========================================
   ESTILOS PÁGINA 4: ESTRATEGIA
   ======================================== */
.strategy-personas-page {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
    padding: 60px;
    min-height: 100vh;
}

.strategy-personas-page .persona4-compact {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.strategy-personas-page .p4-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}

.strategy-personas-page .p4-avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, #88B04B 0%, #9333ea 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 35px;
}

.strategy-personas-page .p4-info h2 {
    font-size: 22px;
    color: #14532d;
    margin-bottom: 5px;
}

.strategy-personas-page .p4-info p {
    font-size: 13px;
    color: #166534;
    margin: 2px 0;
}

.strategy-personas-page .p4-percentage {
    display: inline-block;
    background: #88B04B;
    color: white;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    margin-top: 5px;
}

.strategy-personas-page .p4-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.strategy-personas-page .p4-box {
    background: #f0f7e6;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #88B04B;
}

.strategy-personas-page .p4-box.highlight {
    background: #f0f7e6;
}

.strategy-personas-page .p4-box h4 {
    font-size: 14px;
    color: #14532d;
    margin-bottom: 10px;
}

.strategy-personas-page .p4-box ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.strategy-personas-page .p4-box li {
    padding: 5px 0;
    font-size: 12px;
    color: #166534;
}

.strategy-personas-page .p4-message {
    font-size: 12px;
    color: #14532d;
    font-style: italic;
    margin: 8px 0;
    padding-left: 12px;
    border-left: 2px solid #88B04B;
}

.strategy-personas-page .marketing-strategy {
    margin-bottom: 30px;
}

.strategy-personas-page .marketing-strategy h2 {
    font-size: 24px;
    color: #14532d;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.strategy-personas-page .strategy-persona-block {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.strategy-personas-page .strategy-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f7e6;
}

.strategy-personas-page .strategy-header h3 {
    font-size: 18px;
    color: #14532d;
    margin: 0;
}

.strategy-personas-page .priority-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.strategy-personas-page .priority-badge.priority-alta {
    background: #88B04B;
    color: white;
}

.strategy-personas-page .priority-badge.priority-media {
    background: #88B04B;
    color: white;
}

.strategy-personas-page .priority-badge.priority-baja {
    background: #787878;
    color: white;
}

.strategy-personas-page .strategy-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.strategy-personas-page .strategy-item h4 {
    font-size: 14px;
    color: #14532d;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.strategy-personas-page .strategy-item ul {
    list-style: none;
    padding: 0;
}

.strategy-personas-page .strategy-item li {
    padding: 6px 0;
    padding-left: 20px;
    position: relative;
    font-size: 13px;
    color: #166534;
}

.strategy-personas-page .strategy-item li:before {
    content: "▸";
    position: absolute;
    left: 0;
    color: #88B04B;
}

.strategy-personas-page .strategy-kpi {
    grid-column: span 2;
    background: #f0f7e6;
    padding: 12px;
    border-radius: 6px;
    font-size: 13px;
    color: #14532d;
    margin-top: 10px;
}

.budget-section,
.strategy-personas-page .objectives-section {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.budget-section h2,
.strategy-personas-page .objectives-section h2 {
    font-size: 24px;
    color: #14532d;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.strategy-personas-page .budget-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.strategy-personas-page .budget-item {
    background: #f0f7e6;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    border-left: 3px solid #88B04B;
}

.strategy-personas-page .budget-item.total {
    background: linear-gradient(135deg, #88B04B 0%, #16a34a 100%);
    color: white;
    grid-column: span 3;
    border-left: none;
}

.strategy-personas-page .budget-label {
    display: block;
    font-size: 13px;
    margin-bottom: 8px;
    font-weight: 600;
}

.strategy-personas-page .budget-value {
    display: block;
    font-size: 24px;
    font-weight: 700;
}

.strategy-personas-page .objectives-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.strategy-personas-page .objective-card {
    background: #f0f7e6;
    padding: 20px;
    border-radius: 8px;
    display: flex;
    gap: 15px;
    align-items: start;
    border-left: 4px solid #88B04B;
}

.strategy-personas-page .obj-number {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #88B04B 0%, #16a34a 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.strategy-personas-page .objective-card p {
    margin: 0;
    font-size: 14px;
    color: #14532d;
    line-height: 1.6;
}

/* ========================================
   ESTILOS COMUNES
   ======================================== */
.strategy-personas-page .page-footer {
    margin-top: 50px;
    padding-top: 20px;
    border-top: 2px solid rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #787878;
}

@media print {
    .strategy-personas-page .audit-page {
        page-break-after: always;
    }
}
</style>
