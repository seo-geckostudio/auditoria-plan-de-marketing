# 🤖 Sistema de Generación Automática de CSVs Entregables

## 🎯 Problema Resuelto

**Antes**: El auditor tenía que generar manualmente cada CSV para cada auditoría, lo cual era:
- ❌ Tedioso y propenso a errores
- ❌ Inconsistente entre auditorías
- ❌ Imposible de escalar

**Ahora**: El sistema genera automáticamente los CSVs desde los datos reales de cada auditoría:
- ✅ Completamente automatizado
- ✅ Consistente y basado en datos reales
- ✅ Escalable a cientos de auditorías

---

## 🏗️ Arquitectura del Sistema

```
┌─────────────────────────────────────────────────────────────┐
│                    FLUJO DE GENERACIÓN                       │
└─────────────────────────────────────────────────────────────┘

1. Usuario visita módulo de auditoría
   ↓
2. JavaScript detecta botones de descarga con [data-entregable-tipo]
   ↓
3. Para cada botón, llama a: /api/generar_entregable.php
   ↓
4. API verifica si CSV ya existe (caché < 24h)
   ├─ SI: Retorna CSV existente
   └─ NO: Continúa...
   ↓
5. API carga datos de Screaming Frog para esa auditoría
   ↓
6. EntregablesGenerator.php procesa los datos:
   - Filtra según criterios (ej: URLs huérfanas = inlinks == 0)
   - Calcula prioridades basadas en tráfico
   - Genera acciones recomendadas
   - Ordena por prioridad e impacto
   ↓
7. Genera CSV en: /entregables/auditoria_{id}/{categoria}/{tipo}.csv
   ↓
8. Retorna JSON con:
   {
     "success": true,
     "file_url": "/entregables/...",
     "count": 127,
     "cached": false
   }
   ↓
9. JavaScript actualiza botón con URL correcta
   ↓
10. Usuario hace clic y descarga CSV con datos reales
```

---

## 📁 Componentes del Sistema

### 1. **EntregablesGenerator.php** (Clase PHP)

**Ubicación**: `includes/EntregablesGenerator.php`

**Responsabilidades**:
- Crear estructura de directorios por auditoría
- Filtrar y procesar datos de Screaming Frog
- Calcular prioridades automáticamente
- Generar acciones recomendadas contextuales
- Escribir CSVs con codificación UTF-8 BOM (para Excel)

**Métodos principales**:

```php
// Generar CSVs individuales
$generator = new EntregablesGenerator($auditoriaId);

$generator->generarURLsHuerfanas($datosScreamingFrog);
$generator->generarURLsProfundas($datosScreamingFrog);
$generator->generarPaginasSinH1($datosScreamingFrog);
$generator->generarImagenesSinAlt($datosScreamingFrog);
$generator->generarOportunidadesKeywords($datosAhrefs, $datosGSC);

// Generar todos los CSVs de una categoría
$generator->generarTodosArquitectura($datosScreamingFrog);
$generator->generarTodosOnPage($datosScreamingFrog);
```

**Lógica de Priorización**:

```php
private function calcularPrioridad($url) {
    $trafico = $url['ga_sessions'] ?? 0;

    if ($trafico > 500) return 'Crítica';      // Muy alto tráfico
    if ($trafico > 200) return 'Muy Alta';     // Alto tráfico
    if ($trafico > 50) return 'Alta';          // Tráfico medio
    if ($trafico > 10) return 'Media';         // Tráfico bajo
    return 'Baja';                              // Sin tráfico
}
```

**Generación de Acciones Contextuales**:

```php
private function generarAccionURLHuerfana($url) {
    $path = parse_url($url['address'], PHP_URL_PATH);

    if (strpos($path, '/blog/') !== false) {
        return 'Añadir en sidebar de artículos relacionados';
    }
    if (strpos($path, '/villa') !== false) {
        return 'Añadir en listado de villas disponibles';
    }

    return 'Enlazar desde página relevante de categoría superior';
}
```

---

### 2. **API Endpoint** (`api/generar_entregable.php`)

