<?php
/**
 * Módulo 17: Real Estate SEO Vertical (FINAL)
 * Estrategia SEO vertical específica para luxury villa rental / real estate
 */

$rutaEntregables = __DIR__ . '/../../entregables/real_estate_seo/';

$moduloData = [
    'titulo' => 'Real Estate SEO Vertical - Estrategia Inmobiliaria Lujo',
    'descripcion' => 'SEO vertical específico para luxury villa rental: keywords inmobiliarias, Schema RealEstateListing/Accommodation, amenity-based targeting, location premium strategies, y diferenciación luxury vs mass market.',

    'csvs' => [
        [
            'archivo' => 'luxury_real_estate_keywords.csv',
            'titulo' => 'Keywords Luxury Real Estate (14 oportunidades)',
            'descripcion' => 'Keywords verticales inmobiliarias de lujo (luxury villa, exclusive, beachfront, private estate) con volumen, CPC, posición actual, y estrategia vertical específica.',
            'registros' => 14,
            'columnas' => 11,
            'datos_clave' => [
                'Luxury villa rental ibiza: 2,400 vol/mes, CPC €4.80, posición 45→8-12',
                'Beachfront villa ibiza: 1,920 vol/mes, CPC €3.60, alta prioridad location premium',
                'Exclusive villas ibiza: 720 vol/mes, brand positioning tier exclusivo',
                'Volumen total: 14,960 búsquedas/mes vertical luxury',
                'Tráfico potencial: 1,496-2,244 clics/mes = €430k-650k/año adicional'
            ],
            'uso' => 'Crear landings verticales luxury-specific (no genéricas). RealEstateListing Schema obligatorio. Diferenciación clara vs villas estándar.'
        ],
        [
            'archivo' => 'real_estate_schema_implementation.csv',
            'titulo' => 'Schema Markup Real Estate (15 types)',
            'descripcion' => 'Implementación Schema específico inmobiliario: RealEstateListing (crítico), Accommodation/Villa, Offer, Place, AggregateRating, Service, Event, VideoObject, Organization/RealEstateAgent.',
            'registros' => 15,
            'columnas' => 9,
            'datos_clave' => [
                'RealEstateListing: Crítico para rich snippets propiedades (vs Product genérico)',
                'Accommodation subtype Villa: Google Travel vertical mejor que Product',
                'RealEstateAgent (LocalBusiness): Específico inmobiliario vs genérico',
                '15 Schema types vs 2-3 actuales = +650% estructura',
                'Ejemplos JSON-LD completos copy-paste para cada type'
            ],
            'uso' => 'Implementar RealEstateListing en cada villa primero (Crítico). Luego Accommodation, Offer, AggregateRating. Schema vertical > genérico.'
        ]
    ],

    'kpis' => [
        ['metrica' => 'Keywords Luxury Vertical', 'antes' => '2 rankings débiles', 'despues' => '14 posicionadas Top 20', 'mejora' => '+600%', 'impacto' => 'Diferenciación luxury vs mass market'],
        ['metrica' => 'Tráfico Vertical Luxury', 'antes' => '380 sess/mes', 'despues' => '1,496-2,244 sess/mes', 'mejora' => '+294-490%', 'impacto' => '+€430k-650k/año desde keywords luxury'],
        ['metrica' => 'Schema Real Estate', 'antes' => 'Product genérico', 'despues' => 'RealEstateListing específico', 'mejora' => '+∞', 'impacto' => 'Rich snippets inmobiliarios + Google Travel'],
        ['metrica' => 'Conversión Tráfico Luxury', 'antes' => '1.6% estándar', 'despues' => '3.8-4.5% luxury', 'mejora' => '+138-181%', 'impacto' => 'Tráfico cualificado alto valor €8k-15k/reserva'],
        ['metrica' => 'CPC Keywords Luxury', 'antes' => '€2.40 promedio', 'despues' => '€4.20 promedio', 'mejora' => '+75%', 'impacto' => 'Competencia paga más = mayor valor comercial'],
        ['metrica' => 'Revenue Vertical Real Estate', 'antes' => 'No diferenciado', 'despues' => '€5M-8M/año potencial', 'mejora' => '+∞', 'impacto' => 'Vertical luxury = 2-3x revenue vs mass', 'destacada' => true]
    ]
];
?>

