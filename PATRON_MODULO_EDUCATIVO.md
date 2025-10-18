# 📘 PATRÓN MÓDULO EDUCATIVO - Guía de Replicación

**Versión**: 1.0
**Basado en**: Prototipo Arquitectura (commit c252a4a3)
**Tiempo de implementación**: 2-3 horas por módulo

---

## 🎯 OBJETIVO

Esta guía te permite replicar el patrón educativo validado al 100% en el módulo Arquitectura a cualquiera de los 14 módulos restantes del sistema de auditoría.

**Patrón implementa**:
- ✅ Educación del cliente (¿Qué es? ¿Por qué importa?)
- ✅ Comparación visual ANTES vs DESPUÉS
- ✅ Entregables CSV descargables
- ✅ Tabla de KPIs esperados cuantificados
- ✅ Badges de sección explícitos

---

## 📋 CHECKLIST DE IMPLEMENTACIÓN

Para cada módulo, sigue estos pasos en orden:

### Paso 1: Preparación (15 min)
- [ ] Identificar módulo a mejorar (ej: `08_on_page.php`)
- [ ] Leer archivo actual para entender estructura
- [ ] Identificar CSVs necesarios (2-5 archivos)
- [ ] Definir KPIs clave a mostrar (3-5 métricas)

### Paso 2: Crear CSVs (30-60 min)
- [ ] Crear directorio `/entregables/[categoria]/` si no existe
- [ ] Generar CSVs con datos reales o simulados
- [ ] Validar formato: URL, Problema, Acción, Prioridad
- [ ] Verificar descarga funcional

### Paso 3: Sección Educativa (30 min)
- [ ] Copiar template HTML (ver abajo)
- [ ] Personalizar: título, analogía, impactos
- [ ] Insertar después del header del módulo
- [ ] Verificar que el texto sea comprensible para no-técnicos

### Paso 4: Sección Entregables (30 min)
- [ ] Copiar template HTML tarjetas CSV
- [ ] Personalizar: nombre archivo, descripción, prioridad, impacto
- [ ] Configurar rutas de descarga correctas
- [ ] Insertar después de sección educativa

### Paso 5: Comparación ANTES/DESPUÉS (45 min)
- [ ] Copiar template HTML comparación
- [ ] Personalizar problemas ANTES (4-5 items)
- [ ] Personalizar mejoras DESPUÉS (4-5 items)
- [ ] Adaptar diagrama visual según el módulo
- [ ] Insertar después de entregables

### Paso 6: Tabla KPIs (30 min)
- [ ] Copiar template HTML tabla
- [ ] Definir 3-5 KPIs específicos del módulo
- [ ] Rellenar valores ANTES / DESPUÉS / Mejora
- [ ] Añadir nota de tiempos esperados
- [ ] Insertar después de comparación

### Paso 7: Badges de Sección (10 min)
- [ ] Añadir badge ANTES a sección existente "Resumen Ejecutivo"
- [ ] CSS ya incluido en templates

### Paso 8: CSS Completo (15 min)
- [ ] Copiar bloque CSS completo (ver abajo)
- [ ] Insertar antes de `@media print`
- [ ] Verificar que clases no colisionen

### Paso 9: Testing (15 min)
- [ ] Abrir módulo en navegador
- [ ] Verificar descarga de CSVs
- [ ] Comprobar responsive (móvil)
- [ ] Validar animaciones
- [ ] Revisar ortografía y coherencia

### Paso 10: Commit (5 min)
- [ ] Commit con mensaje descriptivo
- [ ] Formato: `feat: completa patrón educativo en módulo [Nombre]`

**TIEMPO TOTAL**: 2-3 horas por módulo

---

## 📦 TEMPLATE 1: Sección Educativa

**Dónde insertar**: Después del header del módulo, antes del contenido técnico.

