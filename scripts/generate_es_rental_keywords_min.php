<?php
// Generate a minimal Spanish rental/vacation rental keyword list for Ibiza (Spain)
// Output: ibiza villa/keywords_es_expanded.csv

mb_internal_encoding('UTF-8');

function writeCsv($path, $headers, $rows) {
    $dir = dirname($path);
    if (!is_dir($dir)) { mkdir($dir, 0777, true); }
    $fh = fopen($path, 'w');
    fputcsv($fh, $headers);
    foreach ($rows as $r) { fputcsv($fh, $r); }
    fclose($fh);
}

function combineKeyword($parts) {
    $parts = array_filter(array_map('trim', $parts));
    $kw = implode(' ', $parts);
    $kw = preg_replace('/\s+/', ' ', $kw);
    return trim($kw);
}

$language = 'es';
$category = 'alquiler villas ibiza';
$seed = 'es';
$base = 'ibiza';

$intents = ['alquiler', 'alquilar', 'alquiler vacacional', 'reservar', 'comprar', 'venta'];
$types = ['villa', 'villas', 'casa', 'chalé'];
$modifiers = ['lujo', 'barata', 'económica', 'premium', 'exclusiva', 'moderna', 'con piscina', 'vista al mar', 'cerca de la playa', 'para familias', 'para grupos', 'pet friendly'];
$locations = ['ibiza', 'san josé', 'es cubells', 'santa eulària', 'sant antoni', 'sant joan', 'jesús', 'san rafael', 'talamanca', 'cala conta', 'cala tarida', 'cala bassa', 'cala llonga', 'cala vadella', 'portinatx', 'es canar', 'es vedrà', 'dalt vila', 'sa caleta'];
$times = ['verano', 'julio', 'agosto', '2025'];

$rows = [];
$seen = [];

foreach ($intents as $intent) {
    foreach ($types as $type) {
        // Básico sin modificadores
        $kw = combineKeyword([$intent, $type, $base]);
        $norm = mb_strtolower($kw);
        if (!isset($seen[$norm])) { $rows[] = [$language, $category, $kw, $seed]; $seen[$norm] = true; }

        foreach ($modifiers as $mod) {
            $kw = combineKeyword([$intent, $type, $mod, $base]);
            $norm = mb_strtolower($kw);
            if (!isset($seen[$norm])) { $rows[] = [$language, $category, $kw, $seed]; $seen[$norm] = true; }
        }

        foreach ($locations as $loc) {
            $kw = combineKeyword([$intent, $type, $base, $loc]);
            $norm = mb_strtolower($kw);
            if (!isset($seen[$norm])) { $rows[] = [$language, $category, $kw, $seed]; $seen[$norm] = true; }

            foreach ($modifiers as $mod) {
                $kw = combineKeyword([$intent, $type, $mod, $base, $loc]);
                $norm = mb_strtolower($kw);
                if (!isset($seen[$norm])) { $rows[] = [$language, $category, $kw, $seed]; $seen[$norm] = true; }
            }
            foreach ($times as $t) {
                $kw = combineKeyword([$intent, $type, $base, $loc, $t]);
                $norm = mb_strtolower($kw);
                if (!isset($seen[$norm])) { $rows[] = [$language, $category, $kw, $seed]; $seen[$norm] = true; }
                foreach ($modifiers as $mod) {
                    $kw = combineKeyword([$intent, $type, $mod, $base, $loc, $t]);
                    $norm = mb_strtolower($kw);
                    if (!isset($seen[$norm])) { $rows[] = [$language, $category, $kw, $seed]; $seen[$norm] = true; }
                }
            }
        }
    }
}

$outPath = __DIR__ . '/../ibiza villa/keywords_es_expanded.csv';
writeCsv($outPath, ['language','category','keyword','seed'], $rows);

echo 'Generated Spanish keywords to ' . $outPath . ' (total: ' . count($rows) . ")\n";

?>