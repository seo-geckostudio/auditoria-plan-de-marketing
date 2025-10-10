#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para analizar completamente el PDF de auditoría SEO
y generar especificaciones detalladas de cada página
"""

import PyPDF2
import pdfplumber
import re
import json
import os
from pathlib import Path

def analizar_pdf_completo(pdf_path):
    """
    Analiza el PDF completo página por página para extraer:
    - Estructura exacta
    - Contenido específico
    - Tipos de visualización
    - Fuentes de datos necesarias
    """
    
    especificaciones = {
        "total_paginas": 0,
        "paginas": [],
        "secciones": {},
        "tipos_contenido": {}
    }
    
    print(f"Analizando PDF: {pdf_path}")
    
    try:
        with pdfplumber.open(pdf_path) as pdf:
            total_paginas = len(pdf.pages)
            especificaciones["total_paginas"] = total_paginas
            
            print(f"Total de páginas encontradas: {total_paginas}")
            
            for i, page in enumerate(pdf.pages, 1):
                print(f"Procesando página {i}/{total_paginas}")
                
                # Extraer texto completo
                texto = page.extract_text() or ""
                
                # Extraer tablas
                tablas = page.extract_tables()
                
                # Analizar elementos visuales
                elementos_visuales = analizar_elementos_visuales(page)
                
                # Identificar tipo de contenido
                tipo_contenido = identificar_tipo_contenido(texto, tablas)
                
                # Extraer títulos y secciones
                titulos = extraer_titulos(texto)
                
                # Determinar fuente de datos
                fuente_datos = determinar_fuente_datos(texto, tipo_contenido)
                
                pagina_spec = {
                    "numero": i,
                    "titulo_principal": titulos.get("principal", ""),
                    "subtitulos": titulos.get("subtitulos", []),
                    "tipo_contenido": tipo_contenido,
                    "texto_completo": texto[:500] + "..." if len(texto) > 500 else texto,
                    "num_tablas": len(tablas) if tablas else 0,
                    "tablas_detalle": analizar_tablas(tablas) if tablas else [],
                    "elementos_visuales": elementos_visuales,
                    "fuente_datos": fuente_datos,
                    "metricas_identificadas": extraer_metricas(texto),
                    "visualizacion_requerida": determinar_visualizacion(texto, tablas, elementos_visuales)
                }
                
                especificaciones["paginas"].append(pagina_spec)
                
                # Agrupar por secciones
                seccion = identificar_seccion(texto, titulos)
                if seccion not in especificaciones["secciones"]:
                    especificaciones["secciones"][seccion] = []
                especificaciones["secciones"][seccion].append(i)
                
                # Contar tipos de contenido
                if tipo_contenido not in especificaciones["tipos_contenido"]:
                    especificaciones["tipos_contenido"][tipo_contenido] = 0
                especificaciones["tipos_contenido"][tipo_contenido] += 1
    
    except Exception as e:
        print(f"Error al procesar PDF: {e}")
        return None
    
    return especificaciones

def analizar_elementos_visuales(page):
    """Analiza elementos visuales en la página"""
    elementos = {
        "imagenes": 0,
        "graficos": False,
        "charts": False,
        "logos": False,
        "diagramas": False
    }
    
    # Buscar imágenes
    if hasattr(page, 'images'):
        elementos["imagenes"] = len(page.images)
    
    # Buscar elementos gráficos por texto
    texto = page.extract_text() or ""
    if any(word in texto.lower() for word in ['gráfico', 'chart', 'graph', 'diagram']):
        elementos["graficos"] = True
    
    return elementos

def identificar_tipo_contenido(texto, tablas):
    """Identifica el tipo de contenido de la página"""
    texto_lower = texto.lower()
    
    # Patrones para identificar tipos de contenido
    patrones = {
        "portada": ["auditoría", "seo", "técnica", "informe"],
        "resumen_ejecutivo": ["resumen", "ejecutivo", "summary", "overview"],
        "metricas_trafico": ["sesiones", "usuarios", "pageviews", "tráfico", "visitas"],
        "keywords": ["palabras clave", "keywords", "posiciones", "ranking"],
        "analisis_tecnico": ["crawl", "indexación", "robots.txt", "sitemap", "404", "301"],
        "velocidad": ["velocidad", "speed", "performance", "carga", "lcp", "fcp"],
        "mobile": ["móvil", "mobile", "responsive", "dispositivos"],
        "contenido": ["contenido", "content", "texto", "h1", "h2", "meta"],
        "enlaces": ["enlaces", "links", "backlinks", "linking", "autoridad"],
        "competencia": ["competencia", "competitors", "competidores"],
        "recomendaciones": ["recomendaciones", "recommendations", "acciones", "mejoras"],
        "graficos": ["gráfico", "chart", "datos", "estadísticas"],
        "tablas": ["tabla", "listado", "datos tabulares"]
    }
    
    for tipo, palabras in patrones.items():
        if any(palabra in texto_lower for palabra in palabras):
            if tablas and len(tablas) > 0:
                return f"{tipo}_con_tablas"
            return tipo
    
    if tablas and len(tablas) > 0:
        return "datos_tabulares"
    
    return "contenido_general"

def extraer_titulos(texto):
    """Extrae títulos principales y subtítulos"""
    lineas = texto.split('\n')
    titulos = {"principal": "", "subtitulos": []}
    
    for linea in lineas[:10]:  # Revisar primeras 10 líneas
        linea = linea.strip()
        if len(linea) > 5 and len(linea) < 100:
            if not titulos["principal"] and (linea.isupper() or any(char.isupper() for char in linea)):
                titulos["principal"] = linea
            elif linea and linea != titulos["principal"]:
                titulos["subtitulos"].append(linea)
    
    return titulos

def determinar_fuente_datos(texto, tipo_contenido):
    """Determina de dónde obtener los datos para replicar el contenido"""
    fuentes = {
        "google_analytics": ["Google Analytics", "GA", "sesiones", "usuarios", "pageviews"],
        "search_console": ["Search Console", "GSC", "impresiones", "clics", "posiciones"],
        "screaming_frog": ["Screaming Frog", "crawl", "spider", "rastreo"],
        "ahrefs": ["Ahrefs", "DR", "UR", "backlinks"],
        "semrush": ["SEMrush", "keywords", "competencia"],
        "pagespeed": ["PageSpeed", "velocidad", "performance", "Core Web Vitals"],
        "manual": ["análisis manual", "revisión", "inspección"],
        "herramientas_seo": ["herramientas SEO", "tools", "análisis técnico"]
    }
    
    texto_lower = texto.lower()
    fuentes_identificadas = []
    
    for fuente, palabras in fuentes.items():
        if any(palabra.lower() in texto_lower for palabra in palabras):
            fuentes_identificadas.append(fuente)
    
    if not fuentes_identificadas:
        # Determinar por tipo de contenido
        mapeo_tipo_fuente = {
            "metricas_trafico": ["google_analytics"],
            "keywords": ["search_console", "ahrefs", "semrush"],
            "analisis_tecnico": ["screaming_frog", "manual"],
            "velocidad": ["pagespeed"],
            "enlaces": ["ahrefs", "semrush"],
            "competencia": ["ahrefs", "semrush"]
        }
        
        for tipo, fuentes_default in mapeo_tipo_fuente.items():
            if tipo in tipo_contenido:
                fuentes_identificadas.extend(fuentes_default)
    
    return fuentes_identificadas if fuentes_identificadas else ["manual"]

def extraer_metricas(texto):
    """Extrae métricas numéricas del texto"""
    metricas = []
    
    # Patrones para números con contexto
    patrones_metricas = [
        r'(\d{1,3}(?:,\d{3})*)\s*(sesiones|usuarios|pageviews|visitas)',
        r'(\d+(?:\.\d+)?)\s*%\s*(CTR|bounce|conversión)',
        r'(\d+(?:\.\d+)?)\s*(segundos|seg|s)\s*(carga|velocidad)',
        r'(\d+)\s*(keywords|palabras clave|posiciones)',
        r'(\d+)\s*(enlaces|backlinks|links)',
        r'(\d+)\s*(páginas|URLs|errores)'
    ]
    
    for patron in patrones_metricas:
        matches = re.finditer(patron, texto, re.IGNORECASE)
        for match in matches:
            metricas.append({
                "valor": match.group(1),
                "tipo": match.group(2),
                "contexto": match.group(0)
            })
    
    return metricas

def analizar_tablas(tablas):
    """Analiza las tablas encontradas"""
    tablas_detalle = []
    
    for i, tabla in enumerate(tablas):
        if tabla and len(tabla) > 0:
            detalle = {
                "numero": i + 1,
                "filas": len(tabla),
                "columnas": len(tabla[0]) if tabla[0] else 0,
                "headers": tabla[0] if tabla[0] else [],
                "tipo_datos": identificar_tipo_datos_tabla(tabla),
                "muestra_datos": tabla[:3] if len(tabla) > 1 else tabla
            }
            tablas_detalle.append(detalle)
    
    return tablas_detalle

def identificar_tipo_datos_tabla(tabla):
    """Identifica el tipo de datos en la tabla"""
    if not tabla or len(tabla) < 2:
        return "desconocido"
    
    headers = [str(cell).lower() if cell else "" for cell in tabla[0]]
    
    if any(word in " ".join(headers) for word in ["keyword", "palabra", "posición", "ranking"]):
        return "keywords"
    elif any(word in " ".join(headers) for word in ["url", "página", "status", "código"]):
        return "urls_tecnico"
    elif any(word in " ".join(headers) for word in ["sesiones", "usuarios", "tráfico"]):
        return "metricas_trafico"
    elif any(word in " ".join(headers) for word in ["enlace", "link", "dominio"]):
        return "enlaces"
    else:
        return "datos_generales"

def determinar_visualizacion(texto, tablas, elementos_visuales):
    """Determina qué tipo de visualización se necesita"""
    visualizaciones = []
    
    # Basado en tablas
    if tablas:
        for tabla in tablas:
            if tabla and len(tabla) > 1:
                visualizaciones.append("tabla_html")
    
    # Basado en elementos visuales
    if elementos_visuales.get("graficos"):
        visualizaciones.append("grafico_chart_js")
    
    # Basado en contenido textual
    texto_lower = texto.lower()
    if any(word in texto_lower for word in ["gráfico", "chart", "estadística"]):
        visualizaciones.append("grafico_interactivo")
    
    if any(word in texto_lower for word in ["lista", "listado", "elementos"]):
        visualizaciones.append("lista_html")
    
    if not visualizaciones:
        visualizaciones.append("texto_formateado")
    
    return visualizaciones

def identificar_seccion(texto, titulos):
    """Identifica a qué sección pertenece la página"""
    texto_completo = (titulos.get("principal", "") + " " + " ".join(titulos.get("subtitulos", [])) + " " + texto).lower()
    
    secciones = {
        "introduccion": ["portada", "índice", "introducción", "overview"],
        "resumen_ejecutivo": ["resumen", "ejecutivo", "summary", "conclusiones"],
        "analisis_actual": ["situación actual", "análisis", "estado", "diagnóstico"],
        "metricas_rendimiento": ["rendimiento", "métricas", "kpis", "performance"],
        "analisis_tecnico": ["técnico", "crawl", "indexación", "estructura"],
        "contenido_seo": ["contenido", "seo", "optimización", "keywords"],
        "experiencia_usuario": ["usuario", "ux", "usabilidad", "móvil"],
        "competencia": ["competencia", "competitors", "benchmark"],
        "recomendaciones": ["recomendaciones", "acciones", "plan", "mejoras"],
        "anexos": ["anexo", "apéndice", "datos", "detalles"]
    }
    
    for seccion, palabras in secciones.items():
        if any(palabra in texto_completo for palabra in palabras):
            return seccion
    
    return "general"

def generar_documento_especificaciones(especificaciones, output_path):
    """Genera el documento de especificaciones en Markdown"""
    
    contenido = f"""# 📋 ESPECIFICACIONES DETALLADAS - AUDITORÍA SEO WEB
