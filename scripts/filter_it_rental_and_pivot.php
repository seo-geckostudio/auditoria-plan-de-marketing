<?php
// Filter Italian rental/vacation rental keywords and pivot monthly data Jan–Dec
// Input: ibiza villa/keywords_it_expanded.csv (fallback) or ibiza villa/keywords_with_metrics.csv
// Output: ibiza villa/keywords_it_rental_pivot.csv and ibiza villa/it_rental_variants.txt

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

// Italian rental intent terms and property types
$intentTerms = [
    'affitto', 'affittare', 'affitti', 'in affitto',
    'affitto vacanze', 'affitto vacanza', 'casa vacanze', 'case vacanza',
    'villa vacanze', 'ville vacanza', 'vacanze', 'prenotare', 'prenotazione'
];
$propertyTypes = ['villa', 'ville', 'casa', 'case'];
$excludeTerms = ['comprare', 'acquistare', 'vendita', 'in vendita', 'vendere'];

function containsAny($text, $terms) {
    $t = mb_strtolower($text);
    foreach ($terms as $term) {
        if (mb_strpos($t, mb_strtolower($term)) !== false) { return true; }
    }
    return false;
}

function parseMonthlyJson($json) {
    $months = [1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0];
    if (!$json) { return $months; }
    $data = json_decode($json, true);
    if (!is_array($data)) { return $months; }
    // Determine latest year present if year specified
    $years = [];
    foreach ($data as $item) {
        if (is_array($item)) {
            if (isset($item['year'])) { $years[] = intval($item['year']); }
            elseif (isset($item['month']) && preg_match('/^(\d{4})-(\d{2})$/', $item['month'], $m)) { $years[] = intval($m[1]); }
        }
    }
    $targetYear = null;
    if (!empty($years)) { $targetYear = max($years); }
    foreach ($data as $item) {
        $count = 0;
        $mNum = null;
        $y = null;
        if (isset($item['searches'])) { $count = intval($item['searches']); }
        elseif (isset($item['monthly_searches'])) { $count = intval($item['monthly_searches']); }
        elseif (isset($item['count'])) { $count = intval($item['count']); }
        if (isset($item['month']) && preg_match('/^(\d{4})-(\d{2})$/', $item['month'], $m)) {
            $y = intval($m[1]);
            $mNum = intval($m[2]);
        } elseif (isset($item['year']) && isset($item['month'])) {
            $y = intval($item['year']);
            $mRaw = $item['month'];
            if (is_numeric($mRaw)) { $mNum = intval($mRaw); }
            else {
                // Map month names to numbers (en/it)
                $mn = mb_strtolower($mRaw);
                $names = ['january'=>1,'february'=>2,'march'=>3,'april'=>4,'may'=>5,'june'=>6,'july'=>7,'august'=>8,'september'=>9,'october'=>10,'november'=>11,'december'=>12,
                          'gennaio'=>1,'febbraio'=>2,'marzo'=>3,'aprile'=>4,'maggio'=>5,'giugno'=>6,'luglio'=>7,'agosto'=>8,'settembre'=>9,'ottobre'=>10,'novembre'=>11,'dicembre'=>12];
                $mNum = $names[$mn] ?? null;
            }
        }
        if ($mNum !== null) {
            if ($targetYear === null || $y === null || $y === $targetYear) {
                $months[$mNum] += $count;
            }
        }
    }
    return $months;
}

// Paths (prefer metrics file, fallback to expanded IT list if metrics missing)
$metricsPath = __DIR__ . '/../ibiza villa/keywords_with_metrics.csv';
$expandedItPath = __DIR__ . '/../ibiza villa/keywords_it_expanded.csv';
$inputPath = file_exists($metricsPath) ? $metricsPath : $expandedItPath;
$outputPath = __DIR__ . '/../ibiza villa/keywords_it_rental_pivot.csv';
$variantsPath = __DIR__ . '/../ibiza villa/it_rental_variants.txt';

// Read rows from chosen input; if metrics file exists but has zero IT rows, fallback to expanded IT list
$rows = readCsvAssoc($inputPath);
if (empty($rows) || ($inputPath === $metricsPath && !array_filter($rows, fn($r) => mb_strtolower($r['language'] ?? '') === 'it'))) {
    if (file_exists($expandedItPath)) {
        $rows = readCsvAssoc($expandedItPath);
        $inputPath = $expandedItPath;
    }
}
if (empty($rows)) {
    fwrite(STDERR, "No se encontró input válido: $inputPath\n");
    exit(1);
}

// Filter Italian rental only and property-related
$filtered = [];
foreach ($rows as $r) {
    $lang = mb_strtolower($r['language'] ?? '');
    if ($lang !== 'it') { continue; }
    $kw = $r['keyword'] ?? '';
    if (!containsAny($kw, $intentTerms)) { continue; }
    if (!containsAny($kw, $propertyTypes)) { continue; }
    if (containsAny($kw, $excludeTerms)) { continue; }
    $filtered[] = $r;
}

// Sort by avg_monthly_searches desc (numeric)
usort($filtered, function($a, $b) {
    $av = intval($a['avg_monthly_searches'] ?? 0);
    $bv = intval($b['avg_monthly_searches'] ?? 0);
    return $bv <=> $av;
});

// Limit for testing
$limit = 2000;
if (count($filtered) > $limit) { $filtered = array_slice($filtered, 0, $limit); }

// Prepare headers with Spanish month names
$headers = ['language','category','keyword','seed','avg_monthly_searches','low_cpc_eur','high_cpc_eur',
    'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'
];

$outRows = [];
foreach ($filtered as $r) {
    // If monthly_searches_json not present (expanded-only), default to zeros
    $months = [1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0];
    if (array_key_exists('monthly_searches_json', $r)) {
        $months = parseMonthlyJson($r['monthly_searches_json'] ?? '');
    }
    $outRows[] = [
        $r['language'] ?? 'it',
        $r['category'] ?? 'alquiler villas ibiza',
        $r['keyword'] ?? '',
        $r['seed'] ?? 'it',
        $r['avg_monthly_searches'] ?? '',
        $r['low_cpc_eur'] ?? '',
        $r['high_cpc_eur'] ?? '',
        $months[1] ?? 0,
        $months[2] ?? 0,
        $months[3] ?? 0,
        $months[4] ?? 0,
        $months[5] ?? 0,
        $months[6] ?? 0,
        $months[7] ?? 0,
        $months[8] ?? 0,
        $months[9] ?? 0,
        $months[10] ?? 0,
        $months[11] ?? 0,
        $months[12] ?? 0,
    ];
}

writeCsv($outputPath, $headers, $outRows);

// Variants file with common Italian rental queries for villas/houses
$variants = [
    'villa in affitto ibiza','ville in affitto ibiza','casa in affitto ibiza','case in affitto ibiza',
    'affitto vacanze ibiza','villa vacanze ibiza','case vacanza ibiza','ville vacanza ibiza',
    'prenotare villa ibiza','prenotazione villa ibiza','affitto luglio ibiza','affitto agosto ibiza',
    'affitto settimanale ibiza','affitto weekend ibiza','villa con piscina ibiza in affitto',
    'villa vista mare ibiza in affitto','ville di lusso ibiza in affitto','casa vicino alla spiaggia ibiza in affitto'
];
file_put_contents($variantsPath, implode("\n", $variants));

echo "Generado: $outputPath\n";
echo "Variantes: $variantsPath\n";
?>