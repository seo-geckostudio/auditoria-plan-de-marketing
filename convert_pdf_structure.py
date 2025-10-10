#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para convertir la estructura del PDF extraído al formato web requerido
"""

import json
import re

def mapear_fuentes(fuentes_originales):
    """Mapea fuentes de datos del PDF al formato web"""
    mapeo = {
        'google_analytics': 'GA4',
        'google_search_console': 'GSC', 
        'ahrefs': 'Ahrefs',
        'screaming_frog': 'Screaming Frog',
        'semrush': 'SEMrush',
        'pagespeed': 'PageSpeed',
        'manual': 'Análisis Manual'
    }
    return [mapeo.get(f, f.replace('_', ' ').title()) for f in fuentes_originales]

def generar_bullets(texto, subtitulos, metricas):
    """Genera bullets a partir del texto completo, subtítulos y métricas"""
    bullets = []
    
    # Agregar subtítulos como bullets si existen
    if subtitulos and isinstance(subtitulos, list):
        for subtitulo in subtitulos:
            if isinstance(subtitulo, str) and len(subtitulo.strip()) > 0:
                bullets.append(subtitulo.strip())
    
    # Agregar métricas como bullets si existen
    if metricas and isinstance(metricas, list):
        for metrica in metricas:
            if isinstance(metrica, str) and len(metrica.strip()) > 0:
                bullets.append(metrica.strip())
            elif isinstance(metrica, dict):
                # Si es un diccionario, intentar extraer valores útiles
                for key, value in metrica.items():
                    if isinstance(value, str) and len(value.strip()) > 0:
                        bullets.append(f"{key}: {value.strip()}")
    
    # Si no hay bullets de subtítulos/métricas, extraer del texto
    if not bullets and texto:
        # Buscar líneas que empiecen con • o ➔ o números
        lineas = texto.split('\n')
        for linea in lineas:
            linea = linea.strip()
            if linea.startswith('•') or linea.startswith('➔') or linea.startswith('-'):
                bullets.append(linea)
            elif len(linea) > 10 and not linea.startswith('*FUENTE'):
                # Agregar líneas significativas como bullets
                bullets.append(linea)
    
    # Limitar a máximo 5 bullets para mantener legibilidad
    return bullets[:5]

def main():
    # Cargar datos del PDF extraído
    with open('analisis_pdf_auditoria/analisis_estructura.json', 'r', encoding='utf-8') as f:
        pdf_data = json.load(f)

    # Convertir estructura
    web_structure = {
        'proyecto': {
            'nombre': 'Ibiza Villa',
            'color_corporativo': '#54a34a',
            'fuente_headers': 'TWKEverett-Regular',
            'fuente_texto': 'Hanken Grotesk'
        },
        'paginas': []
    }

    # Agregar portada e índice
    web_structure['paginas'].extend([
        {
            'id': 'portada',
            'titulo': 'Portada',
            'subtitulo': 'Auditoría SEO Técnica — Ibiza Villa',
            'fuentes': ['Integrado'],
            'bullets': []
        },
        {
            'id': 'indice', 
            'titulo': 'Índice interactivo',
            'subtitulo': 'Navegación rápida por secciones',
            'fuentes': ['Integrado'],
            'bullets': []
        }
    ])

    # Convertir páginas del PDF
    for i, pagina in enumerate(pdf_data['paginas']):
        numero = pagina.get('numero', i + 1)
        titulo = pagina.get('titulo_principal', f'Página {numero}')
        
        # Generar subtítulo desde subtítulos o tipo de contenido
        subtitulos = pagina.get('subtitulos', [])
        if subtitulos and len(subtitulos) > 0:
            subtitulo = subtitulos[0][:80] + ('...' if len(subtitulos[0]) > 80 else '')
        else:
            tipo = pagina.get('tipo_contenido', 'contenido_general')
            subtitulo = tipo.replace('_', ' ').title()
        
        # Mapear fuentes
        fuentes_orig = pagina.get('fuente_datos', ['manual'])
        fuentes = mapear_fuentes(fuentes_orig)
        
        # Generar bullets
        texto = pagina.get('texto_completo', '')
        metricas = pagina.get('metricas_identificadas', [])
        bullets = generar_bullets(texto, subtitulos, metricas)
        
        web_structure['paginas'].append({
            'id': f'pagina-{numero:03d}',
            'titulo': titulo,
            'subtitulo': subtitulo,
            'fuentes': fuentes,
            'bullets': bullets
        })

    # Guardar estructura convertida
    with open('analisis_pdf_auditoria/analisis_estructura.json', 'w', encoding='utf-8') as f:
        json.dump(web_structure, f, ensure_ascii=False, indent=2)

    print(f'✅ Convertida estructura: {len(web_structure["paginas"])} páginas')
    print(f'📄 Páginas del PDF: {len(pdf_data["paginas"])}')
    print(f'🎯 Total páginas web: {len(web_structure["paginas"])}')

if __name__ == '__main__':
    main()