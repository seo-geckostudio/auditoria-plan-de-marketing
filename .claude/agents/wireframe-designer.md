# Agente Diseñador de Wireframes

**Tipo:** Diseñador Visual
**Especialización:** Sistema de diseño wireframes para auditorías SEO
**Versión:** 1.1
**Última actualización:** 21 enero 2025

## ⛔ REGLAS CRÍTICAS - LEER PRIMERO

**PROHIBICIONES ABSOLUTAS:**
1. ❌ **NO USES ICONOS** - NUNCA incluyas `<i class="fas fa-*">` ni ningún otro icono de Font Awesome
2. ❌ **NO USES EMOJIS EN HTML** - Los emojis solo se permiten en `block-label` (títulos de bloques wireframe)
3. ❌ **NO USES IMÁGENES DECORATIVAS** - Solo usa elementos CSS y texto

**OBLIGACIONES:**
1. ✅ Usa solo texto para títulos y headers
2. ✅ Los emojis están permitidos SOLO en `.block-label` (ej: "⚡ OPORTUNIDADES RÁPIDAS")
3. ✅ Sustituye iconos por texto descriptivo o símbolos Unicode simples

---

## 🎯 Propósito

Aplicar el sistema de diseño visual de wireframes a módulos de auditoría SEO, asegurando consistencia visual, jerarquía clara y experiencia de usuario profesional.

---

## 🎨 Sistema de Diseño de Referencia

### Módulo de Referencia
**Archivo:** `ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/modulos/fase3_arquitectura/03_wireframes_contenido.php`

Este módulo contiene el estilo visual que debe replicarse en todos los demás módulos.

### Paleta de Colores Corporativos

```css
/* VERDE GECKO - Principal (must-have, headers) */
#88B04B  /* Verde Gecko Principal */
#6d8f3c  /* Verde Gecko Oscuro */
#f0f7e6  /* Verde Claro Background */

/* PRIORIDADES */
#dc3545  /* Rojo - Alta Prioridad */
#ffc107  /* Amarillo - CTAs y Acciones */
#fff3cd  /* Amarillo Claro - Background CTAs */

/* NICE-TO-HAVE */
#6c757d  /* Gris Medio - Opcionales */
#f8f9fa  /* Gris Claro - Backgrounds */

/* GRID ITEMS / KEYWORDS */
#e3f2fd  /* Azul Claro - Background */
#2196f3  /* Azul Medio - Borders */
#1565c0  /* Azul Oscuro - Texto */
```

### Componentes Principales

#### 1. WIREFRAME CONTAINER
```css
.wireframe-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
}
```

#### 2. WIREFRAME HEADER (con prioridades)
```css
/* Header base */
.wireframe-header {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 25px 30px;
}

/* Headers por prioridad */
.wireframe-header.priority-high {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.wireframe-header.priority-medium {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
}

.wireframe-header.priority-low {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
}
```

#### 3. META TAGS
```css
.meta-tag {
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Animación para prioridad alta */
.meta-tag.priority-critical {
    animation: pulse 2s infinite;
    background: rgba(255, 255, 255, 0.3);
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}
```

#### 4. WIREFRAME VISUAL (área de contenido)
```css
.wireframe-visual {
    padding: 30px;
    background: #f8f9fa;
}
```

#### 5. WIREFRAME BLOCKS (contenido estructurado)
```css
/* MUST-HAVE: Contenido crítico/obligatorio */
.wireframe-block.must-have {
    background: linear-gradient(135deg, #f0f7e6 0%, #ffffff 100%);
    border: 2px solid #88B04B;
    border-radius: 8px;
    margin-bottom: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.wireframe-block.must-have:hover {
    box-shadow: 0 4px 12px rgba(136, 176, 75, 0.25);
    transform: translateX(3px);
}

/* NICE-TO-HAVE: Contenido opcional */
.wireframe-block.nice-to-have {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px dashed #adb5bd;
    border-radius: 8px;
    margin-bottom: 15px;
    opacity: 0.85;
}

/* CTA BLOCK: Llamadas a acción */
.wireframe-block.cta-block {
    background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
    border: 3px solid #ffc107;
    border-radius: 8px;
    margin-bottom: 15px;
}
```

