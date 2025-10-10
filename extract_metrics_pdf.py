#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script especializado para extraer métricas específicas del PDF de auditoría SEO técnica
Enfoque en datos cuantitativos, KPIs y métricas específicas
"""

import pdfplumber
import re
import json
from pathlib import Path
import sys
from datetime import datetime

class MetricsExtractor:
    def __init__(self, pdf_path):
        self.pdf_path = pdf_path
        self.metrics_data = {
            'trafico_organico': {},
            'conversiones': {},
            'rendimiento_paginas': {},
            'comparativas_yoy': {},
            'google_analytics': {},
            'search_console': {},
            'herramientas_seo': {},
            'autoridad_dominio': {},
            'perfil_enlaces': {},
            'kpis_baseline': {},
            'datos_tecnicos': {}
        }
        
        # Patrones para identificar métricas específicas
        self.patterns = {
            'numeros': r'\b\d{1,3}(?:,\d{3})*(?:\.\d+)?\b',
            'porcentajes': r'\b\d+(?:\.\d+)?%\b',
            'fechas': r'\b(?:enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre|\d{1,2}\/\d{1,2}\/\d{4}|\d{4}-\d{2}-\d{2})\b',
            'trafico': r'(?:tráfico|visitas|usuarios|sesiones|pageviews)\s*:?\s*(\d{1,3}(?:,\d{3})*)',
            'conversiones': r'(?:conversión|conversiones|conversion rate|tasa de conversión)\s*:?\s*(\d+(?:\.\d+)?%?)',
            'bounce_rate': r'(?:bounce rate|tasa de rebote)\s*:?\s*(\d+(?:\.\d+)?%)',
            'tiempo_pagina': r'(?:tiempo en página|time on page|duración)\s*:?\s*(\d+:\d+|\d+\.\d+)',
            'autoridad': r'(?:domain authority|da|page authority|pa|domain rating|dr)\s*:?\s*(\d+)',
            'enlaces': r'(?:backlinks|enlaces|links)\s*:?\s*(\d{1,3}(?:,\d{3})*)',
            'keywords': r'(?:keywords|palabras clave|posiciones)\s*:?\s*(\d{1,3}(?:,\d{3})*)',
            'ctr': r'(?:ctr|click through rate)\s*:?\s*(\d+(?:\.\d+)?%)',
            'impresiones': r'(?:impresiones|impressions)\s*:?\s*(\d{1,3}(?:,\d{3})*)',
            'clics': r'(?:clics|clicks)\s*:?\s*(\d{1,3}(?:,\d{3})*)',
            'posicion_media': r'(?:posición media|average position|posición promedio)\s*:?\s*(\d+(?:\.\d+)?)'
        }

    def extract_text_with_context(self):
        """Extrae texto manteniendo contexto de página y posición"""
        pages_content = []
        
        try:
            with pdfplumber.open(self.pdf_path) as pdf:
                total_pages = len(pdf.pages)
                print(f"Procesando {total_pages} páginas para extracción de métricas...")
                
                for page_num, page in enumerate(pdf.pages):
                    text = page.extract_text()
                    if text:
                        # Dividir en párrafos para mantener contexto
                        paragraphs = [p.strip() for p in text.split('\n\n') if p.strip()]
                        
                        pages_content.append({
                            'page': page_num + 1,
                            'full_text': text,
                            'paragraphs': paragraphs,
                            'lines': [line.strip() for line in text.split('\n') if line.strip()]
                        })
                        
        except Exception as e:
            print(f"Error extrayendo texto: {e}")
            return None
            
        return pages_content

    def extract_metrics_from_text(self, pages_content):
        """Extrae métricas específicas del texto"""
        
        for page_data in pages_content:
            page_num = page_data['page']
            full_text = page_data['full_text'].lower()
            lines = page_data['lines']
            
            # Buscar métricas de tráfico orgánico
            self._extract_traffic_metrics(full_text, lines, page_num)
            
            # Buscar métricas de conversión
            self._extract_conversion_metrics(full_text, lines, page_num)
            
            # Buscar datos de Google Analytics
            self._extract_ga_metrics(full_text, lines, page_num)
            
            # Buscar datos de Search Console
            self._extract_gsc_metrics(full_text, lines, page_num)
            
            # Buscar métricas de herramientas SEO
            self._extract_seo_tools_metrics(full_text, lines, page_num)
            
            # Buscar métricas de autoridad y enlaces
            self._extract_authority_metrics(full_text, lines, page_num)
            
            # Buscar comparativas año sobre año
            self._extract_yoy_comparisons(full_text, lines, page_num)

    def _extract_traffic_metrics(self, text, lines, page_num):
        """Extrae métricas específicas de tráfico"""
        traffic_keywords = [
            'tráfico orgánico', 'organic traffic', 'visitas orgánicas',
            'usuarios únicos', 'unique users', 'sesiones', 'sessions',
            'pageviews', 'páginas vistas'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in traffic_keywords:
                if keyword in line_lower:
                    # Buscar números en la línea
                    numbers = re.findall(self.patterns['numeros'], line)
                    percentages = re.findall(self.patterns['porcentajes'], line)
                    
                    if numbers or percentages:
                        if f'page_{page_num}' not in self.metrics_data['trafico_organico']:
                            self.metrics_data['trafico_organico'][f'page_{page_num}'] = []
                        
                        self.metrics_data['trafico_organico'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers,
                            'percentages': percentages
                        })

    def _extract_conversion_metrics(self, text, lines, page_num):
        """Extrae métricas de conversión"""
        conversion_keywords = [
            'tasa de conversión', 'conversion rate', 'conversiones',
            'objetivos', 'goals', 'embudo', 'funnel'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in conversion_keywords:
                if keyword in line_lower:
                    numbers = re.findall(self.patterns['numeros'], line)
                    percentages = re.findall(self.patterns['porcentajes'], line)
                    
                    if numbers or percentages:
                        if f'page_{page_num}' not in self.metrics_data['conversiones']:
                            self.metrics_data['conversiones'][f'page_{page_num}'] = []
                        
                        self.metrics_data['conversiones'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers,
                            'percentages': percentages
                        })

    def _extract_ga_metrics(self, text, lines, page_num):
        """Extrae métricas específicas de Google Analytics"""
        ga_keywords = [
            'google analytics', 'analytics', 'bounce rate', 'tasa de rebote',
            'tiempo en página', 'time on page', 'duración de sesión',
            'páginas por sesión', 'pages per session'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in ga_keywords:
                if keyword in line_lower:
                    numbers = re.findall(self.patterns['numeros'], line)
                    percentages = re.findall(self.patterns['porcentajes'], line)
                    
                    if numbers or percentages:
                        if f'page_{page_num}' not in self.metrics_data['google_analytics']:
                            self.metrics_data['google_analytics'][f'page_{page_num}'] = []
                        
                        self.metrics_data['google_analytics'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers,
                            'percentages': percentages
                        })

    def _extract_gsc_metrics(self, text, lines, page_num):
        """Extrae métricas de Google Search Console"""
        gsc_keywords = [
            'search console', 'gsc', 'impresiones', 'impressions',
            'clics', 'clicks', 'ctr', 'posición media', 'average position'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in gsc_keywords:
                if keyword in line_lower:
                    numbers = re.findall(self.patterns['numeros'], line)
                    percentages = re.findall(self.patterns['porcentajes'], line)
                    
                    if numbers or percentages:
                        if f'page_{page_num}' not in self.metrics_data['search_console']:
                            self.metrics_data['search_console'][f'page_{page_num}'] = []
                        
                        self.metrics_data['search_console'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers,
                            'percentages': percentages
                        })

    def _extract_seo_tools_metrics(self, text, lines, page_num):
        """Extrae métricas de herramientas SEO (Ahrefs, SEMrush, etc.)"""
        tools_keywords = [
            'ahrefs', 'semrush', 'moz', 'screaming frog',
            'keywords', 'palabras clave', 'ranking', 'posiciones'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in tools_keywords:
                if keyword in line_lower:
                    numbers = re.findall(self.patterns['numeros'], line)
                    percentages = re.findall(self.patterns['porcentajes'], line)
                    
                    if numbers or percentages:
                        if f'page_{page_num}' not in self.metrics_data['herramientas_seo']:
                            self.metrics_data['herramientas_seo'][f'page_{page_num}'] = []
                        
                        self.metrics_data['herramientas_seo'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers,
                            'percentages': percentages
                        })

    def _extract_authority_metrics(self, text, lines, page_num):
        """Extrae métricas de autoridad y enlaces"""
        authority_keywords = [
            'domain authority', 'da', 'page authority', 'pa',
            'domain rating', 'dr', 'backlinks', 'enlaces',
            'referring domains', 'dominios referentes'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in authority_keywords:
                if keyword in line_lower:
                    numbers = re.findall(self.patterns['numeros'], line)
                    
                    if numbers:
                        if f'page_{page_num}' not in self.metrics_data['autoridad_dominio']:
                            self.metrics_data['autoridad_dominio'][f'page_{page_num}'] = []
                        
                        self.metrics_data['autoridad_dominio'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers
                        })

    def _extract_yoy_comparisons(self, text, lines, page_num):
        """Extrae comparativas año sobre año"""
        yoy_keywords = [
            'año anterior', 'previous year', 'yoy', 'year over year',
            'comparativa', 'comparison', 'vs', 'versus', 'incremento', 'decrease'
        ]
        
        for line in lines:
            line_lower = line.lower()
            for keyword in yoy_keywords:
                if keyword in line_lower:
                    numbers = re.findall(self.patterns['numeros'], line)
                    percentages = re.findall(self.patterns['porcentajes'], line)
                    
                    if numbers or percentages:
                        if f'page_{page_num}' not in self.metrics_data['comparativas_yoy']:
                            self.metrics_data['comparativas_yoy'][f'page_{page_num}'] = []
                        
                        self.metrics_data['comparativas_yoy'][f'page_{page_num}'].append({
                            'context': line,
                            'keyword': keyword,
                            'numbers': numbers,
                            'percentages': percentages
                        })

    def save_metrics(self, output_dir):
        """Guarda las métricas extraídas"""
        output_path = Path(output_dir)
        output_path.mkdir(exist_ok=True)
        
        # Guardar métricas completas en JSON
        metrics_file = output_path / 'metricas_extraidas.json'
        with open(metrics_file, 'w', encoding='utf-8') as f:
            json.dump(self.metrics_data, f, indent=2, ensure_ascii=False)
        
        # Crear resumen de métricas
        summary = self._create_metrics_summary()
        summary_file = output_path / 'resumen_metricas.md'
        with open(summary_file, 'w', encoding='utf-8') as f:
            f.write(summary)
        
        print(f"Métricas guardadas en: {output_path}")
        return str(metrics_file), str(summary_file)

    def _create_metrics_summary(self):
        """Crea un resumen legible de las métricas extraídas"""
        summary = f"""# RESUMEN DE MÉTRICAS EXTRAÍDAS - AUDITORÍA SEO TÉCNICA