```html
<!-- SECCIÓN EDUCATIVA: ¿Qué es [CONCEPTO]? -->
<section class="concepto-educativo">
    <div class="concepto-header">
        <span class="concepto-icon">📚</span>
        <h2>¿Qué es [CONCEPTO] y Por Qué es Importante?</h2>
    </div>
    <div class="concepto-content">
        <p class="concepto-intro">
            [DESCRIPCIÓN SIMPLE EN 1-2 FRASES SIN JARGON TÉCNICO]
        </p>
        <div class="analogia-box">
            <div class="analogia-header">
                <span class="analogia-icon">💡</span>
                <strong>Piensa en [CONCEPTO] como [ANALOGÍA DEL MUNDO REAL]:</strong>
            </div>
            <ul class="analogia-list">
                <li><strong>[Elemento 1]</strong> - [Explicación]</li>
                <li><strong>[Elemento 2]</strong> - [Explicación]</li>
                <li><strong>[Elemento 3]</strong> - [Explicación]</li>
                <li><strong>[Elemento 4]</strong> - [Explicación]</li>
            </ul>
            <p class="analogia-conclusion">
                <strong>Problema:</strong> [CONSECUENCIA SI NO SE ATIENDE]
            </p>
        </div>
        <div class="impacto-box">
            <h3>¿Cómo Afecta [CONCEPTO] a Tu Negocio?</h3>
            <div class="impacto-grid">
                <div class="impacto-item">
                    <span class="impacto-icon">🔍</span>
                    <div class="impacto-text">
                        <strong>SEO:</strong> [IMPACTO EN VISIBILIDAD/RANKINGS]
                    </div>
                </div>
                <div class="impacto-item">
                    <span class="impacto-icon">👥</span>
                    <div class="impacto-text">
                        <strong>Usuarios:</strong> [IMPACTO EN EXPERIENCIA/CONVERSIÓN]
                    </div>
                </div>
                <div class="impacto-item">
                    <span class="impacto-icon">⚡</span>
                    <div class="impacto-text">
                        <strong>[TERCER IMPACTO]:</strong> [DESCRIPCIÓN]
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Variables a personalizar**:
- `[CONCEPTO]`: "SEO On-Page", "Keyword Research", "Core Web Vitals", etc.
- `[DESCRIPCIÓN SIMPLE]`: Explicación en lenguaje llano
- `[ANALOGÍA DEL MUNDO REAL]`: Metáfora comprensible (ej: "un escaparate de tienda")
- `[IMPACTO EN...]`: Cuantificar siempre que sea posible (%, números)

**Ejemplos de analogías por módulo**:
- **On-Page**: "Un escaparate de tienda - títulos y descripciones atraen clientes"
- **Keywords**: "Un mapa de búsqueda del tesoro - las palabras clave son las pistas"
- **Core Web Vitals**: "La velocidad de un ascensor - nadie quiere esperar"
- **Contenido**: "Un libro bien organizado - capítulos claros, índice útil"
- **Off-Page**: "Recomendaciones de amigos - los links son votos de confianza"

---

## 📦 TEMPLATE 2: Sección Entregables

**Dónde insertar**: Después de sección educativa.

```html
<!-- SECCIÓN: Archivos de Trabajo Descargables -->
<section class="entregables-section">
    <div class="entregables-header">
        <span class="entregables-icon">📄</span>
        <h2>Archivos de Trabajo para Implementar las Mejoras</h2>
    </div>
    <p class="entregables-intro">
        Hemos preparado archivos CSV listos para usar con todas las URLs/elementos que necesitan corrección.
        Descárgalos, ábrelos en Excel y empieza a trabajar:
    </p>
    <div class="entregables-grid">
        <!-- TARJETA CSV 1 -->
        <div class="entregable-card priority-[critical/high/medium]">
            <div class="entregable-icon">
                <i class="fas fa-file-csv"></i>
            </div>
            <div class="entregable-content">
                <h3>[NOMBRE DESCRIPTIVO DEL CSV]</h3>
                <p class="entregable-desc">
                    <strong>[CANTIDAD]</strong> [tipo de elementos]. [DESCRIPCIÓN DE QUÉ CONTIENE].
                </p>
                <div class="entregable-meta">
                    <span class="meta-badge priority">Prioridad: [Muy Alta/Alta/Media]</span>
                    <span class="meta-badge impact">Impacto: [CUANTIFICADO]</span>
                </div>
                <a href="/entregables/[categoria]/[nombre_archivo].csv"
                   class="btn-download"
                   download
                   title="Descargar CSV con [cantidad] elementos">
                    <i class="fas fa-download"></i> Descargar CSV
                </a>
            </div>
        </div>

        <!-- REPETIR TARJETA PARA CADA CSV (2-5 tarjetas típicamente) -->

    </div>
    <div class="como-usar-entregables">
        <h3>💡 Cómo Usar Estos Archivos</h3>
        <ol class="uso-list">
            <li><strong>Descarga</strong> el CSV haciendo clic en el botón azul</li>
            <li><strong>Ábrelo</strong> en Excel, Google Sheets o Numbers</li>
            <li><strong>Ordena</strong> por columna "Prioridad" para empezar por lo más importante</li>
            <li><strong>Asigna</strong> tareas a tu equipo (puedes añadir columna "Responsable")</li>
            <li><strong>Marca</strong> como completado según avances (añade columna "Estado")</li>
        </ol>
    </div>