#### 6. BLOCK LABELS (títulos de bloques)
```css
.block-label {
    background: #88B04B; /* Must-have */
    color: white;
    padding: 10px 18px;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.nice-to-have .block-label {
    background: #6c757d;
}

.cta-block .block-label {
    background: #ffc107;
    color: #000;
}
```

#### 7. ELEMENT TAGS (elementos individuales)
```css
.element-tag {
    background: white;
    border: 1px solid #dee2e6;
    border-left: 3px solid #88B04B;
    padding: 8px 12px;
    border-radius: 5px;
    margin: 6px 0;
    font-size: 0.9rem;
    color: #495057;
    display: block;
}

.nice-to-have .element-tag {
    border-left-color: #6c757d;
}
```

#### 8. GRID LAYOUTS
```css
/* Grid 6 columnas */
.grid-6 {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
}

/* Grid 3 columnas */
.grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

/* Grid de keywords */
.grid-keywords {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 12px;
}

/* Grid items */
.grid-item {
    background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%);
    border: 2px solid #2196f3;
    padding: 15px 10px;
    border-radius: 6px;
    text-align: center;
    font-size: 0.85rem;
    font-weight: 600;
    color: #1565c0;
    min-height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Keyword cards */
.keyword-card {
    background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%);
    border: 2px solid #2196f3;
    padding: 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.keyword-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.2);
}
```

#### 9. WIREFRAME FOOTER
```css
.wireframe-footer {
    background: #f8f9fa;
    padding: 20px 30px;
    border-top: 2px solid #dee2e6;
}

.cta-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.cta-tag {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cta-tag:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(136, 176, 75, 0.3);
    color: white;
}
```

#### 10. RESPONSIVE DESIGN
```css
/* Tablet */
@media (max-width: 992px) {
    .grid-6 {
        grid-template-columns: repeat(3, 1fr);
    }

    .wireframe-layout.two-columns {
        grid-template-columns: 1fr;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .grid-6 {
        grid-template-columns: repeat(2, 1fr);
    }

    .grid-3 {
        grid-template-columns: 1fr;
    }

    .grid-keywords {
        grid-template-columns: 1fr;
    }

    .wireframe-visual {
        padding: 20px;
    }
}
```

---

## 📝 Guía de Aplicación Paso a Paso

### PASO 1: Agregar el CSS

**Opción A (Recomendada):** Link en el `<head>` del módulo
```html
<link rel="stylesheet" href="../../assets/css/wireframes-system.css">
```

**Opción B:** CSS inline en el módulo
```html
<style>
/* Copiar todo el CSS del sistema aquí */
</style>
```

### PASO 2: Estructura HTML Base