## Replicación del PDF Original en HTML para Impresión A4 Apaisado

### 📊 RESUMEN GENERAL
- **Total de páginas**: {especificaciones['total_paginas']}
- **Secciones identificadas**: {len(especificaciones['secciones'])}
- **Tipos de contenido**: {len(especificaciones['tipos_contenido'])}

### 🗂️ DISTRIBUCIÓN POR SECCIONES
"""
    
    for seccion, paginas in especificaciones['secciones'].items():
        contenido += f"- **{seccion.replace('_', ' ').title()}**: Páginas {', '.join(map(str, paginas))} ({len(paginas)} páginas)\n"
    
    contenido += f"""

### 📈 TIPOS DE CONTENIDO IDENTIFICADOS
"""
    
    for tipo, cantidad in especificaciones['tipos_contenido'].items():
        contenido += f"- **{tipo.replace('_', ' ').title()}**: {cantidad} páginas\n"
    
    contenido += f"""

---

## 📄 ESPECIFICACIONES DETALLADAS POR PÁGINA

"""
    
    for pagina in especificaciones['paginas']:
        contenido += f"""
### 📄 PÁGINA {pagina['numero']}

**🏷️ Título Principal**: {pagina['titulo_principal'] or 'Sin título identificado'}

**📂 Sección**: {identificar_seccion_pagina(pagina['numero'], especificaciones['secciones'])}

