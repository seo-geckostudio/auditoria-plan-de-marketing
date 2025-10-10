#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para extraer y analizar contenido del PDF de auditoría SEO técnica
Archivo: auditoria seo tecnica.pdf (131 páginas)
"""

import PyPDF2
import pdfplumber
import re
import json
from pathlib import Path
import sys

def extract_text_pypdf2(pdf_path):
    """Extrae texto usando PyPDF2"""
    text_content = []
    try:
        with open(pdf_path, 'rb') as file:
            pdf_reader = PyPDF2.PdfReader(file)
            total_pages = len(pdf_reader.pages)
            print(f"Total de páginas detectadas: {total_pages}")
            
            for page_num in range(total_pages):
                page = pdf_reader.pages[page_num]
                text = page.extract_text()
                text_content.append({
                    'page': page_num + 1,
                    'text': text.strip()
                })
                
    except Exception as e:
        print(f"Error con PyPDF2: {e}")
        return None
    
    return text_content

def extract_text_pdfplumber(pdf_path):
    """Extrae texto usando pdfplumber (más preciso)"""
    text_content = []
    try:
        with pdfplumber.open(pdf_path) as pdf:
            total_pages = len(pdf.pages)
            print(f"Total de páginas detectadas con pdfplumber: {total_pages}")
            
            for page_num, page in enumerate(pdf.pages):
                text = page.extract_text()
                if text:
                    text_content.append({
                        'page': page_num + 1,
                        'text': text.strip()
                    })
                    
    except Exception as e:
        print(f"Error con pdfplumber: {e}")
        return None
    
    return text_content

def identify_sections(text_content):
    """Identifica las secciones principales del documento"""
    sections = {
        'situacion_actual': [],
        'keywords': [],
        'seo_onpage': [],
        'seo_offpage': [],
        'priorizacion': [],
        'otros': []
    }
    
    # Patrones para identificar secciones
    patterns = {
        'situacion_actual': [
            r'situaci[óo]n\s+actual',
            r'estado\s+actual',
            r'an[áa]lisis\s+inicial',
            r'diagn[óo]stico'
        ],
        'keywords': [
            r'keywords?',
            r'palabras\s+clave',
            r'keyword\s+research',
            r'investigaci[óo]n\s+de\s+palabras'
        ],
        'seo_onpage': [
            r'seo\s+on[-\s]?page',
            r'optimizaci[óo]n\s+interna',
            r'seo\s+t[ée]cnico',
            r'meta\s+tags'
        ],
        'seo_offpage': [
            r'seo\s+off[-\s]?page',
            r'link\s+building',
            r'enlaces\s+externos',
            r'autoridad\s+de\s+dominio'
        ],
        'priorizacion': [
            r'priorizaci[óo]n',
            r'prioridades',
            r'recomendaciones',
            r'plan\s+de\s+acci[óo]n'
        ]
    }
    
    for page_data in text_content:
        page_num = page_data['page']
        text = page_data['text'].lower()
        
        section_found = False
        for section, section_patterns in patterns.items():
            for pattern in section_patterns:
                if re.search(pattern, text, re.IGNORECASE):
                    sections[section].append(page_num)
                    section_found = True
                    break
            if section_found:
                break
        
        if not section_found:
            sections['otros'].append(page_num)
    
    return sections

def analyze_content_structure(text_content):
    """Analiza la estructura del contenido"""
    analysis = {
        'total_pages': len(text_content),
        'pages_with_content': 0,
        'average_text_length': 0,
        'titles_found': [],
        'key_terms': {}
    }
    
    total_text_length = 0
    key_terms = [
        'seo', 'keywords', 'google', 'analytics', 'search console',
        'meta', 'title', 'description', 'h1', 'h2', 'enlaces',
        'contenido', 'optimización', 'ranking', 'tráfico'
    ]
    
    for page_data in text_content:
        text = page_data['text']
        if text:
            analysis['pages_with_content'] += 1
            total_text_length += len(text)
            
            # Buscar títulos (líneas que empiezan con mayúscula y son cortas)
            lines = text.split('\n')
            for line in lines:
                line = line.strip()
                if (len(line) < 100 and len(line) > 10 and 
                    line[0].isupper() and not line.endswith('.')):
                    analysis['titles_found'].append({
                        'page': page_data['page'],
                        'title': line
                    })
            
            # Contar términos clave
            text_lower = text.lower()
            for term in key_terms:
                count = text_lower.count(term)
                if term not in analysis['key_terms']:
                    analysis['key_terms'][term] = 0
                analysis['key_terms'][term] += count
    
    if analysis['pages_with_content'] > 0:
        analysis['average_text_length'] = total_text_length / analysis['pages_with_content']
    
    return analysis

def save_results(text_content, sections, analysis, output_dir):
    """Guarda los resultados del análisis"""
    output_path = Path(output_dir)
    output_path.mkdir(exist_ok=True)
    
    # Guardar contenido completo
    with open(output_path / 'contenido_completo.json', 'w', encoding='utf-8') as f:
        json.dump(text_content, f, ensure_ascii=False, indent=2)
    
    # Guardar análisis de secciones
    with open(output_path / 'secciones_identificadas.json', 'w', encoding='utf-8') as f:
        json.dump(sections, f, ensure_ascii=False, indent=2)
    
    # Guardar análisis estructural
    with open(output_path / 'analisis_estructura.json', 'w', encoding='utf-8') as f:
        json.dump(analysis, f, ensure_ascii=False, indent=2)
    
    # Crear resumen en texto
    with open(output_path / 'resumen_analisis.txt', 'w', encoding='utf-8') as f:
        f.write("ANÁLISIS DEL PDF DE AUDITORÍA SEO TÉCNICA\n")
        f.write("=" * 50 + "\n\n")
        
        f.write(f"Total de páginas: {analysis['total_pages']}\n")
        f.write(f"Páginas con contenido: {analysis['pages_with_content']}\n")
        f.write(f"Longitud promedio de texto: {analysis['average_text_length']:.0f} caracteres\n\n")
        
        f.write("SECCIONES IDENTIFICADAS:\n")
        f.write("-" * 25 + "\n")
        for section, pages in sections.items():
            if pages:
                f.write(f"{section.upper()}: páginas {', '.join(map(str, pages))}\n")
        
        f.write("\nTÉRMINOS CLAVE MÁS FRECUENTES:\n")
        f.write("-" * 30 + "\n")
        sorted_terms = sorted(analysis['key_terms'].items(), key=lambda x: x[1], reverse=True)
        for term, count in sorted_terms[:10]:
            f.write(f"{term}: {count} menciones\n")
        
        f.write("\nTÍTULOS ENCONTRADOS (primeros 20):\n")
        f.write("-" * 35 + "\n")
        for i, title_data in enumerate(analysis['titles_found'][:20]):
            f.write(f"Página {title_data['page']}: {title_data['title']}\n")

def main():
    pdf_path = r"c:\ai\investigacionauditoria programacion\FASE_5_ENTREGABLES_FINALES\auditoria seo tecnica.pdf"
    output_dir = r"c:\ai\investigacionauditoria programacion\analisis_pdf_auditoria"
    
    print("Iniciando análisis del PDF de auditoría SEO técnica...")
    print(f"Archivo: {pdf_path}")
    
    # Verificar que el archivo existe
    if not Path(pdf_path).exists():
        print(f"ERROR: No se encuentra el archivo {pdf_path}")
        return
    
    # Intentar extracción con pdfplumber primero (más preciso)
    print("\nExtrayendo contenido con pdfplumber...")
    text_content = extract_text_pdfplumber(pdf_path)
    
    if not text_content:
        print("Fallback a PyPDF2...")
        text_content = extract_text_pypdf2(pdf_path)
    
    if not text_content:
        print("ERROR: No se pudo extraer contenido del PDF")
        return
    
    print(f"Contenido extraído exitosamente: {len(text_content)} páginas")
    
    # Identificar secciones
    print("\nIdentificando secciones...")
    sections = identify_sections(text_content)
    
    # Analizar estructura
    print("Analizando estructura del contenido...")
    analysis = analyze_content_structure(text_content)
    
    # Guardar resultados
    print(f"\nGuardando resultados en: {output_dir}")
    save_results(text_content, sections, analysis, output_dir)
    
    print("\n¡Análisis completado exitosamente!")
    print(f"Revisa los archivos generados en: {output_dir}")

if __name__ == "__main__":
    main()