# 📋 INSTRUCCIONES PARA LA FASE 2: KEYWORD RESEARCH

## 🎯 Objetivo de la Fase
Identificar todas las oportunidades de keywords relevantes para el negocio y crear un mapping estratégico que guíe la optimización y creación de contenido.

---

## 📊 ORDEN SECUENCIAL RECOMENDADO

### 1️⃣ Análisis Keywords Actuales (1-2 días)
**Documento:** `03_keywords_actuales.md`

**PROCESO PASO A PASO:**

#### Exportaciones GSC (30 min):
1. **Rendimiento > Consultas** (12 meses)
   - Filtrar: Impresiones >10
   - Orden: Impresiones (descendente)
   - Export: CSV con 1000+ filas

2. **Rendimiento > Páginas** (12 meses)
   - Incluir datos de consultas
   - Export: CSV completo

3. **Rendimiento > Dispositivos/Países** (si relevante)
   - Para análisis segmentado
   - Export: CSV

#### Exportaciones Ahrefs (45 min):
1. **Site Explorer > Organic Keywords**
   - Todas las posiciones (no filtrar)
   - Export: CSV completo

2. **Site Explorer > Top Pages**
   - Por tráfico orgánico
   - Incluir keywords data
   - Export: CSV

#### Análisis y categorización (2-4 horas):
1. **Combinar datos GSC + Ahrefs**
   - Usar VLOOKUP para comparar
   - Identificar discrepancias
   - Validar volúmenes

2. **Categorizar keywords:**
   - Marca vs No-marca
   - Navegacional vs Informacional vs Comercial vs Transaccional
   - Por producto/servicio

3. **Identificar oportunidades rápidas:**
   - Posiciones 11-20 con volumen alto
   - CTR bajo vs posición actual
   - Keywords con tendencia creciente

**⚠️ ERRORES COMUNES:**
- No filtrar datos de baja calidad (impresiones <10)
- No comparar GSC vs Ahrefs para validación
- Categorizar keywords sin entender la intención real
- No identificar patrones estacionales

---

### 2️⃣ Análisis de Competencia (1-2 días)
**Documento:** `04_analisis_competencia.md`

**PROCESO PASO A PASO:**

#### Identificación competidores (30 min):
1. **Validar competidores del brief**
   - ¿Son realmente competidores SEO?
   - ¿Atacan las mismas keywords?

2. **Identificar competidores SEO adicionales**
   - Usar Ahrefs "Competing Domains"
   - Validar relevancia por overlap keywords

#### Análisis por competidor (1 hora cada uno):
1. **Site Explorer > Overview**
   - Export métricas principales: PDF
   - Tomar screenshots para comparativa

2. **Organic Keywords**
   - Export CSV completo
   - Focus en keywords >1000 volumen

3. **Top Pages**
   - Export páginas con más tráfico
   - Analizar tipos de contenido

#### Keywords Gap Analysis (2 horas):
1. **Keywords Gap tool**
   - Cliente vs 3 competidores principales
   - Filtrar: Volumen >500, KD <70
   - Export oportunidades missing

2. **Análisis manual SERP**
   - Top 10 keywords objetivo
   - Verificar intención de búsqueda
   - Validar competencia real

**💡 INSIGHTS CLAVE A BUSCAR:**
- Keywords que TODOS los competidores tienen excepto cliente
- Páginas top de competidores (formatos que funcionan)
- Gaps en intención de búsqueda (info vs comercial)
- Patrones en arquitectura de contenido

---

### 3️⃣ Research Nuevas Oportunidades (1-2 días)
**Documento:** `05_oportunidades_keywords.md`

**PROCESO PASO A PASO:**

#### Expansión semántica (2 horas):
1. **Keywords Explorer por seed**
   - Usar 5-10 keywords semilla del brief
   - Export "Related Keywords" (filtrar KD <50)
   - Export "Questions" relacionadas

2. **Análisis por intención:**
   - Informational: guías, tutoriales, preguntas
   - Commercial: comparativas, reviews, "mejor"
   - Transactional: "comprar", "precio", "cotización"

#### Long-tail research (1.5 horas):
1. **Filtros específicos:**
   - 3-6 palabras de longitud
   - Volumen 100-2000
   - KD <30

2. **Google Suggest analysis:**
   - Búsquedas relacionadas para top keywords
   - Preguntas frecuentes ("People also ask")

#### Nichos emergentes (1 hora):
1. **Google Trends:**
   - Términos con crecimiento >25% último año
   - Temas estacionales no cubiertos

2. **Forum/Reddit research:**
   - Preguntas frecuentes en industria
   - Jerga específica del sector

**🎯 CRITERIOS PRIORIZACIÓN:**
- **Alta:** Volumen >1000, KD <20, intención comercial
- **Media:** Volumen 500-1000, KD 20-40, intención clara
- **Baja:** Volumen <500 o KD >40, intención informacional

---

### 4️⃣ Keyword Mapping Final (2-3 días)
**Documento:** `06_keyword_mapping.md`

**PROCESO PASO A PASO:**

#### Preparación mapping (1 hora):
1. **Inventario páginas actuales**
   - Crawl Screaming Frog básico
   - Lista URLs principales por sección
   - Identificar páginas sin optimizar

