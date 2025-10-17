# 📦 Guía de Migración del Proyecto a Nuevo Ordenador

**Fecha**: 2025-10-17
**Propósito**: Migrar completamente el proyecto de auditoría SEO, incluyendo código, documentación, MCP servers y conversaciones de Claude Code.

---

## 📋 Checklist de Migración

### 1. Código y Documentación del Proyecto
- [ ] Repositorio Git completo
- [ ] Base de datos SQLite
- [ ] Archivos de configuración
- [ ] Datos de ejemplo/tests
- [ ] PHP portable (si aplica)

### 2. Configuración de Claude Code
- [ ] MCP servers configurados
- [ ] Historial de conversaciones
- [ ] Settings y preferencias
- [ ] Comandos slash personalizados

### 3. Entorno de Desarrollo
- [ ] PHP instalado y configurado
- [ ] Node.js y npm
- [ ] Git configurado
- [ ] Variables de entorno

---

## 🗂️ Estructura a Migrar

### A) Proyecto Principal

```
C:\ai\investigacionauditoria programacion\
├── .git/                          # Repositorio Git completo
├── ibiza villa/                   # Proyecto web
│   └── FASE_5_ENTREGABLES_FINALES/
│       └── WEB_AUDITORIA/
│           ├── config/            # Configuraciones
│           ├── data/              # Base de datos SQLite
│           ├── includes/          # PHP core
│           ├── modules/           # Módulos
│           ├── entregables/       # CSVs generados
│           ├── js/                # JavaScript
│           ├── css/               # Estilos
│           └── api/               # Endpoints
├── php/                           # PHP portable (Windows)
├── node_modules/                  # Dependencias npm
├── package.json                   # Dependencias proyecto
├── playwright.config.ts           # Config tests
├── *.md                           # Documentación
└── tests/                         # Tests E2E
```

### B) Configuración de Claude Code

```
C:\Users\[Usuario]\.claude\
├── mcp_config.json                # Configuración MCP servers
├── settings.json                  # Preferencias Claude Code
├── conversations/                 # Historial de conversaciones
│   ├── [conversation-id-1].json
│   ├── [conversation-id-2].json
│   └── ...
└── todos/                         # Listas de tareas
```

### C) Configuración Desktop (opcional)

```
C:\Users\[Usuario]\AppData\Roaming\Claude\
├── claude_desktop_config.json     # Config MCP para desktop app
└── logs/                          # Logs de MCP servers
```

---

## 🚀 Proceso de Migración

### PASO 1: Preparar Backup en Ordenador Actual

#### 1.1 Verificar estado del repositorio Git

```bash
cd "C:\ai\investigacionauditoria programacion"

# Ver estado actual
git status

# Ver commits pendientes
git log --oneline -10

# Verificar rama actual
git branch

# Ver archivos sin commitear
git diff --stat
```

#### 1.2 Commitear cambios pendientes (si hay)

```bash
# Añadir todos los cambios
git add .

# Crear commit de backup
git commit -m "backup: estado antes de migración a nuevo ordenador"

# Verificar que todo está commiteado
git status
```

#### 1.3 Crear backup completo del proyecto

```bash
# Crear carpeta de backup
mkdir C:\backup_proyecto_auditoria

# Copiar proyecto completo (incluyendo .git)
xcopy "C:\ai\investigacionauditoria programacion" "C:\backup_proyecto_auditoria\proyecto" /E /H /I

# Copiar configuración Claude Code
xcopy "%USERPROFILE%\.claude" "C:\backup_proyecto_auditoria\claude_config" /E /H /I

# Copiar configuración Desktop (si existe)
xcopy "%APPDATA%\Claude" "C:\backup_proyecto_auditoria\claude_desktop" /E /H /I
```

#### 1.4 Exportar base de datos (backup adicional)

```bash
cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"

# Crear dump SQL de la base de datos SQLite
sqlite3 data/auditoria_seo.sqlite .dump > C:\backup_proyecto_auditoria\database_backup.sql

# Verificar que se creó
dir C:\backup_proyecto_auditoria\database_backup.sql
```