**Parámetros**:
- `auditoria_id` (int, requerido): ID de la auditoría
- `tipo` (string, requerido): Tipo de CSV (`urls_huerfanas`, `paginas_sin_h1`, etc)
- `categoria` (string, opcional): Categoría (`arquitectura`, `keywords`, `on_page`)
- `force` (bool, opcional): Forzar regeneración ignorando caché

**Respuesta exitosa**:
```json
{
  "success": true,
  "file_url": "/entregables/auditoria_1/arquitectura/urls_huerfanas.csv",
  "file_name": "urls_huerfanas.csv",
  "count": 127,
  "message": "CSV generado exitosamente",
  "cached": false,
  "cache_age_hours": null
}
```

**Respuesta con caché**:
```json
{
  "success": true,
  "file_url": "/entregables/auditoria_1/arquitectura/urls_huerfanas.csv",
  "file_name": "urls_huerfanas.csv",
  "count": 127,
  "message": "CSV cargado desde caché",
  "cached": true,
  "cache_age_hours": 3.5
}
```

**Caché inteligente**:
- CSVs se cachean por 24 horas
- Si existe y es < 24h, se sirve desde caché (super rápido)
- Si existe y es > 24h, se regenera (datos actualizados)
- Parámetro `force=1` invalida caché y regenera

---

### 3. **Cliente JavaScript** (`js/entregables-generator.js`)

**Características**:
- Auto-detecta auditoriaId desde el contexto de la página
- Auto-detecta categoría desde el módulo actual
- Busca botones con atributo `data-entregable-tipo`
- Genera CSVs en paralelo al cargar la página
- Actualiza botones con URLs correctas
- Muestra indicadores de carga/éxito/error

**Uso en módulos**:

```html
<!-- El botón debe tener estos atributos data-* -->
<a href="#"
   class="btn-download"
   data-entregable-tipo="urls_huerfanas"
   data-entregable-categoria="arquitectura"
   download>
    <i class="fas fa-download"></i> Descargar CSV
</a>

<!-- JavaScript detectará este botón y generará el CSV automáticamente -->
```

**Auto-inicialización**:
```javascript
// El script se auto-inicializa al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const auditoriaId = detectarAuditoriaId();
    const categoria = detectarCategoria();

    const generator = new EntregablesGenerator(auditoriaId, categoria);
    generator.init(); // Genera todos los CSVs automáticamente
});
```

---

## 📊 Estructura de Datos

### Entrada: Datos de Screaming Frog

Los datos de Screaming Frog deben estar en formato JSON:

**Ubicación**: `data/screamingfrog/auditoria_{id}.json`

**Estructura esperada**:
```json
{
  "internal": [
    {
      "address": "https://example.com/villa-sunset/",
      "status_code": 200,
      "indexability": "Indexable",
      "inlinks": 0,
      "crawl_depth": 5,
      "ga_sessions": 342,
      "h1_1": "Villa Sunset",
      "title": "Villa Sunset - Alquiler Villas Ibiza",
      "content_type": "text/html"
    }
  ],
  "images": [
    {
      "source": "https://example.com/villa-sunset/",
      "destination": "https://example.com/images/villa-sunset-hero.jpg",
      "alt_text": "",
      "path_type": "Internal"
    }
  ]
}
```

### Salida: CSV Generado

**Ejemplo**: `urls_huerfanas_corregir.csv`

```csv
URL,Profundidad_Actual,Trafico_Mensual,Prioridad,Pagina_Desde_Enlazar,Accion_Recomendada
/villa-sunset-deluxe/,5,342,Alta,/villas/san-antonio/,Añadir en listado de villas disponibles
/blog/mejores-playas-ibiza/,0,523,Muy Alta,/blog/ y /,Enlazar desde home + sidebar blog
```

---

## 🔄 Flujo de Actualización de Datos

### Cuando se actualiza Screaming Frog

1. Auditor exporta nuevos datos de Screaming Frog
2. Sube JSON a: `data/screamingfrog/auditoria_{id}.json`
3. CSVs se regeneran automáticamente después de 24h
4. O forzar regeneración: `/api/generar_entregable.php?auditoria_id=1&tipo=urls_huerfanas&force=1`