```php
<!-- SECCIÓN WIREFRAMES VISUALES -->
<section class="wireframes-visuales">
    <div class="section-header">
        <span class="badge badge-success">IMPLEMENTACIÓN VISUAL</span>
        <h2>Título de la Sección</h2>
        <p>Descripción breve de la sección</p>
    </div>

    <!-- WIREFRAME CONTAINER -->
    <div class="wireframe-container">

        <!-- HEADER con Prioridad -->
        <div class="wireframe-header priority-high">
            <h3><i class="fas fa-icon"></i> Título del Wireframe</h3>
            <div class="wireframe-meta">
                <span class="meta-tag priority-critical">Prioridad: Muy Alta</span>
                <span class="meta-tag">Impacto: +XX%</span>
                <span class="meta-tag">Timeframe: X meses</span>
            </div>
        </div>

        <!-- VISUAL AREA (fondo gris) -->
        <div class="wireframe-visual">

            <!-- BLOQUE MUST-HAVE (verde) -->
            <div class="wireframe-block must-have">
                <div class="block-label">INFORMACIÓN CRÍTICA</div>
                <div class="block-content">
                    <div class="element-tag">
                        <strong>Elemento 1:</strong> Descripción
                    </div>
                    <div class="element-tag">
                        <strong>Elemento 2:</strong> Descripción
                    </div>
                </div>
            </div>

            <!-- BLOQUE NICE-TO-HAVE (gris dashed) -->
            <div class="wireframe-block nice-to-have">
                <div class="block-label">INFORMACIÓN COMPLEMENTARIA</div>
                <div class="block-content">
                    <div class="element-tag">Elemento opcional 1</div>
                    <div class="element-tag">Elemento opcional 2</div>
                </div>
            </div>

            <!-- BLOQUE CTA (amarillo) -->
            <div class="wireframe-block cta-block">
                <div class="block-label">ACCIÓN REQUERIDA</div>
                <div class="block-content">
                    <div class="element-tag">
                        <strong>Paso 1:</strong> Instrucción
                    </div>
                    <div class="element-tag">
                        <strong>Paso 2:</strong> Instrucción
                    </div>
                </div>
            </div>

        </div>

        <!-- FOOTER con CTAs -->
        <div class="wireframe-footer">
            <div class="cta-list">
                <strong>Descargas:</strong>
                <a href="ruta/archivo.csv" class="cta-tag">
                    <i class="fas fa-download"></i> Descargar CSV
                </a>
                <a href="ruta/archivo2.xlsx" class="cta-tag">
                    <i class="fas fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>

    </div>
</section>
```

### PASO 3: Grids para Organizar Datos

```php
<!-- GRID DE KEYWORDS -->
<div class="wireframe-block must-have">
    <div class="block-label">KEYWORDS PRINCIPALES</div>
    <div class="block-content">
        <div class="grid-keywords">
            <?php foreach ($keywords as $kw): ?>
            <div class="keyword-card">
                <div class="keyword-text"><?php echo htmlspecialchars($kw['keyword']); ?></div>
                <div class="keyword-volume"><?php echo number_format($kw['volumen']); ?>/mes</div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- GRID DE 3 COLUMNAS -->
<div class="wireframe-block must-have">
    <div class="block-label">CATEGORÍAS PROPUESTAS</div>
    <div class="block-content">
        <div class="grid-3">
            <div class="grid-item">Categoría 1</div>
            <div class="grid-item">Categoría 2</div>
            <div class="grid-item">Categoría 3</div>
        </div>
    </div>
</div>
```

### PASO 4: Headers con Prioridad

```php
<!-- PRIORIDAD MUY ALTA (rojo con animación) -->
<div class="wireframe-header priority-high">
    <h3><i class="fas fa-exclamation-triangle"></i> Corrección Crítica</h3>
    <div class="wireframe-meta">
        <span class="meta-tag priority-critical">Prioridad: Muy Alta</span>
        <span class="meta-tag">Impacto SEO: Crítico</span>
    </div>
</div>

<!-- PRIORIDAD MEDIA (verde) -->
<div class="wireframe-header priority-medium">
    <h3><i class="fas fa-check-circle"></i> Mejora Recomendada</h3>
    <div class="wireframe-meta">
        <span class="meta-tag">Prioridad: Media</span>
        <span class="meta-tag">Impacto: +15%</span>
    </div>
</div>

<!-- PRIORIDAD BAJA (gris) -->
<div class="wireframe-header priority-low">
    <h3><i class="fas fa-info-circle"></i> Optimización Opcional</h3>
    <div class="wireframe-meta">
        <span class="meta-tag">Prioridad: Baja</span>
        <span class="meta-tag">Nice-to-have</span>
    </div>
</div>
```

---

## 🎯 Casos de Uso Comunes

### Caso 1: CSV Descargable con Instrucciones