#### 1.5 Comprimir backup

```powershell
# Usando PowerShell
Compress-Archive -Path "C:\backup_proyecto_auditoria\*" -DestinationPath "C:\backup_proyecto_auditoria.zip"
```

**Resultado**: `C:\backup_proyecto_auditoria.zip` (copiar a USB, nube, o nuevo ordenador)

---

### PASO 2: Transferir Archivos al Nuevo Ordenador

#### Opciones de transferencia:

**Opción A: USB/Disco externo**
```bash
# Copiar a USB
copy C:\backup_proyecto_auditoria.zip E:\
```

**Opción B: Red local**
```bash
# Compartir carpeta y acceder desde nuevo PC
# O usar: robocopy "C:\backup_proyecto_auditoria" "\\NUEVO-PC\compartida" /MIR
```

**Opción C: Nube (OneDrive/Dropbox/Google Drive)**
```bash
# Copiar a carpeta sincronizada
copy C:\backup_proyecto_auditoria.zip "%USERPROFILE%\OneDrive\"
```

**Opción D: Repositorio Git remoto (RECOMENDADO)**
```bash
# Si tienes GitHub/GitLab configurado
cd "C:\ai\investigacionauditoria programacion"

# Subir a remoto
git push origin miguel/sync-2025-09-29

# En nuevo PC, solo hacer:
git clone [URL_REPOSITORIO]
```

---

### PASO 3: Configurar Nuevo Ordenador

#### 3.1 Instalar requisitos previos

**Software necesario:**
- [ ] **Git**: https://git-scm.com/download/win
- [ ] **Node.js 18+**: https://nodejs.org/
- [ ] **PHP 8.1+** (portable o instalado)
- [ ] **Claude Code**: Descargar de claude.ai/code
- [ ] **VS Code** (opcional): https://code.visualstudio.com/

```bash
# Verificar instalaciones
git --version
node --version
npm --version
php --version
```

#### 3.2 Restaurar proyecto

```bash
# Crear estructura de directorios
mkdir C:\ai
cd C:\ai

# Opción A: Desde backup ZIP
Expand-Archive -Path "C:\backup_proyecto_auditoria.zip" -DestinationPath "C:\ai"
move "C:\ai\backup_proyecto_auditoria\proyecto" "C:\ai\investigacionauditoria programacion"

# Opción B: Desde Git remoto (RECOMENDADO)
git clone [URL_REPO] "investigacionauditoria programacion"
cd "investigacionauditoria programacion"
git checkout miguel/sync-2025-09-29
```

#### 3.3 Instalar dependencias

```bash
cd "C:\ai\investigacionauditoria programacion"

# Instalar dependencias npm
npm install

# Verificar instalación
npm test
```

#### 3.4 Restaurar configuración de Claude Code

```bash
# Copiar configuración MCP
xcopy "C:\backup_proyecto_auditoria\claude_config\.claude" "%USERPROFILE%\.claude" /E /H /I

# Copiar configuración Desktop (si aplica)
xcopy "C:\backup_proyecto_auditoria\claude_desktop\Claude" "%APPDATA%\Claude" /E /H /I
```

#### 3.5 Verificar MCP servers

```bash
# Verificar que los MCP servers están configurados
type "%USERPROFILE%\.claude\mcp_config.json"

# Debería mostrar algo como:
{
  "mcpServers": {
    "@playwright/mcp": {
      "command": "npx",
      "args": ["-y", "@playwright/mcp", "--headless"]
    },
    ...
  }
}
```

---

### PASO 4: Verificar Funcionamiento

#### 4.1 Iniciar servidor de desarrollo

```bash
cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"

# Opción 1: Script automático
iniciar_sistema.bat

# Opción 2: Manual
php -S localhost:8000

# Abrir navegador
start http://localhost:8000
```

#### 4.2 Verificar base de datos

