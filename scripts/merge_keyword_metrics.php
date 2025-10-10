<?php
// Merge expanded keywords with available metrics (avg monthly searches, monthly breakdown, low/high CPC)
// Inputs:
// - ibiza villa/keywords_expanded.csv
// - datos_google_ads/exports/keyword_ideas_real.csv (if present)
// Output:
// - ibiza villa/keywords_with_metrics.csv

mb_internal_encoding('UTF-8');

function readCsvAssoc($path) {
    $rows = [];
    if (!file_exists($path)) { return $rows; }
    $fh = fopen($path, 'r');
    if (!$fh) { return $rows; }
    $headers = fgetcsv($fh);
    if (!$headers) { fclose($fh); return $rows; }
    $map = [];
    foreach ($headers as $i => $h) { $map[$i] = strtolower(trim($h)); }
    while (($row = fgetcsv($fh)) !== false) {
        $assoc = [];
        foreach ($row as $i => $val) {
            $assoc[$map[$i] ?? $i] = $val;
        }
        $rows[] = $assoc;
    }
    fclose($fh);
    return $rows;
}

function writeCsv($path, $headers, $rows) {
    $fh = fopen($path, 'w');
    fputcsv($fh, $headers);
    foreach ($rows as $r) { fputcsv($fh, $r); }
    fclose($fh);
}

$expandedCandidates = [
    __DIR__ . '/../ibiza villa/keywords_expanded.csv',
    // Prefer Italian expanded list if present when working the IT pipeline
    __DIR__ . '/../ibiza villa/keywords_it_expanded.csv',
    // Fallback to generated multi-language expanded list under exports
    __DIR__ . '/../datos_google_ads/exports/keywords_expanded.csv',
];
$expandedPath = null;
foreach ($expandedCandidates as $cand) {
    if (file_exists($cand)) { $expandedPath = $cand; break; }
}
$expandedPath = $expandedPath ?: (__DIR__ . '/../ibiza villa/keywords_expanded.csv');
$metricsPathCandidates = [
    __DIR__ . '/../datos_google_ads/exports/keyword_ideas_real.csv',
    __DIR__ . '/../ibiza villa/keyword_ideas_real.csv',
];

$expanded = readCsvAssoc($expandedPath);
if (empty($expanded)) {
    fwrite(STDERR, "No se encontró expanded CSV: $expandedPath\n");
    exit(1);
}

// Load metrics if available
$metrics = [];
$metricsLoaded = false;
foreach ($metricsPathCandidates as $mp) {
    if (file_exists($mp)) {
        $rows = readCsvAssoc($mp);
        foreach ($rows as $r) {
            $kw = mb_strtolower(trim($r['keyword'] ?? ''));
            if ($kw === '') { continue; }
            $metrics[$kw] = [
                'avg_monthly_searches' => $r['avg_monthly_searches'] ?? ($r['search_volume'] ?? ''),
                'monthly_searches_json' => $r['monthly_searches_json'] ?? '',
                'low_cpc_eur' => $r['low_cpc_eur'] ?? ($r['low_cpc'] ?? ''),
                'high_cpc_eur' => $r['high_cpc_eur'] ?? ($r['high_cpc'] ?? ''),
            ];
        }
        $metricsLoaded = true;
        break;
    }
}

$outPath = __DIR__ . '/../ibiza villa/keywords_with_metrics.csv';
$headers = ['language', 'category', 'keyword', 'seed', 'avg_monthly_searches', 'monthly_searches_json', 'low_cpc_eur', 'high_cpc_eur'];
$outRows = [];

foreach ($expanded as $row) {
    $kw = mb_strtolower(trim($row['keyword'] ?? ''));
    $m = $metrics[$kw] ?? ['avg_monthly_searches' => '', 'monthly_searches_json' => '', 'low_cpc_eur' => '', 'high_cpc_eur' => ''];
    $outRows[] = [
        $row['language'] ?? '',
        $row['category'] ?? '',
        $row['keyword'] ?? '',
        $row['seed'] ?? '',
        $m['avg_monthly_searches'],
        $m['monthly_searches_json'],
        $m['low_cpc_eur'],
        $m['high_cpc_eur'],
    ];
}

writeCsv($outPath, $headers, $outRows);

if ($metricsLoaded) {
    echo "Export con métricas: $outPath (expanded: $expandedPath)\n";
} else {
    echo "Export sin métricas (pendiente API): $outPath (expanded: $expandedPath)\n";
}
?>