**Fecha de extracción:** {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}

## RESUMEN EJECUTIVO

"""
        
        # Contar métricas por categoría
        for category, data in self.metrics_data.items():
            if data:
                count = len(data)
                summary += f"- **{category.replace('_', ' ').title()}:** {count} páginas con datos\n"
        
        summary += "\n## DETALLE POR CATEGORÍAS\n\n"
        
        # Detallar cada categoría
        for category, data in self.metrics_data.items():
            if data:
                summary += f"### {category.replace('_', ' ').upper()}\n\n"
                
                for page_key, page_data in data.items():
                    summary += f"**Página {page_key.replace('page_', '')}:**\n"
                    
                    if isinstance(page_data, list):
                        for item in page_data:
                            summary += f"- {item.get('keyword', 'N/A')}: {item.get('context', 'N/A')[:100]}...\n"
                    else:
                        summary += f"- {page_data.get('keyword', 'N/A')}: {page_data.get('context', 'N/A')[:100]}...\n"
                    
                    summary += "\n"
        
        return summary

    def run_extraction(self, output_dir='metricas_pdf_auditoria'):
        """Ejecuta el proceso completo de extracción"""
        print("Iniciando extracción de métricas específicas...")
        
        # Extraer texto con contexto
        pages_content = self.extract_text_with_context()
        if not pages_content:
            print("Error: No se pudo extraer contenido del PDF")
            return None
        
        print(f"Texto extraído de {len(pages_content)} páginas")
        
        # Extraer métricas
        self.extract_metrics_from_text(pages_content)
        
        # Guardar resultados
        metrics_file, summary_file = self.save_metrics(output_dir)
        
        print("Extracción de métricas completada!")
        return metrics_file, summary_file

def main():
    # Ruta del PDF
    pdf_path = r"c:\ai\investigacionauditoria programacion\FASE_5_ENTREGABLES_FINALES\auditoria seo tecnica.pdf"
    
    if not Path(pdf_path).exists():
        print(f"Error: No se encuentra el archivo PDF en {pdf_path}")
        sys.exit(1)
    
    # Crear extractor y ejecutar
    extractor = MetricsExtractor(pdf_path)
    result = extractor.run_extraction()
    
    if result:
        metrics_file, summary_file = result
        print(f"\nArchivos generados:")
        print(f"- Métricas completas: {metrics_file}")
        print(f"- Resumen: {summary_file}")
    else:
        print("Error en la extracción de métricas")

if __name__ == "__main__":
    main()