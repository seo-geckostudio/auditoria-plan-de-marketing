Param(
    [string]$BaseDir = "C:\ai\investigacionauditoria programacion\ibiza villa\Documentos consolidados",
    [int]$TopN = 15
)

function Get-Column {
    Param(
        [Parameter(Mandatory)]$Data,
        [Parameter(Mandatory)][string[]]$Candidates
    )
    if (-not $Data -or $Data.Count -eq 0) { return $null }
    $cols = $Data[0].psobject.Properties.Name
    foreach ($c in $Candidates) {
        $found = $cols | Where-Object { $_ -ieq $c -or $_ -match "^$([regex]::Escape($c)).*$" }
        if ($found) { return $found[0] }
    }
    # búsqueda flexible por contiene
    foreach ($c in $Candidates) {
        $found = $cols | Where-Object { $_ -imatch $c }
        if ($found) { return $found[0] }
    }
    return $null
}

function To-Number {
    Param([string]$value)
    if ($null -eq $value -or $value -eq '') { return 0 }
    # Normalizar: quitar separadores de miles, manejar coma o punto decimal
    $v = $value -replace '[^0-9,\.-]', ''
    # Si hay coma y punto, intenta formato europeo
    if ($v -match ',') {
        # reemplazar punto de miles y coma decimal
        $v = ($v -replace '\.', '') -replace ',', '.'
    }
    try { [double]$v } catch { 0 }
}

function Build-TableMd {
    Param(
        [Parameter(Mandatory)][object[]]$Rows,
        [Parameter(Mandatory)][string[]]$Columns
    )
    if (-not $Rows -or $Rows.Count -eq 0) { return "(sin datos)" }
    $header = ($Columns -join ' | ')
    $sep = ($Columns | ForEach-Object { '---' }) -join ' | '
    $lines = foreach ($r in $Rows) {
        ($Columns | ForEach-Object { $r."$_" }) -join ' | '
    }
    return "| $header |`n| $sep |`n" + (($lines | ForEach-Object { '| ' + $_ + ' |' }) -join "`n")
}

function Append-Section {
    Param([string]$Title, [string]$Content)
    return "`n## $Title`n`n$Content`n"
}

$outFile = Join-Path $BaseDir 'informe_preliminar.md'
$content = "`n---`n## Datos calculados (auto)" + "`nGenerado: $(Get-Date -Format 'yyyy-MM-dd HH:mm')`n"