</section>
```

**Variables a personalizar**:
- `priority-critical`: Borde rojo (muy urgente)
- `priority-high`: Borde amarillo (urgente)
- `priority-medium`: Borde azul (importante)
- `[categoria]`: `on_page`, `keywords`, `arquitectura`, etc.
- `[CUANTIFICADO]`: Ej: "+500 sesiones/mes", "+15% CTR", "-2s tiempo carga"

---

## 📦 TEMPLATE 3: Comparación ANTES/DESPUÉS

**Dónde insertar**: Después de sección entregables.

```html
<!-- SECCIÓN: Comparación Visual ANTES vs DESPUÉS -->
<section class="comparacion-antes-despues">
    <div class="comparacion-main-header">
        <span class="comparacion-main-icon">🔍</span>
        <h2>Situación Actual vs. Propuesta de Mejora</h2>
    </div>
    <p class="comparacion-intro">
        A continuación mostramos un resumen visual de los problemas detectados y cómo se resolverán:
    </p>

    <div class="comparacion-grid">
        <!-- COLUMNA ANTES -->
        <div class="comparacion-columna antes">
            <div class="comparacion-header error">
                <span class="badge-estado antes">ANTES - SITUACIÓN ACTUAL</span>
                <h3>Estado Actual de [ASPECTO]</h3>
            </div>
            <div class="comparacion-content">
                <!-- DIAGRAMA VISUAL (OPCIONAL - adaptar según módulo) -->
                <div class="arquitectura-visual">
                    <!-- Aquí puedes poner un diagrama simplificado, tabla, o gráfico -->
                    <!-- Ver ejemplos específicos por módulo abajo -->
                </div>

                <!-- LISTA DE PROBLEMAS -->
                <div class="problemas-lista">
                    <h4>Problemas Detectados:</h4>
                    <ul>
                        <li class="problema-item">
                            <span class="icon-error">❌</span>
                            <div class="problema-texto">
                                <strong>[PROBLEMA 1 CUANTIFICADO]</strong>
                                <span class="problema-detalle">[CONSECUENCIA]</span>
                            </div>
                        </li>
                        <li class="problema-item">
                            <span class="icon-error">❌</span>
                            <div class="problema-texto">
                                <strong>[PROBLEMA 2 CUANTIFICADO]</strong>
                                <span class="problema-detalle">[CONSECUENCIA]</span>
                            </div>
                        </li>
                        <li class="problema-item">
                            <span class="icon-error">❌</span>
                            <div class="problema-texto">
                                <strong>[PROBLEMA 3 CUANTIFICADO]</strong>
                                <span class="problema-detalle">[CONSECUENCIA]</span>
                            </div>
                        </li>
                        <li class="problema-item">
                            <span class="icon-error">❌</span>
                            <div class="problema-texto">
                                <strong>[IMPACTO TOTAL ESTIMADO]</strong>
                                <span class="problema-detalle">[PÉRDIDA EN TRÁFICO/CONVERSIÓN]</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FLECHA DE TRANSFORMACIÓN -->
        <div class="transformacion-arrow">
            <div class="arrow-icon">➡️</div>
            <p class="arrow-text">Implementando<br>las acciones<br>del CSV</p>
        </div>

        <!-- COLUMNA DESPUÉS -->
        <div class="comparacion-columna despues">
            <div class="comparacion-header success">
                <span class="badge-estado despues">DESPUÉS - SOLUCIÓN PROPUESTA</span>
                <h3>[ASPECTO] Optimizado</h3>
            </div>
            <div class="comparacion-content">
                <!-- DIAGRAMA VISUAL MEJORADO -->
                <div class="arquitectura-visual">
                    <!-- Mismo tipo de diagrama pero con indicadores verdes -->
                </div>

                <!-- LISTA DE MEJORAS -->
                <div class="mejoras-lista">
                    <h4>Mejoras Implementadas:</h4>
                    <ul>
                        <li class="mejora-item">
                            <span class="icon-success">✅</span>
                            <div class="mejora-texto">
                                <strong>[MEJORA 1 CUANTIFICADA]</strong>
                                <span class="mejora-detalle">[BENEFICIO]</span>
                            </div>
                        </li>
                        <li class="mejora-item">
                            <span class="icon-success">✅</span>
                            <div class="mejora-texto">
                                <strong>[MEJORA 2 CUANTIFICADA]</strong>
                                <span class="mejora-detalle">[BENEFICIO]</span>
                            </div>
                        </li>
                        <li class="mejora-item">
                            <span class="icon-success">✅</span>
                            <div class="mejora-texto">
                                <strong>[MEJORA 3 CUANTIFICADA]</strong>
                                <span class="mejora-detalle">[BENEFICIO]</span>
                            </div>
                        </li>
                        <li class="mejora-item">
                            <span class="icon-success">✅</span>
                            <div class="mejora-texto">
                                <strong>[GANANCIA TOTAL ESTIMADA]</strong>
                                <span class="mejora-detalle">[INCREMENTO EN TRÁFICO/CONVERSIÓN]</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Variables a personalizar**:
- `[ASPECTO]`: "SEO On-Page", "Velocidad del Sitio", etc.
- `[PROBLEMA X]`: Siempre cuantificado (ej: "45 páginas sin H1")
- `[MEJORA X]`: Correspondiente al problema (ej: "45 páginas con H1 optimizado")
- `[CONSECUENCIA]` / `[BENEFICIO]`: Impacto en SEO/negocio

