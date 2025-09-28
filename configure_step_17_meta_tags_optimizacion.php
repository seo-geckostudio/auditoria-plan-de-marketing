<?php
/**
 * AUTO-CONFIGURACIÓN - PASO 17: META TAGS Y OPTIMIZACIÓN
 * ======================================================
 */

try {
    $pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '17_meta_tags_optimizacion'";
    $stmt = $pdo->query($sql);
    $paso = $stmt->fetch();

    if (!$paso) {
        throw new Exception("No se encontró el paso con código '17_meta_tags_optimizacion'");
    }

    $paso_plantilla_id = $paso['id'];
    echo "⚡ Paso ID $paso_plantilla_id - AUTO-CONFIGURANDO\n";

    $sql = "SELECT COUNT(*) as total FROM paso_campos WHERE paso_plantilla_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paso_plantilla_id]);
    $existing = $stmt->fetch();

    if ($existing['total'] == 0) {
        $campos = [
            ['nombre_campo' => 'auditoria_title_tags', 'etiqueta' => 'Auditoría Title Tags', 'orden' => 1],
            ['nombre_campo' => 'meta_descriptions_review', 'etiqueta' => 'Review Meta Descriptions', 'orden' => 2],
            ['nombre_campo' => 'meta_keywords_analisis', 'etiqueta' => 'Análisis Meta Keywords', 'orden' => 3],
            ['nombre_campo' => 'open_graph_tags', 'etiqueta' => 'Open Graph Tags Social Media', 'orden' => 4],
            ['nombre_campo' => 'twitter_card_tags', 'etiqueta' => 'Twitter Card Tags', 'orden' => 5],
            ['nombre_campo' => 'canonical_tags_review', 'etiqueta' => 'Review Canonical Tags', 'orden' => 6],
            ['nombre_campo' => 'meta_robots_directivas', 'etiqueta' => 'Meta Robots y Directivas', 'orden' => 7],
            ['nombre_campo' => 'viewport_mobile_tags', 'etiqueta' => 'Viewport y Mobile Meta Tags', 'orden' => 8],
            ['nombre_campo' => 'meta_rich_snippets', 'etiqueta' => 'Meta Tags Rich Snippets', 'orden' => 9],
            ['nombre_campo' => 'plan_optimizacion_tags', 'etiqueta' => 'Plan Optimización y Mejores Prácticas', 'orden' => 10]
        ];

        $sql = "INSERT INTO paso_campos (paso_plantilla_id, nombre_campo, tipo_campo, etiqueta, descripcion_ayuda, obligatorio, orden)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        foreach ($campos as $campo) {
            $stmt->execute([
                $paso_plantilla_id,
                $campo['nombre_campo'],
                'textarea',
                $campo['etiqueta'],
                'Optimización de ' . strtolower($campo['etiqueta']),
                1,
                $campo['orden']
            ]);
        }

        echo "⚡ " . count($campos) . " campos auto-configurados\n";
    } else {
        echo "⚡ Auto-continúa - {$existing['total']} campos ya configurados\n";
    }

    echo "🎯 META TAGS OPTIMIZACIÓN - COMPLETADO\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>