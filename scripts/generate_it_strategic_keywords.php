<?php
// Genera una lista estratégica de 100 keywords IT para alquiler de villas en Ibiza
// Enfoque: intención, ubicaciones, servicios/amenities, audiencias, temporada/duración

declare(strict_types=1);

function add(array &$out, string $kw): void {
    $kw = preg_replace('/\s+/', ' ', trim($kw));
    if ($kw !== '') { $out[$kw] = true; }
}

$keywords = [];

// Intención principal (Ibiza global)
$core = [
    'villa in affitto ibiza',
    'affitto villa ibiza',
    'ville in affitto ibiza',
    'villa di lusso ibiza',
    'villa economica ibiza',
    'villa budget ibiza',
    'villa premium ibiza',
    'villa esclusiva ibiza',
    'villa moderna ibiza',
    'villa con piscina ibiza',
    'villa vista mare ibiza',
    'villa fronte mare ibiza',
    'villa vicino alla spiaggia ibiza',
    'villa privata ibiza',
    'villa isolata ibiza',
    'villa per famiglie ibiza',
    'villa per gruppi ibiza',
    'villa animali ammessi ibiza',
    'villa per coppie ibiza',
    'villa per bambini ibiza',
    'villa estate ibiza',
    'villa luglio ibiza',
    'villa agosto ibiza',
    'villa settimanale ibiza',
    'villa weekend ibiza',
    'villa con jacuzzi ibiza',
    'villa con barbecue ibiza',
    'villa aria condizionata ibiza',
    'villa wifi ibiza',
    'villa parcheggio ibiza',
    'villa piscina riscaldata ibiza',
    'villa vista tramonto ibiza',
];
foreach ($core as $kw) add($keywords, $kw);

// Ubicaciones estratégicas (12) x 4 variantes
$locations = [
    'sant josep', 'santa eulalia', 'san antonio', 'sant joan', 'ibiza città',
    'jesus', 'es cubells', 'santa gertrudis', 'portinatx', 'cala vadella',
    'san miguel', 'sant carles',
];
foreach ($locations as $loc) {
    add($keywords, "villa in affitto {$loc}");
    add($keywords, "villa di lusso {$loc}");
    add($keywords, "villa per famiglie {$loc}");
    add($keywords, "villa con piscina {$loc}");
}

// Playas populares (10+) variante base
$beaches = [
    'cala comte', 'cala bassa', 'cala tarida', 'cala d\'hort', 'cala salada',
    'benirras', 'talamanca', 'cala llonga', 'es figueral', 'cala vadella',
    'cala gracioneta', 'cala san vicente', 'playa d\'en bossa', 'sa caleta',
    's\'estanyol', 'cala moli', 'cala carbo', 'cala xuclar', 'cala boix', 'aguas blancas',
];
foreach ($beaches as $b) {
    add($keywords, "villa in affitto {$b}");
}

// Audiencias y casos de uso
$audiences = [
    'villa matrimonio ibiza',
    'villa eventi ibiza',
    'villa ritiro aziendale ibiza',
    'villa ritiro yoga ibiza',
    'villa luna di miele ibiza',
    'villa grande famiglia ibiza',
    'villa grande gruppo ibiza',
    'villa piccolo gruppo ibiza',
    'villa bambini ibiza',
];
foreach ($audiences as $kw) add($keywords, $kw);

// Amenities extra para cobertura
$moreAmenities = [
    'villa con palestra ibiza',
    'villa ufficio in casa ibiza',
    'villa terrazza panoramica ibiza',
    'villa sala cinema ibiza',
    'villa sala giochi ibiza',
    'villa con sicurezza ibiza',
];
foreach ($moreAmenities as $kw) add($keywords, $kw);

// Lista final: máximo 100
$final = array_slice(array_keys($keywords), 0, 100);

$baseDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ibiza villa';
if (!is_dir($baseDir)) {
    fwrite(STDERR, "Base directory not found: {$baseDir}\n");
    exit(1);
}
$outPath = $baseDir . DIRECTORY_SEPARATOR . 'keywords_it_list.txt';
$fh = fopen($outPath, 'w');
if (!$fh) {
    fwrite(STDERR, "Cannot write: {$outPath}\n");
    exit(1);
}
foreach ($final as $line) { fwrite($fh, $line . "\n"); }
fclose($fh);
echo "Lista estratégica IT escrita: {$outPath} (" . count($final) . " linee)\n";

?>