---

## 📦 TEMPLATE 4: Tabla de KPIs

**Dónde insertar**: Después de comparación ANTES/DESPUÉS.

```html
<!-- SECCIÓN: Tabla de KPIs y Resultados Esperados -->
<section class="kpis-esperados-section">
    <div class="section-badge-container">
        <span class="section-badge badge-despues">DESPUÉS - RESULTADOS ESPERADOS</span>
    </div>
    <h2>📈 Resultados Esperados (30-90 días post-implementación)</h2>
    <p class="kpis-intro">
        Si implementas las acciones de los archivos CSV descargables, estos son los resultados que puedes esperar:
    </p>

    <div class="tabla-kpis-container">
        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th class="col-metrica">Métrica</th>
                    <th class="col-antes">ANTES<br><span class="col-subtitle">Situación Actual</span></th>
                    <th class="col-despues">DESPUÉS<br><span class="col-subtitle">Con Mejoras</span></th>
                    <th class="col-mejora">Mejora</th>
                    <th class="col-impacto">Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <!-- KPI 1 -->
                <tr class="kpi-row [critical/high/medium]">
                    <td class="metrica-nombre">
                        <strong>[NOMBRE MÉTRICA 1]</strong>
                        <span class="metrica-descripcion">[Descripción corta]</span>
                    </td>
                    <td class="valor-antes">
                        <span class="valor-numero">[VALOR]</span>
                        <span class="valor-unidad">[unidad]</span>
                    </td>
                    <td class="valor-despues">
                        <span class="valor-numero success">[VALOR MEJORADO]</span>
                        <span class="valor-unidad">[unidad]</span>
                    </td>
                    <td class="valor-mejora">
                        <div class="mejora-badge success">
                            <span class="mejora-porcentaje">[±X%]</span>
                            <span class="mejora-texto">[tipo mejora]</span>
                        </div>
                    </td>
                    <td class="impacto-texto">
                        [DESCRIPCIÓN DEL IMPACTO EN NEGOCIO]
                    </td>
                </tr>

                <!-- KPI 2-5: REPETIR ESTRUCTURA -->

                <!-- KPI MÁS IMPORTANTE (highlight-row) -->
                <tr class="kpi-row critical highlight-row">
                    <td class="metrica-nombre">
                        <strong>[MÉTRICA CLAVE - ej: Tráfico Orgánico]</strong>
                        <span class="metrica-descripcion">[Descripción]</span>
                    </td>
                    <td class="valor-antes">
                        <span class="valor-numero">[VALOR BASE]</span>
                        <span class="valor-unidad">[unidad/mes]</span>
                    </td>
                    <td class="valor-despues">
                        <span class="valor-numero success">[RANGO ESTIMADO]</span>
                        <span class="valor-unidad">[unidad/mes]</span>
                    </td>
                    <td class="valor-mejora">
                        <div class="mejora-badge success large">
                            <span class="mejora-porcentaje">[+X-Y%]</span>
                            <span class="mejora-texto">incremento</span>
                        </div>
                    </td>
                    <td class="impacto-texto">
                        <strong>[GANANCIA ABSOLUTA DESTACADA]</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="kpis-nota-importante">
        <div class="nota-header">
            <span class="nota-icon">💡</span>
            <strong>Nota Importante</strong>
        </div>
        <p>
            Estos resultados son estimaciones conservadoras basadas en datos históricos de sitios similares.
            Los resultados reales pueden variar según la velocidad de implementación y otros factores SEO.
            <strong>Tiempo para ver resultados:</strong> Los primeros cambios suelen verse en [TIEMPO CORTO],
            con impacto completo en [TIEMPO LARGO].
        </p>
    </div>
</section>
```

**Variables a personalizar**:
- `[NOMBRE MÉTRICA]`: Páginas sin H1, CTR promedio, Tiempo de carga, etc.
- `[VALOR]` / `[VALOR MEJORADO]`: Datos reales del análisis
- `[±X%]`: Porcentaje de mejora (+ incremento, - reducción)
- `[tipo mejora]`: "incremento", "reducción", "optimizado", "eliminadas"
- `[TIEMPO CORTO]` / `[TIEMPO LARGO]`: Ej: "30-45 días" / "60-90 días"

**Clases de fila**:
- `critical`: Muy importante (borde rojo)
- `high`: Importante (sin borde especial)
- `medium`: Secundario (sin borde especial)
- `highlight-row`: Destacar con fondo amarillo claro (solo 1 por tabla)

---

## 📦 TEMPLATE 5: Badge de Sección ANTES

**Dónde insertar**: Justo antes del `<h2>` de "Resumen Ejecutivo" o primera sección de datos.

