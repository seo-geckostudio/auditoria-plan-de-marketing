# Script PowerShell para generar informe preliminar de auditoría SEO
# Autor: Sistema de Auditorías SEO
# Fecha: 2025-10-06

param(
    [string]$RutaDocumentos = "ibiza villa\Documentos consolidados",
    [string]$ArchivoSalida = "informe_preliminar_completo.md"
)

Write-Host " Generando informe preliminar de auditoría SEO..." -ForegroundColor Green

# Función para leer CSV y generar tabla markdown
function ConvertirCSVaTablaMarkdown {
    param(
        [string]$RutaCSV,
        [int]$MaxFilas = 10,
        [string]$Titulo = ""
    )
    
    if (-not (Test-Path $RutaCSV)) {
        return " Archivo no encontrado: $RutaCSV`n"
    }
    
    try {
        $datos = Import-Csv $RutaCSV -Encoding UTF8
        if ($datos.Count -eq 0) {
            return " Archivo CSV vacío: $RutaCSV`n"
        }
        
        $resultado = ""
        if ($Titulo) {
            $resultado += "#### $Titulo`n`n"
        }
        
        # Obtener las primeras filas
        $filasMostrar = $datos | Select-Object -First $MaxFilas
        
        # Crear cabeceras
        $propiedades = $filasMostrar[0].PSObject.Properties.Name
        $cabeceras = "| " + ($propiedades -join " | ") + " |`n"
        $separador = "| " + ($propiedades | ForEach-Object { "---" }) -join " | " + " |`n"
        
        $resultado += $cabeceras + $separador
        
        # Agregar filas de datos
        foreach ($fila in $filasMostrar) {
            $valores = @()
            foreach ($prop in $propiedades) {
                $valor = $fila.$prop
                if ($valor -eq $null) { $valor = "" }
                $valores += $valor.ToString().Replace("|", "\\|")
            }
            $resultado += "| " + ($valores -join " | ") + " |`n"
        }
        
        if ($datos.Count -gt $MaxFilas) {
            $resultado += "`n*Mostrando $MaxFilas de $($datos.Count) filas totales*`n"
        }
        
        return $resultado + "`n"
    }
    catch {
        return " Error procesando CSV $RutaCSV`: $($_.Exception.Message)`n"
    }
}

# Función para obtener estadísticas básicas de un CSV
function ObtenerEstadisticasCSV {
    param([string]$RutaCSV)
    
    if (-not (Test-Path $RutaCSV)) {
        return "Archivo no encontrado"
    }
    
    try {
        $datos = Import-Csv $RutaCSV -Encoding UTF8
        return "$($datos.Count) filas"
    }
    catch {
        return "Error al leer archivo"
    }
}

# Inicializar contenido del informe
$contenido = @"
# Informe Preliminar de Auditoría SEO  Ibiza Villa
**Generado:** $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")

Este informe consolida automáticamente los datos extraídos de las principales fuentes de análisis SEO.

##  Resumen Ejecutivo

### Estado de Datos Extraídos
"@

# Verificar archivos principales
$archivosVerificar = @{
    "GA4 PageViews (30 días)" = "$RutaDocumentos\ga4\ga4_pageviews_last30.csv"
    "GA4 por Dispositivo (30 días)" = "$RutaDocumentos\ga4\ga4_pageviews_by_device_last30.csv"
    "GA4 por País (30 días)" = "$RutaDocumentos\ga4\ga4_pageviews_by_country_last30.csv"
    "GSC Páginas (30 días)" = "$RutaDocumentos\gsc\gsc_pages_last30.csv"
    "GSC Consultas (30 días)" = "$RutaDocumentos\gsc\gsc_queries_last30.csv"
    "Ahrefs Top Pages" = "$RutaDocumentos\ahrefs\top_pages.csv"
    "Ahrefs Keywords Orgánicas" = "$RutaDocumentos\ahrefs\organic_keywords.csv"
    "Ahrefs Backlinks" = "$RutaDocumentos\ahrefs\backlinks.csv"
    "Redirects" = "$RutaDocumentos\redirects\redirects.csv"
}

