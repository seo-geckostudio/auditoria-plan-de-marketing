<?php
/**
 * Script para arreglar campos problemáticos del Brief
 */

$db = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "=== ANÁLISIS DE CAMPOS PROBLEMÁTICOS ===\n\n";

// 1. Buscar campo KPIs
$sql = "SELECT * FROM paso_campos WHERE paso_plantilla_id = 2 AND (nombre_campo LIKE '%kpi%' OR etiqueta LIKE '%kpi%')";
$result = $db->query($sql);
$campoKPIs = $result->fetch(PDO::FETCH_ASSOC);

if ($campoKPIs) {
    echo "❌ PROBLEMA 1: Campo KPIs encontrado\n";
    echo "   ID: {$campoKPIs['id']}\n";
    echo "   Nombre campo: {$campoKPIs['nombre_campo']}\n";
    echo "   Etiqueta: {$campoKPIs['etiqueta']}\n";
    echo "   Tipo: {$campoKPIs['tipo_campo']}\n";
    echo "   Obligatorio: {$campoKPIs['obligatorio']}\n\n";

    // Arreglar: cambiar a textarea y no obligatorio
    $sql = "UPDATE paso_campos SET tipo_campo = 'textarea', obligatorio = 0 WHERE id = ?";
    $stmt = $db->prepare($sql);
    if ($stmt->execute([$campoKPIs['id']])) {
        echo "   ✅ ARREGLADO: Cambiado a textarea no obligatorio\n\n";
    }
} else {
    echo "ℹ️  Campo KPIs no encontrado\n\n";
}

// 2. Buscar campo Timeline
$sql = "SELECT * FROM paso_campos WHERE paso_plantilla_id = 2 AND (nombre_campo LIKE '%timeline%' OR etiqueta LIKE '%timeline%')";
$result = $db->query($sql);
$campoTimeline = $result->fetch(PDO::FETCH_ASSOC);

if ($campoTimeline) {
    echo "❌ PROBLEMA 2: Campo Timeline encontrado\n";
    echo "   ID: {$campoTimeline['id']}\n";
    echo "   Nombre campo: {$campoTimeline['nombre_campo']}\n";
    echo "   Etiqueta: {$campoTimeline['etiqueta']}\n";
    echo "   Tipo: {$campoTimeline['tipo_campo']}\n";
    echo "   Opciones: {$campoTimeline['opciones']}\n\n";

    // Arreglar: cambiar a text para permitir X días/meses
    $sql = "UPDATE paso_campos SET
            tipo_campo = 'text',
            placeholder = 'Ej: 30 días, 3 meses, 90 días, 6 meses',
            descripcion_ayuda = 'Especifica el tiempo estimado para implementar (ej: 30 días, 90 días, 3 meses, 6 meses)'
            WHERE id = ?";
    $stmt = $db->prepare($sql);
    if ($stmt->execute([$campoTimeline['id']])) {
        echo "   ✅ ARREGLADO: Cambiado a campo de texto libre con placeholder\n\n";
    }
} else {
    echo "ℹ️  Campo Timeline no encontrado\n\n";
}

echo "=== VERIFICACIÓN FINAL ===\n\n";

// Verificar campos actualizados
$sql = "SELECT nombre_campo, etiqueta, tipo_campo, obligatorio, placeholder FROM paso_campos
        WHERE paso_plantilla_id = 2 AND (nombre_campo LIKE '%kpi%' OR nombre_campo LIKE '%timeline%' OR etiqueta LIKE '%kpi%' OR etiqueta LIKE '%timeline%')";
$result = $db->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "Campo: {$row['etiqueta']} ({$row['nombre_campo']})\n";
    echo "  Tipo: {$row['tipo_campo']}\n";
    echo "  Obligatorio: " . ($row['obligatorio'] ? 'Sí' : 'No') . "\n";
    echo "  Placeholder: {$row['placeholder']}\n\n";
}

echo "✅ Script completado\n";
