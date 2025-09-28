<?php
/**
 * CONFIGURACIÓN AUTOMÁTICA - PASO 11: SITUACIÓN ACTUAL Y RENDIMIENTO SEO GENERAL
 * =============================================================================
 *
 * Configuración de campos para el paso de evaluación del estado actual SEO
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Obtener el ID del paso desde la base de datos
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '11_situacion_general_seo'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '11_situacion_general_seo'");
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
        echo "¿Desea continuar y reemplazarlos? (y/N): ";
        $respuesta = trim(fgets(STDIN));
        if (strtolower($respuesta) !== 'y') {
            echo "❌ Operación cancelada.\n";
            exit;
        }

        // Eliminar campos existentes
        $sql = "DELETE FROM paso_campos WHERE paso_plantilla_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$paso_plantilla_id]);
        echo "🗑️  Campos anteriores eliminados.\n";
    }

    // 3. Configuración de campos para situación general SEO
    $campos = [
        [
            'nombre_campo' => 'trafico_organico_actual',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Análisis de Tráfico Orgánico Actual',
            'descripcion_ayuda' => 'Resumen del tráfico orgánico basado en GA4 y GSC (usuarios, sesiones, tendencias)',
            'obligatorio' => 1,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'keywords_ranking_principales',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Keywords Ranking Principales',
            'descripcion_ayuda' => 'Lista de keywords principales por las que el sitio está posicionando actualmente',
            'obligatorio' => 1,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'salud_tecnica_seo_basica',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Assessment de Salud Técnica SEO Básica',
            'descripcion_ayuda' => 'Evaluación inicial de problemas técnicos principales (crawling, indexación, velocidad)',
            'obligatorio' => 1,
            'orden' => 3
        ],
        [
            'nombre_campo' => 'autoridad_enlaces_metricas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Métricas de Autoridad y Enlaces',
            'descripcion_ayuda' => 'DR/DA actual, perfil de enlaces, análisis de autoridad del dominio',
            'obligatorio' => 1,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'performance_user_experience',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Performance y User Experience',
            'descripcion_ayuda' => 'Core Web Vitals, PageSpeed, métricas de rendimiento y experiencia de usuario',
            'obligatorio' => 1,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'presencia_resultados_destacados',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Presencia en Resultados Destacados',
            'descripcion_ayuda' => 'Featured snippets, People Also Ask, otros formatos SERP especiales actuales',
            'obligatorio' => 1,
            'orden' => 6
        ],
        [
            'nombre_campo' => 'assessment_competencia_directa',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Assessment de Competencia Directa Básica',
            'descripcion_ayuda' => 'Análisis preliminar de competidores principales y su rendimiento SEO',
            'obligatorio' => 1,
            'orden' => 7
        ],
        [
            'nombre_campo' => 'configuraciones_seo_tecnicas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Review de Configuraciones SEO Técnicas',
            'descripcion_ayuda' => 'Meta tags, estructuración, sitemaps, robots.txt, configuraciones actuales',
            'obligatorio' => 1,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'contenido_estructura_actual',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Análisis de Contenido y Estructura Actual',
            'descripcion_ayuda' => 'Evaluación de calidad de contenido, arquitectura de información, gaps de contenido',
            'obligatorio' => 1,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'oportunidades_mejora_inmediatas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Oportunidades de Mejora Inmediatas',
            'descripcion_ayuda' => 'Quick wins identificados y recomendaciones de implementación prioritaria',
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
    echo "🎯 Paso: SITUACIÓN ACTUAL Y RENDIMIENTO SEO GENERAL\n";
    echo "🔧 Los campos están listos para ser utilizados en el formulario\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>