```bash
# Conectar a SQLite
sqlite3 data/auditoria_seo.sqlite

# Verificar tablas
.tables

# Ver auditorías
SELECT id, nombre_cliente, fecha_creacion FROM auditorias;

# Salir
.quit
```

#### 4.3 Ejecutar tests

```bash
cd "C:\ai\investigacionauditoria programacion"

# Ejecutar tests Playwright
npm test

# Ver reporte
npm run test:report
```

#### 4.4 Verificar Claude Code

```bash
# Abrir Claude Code en el proyecto
cd "C:\ai\investigacionauditoria programacion"
code .  # O abrir manualmente

# Verificar que reconoce:
# - CLAUDE.md
# - MCP servers en status bar
# - Historial de conversaciones (si se migró)
```

---

## 🔧 Configuración Específica de MCP Servers

### Archivo: `C:\Users\[Usuario]\.claude\mcp_config.json`

```json
{
  "mcpServers": {
    "@playwright/mcp": {
      "command": "npx",
      "args": ["-y", "@playwright/mcp", "--headless"]
    },
    "@modelcontextprotocol/server-memory": {
      "command": "npx",
      "args": ["-y", "@modelcontextprotocol/server-memory"]
    },
    "@modelcontextprotocol/server-sequential-thinking": {
      "command": "npx",
      "args": ["-y", "@modelcontextprotocol/server-sequential-thinking"]
    },
    "@upstash/context7-mcp": {
      "command": "npx",
      "args": ["-y", "@upstash/context7-mcp"]
    }
  }
}
```

**Para recrear en nuevo PC:**

1. Crear archivo manualmente
2. O copiar desde backup
3. Reiniciar Claude Code para aplicar cambios

---

## 📝 Migración de Conversaciones

### Ubicación de conversaciones

```
%USERPROFILE%\.claude\conversations\
├── 948c4508-64d3-44fd-a434-94e6f97c6754.json  # Conversación 1
├── a7b3c2d1-5e6f-4a8b-9c0d-1e2f3a4b5c6d.json  # Conversación 2
└── ...
```

### Cómo migrar

```bash
# En ordenador ACTUAL - Exportar conversaciones importantes
mkdir C:\backup_proyecto_auditoria\conversaciones_importantes

# Copiar últimas 10 conversaciones (las más recientes)
for /f "skip=1" %i in ('dir /b /o-d "%USERPROFILE%\.claude\conversations\*.json"') do @copy "%USERPROFILE%\.claude\conversations\%i" "C:\backup_proyecto_auditoria\conversaciones_importantes\" && if exist "C:\backup_proyecto_auditoria\conversaciones_importantes\*.json" (echo Copiadas 10 conversaciones && goto :done)
:done

# En ordenador NUEVO - Restaurar
xcopy "C:\backup_proyecto_auditoria\conversaciones_importantes\*" "%USERPROFILE%\.claude\conversations\" /Y
```

### Ver contenido de conversación (opcional)

```powershell
# PowerShell - Ver resumen de conversación
$json = Get-Content "%USERPROFILE%\.claude\conversations\[ID].json" | ConvertFrom-Json
$json.messages | Select-Object -First 5 role, content
```

---

## 🔐 Configuración Sensible

### Archivos a NO versionar (ya en .gitignore)

```
config/database_config.php      # Credenciales DB
.env                             # Variables de entorno
data/*.sqlite                    # Base de datos con datos reales
uploads/                         # Archivos subidos por usuarios
```

### Recrear archivos de configuración

```bash
# En nuevo PC
cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"

# Copiar template de configuración
copy config\database_config.template.php config\database_config.php

# Editar con credenciales correctas
notepad config\database_config.php
```

---

## ✅ Checklist de Verificación Final

### En ordenador NUEVO, verificar:

- [ ] **Git funciona**
  ```bash
  git status
  git log --oneline -5
  ```

- [ ] **Base de datos accesible**
  ```bash
  php check_database.php
  ```

- [ ] **Servidor web funciona**
  ```bash
  php -S localhost:8000
  # Abrir http://localhost:8000
  ```