```html
<section class="executive-summary situacion-actual-section">
    <div class="section-badge-container">
        <span class="section-badge badge-antes">ANTES - SITUACIÓN ACTUAL</span>
    </div>
    <h2>Resumen Ejecutivo: Estado Actual</h2>
    <!-- Resto del contenido existente -->
</section>
```

---

## 🎨 CSS COMPLETO PARA COPIAR

**Dónde insertar**: Dentro del bloque `<style>` del módulo, ANTES de `@media print`.

```css
/* ==========================================
   PATRÓN EDUCATIVO - CSS COMPLETO
   ========================================== */

/* Sección Educativa */
.[nombre-modulo]-page .concepto-educativo {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.[nombre-modulo]-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.[nombre-modulo]-page .concepto-icon {
    font-size: 32px;
}

.[nombre-modulo]-page .concepto-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    border: none;
    padding: 0;
    color: white;
}

.[nombre-modulo]-page .concepto-intro {
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 25px;
}

.[nombre-modulo]-page .analogia-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-left: 4px solid #ffd700;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.[nombre-modulo]-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 16px;
}

.[nombre-modulo]-page .analogia-icon {
    font-size: 24px;
}

.[nombre-modulo]-page .analogia-list {
    margin: 15px 0;
    padding-left: 25px;
    list-style: none;
}

.[nombre-modulo]-page .analogia-list li {
    margin-bottom: 12px;
    padding-left: 20px;
    position: relative;
}

.[nombre-modulo]-page .analogia-list li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #ffd700;
    font-weight: bold;
}

.[nombre-modulo]-page .analogia-conclusion {
    background: rgba(255,100,100,0.2);
    padding: 12px 15px;
    border-radius: 6px;
    margin: 15px 0 0 0;
}

.[nombre-modulo]-page .impacto-box {
    background: rgba(255,255,255,0.95);
    color: #333;
    padding: 25px;
    border-radius: 8px;
    margin-top: 25px;
}

.[nombre-modulo]-page .impacto-box h3 {
    margin: 0 0 20px 0;
    color: #1a1a1a;
    font-size: 18px;
    font-weight: 600;
}

.[nombre-modulo]-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.[nombre-modulo]-page .impacto-item {
    display: flex;
    gap: 15px;
    align-items: start;
    background: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
}

.[nombre-modulo]-page .impacto-icon {
    font-size: 28px;
    flex-shrink: 0;
}

.[nombre-modulo]-page .impacto-text {
    line-height: 1.6;
    font-size: 14px;
}

/* Sección Entregables */
.[nombre-modulo]-page .entregables-section {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.[nombre-modulo]-page .entregables-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.[nombre-modulo]-page .entregables-icon {
    font-size: 32px;
}

.[nombre-modulo]-page .entregables-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 22px;
    font-weight: 600;
    border: none;
    padding: 0;
}

.[nombre-modulo]-page .entregables-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}

.[nombre-modulo]-page .entregables-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.[nombre-modulo]-page .entregable-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 25px;
    display: flex;
    gap: 20px;
    transition: all 0.3s ease;
}

.[nombre-modulo]-page .entregable-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102,126,234,0.15);
    transform: translateY(-2px);
}

.[nombre-modulo]-page .entregable-card.priority-critical {
    border-left: 5px solid #dc3545;
}

.[nombre-modulo]-page .entregable-card.priority-high {
    border-left: 5px solid #ffc107;
}

.[nombre-modulo]-page .entregable-card.priority-medium {
    border-left: 5px solid #2196f3;
}

.[nombre-modulo]-page .entregable-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.[nombre-modulo]-page .entregable-content h3 {
    margin: 0 0 12px 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.[nombre-modulo]-page .entregable-desc {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 15px;
}

.[nombre-modulo]-page .entregable-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.[nombre-modulo]-page .meta-badge {
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.[nombre-modulo]-page .meta-badge.priority {
    background: #ffebee;
    color: #c62828;
}

.[nombre-modulo]-page .meta-badge.impact {
    background: #e8f5e9;
    color: #2e7d32;
}

.[nombre-modulo]-page .btn-download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #667eea;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.[nombre-modulo]-page .btn-download:hover {
    background: #5568d3;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(102,126,234,0.3);
}

.[nombre-modulo]-page .btn-download i {
    font-size: 16px;
}

.[nombre-modulo]-page .como-usar-entregables {
    background: #f9f9f9;
    border-left: 4px solid #54a34a;
    padding: 20px;
    border-radius: 8px;
}

.[nombre-modulo]-page .como-usar-entregables h3 {
    margin: 0 0 15px 0;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.[nombre-modulo]-page .uso-list {
    margin: 0;
    padding-left: 25px;
}

.[nombre-modulo]-page .uso-list li {
    margin-bottom: 10px;
    line-height: 1.6;
    font-size: 14px;
}

/* Sección Comparación ANTES vs DESPUÉS */
.[nombre-modulo]-page .comparacion-antes-despues {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 12px;
    margin: 40px 0;
}

.[nombre-modulo]-page .comparacion-main-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.[nombre-modulo]-page .comparacion-main-icon {
    font-size: 32px;
}

.[nombre-modulo]-page .comparacion-main-header h2 {
    margin: 0;
    color: #1a1a1a;
    font-size: 24px;
    font-weight: 600;
    border: none;
    padding: 0;
}

.[nombre-modulo]-page .comparacion-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 30px;
    line-height: 1.6;
}

.[nombre-modulo]-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 25px;
    align-items: start;
}

.[nombre-modulo]-page .comparacion-columna {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.[nombre-modulo]-page .comparacion-header {
    padding: 20px;
    color: white;
}

.[nombre-modulo]-page .comparacion-header.error {
    background: linear-gradient(135deg, #dc3545, #c82333);
}

.[nombre-modulo]-page .comparacion-header.success {
    background: linear-gradient(135deg, #28a745, #218838);
}

.[nombre-modulo]-page .comparacion-header h3 {
    margin: 10px 0 0 0;
    font-size: 18px;
    font-weight: 600;
    color: white;
}

.[nombre-modulo]-page .badge-estado {
    display: inline-block;
    padding: 5px 12px;
    background: rgba(255,255,255,0.25);
    border-radius: 20px;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.[nombre-modulo]-page .comparacion-content {
    padding: 25px;
}

.[nombre-modulo]-page .problemas-lista h4,
.[nombre-modulo]-page .mejoras-lista h4 {
    margin: 0 0 15px 0;
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
}

.[nombre-modulo]-page .problemas-lista ul,
.[nombre-modulo]-page .mejoras-lista ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.[nombre-modulo]-page .problema-item,
.[nombre-modulo]-page .mejora-item {
    display: flex;
    gap: 12px;
    align-items: start;
    margin-bottom: 15px;
    padding: 12px;
    background: #f9f9f9;
    border-radius: 6px;
}

.[nombre-modulo]-page .problema-item {
    border-left: 3px solid #dc3545;
}

.[nombre-modulo]-page .mejora-item {
    border-left: 3px solid #28a745;
}

.[nombre-modulo]-page .icon-error,
.[nombre-modulo]-page .icon-success {
    font-size: 20px;
    flex-shrink: 0;
    line-height: 1;
}

.[nombre-modulo]-page .problema-texto,
.[nombre-modulo]-page .mejora-texto {
    flex: 1;
}

.[nombre-modulo]-page .problema-texto strong,
.[nombre-modulo]-page .mejora-texto strong {
    display: block;
    margin-bottom: 4px;
    color: #1a1a1a;
    font-size: 14px;
}

.[nombre-modulo]-page .problema-detalle,
.[nombre-modulo]-page .mejora-detalle {
    display: block;
    font-size: 12px;
    color: #666;
    font-style: italic;
}

.[nombre-modulo]-page .transformacion-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.[nombre-modulo]-page .arrow-icon {
    font-size: 48px;
    margin-bottom: 10px;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.[nombre-modulo]-page .arrow-text {
    text-align: center;
    font-size: 13px;
    font-weight: 600;
    color: #667eea;
    line-height: 1.4;
    margin: 0;
}

/* Badges de Sección ANTES/DESPUÉS */
.[nombre-modulo]-page .section-badge-container {
    margin-bottom: 15px;
}

.[nombre-modulo]-page .section-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.[nombre-modulo]-page .section-badge.badge-antes {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    box-shadow: 0 2px 4px rgba(220,53,69,0.3);
}

.[nombre-modulo]-page .section-badge.badge-despues {
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    box-shadow: 0 2px 4px rgba(40,167,69,0.3);
}

/* Sección KPIs Esperados */
.[nombre-modulo]-page .kpis-esperados-section {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.[nombre-modulo]-page .kpis-esperados-section h2 {
    color: #1a1a1a;
    font-size: 22px;
    font-weight: 600;
    margin: 10px 0 15px 0;
    border: none;
    padding: 0;
}

.[nombre-modulo]-page .kpis-intro {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
    line-height: 1.6;
}

.[nombre-modulo]-page .tabla-kpis-container {
    overflow-x: auto;
    margin: 25px 0;
}

.[nombre-modulo]-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
}

.[nombre-modulo]-page .tabla-kpis thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.[nombre-modulo]-page .tabla-kpis th {
    padding: 15px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.[nombre-modulo]-page .tabla-kpis .col-subtitle {
    display: block;
    font-size: 10px;
    font-weight: normal;
    text-transform: none;
    margin-top: 3px;
    opacity: 0.9;
}

.[nombre-modulo]-page .tabla-kpis .col-antes {
    background: rgba(220,53,69,0.2);
}

.[nombre-modulo]-page .tabla-kpis .col-despues {
    background: rgba(40,167,69,0.2);
}

.[nombre-modulo]-page .tabla-kpis .col-mejora {
    background: rgba(255,193,7,0.15);
    text-align: center;
}

.[nombre-modulo]-page .tabla-kpis tbody tr {
    border-bottom: 1px solid #e0e0e0;
    transition: background 0.2s ease;
}

.[nombre-modulo]-page .tabla-kpis tbody tr:hover {
    background: #f9f9f9;
}

.[nombre-modulo]-page .tabla-kpis tbody tr.highlight-row {
    background: #fff9e6;
    border-left: 4px solid #ffc107;
}

.[nombre-modulo]-page .tabla-kpis tbody tr.highlight-row:hover {
    background: #fff5d6;
}

.[nombre-modulo]-page .tabla-kpis td {
    padding: 15px 12px;
    vertical-align: top;
}

.[nombre-modulo]-page .metrica-nombre {
    min-width: 180px;
}

.[nombre-modulo]-page .metrica-nombre strong {
    display: block;
    color: #1a1a1a;
    font-size: 14px;
    margin-bottom: 4px;
}

.[nombre-modulo]-page .metrica-descripcion {
    display: block;
    font-size: 12px;
    color: #888;
    font-style: italic;
}

.[nombre-modulo]-page .valor-antes,
.[nombre-modulo]-page .valor-despues {
    text-align: center;
    min-width: 120px;
}

.[nombre-modulo]-page .valor-numero {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2px;
}

.[nombre-modulo]-page .valor-numero.success {
    color: #28a745;
}

.[nombre-modulo]-page .valor-unidad {
    display: block;
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.[nombre-modulo]-page .valor-mejora {
    text-align: center;
    min-width: 130px;
}

.[nombre-modulo]-page .mejora-badge {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 6px;
    text-align: center;
}

.[nombre-modulo]-page .mejora-badge.success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 2px solid #28a745;
}

.[nombre-modulo]-page .mejora-badge.large {
    padding: 10px 15px;
}

.[nombre-modulo]-page .mejora-porcentaje {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 2px;
}

.[nombre-modulo]-page .mejora-badge.large .mejora-porcentaje {
    font-size: 24px;
}

.[nombre-modulo]-page .mejora-texto {
    display: block;
    font-size: 11px;
    color: #155724;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.[nombre-modulo]-page .impacto-texto {
    font-size: 13px;
    color: #555;
    line-height: 1.5;
}

.[nombre-modulo]-page .kpis-nota-importante {
    background: #e7f3ff;
    border-left: 4px solid #2196f3;
    padding: 20px;
    border-radius: 8px;
    margin-top: 25px;
}

.[nombre-modulo]-page .nota-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.[nombre-modulo]-page .nota-icon {
    font-size: 24px;
}

.[nombre-modulo]-page .nota-header strong {
    font-size: 15px;
    color: #1a1a1a;
}

.[nombre-modulo]-page .kpis-nota-importante p {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: #555;
}

/* Responsive */
@media (max-width: 1200px) {
    .[nombre-modulo]-page .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .[nombre-modulo]-page .transformacion-arrow {
        transform: rotate(90deg);
        padding: 20px 0;
    }

    .[nombre-modulo]-page .arrow-text br {
        display: none;
    }
}
```

