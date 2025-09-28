<?php
/**
 * CONFIGURACIÓN AUTOMÁTICA - PASO 10: CONFIGURACIÓN TRACKING POSICIONES
 * ====================================================================
 *
 * Configuración de campos para el paso de configuración de tracking de posiciones SEO
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Obtener el ID del paso desde la base de datos
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '10_configuracion_tracking'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '10_configuracion_tracking'");
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

    // 3. Configuración de campos para configuración tracking posiciones
    $campos = [
        [
            'nombre_campo' => 'keywords_objetivo_principales',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Keywords Objetivo Principales (50-100)',
            'descripcion' => 'Lista priorizada de keywords principales para tracking continuo',
            'obligatorio' => 1,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'herramientas_tracking_configuradas',
            'tipo_campo' => 'select',
            'etiqueta' => 'Herramientas de Tracking Configuradas',
            'descripcion' => 'Selecciona las herramientas que se configurarán para el seguimiento',
            'opciones' => json_encode([
                'ahrefs_rank_tracker' => 'Ahrefs Rank Tracker',
                'semrush_position_tracking' => 'SEMrush Position Tracking',
                'google_search_console' => 'Google Search Console',
                'serpwatcher' => 'SERPWatcher',
                'accuranker' => 'AccuRanker'
            ]),
            'obligatorio' => 1,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'urls_objetivo_keywords',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Mapeo URLs Objetivo por Keyword',
            'descripcion' => 'Asignación específica de URL objetivo para cada keyword principal',
            'obligatorio' => 1,
            'orden' => 3
        ],
        [
            'nombre_campo' => 'ubicaciones_geograficas_tracking',
            'tipo_campo' => 'text',
            'etiqueta' => 'Ubicaciones Geográficas para Tracking',
            'descripcion' => 'Países/ciudades específicas para el seguimiento de posiciones',
            'obligatorio' => 1,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'frecuencia_seguimiento',
            'tipo_campo' => 'select',
            'etiqueta' => 'Frecuencia de Seguimiento',
            'descripcion' => 'Periodicidad del tracking de posiciones',
            'opciones' => json_encode([
                'diario' => 'Diario',
                'cada_3_dias' => 'Cada 3 días',
                'semanal' => 'Semanal',
                'quincenal' => 'Quincenal'
            ]),
            'obligatorio' => 1,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'alertas_automaticas_configuracion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Configuración de Alertas Automáticas',
            'descripcion' => 'Alertas para cambios significativos de posición (+/-5 posiciones, aparición en top 10, etc.)',
            'obligatorio' => 1,
            'orden' => 6
        ],
        [
            'nombre_campo' => 'integracion_analytics_gsc',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Integración Analytics y Search Console',
            'descripcion' => 'Configuración de conectores para datos unificados de tráfico orgánico',
            'obligatorio' => 1,
            'orden' => 7
        ],
        [
            'nombre_campo' => 'dashboard_metricas_seo',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Dashboard de Métricas SEO Personalizado',
            'descripcion' => 'Diseño y configuración del dashboard principal para monitorización',
            'obligatorio' => 1,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'benchmarks_posiciones_iniciales',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Benchmarks de Posiciones Iniciales',
            'descripcion' => 'Datos CSV de posiciones de baseline antes de iniciar optimizaciones (formato: keyword,url,posicion,fecha)',
            'obligatorio' => 1,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'competidores_seguimiento_comparativo',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Competidores para Seguimiento Comparativo',
            'descripcion' => 'Lista de competidores directos e indirectos para tracking paralelo',
            'obligatorio' => 1,
            'orden' => 10
        ]
    ];

    // 4. Insertar campos en la base de datos
    $sql = "INSERT INTO paso_campos (paso_plantilla_id, nombre_campo, tipo_campo, etiqueta, descripcion_ayuda, obligatorio, orden, opciones)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    foreach ($campos as $campo) {
        $opciones = isset($campo['opciones']) ? $campo['opciones'] : null;
        $stmt->execute([
            $paso_plantilla_id,
            $campo['nombre_campo'],
            $campo['tipo_campo'],
            $campo['etiqueta'],
            $campo['descripcion'],
            $campo['obligatorio'],
            $campo['orden'],
            $opciones
        ]);
    }

    echo "✅ Configuración completada exitosamente\n";
    echo "📊 Total de campos configurados: " . count($campos) . "\n";
    echo "🎯 Paso: CONFIGURACIÓN TRACKING POSICIONES\n";
    echo "🔧 Los campos están listos para ser utilizados en el formulario\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>