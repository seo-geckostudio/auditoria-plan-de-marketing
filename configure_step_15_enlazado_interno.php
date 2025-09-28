<?php
/**
 * CONFIGURACIÓN AUTOMÁTICA - PASO 15: ANÁLISIS ENLAZADO INTERNO
 * ============================================================
 *
 * Configuración de campos para el paso de análisis de enlazado interno
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Obtener el ID del paso desde la base de datos
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '15_enlazado_interno'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '15_enlazado_interno'");
    }

    $paso_plantilla_id = $paso['id'];
    echo "✅ Paso encontrado: ID $paso_plantilla_id\n";

    // 2. Auto-continuar configuración
    $sql = "SELECT COUNT(*) as total FROM paso_campos WHERE paso_plantilla_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paso_plantilla_id]);
    $existing = $stmt->fetch();

    if ($existing['total'] > 0) {
        echo "⚡ Auto-continúa - {$existing['total']} campos ya configurados.\n";
    } else {
        // 3. Configuración automática de campos
        $campos = [
            [
                'nombre_campo' => 'mapa_enlaces_internos_completo',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Mapa Completo de Enlaces Internos',
                'descripcion_ayuda' => 'Análisis exhaustivo de todos los enlaces internos del sitio y su estructura',
                'obligatorio' => 1,
                'orden' => 1
            ],
            [
                'nombre_campo' => 'distribucion_pagerank_interno',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Distribución de PageRank Interno',
                'descripcion_ayuda' => 'Análisis de cómo se distribuye la autoridad interna entre páginas',
                'obligatorio' => 1,
                'orden' => 2
            ],
            [
                'nombre_campo' => 'anchor_texts_optimizacion',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Anchor Texts y Optimización',
                'descripcion_ayuda' => 'Evaluación de anchor texts utilizados y oportunidades de optimización',
                'obligatorio' => 1,
                'orden' => 3
            ],
            [
                'nombre_campo' => 'paginas_mayor_autoridad_interna',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Páginas con Mayor Autoridad Interna',
                'descripcion_ayuda' => 'Identificación de páginas que concentran más autoridad interna',
                'obligatorio' => 1,
                'orden' => 4
            ],
            [
                'nombre_campo' => 'oportunidades_enlazado_perdidas',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Oportunidades de Enlazado Perdidas',
                'descripcion_ayuda' => 'Identificación de oportunidades de enlazado interno no aprovechadas',
                'obligatorio' => 1,
                'orden' => 5
            ],
            [
                'nombre_campo' => 'patrones_enlazado_secciones',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Patrones de Enlazado por Secciones',
                'descripcion_ayuda' => 'Análisis de cómo se enlazan las diferentes secciones del sitio',
                'obligatorio' => 1,
                'orden' => 6
            ],
            [
                'nombre_campo' => 'enlaces_rotos_redirecciones',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Enlaces Rotos y Redirecciones Internas',
                'descripcion_ayuda' => 'Identificación y análisis de enlaces internos rotos y redirecciones',
                'obligatorio' => 1,
                'orden' => 7
            ],
            [
                'nombre_campo' => 'profundidad_enlazado_clusters',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Profundidad de Enlazado y Clusters',
                'descripcion_ayuda' => 'Assessment de profundidad de enlazado y formación de clusters temáticos',
                'obligatorio' => 1,
                'orden' => 8
            ],
            [
                'nombre_campo' => 'enlaces_contextuales_navegacionales',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Enlaces Contextuales vs Navegacionales',
                'descripcion_ayuda' => 'Análisis del balance entre enlaces contextuales y navegacionales',
                'obligatorio' => 1,
                'orden' => 9
            ],
            [
                'nombre_campo' => 'paginas_subenlazadas_hiperenlazadas',
                'tipo_campo' => 'textarea',
                'etiqueta' => 'Páginas Sub-enlazadas e Híper-enlazadas',
                'descripcion_ayuda' => 'Identificación de páginas con déficit o exceso de enlaces internos',
                'obligatorio' => 1,
                'orden' => 10
            ]
        ];

        // 4. Inserción automática
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

    echo "🎯 ANÁLISIS ENLAZADO INTERNO configurado\n";
    echo "⚡ Progreso: 50%+ completado, continuando automáticamente...\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>