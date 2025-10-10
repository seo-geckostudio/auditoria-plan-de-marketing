<?php
// Fetch real keyword metrics for Italian (Italy) via Google Ads REST API
// Inputs: ibiza villa/keywords_it_expanded.csv
// Output: datos_google_ads/exports/keyword_ideas_real.csv (Italian rows with metrics)

declare(strict_types=1);

$root = dirname(__DIR__);
$envPath = $root . '/.env';
$inputCsv = $root . '/ibiza villa/keywords_it_expanded.csv';
$exportsDir = $root . '/datos_google_ads/exports';
$outputCsv = $exportsDir . '/keyword_ideas_real.csv';

if (!is_dir($exportsDir)) {
    mkdir($exportsDir, 0777, true);
}

function loadEnv(string $path): void {
    if (!file_exists($path)) return;
    $lines = file($path);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $val = trim($parts[1]);
            // Remove surrounding quotes if present
            if ((str_starts_with($val, '"') && str_ends_with($val, '"')) || (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                $val = substr($val, 1, -1);
            }
            putenv($key . '=' . $val);
        }
    }
}

function getAccessToken(string $clientId, string $clientSecret, string $refreshToken): string {
    $url = 'https://oauth2.googleapis.com/token';
    $payload = http_build_query([
        'grant_type' => 'refresh_token',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'refresh_token' => $refreshToken,
    ]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    // TEMP: Disable SSL verification due to missing CA bundle in portable PHP
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $resp = curl_exec($ch);
    if ($resp === false) {
        throw new RuntimeException('OAuth token request failed: ' . curl_error($ch));
    }
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code !== 200) {
        throw new RuntimeException('OAuth token request HTTP ' . $code . ': ' . $resp);
    }
    $data = json_decode($resp, true);
    if (!isset($data['access_token'])) {
        throw new RuntimeException('Missing access_token in OAuth response: ' . $resp);
    }
    return $data['access_token'];
}

function postKeywordIdeas(string $accessToken, string $developerToken, string $customerId, ?string $loginCustomerId, array $keywords): array {
    $url = 'https://googleads.googleapis.com/v21/customers/' . rawurlencode($customerId) . ':generateKeywordIdeas';
    $payload = [
        'language' => 'languageConstants/1005', // Italian
        'geoTargetConstants' => ['geoTargetConstants/2380'], // Italy
        'keywordPlanNetwork' => 'GOOGLE_SEARCH',
        'keywordSeed' => [ 'keywords' => array_values($keywords) ],
        // Keep defaults for historical metrics; API returns monthly volumes by default
    ];
    $headers = [
        'Authorization: Bearer ' . $accessToken,
        'developer-token: ' . $developerToken,
        'Content-Type: application/json',
        'Accept: application/json',
    ];
    if ($loginCustomerId && $loginCustomerId !== '') {
        $headers[] = 'login-customer-id: ' . $loginCustomerId;
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // TEMP: Disable SSL verification due to missing CA bundle in portable PHP
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $resp = curl_exec($ch);
    if ($resp === false) {
        throw new RuntimeException('GenerateKeywordIdeas request failed: ' . curl_error($ch));
    }
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code !== 200) {
        throw new RuntimeException('GenerateKeywordIdeas HTTP ' . $code . ': ' . $resp);
    }
    $data = json_decode($resp, true);
    return $data ?? [];
}

function readItalianKeywords(string $path): array {
    if (!file_exists($path)) {
        throw new RuntimeException('Input CSV not found: ' . $path);
    }
    $fh = fopen($path, 'r');
    $header = fgetcsv($fh);
    $idxLang = array_search('language', $header);
    $idxCategory = array_search('category', $header);
    $idxKeyword = array_search('keyword', $header);
    $idxSeed = array_search('seed', $header);
    $rows = [];
    while (($row = fgetcsv($fh)) !== false) {
        if (!$row) continue;
        $lang = $idxLang !== false ? $row[$idxLang] : 'it';
        if (strtolower(trim($lang)) !== 'it') continue;
        $kw = $idxKeyword !== false ? $row[$idxKeyword] : null;
        $cat = $idxCategory !== false ? $row[$idxCategory] : '';
        $seed = $idxSeed !== false ? $row[$idxSeed] : 'it';
        if ($kw) {
            $rows[] = ['language' => 'it', 'category' => $cat, 'keyword' => $kw, 'seed' => $seed];
        }
    }
    fclose($fh);
    return $rows;
}

