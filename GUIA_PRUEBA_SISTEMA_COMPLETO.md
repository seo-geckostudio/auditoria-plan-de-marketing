# 🎯 GUÍA: Prueba del Sistema IA Local Completo

**URL del formulario:** http://localhost:8000/?modulo=auditorias&accion=formulario&auditoria_id=30&paso_id=968

---

## 📋 Pasos para Probar el Sistema

### 1. Abrir el Formulario
✅ Ya abierto en tu navegador

El formulario debe mostrar: **"BRIEF INICIAL DEL CLIENTE - AUDITORÍA SEO"**

---

### 2. Buscar el Botón de IA

Busca uno de estos botones en el formulario:
- 🤖 **"Asistencia con Inteligencia Artificial"**
- 🔍 **"Buscar con IA"**
- 📄 **"Importar desde Plantilla"**

Haz clic en **"Asistencia con Inteligencia Artificial"**

---

### 3. Sistema Detectará CLIs

Deberías ver un loading y luego:

```
═══════════════════════════════════════════
✅ CLIs detectadas correctamente
───────────────────────────────────────────

1. Selecciona la IA a usar:

☑ Ollama (100% Local) (v0.12.3)
  ✅ 100% Local • ✅ Configurado
  Modelos: qwq:latest, llama3.1:latest

☐ Claude CLI (v2.0.1)
  ⚠️ Requiere API • ❌ No configurado

☐ Gemini CLI (v0.1.7)
  ⚠️ Requiere API • ❌ No configurado
═══════════════════════════════════════════
```

---

### 4. Seleccionar Ollama

✅ Marca el radio button de **Ollama (100% Local)**

Aparecerá automáticamente:

```
2. Selecciona el modelo:
   [llama3.1:latest ▼]
```

**Modelo recomendado:** llama3.1:latest (más rápido)

---

### 5. Pegar Información del Cliente

Copia y pega este ejemplo en el textarea:

```
INFORMACIÓN DEL CLIENTE PARA AUDITORÍA SEO

Empresa: Marketing Digital Pro
Persona de contacto: Laura Martínez
Cargo: Directora de Marketing
Email: laura.martinez@marketingdigitalpro.com
Teléfono: +34 655 789 123

SOBRE LA EMPRESA:
Somos una agencia de marketing digital especializada en SEO y SEM.
Nuestro sitio web principal es www.marketingdigitalpro.com
También tenemos un blog en blog.marketingdigitalpro.com

TIPO DE NEGOCIO:
- Agencia de servicios B2B
- Sector: Marketing y Publicidad Digital
- Clientes principales: PYMEs y empresas medianas
- Servicios: SEO, SEM, Social Media, Content Marketing

OBJETIVOS SEO:
Objetivo principal: Incrementar tráfico orgánico en un 80% en los próximos 6 meses
Objetivos secundarios:
- Mejorar posicionamiento para "agencia seo madrid"
- Aumentar autoridad de dominio (DA) de 35 a 50
- Conseguir 20 backlinks de calidad al mes
- Mejorar conversión de visitas orgánicas del 2% al 4%

KPIs PRINCIPALES:
- Tráfico orgánico mensual
- Posiciones en Top 10 Google
- Domain Authority
- Tasa de conversión de leads orgánicos
- Número de páginas indexadas

COMPETIDORES:
Principales competidores directos:
1. www.agenciaseomaster.com
2. www.digitalmarketingexperts.es
3. www.seoagencypro.com

PROBLEMAS TÉCNICOS ACTUALES:
- Velocidad de carga lenta (3.5 segundos)
- Contenido duplicado en varias páginas
- Falta de optimización móvil en algunas secciones
- URLs no amigables en blog antiguo

PRESUPUESTO Y TIMELINE:
Presupuesto: Entre 3000€ y 5000€ mensuales
Timeline de implementación: 6 meses con revisiones mensuales
Urgencia: Media - quieren empezar en 2 semanas
```

---

### 6. Información Adicional (Opcional)

En el campo "Información adicional" puedes añadir:

