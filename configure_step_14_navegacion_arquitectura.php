<?php
/**
 * CONFIGURACIÓN AUTOMÁTICA - PASO 14: ANÁLISIS NAVEGACIÓN Y ARQUITECTURA
 * =====================================================================
 *
 * Configuración de campos para el paso de análisis de navegación y arquitectura
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Obtener el ID del paso desde la base de datos
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '14_navegacion_arquitectura'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '14_navegacion_arquitectura'");
    }

    $paso_plantilla_id = $paso['id'];
    echo "✅ Paso encontrado: ID $paso_plantilla_id\n";

    // 2. Verificar si ya existen campos configurados
    $sql = "SELECT COUNT(*) as total FROM paso_campos WHERE paso_plantilla_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paso_plantilla_id]);
    $existing = $stmt->fetch();

    if ($existing['total'] > 0) {
        echo "✅ Continúa automáticamente - {$existing['total']} campos ya configurados.\n";
    } else {
        // 3. Configuración de campos para análisis navegación y arquitectura
        $campos = [
            [
                'nombre_campo' => 'mapa_navegacion_principal',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Mapa de Navegación Principal y Secundaria',
                'descripcion_ayuda' => 'Estructura completa de menús, navegación principal, secundaria y footer',
                'obligatorio' => 1,
                'orden' => 1
            ],
            [
                'nombre_campo' => 'profundidad_paginas_clicks',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Profundidad de Páginas y Clicks to Content',
                'descripcion_ayuda' => 'Análisis de cuántos clicks requieren las páginas importantes desde la homepage',
                'obligatorio' => 1,
                'orden' => 2
            ],
            [
                'nombre_campo' => 'breadcrumbs_navegacion_contextual',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Breadcrumbs y Navegación Contextual',
                'descripcion_ayuda' => 'Evaluación de breadcrumbs, navegación contextual y orientación del usuario',
                'obligatorio' => 1,
                'orden' => 3
            ],
            [
                'nombre_campo' => 'menus_filtros_sistemas',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Menús, Filtros y Sistemas de Navegación',
                'descripcion_ayuda' => 'Review de menús desplegables, filtros, búsqueda interna y sistemas especiales',
                'obligatorio' => 1,
                'orden' => 4
            ],
            [
                'nombre_campo' => 'enlaces_internos_link_juice',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Enlaces Internos y Distribución de Link Juice',
                'descripcion_ayuda' => 'Análisis de linking interno, anchor texts y distribución de autoridad',
                'obligatorio' => 1,
                'orden' => 5
            ],
            [
                'nombre_campo' => 'arquitectura_categorias_taxonomias',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Arquitectura de Categorías y Taxonomías',
                'descripcion_ayuda' => 'Evaluación de estructura de categorías, tags y organización de contenido',
                'obligatorio' => 1,
                'orden' => 6
            ],
            [
                'nombre_campo' => 'url_structure_jerarquia',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'URL Structure y Jerarquía Lógica',
                'descripcion_ayuda' => 'Assessment de estructura de URLs, jerarquía lógica y SEO-friendliness',
                'obligatorio' => 1,
                'orden' => 7
            ],
            [
                'nombre_campo' => 'navegacion_movil_responsive',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Navegación Móvil y Usabilidad Responsive',
                'descripcion_ayuda' => 'Review de navegación en dispositivos móviles y experiencia responsive',
                'obligatorio' => 1,
                'orden' => 8
            ],
            [
                'nombre_campo' => 'sitemap_vs_navegacion_real',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Sitemap XML vs Navegación Real',
                'descripcion_ayuda' => 'Comparación entre sitemap XML declarado y navegación real del sitio',
                'obligatorio' => 1,
                'orden' => 9
            ],
            [
                'nombre_campo' => 'paginas_huerfanas_dead_ends',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Páginas Huérfanas y Dead Ends',
                'descripcion_ayuda' => 'Identificación de páginas sin enlaces internos y callejones sin salida',
                'obligatorio' => 1,
                'orden' => 10
            ]
        ];

        // 4. Insertar campos en la base de datos
        $sql = "INSERT INTO paso_campos (paso_plantilla_id, nombre_campo, tipo_campo, etiqueta, descripcion_ayuda, obligatorio, orden)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        foreach ($campos as $campo) {
            $stmt->execute([
                $paso_plantilla_id,
                $campo['nombre_campo'],
                $campo['tipo_campo'],
                $campo['etiqueta'],
                $campo['descripcion_ayuda'],
                $campo['obligatorio'],
                $campo['orden']
            ]);
        }

        echo "✅ Configuración completada exitosamente\n";
        echo "📊 Total de campos configurados: " . count($campos) . "\n";
    }

    echo "🎯 Paso: ANÁLISIS NAVEGACIÓN Y ARQUITECTURA\n";
    echo "🔧 Continuando automáticamente con próximo paso...\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>