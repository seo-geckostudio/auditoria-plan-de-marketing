# Documentación de referencia — Ibiza Villa

Este documento recopila las fuentes y artefactos a consultar para el proyecto de alquiler de villas en Ibiza.

## Fuentes de datos (Keyword Research / Paid)
- `ibiza villa/kr ibiza villa en.csv`: datos de búsqueda (EN) para planificación y priorización.
- `ibiza villa/kr ibiza villa es.csv`: datos de búsqueda (ES) para planificación y priorización.
- `ibiza villa/kr ibiza villa it.csv`: datos de búsqueda (IT) para planificación y priorización.

## Artefactos generados (listas operativas)
- `ibiza villa/keywords_en_list.txt`: lista estratégica EN limitada a 100 keywords.
- `ibiza villa/keywords_it_list.txt`: lista estratégica IT limitada a 100 keywords.
- `ibiza villa/keywords_es_list.txt`: lista ES (pendiente de revisión/limitación si aplica).

## Scripts útiles
- `scripts/export_keywords_by_language.php`: exporta listas por idioma desde fuentes CSV, con filtros de compra y normalización.
- `scripts/clean_keywords_sources.php`: limpia fuentes CSV para eliminar términos de compra y duplicados.
- `scripts/generate_en_strategic_keywords.php`: genera 100 keywords EN estratégicas.
- `scripts/generate_it_strategic_keywords.php`: genera 100 keywords IT estratégicas.

## Notas de uso
- Las listas estratégicas están pensadas para importación directa en Keyword Planner (≤100).
- Los CSV `kr ...` se usarán para ponderar y priorizar términos por volumen/intención antes de crear campañas.
- La normalización evita tokens sueltos de idioma y duplica.