**🎯 Tipo de Contenido**: {pagina['tipo_contenido'].replace('_', ' ').title()}

**📝 Subtítulos**:
{chr(10).join([f"- {sub}" for sub in pagina['subtitulos']]) if pagina['subtitulos'] else "- No se identificaron subtítulos"}

**📊 Contenido Identificado**:
- **Texto**: {'Sí' if pagina['texto_completo'] else 'No'}
- **Tablas**: {pagina['num_tablas']} tabla(s)
- **Elementos visuales**: {'Sí' if any(pagina['elementos_visuales'].values()) else 'No'}

**🔍 Métricas Identificadas**:
{chr(10).join([f"- {m['contexto']}" for m in pagina['metricas_identificadas']]) if pagina['metricas_identificadas'] else "- No se identificaron métricas específicas"}

**📋 Detalles de Tablas**:
"""
        
        if pagina['tablas_detalle']:
            for tabla in pagina['tablas_detalle']:
                contenido += f"""
- **Tabla {tabla['numero']}**: {tabla['filas']} filas × {tabla['columnas']} columnas
  - **Tipo**: {tabla['tipo_datos'].replace('_', ' ').title()}
  - **Headers**: {', '.join([str(h) for h in tabla['headers']]) if tabla['headers'] else 'Sin headers'}