- [ ] **Tests pasan**
  ```bash
  npm test
  ```

- [ ] **MCP servers conectados**
  - Abrir Claude Code
  - Verificar status bar (ícono MCP)
  - Probar comando que use MCP

- [ ] **Conversaciones restauradas**
  - Abrir Claude Code
  - Ver historial (Cmd/Ctrl + H)
  - Verificar conversaciones recientes

- [ ] **Documentación accesible**
  ```bash
  dir *.md
  # Debe listar: README.md, CLAUDE.md, SISTEMA_GENERACION_AUTOMATICA_CSVS.md, etc.
  ```

- [ ] **Entregables generados**
  ```bash
  dir "ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA\entregables" /s
  ```

---

## 🚨 Troubleshooting

### Problema: Git no reconoce el repositorio

**Solución:**
```bash
cd "C:\ai\investigacionauditoria programacion"
git init
git remote add origin [URL_REMOTO]
git fetch
git checkout miguel/sync-2025-09-29
```

### Problema: SQLite no funciona

**Solución:**
```bash
# Verificar extensión PHP
php -m | findstr sqlite

# Si no aparece, habilitar en php.ini
# Descomentar: extension=sqlite3
```

### Problema: MCP servers no conectan

**Solución:**
```bash
# Verificar Node.js
node --version

# Reinstalar MCP servers globalmente
npm install -g @playwright/mcp
npm install -g @modelcontextprotocol/server-memory

# Reiniciar Claude Code
```

### Problema: Puerto 8000 ocupado

**Solución:**
```bash
# Verificar qué usa el puerto
netstat -ano | findstr :8000

# Usar otro puerto
php -S localhost:8001
```

---

## 📦 Script Automático de Backup

**Archivo:** `backup_proyecto.bat`

```batch
@echo off
echo ========================================
echo   BACKUP PROYECTO AUDITORIA SEO
echo ========================================
echo.

SET BACKUP_DIR=C:\backup_proyecto_auditoria_%date:~-4,4%%date:~-10,2%%date:~-7,2%
SET PROYECTO_DIR=C:\ai\investigacionauditoria programacion

echo Creando directorio de backup: %BACKUP_DIR%
mkdir "%BACKUP_DIR%"

echo.
echo [1/5] Copiando proyecto completo...
xcopy "%PROYECTO_DIR%" "%BACKUP_DIR%\proyecto" /E /H /I /Y

echo.
echo [2/5] Copiando configuracion Claude Code...
xcopy "%USERPROFILE%\.claude" "%BACKUP_DIR%\claude_config" /E /H /I /Y

echo.
echo [3/5] Exportando base de datos...
cd "%PROYECTO_DIR%\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
sqlite3 data\auditoria_seo.sqlite .dump > "%BACKUP_DIR%\database_backup.sql"

echo.
echo [4/5] Creando listado de archivos...
dir "%BACKUP_DIR%" /S > "%BACKUP_DIR%\archivos_backup.txt"

echo.
echo [5/5] Comprimiendo backup...
powershell Compress-Archive -Path "%BACKUP_DIR%\*" -DestinationPath "%BACKUP_DIR%.zip" -Force

echo.
echo ========================================
echo   BACKUP COMPLETADO
echo ========================================
echo.
echo Archivo creado: %BACKUP_DIR%.zip
echo Tamano:
dir "%BACKUP_DIR%.zip" | findstr .zip
echo.
echo Copiar este archivo al nuevo ordenador
echo.
pause
```

**Uso:**
```bash
# Ejecutar en ordenador actual
backup_proyecto.bat

# Resultado: C:\backup_proyecto_auditoria_20251017.zip
```

---

## 📦 Script Automático de Restauración

**Archivo:** `restaurar_proyecto.bat`

