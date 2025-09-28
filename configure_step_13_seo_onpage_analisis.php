<?php
/**
 * CONFIGURACIÓN AUTOMÁTICA - PASO 13: ANÁLISIS SEO ON-PAGE
 * ========================================================
 *
 * Configuración de campos para el paso de análisis SEO On-Page
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Obtener el ID del paso desde la base de datos
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '13_seo_onpage_analisis'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '13_seo_onpage_analisis'");
    }

    $paso_plantilla_id = $paso['id'];
    echo "✅ Paso encontrado: ID $paso_plantilla_id\n";

    // 2. Verificar si ya existen campos configurados
    $sql = "SELECT COUNT(*) as total FROM paso_campos WHERE paso_plantilla_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paso_plantilla_id]);
    $existing = $stmt->fetch();

    if ($existing['total'] > 0) {
        echo "⚠️  Ya existen {$existing['total']} campos configurados para este paso.\n";
        echo "✅ Continúa automáticamente con campos existentes.\n";
    } else {
        // 3. Configuración de campos para análisis SEO On-Page
        $campos = [
            [
                'nombre_campo' => 'auditoria_meta_tags',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Auditoría Completa de Meta Tags',
                'descripcion_ayuda' => 'Análisis de title tags, meta descriptions, headers H1-H6 y su optimización',
                'obligatorio' => 1,
                'orden' => 1
            ],
            [
                'nombre_campo' => 'estructura_urls_arquitectura',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Estructura de URLs y Arquitectura Interna',
                'descripcion_ayuda' => 'Evaluación de URLs SEO-friendly, jerarquía y navegación interna',
                'obligatorio' => 1,
                'orden' => 2
            ],
            [
                'nombre_campo' => 'optimizacion_contenido_keywords',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Optimización de Contenido y Keywords',
                'descripcion_ayuda' => 'Análisis de keyword density, relevancia de contenido y optimización semántica',
                'obligatorio' => 1,
                'orden' => 3
            ],
            [
                'nombre_campo' => 'imagenes_multimedia_optimization',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Optimización de Imágenes y Multimedia',
                'descripcion_ayuda' => 'Review de alt texts, file names, compresión y optimización multimedia',
                'obligatorio' => 1,
                'orden' => 4
            ],
            [
                'nombre_campo' => 'enlaces_internos_authority',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Enlaces Internos y Distribución de Authority',
                'descripcion_ayuda' => 'Análisis de linking interno, anchor texts y distribución de PageRank',
                'obligatorio' => 1,
                'orden' => 5
            ],
            [
                'nombre_campo' => 'schema_datos_estructurados',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Schema Markup y Datos Estructurados',
                'descripcion_ayuda' => 'Evaluación de implementación de schema.org y rich snippets',
                'obligatorio' => 1,
                'orden' => 6
            ],
            [
                'nombre_campo' => 'factores_experiencia_usuario',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Factores de Experiencia de Usuario (UX)',
                'descripcion_ayuda' => 'Assessment de usabilidad, navegación y factores UX que impactan SEO',
                'obligatorio' => 1,
                'orden' => 7
            ],
            [
                'nombre_campo' => 'performance_core_web_vitals',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Performance y Core Web Vitals',
                'descripcion_ayuda' => 'Análisis de velocidad, LCP, FID, CLS y métricas de rendimiento',
                'obligatorio' => 1,
                'orden' => 8
            ],
            [
                'nombre_campo' => 'optimizacion_movil_responsive',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Optimización Móvil y Responsive Design',
                'descripcion_ayuda' => 'Evaluación de mobile-friendliness y experiencia en dispositivos móviles',
                'obligatorio' => 1,
                'orden' => 9
            ],
            [
                'nombre_campo' => 'contenido_duplicado_issues',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Contenido Duplicado e Issues Técnicos',
                'descripcion_ayuda' => 'Identificación de contenido duplicado, canonical tags y problemas técnicos',
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

    echo "🎯 Paso: ANÁLISIS SEO ON-PAGE\n";
    echo "🔧 Los campos están listos para ser utilizados en el formulario\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>