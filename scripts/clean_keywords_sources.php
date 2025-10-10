<?php
// Limpia CSVs de palabras clave en "ibiza villa":
// - Elimina términos de compra/venta en varios idiomas
// - Normaliza espacios y tokens lingüísticos sueltos (es, it, fr, nl, pt)
// - Evita duplicados manteniendo el resto de columnas

declare(strict_types=1);
error_reporting(E_ALL);

function hasPurchaseIntent(string $kw): bool {
    $patterns = [
        // English
        '/\bfor\s+sale\b/i', '/\bbuy\b/i',
        // Spanish
        '/\bventa\b/i', '/\ben\s+venta\b/i', '/\bcomprar\b/i', '/\bse\s+vende\b/i',
        // Italian
        '/\bvendita\b/i', '/\bin\s+vendita\b/i', '/\bcomprare\b/i',
        // French
        '/\bà\s+vendre\b/i', '/\bacheter\b/i', '/\bvente\b/i',
        // German
        '/\bverkauf\b/i', '/\bzum\s+verkauf\b/i', '/\bkaufen\b/i',
        // Dutch
        '/\bte\s+koop\b/i', '/\bkopen\b/i', '/\bkoop\b/i',
        // Portuguese
        '/\bà\s+venda\b/i', '/\bvenda\b/i', '/\bcomprar\b/i',
    ];
    foreach ($patterns as $p) {
        if (preg_match($p, $kw)) return true;
    }
    return false;
}

function normalizeKeyword(string $kw): string {
    // Elimina tokens lingüísticos sueltos problemáticos
    // Nota: evitamos eliminar 'de' y 'en' porque son preposiciones comunes
    $kw = preg_replace('/\b(?:es|it|fr|nl|pt)\b/i', ' ', $kw);
    // Colapsa espacios múltiples
    $kw = preg_replace('/\s{2,}/', ' ', trim($kw));
    return $kw;
}

function cleanCsv(string $filePath): array {
    $bakPath = $filePath . '.bak';
    if (!copy($filePath, $bakPath)) {
        throw new RuntimeException("No se pudo crear la copia de seguridad: {$bakPath}");
    }

    $fp = fopen($filePath, 'r');
    if (!$fp) throw new RuntimeException("No se pudo abrir: {$filePath}");

    $rows = [];
    $header = fgetcsv($fp);
    if ($header === false) {
        fclose($fp);
        throw new RuntimeException("CSV vacío o inválido: {$filePath}");
    }

    // Encuentra la columna 'keyword' si existe
    $kwIndex = null;
    foreach ($header as $i => $col) {
        if (mb_strtolower(trim((string)$col)) === 'keyword') { $kwIndex = $i; break; }
    }
    if ($kwIndex === null) $kwIndex = 0; // fallback a primera columna

    $seen = [];
    $kept = 0; $dropped = 0;
    while (($row = fgetcsv($fp)) !== false) {
        if (!isset($row[$kwIndex])) { $dropped++; continue; }
        $kw = (string)$row[$kwIndex];
        $kwNorm = normalizeKeyword($kw);
        if ($kwNorm === '' || hasPurchaseIntent($kwNorm)) { $dropped++; continue; }

        $dedupKey = mb_strtolower($kwNorm);
        if (isset($seen[$dedupKey])) { $dropped++; continue; }
        $seen[$dedupKey] = true;

        // Escribe la versión normalizada en la columna de keyword
        $row[$kwIndex] = $kwNorm;
        $rows[] = $row;
        $kept++;
    }
    fclose($fp);

    // Reescribe el archivo original con contenido limpio
    $out = fopen($filePath, 'w');
    if (!$out) throw new RuntimeException("No se pudo escribir: {$filePath}");
    fputcsv($out, $header);
    foreach ($rows as $r) { fputcsv($out, $r); }
    fclose($out);

    return ['kept' => $kept, 'dropped' => $dropped, 'backup' => $bakPath];
}

function main(): void {
    $dir = realpath(__DIR__ . '/../ibiza villa');
    if ($dir === false) throw new RuntimeException('Directorio "ibiza villa" no encontrado');

    $targets = [];
    $primary = $dir . DIRECTORY_SEPARATOR . 'keywords_expanded.csv';
    if (is_file($primary)) $targets[] = $primary;
    foreach (glob($dir . DIRECTORY_SEPARATOR . 'keywords_*expanded*.csv') as $path) {
        if (!in_array($path, $targets, true)) $targets[] = $path;
    }

    if (!$targets) {
        fwrite(STDERR, "No hay CSVs de fuentes para limpiar en: {$dir}\n");
        return;
    }

    $summary = [];
    foreach ($targets as $file) {
        $res = cleanCsv($file);
        $summary[] = [
            'file' => $file,
            'kept' => $res['kept'],
            'dropped' => $res['dropped'],
            'backup' => $res['backup'],
        ];
    }

    // Muestra resumen
    foreach ($summary as $s) {
        echo "[LIMPIO] {$s['file']} => kept={$s['kept']} dropped={$s['dropped']} backup={$s['backup']}\n";
    }
}

main();

?>