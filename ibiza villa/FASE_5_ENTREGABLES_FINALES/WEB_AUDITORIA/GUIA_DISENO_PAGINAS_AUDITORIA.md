# 📐 GUÍA DE DISEÑO: Páginas de Auditoría SEO Profesional

## 🎯 Objetivo
Esta guía establece los estándares para crear páginas de auditoría profesionales, presentables y con valor real para el cliente.

---

## 📋 ÍNDICE

1. [Principios de Diseño](#principios)
2. [Tipos de Páginas](#tipos-paginas)
3. [Componentes Visuales](#componentes)
4. [Plantillas por Tipo](#plantillas)
5. [Checklist de Calidad](#checklist)

---

## <a name="principios"></a>🎨 1. PRINCIPIOS DE DISEÑO

### Reglas de Oro

1. **Una página = Un mensaje claro**
   - Cada página debe tener un objetivo específico
   - El título debe resumir el insight principal
   - Subtítulo amplía el contexto

2. **Datos > Decoración**
   - Priorizar la información sobre el diseño
   - Usar visualizaciones cuando aporten claridad
   - Evitar elementos decorativos sin función

3. **Jerarquía Visual**
   ```
   Título (H2) → Mensaje principal
   Subtítulo (H3) → Contexto o métrica clave
   Visualización → Datos en contexto
   Bullets → Insights y conclusiones
   Fuente → Herramienta de origen
   ```

4. **Consistencia**
   - Mismo estilo de gráficas en toda la auditoría
   - Paleta de colores limitada (verde marca + grises)
   - Tipografía uniforme (Hanken Grotesk)

---

## <a name="tipos-paginas"></a>📄 2. TIPOS DE PÁGINAS

### A. Páginas de Métricas (KPIs)

**Cuándo usar:** Mostrar números clave y su evolución

**Estructura:**
```
┌─────────────────────────────────────┐
│ TÍTULO: Métrica Principal           │
│ SUBTÍTULO: Período y contexto       │
├─────────────────────────────────────┤
│ ┌───────┐ ┌───────┐ ┌───────┐      │
│ │ KPI 1 │ │ KPI 2 │ │ KPI 3 │      │
│ │ 1,245 │ │ 48.5% │ │ 2:34  │      │
│ └───────┘ └───────┘ └───────┘      │
│                                     │
│ [GRÁFICA DE EVOLUCIÓN]              │
│                                     │
│ • Insight clave 1                   │
│ • Insight clave 2                   │
│ • Insight clave 3                   │
└─────────────────────────────────────┘
```

**JSON necesario:**
```json
{
  "id": "pagina-XXX",
  "numero": X,
  "titulo": "Título descriptivo",
  "subtitulo": "Período: Enero - Septiembre 2025",
  "contenido": {
    "tipo": "metricas",
    "datos": {
      "metrica_1": 1245,
      "metrica_2": "48.5%",
      "metrica_3": "2:34"
    },
    "grafica": {
      "tipo": "line",
      "titulo": "Evolución temporal",
      "etiquetas": ["Ene", "Feb", "Mar"...],
      "datasets": [{
        "label": "Métrica",
        "valores": [100, 120, 150...]
      }]
    }
  }
}
```

---

### B. Páginas de Comparativa

**Cuándo usar:** Comparar canales, períodos o segmentos

**Estructura:**
```
┌─────────────────────────────────────┐
│ TÍTULO: Comparativa de X            │
│ SUBTÍTULO: A vs B                   │
├─────────────────────────────────────┤
│ ┌──────────────┐ ┌──────────────┐  │
│ │   CANAL A    │ │   CANAL B    │  │
│ │              │ │              │  │
│ │ Sesiones: X  │ │ Sesiones: Y  │  │
│ │ Conv: X%     │ │ Conv: Y%     │  │
│ │ CTR: X%      │ │ CTR: Y%      │  │
│ └──────────────┘ └──────────────┘  │
│                                     │
│ [GRÁFICA COMPARATIVA]               │
│                                     │
│ ✓ Canal A mejor en: ...             │
│ ⚠ Canal B necesita: ...             │
└─────────────────────────────────────┘
```

**JSON necesario:**
```json
{
  "contenido": {
    "tipo": "comparativa",
    "datos": {
      "elemento_a": {
        "nombre": "Orgánico",
        "sesiones": 814,
        "conversiones": 24,
        "ctr": 2.9
      },
      "elemento_b": {
        "nombre": "Directo",
        "sesiones": 475,
        "conversiones": 18,
        "ctr": 3.8
      }
    },
    "grafica": {...}
  }
}
```

---

### C. Páginas de Ranking/Top N

**Cuándo usar:** Mostrar keywords, páginas, errores top

**Estructura:**
```
┌─────────────────────────────────────┐
│ TÍTULO: Top 10 Keywords             │
│ SUBTÍTULO: Por clics orgánicos      │
├─────────────────────────────────────┤
│ [TABLA]                             │
│ ┌──────────┬────────┬─────┬───────┐│
│ │ Keyword  │ Clics  │ Pos │ CTR % ││
│ ├──────────┼────────┼─────┼───────┤│
│ │ villa... │   125  │ 1.2 │ 8.5%  ││
│ │ alquiler │    98  │ 3.1 │ 5.2%  ││
│ └──────────┴────────┴─────┴───────┘│
│                                     │
│ [GRÁFICA DE BARRAS]                 │
│                                     │
│ 📊 Análisis:                        │
│ • Keyword principal representa X%   │
│ • Top 3 concentran Y% del tráfico   │
│ • Oportunidad en keyword Z          │
└─────────────────────────────────────┘
```

**JSON necesario:**
```json
{
  "contenido": {
    "tipo": "ranking",
    "datos": {
      "items": [
        {
          "nombre": "villa ibiza",
          "clics": 125,
          "posicion": 1.2,
          "ctr": 8.5
        }
      ]
    },
    "analisis": [
      "Keyword principal representa 45% del tráfico",
      "Top 3 concentran 78% del tráfico total"
    ]
  }
}
```

---

### D. Páginas de Análisis Técnico

**Cuándo usar:** Errores, arquitectura, velocidad

**Estructura:**
```
┌─────────────────────────────────────┐
│ TÍTULO: Errores Técnicos            │
│ SUBTÍTULO: Análisis Screaming Frog  │
├─────────────────────────────────────┤
│ ⚠ RESUMEN DE PROBLEMAS              │
│                                     │
│ ┌─────────┐ ┌─────────┐ ┌─────────┐│
│ │ CRÍTICO │ │  ALTA   │ │  MEDIA  ││
│ │   12    │ │   45    │ │   89    ││
│ └─────────┘ └─────────┘ └─────────┘│
│                                     │
│ [TABLA DETALLADA]                   │
│ Tipo Error    | Cantidad | Impacto │
│ 404 Not Found |    12    | CRÍTICO││
│ Meta Missing  |    45    | ALTA    ││
│                                     │
│ 🔧 RECOMENDACIONES:                 │
│ 1. Corregir enlaces rotos (12 URLs) │
│ 2. Añadir meta descriptions (45)    │
│ 3. Optimizar imágenes (89 casos)    │
└─────────────────────────────────────┘
```

---

### E. Páginas de Conclusiones/DAFO

**Cuándo usar:** Cierre de secciones con insights

**Estructura:**
```
┌─────────────────────────────────────┐
│ TÍTULO: Conclusiones - Sección X    │
│ SUBTÍTULO: Hallazgos clave          │
├─────────────────────────────────────┤
│ ✅ FORTALEZAS                       │
│ • Punto fuerte 1                    │
│ • Punto fuerte 2                    │
│                                     │
│ ⚠️ DEBILIDADES                      │
│ • Área de mejora 1                  │
│ • Área de mejora 2                  │
│                                     │
│ ⭐ OPORTUNIDADES                    │
│ • Oportunidad 1                     │
│ • Oportunidad 2                     │
│                                     │
│ 🎯 PRIORIDADES INMEDIATAS           │
│ 1. Acción prioritaria #1            │
│ 2. Acción prioritaria #2            │
│ 3. Acción prioritaria #3            │
└─────────────────────────────────────┘
```

---

## <a name="componentes"></a>🧩 3. COMPONENTES VISUALES

### Tarjetas de Métricas

```html
<div class="metrics-grid">
  <div class="metric-card">
    <div class="metric-value">1,245</div>
    <div class="metric-label">Usuarios/mes</div>
  </div>
</div>
```

**CSS requerido:** Ya existe en styles.css

---

### Gráficas Chart.js

**Tipos disponibles:**
- `line` - Evoluciones temporales
- `bar` - Comparativas
- `pie` - Distribuciones
- `doughnut` - Porcentajes
- `bar_horizontal` - Rankings

**Configuración mínima:**
```json
"grafica": {
  "tipo": "bar",
  "titulo": "Título de la gráfica",
  "etiquetas": ["Ene", "Feb", "Mar"],
  "datasets": [{
    "label": "Serie 1",
    "valores": [100, 200, 150],
    "color": "#54a34a"
  }]
}
```

---

### Tablas de Datos

```html
<table class="data-table">
  <thead>
    <tr>
      <th>Columna 1</th>
      <th>Columna 2</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Dato 1</td>
      <td>Dato 2</td>
    </tr>
  </tbody>
</table>
```

---

### Alertas/Callouts

```html
<div class="alert alert-warning">
  <strong>⚠️ Atención:</strong> Mensaje importante
</div>

<div class="alert alert-success">
  <strong>✅ Éxito:</strong> Mensaje positivo
</div>

<div class="alert alert-danger">
  <strong>🚨 Crítico:</strong> Problema grave
</div>
```

---

## <a name="plantillas"></a>📑 4. PLANTILLAS JSON COMPLETAS

### Plantilla 1: Página de Tráfico Orgánico Histórico

```json
{
  "id": "pagina-006",
  "numero": 6,
  "titulo": "Tráfico Orgánico Histórico",
  "subtitulo": "Evolución de sesiones orgánicas - Últimos 12 meses",
  "contenido": {
    "tipo": "metricas_temporal",
    "datos": {
      "periodo": "Octubre 2024 - Septiembre 2025",
      "sesiones_totales": 9768,
      "variacion_yoy": "+12.5%",
      "promedio_mensual": 814,
      "mejor_mes": {
        "nombre": "Julio 2025",
        "sesiones": 1245
      },
      "peor_mes": {
        "nombre": "Enero 2025",
        "sesiones": 456
      }
    },
    "grafica": {
      "tipo": "line",
      "titulo": "Sesiones Orgánicas Mensuales",
      "etiquetas": ["Oct 24", "Nov 24", "Dic 24", "Ene 25", "Feb 25", "Mar 25", "Abr 25", "May 25", "Jun 25", "Jul 25", "Ago 25", "Sep 25"],
      "datasets": [{
        "label": "Sesiones Orgánicas",
        "valores": [678, 723, 589, 456, 612, 734, 823, 956, 1089, 1245, 1178, 885],
        "color": "#54a34a"
      }]
    },
    "insights": [
      "Tendencia positiva general con crecimiento del 12.5% año vs año",
      "Estacionalidad marcada: pico en julio (temporada alta) y valle en enero",
      "Últimos 6 meses muestran aceleración del crecimiento",
      "Oportunidad de mejorar tráfico en meses de baja temporada"
    ]
  }
}
```

---

### Plantilla 2: Página de Captación por Países

```json
{
  "id": "pagina-009",
  "numero": 9,
  "titulo": "Ranking de Países por Tráfico Orgánico",
  "subtitulo": "Distribución geográfica de sesiones - Septiembre 2025",
  "contenido": {
    "tipo": "ranking_geografico",
    "datos": {
      "top_paises": [
        {
          "pais": "España",
          "flag": "🇪🇸",
          "sesiones": 412,
          "porcentaje": 50.6,
          "conversiones": 15,
          "tasa_conversion": 3.6
        },
        {
          "pais": "Francia",
          "flag": "🇫🇷",
          "sesiones": 156,
          "porcentaje": 19.2,
          "conversiones": 8,
          "tasa_conversion": 5.1
        },
        {
          "pais": "Alemania",
          "flag": "🇩🇪",
          "sesiones": 98,
          "porcentaje": 12.0,
          "conversiones": 6,
          "tasa_conversion": 6.1
        },
        {
          "pais": "Reino Unido",
          "flag": "🇬🇧",
          "sesiones": 89,
          "porcentaje": 10.9,
          "conversiones": 4,
          "tasa_conversion": 4.5
        },
        {
          "pais": "Otros",
          "flag": "🌍",
          "sesiones": 59,
          "porcentaje": 7.3,
          "conversiones": 2,
          "tasa_conversion": 3.4
        }
      ]
    },
    "grafica": {
      "tipo": "pie",
      "titulo": "Distribución de Tráfico por País",
      "etiquetas": ["🇪🇸 España", "🇫🇷 Francia", "🇩🇪 Alemania", "🇬🇧 Reino Unido", "🌍 Otros"],
      "valores": [50.6, 19.2, 12.0, 10.9, 7.3],
      "colores": ["#54a34a", "#6ab85e", "#8cc77e", "#aed69e", "#d0e8c5"]
    },
    "insights": [
      "España lidera con más del 50% del tráfico orgánico total",
      "Alemania muestra la mejor tasa de conversión (6.1%) pese a menor volumen",
      "Francia es el segundo mercado más importante con 19.2% del tráfico",
      "Oportunidad de crecimiento en Reino Unido (bajo conversion rate)"
    ]
  }
}
```

---

### Plantilla 3: Página de Dispositivos

```json
{
  "id": "pagina-010",
  "numero": 10,
  "titulo": "Ranking de Dispositivos por Tráfico Orgánico",
  "subtitulo": "Análisis de comportamiento por tipo de dispositivo",
  "contenido": {
    "tipo": "comparativa_dispositivos",
    "datos": {
      "dispositivos": [
        {
          "tipo": "Mobile",
          "icon": "📱",
          "sesiones": 487,
          "porcentaje": 59.8,
          "duracion_promedio": "1:45",
          "tasa_rebote": 52.3,
          "paginas_sesion": 2.1
        },
        {
          "tipo": "Desktop",
          "icon": "💻",
          "sesiones": 245,
          "porcentaje": 30.1,
          "duracion_promedio": "3:12",
          "tasa_rebote": 38.5,
          "paginas_sesion": 3.4
        },
        {
          "tipo": "Tablet",
          "icon": "📲",
          "sesiones": 82,
          "porcentaje": 10.1,
          "duracion_promedio": "2:34",
          "tasa_rebote": 45.2,
          "paginas_sesion": 2.8
        }
      ]
    },
    "grafica": {
      "tipo": "bar",
      "titulo": "Métricas de Engagement por Dispositivo",
      "etiquetas": ["Mobile", "Desktop", "Tablet"],
      "datasets": [
        {
          "label": "Sesiones",
          "valores": [487, 245, 82],
          "color": "#54a34a"
        },
        {
          "label": "Páginas/Sesión",
          "valores": [2.1, 3.4, 2.8],
          "color": "#6ab85e"
        }
      ]
    },
    "insights": [
      "60% del tráfico proviene de dispositivos móviles",
      "Desktop muestra mejor engagement: 3.4 páginas/sesión y menor rebote",
      "Usuarios móviles requieren optimización UX: alta tasa de rebote (52.3%)",
      "Tablet representa oportunidad desaprovechada con bajo volumen"
    ]
  }
}
```

---

## <a name="checklist"></a>✅ 5. CHECKLIST DE CALIDAD

### Antes de dar por terminada una página:

- [ ] **Título claro y descriptivo** que resuma el mensaje principal
- [ ] **Subtítulo con contexto** (período, herramienta, alcance)
- [ ] **Datos reales** (no placeholder, no "Lorem ipsum")
- [ ] **Visualización apropiada** (gráfica que aporte claridad)
- [ ] **3-5 insights clave** en bullets
- [ ] **Fuente de datos** indicada en footer
- [ ] **Colores consistentes** con la marca (#54a34a)
- [ ] **Sin errores** de ortografía o formato
- [ ] **Responsive** en impresión A4 landscape
- [ ] **Page breaks correctos** (no corta gráficas ni tablas)

---

## 🚀 PROCESO DE TRABAJO

### Para cada página nueva:

1. **Definir objetivo**: ¿Qué debe entender el cliente?
2. **Elegir tipo**: Métricas, Comparativa, Ranking, Técnico, Conclusión
3. **Preparar datos**: Extraer de GA4/GSC/Ahrefs/Screaming Frog
4. **Crear JSON**: Usar plantilla correspondiente
5. **Revisar visualización**: ¿La gráfica ayuda a entender?
6. **Escribir insights**: 3-5 conclusiones accionables
7. **Validar calidad**: Usar checklist anterior
8. **Probar impresión**: Vista previa A4 landscape

---

## 📊 EJEMPLO COMPLETO: Página de Buscadores

```json
{
  "id": "pagina-011",
  "numero": 11,
  "titulo": "Ranking de Buscadores por Tráfico Orgánico",
  "subtitulo": "Distribución de sesiones por motor de búsqueda - Septiembre 2025",
  "contenido": {
    "tipo": "comparativa_buscadores",
    "datos": {
      "total_sesiones": 814,
      "buscadores": [
        {
          "nombre": "Google",
          "logo": "https://www.google.com/favicon.ico",
          "sesiones": 718,
          "porcentaje": 88.2,
          "clics": 64,
          "ctr": 8.9
        },
        {
          "nombre": "Bing",
          "logo": "https://www.bing.com/favicon.ico",
          "sesiones": 72,
          "porcentaje": 8.8,
          "clics": 7,
          "ctr": 9.7
        },
        {
          "nombre": "Yahoo",
          "logo": "https://www.yahoo.com/favicon.ico",
          "sesiones": 16,
          "porcentaje": 2.0,
          "clics": 1,
          "ctr": 6.3
        },
        {
          "nombre": "DuckDuckGo",
          "logo": "https://duckduckgo.com/favicon.ico",
          "sesiones": 8,
          "porcentaje": 1.0,
          "clics": 1,
          "ctr": 12.5
        }
      ]
    },
    "grafica": {
      "tipo": "doughnut",
      "titulo": "Cuota de Mercado por Buscador",
      "etiquetas": ["Google", "Bing", "Yahoo", "DuckDuckGo"],
      "valores": [88.2, 8.8, 2.0, 1.0],
      "colores": ["#54a34a", "#6ab85e", "#8cc77e", "#aed69e"]
    },
    "insights": [
      "Google domina con 88.2% del tráfico orgánico total (718 sesiones)",
      "Bing es el segundo buscador con 8.8%, relevante para estrategia multicanal",
      "DuckDuckGo muestra el mejor CTR (12.5%) pese a bajo volumen",
      "Oportunidad: optimizar para Bing dado su 9.7% de CTR"
    ]
  }
}
```

---

## 🎓 RECURSOS ADICIONALES

### Herramientas para extraer datos:

- **Google Analytics 4**: Informes → Adquisición → Tráfico
- **Search Console**: Rendimiento → Exportar
- **Ahrefs**: Site Explorer → Organic Keywords → Export
- **Screaming Frog**: Export → All Tabs → CSV

### Paleta de colores oficial:

- **Verde primario**: `#54a34a`
- **Verde secundario**: `#6ab85e`
- **Verde terciario**: `#8cc77e`
- **Verde claro**: `#aed69e`
- **Gris texto**: `#1a1a1a`
- **Gris secundario**: `#4a5568`
- **Gris claro**: `#e2e8f0`

---

## ✨ CONSEJOS FINALES

1. **Piensa como el cliente**: ¿Qué decisión puede tomar con esta información?
2. **Sé específico**: "Aumentar tráfico" ❌ → "Optimizar 12 keywords posición 11-20" ✅
3. **Contexto siempre**: Los números sin comparación no dicen nada
4. **Visual > Textual**: Una buena gráfica vale más que 100 palabras
5. **Accionable**: Cada insight debe poder convertirse en tarea

---

**Última actualización:** Octubre 2025
**Versión:** 1.0
**Autor:** Sistema de Auditoría SEO - Ibiza Villa
