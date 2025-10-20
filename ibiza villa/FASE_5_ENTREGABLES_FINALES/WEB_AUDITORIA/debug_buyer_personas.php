<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$jsonPath = __DIR__ . '/data/fase0/buyer_personas.json';
$jsonContent = file_get_contents($jsonPath);
$datosModulo = json_decode($jsonContent, true);

echo "<h1>Debug Buyer Personas</h1>";
echo "<h2>Página 1 - Portada</h2>";
$portada = $datosModulo['paginas'][0]['contenido']['datos'];
echo "<pre>";
echo "Segmentos: " . count($portada['segmentos_principales'] ?? []) . "\n";
echo "Países: " . count($portada['pais_origen_principal'] ?? []) . "\n";
print_r($portada['segmentos_principales'] ?? []);
echo "</pre>";

echo "<h2>Página 2 - Marco</h2>";
$marco = $datosModulo['paginas'][1]['contenido']['datos'];
echo "<pre>";
echo "Tiene 'persona': " . (isset($marco['persona']) ? 'SÍ' : 'NO') . "\n";
if (isset($marco['persona'])) {
    print_r($marco['persona']);
}
echo "\nTiene 'psicografia': " . (isset($marco['psicografia']) ? 'SÍ' : 'NO') . "\n";
echo "Tiene 'pain_points': " . (isset($marco['pain_points']) ? 'SÍ (' . count($marco['pain_points']) . ')' : 'NO') . "\n";
echo "Tiene 'goals': " . (isset($marco['goals']) ? 'SÍ (' . count($marco['goals']) . ')' : 'NO') . "\n";
echo "</pre>";

echo "<h2>Página 3 - Dual Personas (Sofia + James)</h2>";
$dual = $datosModulo['paginas'][2]['contenido']['datos'];
echo "<pre>";
echo "Tipo: " . ($datosModulo['paginas'][2]['contenido']['tipo'] ?? 'N/A') . "\n";
echo "Tiene 'persona_2': " . (isset($dual['persona_2']) ? 'SÍ' : 'NO') . "\n";
echo "Tiene 'persona_3': " . (isset($dual['persona_3']) ? 'SÍ' : 'NO') . "\n\n";

if (isset($dual['persona_2'])) {
    echo "=== PERSONA 2 (Sofia) ===\n";
    print_r($dual['persona_2']);
}

if (isset($dual['persona_3'])) {
    echo "\n=== PERSONA 3 (James) ===\n";
    print_r($dual['persona_3']);
}
echo "</pre>";

echo "<hr><a href='modulos/fase0_marketing/02_buyer_personas.php'>Ver módulo completo</a>";
?>
