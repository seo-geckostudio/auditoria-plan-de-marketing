# 🚨 INSTRUCCIONES DE BACKUP MANUAL (3 PASOS SIMPLES)

El script automático tiene problemas de permisos. Aquí están las instrucciones **MUY SIMPLES** para hacer el backup manualmente:

---

## ✅ OPCIÓN 1: Usar Explorador de Windows (MÁS FÁCIL)

### Paso 1: Comprimir la carpeta del proyecto
1. Abre el Explorador de Windows
2. Ve a: `C:\ai\`
3. Clic derecho en la carpeta: `investigacionauditoria programacion`
4. Selecciona: **Enviar a → Carpeta comprimida (en ZIP)**
5. Se creará: `investigacionauditoria programacion.zip`
6. Renombrar a: `backup_proyecto_20251017.zip`

### Paso 2: Copiar configuración Claude Code
1. Abre el Explorador de Windows
2. En la barra de dirección escribe: `%USERPROFILE%\.claude`
3. Presiona Enter
4. Clic derecho en la carpeta `.claude`
5. Selecciona: **Enviar a → Carpeta comprimida (en ZIP)**
6. Renombrar a: `claude_config_20251017.zip`

### Paso 3: Copiar ambos ZIPs a USB
1. Conecta tu USB
2. Copia estos 2 archivos al USB:
   - `backup_proyecto_20251017.zip`
   - `claude_config_20251017.zip`

**¡LISTO!** 🎉

---

## ✅ OPCIÓN 2: Usar PowerShell (RÁPIDO)

### Abre PowerShell como Administrador
1. Presiona `Win + X`
2. Selecciona: **Windows PowerShell (Admin)** o **Terminal (Admin)**

### Ejecuta estos comandos uno por uno:

```powershell
# 1. Crear backup del proyecto
Compress-Archive -Path "C:\ai\investigacionauditoria programacion" -DestinationPath "$env:USERPROFILE\Desktop\backup_proyecto_20251017.zip" -Force

# 2. Crear backup de configuración Claude
Compress-Archive -Path "$env:USERPROFILE\.claude" -DestinationPath "$env:USERPROFILE\Desktop\claude_config_20251017.zip" -Force

# 3. Verificar que se crearon
Get-ChildItem "$env:USERPROFILE\Desktop\backup_*.zip"
```

### Resultado esperado:
```
backup_proyecto_20251017.zip     (50-200 MB)
claude_config_20251017.zip       (1-10 MB)
```

Ambos archivos estarán en tu **Escritorio**.

---

## ✅ OPCIÓN 3: Usar Git (SI TIENES REPOSITORIO REMOTO)

Si ya tienes el proyecto en GitHub/GitLab:

```bash
# 1. Commitear cambios
git add .
git commit -m "backup: estado antes de migración"

# 2. Subir a remoto
git push origin miguel/sync-2025-09-29

# 3. En nuevo PC solo hacer:
git clone [URL_DEL_REPOSITORIO]
git checkout miguel/sync-2025-09-29
```

**Ventaja**: No necesitas USB, todo está en la nube de Git.

**Desventaja**: No incluye configuración Claude Code (tendrías que copiarla aparte).

---

## 📋 ARCHIVOS IMPORTANTES A COPIAR

### Archivos del Backup (ambos necesarios):
- ✅ `backup_proyecto_20251017.zip` (proyecto completo)
- ✅ `claude_config_20251017.zip` (configuración MCP + conversaciones)

### Archivos para el nuevo PC (copiar también):
- ✅ `restaurar_proyecto.bat` (de la carpeta del proyecto)
- ✅ `LEER_PRIMERO_MIGRACION.md` (instrucciones)

---

## 🔍 VERIFICAR ANTES DE COPIAR

### Verifica que el ZIP del proyecto contiene:
1. Abre: `backup_proyecto_20251017.zip`
2. Debe contener carpetas:
   - `ibiza villa/`
   - `php/`
   - `node_modules/` (opcional, se puede reinstalar)
   - Archivos: `README.md`, `package.json`, etc.

### Verifica que el ZIP de Claude contiene:
1. Abre: `claude_config_20251017.zip`
2. Debe contener:
   - `mcp_config.json`
   - Carpeta `conversations/` (con archivos .json)
   - `settings.json`

Si ves estos archivos, ¡el backup está correcto! ✅

---

## 🆘 SI ALGO FALLA

### Error: "No se puede crear ZIP"
→ Intenta copiar la carpeta directamente a USB sin comprimir

### Error: "No encuentro .claude"
→ Es normal si Claude Code no se ha usado mucho. Solo copia el proyecto.

### Error: "El ZIP es muy grande (>2 GB)"
→ Probablemente incluye node_modules. Puedes:
  - Borrar `node_modules/` antes de comprimir
  - En nuevo PC ejecutar: `npm install`

---

## 📍 UBICACIONES DE LOS ARCHIVOS

### Después del backup, tus archivos estarán en:

**Proyecto comprimido**:
- `C:\ai\investigacionauditoria programacion.zip`
- O en tu Escritorio: `%USERPROFILE%\Desktop\backup_proyecto_20251017.zip`

**Claude Config comprimido**:
- `%USERPROFILE%\Desktop\claude_config_20251017.zip`

---

## ✅ CHECKLIST FINAL

Antes de apagar este PC, verifica:

- [ ] Archivo `backup_proyecto_20251017.zip` existe
- [ ] Archivo `claude_config_20251017.zip` existe (opcional)
- [ ] Tamaño del backup es razonable (50-200 MB)
- [ ] Archivos copiados a USB o nube
- [ ] Archivo `restaurar_proyecto.bat` copiado también

---

## 🟢 EN EL NUEVO PC

1. Copiar todos los ZIPs al nuevo ordenador
2. Abrir PowerShell como Admin
3. Ejecutar:

```powershell
# Extraer proyecto
Expand-Archive -Path "C:\Users\TuUsuario\Desktop\backup_proyecto_20251017.zip" -DestinationPath "C:\ai\" -Force

# Extraer configuración Claude
Expand-Archive -Path "C:\Users\TuUsuario\Desktop\claude_config_20251017.zip" -DestinationPath "$env:USERPROFILE\.claude\" -Force

# Instalar dependencias
cd "C:\ai\investigacionauditoria programacion"
npm install

# Iniciar servidor
.\iniciar_sistema.bat
```

---

**¡Eso es todo!** 🚀

Usa la **OPCIÓN 1** (Explorador de Windows) si no te sientes cómodo con comandos.

Es literalmente: Clic derecho → Enviar a → ZIP → Copiar a USB

**Tiempo total: 3 minutos** ⏱️
