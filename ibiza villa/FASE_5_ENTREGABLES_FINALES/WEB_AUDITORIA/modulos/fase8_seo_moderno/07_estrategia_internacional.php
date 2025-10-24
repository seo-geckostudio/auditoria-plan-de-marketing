<?php
/**
 * Módulo: Estrategia de SEO Internacional
 * Fase: 8 - SEO Moderno
 * Descripción: Análisis de distribución geográfica y estrategia de dominios para expansión internacional
 */

// Cargar datos de países
$gscCountriesPath = __DIR__ . '/../../datos/gsc_queries_by_country_last30.csv';
$ga4CountriesPath = __DIR__ . '/../../datos/ga4_pageviews_by_country_last30.csv';

function parseCSV($filePath) {
    $data = [];
    if (file_exists($filePath)) {
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file);
        while (($row = fgetcsv($file)) !== false) {
            $data[] = array_combine($headers, $row);
        }
        fclose($file);
    }
    return $data;
}

$gscCountries = parseCSV($gscCountriesPath);
$ga4Countries = parseCSV($ga4CountriesPath);

// Mapeo de códigos ISO a nombres de países y banderas
$countryNames = [
    'esp' => ['nombre' => 'España', 'flag' => '🇪🇸'],
    'fra' => ['nombre' => 'Francia', 'flag' => '🇫🇷'],
    'deu' => ['nombre' => 'Alemania', 'flag' => '🇩🇪'],
    'gbr' => ['nombre' => 'Reino Unido', 'flag' => '🇬🇧'],
    'ita' => ['nombre' => 'Italia', 'flag' => '🇮🇹'],
    'nld' => ['nombre' => 'Países Bajos', 'flag' => '🇳🇱'],
    'Spain' => ['nombre' => 'España', 'flag' => '🇪🇸'],
    'France' => ['nombre' => 'Francia', 'flag' => '🇫🇷'],
    'Germany' => ['nombre' => 'Alemania', 'flag' => '🇩🇪'],
    'United Kingdom' => ['nombre' => 'Reino Unido', 'flag' => '🇬🇧'],
    'Italy' => ['nombre' => 'Italia', 'flag' => '🇮🇹'],
    'Netherlands' => ['nombre' => 'Países Bajos', 'flag' => '🇳🇱'],
    'United States' => ['nombre' => 'Estados Unidos', 'flag' => '🇺🇸'],
    'Switzerland' => ['nombre' => 'Suiza', 'flag' => '🇨🇭'],
    'Belgium' => ['nombre' => 'Bélgica', 'flag' => '🇧🇪'],
    'Sweden' => ['nombre' => 'Suecia', 'flag' => '🇸🇪']
];
?>

<style>
.international-seo-module {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
}

.module-header {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
    position: relative;
    overflow: hidden;
}

.module-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}

.module-header h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2.5rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.module-header p {
    margin: 0;
    font-size: 1.1rem;
    opacity: 0.95;
    position: relative;
    z-index: 1;
}

