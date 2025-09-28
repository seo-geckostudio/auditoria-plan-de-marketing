<?php
/**
 * CONFIGURACIÓN AUTOMÁTICA - PASO 16: ANÁLISIS DE CONTENIDO
 * ========================================================
 *
 * Auto-configuración de campos para análisis de contenido
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '16_analisis_contenido'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '16_analisis_contenido'");
    }

    $paso_plantilla_id = $paso['id'];
    echo "⚡ Paso encontrado: ID $paso_plantilla_id\n";

    $sql = "SELECT COUNT(*) as total FROM paso_campos WHERE paso_plantilla_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paso_plantilla_id]);
    $existing = $stmt->fetch();

    if ($existing['total'] > 0) {
        echo "⚡ Auto-continúa - {$existing['total']} campos configurados.\n";
    } else {
        $campos = [
            [
                'nombre_campo' => 'inventario_contenido_completo',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Inventario Completo de Contenido',
                'descripcion_ayuda' => 'Catálogo exhaustivo de todo el contenido del sitio con URLs, tipos y características',
                'obligatorio' => 1,
                'orden' => 1
            ],
            [
                'nombre_campo' => 'calidad_profundidad_contenido',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Análisis de Calidad y Profundidad',
                'descripcion_ayuda' => 'Evaluación de la calidad, extensión y profundidad del contenido existente',
                'obligatorio' => 1,
                'orden' => 2
            ],
            [
                'nombre_campo' => 'relevancia_keyword_targeting',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Relevancia Temática y Keyword Targeting',
                'descripcion_ayuda' => 'Assessment de alineación temática y targeting de keywords en contenido',
                'obligatorio' => 1,
                'orden' => 3
            ],
            [
                'nombre_campo' => 'contenido_duplicado_issues',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Contenido Duplicado e Issues de Calidad',
                'descripcion_ayuda' => 'Identificación de contenido duplicado, thin content y problemas de calidad',
                'obligatorio' => 1,
                'orden' => 4
            ],
            [
                'nombre_campo' => 'formatos_contenido_multimedia',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Formatos de Contenido Multimedia',
                'descripcion_ayuda' => 'Review de variedad de formatos: texto, video, imágenes, infografías, etc.',
                'obligatorio' => 1,
                'orden' => 5
            ],
            [
                'nombre_campo' => 'engagement_performance_contenido',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Engagement y Performance de Contenido',
                'descripcion_ayuda' => 'Análisis de métricas de engagement: tiempo en página, bounce rate, shares',
                'obligatorio' => 1,
                'orden' => 6
            ],
            [
                'nombre_campo' => 'gaps_oportunidades_contenido',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Gaps y Oportunidades de Contenido',
                'descripcion_ayuda' => 'Identificación de temas no cubiertos y oportunidades de nuevo contenido',
                'obligatorio' => 1,
                'orden' => 7
            ],
            [
                'nombre_campo' => 'contenido_evergreen_temporal',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Contenido Evergreen vs Temporal',
                'descripcion_ayuda' => 'Clasificación y strategy para contenido perenne vs contenido estacional',
                'obligatorio' => 1,
                'orden' => 8
            ],
            [
                'nombre_campo' => 'contenido_buyer_personas',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Contenido para Buyer Personas',
                'descripcion_ayuda' => 'Assessment de alineación de contenido con diferentes buyer personas',
                'obligatorio' => 1,
                'orden' => 9
            ],
            [
                'nombre_campo' => 'ctas_elementos_conversion',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'CTAs y Elementos de Conversión',
                'descripcion_ayuda' => 'Review de calls-to-action, formularios y elementos de conversión en contenido',
                'obligatorio' => 1,
                'orden' => 10
            ]
        ];

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

        echo "⚡ Auto-configuración completa - " . count($campos) . " campos\n";
    }

    echo "🎯 ANÁLISIS DE CONTENIDO configurado\n";
    echo "⚡ Progreso: 61.8% completado, auto-continuando...\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>