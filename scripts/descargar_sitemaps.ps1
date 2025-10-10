Param(
    [string]$SiteUrl = "https://www.ibizavilla.com",
    [string]$OutputDir = (Join-Path $PSScriptRoot "..\ibiza villa\Documentos consolidados\sitemaps"),
    [string]$RobotsOut = (Join-Path $PSScriptRoot "..\ibiza villa\Documentos consolidados\robots.txt")
)

Write-Host "Descargando sitemaps para: $SiteUrl"

# Asegurar carpeta destino
New-Item -ItemType Directory -Force -Path $OutputDir | Out-Null

# Descargar robots.txt
$robotsUrl = ($SiteUrl.TrimEnd('/') + "/robots.txt")
try {
    Invoke-WebRequest -Uri $robotsUrl -OutFile $RobotsOut -UseBasicParsing -ErrorAction Stop
    Write-Host "Descargado robots.txt en $RobotsOut"
} catch {
    Write-Host ("No se pudo descargar robots.txt: " + $_.Exception.Message)
}

# Extraer URLs de sitemap desde robots.txt
$sitemapUrls = @()
if (Test-Path $RobotsOut) {
    try {
        $robotsContent = Get-Content -Path $RobotsOut -ErrorAction Stop
        foreach ($line in $robotsContent) {
            if ($line -match '(?i)^\s*Sitemap:\s*(\S+)') {
                $sitemapUrls += $Matches[1]
            }
        }
    } catch {}
}

# Añadir endpoints comunes
$commonEndpoints = @(
    ($SiteUrl.TrimEnd('/') + "/sitemap.xml"),
    ($SiteUrl.TrimEnd('/') + "/sitemap_index.xml"),
    ($SiteUrl.TrimEnd('/') + "/sitemapindex.xml"),
    ($SiteUrl.TrimEnd('/') + "/sitemap.xml.gz"),
    ($SiteUrl.TrimEnd('/') + "/sitemap_index.xml.gz")
)

$sitemapUrls = ($sitemapUrls + $commonEndpoints) | Sort-Object -Unique

function Expand-GzipFile {
    Param(
        [string]$gzipPath,
        [string]$outXmlPath
    )
    try {
        $inStream = [System.IO.File]::OpenRead($gzipPath)
        $gzip = New-Object System.IO.Compression.GZipStream($inStream, [System.IO.Compression.CompressionMode]::Decompress)
        $outStream = [System.IO.File]::Create($outXmlPath)
        $buffer = New-Object byte[] 4096
        while (($read = $gzip.Read($buffer, 0, $buffer.Length)) -gt 0) {
            $outStream.Write($buffer, 0, $read)
        }
        $gzip.Dispose()
        $inStream.Dispose()
        $outStream.Dispose()
        Write-Host "Descomprimido: $gzipPath -> $outXmlPath"
    } catch {
        Write-Host ("Error al descomprimir ${gzipPath}: " + $_.Exception.Message)
    }
}

function Download-SitemapUrl {
    Param(
        [string]$url,
        [string]$outDir
    )
    try {
        $uri = [System.Uri]$url
        $fileName = [System.IO.Path]::GetFileName($uri.AbsolutePath)
        if ([string]::IsNullOrWhiteSpace($fileName)) { $fileName = "sitemap.xml" }
        $destPath = Join-Path $outDir $fileName
        Invoke-WebRequest -Uri $url -OutFile $destPath -UseBasicParsing -ErrorAction Stop
        Write-Host "Descargado: $url -> $destPath"

        $savedFiles = @($destPath)
        if ($destPath.ToLower().EndsWith('.xml.gz')) {
            $outXml = ($destPath -replace '\.gz$', '')
            Expand-GzipFile -gzipPath $destPath -outXmlPath $outXml
            $savedFiles += $outXml
        }

        foreach ($file in $savedFiles) {
            if ($file.ToLower().EndsWith('.xml')) {
                try {
                    $xmlContent = Get-Content -Path $file -Raw -ErrorAction Stop
                    if ($xmlContent -match '<sitemapindex') {
                        $locs = Select-String -InputObject $xmlContent -Pattern '<loc>(.*?)</loc>' -AllMatches | ForEach-Object { $_.Matches } | ForEach-Object { $_.Groups[1].Value }
                        foreach ($loc in $locs) {
                            if ($loc) { Download-SitemapUrl -url $loc -outDir $outDir }
                        }
                    }
                } catch {}
            }
        }
    } catch {
        Write-Host ("No disponible: " + $url + " (" + $_.Exception.Message + ")")
    }
}

foreach ($s in $sitemapUrls) {
    Download-SitemapUrl -url $s -outDir $OutputDir
}

Write-Host "Sitemaps descargados en $OutputDir"