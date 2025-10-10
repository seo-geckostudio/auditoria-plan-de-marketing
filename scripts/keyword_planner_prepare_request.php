<?php
// Prepare Keyword Planner request payloads from seed keywords and selected account.
// Outputs:
// - datos_google_ads/exports/generate_keyword_ideas_requests.json
// - datos_google_ads/exports/seeds_used.csv
// - datos_google_ads/exports/mock_keyword_ideas.csv (placeholder metrics)

declare(strict_types=1);

$root = dirname(__DIR__);
$selectedPath = $root . '/datos_google_ads/selected_customer.json';
$seedsPath = $root . '/datos_google_ads/seed_keywords_template.csv';
$exportsDir = $root . '/datos_google_ads/exports';
$envTemplate = $root . '/.env.template';

if (!is_dir($exportsDir)) {
    mkdir($exportsDir, 0777, true);
}

function readJson(string $path): array {
    if (!file_exists($path)) return [];
    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function readEnvTemplate(string $path): array {
    if (!file_exists($path)) return [];
    $env = [];
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (preg_match('/^\s*([A-Z0-9_]+)\s*=\s*(.*)$/', $line, $m)) {
            $env[$m[1]] = trim($m[2]);
        }
    }
    return $env;
}

function readSeeds(string $csvPath): array {
    if (!file_exists($csvPath)) {
        throw new RuntimeException('Seed CSV not found: ' . $csvPath);
    }
    $fh = fopen($csvPath, 'r');
    $header = fgetcsv($fh);
    if (!$header) throw new RuntimeException('Seed CSV is empty');
    $idxCategory = array_search('category', $header);
    $idxKeyword = array_search('keyword', $header);
    $idxLanguage = array_search('language', $header);
    if ($idxCategory === false || $idxKeyword === false || $idxLanguage === false) {
        throw new RuntimeException('Seed CSV must have headers: category, keyword, language');
    }
    $seeds = [];
    while (($row = fgetcsv($fh)) !== false) {
        $cat = trim((string)$row[$idxCategory]);
        $kw = trim((string)$row[$idxKeyword]);
        $lang = trim((string)$row[$idxLanguage]);
        if ($kw === '') continue;
        if ($cat === '') $cat = 'pilar';
        if ($lang === '') $lang = 'es';
        $seeds[$lang][$cat][] = $kw;
    }
    fclose($fh);
    return $seeds;
}

$selected = readJson($selectedPath);
$customerId = $selected['customer_id'] ?? null;
$accountLabel = $selected['label'] ?? null;

$env = readEnvTemplate($envTemplate);
$credentials = [
    'developer_token' => $env['GOOGLE_ADS_DEVELOPER_TOKEN'] ?? '',
    'client_id' => $env['GOOGLE_ADS_CLIENT_ID'] ?? '',
    'client_secret' => $env['GOOGLE_ADS_CLIENT_SECRET'] ?? '',
    'refresh_token' => $env['GOOGLE_ADS_REFRESH_TOKEN'] ?? '',
    'login_customer_id' => $env['GOOGLE_ADS_LOGIN_CUSTOMER_ID'] ?? '',
];

$seeds = readSeeds($seedsPath);

$languageMap = [
    'es' => 'Spanish',
    'en' => 'English',
    'de' => 'German',
    'fr' => 'French',
    'it' => 'Italian',
];

$bundles = [];
foreach ($seeds as $lang => $cats) {
    $allKeywords = [];
    foreach ($cats as $cat => $arr) {
        foreach ($arr as $kw) $allKeywords[$kw] = true;
    }
    $allKeywords = array_keys($allKeywords);
    $bundles[] = [
        'customer_id' => $customerId,
        'account_label' => $accountLabel,
        'language' => $lang,
        'language_name' => $languageMap[$lang] ?? $lang,
        'login_customer_id' => $credentials['login_customer_id'],
        'developer_token' => $credentials['developer_token'],
        'keyword_plan_network' => 'GOOGLE_SEARCH',
        'seed_keywords' => $allKeywords,
        'geo_targets_hint' => ['ES', 'UK', 'DE', 'FR', 'IT'],
        'note' => 'Prepared payload for KeywordPlanIdeaService.GenerateKeywordIdeas',
    ];
}

file_put_contents($exportsDir . '/generate_keyword_ideas_requests.json', json_encode($bundles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Export seeds_used.csv
$fhOut = fopen($exportsDir . '/seeds_used.csv', 'w');
fputcsv($fhOut, ['language', 'category', 'keyword']);
foreach ($seeds as $lang => $cats) {
    foreach ($cats as $cat => $arr) {
        foreach ($arr as $kw) {
            fputcsv($fhOut, [$lang, $cat, $kw]);
        }
    }
}
fclose($fhOut);

// Create mock ideas CSV by echoing seeds with placeholder metrics.
$fhMock = fopen($exportsDir . '/mock_keyword_ideas.csv', 'w');
fputcsv($fhMock, [
    'Keyword', 'Avg monthly searches', 'Competition', 'Top of page bid (low range)', 'Top of page bid (high range)', 'Language'
]);
foreach ($seeds as $lang => $cats) {
    foreach ($cats as $cat => $arr) {
        foreach ($arr as $kw) {
            $base = match ($cat) {
                'pilar' => 1600,
                'localidad' => 900,
                'amenity' => 600,
                'intencion' => 1200,
                default => 700,
            };
            $len = strlen($kw);
            $avg = max(90, (int)round($base - $len * 7));
            $low = round($avg * 0.02, 2);
            $high = round($avg * 0.06, 2);
            $comp = ($avg > 1200) ? 'High' : (($avg > 800) ? 'Medium' : 'Low');
            fputcsv($fhMock, [$kw, $avg, $comp, $low, $high, $lang]);
        }
    }
}
fclose($fhMock);

// Summary output
$totalSeeds = 0;
foreach ($seeds as $cats) {
    foreach ($cats as $arr) $totalSeeds += count($arr);
}

echo "Prepared requests for Keyword Planner\n";
echo "Account: {$accountLabel} ({$customerId})\n";
echo "Seeds: {$totalSeeds} across languages: " . implode(',', array_keys($seeds)) . "\n";
echo "Outputs:\n - exports/generate_keyword_ideas_requests.json\n - exports/seeds_used.csv\n - exports/mock_keyword_ideas.csv\n";