**IMPORTANTE**: Reemplaza `[nombre-modulo]` con el nombre de tu módulo (ej: `on-page`, `keywords`, `core-web-vitals`).

---

## 📋 EJEMPLOS ESPECÍFICOS POR MÓDULO

### Módulo: SEO On-Page

**CSVs necesarios** (5):
1. `paginas_sin_h1.csv` ✅ (ya creado)
2. `h1_duplicados.csv`
3. `meta_descriptions_duplicadas.csv`
4. `title_tags_optimizar.csv`
5. `imagenes_sin_alt.csv` ✅ (ya creado)

**KPIs clave**:
- Páginas sin H1: ANTES 45 → DESPUÉS 0
- Meta descriptions duplicadas: ANTES 78 → DESPUÉS 0
- CTR promedio: ANTES 2.3% → DESPUÉS 3.1-3.5%
- Páginas con title optimizado: ANTES 62% → DESPUÉS 100%

**Analogía**: "Un escaparate de tienda - títulos y descripciones atraen clientes"

---

### Módulo: Keyword Research

**CSVs necesarios** (1-2):
1. `oportunidades_priorizadas.csv` ✅ (ya creado)
2. `keywords_canibalizacion.csv` (opcional)

**KPIs clave**:
- Keywords rastreadas: ANTES 127 → DESPUÉS 185 (+46%)
- Posición promedio: ANTES 18.4 → DESPUÉS 12.1
- Tráfico estimado de oportunidades: +2,100-2,800 sesiones/mes
- Keywords en top 10: ANTES 23 → DESPUÉS 42 (+83%)

