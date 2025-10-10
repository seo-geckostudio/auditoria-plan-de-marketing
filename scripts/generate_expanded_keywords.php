<?php
// Generate an expanded, deduplicated keyword list across multiple languages
// Output: datos_google_ads/exports/keywords_expanded.csv

mb_internal_encoding('UTF-8');

function ensureDir($path) {
    if (!is_dir($path)) {
        @mkdir($path, 0777, true);
    }
}

function readSeeds($path) {
    $seeds = [];
    if (file_exists($path)) {
        $fh = fopen($path, 'r');
        if ($fh) {
            $header = fgetcsv($fh);
            while (($row = fgetcsv($fh)) !== false) {
                if (count($row) < 3) { continue; }
                $language = trim($row[0] ?? '');
                $category = trim($row[1] ?? '');
                $keyword = trim($row[2] ?? '');
                if ($keyword !== '') {
                    $seeds[] = [
                        'language' => $language ?: 'es',
                        'category' => $category ?: 'general',
                        'keyword' => $keyword,
                    ];
                }
            }
            fclose($fh);
        }
    }
    return $seeds;
}

// Built-in seeds fallback (multi-language, Ibiza villas context)
$fallbackSeeds = [
    ['language' => 'es', 'category' => 'alquiler', 'keyword' => 'alquiler villas ibiza'],
    ['language' => 'es', 'category' => 'lujo', 'keyword' => 'villas de lujo en ibiza'],
    ['language' => 'es', 'category' => 'compra', 'keyword' => 'comprar villa ibiza'],
    ['language' => 'en', 'category' => 'rent', 'keyword' => 'ibiza luxury villas'],
    ['language' => 'en', 'category' => 'rent', 'keyword' => 'rent villa ibiza'],
    ['language' => 'de', 'category' => 'mieten', 'keyword' => 'luxusvilla ibiza mieten'],
    ['language' => 'fr', 'category' => 'location', 'keyword' => 'villa de luxe ibiza'],
    ['language' => 'it', 'category' => 'affitto', 'keyword' => 'villa di lusso ibiza'],
];

$locations = [
    'es' => ['ibiza', 'san josé', 'es cubells', 'santa eulària', 'sant antoni', 'sant joan', 'jesús', 'san rafael', 'talamanca', 'cala conta', 'cala tarida', 'cala bassa', 'cala llonga', 'cala vadella', 'portinatx', 'es canar', 'es vedrà', 'dalt vila', 'sa caleta'],
    'en' => ['ibiza', 'san jose', 'es cubells', 'santa eulalia', 'san antonio', 'sant joan', 'jesus', 'san rafael', 'talamanca', 'cala conta', 'cala tarida', 'cala bassa', 'cala llonga', 'cala vadella', 'portinatx', 'es canar', 'es vedra', 'dalt vila', 'sa caleta'],
    'de' => ['ibiza', 'san jose', 'es cubells', 'santa eulalia', 'san antonio', 'jesus', 'talamanca', 'cala conta', 'cala tarida', 'cala bassa', 'cala llonga', 'cala vadella', 'portinatx', 'es canar', 'es vedra'],
    'fr' => ['ibiza', 'san josé', 'es cubells', 'santa eulalia', 'san antonio', 'talamanca', 'cala conta', 'cala tarida', 'cala bassa', 'cala llonga', 'portinatx', 'es vedrà'],
    'it' => ['ibiza', 'san jose', 'es cubells', 'santa eulalia', 'san antonio', 'talamanca', 'cala conta', 'cala tarida', 'cala bassa', 'cala llonga', 'portinatx', 'es vedra'],
];

$intents = [
    'es' => ['alquiler', 'alquilar', 'alquiler vacacional', 'reservar', 'comprar', 'venta'],
    'en' => ['rent', 'rental', 'book', 'buy', 'for sale'],
    'de' => ['mieten', 'ferien', 'buchen', 'kaufen', 'zum verkauf'],
    'fr' => ['location', 'louer', 'réserver', 'acheter', 'à vendre'],
    'it' => ['affitto', 'affittare', 'prenotare', 'comprare', 'in vendita'],
];

$types = [
    'es' => ['villa', 'villas', 'casa', 'chalé'],
    'en' => ['villa', 'villas', 'house'],
    'de' => ['villa', 'villen', 'haus'],
    'fr' => ['villa', 'villas', 'maison'],
    'it' => ['villa', 'ville', 'casa'],
];