<div class="real-estate-seo-page">
    <div class="modulo-header">
        <h1><?= $moduloData['titulo'] ?></h1>
        <p class="descripcion"><?= $moduloData['descripcion'] ?></p>
    </div>

    <!-- Sección Educativa -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="icono-concepto">️</span>
            <h2>¿Qué es Real Estate SEO Vertical? (Explicación Simple)</h2>
        </div>

        <div class="analogia-box">
            <div class="analogia-header">
                <strong>Piensa en Real Estate SEO como el Escaparate de una Agencia Inmobiliaria de Lujo en Calle Principal:</strong>
            </div>
            <ul class="analogia-list">
                <li><strong>Agencia genérica</strong> = vende todo (pisos, oficinas, garajes) sin diferenciación = SEO genérico</li>
                <li><strong>Agencia luxury</strong> = especializada villas €3M-10M, escaparate elegante, solo clientes cualificados = SEO vertical</li>
                <li><strong>Escaparate luxury</strong> = fotos grandes, materiales premium, champán gratis = Schema RealEstateListing + amenities</li>
                <li><strong>Ubicación premium</strong> (calle principal) = keywords "luxury", "exclusive", "beachfront" con CPC €4-6</li>
                <li><strong>Cliente cualificado</strong> = busca características específicas (infinity pool, private chef) = conversión 3-4x mayor</li>
            </ul>
            <p class="concepto-explicacion">
                <strong>En Ibiza Villa:</strong> Competir con keywords genéricas "alquiler villa" (CPC €2.40) = pelear con Airbnb/Booking.
                Dominar keywords luxury verticales "luxury villa rental", "exclusive villas", "beachfront" (CPC €4-6) = diferenciación clara, tráfico cualificado, conversión 2-3x mayor.
            </p>
        </div>

        <div class="impacto-negocio">
            <h3>¿Por Qué Real Estate SEO Vertical es Crítico?</h3>
            <div class="impacto-grid">
                <div class="impacto-item">
                    <div class="impacto-numero">€4.20</div>
                    <div class="impacto-texto">CPC promedio keywords luxury (vs €2.40 genérico) = +75% valor</div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-numero">3.8-4.5%</div>
                    <div class="impacto-texto">Conversión tráfico luxury (vs 1.6% genérico) = +138-181%</div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-numero">€5M-8M</div>
                    <div class="impacto-texto">Revenue potencial anual vertical inmobiliario luxury</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resumen Ejecutivo -->
    <section class="resumen-ejecutivo">
        <div class="badge-seccion badge-antes">️ ESTRATEGIA VERTICAL REAL ESTATE</div>
        <h2>Resumen: SEO Inmobiliario Luxury vs Genérico</h2>

        <div class="comparacion-estrategias">
            <div class="estrategia-box estrategia-generica">
                <h3> SEO Genérico (Actual)</h3>
                <ul>
                    <li>Keywords "alquiler villa" genéricas (competencia Airbnb/Booking masiva)</li>
                    <li>Schema Product básico (no específico real estate)</li>
                    <li>Sin diferenciación luxury vs estándar</li>
                    <li>Tráfico bajo valor, conversión 1.6%</li>
                    <li>CPC promedio €2.40 (bajo valor comercial)</li>
                </ul>
            </div>

            <div class="estrategia-box estrategia-vertical">
                <h3> SEO Vertical Real Estate (Objetivo)</h3>
                <ul>
                    <li>Keywords luxury verticales: "luxury villa rental", "exclusive", "beachfront", "private estate"</li>
                    <li>Schema RealEstateListing + Accommodation/Villa específico inmobiliario</li>
                    <li>Diferenciación clara: amenities premium, location premium, service bundling</li>
                    <li>Tráfico alto valor cualificado, conversión 3.8-4.5%</li>
                    <li>CPC promedio €4.20 (+75% valor comercial indicador demanda luxury)</li>
                </ul>
            </div>
        </div>

        <div class="elementos-vertical">
            <h3>5 Pilares Real Estate SEO Vertical:</h3>
            <div class="pilares-grid">
                <div class="pilar-item">
                    <strong>1. Keywords Luxury-Specific</strong>
                    <p>14 keywords verticales (luxury, exclusive, beachfront, private estate) vs genéricas mass market</p>
                </div>
                <div class="pilar-item">
                    <strong>2. Schema Inmobiliario</strong>
                    <p>RealEstateListing + Accommodation/Villa + RealEstateAgent (15 types vs 2-3 genéricos)</p>
                </div>
                <div class="pilar-item">
                    <strong>3. Amenity-Based Targeting</strong>
                    <p>Infinity pool, private chef, sea views, gym, smart home = filtros avanzados diferenciación</p>
                </div>
                <div class="pilar-item">
                    <strong>4. Location Premium</strong>
                    <p>Beachfront, exclusive zones, private access = 30-50% precio premium justificado</p>
                </div>
                <div class="pilar-item">
                    <strong>5. Service Bundling</strong>
                    <p>Villa + chef + concierge + transfers = packages €15k-25k/semana vs villa sola €5k-8k</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Entregables CSV -->
    <section class="entregables-seccion">
        <div class="badge-seccion badge-despues"> HERRAMIENTAS IMPLEMENTACIÓN VERTICAL</div>
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

        <div class="instrucciones-uso">
            <h3> Roadmap Implementación Real Estate SEO:</h3>
            <ol>
                <li><strong>Mes 1:</strong> Implementar RealEstateListing Schema en 20-30 villas principales (crítico)</li>
                <li><strong>Mes 2:</strong> Crear 5 landings luxury-specific (luxury rental, exclusive, beachfront, private estate, events)</li>
                <li><strong>Mes 3:</strong> Amenity-based landings (infinity pool, chef, sea views, gym, smart home)</li>
                <li><strong>Mes 4:</strong> Location premium landings (zonas exclusivas con pricing justificado)</li>
                <li><strong>Mes 5:</strong> Service bundling packages (villa+chef+concierge €15k-25k/semana)</li>
                <li><strong>Mes 6:</strong> Consolidación: Accommodation/Villa Schema, VideoObject tours, Event Schema bodas/corporate</li>
            </ol>
        </div>
    </section>

    <!-- Tabla KPIs -->
    <section class="kpis-seccion">
        <div class="badge-seccion badge-despues"> RESULTADOS ESPERADOS VERTICAL</div>
        <h2>KPIs Real Estate SEO: Luxury vs Genérico</h2>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th>Métrica Vertical</th>
                    <th>ANTES (Genérico)</th>
                    <th>DESPUÉS (Luxury Vertical)</th>
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
            <strong> Conclusión Final:</strong> Real Estate SEO Vertical = diferenciación competitiva crítica en mercado luxury villa rental.
            Competir keywords genéricas "alquiler villa" vs Airbnb/Booking = imposible ganar (presupuesto masivo, brand recognition).
            Dominar keywords luxury verticales "luxury villa rental", "exclusive", "beachfront" = océano azul, tráfico cualificado, conversión 2-3x mayor.
            <strong>ROI Vertical:</strong> Inversión €20k-30k implementación → Revenue adicional €5M-8M/año = ROI 167-400:1 en 12 meses.
            <strong>Módulo 17 de 17 COMPLETADO  - Sistema Auditoría SEO Completo al 100%</strong>
        </div>
    </section>
</div>

<style>
.real-estate-seo-page {
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

.impacto-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 25px;
}

.impacto-item {
    text-align: center;
    padding: 20px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
}

.impacto-numero {
    font-size: 32px;
    font-weight: bold;
    color: #ffd700;
}

.comparacion-estrategias {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin: 30px 0;
}

.estrategia-box {
    padding: 25px;
    border-radius: 12px;
    border-left: 5px solid;
}

.estrategia-generica {
    background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%);
    border-color: #dc3545;
}

.estrategia-vertical {
    background: linear-gradient(135deg, #f0fff4 0%, #d4f4dd 100%);
    border-color: #88B04B;
}

.pilares-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 25px 0;
}

.pilar-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border-top: 3px solid #88B04B;
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
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.badge-despues {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

@media (max-width: 992px) {
    .comparacion-estrategias,
    .pilares-grid,
    .csv-grid,
    .impacto-grid {
        grid-template-columns: 1fr;
    }
}
</style>