function writeCsv(string $path, array $rows): void {
    $fh = fopen($path, 'w');
    fputcsv($fh, ['language','category','keyword','seed','avg_monthly_searches','monthly_searches_json','low_cpc_eur','high_cpc_eur']);
    foreach ($rows as $r) {
        fputcsv($fh, [
            $r['language'] ?? 'it',
            $r['category'] ?? 'alquiler villas ibiza',
            $r['keyword'] ?? '',
            $r['seed'] ?? 'it',
            $r['avg_monthly_searches'] ?? '',
            $r['monthly_searches_json'] ?? '{}',
            $r['low_cpc_eur'] ?? '',
            $r['high_cpc_eur'] ?? '',
        ]);
    }
    fclose($fh);
}

// Main execution
loadEnv($envPath);

try {
    $developerToken = getenv('GOOGLE_ADS_DEVELOPER_TOKEN') ?: '';
    $clientId = getenv('GOOGLE_ADS_CLIENT_ID') ?: '';
    $clientSecret = getenv('GOOGLE_ADS_CLIENT_SECRET') ?: '';
    $refreshToken = getenv('GOOGLE_ADS_REFRESH_TOKEN') ?: '';
    $loginCustomerId = getenv('GOOGLE_ADS_LOGIN_CUSTOMER_ID') ?: '';
    $customerId = getenv('GOOGLE_ADS_CUSTOMER_ID') ?: $loginCustomerId;

    if ($developerToken === '' || $clientId === '' || $clientSecret === '' || $refreshToken === '' || $customerId === '') {
        throw new RuntimeException('Missing Google Ads credentials (.env). Required: GOOGLE_ADS_DEVELOPER_TOKEN, GOOGLE_ADS_CLIENT_ID, GOOGLE_ADS_CLIENT_SECRET, GOOGLE_ADS_REFRESH_TOKEN, GOOGLE_ADS_LOGIN_CUSTOMER_ID or GOOGLE_ADS_CUSTOMER_ID');
    }

    $seedRows = readItalianKeywords($inputCsv);
    if (count($seedRows) === 0) {
        throw new RuntimeException('No Italian keywords found in input CSV.');
    }

    // Deduplicate keywords and chunk
    $allKeywords = array_values(array_unique(array_map(fn($r) => $r['keyword'], $seedRows)));
    $chunks = array_chunk($allKeywords, 100);

    // If an access token is provided via environment, use it directly to skip OAuth refresh flow.
    $accessTokenEnv = getenv('GOOGLE_OAUTH_ACCESS_TOKEN') ?: '';
    $accessToken = $accessTokenEnv !== ''
        ? $accessTokenEnv
        : getAccessToken($clientId, $clientSecret, $refreshToken);
    $collected = [];

    foreach ($chunks as $chunk) {
        $resp = postKeywordIdeas($accessToken, $developerToken, $customerId, $loginCustomerId, $chunk);
        $results = $resp['results'] ?? [];
        foreach ($results as $item) {
            $text = $item['text'] ?? '';
            $metrics = $item['keywordIdeasMetrics'] ?? [];
            $avgMonthly = $metrics['avgMonthlySearches'] ?? null;
            $lowMicros = $metrics['lowTopOfPageBidMicros'] ?? null;
            $highMicros = $metrics['highTopOfPageBidMicros'] ?? null;
            $monthlyVolumes = $metrics['monthlySearchVolumes'] ?? [];
            $monthMap = [];
            foreach ($monthlyVolumes as $mv) {
                $m = $mv['month'] ?? null; // 1..12
                $val = $mv['monthlySearches'] ?? null;
                if ($m !== null && $val !== null) {
                    $monthMap[(string)$m] = (int)$val;
                }
            }
            $collected[] = [
                'language' => 'it',
                'category' => 'alquiler villas ibiza',
                'keyword' => $text,
                'seed' => 'it',
                'avg_monthly_searches' => $avgMonthly !== null ? (int)$avgMonthly : '',
                'monthly_searches_json' => json_encode($monthMap, JSON_UNESCAPED_UNICODE),
                'low_cpc_eur' => $lowMicros !== null ? round(((int)$lowMicros) / 1_000_000, 2) : '',
                'high_cpc_eur' => $highMicros !== null ? round(((int)$highMicros) / 1_000_000, 2) : '',
            ];
        }
        // Be polite with API rate limits
        usleep(300_000);
    }

    if (count($collected) === 0) {
        throw new RuntimeException('Google Ads API returned no results for the provided keywords.');
    }

    writeCsv($outputCsv, $collected);
    echo "Saved Italian keyword metrics to: {$outputCsv}\n";
} catch (Throwable $e) {
    $logPath = $exportsDir . '/fetch_metrics_it_rest.log';
    file_put_contents($logPath, '[' . date('c') . "] " . $e->getMessage() . "\n");
    fwrite(STDERR, $e->getMessage());
    exit(1);
}