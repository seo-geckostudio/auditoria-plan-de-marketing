<?php
// Generate a strategic list of 100 EN keywords for Ibiza villa rentals
// Focus: intent, locations, amenities, audiences, seasons/duration

declare(strict_types=1);

function add(array &$out, string $kw): void {
    $kw = preg_replace('/\s+/', ' ', trim($kw));
    if ($kw !== '') { $out[$kw] = true; }
}

$keywords = [];

// Core intents (Ibiza-wide)
$core = [
    'rent villa ibiza',
    'villa rental ibiza',
    'rent villas ibiza',
    'luxury villa ibiza',
    'cheap villa ibiza',
    'budget villa ibiza',
    'premium villa ibiza',
    'exclusive villa ibiza',
    'modern villa ibiza',
    'rent villa with pool ibiza',
    'sea view villa ibiza',
    'near beach villa ibiza',
    'beachfront villa ibiza',
    'private villa ibiza',
    'secluded villa ibiza',
    'family villa ibiza',
    'group villa ibiza',
    'pet friendly villa ibiza',
    'couples villa ibiza',
    'friends villa ibiza',
    'kids friendly villa ibiza',
    'summer villa ibiza',
    'july villa ibiza',
    'august villa ibiza',
    'weekly villa ibiza',
    'weekend villa ibiza',
];
foreach ($core as $kw) add($keywords, $kw);

// Amenities and features
$amenities = [
    'jacuzzi villa ibiza',
    'bbq villa ibiza',
    'air conditioned villa ibiza',
    'wifi villa ibiza',
    'parking villa ibiza',
    'heated pool villa ibiza',
    'sea front villa ibiza',
    'sunset view villa ibiza',
    'near nightlife villa ibiza',
    'near old town villa ibiza',
];
foreach ($amenities as $kw) add($keywords, $kw);

// Strategic towns/areas (10) x 4 variants (base, luxury, family, with pool)
$locations = [
    'san jose', 'santa eulalia', 'san antonio', 'sant joan', 'ibiza town',
    'jesus', 'es cubells', 'santa gertrudis', 'portinatx', 'cala vadella',
    'san miguel', 'sant carles',
];
foreach ($locations as $loc) {
    add($keywords, "rent villa {$loc}");
    add($keywords, "rent villa luxury {$loc}");
    add($keywords, "rent villa family {$loc}");
    add($keywords, "rent villa with pool {$loc}");
}

// Popular beaches (10) base variant
$beaches = [
    'cala comte', 'cala bassa', 'cala tarida', 'cala d\'hort', 'cala salada',
    'benirras', 'talamanca', 'cala llonga', 'es figueral', 'cala vadella',
    'cala gracioneta', 'cala san vicente', 'playa d\'en bossa', 'sa caleta',
    's\'estanyol', 'cala moli', 'cala carbo', 'cala xuclar', 'cala boix', 'aguas blancas',
];
foreach ($beaches as $b) {
    add($keywords, "rent villa {$b}");
}

// Audiences and use cases
$audiences = [
    'wedding villa ibiza',
    'event villa ibiza',
    'corporate retreat villa ibiza',
    'yoga retreat villa ibiza',
    'honeymoon villa ibiza',
    'extended family villa ibiza',
    'large group villa ibiza',
    'small group villa ibiza',
    'child friendly villa ibiza',
];
foreach ($audiences as $kw) add($keywords, $kw);

// Extra amenities/useful features to reach full coverage
$moreAmenities = [
    'gym villa ibiza',
    'home office villa ibiza',
    'rooftop terrace villa ibiza',
    'cinema room villa ibiza',
    'game room villa ibiza',
    'security gated villa ibiza',
];
foreach ($moreAmenities as $kw) add($keywords, $kw);

// Build final list: ensure max 100
$final = array_slice(array_keys($keywords), 0, 100);

$baseDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ibiza villa';
if (!is_dir($baseDir)) {
    fwrite(STDERR, "Base directory not found: {$baseDir}\n");
    exit(1);
}
$outPath = $baseDir . DIRECTORY_SEPARATOR . 'keywords_en_list.txt';
$fh = fopen($outPath, 'w');
if (!$fh) {
    fwrite(STDERR, "Cannot write: {$outPath}\n");
    exit(1);
}
foreach ($final as $line) { fwrite($fh, $line . "\n"); }
fclose($fh);
echo "Strategic EN list written: {$outPath} (" . count($final) . " lines)\n";

?>