### Invalidar caché manualmente

```javascript
// Desde consola del navegador
await entregablesGenerator.generarCSV('urls_huerfanas', 'arquitectura', button);
```

O llamando a la API con `force=1`:
```bash
curl "http://localhost:8000/api/generar_entregable.php?auditoria_id=1&tipo=urls_huerfanas&force=1"
```

---

## 🎨 Integración en Módulos

### Paso 1: Añadir script en el header

En `index.php` o en el módulo específico:

```php
<!-- Añadir antes de </body> -->
<script src="/js/entregables-generator.js"></script>

<!-- Pasar auditoriaId al contexto -->
<body data-auditoria-id="<?php echo $auditoriaId; ?>"
      data-modulo="fase3_arquitectura">
```

### Paso 2: Usar atributos data-* en botones

```html
<a href="#"
   class="btn-download"
   data-entregable-tipo="urls_huerfanas"
   data-entregable-categoria="arquitectura"
   download>
    <i class="fas fa-download"></i> Descargar CSV
</a>
```

### Paso 3: (Opcional) Añadir contador de elementos

```html
<div class="entregable-card">
    <h3>URLs Huérfanas</h3>
    <p class="entregable-desc">
        <strong class="entregable-count">...</strong> páginas sin enlaces
    </p>
    <a href="#"
       class="btn-download"
       data-entregable-tipo="urls_huerfanas"
       data-entregable-categoria="arquitectura">
        Descargar CSV
    </a>
</div>
```

El JavaScript actualizará automáticamente `.entregable-count` con el número real de elementos.

---

## 🧪 Testing del Sistema

### Test 1: Generación Manual (PHP)

```php
<?php
require_once 'includes/EntregablesGenerator.php';

$datosScreamingFrog = json_decode(file_get_contents('data/screamingfrog/auditoria_1.json'), true);

$generator = new EntregablesGenerator(1);
$resultado = $generator->generarURLsHuerfanas($datosScreamingFrog);

print_r($resultado);
// Expected:
// Array (
//   [success] => 1
//   [file_url] => /entregables/auditoria_1/arquitectura/urls_huerfanas_corregir.csv
//   [count] => 127
// )
?>
```

### Test 2: API Endpoint

```bash
# Test generación
curl "http://localhost:8000/api/generar_entregable.php?auditoria_id=1&tipo=urls_huerfanas&categoria=arquitectura"

# Test caché
curl "http://localhost:8000/api/generar_entregable.php?auditoria_id=1&tipo=urls_huerfanas"

# Test forzar regeneración
curl "http://localhost:8000/api/generar_entregable.php?auditoria_id=1&tipo=urls_huerfanas&force=1"
```

### Test 3: Integración JavaScript

```javascript
// En consola del navegador
const generator = new EntregablesGenerator(1, 'arquitectura');
await generator.generarCSV('urls_huerfanas', 'arquitectura', document.querySelector('[data-entregable-tipo="urls_huerfanas"]'));

// Verificar resultados
console.log(generator.results);
```

---

## 📈 Ventajas del Sistema

### Para el Auditor

✅ **Cero trabajo manual**: Los CSVs se generan automáticamente
✅ **Siempre actualizados**: Se regeneran cuando hay nuevos datos
✅ **Consistentes**: Misma lógica para todas las auditorías
✅ **Escalables**: Funciona para 1 o 1000 auditorías

### Para el Cliente

✅ **Datos reales**: CSVs con sus URLs reales, no ejemplos
✅ **Priorizados**: Ordenados por impacto en su negocio
✅ **Accionables**: Cada fila tiene acción específica
✅ **Descarga instantánea**: Botón funciona al instante

### Para el Sistema

✅ **Caché inteligente**: No regenera innecesariamente
✅ **Performante**: Caché hace las descargas instantáneas
✅ **Extensible**: Fácil añadir nuevos tipos de CSVs
✅ **Mantenible**: Lógica centralizada en una clase

---

## 🔧 Añadir Nuevo Tipo de CSV

### Paso 1: Añadir método al generador

