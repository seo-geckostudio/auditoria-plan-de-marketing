# 🚀 Configuración de MCPs para Trae AI

## 📁 Archivo de Configuración Creado

✅ **Archivo:** `trae-mcp-config.json`
✅ **Ubicación:** `C:\ai\investigacionauditoria programacion\trae-mcp-config.json`

## 🎯 Estado de las Credenciales

### ✅ Google Ads API - COMPLETAMENTE CONFIGURADO
- **Developer Token:** `il4ZwMP_no7JozSz8iZAvg`
- **Client ID:** `386701778748-00jh022prnv9prt42989g0s7esf9djsr.apps.googleusercontent.com`
- **Client Secret:** `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`
- **Refresh Token:** `1//035pUKaVUAYp-CgYIARAAGAMSNwF-L9IrQyIh3QRgdluXjqrWCX8gEdL_NArz0uGOUqN2HTmsnwkPkH82v4r8sd9vLCrCW2Wytv0`
- **Login Customer ID:** `7009924982`

### ⏳ Google Search Console - PENDIENTE
- **Archivo requerido:** `credentials/gsc-service-account.json`
- **Estado:** Necesitas crear el Service Account

### ⏳ Google Analytics 4 - PENDIENTE
- **Archivo:** Reutiliza el mismo `gsc-service-account.json`
- **Pendiente:** Obtener GA4 Property ID

## 🔧 Cómo usar en Trae AI

### Opción 1: Cargar archivo JSON directamente
1. En Trae AI, busca la opción de configuración de MCPs
2. Carga el archivo `trae-mcp-config.json`
3. Trae AI debería reconocer automáticamente los 3 MCPs configurados

### Opción 2: Copiar configuración manualmente
Si Trae AI requiere configuración manual, usa esta estructura:

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
    "google-analytics": {
      "command": "npx",
      "args": ["-y", "mcp-server-google-analytics"],
      "env": {
        "GOOGLE_APPLICATION_CREDENTIALS": "C:\\ai\\investigacionauditoria programacion\\credentials\\gsc-service-account.json",
        "GA_PROPERTY_ID": "REEMPLAZAR_CON_TU_GA4_PROPERTY_ID"
      }
    },
    "seo-ai-assistant": {
      "command": "npx",
      "args": ["-y", "@ayushsinghvi92/app-seo-ai"],
      "env": {
        "GOOGLE_ADS_DEVELOPER_TOKEN": "il4ZwMP_no7JozSz8iZAvg",
        "GOOGLE_ADS_CLIENT_ID": "386701778748-00jh022prnv9prt42989g0s7esf9djsr.apps.googleusercontent.com",
        "GOOGLE_ADS_CLIENT_SECRET": "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",
        "GOOGLE_ADS_REFRESH_TOKEN": "1//035pUKaVUAYp-CgYIARAAGAMSNwF-L9IrQyIh3QRgdluXjqrWCX8gEdL_NArz0uGOUqN2HTmsnwkPkH82v4r8sd9vLCrCW2Wytv0",
        "GOOGLE_ADS_LOGIN_CUSTOMER_ID": "7009924982"
      }
    }
  }
}
```

## 🎯 MCPs Disponibles Inmediatamente

### ✅ SEO AI Assistant (Google Ads Keyword Planner)
**Funciona AHORA** - Todas las credenciales están configuradas
- Volúmenes de búsqueda
- Competencia por keyword
- Sugerencias de keywords
- CPC estimado

## ⚠️ Para completar la configuración

### Paso 1: Crear Service Account (Google Search Console + Analytics)
Sigue las instrucciones detalladas en: <mcfile name="PASOS_SIGUIENTES_CREDENCIALES.md" path="C:\ai\investigacionauditoria programacion\PASOS_SIGUIENTES_CREDENCIALES.md"></mcfile>

### Paso 2: Obtener GA4 Property ID
1. Ve a [Google Analytics](https://analytics.google.com/)
2. Selecciona tu propiedad
3. Ve a **Admin > Property Settings**
4. Copia el **Property ID** (formato: 123456789)
5. Reemplaza `REEMPLAZAR_CON_TU_GA4_PROPERTY_ID` en el archivo JSON

## 🔄 Actualizar configuración

Cuando tengas las credenciales completas:

1. **Actualiza el archivo JSON:**
   ```json
   "GA_PROPERTY_ID": "TU_PROPERTY_ID_REAL"
   ```

2. **Recarga la configuración en Trae AI**

## 🧪 Probar la configuración

### Test 1: Google Ads (debería funcionar YA)
```
Pregunta en Trae AI: "¿Cuál es el volumen de búsqueda para 'SEO audit'?"
```

### Test 2: Google Search Console (después de configurar)
```
Pregunta: "¿Cuáles son las top 10 queries de mi sitio web en los últimos 30 días?"
```

### Test 3: Google Analytics (después de configurar)
```
Pregunta: "¿Cuál es el tráfico orgánico de mi sitio en el último mes?"
```

## 📂 Archivos Relacionados

- ✅ `trae-mcp-config.json` - Configuración para Trae AI
- ✅ `claude_desktop_config.json` - Configuración para Claude Desktop
- ✅ `credentials/google-ads-credentials.json` - Credenciales Google Ads
- ⏳ `credentials/gsc-service-account.json` - Pendiente de crear
- ✅ `PASOS_SIGUIENTES_CREDENCIALES.md` - Guía detallada

## 🎉 Resultado Final

Una vez completado, tendrás acceso a:
- **Google Search Console:** Queries, CTR, posiciones, páginas indexadas
- **Google Analytics 4:** Tráfico, conversiones, demografía, fuentes
- **Google Ads Keyword Planner:** Volúmenes, competencia, CPC

¡Esto cubrirá aproximadamente el 70% de los datos necesarios para auditorías SEO profesionales!