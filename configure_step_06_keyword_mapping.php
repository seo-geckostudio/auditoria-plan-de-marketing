<?php
/**
 * CONFIGURACIÓN PASO 06: KEYWORD MAPPING FINAL
 * ============================================
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

try {
    $pdo->beginTransaction();

    // Verificar que el paso existe
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '06_keyword_mapping'";
    $step = $pdo->query($sql)->fetch();

    if (!$step) {
        throw new Exception("Paso 06_keyword_mapping no encontrado");
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
            'nombre_campo' => 'inventario_urls_completo',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Inventario Completo de URLs del Sitio',
            'placeholder' => 'Lista todas las URLs actuales del sitio web, organizadas por secciones y jerarquía',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Extrae todas las URLs usando Screaming Frog - archivo Internal.csv',
            'min_length' => 50,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'keywords_principales_consolidadas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Keywords Principales Consolidadas',
            'placeholder' => 'Lista consolidada de keywords principales, secundarias y de cola larga identificadas en pasos anteriores',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Unifica todas las keywords de los análisis previos de oportunidades y competencia',
            'min_length' => 60,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'mapeo_keywords_urls_actual',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Mapeo Keywords-URLs Actual',
            'placeholder' => 'Análisis del mapeo actual de keywords a páginas existentes, identificando fortalezas y debilidades',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Usa GSC Queries.csv y Ahrefs Top Pages para mapear keywords actuales',
            'min_length' => 50,
            'orden' => 3
        ],
        [
            'nombre_campo' => 'clusters_keywords_tematicos',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Clusters de Keywords Temáticos',
            'placeholder' => 'Agrupación de keywords relacionadas semánticamente en clusters temáticos para optimizar arquitectura',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Agrupa keywords por temas principales para crear páginas pillar y clusters de contenido',
            'min_length' => 40,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'gaps_arquitectura_identificados',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Gaps en Arquitectura Identificados',
            'placeholder' => 'Keywords importantes sin página asignada, páginas sin keywords objetivo, oportunidades perdidas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Identifica oportunidades donde faltan páginas para keywords importantes',
            'min_length' => 40,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'propuesta_nuevas_urls',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Propuesta de Nuevas URLs',
            'placeholder' => 'URLs nuevas necesarias para cubrir gaps, con estructura SEO-friendly y keywords asignadas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Propone nuevas páginas con URLs optimizadas para keywords sin cobertura',
            'min_length' => 40,
            'orden' => 6
        ],
        [
            'nombre_campo' => 'distribucion_intencion_busqueda',
            'tipo_campo' => 'select',
            'etiqueta' => 'Distribución por Intención de Búsqueda',
            'opciones' => '{"informacional":"Informacional (Know)","navegacional":"Navegacional (Go)","transaccional":"Transaccional (Do)","comercial":"Comercial (Buy)","mixta":"Estrategia Mixta"}',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Clasifica y distribuye keywords según intención para optimizar conversiones',
            'orden' => 7
        ],
        [
            'nombre_campo' => 'analisis_cannibalizacion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Análisis de Cannibalización',
            'placeholder' => 'Identificación de keywords que compiten entre múltiples páginas y propuesta de resolución',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Detecta y resuelve conflictos donde múltiples páginas compiten por la misma keyword',
            'min_length' => 30,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'jerarquia_navegacion_propuesta',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Jerarquía y Navegación Propuesta',
            'placeholder' => 'Estructura de navegación optimizada basada en el mapeo de keywords y user journey',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Define arquitectura de información que soporte la estrategia de keywords',
            'min_length' => 40,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'matriz_implementacion_final',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Matriz de Implementación Final',
            'placeholder' => 'Matriz completa keyword-URL con prioridades, dificultad, volumen y plan de implementación',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Documento final con mapeo completo listo para implementación técnica',
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
    echo "\n🎉 PASO 06 CONFIGURADO EXITOSAMENTE\n";
    echo "Total de campos creados: " . count($campos) . "\n";
    echo "🚀 KEYWORD MAPPING - FASE 3 INICIADA\n";

} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>