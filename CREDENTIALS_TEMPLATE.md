# PLANTILLA DE CREDENCIALES PARA MCPs

## RESUMEN
Esta guía te ayudará a configurar las credenciales necesarias para los MCPs disponibles:
- ✅ **Google Search Console** (GSC)
- ✅ **Google Analytics 4** (GA4)
- ✅ **Google Keyword Planner** (via Google Ads API)

---

## 1. GOOGLE SEARCH CONSOLE (GSC)

### Pasos para obtener credenciales:
1. Ve a [Google Cloud Console](https://console.cloud.google.com/)
2. Crea un nuevo proyecto o selecciona uno existente
3. Habilita la API de Google Search Console
4. Ve a "Credenciales" → "Crear credenciales" → "Cuenta de servicio"
5. Descarga el archivo JSON de la cuenta de servicio
6. Guarda el archivo como `gsc-service-account.json` en la carpeta `credentials/`

### Archivo requerido:
```
credentials/gsc-service-account.json
```

### Permisos necesarios:
- Agregar la cuenta de servicio como usuario en Google Search Console
- Nivel de acceso: "Propietario completo" o "Usuario completo"

---

## 2. GOOGLE ANALYTICS 4 (GA4)

### Pasos para obtener credenciales:
1. Ve a [Google Cloud Console](https://console.cloud.google.com/)
2. En el mismo proyecto (o crea uno nuevo)
3. Habilita la API de Google Analytics Reporting API v4
4. Habilita la API de Google Analytics Data API
5. Crea una cuenta de servicio (o usa la misma del GSC)
6. Descarga el archivo JSON de la cuenta de servicio
7. Guarda el archivo como `ga4-service-account.json` en la carpeta `credentials/`

### Archivo requerido:
```
credentials/ga4-service-account.json
```

### Permisos necesarios:
- Agregar la cuenta de servicio como usuario en Google Analytics
- Nivel de acceso: "Visualizador" (mínimo) o "Analista"

---

## 3. GOOGLE KEYWORD PLANNER (Google Ads API)

### Pasos para obtener credenciales:
1. Ve a [Google Ads API Center](https://developers.google.com/google-ads/api)
2. Crea una aplicación en Google Cloud Console
3. Habilita la Google Ads API
4. Obtén las credenciales OAuth2
5. Solicita acceso al Google Ads API (puede requerir aprobación)

### Variables de entorno requeridas:
```
GOOGLE_ADS_DEVELOPER_TOKEN=tu_developer_token
GOOGLE_ADS_CLIENT_ID=tu_client_id
GOOGLE_ADS_CLIENT_SECRET=tu_client_secret
GOOGLE_ADS_REFRESH_TOKEN=tu_refresh_token
```

### Archivo de configuración:
```json
{
  "developer_token": "TU_DEVELOPER_TOKEN",
  "client_id": "TU_CLIENT_ID",
  "client_secret": "TU_CLIENT_SECRET",
  "refresh_token": "TU_REFRESH_TOKEN"
}
```
Guarda como `credentials/google-ads-credentials.json`

---

## ESTRUCTURA DE ARCHIVOS ESPERADA

```
credentials/
├── gsc-service-account.json      # Google Search Console
├── ga4-service-account.json      # Google Analytics 4
├── google-ads-credentials.json   # Google Ads API
└── README.md                     # Guía de seguridad
```

---

## COBERTURA DE DATOS

### Con estos MCPs podrás obtener:

**FASE_0_MARKETING_DIGITAL:**
- ✅ Datos demográficos (GA4)
- ✅ Tráfico orgánico (GSC + GA4)
- ✅ Volúmenes de búsqueda (Google Keyword Planner)
- ❌ Google Trends (requiere alternativa)

**FASE_1_PREPARACION:**
- ✅ Configuración GA4 y GSC
- ✅ Datos de acceso técnico

**FASE_2_KEYWORD_RESEARCH:**
- ✅ Consultas GSC
- ✅ Volúmenes de búsqueda (Keyword Planner)
- ❌ Datos competitivos (requiere alternativas gratuitas)

**FASE_3_ARQUITECTURA:**
- ✅ Páginas indexadas (GSC)
- ❌ Crawl técnico (requiere Screaming Frog)

**FASE_4_RECOPILACION_DATOS:**
- ✅ Eventos GA4
- ✅ Métricas de rendimiento (GSC + GA4)

---

## SEGURIDAD

### Reglas importantes:
1. **NUNCA** subas estos archivos a repositorios públicos
2. **NUNCA** compartas credenciales por email o chat
3. Usa permisos mínimos necesarios
4. Rota credenciales cada 90 días
5. Mantén backups seguros

### Variables de entorno (alternativa):
Puedes usar variables de entorno en lugar de archivos JSON:
```bash
set GOOGLE_APPLICATION_CREDENTIALS=C:\path\to\credentials\gsc-service-account.json
set GA4_CREDENTIALS=C:\path\to\credentials\ga4-service-account.json
```

---

## PRÓXIMOS PASOS PRIORIZADOS

1. **INMEDIATO:** Configurar Google Search Console (datos más críticos)
2. **IMPORTANTE:** Configurar Google Analytics 4 (métricas de tráfico)
3. **OPCIONAL:** Configurar Google Ads API (volúmenes de búsqueda)

### Para datos no disponibles via MCP:
- Consulta `ALTERNATIVAS_SIN_DATAFORSEO.md`
- Usa herramientas gratuitas como Ubersuggest, AnswerThePublic
- Implementa scraping ético para Google Trends

### ❌ SERVICIOS NO DISPONIBLES

#### 3. DATAFORSEO ❌ SIN ACCESO
**Alternativas gratuitas:**
- Ubersuggest (3 búsquedas/día)
- SEMrush versión gratuita (10 consultas/día)
- Google Keyword Planner (disponible via MCP)

#### 4. COUPLER.IO ❌ SIN ACCESO
**Alternativas:**
- Exportación manual de GSC/GA4
- Scripts personalizados con APIs gratuitas
- Zapier (versión gratuita limitada)

## 📁 ESTRUCTURA DE ARCHIVOS SIMPLIFICADA

```
C:\ai\investigacionauditoria programacion\
├── credentials\
│   ├── gsc-service-account.json
│   └── README.md
├── claude_desktop_config.json (solo GSC + Google Ads)
└── ALTERNATIVAS_SIN_DATAFORSEO.md
```

## ⚠️ SEGURIDAD

### IMPORTANTE:
- ❌ **NUNCA** subir credenciales a repositorios públicos
- ✅ Agregar `credentials/` a `.gitignore`
- ✅ Usar variables de entorno para datos sensibles
- ✅ Rotar credenciales periódicamente
- ✅ Limitar permisos de Service Accounts al mínimo necesario

### Archivo .gitignore recomendado:
```
credentials/
*.json
.env
claude_desktop_config.json
```

## 🔄 CONFIGURACIÓN SIMPLIFICADA

### 1. Configurar solo MCPs disponibles:
```json
{
  "mcpServers": {
    "gsc": {
      "command": "npx",
      "args": ["-y", "mcp-server-gsc"],
      "env": {
        "GOOGLE_APPLICATION_CREDENTIALS": "C:\\ai\\investigacionauditoria programacion\\credentials\\gsc-service-account.json"
      }
    },
    "seo-ai-assistant": {
      "command": "npx",
      "args": ["-y", "@ayushsinghvi92/app-seo-ai"],
      "env": {
        "GOOGLE_ADS_DEVELOPER_TOKEN": "TU_GOOGLE_ADS_DEVELOPER_TOKEN",
        "GOOGLE_ADS_CLIENT_ID": "TU_GOOGLE_ADS_CLIENT_ID",
        "GOOGLE_ADS_CLIENT_SECRET": "TU_GOOGLE_ADS_CLIENT_SECRET",
        "GOOGLE_ADS_REFRESH_TOKEN": "TU_GOOGLE_ADS_REFRESH_TOKEN"
      }
    }
  }
}
```

### 2. Instalar solo MCPs necesarios:
```bash
# Google Search Console
npx -y @smithery/cli install mcp-server-gsc --client claude

# Google Keyword Planner
npm install -g @ayushsinghvi92/app-seo-ai
```

## 📊 COBERTURA DE DATOS

### ✅ DATOS DISPONIBLES (70%):
- **GSC:** Queries, páginas, CTR, posiciones, errores
- **Google Keyword Planner:** Volúmenes, competencia, CPC
- **APIs gratuitas:** PageSpeed, Lighthouse, Trends

### ❌ DATOS LIMITADOS (30%):
- **Backlinks:** Solo básicos de GSC
- **Competencia:** Limitado a herramientas gratuitas
- **Análisis técnico:** Sin Screaming Frog
- **Datos históricos:** Períodos más cortos

## 🎯 PRÓXIMOS PASOS PRIORITARIOS

1. **Configurar GSC Service Account** (crítico)
2. **Configurar Google Ads API** (importante)
3. **Revisar alternativas gratuitas** (complementario)
4. **Crear flujo de trabajo híbrido** (manual + automático)

---
*Configuración optimizada para trabajar sin DataForSEO ni Coupler.io*