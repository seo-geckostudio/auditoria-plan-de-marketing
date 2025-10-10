# Arquitectura gráfica — ibizavilla.com/alquiler/

Este archivo presenta la arquitectura con el prefijo `/alquiler/` de forma gráfica (diagramas Mermaid y árbol ASCII) para facilitar su comprensión, implementación y validación.

> Nota: Los diagramas Mermaid se renderizan en visores compatibles (GitHub, extensiones de VS Code/Trae, etc.).

---

## Diagrama general (categorías y ejemplos)

```mermaid
flowchart LR
    A([Inicio]) --> B([Alquiler])
    B --> C([Ubicaciones])
    B --> D([Playas])
    B --> E([Amenidades])
    B --> F([Audiencias])
    B --> G([Temporada])
    B --> H([Capacidad])

    %% Ubicaciones
    C --> C1[/santa-eulalia/]
    C --> C2[/san-jose/]
    C --> C3[/ibiza-ciudad/]
    C --> C4[/san-antonio/]
    C --> C5[/es-cubells/]

    %% Playas
    D --> D1[/playa-den-bossa/]
    D --> D2[/cala-comte/]
    D --> D3[/cala-bassa/]
    D --> D4[/cala-tarida/]

    %% Amenidades
    E --> E1[/lujo/]
    E --> E2[/con-piscina/]
    E --> E3[/vista-mar/]
    E --> E4[/frente-mar/]
    E --> E5[/cerca-playa/]

    %% Audiencias
    F --> F1[/familias/]
    F --> F2[/grupos/]
    F --> F3[/bodas/]
    F --> F4[/eventos/]

    %% Temporada
    G --> G1[/verano/]
    G --> G2[/julio/]
    G --> G3[/agosto/]
    G --> G4[/semanal/]
    G --> G5[/fin-de-semana/]

    %% Capacidad
    H --> H1[/8-personas/]
    H --> H2[/10-personas/]
    H --> H3[/12-personas/]

    %% Interlinking de ejemplo
    C1 --- D2
    C1 --- E2
    D1 --- E1
    D2 --- E3
    C2 --- D4
```

---

## Árbol de URLs (ASCII)

```
ibizavilla.com/alquiler/
├── ubicaciones/
│   ├── santa-eulalia/
│   ├── san-jose/
│   ├── ibiza-ciudad/
│   ├── san-antonio/
│   └── es-cubells/
├── playas/
│   ├── playa-den-bossa/
│   ├── cala-comte/
│   ├── cala-bassa/
│   └── cala-tarida/
├── amenidades/
│   ├── lujo/
│   ├── con-piscina/
│   ├── vista-mar/
│   └── frente-mar/
├── audiencias/
│   ├── familias/
│   ├── grupos/
│   ├── bodas/
│   └── eventos/
├── temporada/
│   ├── verano/
│   ├── julio/
│   ├── agosto/
│   ├── semanal/
│   └── fin-de-semana/
└── capacidad/
    ├── 8-personas/
    ├── 10-personas/
    └── 12-personas/
```

---

## Breadcrumbs e interlinking

```mermaid
flowchart TD
    Home([Inicio]) --> Alq([Alquiler])
    Alq --> Cat1([Ubicaciones])
    Cat1 --> SEU[[/alquiler/santa-eulalia/]]

    %% Breadcrumbs
    classDef crumb fill:#f3f3f3,stroke:#bbb,color:#333;
    Home:::crumb --> Alq:::crumb --> Cat1:::crumb --> SEU:::crumb

    %% Enlaces cruzados desde Santa Eulalia
    SEU -.-> PDB[/playa-den-bossa/]
    SEU -.-> LUX[/lujo/]
    SEU -.-> CP[/con-piscina/]
```

---

## Internacionalización (espejo)

```mermaid
flowchart LR
    ES([ES /alquiler/]) --- EN([EN /rent/]) --- IT([IT /affitto/])
    ES --> ES_U([ubicaciones])
    EN --> EN_U([locations])
    IT --> IT_U([località])

    ES_U --> ES_SEU[/santa-eulalia/]
    EN_U --> EN_SEU[/santa-eulalia/]
    IT_U --> IT_SEU[/santa-eulalia/]
```

---

## Top 10 prioritarios (visual)

```mermaid
flowchart LR
    root([/alquiler/])
    root --> lujo[/lujo/]
    root --> seu[/santa-eulalia/]
    root --> sj[/san-jose/]
    root --> ibc[/ibiza-ciudad/]
    root --> pdb[/playa-den-bossa/]
    root --> piscina[/con-piscina/]
    root --> vista[/vista-mar/]
    root --> cco[/cala-comte/]
    root --> sa[/san-antonio/]
    root --> esc[/es-cubells/]
```

---

## Notas rápidas de implementación
- Slugs en español, normalizados: minúsculas, guiones, sin acentos.
- Titles/H1 orientados a “Alquiler de villas … en Ibiza”.
- Interlinking entre Ubicaciones ↔ Playas ↔ Amenidades para distribuir autoridad.
- 301 desde URLs antiguas `/villas/...` y `/villa/...` a `/alquiler/...` equivalentes.

```
Ejemplo de breadcrumb: Inicio > Alquiler > Ubicaciones > Santa Eulalia
Ejemplo de H1: Alquiler de villas en Santa Eulalia (Ibiza)
```

---

## Referencias
- Propuesta detallada: `FASE_3_ARQUITECTURA/09_propuesta_arquitectura.md`
- Slugs priorizados: `FASE_3_ARQUITECTURA/10_slugs_priorizados_alquiler.md`
```
```