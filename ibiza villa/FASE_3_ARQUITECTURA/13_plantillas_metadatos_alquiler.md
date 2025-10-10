# Plantillas de metadatos SEO para `/alquiler/`

Guía de títulos, H1, meta descripciones, datos estructurados, `hreflang` y `canonical` para las páginas de la arquitectura `/alquiler/`.

## Notas generales
- Mantener coherencia entre `title` y `H1` (variar levemente para evitar duplicidad).
- Longitud recomendada: `title` 55–60 caracteres; `meta description` 145–160.
- Incluir USP: gestión local en Ibiza, selección curada de villas.
- Usar variables: `{categoria}`, `{ubicacion}`, `{playa}`, `{capacidad}`, `{marca}` (`Ibiza Villa`).

## Categorías: Ubicaciones
Ruta: `/alquiler/{ubicacion}/`
- Title: `Alquiler de villas en {ubicacion} | {marca}`
- H1: `Villas en alquiler en {ubicacion}`
- Meta: `Descubre villas en {ubicacion} con vistas, piscina y servicios gestionados por {marca}. Reserva segura y asesoría local.`
- JSON-LD:
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Villas en alquiler en {ubicacion}",
  "itemListElement": [],
  "isPartOf": {
    "@type": "WebPage",
    "inLanguage": "es",
    "breadcrumb": "Home > Alquiler > {ubicacion}"
  }
}
</script>
```

## Categorías: Playas
Ruta: `/alquiler/playa/{playa}/`
- Title: `Alquiler de villas cerca de {playa} | {marca}`
- H1: `Villas en alquiler cerca de {playa}`
- Meta: `Villas seleccionadas cerca de {playa} en Ibiza. Acceso a la playa, privacidad y servicios premium con {marca}.`

## Categorías: Amenidades
Ruta: `/alquiler/{amenidad}/` (p.ej. `lujo`, `piscina`, `frente-al-mar`)
- Lujo
  - Title: `Alquiler de villas de lujo en Ibiza | {marca}`
  - H1: `Villas de lujo en Ibiza en alquiler`
  - Meta: `Colección de villas de lujo en Ibiza con diseño, vistas y servicios a medida. Reserva con {marca}.`
- Piscina
  - Title: `Villas con piscina en Ibiza en alquiler | {marca}`
  - H1: `Alquiler de villas con piscina en Ibiza`
  - Meta: `Villas con piscina privada en Ibiza, ideales para familias y grupos. Gestión local de {marca}.`
- Frente al mar
  - Title: `Villas frente al mar en Ibiza en alquiler | {marca}`
  - H1: `Alquiler de villas frente al mar en Ibiza`
  - Meta: `Primera línea y vistas al Mediterráneo. Selección curada de villas frente al mar por {marca}.`

## Categorías: Audiencias
Ruta: `/alquiler/{audiencia}/` (p.ej. `familias`, `grupos`)
- Familias
  - Title: `Villas para familias en Ibiza en alquiler | {marca}`
  - H1: `Alquiler de villas para familias en Ibiza`
  - Meta: `Villas seguras y cómodas para familias en Ibiza, con piscina y servicios. {marca} te acompaña en todo el proceso.`
- Grupos
  - Title: `Villas para grupos en Ibiza en alquiler | {marca}`
  - H1: `Alquiler de villas para grupos en Ibiza`
  - Meta: `Capacidad y privacidad para grupos. Villas en Ibiza con múltiples habitaciones y espacios exteriores. Reserva con {marca}.`

## Categorías: Temporada
Ruta: `/alquiler/{temporada}/` (p.ej. `verano`)
- Title: `Alquiler de villas en Ibiza en {temporada} | {marca}`
- H1: `Villas en alquiler en {temporada} en Ibiza`
- Meta: `Villas disponibles en {temporada} con gestión integral, mejores zonas y playas. {marca} te asesora.`

## Categorías: Capacidad
Ruta: `/alquiler/{capacidad}/` (p.ej. `8-personas`)
- Title: `Villas para {capacidad} en Ibiza en alquiler | {marca}`
- H1: `Alquiler de villas para {capacidad} en Ibiza`
- Meta: `Selección de villas para {capacidad} en Ibiza con espacios amplios y privacidad. Gestión local de {marca}.`

## Canonical y `hreflang`
- Canonical: siempre la URL base de la categoría (sin filtros ni parámetros).
- `hreflang` ejemplo para `/alquiler/lujo/`:
```html
<link rel="alternate" href="https://ibizavilla.com/alquiler/lujo/" hreflang="es" />
<link rel="alternate" href="https://ibizavilla.co.uk/rent/luxury/" hreflang="en" />
<link rel="alternate" href="https://ibizavilla.it/affitto/lusso/" hreflang="it" />
<link rel="alternate" href="https://ibizavilla.com/alquiler/lujo/" hreflang="x-default" />
```

## Breadcrumbs (JSON-LD)
Ejemplo para `/alquiler/santa-eulalia/`:
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://ibizavilla.com/"},
    {"@type": "ListItem", "position": 2, "name": "Alquiler", "item": "https://ibizavilla.com/alquiler/"},
    {"@type": "ListItem", "position": 3, "name": "Santa Eulalia", "item": "https://ibizavilla.com/alquiler/santa-eulalia/"}
  ]
}
</script>
```

## Datos estructurados adicionales
- `WebPage` con `inLanguage`, `isPartOf`, `about` para reforzar contexto.
- `ItemList` para listados (categorías) con `itemListElement` de tipo `LodgingBusiness` o `House`.
- `FAQPage` opcional si hay módulo de preguntas frecuentes.

## Open Graph / Twitter
- OG title: replicar `title`.
- OG description: replicar `meta description`.
- OG type: `website` para categoría.
- Twitter card: `summary_large_image`.

## Reglas de filtros y robots
- Parámetros de filtros (precio, capacidad, amenities): `noindex,follow` + canonical a la categoría.
- Evitar indexación de combinaciones infinitas; permitir navegación para usuarios.

## Ejemplo completo (Ubicación)
Para `/alquiler/santa-eulalia/`:
```html
<title>Alquiler de villas en Santa Eulalia | Ibiza Villa</title>
<meta name="description" content="Descubre villas en Santa Eulalia con vistas, piscina y servicios gestionados por Ibiza Villa. Reserva segura y asesoría local." />
<link rel="canonical" href="https://ibizavilla.com/alquiler/santa-eulalia/" />
<!-- hreflang -->
<link rel="alternate" href="https://ibizavilla.com/alquiler/santa-eulalia/" hreflang="es" />
<link rel="alternate" href="https://ibizavilla.co.uk/rent/santa-eulalia/" hreflang="en" />
<link rel="alternate" href="https://ibizavilla.it/affitto/santa-eulalia/" hreflang="it" />
<link rel="alternate" href="https://ibizavilla.com/alquiler/santa-eulalia/" hreflang="x-default" />
<!-- Breadcrumbs JSON-LD aquí -->
```

## Entrega operativa
- Generar CSV/JSON con columnas: `url`, `title`, `h1`, `meta_description`, `canonical`, `hreflang_es`, `hreflang_en`, `hreflang_it`.
- Aplicar estas plantillas a las páginas del Top 10 priorizado.