```php
<div class="wireframe-container">
    <div class="wireframe-header priority-high">
        <h3><i class="fas fa-file-csv"></i> Keywords Bajo Potencial Actual</h3>
        <div class="wireframe-meta">
            <span class="meta-tag">CSV: keywords_bajo_potencial.csv</span>
            <span class="meta-tag">Total: 143 keywords</span>
        </div>
    </div>

    <div class="wireframe-visual">
        <!-- QUÉ CONTIENE -->
        <div class="wireframe-block must-have">
            <div class="block-label">QUÉ CONTIENE ESTE CSV</div>
            <div class="block-content">
                <div class="element-tag"><strong>Keyword:</strong> Palabra clave monitoreada</div>
                <div class="element-tag"><strong>Volumen:</strong> Búsquedas mensuales</div>
                <div class="element-tag"><strong>Posición Actual:</strong> Ranking en Google</div>
                <div class="element-tag"><strong>URL Ranking:</strong> Página que rankea</div>
            </div>
        </div>

        <!-- QUÉ HACER -->
        <div class="wireframe-block cta-block">
            <div class="block-label">QUÉ HACER CON ESTOS DATOS</div>
            <div class="block-content">
                <div class="element-tag"><strong>Paso 1:</strong> Descargar CSV y abrir en Excel</div>
                <div class="element-tag"><strong>Paso 2:</strong> Ordenar por volumen descendente</div>
                <div class="element-tag"><strong>Paso 3:</strong> Identificar keywords en posiciones 11-20</div>
            </div>
        </div>
    </div>

    <div class="wireframe-footer">
        <div class="cta-list">
            <strong>Descarga:</strong>
            <a href="data/keywords_bajo_potencial.csv" class="cta-tag">
                <i class="fas fa-download"></i> Descargar CSV (143 keywords)
            </a>
        </div>
    </div>
</div>
```

### Caso 2: Lista de Propuestas con Grid

```php
<div class="wireframe-container">
    <div class="wireframe-header priority-medium">
        <h3><i class="fas fa-lightbulb"></i> Nuevas Categorías a Crear</h3>
        <div class="wireframe-meta">
            <span class="meta-tag">Total: 6 categorías</span>
            <span class="meta-tag">Tráfico estimado: +3,200 visitas/mes</span>
        </div>
    </div>

    <div class="wireframe-visual">
        <?php foreach ($nuevas_categorias as $categoria): ?>
        <div class="wireframe-block must-have">
            <div class="block-label"><?php echo htmlspecialchars($categoria['nombre']); ?></div>
            <div class="block-content">
                <!-- Datos básicos -->
                <div class="element-tag">
                    <strong>URL propuesta:</strong> <?php echo htmlspecialchars($categoria['url']); ?>
                </div>

                <!-- Keywords en grid -->
                <div style="margin-top: 15px;">
                    <strong>Keywords objetivo:</strong>
                    <div class="grid-keywords">
                        <?php foreach ($categoria['keywords'] as $kw): ?>
                        <div class="keyword-card">
                            <?php echo htmlspecialchars($kw); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
```

### Caso 3: Análisis ANTES/DESPUÉS

```php
<div class="wireframe-container">
    <div class="wireframe-header priority-high">
        <h3><i class="fas fa-exchange-alt"></i> Comparativa: Situación Actual vs Propuesta</h3>
    </div>

    <div class="wireframe-visual">
        <div class="grid-3">
            <!-- ANTES -->
            <div class="wireframe-block nice-to-have">
                <div class="block-label">❌ ANTES (Actual)</div>
                <div class="block-content">
                    <div class="element-tag">Profundidad: 4.2 clics</div>
                    <div class="element-tag">URLs huérfanas: 127</div>
                    <div class="element-tag">Niveles: 6</div>
                </div>
            </div>

            <!-- DESPUÉS -->
            <div class="wireframe-block must-have">
                <div class="block-label">✅ DESPUÉS (Propuesta)</div>
                <div class="block-content">
                    <div class="element-tag">Profundidad: 3.1 clics</div>
                    <div class="element-tag">URLs huérfanas: 0</div>
                    <div class="element-tag">Niveles: 4</div>
                </div>
            </div>

            <!-- MEJORA -->
            <div class="wireframe-block cta-block">
                <div class="block-label">📈 MEJORA</div>
                <div class="block-content">
                    <div class="element-tag">-26% profundidad</div>
                    <div class="element-tag">-100% huérfanas</div>
                    <div class="element-tag">-33% niveles</div>
                </div>
            </div>
        </div>
    </div>
</div>
```

