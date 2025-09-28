<?php
/**
 * CONFIGURACIÓN PASO 08: MAPPING KEYWORDS A ARQUITECTURA
 * ======================================================
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

try {
    $pdo->beginTransaction();

    // Verificar que el paso existe
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '08_mapping_keywords_arquitectura'";
    $step = $pdo->query($sql)->fetch();

    if (!$step) {
        throw new Exception("Paso 08_mapping_keywords_arquitectura no encontrado");
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
            'nombre_campo' => 'plan_migracion_urls_redirects',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Migración URLs con Redirects 301',
            'placeholder' => 'Matriz detallada URL antigua → URL nueva con especificaciones de redirects 301 y preservación de autoridad',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Documenta cada cambio de URL con su redirect correspondiente para preservar SEO',
            'min_length' => 60,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'calendario_implementacion_fases',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Calendario de Implementación por Fases',
            'placeholder' => 'Timeline detallado: Fase 1 (preparación), Fase 2 (migración core), Fase 3 (contenido), Fase 4 (optimización)',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Plan temporal que minimice riesgos SEO implementando cambios gradualmente',
            'min_length' => 50,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'estrategia_preservacion_autoridad',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Estrategia de Preservación de Autoridad SEO',
            'placeholder' => 'Plan para mantener rankings, autoridad de dominio, backlinks y señales SEO durante la migración',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Medidas específicas para evitar pérdidas de posicionamiento durante cambios',
            'min_length' => 50,
            'orden' => 3
        ],
        [
            'nombre_campo' => 'plan_comunicacion_stakeholders',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Comunicación a Stakeholders',
            'placeholder' => 'Comunicación a equipo técnico, marketing, dirección y usuarios sobre cambios y timeline',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Estrategia de comunicación clara para alinear expectativas y responsabilidades',
            'min_length' => 40,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'protocolo_testing_validacion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Protocolo de Testing y Validación Pre-Lanzamiento',
            'placeholder' => 'Checklist exhaustivo: tests funcionales, SEO, rendimiento, UX antes de cada fase',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Procedimientos de validación para asegurar que cada cambio funcione correctamente',
            'min_length' => 40,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'estrategia_monitoreo_post_implementacion',
            'tipo_campo' => 'select',
            'etiqueta' => 'Estrategia de Monitoreo Post-Implementación',
            'opciones' => '{"diario_2_semanas":"Monitoreo diario primeras 2 semanas","semanal_2_meses":"Monitoreo semanal primeros 2 meses","quincenal_6_meses":"Monitoreo quincenal hasta 6 meses","mensual_continuo":"Monitoreo mensual continuo"}',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Frecuencia y duración del monitoreo para detectar problemas temprano',
            'orden' => 6
        ],
        [
            'nombre_campo' => 'plan_rollback_emergencia',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Rollback en Caso de Emergencia',
            'placeholder' => 'Procedimiento de reversión rápida: backups, rollback de redirects, restauración de URLs críticas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Plan de contingencia para revertir cambios rápidamente si hay problemas críticos',
            'min_length' => 40,
            'orden' => 7
        ],
        [
            'nombre_campo' => 'documentacion_tecnica_desarrollo',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Documentación Técnica para Desarrollo',
            'placeholder' => 'Especificaciones técnicas: redirects .htaccess, cambios CMS, configuración servidor, sitemaps',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Documentación clara para que el equipo técnico implemente correctamente',
            'min_length' => 40,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'plan_actualizacion_contenido_enlaces',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Actualización de Contenido y Enlaces',
            'placeholder' => 'Actualización de enlaces internos, menús, contenido, anchor texts según nueva arquitectura',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Proceso para actualizar todos los elementos que referencian las URLs modificadas',
            'min_length' => 30,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'checklist_verificacion_seo_post_migracion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Checklist de Verificación SEO Post-Migración',
            'placeholder' => 'Lista verificación: redirects funcionando, sitemaps actualizados, GSC configurado, rankings monitoreados',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Checklist final para confirmar que todo está funcionando correctamente post-migración',
            'min_length' => 40,
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
    echo "\n🎉 PASO 08 CONFIGURADO EXITOSAMENTE\n";
    echo "Total de campos creados: " . count($campos) . "\n";
    echo "🏆 ¡FASE 3 COMPLETADA AL 100%! - ARQUITECTURA DEL SITIO\n";

} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>