$contenido += "`n| Fuente de Datos | Estado | Registros |`n"
$contenido += "| --- | --- | --- |`n"

foreach ($archivo in $archivosVerificar.GetEnumerator()) {
    $estado = if (Test-Path $archivo.Value) { " Disponible" } else { " Faltante" }
    $registros = if (Test-Path $archivo.Value) { ObtenerEstadisticasCSV $archivo.Value } else { "N/A" }
    $contenido += "| $($archivo.Key) | $estado | $registros |`n"
}

# Sección 1: Análisis de Tráfico (GA4)
$contenido += @"

## 1.  Análisis de Tráfico (Google Analytics 4)

### 1.1 Top Páginas por Tráfico (Últimos 30 días)
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\ga4\ga4_pageviews_last30.csv" -MaxFilas 15

$contenido += @"
### 1.2 Distribución por Dispositivo
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\ga4\ga4_pageviews_by_device_last30.csv" -MaxFilas 5

$contenido += @"
### 1.3 Distribución por País
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\ga4\ga4_pageviews_by_country_last30.csv" -MaxFilas 10

# Sección 2: Visibilidad en Búsqueda (GSC)
$contenido += @"

## 2.  Visibilidad en Búsqueda (Google Search Console)

### 2.1 Top Páginas por Clics (Últimos 30 días)
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\gsc\gsc_pages_last30.csv" -MaxFilas 15

$contenido += @"
### 2.2 Top Consultas de Búsqueda (Últimos 30 días)
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\gsc\gsc_queries_last30.csv" -MaxFilas 15

# Sección 3: Autoridad y Backlinks (Ahrefs)
$contenido += @"

## 3.  Autoridad y Backlinks (Ahrefs)

### 3.1 Top Páginas por Tráfico Orgánico
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\ahrefs\top_pages.csv" -MaxFilas 10

$contenido += @"
### 3.2 Keywords Orgánicas Principales
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\ahrefs\organic_keywords.csv" -MaxFilas 15

# Sección 4: Aspectos Técnicos
$contenido += @"

## 4.  Aspectos Técnicos

### 4.1 Redirects Identificados
"@

$contenido += ConvertirCSVaTablaMarkdown -RutaCSV "$RutaDocumentos\redirects\redirects.csv" -MaxFilas 10

# Sección 5: Próximos Pasos
$contenido += @"

## 5.  Próximos Pasos y Recomendaciones Preliminares

### Análisis Pendientes
- [ ] Análisis detallado de Core Web Vitals
- [ ] Auditoría completa de contenido duplicado
- [ ] Revisión de estructura de enlaces internos
- [ ] Análisis de competencia directa
- [ ] Optimización de meta descripciones y títulos

### Oportunidades Identificadas
- **Tráfico móvil**: Revisar experiencia en dispositivos móviles
- **Posicionamiento internacional**: Optimizar para mercados principales
- **Redirects**: Revisar y optimizar cadenas de redirección
- **Keywords**: Expandir contenido para términos de alto volumen

---

*Informe generado automáticamente por el Sistema de Auditorías SEO*  
*Próxima actualización: Análisis técnico completo con Screaming Frog*
"@

# Guardar el informe
try {
    $contenido | Out-File -FilePath $ArchivoSalida -Encoding UTF8
    Write-Host " Informe generado exitosamente: $ArchivoSalida" -ForegroundColor Green
    Write-Host " Archivo guardado en: $(Resolve-Path $ArchivoSalida)" -ForegroundColor Cyan
}
catch {
    Write-Host " Error al guardar el informe: $($_.Exception.Message)" -ForegroundColor Red
    exit 1
}

Write-Host "`n Proceso completado. El informe preliminar está listo para revisión." -ForegroundColor Green