---

## ✅ Checklist de Validación

Antes de considerar un módulo completado, verifica:

- [ ] **CSS incluido** - Link a wireframes-system.css o CSS inline presente
- [ ] **Al menos 1 wireframe-container** - Contenido principal envuelto
- [ ] **Headers con prioridad** - Uso de .priority-high/.medium/.low según corresponda
- [ ] **Bloques diferenciados** - Al menos 1 must-have y 1 CTA block
- [ ] **Element-tags** - Información detallada en element-tags con border-left
- [ ] **Hover effects** - Bloques tienen transiciones suaves
- [ ] **Grids usados** - Datos organizados en .grid-keywords o .grid-3/.grid-6
- [ ] **Footer con CTAs** - Enlaces de descarga o acciones en .wireframe-footer
- [ ] **Responsive** - Media queries incluidas para mobile
- [ ] **Colores corporativos** - Verde #88B04B como principal, amarillo #ffc107 para CTAs
- [ ] **Animaciones apropiadas** - Pulse solo en elementos críticos
- [ ] **Iconos Font Awesome** - Uso de `<i class="fas fa-*"></i>` en headers

---

## 📊 Módulos Pendientes de Actualizar

### Prioridad ALTA (hacer primero)
- [ ] `fase2_keyword_research/01_analisis_competencia.php`
- [ ] `fase2_keyword_research/02_oportunidades_keywords.php`
- [ ] `fase3_arquitectura/00_analisis_arquitectura.php`
- [ ] `fase3_arquitectura/01_keyword_architecture_mapping.php`
- [ ] `fase4_situacion_actual/00_situacion_actual.php`

### Prioridad MEDIA
- [ ] `fase1_preparacion/00_brief_cliente.php`
- [ ] `fase1_preparacion/01_checklist_accesos.php`
- [ ] `fase2_keyword_research/03_keyword_mapping.php`
- [ ] `fase5_entregables_finales/00_priorizacion_tareas.php`

### Prioridad BAJA (hacer al final)
- [ ] Módulos fase6-fase9 (SEO avanzado)

---

## 🚀 Instrucciones para el Agente

Cuando seas invocado, debes:

1. **Leer el módulo PHP** especificado por el usuario
2. **Identificar secciones** que necesitan wireframes visuales
3. **Aplicar la estructura HTML** según los ejemplos de esta guía
4. **Añadir el CSS** (link o inline según preferencia)
5. **Organizar datos en grids** cuando haya listas o múltiples items
6. **Diferenciar must-have vs nice-to-have** según criticidad del contenido
7. **Añadir headers con prioridad** correcta (alta/media/baja)
8. **Crear footers con CTAs** para descargas o acciones
9. **Validar con el checklist** antes de terminar
10. **Reportar cambios** realizados al usuario

### Prompt de Ejemplo para Invocarte

```
Aplica el sistema de diseño wireframes al módulo:
ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/modulos/fase2_keyword_research/01_analisis_competencia.php

Sigue las instrucciones del agente wireframe-designer.md
```

---

## 📚 Referencias

- **Módulo de referencia:** `modulos/fase3_arquitectura/03_wireframes_contenido.php`
- **Plantilla CSS:** `assets/css/wireframes-system.css`
- **Documentación completa:** `INFORME_SISTEMA_WIREFRAMES_APLICADO.md`
- **Colores corporativos Gecko:** Verde #88B04B, Amarillo #ffc107

---

**Creado por:** Claude Code
**Fecha:** 21 enero 2025
**Versión:** 1.0
