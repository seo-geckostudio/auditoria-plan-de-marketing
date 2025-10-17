# 🚨 LEER PRIMERO - Migración al Nuevo Ordenador

## ⚡ ACCIÓN INMEDIATA - Hacer AHORA (2 minutos)

### Paso 1: Ejecutar Backup Automático

Abre una terminal en esta carpeta y ejecuta:

```bash
backup_proyecto.bat
```

**Qué hace el script**:
- ✅ Detecta cambios pendientes en Git y los commitea
- ✅ Copia todo el proyecto (código, .git, documentación)
- ✅ Exporta configuración de Claude Code (~/.claude/)
- ✅ Exporta historial de conversaciones
- ✅ Exporta configuración de MCP servers
- ✅ Hace dump de la base de datos SQLite
- ✅ Comprime todo en un archivo ZIP

**Resultado**: `C:\backup_proyecto_auditoria_[FECHA].zip`

### Paso 2: Copiar ZIP a Lugar Seguro

Copia el archivo ZIP a:
- 🔵 USB (recomendado)
- 🔵 OneDrive/Google Drive
- 🔵 Email a ti mismo

### Paso 3: Verificar

Verifica que el archivo ZIP tiene un tamaño razonable (debería ser 50-200 MB dependiendo de los datos).

---

## 📦 Archivos a Copiar al Nuevo Ordenador

Copiar estos 2 archivos al nuevo PC (escritorio):

1. ✅ `C:\backup_proyecto_auditoria_[FECHA].zip` (el backup)
2. ✅ `restaurar_proyecto.bat` (el script de restauración)

---

## 🟢 En el Nuevo Ordenador - Hacer AL LLEGAR

### Paso 1: Instalar Requisitos (3 minutos)

Descargar e instalar en orden:

1. **Git**: https://git-scm.com/download/win
2. **Node.js**: https://nodejs.org/ (versión LTS)
3. **Claude Code**: https://claude.com/code

### Paso 2: Restaurar Proyecto (2 minutos)

Doble clic en: `restaurar_proyecto.bat`

Cuando pida la ruta del ZIP, escribir:
```
C:\Users\[TuUsuario]\Desktop\backup_proyecto_auditoria_20251017.zip
```

### Paso 3: Verificar (1 minuto)

```bash
cd C:\ai\investigacionauditoria programacion
iniciar_sistema.bat
```

Abrir navegador: http://localhost:8000

Si la página carga, ¡migración exitosa! 🎉

---

## 📚 Documentación Disponible

Si necesitas más ayuda, tienes estos archivos:

### Para Migración
- 📄 **INSTRUCCIONES_MIGRACION.txt** - Instrucciones visuales paso a paso
- 📄 **MIGRACION_RAPIDA.md** - Guía ultra-rápida (5 minutos)
- 📄 **GUIA_MIGRACION_PROYECTO.md** - Guía completa con troubleshooting
- 📄 **RESUMEN_SESION_MIGRACION.md** - Resumen de esta sesión

### Para el Proyecto
- 📄 **README.md** - Guía de inicio rápido
- 📄 **CLAUDE.md** - Instrucciones para Claude Code
- 📄 **SISTEMA_GENERACION_AUTOMATICA_CSVS.md** - Sistema de CSVs automáticos

---

## ✅ Checklist Rápido

### En Este Ordenador (Actual)
- [ ] Ejecutar `backup_proyecto.bat`
- [ ] Copiar ZIP a USB/nube
- [ ] Verificar que el ZIP se copió correctamente

### En Nuevo Ordenador
- [ ] Instalar Git, Node.js, Claude Code
- [ ] Copiar ZIP y `restaurar_proyecto.bat` al escritorio
- [ ] Ejecutar `restaurar_proyecto.bat`
- [ ] Abrir Claude Code en `C:\ai\investigacionauditoria programacion`
- [ ] Ejecutar `iniciar_sistema.bat`
- [ ] Abrir http://localhost:8000

---

## 🆘 Si Algo Falla

### Script de backup no funciona
→ Ver: **GUIA_MIGRACION_PROYECTO.md** sección "Backup Manual"

### Script de restauración no funciona
→ Ver: **GUIA_MIGRACION_PROYECTO.md** sección "Restauración Manual"

### Puerto 8000 ocupado
→ Ejecutar: `php -S localhost:8001`
→ Abrir: http://localhost:8001

---

## 🎯 Resumen Ultra-Rápido

**AHORA (2 min)**:
1. `backup_proyecto.bat`
2. Copiar ZIP a USB

**NUEVO PC (5 min)**:
1. Instalar Git, Node.js, Claude Code
2. `restaurar_proyecto.bat`
3. Abrir Claude Code y verificar

**TOTAL: 7 minutos** ⏱️

---

## 📊 Qué Se Migra

✅ Todo el código del proyecto
✅ Todo el historial de Git
✅ Base de datos SQLite completa
✅ Configuración de MCP servers
✅ Historial de conversaciones de Claude Code
✅ Toda la documentación
✅ Tests Playwright
✅ Dependencias npm
✅ PHP portable

**¡No se pierde NADA!** 🎉

---

**Última actualización**: 2025-10-17
**Estado**: Todo listo para migrar
**Próxima acción**: Ejecutar `backup_proyecto.bat`