# ====================
# GA4
# ====================
try {
    $ga4Dir = Join-Path $BaseDir 'ga4'
    # Top páginas por pageviews (30 días)
    $ga4PagesFile = Join-Path $ga4Dir 'ga4_pageviews_last30.csv'
    if (Test-Path $ga4PagesFile) {
        $d = Import-Csv -Path $ga4PagesFile
        $colPage = Get-Column $d @('pagePath','Page','page','url','URL')
        $colViews = Get-Column $d @('screenPageViews','Pageviews','pageviews','views','Views')
        if ($colPage -and $colViews) {
            $rows = $d | ForEach-Object {
                [PSCustomObject]@{
                    Page = $_.$colPage
                    Views = [int](To-Number $_.$colViews)
                }
            } | Sort-Object Views -Descending | Select-Object -First $TopN
            $content += Append-Section -Title 'GA4: Top páginas por PageViews (30 días)' -Content (Build-TableMd -Rows $rows -Columns @('Page','Views'))
        }
    }
    # Por dispositivo (30 días)
    $ga4DeviceFile = Join-Path $ga4Dir 'ga4_pageviews_by_device_last30.csv'
    if (Test-Path $ga4DeviceFile) {
        $d = Import-Csv -Path $ga4DeviceFile
        $colDevice = Get-Column $d @('deviceCategory','device','Device')
        $colViews = Get-Column $d @('screenPageViews','Pageviews','pageviews','views','Views')
        if ($colDevice -and $colViews) {
            $rows = $d | Group-Object -Property $colDevice | ForEach-Object {
                $sum = ($_.Group | ForEach-Object { To-Number $_.$colViews } | Measure-Object -Sum).Sum
                [PSCustomObject]@{ Device=$_.Name; Views=[int]$sum }
            } | Sort-Object Views -Descending
            $content += Append-Section -Title 'GA4: Distribución por dispositivo (30 días)' -Content (Build-TableMd -Rows $rows -Columns @('Device','Views'))
        }
    }
    # Por país (30 días)
    $ga4CountryFile = Join-Path $ga4Dir 'ga4_pageviews_by_country_last30.csv'
    if (Test-Path $ga4CountryFile) {
        $d = Import-Csv -Path $ga4CountryFile
        $colCountry = Get-Column $d @('country','Country','país','Pais')
        $colViews = Get-Column $d @('screenPageViews','Pageviews','pageviews','views','Views')
        if ($colCountry -and $colViews) {
            $rows = $d | Group-Object -Property $colCountry | ForEach-Object {
                $sum = ($_.Group | ForEach-Object { To-Number $_.$colViews } | Measure-Object -Sum).Sum
                [PSCustomObject]@{ Country=$_.Name; Views=[int]$sum }
            } | Sort-Object Views -Descending | Select-Object -First 10
            $content += Append-Section -Title 'GA4: Top países por PageViews (30 días)' -Content (Build-TableMd -Rows $rows -Columns @('Country','Views'))
        }
    }
} catch {
    $content += Append-Section -Title 'GA4' -Content "Error procesando GA4: $($_.Exception.Message)"
}

# ====================
# GSC
# ====================
try {
    $gscDir = Join-Path $BaseDir 'gsc'
    # Páginas (30 días)
    $gscPagesFile = Join-Path $gscDir 'gsc_pages_last30.csv'
    if (Test-Path $gscPagesFile) {
        $d = Import-Csv -Path $gscPagesFile
        $colPage = Get-Column $d @('page','Page','url','URL')
        $colClicks = Get-Column $d @('clicks','Clicks')
        $colImpr = Get-Column $d @('impressions','Impressions')
        $colCtr = Get-Column $d @('ctr','CTR')
        $colPos = Get-Column $d @('position','Position')
        if ($colPage -and $colClicks -and $colImpr) {
            $rows = $d | ForEach-Object {
                [PSCustomObject]@{
                    Page = $_.$colPage
                    Clicks = [int](To-Number $_.$colClicks)
                    Impressions = [int](To-Number $_.$colImpr)
                    CTR = if ($colCtr) { '{0:P2}' -f ((To-Number $_.$colCtr)/100) } else { '' }
                    Position = if ($colPos) { '{0:N2}' -f (To-Number $_.$colPos) } else { '' }
                }
            } | Sort-Object Clicks -Descending | Select-Object -First $TopN
            $content += Append-Section -Title 'GSC: Top páginas por clics (30 días)' -Content (Build-TableMd -Rows $rows -Columns @('Page','Clicks','Impressions','CTR','Position'))
        }
    }
    # Consultas (30 días)
    $gscQueriesFile = Join-Path $gscDir 'gsc_queries_last30.csv'
    if (Test-Path $gscQueriesFile) {
        $d = Import-Csv -Path $gscQueriesFile
        $colQuery = Get-Column $d @('query','Query','keyword','Keyword')
        $colClicks = Get-Column $d @('clicks','Clicks')
        $colImpr = Get-Column $d @('impressions','Impressions')
        $colCtr = Get-Column $d @('ctr','CTR')
        $colPos = Get-Column $d @('position','Position')
        if ($colQuery -and $colClicks -and $colImpr) {
            $rows = $d | ForEach-Object {
                [PSCustomObject]@{
                    Query = $_.$colQuery
                    Clicks = [int](To-Number $_.$colClicks)
                    Impressions = [int](To-Number $_.$colImpr)
                    CTR = if ($colCtr) { '{0:P2}' -f ((To-Number $_.$colCtr)/100) } else { '' }
                    Position = if ($colPos) { '{0:N2}' -f (To-Number $_.$colPos) } else { '' }
                }
            } | Sort-Object Clicks -Descending | Select-Object -First $TopN
            $content += Append-Section -Title 'GSC: Top consultas por clics (30 días)' -Content (Build-TableMd -Rows $rows -Columns @('Query','Clicks','Impressions','CTR','Position'))
        }
    }
} catch {
    $content += Append-Section -Title 'GSC' -Content "Error procesando GSC: $($_.Exception.Message)"
}