2. **Lista consolidada keywords**
   - Combinar actuales + oportunidades + competencia
   - Eliminar duplicados
   - Priorizar por volumen x facilidad

#### Mapping sistemático (4-6 horas):
1. **Páginas existentes PRIMERO**
   - Asignar keyword principal + secundarias
   - Identificar páginas que compiten (canibalizaciones)
   - Resolver conflictos antes de continuar

2. **Keywords huérfanas**
   - Listar keywords sin página específica
   - Proponer nuevas páginas/contenido
   - Agrupar en content clusters

3. **Content clusters**
   - Página pilar + páginas de soporte
   - Estrategia enlazado interno
   - Timeline de creación

#### Validación mapping (1 hora):
1. **Revisión balance intenciones**
   - ¿Suficiente contenido comercial?
   - ¿Demasiado enfoque informacional?
   - ¿Cubre todo el customer journey?

2. **Feasibility check**
   - ¿Es realista el timeline propuesto?
   - ¿Hay recursos para crear contenido?
   - ¿Se alinea con objetivos de negocio?

**🚨 VALIDACIONES CRÍTICAS:**
- Una keyword principal por página máximo
- Resolver canibalizaciones antes de optimizar
- Priorizar comercial sobre informacional si es B2B
- Timeline realista basado en recursos disponibles

---

## 📊 FLUJO DE DATOS ENTRE DOCUMENTOS

```
03_keywords_actuales.md
         ↓
(keywords con potencial)
         ↓
04_analisis_competencia.md
         ↓
(gaps + oportunidades competencia)
         ↓
05_oportunidades_keywords.md
         ↓
(nuevas keywords identificadas)
         ↓
06_keyword_mapping.md
(asignación final a páginas)
```

---

## 🛠️ HERRAMIENTAS Y CONFIGURACIONES

### Ahrefs Settings Recomendadas:
- **Country:** Coincidir con target geográfico cliente
- **Search Engine:** Google (salvo especificación contraria)
- **Data mode:** Live (no histórica para research)
- **Keyword filters:** Siempre incluir volume + KD

### Google Search Console:
- **Período:** Últimos 12 meses para tendencias
- **Filtros:** Impresiones >10, CTR >0.1%
- **Países:** Filtrar solo mercados objetivo

### Spreadsheet Setup:
```
Columnas estándar para todos los análisis:
- Keyword
- Volumen (Ahrefs)
- KD (Keyword Difficulty)
- CPC
- Intención (Navegacional/Informacional/Comercial/Transaccional)
- Cliente rankea (Sí/No/Posición)
- Competidor que rankea
- Prioridad (Alta/Media/Baja)
- Acción sugerida
- Página target
```

---

## ⏱️ TIMELINE DETALLADO RECOMENDADO

### Semana 1:
- **Días 1-2:** Keywords actuales + primeras exportaciones
- **Días 3-4:** Análisis competencia principal
- **Día 5:** Review y correcciones

### Semana 2:
- **Días 1-2:** Research oportunidades + long-tail
- **Días 3-5:** Keyword mapping + content clusters

### Checkpoints obligatorios:
- **Día 3:** Validar keywords actuales con cliente
- **Día 7:** Confirmar competidores principales
- **Día 10:** Preview oportunidades principales
- **Día 12:** Mapping final para aprobación

---

## ⚠️ SEÑALES DE ALERTA

### Datos insuficientes:
- GSC con <3 meses de historial
- Ahrefs muestra <100 keywords orgánicas
- Competidores identificados no son relevantes

### Red flags metodológicos:
- Todas las keywords son informacionales
- No hay keywords de marca posicionando
- KD promedio >60 en todas las oportunidades
- No se encontraron gaps vs competencia

### Problemas de negocio:
- Cliente no puede crear contenido nuevo
- No hay presupuesto para desarrollo
- Expectativas irreales de timeline
- Cambios constantes en objetivos/prioridades

---

## 📈 MÉTRICAS DE ÉXITO FASE 2

### Outputs mínimos requeridos:
- **150+ keywords actuales** categorizadas
- **3+ competidores** analizados completamente
- **100+ oportunidades nuevas** identificadas
- **50+ keywords mapeadas** a páginas específicas
- **5+ content clusters** planificados

### Validación calidad:
- **80%+ keywords** tienen volumen validado Ahrefs
- **100% páginas principales** tienen keyword asignada
- **0 canibalizaciones** sin resolver en mapping final
- **Timeline realista** validado con recursos disponibles

---

## 🔄 TRANSICIÓN A FASE 3

### Antes de avanzar verificar:
- [ ] **Mapping validado y aprobado por cliente**
- [ ] **Prioridades claras para arquitectura**
- [ ] **Lista de páginas nuevas a crear definida**
- [ ] **Keywords objetivo para tracking configuradas**

### Outputs para Fase 3:
- Lista keywords comerciales principales (para arquitectura)
- URLs actuales vs URLs recomendadas
- Plan de content clusters (para estructura sitio)
- Canibalizaciones identificadas (para resolución)

**⏰ Tiempo estimado Fase 2: 5-8 días según complejidad del sitio**