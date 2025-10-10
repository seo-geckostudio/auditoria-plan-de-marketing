# Informe preliminar de auditoría SEO — Ibiza Villa
Generado: 2025-10-06

Este borrador consolida el estado actual, documentos presentes y próximos pasos para avanzar con el análisis.

## 1) Estado actual
- Checklist de documentos: todo marcado como presente en `LISTA_DOCUMENTOS_AUDITORIA.md`.
- Datos disponibles:
  - GA4: últimos 30 y 365 días (por pagePath, dispositivo y país).
  - GSC: páginas y consultas (últimos 30 días; desgloses por dispositivo y país).
  - Ahrefs: `backlinks.csv`, `anchors.csv`, `referring_domains.csv`, `organic_keywords.csv`, `top_pages.csv`.
  - Técnica: `redirects/redirects.csv`, logs de servidor (`logs/access/*` y `logs/error/*`), `robots.txt`, sitemaps descargados.

## 2) Hallazgos preliminares (estructura)
Nota: Secciones preparadas para completar con datos tras confirmar cabeceras de CSV.

### 2.1 Tráfico (GA4)
- Top páginas por `pagePath` (últimos 30 días).
- Distribución por dispositivo (Mobile/Desktop/Tablet).
- Distribución por país (top 10).
- Tendencia 365 días: páginas con crecimiento/descenso destacado.

### 2.2 Visibilidad en búsqueda (GSC)
- Top páginas por clics e impresiones (últimos 30 días).
- Top consultas por clics e impresiones.
- CTR promedio y posiciones medias por dispositivo.

### 2.3 Autoridad y backlinks (Ahrefs)
- Top páginas por backlinks y por dominios de referencia.
- Anclas más frecuentes y su distribución.
- Dominios de referencia con mayor autoridad.
- Palabras clave orgánicas principales y páginas asociadas.

### 2.4 Técnica (Logs y Redirects)
- Resumen de errores frecuentes (4xx/5xx) en los últimos 30 días.
- Redirecciones definidas: validación de tipos (301/302) y detección de cadenas.
- Sitemaps presentes y coherencia con URLs activas.

## 3) Revisión necesaria
- Confirmar cabeceras de CSV de GA4 y GSC para calcular métricas automáticamente.
- Confirmar esquema de `redirects.csv` (from, to, type, source opcional).
- Verificar tamaño de logs y periodo cubierto (últimos 30 días).

## 4) Próximos pasos
1. Ejecutar extracción automática y rellenar este informe con tablas y métricas.
2. Generar tablas:
   - Top 15 páginas por tráfico (GA4), por dispositivo y país.
   - Top 15 páginas por backlinks y dominios de referencia (Ahrefs).
   - Top consultas y páginas con CTR bajo (GSC) para optimización rápida.
   - Validación de `redirects.csv` y listado de potenciales 404/500 desde logs.
3. Priorizar acciones: contenido, enlaces internos, técnica (redirects/errores), internacional.

## 5) Fuentes
- `ga4/*.csv`, `gsc/*.csv`, `ahrefs/*.csv`, `redirects/redirects.csv`, `logs/*`, `sitemaps/*.xml`, `robots.txt`.

---
Este documento es un borrador. Tras confirmar las cabeceras de los CSV, se completarán las tablas y métricas automáticamente.
---
## Datos calculados (auto)
Generado: 2025-10-06 09:05

## GA4: Top pÃ¡ginas por PageViews (30 dÃ­as)

| Page | Views |
| --- | --- |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |

## GA4

Error procesando GA4: El método especificado no es compatible.

## GSC: Top pÃ¡ginas por clics (30 dÃ­as)

| Page | Clicks | Impressions | CTR | Position |
| --- | --- | --- | --- | --- |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |

## GSC: Top consultas por clics (30 dÃ­as)

| Query | Clicks | Impressions | CTR | Position |
| --- | --- | --- | --- | --- |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |
|  | 0 | 0 | 0,00 % | 0,00 |

## Ahrefs: Top pages por trÃ¡fico orgÃ¡nico

| URL | Traffic |
| --- | --- |
|  | 65 |
|  | 16 |
|  | 6 |
|  | 2 |
|  | 2 |
|  | 1 |
|  | 1 |
|  | 1 |
|  | 1 |
|  | 1 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |
|  | 0 |

## Ahrefs: Keywords orgÃ¡nicas principales

| Keyword | Position | Traffic | URL |
| --- | --- | --- | --- |
|  | 0,0 | 59 |  |
|  | 0,0 | 40 |  |
|  | 0,0 | 36 |  |
|  | 0,0 | 29 |  |
|  | 0,0 | 29 |  |
|  | 0,0 | 27 |  |
|  | 0,0 | 25 |  |
|  | 0,0 | 21 |  |
|  | 0,0 | 21 |  |
|  | 0,0 | 21 |  |
|  | 0,0 | 20 |  |
|  | 0,0 | 19 |  |
|  | 0,0 | 17 |  |
|  | 0,0 | 15 |  |
|  | 0,0 | 13 |  |

## Ahrefs: Referring domains (top 10 por backlinks)

| Domain | DR | Backlinks |
| --- | --- | --- |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |
|  | 0 | 0 |

## Redirects: resumen por tipo

| Tipo | Conteo |
| --- | --- |
| 301 | 0 |
| 302 | 0 |
| invÃ¡lidos | 73 |

## Logs: errores frecuentes (Ãºltimos archivos)

| Codigo | Ocurrencias |
| --- | --- |
| 404 | 164 |
| 403 | 72 |
| 500 | 889 |
| 502 | 0 |