"""
        else:
            contenido += "- No contiene tablas\n"
        
        contenido += f"""
**🎨 Visualización Requerida**:
{chr(10).join([f"- {vis.replace('_', ' ').title()}" for vis in pagina['visualizacion_requerida']])}

**📡 Fuente de Datos**:
{chr(10).join([f"- {fuente.replace('_', ' ').title()}" for fuente in pagina['fuente_datos']])}

**💻 Implementación HTML**:
- **Layout**: A4 Apaisado (297mm × 210mm)
- **CSS Print**: `@media print` específico
- **Elementos**: {'Tablas responsivas, ' if pagina['num_tablas'] > 0 else ''}{'Gráficos Chart.js, ' if any('grafico' in vis for vis in pagina['visualizacion_requerida']) else ''}Texto formateado

**🔄 Proceso de Obtención de Datos**:
"""
        
        # Generar proceso específico según fuente de datos
        for fuente in pagina['fuente_datos']:
            if fuente == 'google_analytics':
                contenido += "- Conectar con Google Analytics API para obtener métricas de tráfico\n"
            elif fuente == 'search_console':
                contenido += "- Extraer datos de Google Search Console (impresiones, clics, posiciones)\n"
            elif fuente == 'screaming_frog':
                contenido += "- Ejecutar crawl con Screaming Frog y procesar resultados\n"
            elif fuente == 'ahrefs':
                contenido += "- Consultar API de Ahrefs para métricas de enlaces y autoridad\n"
            elif fuente == 'semrush':
                contenido += "- Obtener datos de SEMrush para análisis de keywords y competencia\n"
            elif fuente == 'pagespeed':
                contenido += "- Ejecutar PageSpeed Insights API para métricas de velocidad\n"
            elif fuente == 'manual':
                contenido += "- Análisis manual y recopilación de datos específicos del sitio\n"
            else:
                contenido += f"- Proceso personalizado para {fuente.replace('_', ' ')}\n"
        
        contenido += f"""
**📝 Muestra de Contenido**:
```
{pagina['texto_completo'][:200]}...
```

---
"""
    
    contenido += f"""

## 🛠️ GUÍA DE IMPLEMENTACIÓN TÉCNICA