# ====================
# Ahrefs
# ====================
try {
    $ahrefsDir = Join-Path $BaseDir 'ahrefs'
    # Top pages por tráfico
    $tp = Join-Path $ahrefsDir 'top_pages.csv'
    if (Test-Path $tp) {
        $d = Import-Csv -Path $tp
        $colUrl = Get-Column $d @('url','URL','page','Page')
        $colTraffic = Get-Column $d @('traffic','Traffic','organic_traffic','Organic traffic')
        if ($colUrl -and $colTraffic) {
            $rows = $d | ForEach-Object {
                [PSCustomObject]@{ URL = $_.$colUrl; Traffic = [int](To-Number $_.$colTraffic) }
            } | Sort-Object Traffic -Descending | Select-Object -First $TopN
            $content += Append-Section -Title 'Ahrefs: Top pages por tráfico orgánico' -Content (Build-TableMd -Rows $rows -Columns @('URL','Traffic'))
        }
    }
    # Organic keywords principales
    $ok = Join-Path $ahrefsDir 'organic_keywords.csv'
    if (Test-Path $ok) {
        $d = Import-Csv -Path $ok
        $colKw = Get-Column $d @('keyword','Keyword')
        $colTraffic = Get-Column $d @('traffic','Traffic')
        $colPos = Get-Column $d @('position','Position')
        $colUrl = Get-Column $d @('url','URL','page','Page')
        if ($colKw -and $colTraffic) {
            $rows = $d | ForEach-Object {
                [PSCustomObject]@{
                    Keyword = $_.$colKw
                    Position = if ($colPos) { '{0:N1}' -f (To-Number $_.$colPos) } else { '' }
                    Traffic = [int](To-Number $_.$colTraffic)
                    URL = if ($colUrl) { $_.$colUrl } else { '' }
                }
            } | Sort-Object Traffic -Descending | Select-Object -First $TopN
            $content += Append-Section -Title 'Ahrefs: Keywords orgánicas principales' -Content (Build-TableMd -Rows $rows -Columns @('Keyword','Position','Traffic','URL'))
        }
    }
    # Referring domains top
    $rd = Join-Path $ahrefsDir 'referring_domains.csv'
    if (Test-Path $rd) {
        $d = Import-Csv -Path $rd
        $colDomain = Get-Column $d @('domain','Domain')
        $colDr = Get-Column $d @('dr','DR','domain_rating')
        $colLinks = Get-Column $d @('backlinks','Backlinks')
        $rows = $d | ForEach-Object {
            [PSCustomObject]@{
                Domain = if ($colDomain) { $_.$colDomain } else { '' }
                DR = if ($colDr) { '{0:N0}' -f (To-Number $_.$colDr) } else { '' }
                Backlinks = if ($colLinks) { [int](To-Number $_.$colLinks) } else { 0 }
            }
        } | Sort-Object Backlinks -Descending | Select-Object -First 10
        if ($rows.Count -gt 0) {
            $content += Append-Section -Title 'Ahrefs: Referring domains (top 10 por backlinks)' -Content (Build-TableMd -Rows $rows -Columns @('Domain','DR','Backlinks'))
        }
    }
    # Anchors más frecuentes
    $an = Join-Path $ahrefsDir 'anchors.csv'
    if (Test-Path $an) {
        $d = Import-Csv -Path $an
        $colAnchor = Get-Column $d @('anchor','Anchor')
        $colLinks = Get-Column $d @('backlinks','Backlinks')
        if ($colAnchor -and $colLinks) {
            $rows = $d | ForEach-Object { [PSCustomObject]@{ Anchor = $_.$colAnchor; Backlinks = [int](To-Number $_.$colLinks) } } |
                Sort-Object Backlinks -Descending | Select-Object -First 15
            $content += Append-Section -Title 'Ahrefs: Anclas más frecuentes' -Content (Build-TableMd -Rows $rows -Columns @('Anchor','Backlinks'))
        }
    }
} catch {
    $content += Append-Section -Title 'Ahrefs' -Content "Error procesando Ahrefs: $($_.Exception.Message)"
}