```
Cliente premium, necesita resultados medibles cada mes
```

---

### 7. Generar Brief

Haz clic en el botón grande:

```
🪄 Generar Brief Automáticamente
```

---

### 8. Esperar Procesamiento

Verás:

```
═══════════════════════════════════════
⏳ Progreso
───────────────────────────────────────
Preparando consulta para Ollama (100% Local)...
Esperando respuesta de la IA...
Procesando respuesta...
JSON generado correctamente
═══════════════════════════════════════
```

**Tiempo estimado:** 10-30 segundos (dependiendo del prompt)

---

### 9. Revisar Preview

El sistema mostrará:

```
═══════════════════════════════════════════════════════
✅ ¡Brief generado correctamente!
───────────────────────────────────────────────────────

ℹ️ Información del Procesamiento:
• IA Usada: Ollama (100% Local)
• Modelo: llama3.1
• Tipo: ✅ 100% Local
• Tiempo de procesamiento: 12.5s

───────────────────────────────────────────────────────

📋 Preview de los Datos Extraídos:

▼ INFO GENERAL
  • nombre_empresa: Marketing Digital Pro
  • persona_contacto: Laura Martínez
  • email: laura.martinez@marketingdigitalpro.com
  • telefono: +34 655 789 123
  • cargo: Directora de Marketing

▶ WEBSITE
▶ MODELO NEGOCIO
▶ OBJETIVOS SEO
▶ COMPETIDORES
▶ PROBLEMAS TECNICOS
▶ PRESUPUESTO

[Ver JSON Completo ▼]

───────────────────────────────────────────────────────

[✅ Aplicar Datos al Formulario]
[Copiar JSON] [Nueva Consulta]

═══════════════════════════════════════════════════════
```

---

### 10. Revisar Datos Extraídos

Expande cada sección del accordion para verificar:

✅ **INFO GENERAL:**
- Nombre empresa: ¿Correcto?
- Contacto: ¿Correcto?
- Email: ¿Correcto?
- Teléfono: ¿Correcto?

✅ **WEBSITE:**
- URL principal: ¿Detectada?
- Otras URLs: ¿Blog detectado?

✅ **OBJETIVOS SEO:**
- Objetivo principal: ¿Claro?
- Objetivos secundarios: ¿Listados?
- KPIs: ¿Identificados?

✅ **COMPETIDORES:**
- ¿3 competidores detectados?

✅ **PRESUPUESTO:**
- Rango: ¿3000-5000€?
- Timeline: ¿6 meses?

---

### 11. Aplicar al Formulario

Si todo está bien:

1. Haz clic en **"✅ Aplicar Datos al Formulario"**

2. Confirma en el popup:
   ```
   ¿Confirmas que quieres aplicar estos datos al formulario?

   Esto sobrescribirá cualquier dato existente en los campos.

   [Aceptar] [Cancelar]
   ```

3. Verás:
   ```
   ✅ Datos aplicados correctamente al formulario
   ```

---

### 12. Verificar Formulario

El formulario debería tener ahora:

✅ **Información General del Cliente:**
- Nombre de la Empresa: Marketing Digital Pro
- Persona de Contacto: Laura Martínez
- Email: laura.martinez@marketingdigitalpro.com
- Teléfono: +34 655 789 123
- Cargo: Directora de Marketing

✅ **Información del Website:**
- URL Principal: www.marketingdigitalpro.com
- Otras URLs: blog.marketingdigitalpro.com

✅ **Modelo de Negocio:**
- Descripción: Agencia de servicios B2B...
- Tipo: B2B
- Sector: Marketing y Publicidad Digital

✅ **Objetivos SEO:**
- Objetivo Principal: Incrementar tráfico orgánico en un 80%...
- Objetivos Secundarios: [Lista de objetivos]

✅ **Competidores:**
- agenciaseomaster.com
- digitalmarketingexperts.es
- seoagencypro.com

✅ **Presupuesto:**
- Rango: 3000-5000€/mes
- Timeline: 6 meses con revisiones mensuales

---

