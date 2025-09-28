<?php
/**
 * CONFIGURACIÓN PASO 07: ANÁLISIS ARQUITECTURA ACTUAL DEL SITIO
 * ============================================================
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

try {
    $pdo->beginTransaction();

    // Verificar que el paso existe
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '07_arquitectura_actual'";
    $step = $pdo->query($sql)->fetch();

    if (!$step) {
        throw new Exception("Paso 07_arquitectura_actual no encontrado");
    }

    $step_id = $step['id'];
    echo "Configurando campos para paso ID: $step_id\n";

    // Eliminar campos existentes si los hay
    $sql = "DELETE FROM paso_campos WHERE paso_plantilla_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$step_id]);

    // Definir campos del formulario
    $campos = [
        [
            'nombre_campo' => 'mapa_arquitectura_actual',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Mapa de Arquitectura de Información Actual',
            'placeholder' => 'Describe la estructura actual del sitio: navegación principal, categorías, subcategorías, jerarquía de páginas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Mapea visualmente la arquitectura de información actual usando Screaming Frog',
            'min_length' => 60,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'estructura_urls_patron',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Estructura de URLs y Patrones',
            'placeholder' => 'Analiza patrones de URLs, nomenclatura, organización por secciones, coherencia y SEO-friendliness',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Evalúa la estructura de URLs actual identificando patrones y inconsistencias',
            'min_length' => 50,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'navegacion_principal_secundaria',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Navegación Principal y Secundaria',
            'placeholder' => 'Evalúa menús principales, footers, sidebars, navegación contextual, breadcrumbs y su efectividad',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Analiza todos los elementos de navegación y su impacto en UX y SEO',
            'min_length' => 50,
            'orden' => 3
        ],
        [
            'nombre_campo' => 'categorizacion_taxonomias',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Categorización y Taxonomías',
            'placeholder' => 'Analiza la lógica de categorización, taxonomías, etiquetas, organización de contenido por temas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Evalúa si la categorización es intuitiva y apoya los objetivos SEO',
            'min_length' => 40,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'enlaces_internos_pagerank',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Enlaces Internos y Distribución de PageRank',
            'placeholder' => 'Analiza flujo de enlaces internos, distribución de autoridad, páginas con más/menos enlaces',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Usa Ahrefs Internal Links Report y Screaming Frog All Inlinks.csv',
            'min_length' => 40,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'profundidad_paginas_clics',
            'tipo_campo' => 'select',
            'etiqueta' => 'Profundidad de Páginas y Regla de Clics',
            'opciones' => '{"excelente":"Excelente - Max 3 clics a todas las páginas","buena":"Buena - Max 4 clics a páginas importantes","regular":"Regular - Algunas páginas requieren 5+ clics","mala":"Mala - Muchas páginas muy profundas","critica":"Crítica - Páginas importantes muy enterradas"}',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Evalúa cuántos clics requiere llegar a páginas importantes desde home',
            'orden' => 6
        ],
        [
            'nombre_campo' => 'paginas_huerfanas_problemas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Páginas Huérfanas y Problemas de Enlazado',
            'placeholder' => 'Lista páginas sin enlaces internos, páginas con pocos enlaces entrantes, oportunidades perdidas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Identifica páginas sin enlaces internos usando análisis de Screaming Frog',
            'min_length' => 40,
            'orden' => 7
        ],
        [
            'nombre_campo' => 'sitemaps_xml_indexacion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Sitemaps XML y Estado de Indexación',
            'placeholder' => 'Analiza sitemaps actuales, páginas incluidas/excluidas, errores de indexación en GSC',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Usa Google Search Console Coverage report para análisis completo',
            'min_length' => 30,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'usabilidad_experiencia_usuario',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Usabilidad y Experiencia de Usuario',
            'placeholder' => 'Evalúa facilidad de navegación, encontrabilidad de contenido, flujos de usuario, mobile experience',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Analiza comportamiento de usuarios con GA4 y herramientas de heatmaps',
            'min_length' => 40,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'oportunidades_mejora_arquitectura',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Oportunidades de Mejora Identificadas',
            'placeholder' => 'Lista priorizada de mejoras: navegación, enlaces internos, estructura URLs, categorización',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Prioriza las mejoras por impacto SEO y factibilidad de implementación',
            'min_length' => 50,
            'orden' => 10
        ]
    ];

    // Insertar campos
    $sql = "INSERT INTO paso_campos (
        paso_plantilla_id, nombre_campo, tipo_campo, etiqueta, placeholder,
        descripcion_ayuda, opciones, obligatorio, orden, min_length, activo, fecha_creacion
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, datetime('now'))";

    $stmt = $pdo->prepare($sql);

    foreach ($campos as $campo) {
        $stmt->execute([
            $step_id,
            $campo['nombre_campo'],
            $campo['tipo_campo'],
            $campo['etiqueta'],
            $campo['placeholder'] ?? null,
            $campo['descripcion_ayuda'] ?? null,
            $campo['opciones'] ?? null,
            $campo['obligatorio'],
            $campo['orden'],
            $campo['min_length'] ?? null
        ]);

        echo "✓ Campo creado: " . $campo['etiqueta'] . "\n";
    }

    $pdo->commit();
    echo "\n🎉 PASO 07 CONFIGURADO EXITOSAMENTE\n";
    echo "Total de campos creados: " . count($campos) . "\n";
    echo "🏗️ ANÁLISIS ARQUITECTURA ACTUAL - FASE 3 EN PROGRESO\n";

} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>