```batch
@echo off
echo ========================================
echo   RESTAURAR PROYECTO AUDITORIA SEO
echo ========================================
echo.

SET /P BACKUP_ZIP="Ruta completa del archivo ZIP de backup: "

echo.
echo Verificando archivo...
if not exist "%BACKUP_ZIP%" (
    echo ERROR: Archivo no encontrado: %BACKUP_ZIP%
    pause
    exit /b
)

echo.
echo [1/6] Creando estructura de directorios...
mkdir C:\ai

echo.
echo [2/6] Extrayendo backup...
powershell Expand-Archive -Path "%BACKUP_ZIP%" -DestinationPath "C:\ai\temp_restore" -Force

echo.
echo [3/6] Moviendo proyecto...
move "C:\ai\temp_restore\proyecto" "C:\ai\investigacionauditoria programacion"

echo.
echo [4/6] Restaurando configuracion Claude Code...
xcopy "C:\ai\temp_restore\claude_config\.claude" "%USERPROFILE%\.claude" /E /H /I /Y

echo.
echo [5/6] Instalando dependencias npm...
cd "C:\ai\investigacionauditoria programacion"
call npm install

echo.
echo [6/6] Limpiando archivos temporales...
rmdir /S /Q "C:\ai\temp_restore"

echo.
echo ========================================
echo   RESTAURACION COMPLETADA
echo ========================================
echo.
echo Proyecto restaurado en: C:\ai\investigacionauditoria programacion
echo.
echo Siguiente paso:
echo   1. Abrir Claude Code en la carpeta del proyecto
echo   2. Ejecutar: iniciar_sistema.bat
echo   3. Abrir: http://localhost:8000
echo.
pause
```

**Uso en nuevo ordenador:**
```bash
# 1. Copiar backup ZIP y restaurar_proyecto.bat al nuevo PC
# 2. Ejecutar
restaurar_proyecto.bat

# 3. Cuando pregunte, escribir ruta del ZIP:
# C:\Users\Usuario\Downloads\backup_proyecto_auditoria_20251017.zip
```

---

## 📚 Documentos a Llevar

### Documentación del proyecto (ya en Git)
- ✅ `README.md` - Guía de inicio rápido
- ✅ `CLAUDE.md` - Instrucciones para Claude Code
- ✅ `DOCUMENTACION_INTERNA_SISTEMA.md` - Arquitectura del sistema
- ✅ `SISTEMA_GENERACION_AUTOMATICA_CSVS.md` - Sistema de CSVs
- ✅ `PATRON_MODULOS_EDUCATIVOS_ENTREGABLES.md` - Patrón de diseño
- ✅ `RESUMEN_IMPLEMENTACION_AUDITORIA_EDUCATIVA.md` - Estado actual
- ✅ Esta guía: `GUIA_MIGRACION_PROYECTO.md`

### Archivos de configuración
- ✅ `package.json` - Dependencias npm
- ✅ `playwright.config.ts` - Config tests
- ✅ `.gitignore` - Archivos a ignorar
- ✅ `trae-mcp-config.json` - Config MCP servers
- ✅ `iniciar_sistema.bat` - Script de inicio

---

## 🎯 Resumen Ejecutivo

### Ordenador ACTUAL (hacer ANTES de apagar):

1. **Commitear cambios pendientes**
   ```bash
   git add . && git commit -m "backup: estado final antes de migración"
   ```

2. **Ejecutar backup automático**
   ```bash
   backup_proyecto.bat
   ```

3. **Copiar archivo ZIP resultante** a USB/nube:
   ```
   C:\backup_proyecto_auditoria_[FECHA].zip
   ```

### Ordenador NUEVO (hacer AL LLEGAR):

1. **Instalar requisitos**: Git, Node.js, PHP, Claude Code

2. **Ejecutar restauración automática**
   ```bash
   restaurar_proyecto.bat
   ```

3. **Verificar funcionamiento**
   ```bash
   cd "C:\ai\investigacionauditoria programacion"
   npm test
   iniciar_sistema.bat
   ```

4. **Abrir Claude Code** y continuar trabajando

---

**Tiempo estimado de migración**: 30-45 minutos

**Última actualización**: 2025-10-17