```php
// En EntregablesGenerator.php

public function generarMetaDescriptionsSinOptimizar($datosScreamingFrog) {
    $sinOptimizar = array_filter($datosScreamingFrog['internal'] ?? [], function($url) {
        $metaDesc = $url['meta_description_1'] ?? '';
        return strlen($metaDesc) < 120 || strlen($metaDesc) > 160;
    });

    $csvData = [];
    foreach ($sinOptimizar as $url) {
        $csvData[] = [
            'URL' => $url['address'],
            'Meta_Description_Actual' => $url['meta_description_1'] ?? '',
            'Longitud_Actual' => strlen($url['meta_description_1'] ?? ''),
            'Meta_Description_Recomendada' => $this->generarMetaDescRecomendada($url),
            'Prioridad' => $this->calcularPrioridad($url)
        ];
    }

    return $this->generarCSV('meta_descriptions_optimizar', $csvData, 'on_page');
}
```

### Paso 2: Añadir case al API endpoint

```php
// En api/generar_entregable.php

case 'meta_descriptions':
case 'meta_descriptions_optimizar':
    $resultado = $generator->generarMetaDescriptionsSinOptimizar($datosScreamingFrog);
    break;
```

### Paso 3: Añadir botón en módulo

```html
<a href="#"
   class="btn-download"
   data-entregable-tipo="meta_descriptions"
   data-entregable-categoria="on_page"
   download>
    <i class="fas fa-download"></i> Descargar CSV
</a>
```

**¡Listo!** El sistema lo detectará y generará automáticamente.

---

## 🚨 Troubleshooting

### Error: "No hay datos de Screaming Frog"

**Causa**: El archivo JSON no existe en `data/screamingfrog/auditoria_{id}.json`

**Solución**:
1. Exportar datos de Screaming Frog a JSON
2. Subirlo a la ruta correcta
3. O implementar carga desde base de datos en `cargarDatosScreamingFrog()`

### Error: "No se pudo crear el archivo CSV"

**Causa**: Permisos insuficientes en el directorio `/entregables/`

**Solución**:
```bash
chmod 755 entregables/
chmod 755 entregables/auditoria_*/
```

### CSV aparece vacío (0 elementos)

**Causa**: Los filtros son demasiado restrictivos

**Solución**:
1. Revisar método de filtrado en `EntregablesGenerator.php`
2. Ajustar condiciones de filtro
3. Verificar que los datos de entrada tienen los campos esperados

### Botón no se actualiza

**Causa**: JavaScript no detecta el atributo `data-entregable-tipo`

**Solución**:
1. Verificar que el botón tiene `data-entregable-tipo="..."`
2. Verificar que `entregables-generator.js` está cargado
3. Abrir consola y verificar errores

---

## 📚 Referencias

- **Clase generadora**: `includes/EntregablesGenerator.php`
- **API endpoint**: `api/generar_entregable.php`
- **Cliente JS**: `js/entregables-generator.js`
- **Documentación patrón**: `PATRON_MODULOS_EDUCATIVOS_ENTREGABLES.md`
- **Template módulo**: `templates/template_modulo_educativo.php`

---

## 🎯 Próximos Pasos

1. **Integrar con otros módulos**:
   - Keywords: `generarOportunidadesKeywords()` ✅
   - On-Page: `generarPaginasSinH1()`, `generarImagenesSinAlt()` ✅
   - Contenido: `generarContenidoDelgado()` (pendiente)
   - Enlaces: `generarEnlacesRotos()` (pendiente)
   - Técnico: `generarErrores404()` (pendiente)

2. **Mejorar lógica de priorización**:
   - Incorporar datos de Ahrefs (autoridad de página)
   - Incorporar datos de GSC (impresiones, CTR)
   - Machine learning para predecir impacto

3. **Dashboard de entregables**:
   - Página con todos los CSVs disponibles
   - Progreso de completitud
   - Descarga masiva (ZIP con todos)

4. **Notificaciones**:
   - Email al cliente cuando los CSVs están listos
   - Webhook para integraciones

---

**Última actualización**: 2025-10-17
**Versión**: 1.0
**Autor**: Sistema de Auditoría SEO
