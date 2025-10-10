# GUÍA DE CONFIGURACIÓN MCP PARA AUDITORÍA SEO

## 🎯 OBJETIVO
Configurar los Model Context Protocols (MCP) necesarios para obtener datos reales de SEO y reemplazar los datos ficticios en nuestras auditorías.

## 📋 MCPs REQUERIDOS

### 1. 🔍 GOOGLE SEARCH CONSOLE MCP
**Servidor:** `mcp-server-gsc`
**Datos obtenidos:**
- Queries de búsqueda (últimos 16 meses)
- Impresiones, clics, CTR, posición promedio
- Páginas indexadas y rendimiento
- Datos por país, dispositivo, tipo de búsqueda
- Errores de indexación

### 2. 📊 DATAFORSEO MCP
**Servidor:** Oficial DataForSEO
**Datos obtenidos:**
- Volúmenes de búsqueda por keyword
- Análisis de competencia SERP
- Datos de backlinks (limitados)
- Keyword research y sugerencias
- Datos de ranking por ubicación

### 3. 🎯 GOOGLE KEYWORD PLANNER MCP
**Servidor:** `seo-ai-assistant`
**Datos obtenidos:**
- Volúmenes de búsqueda
- Competencia por keyword
- Sugerencias de keywords
- Tendencias estacionales

## 🛠️ INSTALACIÓN Y CONFIGURACIÓN

### PASO 1: Instalar Google Search Console MCP

```bash
# Instalación automática con Smithery
npx -y @smithery/cli install mcp-server-gsc --client claude

# O instalación manual
npm install mcp-server-gsc
```

**Configuración de autenticación:**
1. Ir a [Google Cloud Console](https://console.cloud.google.com/)
2. Crear proyecto o seleccionar existente
3. Habilitar "Search Console API"
4. Crear Service Account y descargar credenciales JSON
5. Agregar el email del Service Account como administrador en Search Console

### PASO 2: Instalar DataForSEO MCP

```bash
# Seguir documentación oficial en dataforseo.com/model-context-protocol
# Requiere cuenta DataForSEO con API access
```

**Configuración:**
1. Crear cuenta en DataForSEO
2. Obtener API credentials
3. Configurar límites de uso según plan

### PASO 3: Instalar Google Keyword Planner MCP

```bash
# Instalación del servidor seo-ai-assistant
# Seguir instrucciones en glama.ai/mcp/servers/@ayushsinghvi92/app-seo-ai
```

## 📁 CONFIGURACIÓN CLAUDE DESKTOP

Crear/editar archivo de configuración:
- **Windows:** `%APPDATA%\Claude\claude_desktop_config.json`
- **macOS:** `~/Library/Application Support/Claude/claude_desktop_config.json`
- **Linux:** `~/.config/Claude/claude_desktop_config.json`

```json
{
  "mcpServers": {
    "gsc": {
      "command": "npx",
      "args": ["-y", "mcp-server-gsc"],
      "env": {
        "GOOGLE_APPLICATION_CREDENTIALS": "/ruta/a/credenciales.json"
      }
    },
    "dataforseo": {
      "command": "dataforseo-mcp-server",
      "env": {
        "DATAFORSEO_LOGIN": "tu_login",
        "DATAFORSEO_PASSWORD": "tu_password"
      }
    },
    "keyword-planner": {
      "command": "seo-ai-assistant",
      "env": {
        "GOOGLE_ADS_DEVELOPER_TOKEN": "tu_token",
        "GOOGLE_ADS_CLIENT_ID": "tu_client_id",
        "GOOGLE_ADS_CLIENT_SECRET": "tu_secret"
      }
    }
  }
}
```

## 🔐 CREDENCIALES NECESARIAS

### Google Search Console
- ✅ Service Account JSON (Google Cloud)
- ✅ Acceso como administrador en Search Console
- ✅ Search Console API habilitada

### DataForSEO
- ✅ Cuenta DataForSEO activa
- ✅ API Login y Password
- ✅ Créditos suficientes para consultas

### Google Keyword Planner
- ✅ Cuenta Google Ads
- ✅ Developer Token
- ✅ OAuth2 Client ID y Secret

## 🎯 DATOS ESPECÍFICOS POR FASE

### FASE_0_MARKETING_DIGITAL
**MCP:** DataForSEO + Google Keyword Planner
- Volúmenes de búsqueda por sector
- Tendencias estacionales
- Análisis de competencia básico

### FASE_1_PREPARACION
**MCP:** Google Search Console
- Verificación de acceso a propiedades
- Estado actual de indexación
- Errores críticos existentes

### FASE_2_KEYWORD_RESEARCH
**MCP:** Google Search Console + DataForSEO
- Queries actuales con rendimiento
- Oportunidades de keywords
- Análisis de competencia SERP

### FASE_3_ARQUITECTURA
**MCP:** Google Search Console
- Páginas indexadas vs. no indexadas
- Estructura de URLs actual
- Problemas de crawling

### FASE_4_RECOPILACION_DATOS
**MCP:** Todos los configurados
- Consolidación de datos de todas las fuentes
- Validación de métricas
- Preparación para entregables

## ⚠️ LIMITACIONES Y ALTERNATIVAS

### Datos NO disponibles por MCP:
- **Ahrefs completo:** Usar DataForSEO como alternativa
- **Screaming Frog:** Exportar manualmente o usar APIs de crawling
- **Google Trends:** Usar bibliotecas Python como `pytrends`

### Métodos alternativos:
1. **Para Ahrefs:** DataForSEO ofrece datos similares de backlinks y DR
2. **Para crawling:** APIs como OnCrawl, DeepCrawl o Botify
3. **Para Trends:** Integración directa con Google Trends API

## 🚀 PRÓXIMOS PASOS

1. **Configurar credenciales** para cada servicio
2. **Probar conexiones** MCP individualmente
3. **Integrar datos** en las plantillas existentes
4. **Validar calidad** de datos obtenidos
5. **Documentar flujos** de actualización de datos

## 📞 SOPORTE

- **Google Search Console MCP:** [GitHub Issues](https://github.com/ahonn/mcp-server-gsc)
- **DataForSEO MCP:** [Help Center](https://dataforseo.com/help-center)
- **Documentación MCP:** [Model Context Protocol](https://modelcontextprotocol.io/)

---
*Última actualización: Enero 2025*