**Analogía**: "Un mapa del tesoro - las palabras clave son las pistas que guían a tus clientes"

**Comparación visual**: Tabla de keywords actuales vs oportunidades con posiciones y tráfico estimado

---

### Módulo: Core Web Vitals

**CSVs necesarios** (2):
1. `paginas_lentas.csv`
2. `elementos_bloquean_render.csv`

**KPIs clave**:
- LCP (Largest Contentful Paint): ANTES 4.2s → DESPUÉS 1.8s
- FID (First Input Delay): ANTES 180ms → DESPUÉS 45ms
- CLS (Cumulative Layout Shift): ANTES 0.18 → DESPUÉS 0.03
- Páginas "Buenas": ANTES 32% → DESPUÉS 94%

**Analogía**: "La velocidad de un ascensor - nadie quiere esperar 4 segundos para que abra la puerta"

**Comparación visual**: Gauges circulares mostrando métricas ANTES (rojo) vs DESPUÉS (verde)

---

### Módulo: SEO Técnico

**CSVs necesarios** (3):
1. `errores_404.csv`
2. `problemas_canonical.csv`
3. `paginas_sin_indexar.csv`

**KPIs clave**:
- Errores 404: ANTES 47 → DESPUÉS 0
- Páginas con canonical incorrecto: ANTES 23 → DESPUÉS 0
- URLs indexables: ANTES 789 → DESPUÉS 892 (+13%)
- Crawl errors: ANTES 156 → DESPUÉS 8 (-95%)

