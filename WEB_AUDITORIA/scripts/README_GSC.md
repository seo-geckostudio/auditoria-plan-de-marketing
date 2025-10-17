GSC MCP: Extracción automática de datos de Google Search Console

Resumen
- Script `fetch_gsc_data.js` para consultar Search Analytics y generar CSVs en `assets/data/custom/`.
- Permite completar el apartado de “Análisis de situación actual” con clics y keywords orgánicas.

Requisitos
- Node.js 18+
- Paquetes: `googleapis`, `dotenv`
- Permisos de acceso al sitio en GSC para la cuenta usada.

Instalación
1) Ir a `WEB_AUDITORIA/scripts/`
2) Instalar dependencias:
   - `npm i googleapis dotenv`
3) Copiar `.env.gsc.example` a `.env.gsc` y completar valores.

Configuración (.env.gsc)
- `GOOGLE_CLIENT_ID` y `GOOGLE_CLIENT_SECRET`: credenciales OAuth de Google Cloud.
- `GOOGLE_REFRESH_TOKEN`: token de actualización con acceso a Search Console.
- `GSC_SITE_URL`: URL del sitio tal y como aparece en GSC (ej. `https://www.ejemplo.com/`).

Ejecución
- `node fetch_gsc_data.js`
- Los CSVs se generan en `WEB_AUDITORIA/assets/data/custom/`.

CSVs generados
- `gsc_pages_last30.csv` → columnas: `page,clicks,impressions,ctr,position`
- `gsc_queries_last30.csv` → columnas: `query,clicks,impressions,ctr,position`
- `gsc_pages_by_device_last30.csv` → columnas: `page,device,clicks,impressions,ctr,position`
- `gsc_pages_by_country_last30.csv` → columnas: `page,country,clicks,impressions,ctr,position`
- `gsc_queries_by_device_last30.csv` → columnas: `query,device,clicks,impressions,ctr,position`
- `gsc_queries_by_country_last30.csv` → columnas: `query,country,clicks,impressions,ctr,position`

Notas
- `ctr` se devuelve en porcentaje con dos decimales.
- Ordenación principal por `clicks` descendente donde aplica.
- Si el sitio es propiedad de dominio, usa el formato correcto en `GSC_SITE_URL`.