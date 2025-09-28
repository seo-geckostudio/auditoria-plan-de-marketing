<?php
/**
 * CONFIGURACIÓN PASO 03: ESTRATEGIA DE CONTENIDOS SEO
 * ===================================================
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

try {
    $pdo->beginTransaction();

    // Verificar que el paso existe
    $sql = "SELECT id FROM pasos_plantilla WHERE codigo_paso = '03_estrategia_contenidos'";
    $step = $pdo->query($sql)->fetch();

    if (!$step) {
        throw new Exception("Paso 03_estrategia_contenidos no encontrado");
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
            'nombre_campo' => 'pilares_contenido_principales',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Pilares de Contenido Principales',
            'placeholder' => 'Define 3-5 pilares principales de contenido basados en keywords estratégicas y buyer personas',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Establece los temas principales sobre los que girará toda la estrategia de contenido',
            'min_length' => 60,
            'orden' => 1
        ],
        [
            'nombre_campo' => 'mapping_contenido_buyer_personas',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Mapping de Contenido por Buyer Personas',
            'placeholder' => 'Especifica qué tipo de contenido necesita cada buyer persona en cada etapa del customer journey',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Mapea el contenido específico para cada persona en awareness, consideration y decision',
            'min_length' => 80,
            'orden' => 2
        ],
        [
            'nombre_campo' => 'tipos_formatos_contenido',
            'tipo_campo' => 'checkbox',
            'etiqueta' => 'Tipos y Formatos de Contenido',
            'opciones' => '{"blog_posts":"Blog Posts/Artículos","guias_completas":"Guías Completas","case_studies":"Case Studies","infografias":"Infografías","videos":"Videos","podcasts":"Podcasts","webinars":"Webinars","ebooks":"E-books","checklists":"Checklists","templates":"Templates","comparativas":"Comparativas","faqs":"FAQs"}',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Selecciona los formatos de contenido que incluirá la estrategia',
            'orden' => 3
        ],
        [
            'nombre_campo' => 'calendario_editorial_estrategico',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Calendario Editorial Estratégico',
            'placeholder' => 'Planificación mensual/trimestral: frecuencia, temas estacionales, contenido evergreen, timing estratégico',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Calendario con timing estratégico, considerando estacionalidad y objetivos de negocio',
            'min_length' => 60,
            'orden' => 4
        ],
        [
            'nombre_campo' => 'estrategia_keywords_contenido',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Estrategia de Keywords por Contenido',
            'placeholder' => 'Asignación de keywords principales y secundarias por pilar, intención de búsqueda y dificultad',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Define cómo distribuir las keywords entre diferentes tipos de contenido',
            'min_length' => 50,
            'orden' => 5
        ],
        [
            'nombre_campo' => 'plan_distribucion_promocion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Distribución y Promoción',
            'placeholder' => 'Canales de distribución, estrategia de redes sociales, email marketing, partnerships, guest posting',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Estrategia para maximizar el alcance y engagement del contenido creado',
            'min_length' => 50,
            'orden' => 6
        ],
        [
            'nombre_campo' => 'arquitectura_linkbuilding_interno',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Arquitectura y Linkbuilding Interno',
            'placeholder' => 'Estructura de enlaces internos, clusters de contenido, pillar pages, topic clusters',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Plan para crear una arquitectura de enlaces internos que potencie el SEO',
            'min_length' => 40,
            'orden' => 7
        ],
        [
            'nombre_campo' => 'metricas_kpis_contenido',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Métricas y KPIs de Contenido',
            'placeholder' => 'KPIs específicos: tráfico orgánico, time on page, conversiones, shares, backlinks, rankings',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Define cómo medir el éxito de la estrategia de contenidos',
            'min_length' => 40,
            'orden' => 8
        ],
        [
            'nombre_campo' => 'recursos_produccion_necesarios',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Recursos y Producción Necesarios',
            'placeholder' => 'Equipo necesario, herramientas, presupuesto, timeline de producción, flujo de trabajo',
            'obligatorio' => 1,
            'descripcion_ayuda' => 'Especifica qué recursos humanos y técnicos son necesarios para ejecutar la estrategia',
            'min_length' => 40,
            'orden' => 9
        ],
        [
            'nombre_campo' => 'plan_optimizacion_actualizacion',
            'tipo_campo' => 'textarea',
            'etiqueta' => 'Plan de Optimización y Actualización',
            'placeholder' => 'Estrategia para actualizar contenido existente, refresh de posts antiguos, repurposing',
            'obligatorio' => 0,
            'descripcion_ayuda' => 'Plan para mantener y mejorar continuamente el contenido existente',
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
    echo "\n🎉 PASO 03 CONFIGURADO EXITOSAMENTE\n";
    echo "Total de campos creados: " . count($campos) . "\n";
    echo "🎉 ¡FASE 0 COMPLETADA AL 100%!\n";

} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>