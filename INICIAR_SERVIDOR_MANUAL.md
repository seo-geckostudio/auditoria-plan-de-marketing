# 🚀 CÓMO INICIAR EL SERVIDOR MANUALMENTE

## ⚠️ PROBLEMA DETECTADO
El inicio automático del servidor PHP no está funcionando. Aquí tienes las soluciones:

---

## ✅ OPCIÓN 1: COMANDO MANUAL (RECOMENDADO)

### **Pasos:**

1. **Abrir CMD o PowerShell**
   - Presiona `Win + R`
   - Escribe `cmd` y Enter

2. **Navegar al directorio**
   ```cmd
   cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
   ```

3. **Iniciar servidor**
   ```cmd
   "C:\ai\investigacionauditoria programacion\php\php.exe" -S localhost:8000
   ```

4. **Abrir navegador**
   - Ir a: `http://localhost:8000/index.php`

5. **Detener servidor**
   - Presiona `Ctrl + C` en la ventana de CMD

---

## ✅ OPCIÓN 2: USAR ARCHIVO HTML ESTÁTICO

### **Ventajas:**
- ✅ No requiere servidor PHP
- ✅ Funciona directamente desde el explorador
- ✅ Más rápido para revisión

### **Pasos:**

1. Ir a la carpeta:
   ```
   C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA\
   ```

2. **Doble clic** en: `index.html`

3. Se abrirá en tu navegador predeterminado

### **Limitaciones:**
- ⚠️ No carga sistema modular dinámico
- ⚠️ Usa versión estática anterior
- ⚠️ No muestra panel de administración

---

## ✅ OPCIÓN 3: USAR BAT FILE (Windows)

### **Crear archivo de inicio rápido:**

1. Crear archivo: `iniciar_servidor.bat`

2. Contenido:
```batch
@echo off
title Auditoría SEO Ibiza Villa
cd /d "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
echo.
echo ================================================
echo   SERVIDOR AUDITORIA SEO - IBIZA VILLA
echo ================================================
echo.
echo Iniciando en http://localhost:8000
echo.
echo Presiona Ctrl+C para detener
echo.
start http://localhost:8000/index.php
"C:\ai\investigacionauditoria programacion\php\php.exe" -S localhost:8000
pause
```

3. **Doble clic** en `iniciar_servidor.bat`

---

## 🔧 SOLUCIÓN DE PROBLEMAS

### **Error: "PHP not found"**

**Verificar que PHP existe:**
```cmd
dir "C:\ai\investigacionauditoria programacion\php\php.exe"
```

**Si no existe, buscar PHP:**
```cmd
where php
```

**Si está en PATH:**
```cmd
cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
php -S localhost:8000
```

### **Error: "Port 8000 already in use"**

**Ver qué proceso usa el puerto:**
```cmd
netstat -ano | findstr :8000
```

**Matar el proceso:**
```cmd
taskkill /F /PID [NUMERO_PID]
```

**O usar otro puerto:**
```cmd
php -S localhost:8001
```
Luego ir a: `http://localhost:8001`

### **Error: "Cannot access index.php"**

**Verificar que estás en el directorio correcto:**
```cmd
dir index.php
```

Debe mostrar el archivo. Si no, navega al directorio correcto.

---

## 📱 VERIFICAR QUE FUNCIONA

### **Servidor PHP (index.php):**

1. Abrir: `http://localhost:8000/index.php`
2. Debe ver:
   - ✅ Portada con "Auditoría SEO - Ibiza Villa"
   - ✅ Sidebar derecho con navegación
   - ✅ Logo de Ibiza Villa
   - ✅ Colores verde corporativo

3. Presionar `Ctrl + Shift + A`:
   - ✅ Debe abrir panel de administración
   - ✅ Ver "17 módulos activos"

### **Versión HTML estática (index.html):**

1. Abrir: `index.html` desde explorador
2. Debe ver:
   - ✅ Diseño similar
   - ⚠️ Contenido estático (no dinámico)
   - ❌ No funciona panel admin

---

## 🎯 URLS IMPORTANTES

### **Con Servidor PHP:**
```
Principal:       http://localhost:8000/index.php
Panel Pruebas:   http://localhost:8000/test_module_loader.php
HTML Estático:   http://localhost:8000/index.html
```

### **Sin Servidor (Archivo Local):**
```
Archivo:  file:///C:/ai/investigacionauditoria%20programacion/ibiza%20villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/index.html
```

---

## ⚡ INICIO RÁPIDO PARA REVISIÓN

### **Si quieres VER AHORA:**

**1. Método más rápido:**
```
Doble clic en: index.html
```

**2. Método completo (para ver sistema modular):**
```cmd
# En CMD:
cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
"C:\ai\investigacionauditoria programacion\php\php.exe" -S localhost:8000

# En navegador:
http://localhost:8000/index.php
```

---

## 📞 AYUDA ADICIONAL

**¿No funciona nada?**

Prueba en este orden:

1. ✅ Abrir `index.html` directamente (sin servidor)
2. ✅ Usar Python como servidor alternativo:
   ```cmd
   cd "WEB_AUDITORIA"
   python -m http.server 8000
   ```
3. ✅ Usar Node.js con http-server:
   ```cmd
   npx http-server -p 8000
   ```

---

## 🎓 EXPLICACIÓN TÉCNICA

### **¿Por qué PHP?**
- El sistema modular (`index.php`) requiere PHP para:
  - Cargar configuración JSON
  - Renderizar módulos dinámicamente
  - Validar dependencias
  - Calcular estadísticas

### **¿Por qué funciona index.html?**
- Es la versión estática antigua
- No requiere servidor
- Útil para revisión rápida
- No incluye sistema modular v2.0

---

**RESUMEN:**
- 🟢 Para ver **AHORA**: Doble clic en `index.html`
- 🔵 Para ver **sistema completo**: Iniciar servidor PHP manualmente
- 🔴 Si nada funciona: Revisar rutas y permisos

**Última actualización:** 13 de Octubre de 2025