**Analogía**: "Los cimientos de un edificio - invisibles pero críticos para la estabilidad"

---

## 🚀 FLUJO DE TRABAJO RECOMENDADO

### Semana 1: Módulos Críticos (3 módulos)
1. **Lunes-Martes**: On-Page (3h)
2. **Miércoles**: Keywords (2h)
3. **Jueves-Viernes**: SEO Técnico (3h)

### Semana 2: Módulos Importantes (4 módulos)
4. **Lunes**: Core Web Vitals (2.5h)
5. **Martes**: Contenido (2.5h)
6. **Miércoles**: Off-Page (2.5h)
7. **Jueves**: Performance (2.5h)

### Semana 3: Módulos Secundarios (7 módulos)
8-14. **Lunes-Viernes**: Resto de módulos (2h cada uno)

**TOTAL**: ~35-40 horas de trabajo para completar los 14 módulos restantes

---

## ✅ CHECKLIST FINAL DE VALIDACIÓN

Antes de considerar un módulo "completado", verifica:

- [ ] **Educación**: Sección con analogía comprensible
- [ ] **Entregables**: Al menos 2 CSVs descargables
- [ ] **Comparación**: Columnas ANTES/DESPUÉS con 4+ items cada una
- [ ] **KPIs**: Tabla con 3-5 métricas cuantificadas
- [ ] **Badges**: Sección principal etiquetada como "ANTES"
- [ ] **CSS**: Todo el bloque copiado sin errores
- [ ] **Responsive**: Funciona en móvil (grid se apila)
- [ ] **Descarga**: Botones CSV funcionan correctamente
- [ ] **Ortografía**: Sin errores de escritura
- [ ] **Commit**: Guardado en Git con mensaje descriptivo

---

## 📚 RECURSOS ADICIONALES

**Archivos de referencia**:
- Prototipo completo: `modulos/fase3_arquitectura/00_analisis_arquitectura.php`
- Documentación: `COMPLETADO_PROTOTIPO_ARQUITECTURA.md`
- Análisis: `REVISION_FORMACION_ANTES_DESPUES.md`

**Paleta de colores**:
```css
--educativo: #667eea → #764ba2
--antes-error: #dc3545
--despues-success: #28a745
--warning: #ffc107
--info: #2196f3
```

---

## 💡 CONSEJOS Y MEJORES PRÁCTICAS

1. **Siempre cuantifica**: "45 páginas sin H1" mejor que "varias páginas"
2. **Usa analogías**: El cliente no es técnico, necesita metáforas
3. **Sé conservador en estimaciones**: Mejor sorprender positivamente
4. **Prioriza visualmente**: Usa colores (rojo = crítico, amarillo = importante, azul = secundario)
5. **Incluye tiempos**: El cliente quiere saber CUÁNDO verá resultados
6. **Conecta con negocio**: Traduce mejoras SEO a tráfico/conversión/ingresos
7. **Haz el CSV accionable**: Cada fila debe decir QUÉ hacer, no solo QUÉ está mal

---

**Documento creado**: 2025-01-18
**Versión**: 1.0
**Basado en**: Módulo Arquitectura (commit c252a4a3)
**Próxima actualización**: Tras implementar 2-3 módulos adicionales para refinar el patrón
