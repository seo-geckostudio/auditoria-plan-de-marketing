<?php
// Generate a minimal Italian rental/vacation rental keyword list for Ibiza
// Output: ibiza villa/keywords_it_expanded.csv

mb_internal_encoding('UTF-8');

function writeCsv($path, $headers, $rows) {
    $dir = dirname($path);
    if (!is_dir($dir)) { mkdir($dir, 0777, true); }
    $fh = fopen($path, 'w');
    fputcsv($fh, $headers);
    foreach ($rows as $r) { fputcsv($fh, $r); }
    fclose($fh);
}

$locations = [
    'ibiza','es cubells','san josé','sant josep','santa eulalia','santa eulària','san antonio','sant antoni','san miguel','sant miquel','portinatx','calá longa','cala longa','cala vadella','cala tarida','cala conta'
];
$propertyTypes = ['villa','ville','casa','case'];
$modifiers = [
    'in affitto','affitto vacanze','case vacanza','villa vacanze',
    'lusso','economica','con piscina','vista mare','vicino alla spiaggia',
    'familiare','per gruppo','pet friendly','settimanale','weekend'
];
$seasonals = ['estate','luglio','agosto','2025'];

$rows = [];
foreach ($locations as $loc) {
    foreach ($propertyTypes as $type) {
        // Base rental intents
        $baseIntents = [
            "$type in affitto $loc",
            "$type affitto vacanze $loc",
            "$type case vacanza $loc",
            "$type villa vacanze $loc"
        ];
        foreach ($baseIntents as $kw) {
            $rows[] = ['it','alquiler villas ibiza',$kw,'it'];
        }
        // Modifiers
        foreach ($modifiers as $mod) {
            $kw = "$type $mod $loc";
            $rows[] = ['it','alquiler villas ibiza',$kw,'it'];
        }
        // Seasonals
        foreach ($seasonals as $s) {
            $rows[] = ['it','alquiler villas ibiza',"$type in affitto $loc $s",'it'];
        }
    }
}

// Deduplicate
$unique = [];
$dedup = [];
foreach ($rows as $r) {
    $key = mb_strtolower($r[2]);
    if (!isset($unique[$key])) { $unique[$key] = true; $dedup[] = $r; }
}

$outPath = __DIR__ . '/../ibiza villa/keywords_it_expanded.csv';
writeCsv($outPath, ['language','category','keyword','seed'], $dedup);
echo "Generado listado italiano: $outPath\n";
?>