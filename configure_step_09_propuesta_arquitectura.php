<?php
/**
 * CONFIGURACIÓN PASO 09: PROPUESTA NUEVA ARQUITECTURA SEO
 * =======================================================
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

try {
    $pdo->beginTransaction();

    // Verificar que el paso existe
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '09_propuesta_arquitectura'";
    $step = $pdo->query($sql)->fetch();

    if (!$step) {
        throw new Exception("Paso 09_propuesta_arquitectura no encontrado");
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
            'nombre_campo' => 'nueva_navegacion_principal',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Nueva Estructura de Navegación Principal',
            'placeholder' => 'Diseña la navegación principal optimizada: menús, categorías, jerarquía basada en keywords objetivo',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Propón una navegación que refleje las keywords más importantes y facilite el crawling',
            'min_length' => 60,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'reorganizacion_categorias_taxonomias',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Reorganización de Categorías y Taxonomías',
            'placeholder' => 'Propuesta de nueva categorización lógica, intuitiva y SEO-friendly basada en análisis previo',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Rediseña la organización del contenido para mejorar findabilidad y SEO',
            'min_length' => 50,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'diseno_urls_seo_friendly',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Diseño de URLs SEO-Friendly',
            'placeholder' => 'Nuevos patrones de URLs: descriptivos, coherentes, escalables y optimizados para SEO',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Define estructura de URLs clara y consistente que soporte keywords objetivo',
            'min_length' => 50,
            'orden' => 3
        ],
        [
            'nombre_campo' => 'redistribucion_enlaces_pagerank',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Redistribución de Enlaces y PageRank',
            'placeholder' => 'Estrategia para dirigir autoridad hacia páginas comerciales clave, eliminar desperdicio de PageRank',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Optimiza el flujo de autoridad interna hacia páginas que generan conversiones',
            'min_length' => 40,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'propuesta_breadcrumbs_navegacion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Propuesta de Breadcrumbs y Navegación Contextual',
            'placeholder' => 'Diseño de breadcrumbs, navegación contextual, filtros y elementos que mejoren UX y crawling',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Mejora la navegación contextual para usuarios y motores de búsqueda',
            'min_length' => 40,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'reduccion_profundidad_paginas',
            'tipo_campo' => 'select',
            'etiqueta' => 'Estrategia de Reducción de Profundidad',
            'opciones' => '{"flat_2_niveles":"Arquitectura Flat - Máximo 2 niveles","flat_3_niveles":"Arquitectura Flat - Máximo 3 niveles","hibrida_2_3":"Híbrida - 2 niveles comercial, 3 blog","custom":"Estrategia personalizada por sección"}',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Define estrategia para reducir profundidad y mejorar crawlabilidad',
            'orden' => 6
        ],
        [
            'nombre_campo' => 'resolucion_paginas_huerfanas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Resolución de Páginas Huérfanas',
            'placeholder' => 'Estrategia para conectar páginas huérfanas importantes, eliminar innecesarias, crear enlaces estratégicos',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Asegura que todas las páginas importantes estén conectadas en la nueva arquitectura',
            'min_length' => 40,
            'orden' => 7
        ],
        [
            'nombre_campo' => 'nueva_estructura_sitemaps',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Diseño de Nueva Estructura de Sitemaps XML',
            'placeholder' => 'Propuesta de sitemaps segmentados, priorizados y optimizados para mejor indexación',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Diseña sitemaps que faciliten la indexación y comuniquen prioridades a Google',
            'min_length' => 30,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'mejoras_experiencia_usuario',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Propuesta de Mejoras en Experiencia de Usuario',
            'placeholder' => 'UX optimizations: navegación intuitiva, findabilidad, mobile-first, velocidad, accessibility',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Mejoras de UX que también beneficien el SEO y Core Web Vitals',
            'min_length' => 40,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'roadmap_implementacion_fases',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Roadmap de Implementación por Fases',
            'placeholder' => 'Plan de implementación: fases, prioridades, timeline, recursos necesarios, plan de redirects 301',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Hoja de ruta clara para implementar la nueva arquitectura sin perder autoridad',
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
    echo "\n🎉 PASO 09 CONFIGURADO EXITOSAMENTE\n";
    echo "Total de campos creados: " . count($campos) . "\n";
    echo "🏗️ PROPUESTA ARQUITECTURA SEO - FASE 3 AVANZANDO\n";

} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>