$modifiers = [
    'es' => ['lujo', 'barata', 'económica', 'premium', 'exclusiva', 'moderna', 'con piscina', 'vista al mar', 'cerca de la playa', 'para familias', 'para grupos', 'pet friendly'],
    'en' => ['luxury', 'cheap', 'budget', 'premium', 'exclusive', 'modern', 'with pool', 'sea view', 'near beach', 'family', 'group', 'pet friendly'],
    'de' => ['luxus', 'günstig', 'exklusiv', 'modern', 'mit pool', 'meerblick', 'strandnah', 'familie', 'gruppe'],
    'fr' => ['luxe', 'pas cher', 'exclusif', 'moderne', 'avec piscine', 'vue mer', 'près de la plage', 'famille', 'groupe'],
    'it' => ['lusso', 'economica', 'esclusiva', 'moderna', 'con piscina', 'vista mare', 'vicino alla spiaggia', 'famiglia', 'gruppo'],
];

$timeQualifiers = [
    'es' => ['verano', 'julio', 'agosto', '2025', 'semana', 'fin de semana'],
    'en' => ['summer', 'july', 'august', '2025', 'week', 'weekend'],
    'de' => ['sommer', 'juli', 'august', '2025', 'woche', 'wochenende'],
    'fr' => ['été', 'juillet', 'août', '2025', 'semaine', 'week-end'],
    'it' => ['estate', 'luglio', 'agosto', '2025', 'settimana', 'weekend'],
];

function combineKeyword($parts) {
    $parts = array_filter(array_map('trim', $parts));
    $kw = implode(' ', $parts);
    // Normalize extra spaces
    $kw = preg_replace('/\s+/', ' ', $kw);
    return trim($kw);
}

function expandForLanguage($lang, $base, $locations, $intents, $types, $mods, $times) {
    $results = [];
    foreach ($intents[$lang] as $intent) {
        foreach ($types[$lang] as $type) {
            // Basic combos without modifiers
            $results[] = combineKeyword([$intent, $type, $base]);
            foreach ($mods[$lang] as $mod) {
                $results[] = combineKeyword([$intent, $type, $mod, $base]);
            }
            foreach ($locations[$lang] as $loc) {
                $results[] = combineKeyword([$intent, $type, $base, $loc]);
                foreach ($mods[$lang] as $mod) {
                    $results[] = combineKeyword([$intent, $type, $mod, $base, $loc]);
                }
                foreach ($times[$lang] as $t) {
                    $results[] = combineKeyword([$intent, $type, $base, $loc, $t]);
                    foreach ($mods[$lang] as $mod) {
                        $results[] = combineKeyword([$intent, $type, $mod, $base, $loc, $t]);
                    }
                }
            }
        }
    }
    return $results;
}

// Load seeds or fallback
$seedPath = __DIR__ . '/../datos_google_ads/seed_keywords_template.csv';
$seeds = readSeeds($seedPath);
if (empty($seeds)) {
    $seeds = $fallbackSeeds;
}

// Prepare output
$outDir = __DIR__ . '/../datos_google_ads/exports';
ensureDir($outDir);
$outCsv = $outDir . '/keywords_expanded.csv';
$fhOut = fopen($outCsv, 'w');
fputcsv($fhOut, ['language', 'category', 'keyword', 'seed']);

$seen = [];
$total = 0;
foreach ($seeds as $seed) {
    $lang = $seed['language'];
    $category = $seed['category'];
    $base = $seed['keyword'];
    if (!isset($locations[$lang])) { $lang = 'en'; }

    $expanded = expandForLanguage($lang, $base, $locations, $intents, $types, $modifiers, $timeQualifiers);
    foreach ($expanded as $kw) {
        $norm = mb_strtolower(trim($kw));
        if ($norm === '') { continue; }
        if (isset($seen[$norm])) { continue; }
        $seen[$norm] = true;
        fputcsv($fhOut, [$lang, $category, $kw, $base]);
        $total++;
    }
}

fclose($fhOut);

// Also write a brief summary file
$summary = $outDir . '/keywords_expanded_summary.txt';
file_put_contents($summary, "Total keywords: $total\nSource seeds: " . count($seeds) . "\nOutput: keywords_expanded.csv\n");

echo "Generated $total keywords to $outCsv\n";

?>