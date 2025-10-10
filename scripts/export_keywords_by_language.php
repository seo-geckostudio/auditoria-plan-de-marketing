<?php
// Export the 'keyword' column grouped by language from available expanded CSVs
// Generates plain text files: ibiza villa/keywords_<lang>_list.txt (one keyword per line)

declare(strict_types=1);

$baseDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ibiza villa';

if (!is_dir($baseDir)) {
    fwrite(STDERR, "Base directory not found: {$baseDir}\n");
    exit(1);
}

// Discover source CSVs: keywords_*_expanded.csv and keywords_expanded.csv (assumed 'en')
$files = glob($baseDir . DIRECTORY_SEPARATOR . 'keywords_*_expanded.csv');
// Ensure English base file is included if present
$enFile = $baseDir . DIRECTORY_SEPARATOR . 'keywords_expanded.csv';
if (is_file($enFile) && !in_array($enFile, $files, true)) {
    $files[] = $enFile;
}

if (!$files) {
    fwrite(STDERR, "No expanded keyword CSVs found in: {$baseDir}\n");
    exit(1);
}

// Parse optional per-language max limits, e.g. --max=en:100 --max=es:200
$maxPerLang = [];
if (!empty($argv)) {
    foreach ($argv as $arg) {
        if (preg_match('/^--max=([a-z]{2}):(\d+)$/i', (string)$arg, $m)) {
            $maxPerLang[strtolower($m[1])] = (int)$m[2];
        }
    }
}

// Helper to get language code from filename
$langFromFilename = function (string $filePath): string {
    $basename = basename($filePath);
    if ($basename === 'keywords_expanded.csv') {
        return 'en';
    }
    // match keywords_<lang>_expanded.csv
    if (preg_match('/^keywords_([a-z]{2})_expanded\.csv$/i', $basename, $m)) {
        return strtolower($m[1]);
    }
    return 'xx';
};

// Read a CSV and return all values in 'keyword' column
$readKeywords = function (string $filePath): array {
    $fh = fopen($filePath, 'r');
    if (!$fh) {
        throw new RuntimeException("Cannot open: {$filePath}");
    }
    $header = fgetcsv($fh);
    if (!$header) {
        fclose($fh);
        return [];
    }
    // normalize header
    $map = [];
    foreach ($header as $i => $col) {
        $map[strtolower(trim((string)$col))] = $i;
    }
    if (!isset($map['keyword'])) {
        fclose($fh);
        throw new RuntimeException("File missing 'keyword' column: {$filePath}");
    }
    $keywords = [];
    while (($row = fgetcsv($fh)) !== false) {
        // skip empty/short rows
        if (!is_array($row) || count($row) <= $map['keyword']) {
            continue;
        }
        $kw = trim((string)$row[$map['keyword']]);
        if ($kw !== '') {
            $keywords[] = $kw;
        }
    }
    fclose($fh);
    return $keywords;
};

$generated = [];
foreach ($files as $file) {
    $lang = $langFromFilename($file);
    $keywords = $readKeywords($file);
    // Filter out non-rental terms: remove lines containing 'for sale' or 'buy'
    $keywords = array_values(array_filter($keywords, function ($kw) {
        $lower = strtolower($kw);
        if (strpos($lower, 'for sale') !== false) {
            return false;
        }
        if (preg_match('/\bbuy\b/i', $kw)) {
            return false;
        }
        return true;
    }));
    // Normalize: remove standalone language markers (es, it, en, fr, de, nl, pt)
    $langTokens = '(es|it|en|fr|de|nl|pt)';
    $keywords = array_map(function ($kw) use ($langTokens) {
        $kw = preg_replace('/\b' . $langTokens . '\b/i', '', $kw);
        $kw = preg_replace('/\s+/', ' ', $kw);
        return trim($kw);
    }, $keywords);
    // Remove empty results and deduplicate
    $keywords = array_values(array_unique(array_filter($keywords, function ($kw) {
        return $kw !== '';
    })));

    // Apply max limit per language if provided
    if (isset($maxPerLang[$lang]) && $maxPerLang[$lang] >= 0) {
        $keywords = array_slice($keywords, 0, $maxPerLang[$lang]);
    }
    $outPath = $baseDir . DIRECTORY_SEPARATOR . "keywords_{$lang}_list.txt";
    // Write one keyword per line, no bullets
    $out = fopen($outPath, 'w');
    if (!$out) {
        throw new RuntimeException("Cannot write: {$outPath}");
    }
    foreach ($keywords as $kw) {
        fwrite($out, $kw . "\n");
    }
    fclose($out);
    $generated[$lang] = [
        'file' => $outPath,
        'count' => count($keywords),
        'source' => $file,
    ];
}

// Print summary
foreach ($generated as $lang => $info) {
    echo sprintf(
        "%s: %d keywords -> %s (from %s)\n",
        $lang,
        $info['count'],
        $info['file'],
        basename($info['source'])
    );
}

echo "Done.\n";