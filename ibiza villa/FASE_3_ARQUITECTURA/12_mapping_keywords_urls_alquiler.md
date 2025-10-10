# Mapping keywords → URLs para `/alquiler/`

Este documento define el mapeo de clusters de keywords a las rutas de la arquitectura `/alquiler/` y sirve como guía operativa para contenidos, SEO técnico y enlazado interno.

## Principios
- Mantener consistencia semántica y de intención de búsqueda (informacional vs transaccional).
- Usar slugs cortos, claros y estables; evitar stop‑words.
- Priorizar categorías con evidencia de demanda (Top 10 ya definidos).
- Reutilizar slugs de ubicaciones y playas en todos los idiomas; traducir atributos (lujo → luxury → lusso, con/hreflang).
- Canonical siempre a la URL limpia de la categoría; filtros con parámetros no canónicos.

## Estructura base de rutas
- Ubicaciones: `/alquiler/<municipio|zona>/`
- Playas: `/alquiler/playa/<nombre-playa>/`
- Amenidades: `/alquiler/<amenidad>/` (p.ej. `lujo`, `piscina`, `frente-al-mar`)
- Audiencias: `/alquiler/<audiencia>/` (p.ej. `familias`, `grupos`, `parejas`)
- Temporada: `/alquiler/<temporada>/` (p.ej. `verano`, `invierno`)
- Capacidad: `/alquiler/<capacidad>/` (p.ej. `4-personas`, `8-personas`)

## Clusters y ejemplos (ES)

### Ubicaciones
- Santa Eulalia → `/alquiler/santa-eulalia/`
  - Keywords: "alquiler villa santa eulalia", "villas en santa eulalia", "alquiler casas santa eulalia ibiza"
  - Intención: transaccional
  - Interlinking: enlazar a `lujo`, `piscina`, `familias`, y playas cercanas

- San José → `/alquiler/san-jose/`
  - Keywords: "alquiler villa san jose ibiza", "villas san jose"
  - Intención: transaccional
  - Interlinking: `frente-al-mar`, `grupos`, playas: Cala d'Hort, Cala Tarida

### Playas
- Cala d'Hort → `/alquiler/playa/cala-dhort/`
  - Keywords: "villa cala d'hort", "alquiler cerca de cala d'hort"
  - Intención: transaccional
  - Interlinking: `frente-al-mar`, `parejas`, `lujo`

### Amenidades
- Lujo → `/alquiler/lujo/`
  - Keywords: "alquiler villas de lujo ibiza", "villa lujo ibiza alquiler"
  - Intención: transaccional
  - Interlinking: ubicaciones top, `frente-al-mar`, `piscina`

- Piscina → `/alquiler/piscina/`
  - Keywords: "villa con piscina ibiza", "alquiler casa con piscina ibiza"
  - Intención: transaccional
  - Interlinking: ubicaciones, `familias`

- Frente al mar → `/alquiler/frente-al-mar/`
  - Keywords: "villa frente al mar ibiza", "alquiler casa primera linea ibiza"
  - Intención: transaccional
  - Interlinking: playas, `lujo`, `parejas`

### Audiencias
- Familias → `/alquiler/familias/`
  - Keywords: "villa familiar ibiza", "alquiler villas para familias ibiza"
  - Intención: transaccional
  - Interlinking: `piscina`, ubicaciones tranquilas

- Grupos → `/alquiler/grupos/`
  - Keywords: "villa para grupos ibiza", "alquiler grandes grupos ibiza"
  - Intención: transaccional
  - Interlinking: `8-personas`, `12-personas`, `san-jose`

### Temporada
- Verano → `/alquiler/verano/`
  - Keywords: "alquiler villa verano ibiza", "villas verano ibiza"
  - Intención: transaccional
  - Interlinking: ubicaciones + playas, `familias`

### Capacidad
- 8 personas → `/alquiler/8-personas/`
  - Keywords: "villa 8 personas ibiza", "alquiler 8 personas ibiza"
  - Intención: transaccional
  - Interlinking: `grupos`, ubicaciones top

## Top 10 priorizados (enlazado y foco)
Basado en el documento de arquitectura, priorizar:
1. `/alquiler/lujo/`
2. `/alquiler/santa-eulalia/`
3. `/alquiler/san-jose/`
4. `/alquiler/frente-al-mar/`
5. `/alquiler/playa/cala-dhort/`
6. `/alquiler/playa/cala-tarida/`
7. `/alquiler/familias/`
8. `/alquiler/grupos/`
9. `/alquiler/piscina/`
10. `/alquiler/8-personas/`

## Internacionalización (ES/EN/IT)
- Mantener slugs de ubicaciones y playas iguales en todos los idiomas.
- Traducir atributos:
  - `lujo` → `luxury` (EN) → `lusso` (IT)
  - `frente-al-mar` → `seafront` (EN) → `fronte-mare` (IT)
  - `piscina` → `pool` (EN) → `piscina` (IT)
  - `familias` → `families` (EN) → `famiglie` (IT)
  - `grupos` → `groups` (EN) → `gruppi` (IT)
  - `verano` → `summer` (EN) → `estate` (IT)
  - `8-personas` → `8-persons` (EN) → `8-persone` (IT)

### Mirrors por dominio regional
- ES: ibizavilla.com/alquiler/.../
- EN: ibizavilla.co.uk/rent/.../
- IT: ibizavilla.it/affitto/.../

## Reglas de enlazado interno
- Cada página de categoría debe enlazar a 4–6 páginas relacionadas: 2 ubicaciones, 2 amenidades, 2 playas.
- Añadir breadcrumbs (`Home > Alquiler > Categoría`) + módulo de "Descubre también" con relaciones cruzadas.
- En cada playa, enlazar a `frente-al-mar`, `lujo` y 2 ubicaciones cercanas.

## Reglas técnicas (canonical, hreflang, params)
- Canonical: la URL base de categoría.
- Filtros (p.ej. `?precio_max=...`) sin indexación: `noindex,follow` y canonical a la base.
- `hreflang`: ES/EN/IT en cada categoría con `x-default` al idioma principal.

## Entregables
- Plantillas de metadatos por tipo de categoría (ver `13_plantillas_metadatos_alquiler.md`).
- CSV opcional para import (columns: url, title, h1, meta_description, canonical, hreflang_es, hreflang_en, hreflang_it).

## Checklist de implementación
- [ ] Crear páginas y rutas físicas según patrones.
- [ ] Implementar breadcrumbs + bloque de interlinking.
- [ ] Configurar canonical y hreflang.
- [ ] Aplicar plantillas de metadatos.
- [ ] Registrar en sitemap por idioma.