# ====================
# Redirects
# ====================
try {
    $redirFile = Join-Path (Join-Path $BaseDir 'redirects') 'redirects.csv'
    if (Test-Path $redirFile) {
        $d = Import-Csv -Path $redirFile
        $colType = Get-Column $d @('type','Type')
        $invalid = 0
        $sum301 = 0; $sum302 = 0
        foreach ($r in $d) {
            $t = if ($colType) { ($r.$colType -as [string]).Trim() } else { '' }
            switch ($t) {
                '301' { $sum301++ }
                '302' { $sum302++ }
                default { $invalid++ }
            }
        }
        $rows = @(
            [PSCustomObject]@{ Tipo='301'; Conteo=$sum301 },
            [PSCustomObject]@{ Tipo='302'; Conteo=$sum302 },
            [PSCustomObject]@{ Tipo='inválidos'; Conteo=$invalid }
        )
        $content += Append-Section -Title 'Redirects: resumen por tipo' -Content (Build-TableMd -Rows $rows -Columns @('Tipo','Conteo'))
    }
} catch {
    $content += Append-Section -Title 'Redirects' -Content "Error procesando redirects: $($_.Exception.Message)"
}

# ====================
# Logs (conteo básico de errores comunes)
# ====================
try {
    $logsAccess = Join-Path (Join-Path $BaseDir 'logs') 'access'
    $logsError = Join-Path (Join-Path $BaseDir 'logs') 'error'
    $codes = @(404,403,500,502)
    $rows = @()
    foreach ($c in $codes) {
        $pat = "\s$c\s"
        $count = 0
        if (Test-Path $logsAccess) {
            $count += (Get-ChildItem -Path $logsAccess -File -ErrorAction SilentlyContinue | ForEach-Object { (Select-String -Path $_.FullName -Pattern $pat -AllMatches -ErrorAction SilentlyContinue).Matches.Count } | Measure-Object -Sum).Sum
        }
        if (Test-Path $logsError) {
            $count += (Get-ChildItem -Path $logsError -File -ErrorAction SilentlyContinue | ForEach-Object { (Select-String -Path $_.FullName -Pattern $pat -AllMatches -ErrorAction SilentlyContinue).Matches.Count } | Measure-Object -Sum).Sum
        }
        $rows += [PSCustomObject]@{ Codigo=$c; Ocurrencias=[int]($count) }
    }
    if ($rows.Count -gt 0) {
        $content += Append-Section -Title 'Logs: errores frecuentes (últimos archivos)' -Content (Build-TableMd -Rows $rows -Columns @('Codigo','Ocurrencias'))
    }
} catch {
    $content += Append-Section -Title 'Logs' -Content "Error procesando logs: $($_.Exception.Message)"
}

# Escribir salida
try {
    Add-Content -Path $outFile -Value $content -Encoding UTF8
    Write-Output "Informe actualizado: $outFile"
} catch {
    Write-Output "Error escribiendo informe: $($_.Exception.Message)"
    exit 1
}