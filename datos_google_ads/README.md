# Estudio de Palabras Clave con Google Ads (Keyword Planner)

Este directorio centraliza el flujo del estudio de palabras clave vía Google Ads. La arquitectura SEO se definirá después de este estudio, con foco en pilares de contenido, localidades y amenities, descartando términos que sean propiedades específicas.

## Opciones de extracción
- Opción A: Exportar manualmente desde Google Ads (Keyword Planner) y colocar el CSV aquí.
- Opción B: Extracción automática vía API (necesita credenciales y permisos).

## Credenciales necesarias para extracción automática
- Developer Token (Google Ads)
- OAuth Client ID y Client Secret
- Refresh Token
- Login Customer ID (MCC)
- Customer ID(s) a analizar
- Scope de acceso: `https://www.googleapis.com/auth/adwords`

## Configuración recomendada de extracción
- Red: Solo Google Search
- Idiomas objetivo: `es`, `en`, `de`, `fr`, `it`
- Ubicaciones: España, Reino Unido, Alemania, Francia, Italia
- Periodo: Últimos 12 meses (media mensual)
- Semillas: usar `seed_keywords_template.csv`
- Exclusiones: aplicar `exclusion_rules.yml`

## Archivos
- `seed_keywords_template.csv`: plantilla de semillas por categoría (pilar, localidad, amenity, servicio).
- `exclusion_rules.yml`: reglas y patrones para excluir términos de propiedades, marcas y ruido.
- `exports/`: coloca aquí los CSVs exportados del Keyword Planner.
- `processed/`: resultados procesados y clasificados en pilares, localidades y amenities.

### Selección de cuenta cliente (API)
- `selected_customer.json`: archivo generado automáticamente con la cuenta cliente elegida.
- Endpoint: `api/google_ads_customer_selection.php`
  - GET: devuelve la selección actual y opciones permitidas.
  - POST: establece la cuenta.
    - Parámetros: `id=test` (257-911-2901) o `id=test2` (649-791-4215)
  - Ejemplos:
    - GET: `/api/google_ads_customer_selection.php`
    - POST: `/api/google_ads_customer_selection.php` con cuerpo `id=test2`

## Flujo de trabajo sugerido
1) Completa `seed_keywords_template.csv` con tus semillas por categoría.
2) Exporta desde Google Ads Keyword Planner las ideas de palabras (CSV) y guárdalas en `exports/`.
3) Aplicaremos exclusiones y clustering por intención y temática.
4) Generaremos:
   - `processed/keywords_filtradas.csv`
   - `processed/clusters_priorizados.csv`
   - `processed/mapping_keyword_url.csv`

## Campos esperados en export de Ads
- `Keyword`, `Avg monthly searches`, `Competition`, `Top of page bid (low range)`, `Top of page bid (high range)`, `Language`, `Location`, `Network`

## Nota
La arquitectura y el interlinking se construirán tras obtener los clusters priorizados y el mapping keyword→URL.