# 📁 Directorio /datos/

Este directorio contiene archivos CSV con **datos reales de herramientas SEO** que alimentan la auditoría.

## 🎯 Propósito

Los archivos CSV en esta carpeta son referenciados desde la página principal (`index.php`) en la sección "Recursos Descargables". Permiten al auditor y al cliente descargar los datos fuente que sustentan el análisis.

## 📂 Archivos Requeridos

### Google Search Console (GSC)
- ✅ `gsc_queries.csv` - Queries con clicks, impresiones, CTR, posición
- ✅ `gsc_pages.csv` - Páginas con métricas de rendimiento
- ✅ `gsc_devices.csv` - Métricas por dispositivo (mobile, desktop, tablet)

### Google Analytics 4 (GA4)
- ✅ `ga4_traffic.csv` - Tráfico diario: usuarios, sesiones, páginas vistas
- ✅ `ga4_conversions.csv` - Eventos de conversión y tasas
- ✅ `ga4_landing_pages.csv` - Métricas por landing page

### Ahrefs
- ✅ `ahrefs_keywords.csv` - Keywords con volumen, KD, CPC, tráfico estimado
- ✅ `ahrefs_backlinks.csv` - Backlinks con DR, anchor text, fecha
- ✅ `ahrefs_anchors.csv` - Distribución de anchor texts

### Screaming Frog
- ✅ `sf_internal_all.csv` - Crawl completo: URLs, status codes, títulos, H1s
- ✅ `sf_page_titles.csv` - Análisis de title tags (longitud, píxeles)
- ✅ `sf_meta_description.csv` - Análisis de meta descriptions

## 🔄 Cómo Reemplazar con Datos Reales

### Opción 1: Manual (Recomendado)

1. **Google Search Console**:
   - Ir a Performance → Exportar
   - Seleccionar rango de fechas (últimos 3-6 meses)
   - Exportar "Queries" → Guardar como `gsc_queries.csv`
   - Exportar "Pages" → Guardar como `gsc_pages.csv`
   - Exportar "Devices" → Guardar como `gsc_devices.csv`

2. **Google Analytics 4**:
   - Ir a Reports → Traffic Acquisition
   - Exportar datos → `ga4_traffic.csv`
   - Ir a Events → Conversions → Exportar → `ga4_conversions.csv`
   - Ir a Landing Pages → Exportar → `ga4_landing_pages.csv`

3. **Ahrefs**:
   - Site Explorer → Organic Keywords → Export → `ahrefs_keywords.csv`
   - Backlink Profile → Export → `ahrefs_backlinks.csv`
   - Anchors → Export → `ahrefs_anchors.csv`

4. **Screaming Frog**:
   - Crawl el sitio completo
   - Export → Internal → All → `sf_internal_all.csv`
   - Export → Page Titles → `sf_page_titles.csv`
   - Export → Meta Description → `sf_meta_description.csv`

### Opción 2: Automatizada (API)

```bash
# Ejemplo con Google Search Console API
# (Requiere configuración de credenciales)
python scripts/fetch_gsc_data.py --domain example.com --output datos/
```

## 📊 Formato de Datos de Ejemplo

Los archivos actuales contienen **datos de muestra** de "Ibiza Villa". Estos deben ser reemplazados con los datos reales del cliente.

### Ejemplo: gsc_queries.csv
```csv
Query,Clicks,Impressions,CTR,Position
villas lujo ibiza,145,2400,6.04%,3.2
alquiler villas ibiza,98,1850,5.30%,4.5
```

### Ejemplo: ahrefs_keywords.csv
```csv
Keyword,Volume,KD,CPC,Traffic,Position,URL
villas lujo ibiza,2400,65,€4.50,245,3.2,/villas-lujo-ibiza
```

## ⚠️ Consideraciones Importantes

### Privacidad
- **NO subir a repositorios públicos**: Estos datos son confidenciales del cliente
- El archivo `.gitignore` debe incluir `/datos/*.csv`
- Solo compartir con el equipo autorizado

### Formato
- **Encoding**: UTF-8 (para caracteres especiales españoles)
- **Separador**: Coma (`,`)
- **Headers**: Primera fila DEBE contener nombres de columnas
- **Fechas**: Formato ISO 8601 (YYYY-MM-DD)
- **Decimales**: Punto (`.`) no coma

### Validación
Antes de usar los archivos, verificar:
```bash
# Verificar que todos los archivos existen
ls -lh datos/*.csv

# Contar líneas (mínimo 2: header + 1 dato)
wc -l datos/*.csv

# Verificar encoding UTF-8
file -i datos/gsc_queries.csv
```

## 🔗 Integración con la Auditoría

Los datos en estos CSVs alimentan:
- **Dashboard principal** (index.php)
- **Módulos de análisis** (Fase 4)
- **Entregables finales** (reportes, gráficos)

Para actualizar visualizaciones después de cambiar los datos:
1. Recargar la página (Ctrl+F5)
2. Los módulos PHP procesarán automáticamente los nuevos CSVs
3. Los gráficos se regenerarán con los datos actualizados

## 📝 Mantenimiento

### Actualización Periódica
Se recomienda actualizar los datos:
- **GSC/GA4**: Mensual
- **Ahrefs**: Trimestral
- **Screaming Frog**: Al inicio de la auditoría

### Respaldo
```bash
# Crear backup antes de actualizar
cp -r datos/ datos_backup_$(date +%Y%m%d)/
```

### Limpieza
```bash
# Eliminar archivos de ejemplo cuando tengas datos reales
rm datos/*_ejemplo.csv
```

## 🆘 Troubleshooting

### Error: "Archivo no encontrado"
- Verificar que el nombre del archivo coincide EXACTAMENTE (case-sensitive)
- Verificar que la extensión es `.csv` (no `.xlsx`, `.txt`)

### Error: "Datos no se muestran"
- Verificar que el CSV tiene el header correcto
- Verificar encoding UTF-8
- Verificar que no hay líneas vacías al final

### Error: "Caracteres extraños"
- Guardar el CSV con encoding UTF-8
- En Excel: "Guardar como" → "CSV UTF-8 (delimitado por comas)"

---

**Última actualización:** 2025-10-23
**Autor:** Claude Code
**Versión:** 1.0
