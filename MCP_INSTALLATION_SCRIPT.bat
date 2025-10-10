@echo off
echo ========================================
echo INSTALACION DE MCPs PARA AUDITORIA SEO
echo ========================================
echo.

echo Instalando Google Search Console MCP...
npm install -g mcp-server-gsc
if %errorlevel% neq 0 (
    echo ERROR: Fallo la instalacion de Google Search Console MCP
    pause
    exit /b 1
)
echo ✓ Google Search Console MCP instalado correctamente
echo.

echo Instalando Google Analytics MCP...
npm install -g mcp-server-google-analytics
if %errorlevel% neq 0 (
    echo ERROR: Fallo la instalacion de Google Analytics MCP
    pause
    exit /b 1
)
echo ✓ Google Analytics MCP instalado correctamente
echo.

echo Instalando SEO AI Assistant MCP (Google Ads Keyword Planner)...
npm install -g @ayushsinghvi92/app-seo-ai
if %errorlevel% neq 0 (
    echo ERROR: Fallo la instalacion de SEO AI Assistant MCP
    pause
    exit /b 1
)
echo ✓ SEO AI Assistant MCP instalado correctamente
echo.

echo ========================================
echo INSTALACION COMPLETADA
echo ========================================
echo.
echo MCPs INSTALADOS:
echo ✓ Google Search Console (mcp-server-gsc)
echo ✓ Google Analytics (mcp-server-google-analytics)
echo ✓ SEO AI Assistant (@ayushsinghvi92/app-seo-ai)
echo.
echo PROXIMOS PASOS:
echo 1. Configurar credenciales en la carpeta 'credentials/'
echo 2. Seguir las instrucciones en CREDENTIALS_TEMPLATE.md
echo 3. Reiniciar Claude Desktop
echo.
echo MCPs NO DISPONIBLES (requieren alternativas):
echo ✗ DataForSEO (no disponible)
echo ✗ Coupler.io (no disponible)
echo.
echo Consulta ALTERNATIVAS_SIN_DATAFORSEO.md para opciones gratuitas
echo.
pause