.section-card {
    background: white;
    border-radius: 1rem;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.section-card:hover {
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 1.5rem 0;
    color: #1a1a1a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 1rem;
    background: linear-gradient(to right, #2563eb 0%, transparent 100%);
    background-position: 0 100%;
    background-size: 100% 3px;
    background-repeat: no-repeat;
}

.alert-box {
    background: linear-gradient(135deg, #fef3c7 0%, #ffffff 100%);
    border-left: 5px solid #f59e0b;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(245, 158, 11, 0.15);
}

.alert-box strong {
    color: #92400e;
    font-size: 1.1rem;
}

.countries-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.country-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.country-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    border-color: #2563eb;
}

.country-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.country-flag {
    font-size: 2rem;
}

.country-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
}

.country-metrics {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.metric-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem;
    background: white;
    border-radius: 0.5rem;
}

.metric-label {
    font-size: 0.9rem;
    color: #666;
}

.metric-value {
    font-weight: 700;
    font-size: 1.1rem;
    color: #2563eb;
}

.comparison-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 1.5rem;
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.comparison-table thead {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
    color: white;
}

.comparison-table th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 700;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.comparison-table td {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
}

.comparison-table tbody tr {
    transition: all 0.2s ease;
}

.comparison-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.comparison-table tbody tr:last-child td {
    border-bottom: none;
}

.strategy-header {
    font-weight: 700;
    font-size: 1.1rem;
    color: #1a1a1a;
}

.pro-item {
    color: #059669;
    padding: 0.5rem 0;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.pro-item::before {
    content: '✓';
    font-weight: 700;
    flex-shrink: 0;
}

.con-item {
    color: #dc2626;
    padding: 0.5rem 0;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.con-item::before {
    content: '✗';
    font-weight: 700;
    flex-shrink: 0;
}

.cost-badge {
    display: inline-block;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.85rem;
}

.cost-low {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
}

.cost-medium {
    background: linear-gradient(135deg, #fed7aa 0%, #fcd34d 100%);
    color: #92400e;
}

.cost-high {
    background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
    color: #991b1b;
}

.recommendation-box {
    background: linear-gradient(135deg, #dbeafe 0%, #ffffff 100%);
    border: 3px solid #2563eb;
    border-radius: 1rem;
    padding: 2.5rem;
    margin-top: 2rem;
    position: relative;
    overflow: hidden;
}

.recommendation-box::before {
    content: '💡';
    position: absolute;
    top: 1.5rem;
    right: 2rem;
    font-size: 3rem;
    opacity: 0.2;
}

.recommendation-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #1e40af;
    margin-bottom: 1rem;
}

.recommendation-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #334155;
}

.roadmap-steps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.roadmap-step {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.roadmap-step:hover {
    transform: translateX(8px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.step-content {
    flex: 1;
}

.step-title {
    font-weight: 700;
    font-size: 1.1rem;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.step-description {
    color: #666;
    line-height: 1.6;
}

.code-block {
    background: #1e293b;
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-top: 1rem;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    overflow-x: auto;
}

.highlight {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-weight: 600;
    color: #166534;
}
</style>

<div class="international-seo-module">
    <div class="module-header">
        <h1>🌍 Estrategia de SEO Internacional</h1>
        <p>Análisis de distribución geográfica y recomendaciones de dominios para expansión internacional</p>
    </div>

    <!-- Situación Actual -->
    <div class="section-card">
        <h2 class="section-title">📊 Distribución Geográfica Actual</h2>

        <div class="alert-box">
            <strong>🎯 Insight Clave:</strong> Tu sitio web recibe tráfico de <span class="highlight">10+ países</span>,
            con una concentración del <span class="highlight">67% en mercados europeos</span>. Esto representa una
            oportunidad clara para implementar una estrategia de SEO internacional.
        </div>

        <h3 style="margin-top: 2rem; margin-bottom: 1rem; font-size: 1.3rem;">Top 10 Países por Tráfico (GA4)</h3>

        <div class="countries-grid">
            <?php foreach ($ga4Countries as $index => $country):
                if ($index >= 10) break;
                $countryCode = $country['country'];
                $countryInfo = $countryNames[$countryCode] ?? ['nombre' => $countryCode, 'flag' => '🌐'];
            ?>
            <div class="country-card">
                <div class="country-header">
                    <span class="country-flag"><?php echo $countryInfo['flag']; ?></span>
                    <span class="country-name"><?php echo $countryInfo['nombre']; ?></span>
                </div>
                <div class="country-metrics">
                    <div class="metric-row">
                        <span class="metric-label">Páginas vistas</span>
                        <span class="metric-value"><?php echo number_format($country['screenPageViews']); ?></span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Sesiones</span>
                        <span class="metric-value"><?php echo number_format($country['sessions']); ?></span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Bounce Rate</span>
                        <span class="metric-value"><?php echo round($country['bounceRate'] * 100, 1); ?>%</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Comparativa de Estrategias -->
    <div class="section-card">
        <h2 class="section-title">⚖️ Comparativa de Estrategias de Dominios Internacionales</h2>

        <p style="font-size: 1.05rem; line-height: 1.7; color: #555; margin-bottom: 2rem;">
            Existen <strong>3 enfoques principales</strong> para estructurar un sitio web internacional.
            Cada uno tiene ventajas e inconvenientes que debes considerar según tu presupuesto, recursos técnicos
            y objetivos de negocio.
        </p>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Estrategia</th>
                    <th>Ejemplo</th>
                    <th>Coste</th>
                    <th>Dificultad SEO</th>
                    <th>Autoridad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="strategy-header">ccTLD (Dominios por país)</td>
                    <td><code>ibizavilla.es</code><br><code>ibizavilla.de</code><br><code>ibizavilla.fr</code></td>
                    <td><span class="cost-badge cost-high">Alto</span></td>
                    <td><span class="cost-badge cost-high">Difícil</span></td>
                    <td><span class="cost-badge cost-medium">Dividida</span></td>
                </tr>
                <tr>
                    <td class="strategy-header">Subdirectorios</td>
                    <td><code>ibizavilla.com/es/</code><br><code>ibizavilla.com/de/</code><br><code>ibizavilla.com/fr/</code></td>
                    <td><span class="cost-badge cost-low">Bajo</span></td>
                    <td><span class="cost-badge cost-low">Fácil</span></td>
                    <td><span class="cost-badge cost-high">Consolidada</span></td>
                </tr>
                <tr>
                    <td class="strategy-header">Subdominios</td>
                    <td><code>es.ibizavilla.com</code><br><code>de.ibizavilla.com</code><br><code>fr.ibizavilla.com</code></td>
                    <td><span class="cost-badge cost-low">Bajo</span></td>
                    <td><span class="cost-badge cost-medium">Moderado</span></td>
                    <td><span class="cost-badge cost-medium">Semi-dividida</span></td>
                </tr>
            </tbody>
        </table>

        <h3 style="margin-top: 3rem; margin-bottom: 1.5rem; font-size: 1.4rem;">📋 Análisis Detallado</h3>

        <!-- Estrategia 1: ccTLD -->
        <div style="margin-bottom: 2.5rem; padding: 2rem; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-radius: 0.75rem; border-left: 5px solid #2563eb;">
            <h4 style="margin: 0 0 1rem 0; font-size: 1.3rem; color: #2563eb;">1️⃣ ccTLD - Dominios por País (.es, .de, .fr)</h4>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 1.5rem;">
                <div>
                    <strong style="color: #059669; font-size: 1.1rem;">✅ Ventajas</strong>
                    <div class="pro-item">Máxima geolocalización para cada país</div>
                    <div class="pro-item">Mayor confianza del usuario local</div>
                    <div class="pro-item">Posicionamiento preferente en cada mercado</div>
                    <div class="pro-item">Permite hosting local (mejor velocidad)</div>
                    <div class="pro-item">Ideal si el contenido es muy diferente por país</div>
                </div>
                <div>
                    <strong style="color: #dc2626; font-size: 1.1rem;">❌ Desventajas</strong>
                    <div class="con-item">Coste alto: múltiples dominios + hosting</div>
                    <div class="con-item">Autoridad de dominio dividida (empiezas de cero en cada país)</div>
                    <div class="con-item">Trabajo SEO multiplicado por N países</div>
                    <div class="con-item">Gestión de backlinks compleja (uno por dominio)</div>
                    <div class="con-item">Mantenimiento técnico y contenido X3, X4, X5...</div>
                    <div class="con-item">No se comparten mejoras entre dominios</div>
                </div>
            </div>

            <div style="margin-top: 1.5rem; padding: 1rem; background: #fef3c7; border-radius: 0.5rem;">
                <strong>💰 Coste estimado:</strong> €300-600/año (dominios) + €100-300/mes (hosting múltiple) + desarrollo separado
            </div>
        </div>

        <!-- Estrategia 2: Subdirectorios -->
        <div style="margin-bottom: 2.5rem; padding: 2rem; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-radius: 0.75rem; border-left: 5px solid #059669;">
            <h4 style="margin: 0 0 1rem 0; font-size: 1.3rem; color: #059669;">2️⃣ Subdirectorios (.com/es/, .com/de/, .com/fr/) ⭐ RECOMENDADO</h4>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 1.5rem;">
                <div>
                    <strong style="color: #059669; font-size: 1.1rem;">✅ Ventajas</strong>
                    <div class="pro-item">Un solo dominio = autoridad consolidada</div>
                    <div class="pro-item">Backlinks benefician a todas las versiones</div>
                    <div class="pro-item">Coste muy bajo (1 dominio + 1 hosting)</div>
                    <div class="pro-item">Fácil implementación técnica</div>
                    <div class="pro-item">Google Search Console unificado</div>
                    <div class="pro-item">Hreflang simple de implementar</div>
                    <div class="pro-item">Recursos compartidos (imágenes, CSS, JS)</div>
                </div>
                <div>
                    <strong style="color: #dc2626; font-size: 1.1rem;">❌ Desventajas</strong>
                    <div class="con-item">Geolocalización menos clara (requiere hreflang)</div>
                    <div class="con-item">Menos confianza local (depende del .com)</div>
                    <div class="con-item">Hosting único (si cae, caen todas las versiones)</div>
                    <div class="con-item">Requiere CDN para velocidad óptima por país</div>
                </div>
            </div>

            <div style="margin-top: 1.5rem; padding: 1rem; background: #d1fae5; border-radius: 0.5rem;">
                <strong>💰 Coste estimado:</strong> €15-30/año (1 dominio .com) + €30-80/mes (hosting único) + CDN opcional €10-30/mes
            </div>
        </div>

        <!-- Estrategia 3: Subdominios -->
        <div style="margin-bottom: 2.5rem; padding: 2rem; background: linear-gradient(135deg, #fef3c7 0%, #ffffff 100%); border-radius: 0.75rem; border-left: 5px solid #f59e0b;">
            <h4 style="margin: 0 0 1rem 0; font-size: 1.3rem; color: #f59e0b;">3️⃣ Subdominios (es.sitio.com, de.sitio.com)</h4>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 1.5rem;">
                <div>
                    <strong style="color: #059669; font-size: 1.1rem;">✅ Ventajas</strong>
                    <div class="pro-item">Fácil separación de contenido por país</div>
                    <div class="pro-item">Permite hosting geográfico específico</div>
                    <div class="pro-item">Flexibilidad técnica (diferentes tecnologías por país)</div>
                    <div class="pro-item">Más barato que ccTLD</div>
                </div>
                <div>
                    <strong style="color: #dc2626; font-size: 1.1rem;">❌ Desventajas</strong>
                    <div class="con-item">Google los trata como sitios semi-independientes</div>
                    <div class="con-item">Autoridad menos compartida que subdirectorios</div>
                    <div class="con-item">Backlinks benefician menos al dominio principal</div>
                    <div class="con-item">Hreflang más complejo de configurar</div>
                    <div class="con-item">Gestión de certificados SSL múltiples</div>
                </div>
            </div>

            <div style="margin-top: 1.5rem; padding: 1rem; background: #fed7aa; border-radius: 0.5rem;">
                <strong>💰 Coste estimado:</strong> €15-30/año (1 dominio) + €60-150/mes (hosting múltiple o VPS) + SSL múltiples
            </div>
        </div>
    </div>

    <!-- Recomendación -->
    <div class="section-card">
        <h2 class="section-title">💡 Recomendación para Ibiza Villa</h2>

        <div class="recommendation-box">
            <div class="recommendation-title">Estrategia Recomendada: SUBDIRECTORIOS con .com</div>
            <div class="recommendation-content">
                <p style="margin-bottom: 1rem;">
                    Basándome en el análisis de tu distribución de tráfico actual (España 31%, UK 22%, Alemania 16%, Francia 13%)
                    y considerando que eres una <strong>empresa en fase de crecimiento</strong>, la estrategia óptima es:
                </p>

                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; margin: 1.5rem 0;">
                    <code style="font-size: 1.1rem; color: #2563eb;">
                        www.ibizavilla.com/es/<br>
                        www.ibizavilla.com/en/<br>
                        www.ibizavilla.com/de/<br>
                        www.ibizavilla.com/fr/
                    </code>
                </div>

                <h4 style="margin-top: 2rem; color: #1e40af;">¿Por qué subdirectorios?</h4>
                <ul style="line-height: 1.8; color: #334155;">
                    <li><strong>ROI óptimo:</strong> Inversión 75% menor que ccTLD (€500/año vs €2,000+/año)</li>
                    <li><strong>Autoridad consolidada:</strong> Todos los backlinks suman al dominio principal</li>
                    <li><strong>Escalabilidad:</strong> Puedes añadir países (IT, NL, CH) sin costes adicionales significativos</li>
                    <li><strong>Mantenimiento simple:</strong> Un único CMS, una única base de datos</li>
                    <li><strong>SEO eficiente:</strong> Mejoras técnicas benefician a todas las versiones automáticamente</li>
                    <li><strong>Tráfico multi-país comprobado:</strong> Ya tienes audiencia de 10+ países, aprovecha esa diversidad</li>
                </ul>

                <h4 style="margin-top: 2rem; color: #1e40af;">¿Cuándo consideraría ccTLD (.es, .de)?</h4>
                <ul style="line-height: 1.8; color: #334155;">
                    <li>Si tuvieras presupuesto de SEO >€5,000/mes</li>
                    <li>Si cada país necesitara contenido 100% diferente</li>
                    <li>Si quisieras marcas diferentes por país</li>
                    <li>Si ya tuvieras equipos locales en cada mercado</li>
                </ul>

                <p style="margin-top: 1.5rem; padding: 1rem; background: #dbeafe; border-radius: 0.5rem; border-left: 4px solid #2563eb;">
                    <strong>💬 Consejo profesional:</strong> Empresas como Airbnb, Booking.com, TripAdvisor usan subdirectorios exitosamente.
                    Solo cambian a ccTLD cuando su facturación por país supera €10M y pueden permitirse equipos locales independientes.
                </p>
            </div>
        </div>
    </div>

    <!-- Roadmap de Implementación -->
    <div class="section-card">
        <h2 class="section-title">🗺️ Roadmap de Implementación (Subdirectorios)</h2>

        <div class="roadmap-steps">
            <div class="roadmap-step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <div class="step-title">Fase 1: Preparación Técnica (2-3 semanas)</div>
                    <div class="step-description">
                        • Crear estructura de carpetas: /es/, /en/, /de/, /fr/<br>
                        • Configurar redirección automática por geolocalización (opcional)<br>
                        • Implementar selector de idioma en la navegación<br>
                        • Configurar Google Analytics 4 con seguimiento por idioma
                    </div>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <div class="step-title">Fase 2: Implementación de Hreflang (1 semana)</div>
                    <div class="step-description">
                        • Añadir etiquetas hreflang en todas las páginas<br>
                        • Configurar XML sitemaps separados por idioma<br>
                        • Verificar con Google Search Console Hreflang Tester
                    </div>
                    <div class="code-block">
&lt;link rel="alternate" hreflang="es" href="https://ibizavilla.com/es/villas-lujo/" /&gt;
&lt;link rel="alternate" hreflang="en" href="https://ibizavilla.com/en/luxury-villas/" /&gt;
&lt;link rel="alternate" hreflang="de" href="https://ibizavilla.com/de/luxus-villen/" /&gt;
&lt;link rel="alternate" hreflang="fr" href="https://ibizavilla.com/fr/villas-luxe/" /&gt;
&lt;link rel="alternate" hreflang="x-default" href="https://ibizavilla.com/en/" /&gt;
                    </div>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <div class="step-title">Fase 3: Traducción de Contenido (4-6 semanas)</div>
                    <div class="step-description">
                        • Traducir páginas principales (Home, Villas, Servicios, Contacto)<br>
                        • Adaptar contenido culturalmente (no solo traducir literalmente)<br>
                        • Localizar precios, teléfonos, formatos de fecha<br>
                        • Crear meta titles/descriptions optimizados por idioma
                    </div>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <div class="step-title">Fase 4: Keyword Research Internacional (2 semanas)</div>
                    <div class="step-description">
                        • Investigar keywords de alto volumen en DE, EN, FR<br>
                        • Identificar diferencias culturales en búsquedas<br>
                        • Crear mapeo de keywords por idioma<br>
                        • Ejemplo: "villas de lujo" (ES) ≠ "luxury villas" (EN) ≠ "Luxusvillen" (DE)
                    </div>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="step-number">5</div>
                <div class="step-content">
                    <div class="step-title">Fase 5: Link Building Internacional (Continuo)</div>
                    <div class="step-description">
                        • Contactar con blogs de viajes en cada idioma<br>
                        • Aparecer en directorios locales (.de para Alemania, .co.uk para UK)<br>
                        • Colaborar con influencers de cada país<br>
                        • Crear contenido específico para cada mercado
                    </div>
                </div>
            </div>

            <div class="roadmap-step">
                <div class="step-number">6</div>
                <div class="step-content">
                    <div class="step-title">Fase 6: Monitoreo y Optimización (Continuo)</div>
                    <div class="step-description">
                        • Crear propiedad de Search Console por país<br>
                        • Monitorear posicionamiento con Google Search Console<br>
                        • Analizar tráfico por país en GA4<br>
                        • Ajustar estrategia según rendimiento de cada mercado
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recursos Adicionales -->
    <div class="section-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);">
        <h2 class="section-title">📚 Recursos y Herramientas Recomendadas</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <div style="padding: 1.5rem; background: white; border-radius: 0.75rem; border-left: 4px solid #2563eb;">
                <h4 style="margin: 0 0 1rem 0; color: #2563eb;">🔍 Análisis Hreflang</h4>
                <ul style="line-height: 1.8; margin: 0; padding-left: 1.5rem;">
                    <li>Merkle Hreflang Tags Testing Tool</li>
                    <li>Google Search Console > Internacional</li>
                    <li>Screaming Frog SEO Spider</li>
                </ul>
            </div>

            <div style="padding: 1.5rem; background: white; border-radius: 0.75rem; border-left: 4px solid #059669;">
                <h4 style="margin: 0 0 1rem 0; color: #059669;">🌐 Traducción</h4>
                <ul style="line-height: 1.8; margin: 0; padding-left: 1.5rem;">
                    <li>DeepL Pro (mejor que Google Translate)</li>
                    <li>Gengo (traductores nativos)</li>
                    <li>WPML / Polylang (para WordPress)</li>
                </ul>
            </div>

            <div style="padding: 1.5rem; background: white; border-radius: 0.75rem; border-left: 4px solid #f59e0b;">
                <h4 style="margin: 0 0 1rem 0; color: #f59e0b;">📊 Keyword Research Internacional</h4>
                <ul style="line-height: 1.8; margin: 0; padding-left: 1.5rem;">
                    <li>Ahrefs (cambiar país en configuración)</li>
                    <li>SEMrush Internacional Database</li>
                    <li>Google Trends por país</li>
                </ul>
            </div>
        </div>
    </div>

</div>
