Param()

$ErrorActionPreference = 'Stop'

# Ubicaciones base
$scriptDir = $PSScriptRoot
$projectRoot = Split-Path $scriptDir -Parent
$configDir = Join-Path $projectRoot 'scripts'
$configPath = Join-Path $configDir 'documentos_auditoria_config.json'

if (-not (Test-Path $configPath)) {
  Write-Error "No se encuentra la configuración: $configPath"
}

# Cargar configuración
$cfgJson = Get-Content -Path $configPath -Raw -Encoding UTF8
$cfg = $cfgJson | ConvertFrom-Json

$clienteRel = $cfg.cliente_folder_relative
$clienteBase = Join-Path $projectRoot $clienteRel
if (-not (Test-Path $clienteBase)) {
  New-Item -ItemType Directory -Force -Path $clienteBase | Out-Null
}

$outputPath = Join-Path $clienteBase 'LISTA_DOCUMENTOS_AUDITORIA.md'

# Generar contenido
$lines = @()
$lines += "# Lista de documentos de auditoría"
$lines += "Generado: $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
$lines += ""
$lines += "Instrucciones: Añade nuevos documentos en 'scripts/documentos_auditoria_config.json'. Este listado se actualiza automáticamente marcando el checkbox cuando el archivo existe."
$lines += ""

foreach ($doc in $cfg.documentos) {
  $fullPattern = Join-Path $projectRoot $doc.ruta_relativa

  $exists = $false
  if ($fullPattern -match '[\*\?]') {
    $items = Get-ChildItem -Path $fullPattern -ErrorAction SilentlyContinue
    $exists = ($items -ne $null -and $items.Count -gt 0)
  } else {
    $exists = Test-Path $fullPattern
  }

  $checkbox = if ($exists) { 'x' } else { ' ' }
  $reqLabel = if ($doc.requerido) { '(requerido)' } else { '(opcional)' }

  $displayPath = $doc.ruta_relativa
  # Componer línea con formato para evitar problemas de cadena
  $lines += ("- [{0}] {1} - {2} {3}" -f $checkbox, $doc.nombre, $displayPath, $reqLabel)
}

# Guardar
Set-Content -Path $outputPath -Value ($lines -join "`n") -Encoding UTF8
Write-Output "Checklist generado en: $outputPath"