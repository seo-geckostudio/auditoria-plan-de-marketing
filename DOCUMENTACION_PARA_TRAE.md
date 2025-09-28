# 📋 DOCUMENTACIÓN PARA TRAE - ESTADO DEL PROYECTO

## 🎯 **CONTEXTO DEL PROYECTO**

**Objetivo:** Sistema web PHP para gestionar auditorías SEO con 5 fases y 47+ documentos por auditoría.

**Usuario final:** Consultores SEO que necesitan:
1. Crear auditorías para clientes
2. Ir completando documentos paso a paso
3. Usar 3 métodos de entrada: formularios, upload archivos, importar CSV
4. Generar informes finales

## ✅ **ESTADO ACTUAL COMPLETADO**

### **Base Técnica (100% funcional):**
- ✅ Base de datos SQLite con esquema completo
- ✅ Sistema PHP MVC bien estructurado
- ✅ Módulos: auditorías, clientes, archivos
- ✅ Sistema de upload de archivos funcionando
- ✅ Documentación metodológica completa (5 fases)
- ✅ Tests Playwright configurados

### **Archivos Clave Existentes:**
```
├── index.php (punto entrada + enrutador)
├── config/database.php (conexión SQLite)
├── modules/auditorias.php (CRUD auditorías)
├── modules/archivos.php (upload files)
├── views/auditorias/upload_file.php (funcional)
├── database_schema.sql (esquema completo)
├── generacion-auditorias.md (metodología 5 fases)
└── resumen-documentos-necesarios.md (47 documentos)
```

## 🔧 **MCPs INSTALADOS PARA DESARROLLO**

```bash
# MCPs activos para Claude Code:
✅ file-operations: Manejo avanzado archivos (CSV, PDF, Excel)
✅ web-scraper: Scraping para análisis competencia
❌ sqlite: Falló instalación (usar alternativa)

# Comando verificación:
claude mcp list
```

## 🚨 **FUNCIONALIDADES FALTANTES (CRÍTICAS)**

### **1. Sistema de Formularios Dinámicos**
**Estado:** ❌ No existe
**Urgencia:** ALTA
**Para qué:** Capturar datos estructurados (brief cliente, objetivos, etc.)

**Implementación necesaria:**
```sql
-- Tablas requeridas:
CREATE TABLE paso_campos (
    id INTEGER PRIMARY KEY,
    paso_plantilla_id INTEGER,
    nombre_campo TEXT,
    tipo_campo TEXT, -- text, textarea, select, number
    etiqueta TEXT,
    opciones TEXT, -- JSON para selects
    obligatorio INTEGER,
    orden INTEGER
);

CREATE TABLE paso_datos (
    id INTEGER PRIMARY KEY,
    auditoria_paso_id INTEGER,
    campo_id INTEGER,
    valor TEXT
);
```

### **2. Importador de CSV**
**Estado:** ❌ No existe
**Urgencia:** ALTA
**Para qué:** Importar exports de GSC, Ahrefs, Screaming Frog

**Implementación necesaria:**
```sql
CREATE TABLE csv_configuraciones (
    id INTEGER PRIMARY KEY,
    paso_plantilla_id INTEGER,
    nombre_configuracion TEXT,
    columnas_esperadas TEXT, -- JSON
    separador TEXT DEFAULT ','
);

CREATE TABLE csv_datos (
    id INTEGER PRIMARY KEY,
    auditoria_paso_id INTEGER,
    fila_numero INTEGER,
    datos_json TEXT
);
```

### **3. Selector de Método por Paso**
**Estado:** ❌ No existe
**Para qué:** Elegir entre formulario/archivo/CSV según el paso

## 📊 **EJEMPLOS DE USO REAL**

### **Caso 1: Brief Cliente (FASE 1)**
- **Método:** Solo formulario
- **Campos:** empresa, sector, URL, objetivos
- **Estado:** Falta implementar formulario dinámico

### **Caso 2: Keywords Actuales (FASE 2)**
- **Método:** CSV (desde GSC) + formulario (análisis)
- **CSV esperado:** consulta, impresiones, clics, posición
- **Estado:** Falta importador CSV

### **Caso 3: Competencia (FASE 2)**
- **Método:** CSV (desde Ahrefs) + formulario manual
- **CSV esperado:** dominio, keywords, tráfico, DR
- **Estado:** Falta ambos sistemas

## 🚀 **PLAN DE IMPLEMENTACIÓN INMEDIATO**

### **PRIORIDAD 1: Formularios Dinámicos (Semana 1)**
1. Crear tablas `paso_campos` y `paso_datos`
2. Función PHP `generarCampoFormulario($campo)`
3. Vista `views/auditorias/formulario_paso.php`
4. AJAX para guardar datos
5. Configurar 5 pasos básicos

### **PRIORIDAD 2: Importador CSV (Semana 2)**
1. Crear tablas CSV
2. Función `procesarCSV($archivo, $config)`
3. Vista con mapeo de columnas
4. Validaciones de datos
5. Preview antes de importar

### **PRIORIDAD 3: Integración UX (Semana 3)**
1. Selector de método por paso
2. Dashboard progreso visual
3. Mensajes de error/éxito
4. Navegación entre pasos

## 📁 **ESTRUCTURA DE ARCHIVOS A CREAR**

```
├── modules/
│   ├── formularios.php (nuevo)
│   └── csv_processor.php (nuevo)
├── views/auditorias/
│   ├── formulario_paso.php (nuevo)
│   ├── importar_csv.php (nuevo)
│   └── seleccionar_metodo.php (nuevo)
├── config/
│   └── plantillas_campos.php (nuevo)
└── api/
    ├── guardar_formulario.php (nuevo)
    └── procesar_csv.php (nuevo)
```

## 🎯 **PRÓXIMO PASO PARA TRAE**

**EMPEZAR POR:** Sistema de formularios dinámicos
**ARCHIVO:** `modules/formularios.php`
**OBJETIVO:** Que el usuario pueda completar el "Brief Cliente" con un formulario

**Comando para continuar:**
```bash
# Verificar estado actual
php -f index.php
# Crear primera tabla
sqlite3 data/auditoria_seo.sqlite < nueva_tabla.sql
```

## 📞 **PUNTOS DE COORDINACIÓN CON USUARIO**

1. **Metodología:** Los 47 documentos están definidos en carpetas FASE_X
2. **Herramientas:** GSC, Ahrefs, Screaming Frog (formatos CSV específicos)
3. **Enfoque:** Versión 1 = 100% manual, Versión 2 = automatización IA
4. **Estilo código:** Mantener el estilo PHP actual (funcional, no OOP)

---
**Fecha:** 2025-09-27
**Claude Code Sesión:** Finalizada por límite de tiempo
**Siguiente:** Continuar con Trae en formularios dinámicos