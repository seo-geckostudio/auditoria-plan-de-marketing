# Lista inicial de slugs — prefijo `/alquiler/`

Este documento define la lista inicial de slugs bajo el prefijo `/alquiler/`, priorizada por intención comercial y demanda estimada, agrupada por categorías estratégicas. Se alinea con la arquitectura establecida y servirá como base para routing, breadcrumbs, plantillas de contenido y metadatos.

## Principios de priorización
- Foco en intención transaccional y discoverability (zonas, playas, atributos, ocasiones, temporada y capacidad).
- Slugs en español, normalizados (sin acentos, guiones, minúsculas).
- Títulos/H1 orientados a “Alquiler de villas en …” o “… en Ibiza”.

---

## Top 10 prioridades (fase 1)
1. `/alquiler/lujo/` — H1: Alquiler de villas de lujo en Ibiza
2. `/alquiler/santa-eulalia/` — H1: Alquiler de villas en Santa Eulalia
3. `/alquiler/san-jose/` — H1: Alquiler de villas en San José (Sant Josep)
4. `/alquiler/ibiza-ciudad/` — H1: Alquiler de villas en Ibiza Ciudad
5. `/alquiler/playa-den-bossa/` — H1: Alquiler de villas en Playa d’en Bossa
6. `/alquiler/con-piscina/` — H1: Alquiler de villas con piscina en Ibiza
7. `/alquiler/vista-mar/` — H1: Alquiler de villas con vista al mar en Ibiza
8. `/alquiler/cala-comte/` — H1: Alquiler de villas en Cala Comte
9. `/alquiler/san-antonio/` — H1: Alquiler de villas en San Antonio
10. `/alquiler/es-cubells/` — H1: Alquiler de villas en Es Cubells

---

## Ubicaciones (municipios/zonas)
- `/alquiler/santa-eulalia/` — Santa Eulalia
- `/alquiler/san-jose/` — San José (Sant Josep)
- `/alquiler/san-antonio/` — San Antonio
- `/alquiler/sant-joan/` — Sant Joan
- `/alquiler/ibiza-ciudad/` — Ibiza Ciudad (Eivissa)
- `/alquiler/jesus/` — Jesús
- `/alquiler/es-cubells/` — Es Cubells
- `/alquiler/santa-gertrudis/` — Santa Gertrudis
- `/alquiler/portinatx/` — Portinatx
- `/alquiler/san-miguel/` — San Miguel
- `/alquiler/sant-carles/` — Sant Carles

## Playas (hotspots turísticos)
- `/alquiler/cala-comte/` — Cala Comte
- `/alquiler/cala-bassa/` — Cala Bassa
- `/alquiler/cala-tarida/` — Cala Tarida
- `/alquiler/cala-dhort/` — Cala d’Hort
- `/alquiler/cala-salada/` — Cala Salada
- `/alquiler/benirras/` — Benirras
- `/alquiler/talamanca/` — Talamanca
- `/alquiler/cala-llonga/` — Cala Llonga
- `/alquiler/es-figueral/` — Es Figueral
- `/alquiler/cala-san-vicente/` — Cala San Vicente
- `/alquiler/playa-den-bossa/` — Playa d’en Bossa
- `/alquiler/sa-caleta/` — Sa Caleta
- `/alquiler/s-estanyol/` — S’Estanyol
- `/alquiler/cala-moli/` — Cala Molí
- `/alquiler/cala-carbo/` — Cala Carbó

## Atributos/Amenidades
- `/alquiler/lujo/` — Villas de lujo
- `/alquiler/con-piscina/` — Villas con piscina
- `/alquiler/frente-mar/` — Villas frente al mar
- `/alquiler/cerca-playa/` — Villas cerca de la playa
- `/alquiler/privadas/` — Villas privadas
- `/alquiler/aisladas/` — Villas aisladas
- `/alquiler/jacuzzi/` — Villas con jacuzzi
- `/alquiler/bbq/` — Villas con barbacoa
- `/alquiler/aire-acondicionado/` — Villas con aire acondicionado
- `/alquiler/wifi/` — Villas con wifi
- `/alquiler/aparcamiento/` — Villas con aparcamiento
- `/alquiler/piscina-climatizada/` — Villas con piscina climatizada
- `/alquiler/vista-atardecer/` — Villas con vista al atardecer
- `/alquiler/cerca-vida-nocturna/` — Villas cerca de la vida nocturna
- `/alquiler/cerca-casco-antiguo/` — Villas cerca del casco antiguo

## Audiencias/Ocasiones
- `/alquiler/familias/` — Villas para familias
- `/alquiler/grupos/` — Villas para grupos
- `/alquiler/mascotas-permitidas/` — Villas pet friendly
- `/alquiler/bodas/` — Villas para bodas
- `/alquiler/eventos/` — Villas para eventos
- `/alquiler/yoga/` — Villas para retiros de yoga
- `/alquiler/luna-de-miel/` — Villas para luna de miel
- `/alquiler/empresas/` — Villas para empresas

## Temporada/Duración
- `/alquiler/verano/` — Verano en Ibiza
- `/alquiler/julio/` — Julio en Ibiza
- `/alquiler/agosto/` — Agosto en Ibiza
- `/alquiler/semanal/` — Alquiler semanal
- `/alquiler/fin-de-semana/` — Alquiler fin de semana

## Capacidad (orientación comercial)
- `/alquiler/8-personas/` — Villas para 8 personas
- `/alquiler/10-personas/` — Villas para 10 personas
- `/alquiler/12-personas/` — Villas para 12 personas
- `/alquiler/14-personas/` — Villas para 14 personas
- `/alquiler/16-personas/` — Villas para 16 personas
- `/alquiler/20-personas/` — Villas para 20 personas

---

## Notas de implementación
- Breadcrumbs base: Inicio > Alquiler > {Categoría} > {Slug}
- Plantillas de metadatos: Title y H1 con “Alquiler de villas … en Ibiza” + USP.
- Internacionalización: espejo en `/en/rent/…` y `/it/affitto/…` cuando aplique.
- Redirects: mapear URLs antiguas `/villas/...` y `/villa/...` a los nuevos `/alquiler/...` equivalentes.

## Próximos pasos
- Generar briefs y módulos de contenido para el Top 10 de fase 1.
- Integrar slugs en routing y navegación (header/footer/mega menú).
- Añadir reglas de breadcrumbs y bloques de interlinking entre ubicaciones, playas y atributos.
- Validar con datos (KR) el orden de publicación y expandir fase 2.