## 🧪 Casos de Prueba Adicionales

### Prueba A: Brief Corto
```
Empresa: TechStart SL
Contacto: Pedro García
Email: pedro@techstart.com
Objetivo: Mejorar SEO local en Madrid
Presupuesto: 1500€/mes
```

### Prueba B: Brief con Archivo
1. Crea un archivo .txt con información del cliente
2. Súbelo usando el campo "O sube un archivo"
3. Ollama procesará el contenido del archivo

### Prueba C: Brief + Archivo Combinado
1. Pega texto general en el textarea
2. Sube archivo con detalles adicionales
3. Ollama combinará ambas fuentes

---

## ⚠️ Posibles Problemas

### Problema 1: "No se detectaron CLIs"
**Solución:** Verifica que Ollama esté corriendo:
```bash
ollama --version
```

### Problema 2: Loading infinito
**Solución:** Revisa la consola del navegador (F12)
Puede que haya un error JavaScript

### Problema 3: JSON inválido
**Solución:** Copia el JSON y valídalo en jsonlint.com
Si hay problemas, reporta el error

### Problema 4: Datos no aplicados
**Solución:** Verifica que `aplicarDatosInteligente()` esté cargada
Abre consola (F12) y escribe: `typeof aplicarDatosInteligente`
Debería decir: "function"

---

## 📊 Métricas a Observar

Durante la prueba, anota:

- ⏱️ **Tiempo de detección de CLIs:** _____s
- ⏱️ **Tiempo de procesamiento de Ollama:** _____s
- ✅ **¿JSON generado correctamente?** Sí / No
- ✅ **¿Datos aplicados al formulario?** Sí / No
- ✅ **¿Preview funciona bien?** Sí / No
- 📊 **Precisión de extracción:** ____%

**Precisión = (Campos correctos / Total campos) × 100**

---

## 🎯 Resultado Esperado

Al final de la prueba deberías tener:

✅ Formulario del Brief completamente rellenado
✅ Datos extraídos con >80% de precisión
✅ Tiempo total < 45 segundos
✅ No errores en consola
✅ JSON válido generado
✅ Preview detallado mostrado
✅ Confirmación antes de aplicar

---

## 📸 Screenshots Recomendados

Toma capturas de:

1. **Detección de CLIs** (opciones mostradas)
2. **Selector de modelos** (dropdown de Ollama)
3. **Preview del JSON** (accordion expandido)
4. **Información del procesamiento** (tiempos y modelo usado)
5. **Formulario rellenado** (resultado final)

---

## 🐛 Reportar Problemas

Si encuentras errores, anota:

1. **Paso donde ocurrió:** _____
2. **Error en consola (F12):** _____
3. **Comportamiento esperado:** _____
4. **Comportamiento observado:** _____
5. **JSON generado (si aplica):** _____

---

## ✅ Checklist Final

Marca cuando completes:

- [ ] Formulario abierto correctamente
- [ ] CLIs detectadas (mínimo Ollama)
- [ ] Ollama seleccionado
- [ ] Modelo llama3.1 seleccionado
- [ ] Información pegada
- [ ] Brief generado (sin errores)
- [ ] Preview mostrado correctamente
- [ ] Información del procesamiento visible
- [ ] Todas las secciones del accordion visibles
- [ ] JSON válido (verificado en collapse)
- [ ] Datos aplicados al formulario
- [ ] Campos del formulario rellenados
- [ ] No errores en consola (F12)

---

## 🎉 ¡Listo!

Si todos los checks están ✅, el sistema está **100% funcional**.

**Próximos pasos:**
1. Usar con briefs reales de clientes
2. Ajustar prompts si es necesario
3. Añadir más modelos de Ollama (opcional)
4. Documentar casos de uso específicos

---

**Documentos relacionados:**
- `PRUEBA_OLLAMA_EXITOSA.md` - Resultados de tests técnicos
- `SISTEMA_IA_LOCAL.md` - Documentación completa
- `CAMBIOS_IA_LOCAL_OLLAMA.md` - Cambios técnicos realizados
