# MCP: Extracción automática de datos GA4

Este script obtiene datos de Google Analytics 4 y genera los CSVs necesarios en `../assets/data/custom/` para activar los gráficos del informe.

## Requisitos
- Node.js 16+
- Un **Service Account** con acceso de lector a la propiedad GA4
- Archivo JSON de credenciales del Service Account

## Instalación

1. En esta carpeta, inicializa dependencias:

   ```
   npm init -y
   npm i @google-analytics/data dotenv
   ```

2. Copia `.env.example` a `.env` y rellena valores:

   ```
   GA4_PROPERTY_ID=XXXXXXXX
   GOOGLE_APPLICATION_CREDENTIALS=C:\ruta\a\tu\service-account.json
   ```

3. Ejecuta la extracción:

   ```
   node fetch_ga4_data.js
   ```

## CSVs generados
- `search_engines_last30.csv` → columnas: `source,sessions`
- `pageviews_by_country_last30.csv` → `country,screenPageViews`
- `pageviews_by_device_last30.csv` → `deviceCategory,screenPageViews`
- `pages_sample.csv` → `pagePath,screenPageViews`
- `channels_last365.csv` → `channelGroup,sessions,sessionsPct,revenuePct`
- `organic_sessions_yoy_last12.csv` → `month,sessions_prev,sessions_curr`
- `organic_conversions_by_month_last12.csv` → `month,conversions`

Los gráficos del informe se activan automáticamente al existir estos archivos en `assets/data/custom/`.

## Notas
- `revenuePct` queda vacío: GA4 no expone ingresos agregados sin e-commerce clarificado.
- Se filtran canales por `sessionDefaultChannelGroup = Organic Search` donde aplica.