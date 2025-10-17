# ⚡ Guía Rápida de Migración (5 minutos)

## 🔴 EN ORDENADOR ACTUAL (Antes de apagar)

### 1 minuto - Ejecutar backup automático

```bash
# Ir a la carpeta del proyecto
cd C:\ai\investigacionauditoria programacion

# Ejecutar script de backup
backup_proyecto.bat
```

**Resultado**: Archivo `C:\backup_proyecto_auditoria_YYYYMMDD.zip`

### 30 segundos - Copiar a USB/Nube

```bash
# Opción A: Copiar a USB
copy C:\backup_proyecto_auditoria_*.zip E:\

# Opción B: Copiar a OneDrive/Dropbox
copy C:\backup_proyecto_auditoria_*.zip "%USERPROFILE%\OneDrive\"
```

---

## 🟢 EN ORDENADOR NUEVO (Al llegar)

### 2 minutos - Instalar requisitos

Descargar e instalar en orden:
1. **Git**: https://git-scm.com/download/win (Next, Next, Finish)
2. **Node.js**: https://nodejs.org/ (versión LTS)
3. **Claude Code**: https://claude.com/code

(PHP ya está incluido portable en el proyecto)

### 2 minutos - Restaurar proyecto

```bash
# 1. Copiar backup ZIP y restaurar_proyecto.bat al escritorio
# 2. Ejecutar
restaurar_proyecto.bat

# 3. Cuando pida ruta del ZIP, escribir:
C:\Users\TuUsuario\Desktop\backup_proyecto_auditoria_20251017.zip
```

**Resultado**: Proyecto completo restaurado en `C:\ai\investigacionauditoria programacion`

### 30 segundos - Verificar

```bash
# Abrir proyecto en Claude Code
# Debería reconocer:
# - CLAUDE.md (instrucciones del proyecto)
# - MCP servers (ícono en status bar)
# - Historial de conversaciones (Ctrl+H)

# Iniciar servidor
cd C:\ai\investigacionauditoria programacion
iniciar_sistema.bat

# Abrir navegador
start http://localhost:8000
```

---

## ✅ Checklist Ultra-Rápido

### Ordenador Actual
- [ ] `backup_proyecto.bat` → Esperar a que termine
- [ ] Copiar ZIP a USB/nube
- [ ] Verificar que el archivo se copió (ver tamaño)

### Ordenador Nuevo
- [ ] Instalar Git, Node.js, Claude Code
- [ ] `restaurar_proyecto.bat` → Esperar a que termine
- [ ] Abrir Claude Code en `C:\ai\investigacionauditoria programacion`
- [ ] `iniciar_sistema.bat`
- [ ] Abrir `http://localhost:8000`

---

## 🚨 Troubleshooting Rápido

**Problema: Script de backup falla**
```bash
# Hacer backup manual
xcopy "C:\ai\investigacionauditoria programacion" "C:\backup\proyecto" /E /H /I
xcopy "%USERPROFILE%\.claude" "C:\backup\claude" /E /H /I
# Comprimir carpeta C:\backup manualmente (clic derecho → Comprimir)
```

**Problema: Script de restauración falla**
```bash
# Restaurar manual
# 1. Descomprimir ZIP en C:\ai
# 2. Renombrar carpeta a "investigacionauditoria programacion"
# 3. Copiar carpeta "claude" a %USERPROFILE%\.claude
# 4. cd al proyecto y ejecutar: npm install
```

**Problema: Puerto 8000 ocupado**
```bash
php -S localhost:8001
# Abrir http://localhost:8001
```

---

## 📞 Soporte Rápido

Si algo falla, tienes estos recursos:

1. **Guía completa**: `GUIA_MIGRACION_PROYECTO.md`
2. **README del proyecto**: `README.md`
3. **Instrucciones Claude**: `CLAUDE.md`
4. **Sistema de CSVs**: `SISTEMA_GENERACION_AUTOMATICA_CSVS.md`

---

**Tiempo total**: 5-6 minutos