### 📱 Estructura HTML Base
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría SEO - Página {{numero}}</title>
    <link rel="stylesheet" href="styles/print.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="a4-landscape">
    <div class="page-container">
        <!-- Contenido específico de cada página -->
    </div>
</body>
</html>
```

### 🎨 CSS para Impresión A4 Apaisado
```css
@media print {{
    .a4-landscape {{
        width: 297mm;
        height: 210mm;
        margin: 0;
        padding: 20mm;
        page-break-after: always;
    }}
    
    .page-container {{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }}
}}
```

### 📊 Integración de Datos
- **APIs necesarias**: Google Analytics, Search Console, PageSpeed Insights
- **Herramientas**: Screaming Frog, Ahrefs/SEMrush (según disponibilidad)
- **Procesamiento**: Scripts Python para extracción y formateo de datos
- **Actualización**: Sistema automatizado para regenerar páginas con datos actuales

### 🔄 Flujo de Trabajo
1. **Extracción de datos** de todas las fuentes identificadas
2. **Procesamiento y formateo** según especificaciones de cada página
3. **Generación HTML** con datos actualizados de Ibiza Villa
4. **Aplicación de estilos** para impresión A4 apaisado
5. **Validación** de contenido y formato
6. **Exportación** a PDF final si es necesario

---

## 📋 CHECKLIST DE IMPLEMENTACIÓN

### ✅ Preparación
- [ ] Configurar acceso a todas las APIs necesarias
- [ ] Instalar y configurar herramientas de análisis
- [ ] Preparar estructura de archivos HTML/CSS
- [ ] Configurar scripts de extracción de datos

### ✅ Desarrollo por Secciones
"""
    
    for seccion, paginas in especificaciones['secciones'].items():
        contenido += f"- [ ] **{seccion.replace('_', ' ').title()}**: Páginas {', '.join(map(str, paginas))}\n"
    
    contenido += f"""
### ✅ Validación y Testing
- [ ] Verificar formato A4 apaisado en todas las páginas
- [ ] Comprobar legibilidad de tablas y gráficos
- [ ] Validar datos actualizados de Ibiza Villa
- [ ] Testing de impresión en diferentes navegadores
- [ ] Revisión final de contenido y formato

---

*Documento generado automáticamente el {__import__('datetime').datetime.now().strftime('%d/%m/%Y %H:%M')}*
*Total de páginas analizadas: {especificaciones['total_paginas']}*
"""
    
    # Guardar el documento
    with open(output_path, 'w', encoding='utf-8') as f:
        f.write(contenido)
    
    print(f"Documento de especificaciones guardado en: {output_path}")

def identificar_seccion_pagina(numero_pagina, secciones):
    """Identifica a qué sección pertenece una página específica"""
    for seccion, paginas in secciones.items():
        if numero_pagina in paginas:
            return seccion.replace('_', ' ').title()
    return "General"

def main():
    # Rutas de archivos
    pdf_path = r"c:\ai\investigacionauditoria programacion\FASE_5_ENTREGABLES_FINALES\auditoria seo tecnica.pdf"
    output_path = r"c:\ai\investigacionauditoria programacion\ESPECIFICACIONES_113_PAGINAS_AUDITORIA_WEB.md"
    json_output = r"c:\ai\investigacionauditoria programacion\especificaciones_detalladas.json"
    
    print("🔍 Iniciando análisis completo del PDF de auditoría SEO...")
    
    # Verificar que existe el PDF
    if not os.path.exists(pdf_path):
        print(f"❌ Error: No se encuentra el archivo PDF en {pdf_path}")
        return
    
    # Analizar PDF
    especificaciones = analizar_pdf_completo(pdf_path)
    
    if especificaciones:
        print(f"✅ Análisis completado. {especificaciones['total_paginas']} páginas procesadas.")
        
        # Guardar especificaciones en JSON
        with open(json_output, 'w', encoding='utf-8') as f:
            json.dump(especificaciones, f, ensure_ascii=False, indent=2)
        
        # Generar documento de especificaciones
        generar_documento_especificaciones(especificaciones, output_path)
        
        print(f"📄 Documento de especificaciones generado: {output_path}")
        print(f"💾 Datos detallados guardados en: {json_output}")
        
    else:
        print("❌ Error al analizar el PDF")

if __name__ == "__main__":
    main()