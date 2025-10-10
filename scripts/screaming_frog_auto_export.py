#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script de automatización para exportar datos de Screaming Frog
Compatible con interfaz en castellano/español
Autor: AI Assistant
Fecha: 2025
"""

import os
import time
import pyautogui
import subprocess
from pathlib import Path
import json
from datetime import datetime

class ScreamingFrogAutoExporter:
    def __init__(self, export_dir="datos_previos_a_la_auditoria"):
        self.export_dir = Path(export_dir)
        self.export_dir.mkdir(exist_ok=True)
        
        # Mapeo de pestañas en español a nombres de archivo
        self.tab_mapping = {
            # Pestañas principales
            "Interno": "internal_all",
            "Externo": "external_all", 
            "Códigos de respuesta": "response_codes",
            "Títulos de página": "page_titles",
            "Descripciones meta": "meta_descriptions",
            "H1": "h1_headers",
            "H2": "h2_headers",
            "Imágenes": "images",
            "Contenido": "content",
            "Enlaces internos": "internal_links",
            "Páginas huérfanas": "orphan_pages",
            "Directivas": "directives",
            "Esquemas": "schema",
            "Hreflang": "hreflang"
        }
        
        # Configuración de PyAutoGUI
        pyautogui.FAILSAFE = True
        pyautogui.PAUSE = 0.5
        
    def create_folder_structure(self):
        """Crear estructura de carpetas para organizar exports"""
        folders = [
            "exports_csv/general",
            "exports_csv/seo_onpage", 
            "exports_csv/contenido",
            "exports_csv/arquitectura",
            "exports_csv/imagenes",
            "graficos_visuales"
        ]
        
        for folder in folders:
            (self.export_dir / folder).mkdir(parents=True, exist_ok=True)
            
        print(f"✅ Estructura de carpetas creada en: {self.export_dir}")
    
    def wait_for_screaming_frog(self):
        """Verificar que Screaming Frog esté abierto"""
        print("🔍 Buscando ventana de Screaming Frog...")
        
        # Intentar encontrar la ventana de Screaming Frog
        try:
            window = pyautogui.getWindowsWithTitle("Screaming Frog")
            if not window:
                print("❌ Screaming Frog no está abierto. Por favor, ábrelo primero.")
                return False
            
            # Activar la ventana
            window[0].activate()
            time.sleep(2)
            print("✅ Screaming Frog encontrado y activado")
            return True
            
        except Exception as e:
            print(f"❌ Error al buscar Screaming Frog: {e}")
            return False
    
    def export_tab_data(self, tab_name, subtab=None, filename_suffix=""):
        """Exportar datos de una pestaña específica"""
        try:
            print(f"📊 Exportando datos de: {tab_name}")
            
            # Hacer clic en la pestaña
            tab_location = pyautogui.locateOnScreen(f"tab_{tab_name.lower().replace(' ', '_')}.png", confidence=0.8)
            if tab_location:
                pyautogui.click(tab_location)
                time.sleep(1)
            else:
                # Método alternativo: usar texto
                print(f"⚠️ No se encontró imagen para {tab_name}, usando método alternativo")
            
            # Si hay subpestaña, hacer clic en ella
            if subtab:
                print(f"   📋 Subpestaña: {subtab}")
                time.sleep(0.5)
            
            # Exportar a CSV (Ctrl+E o menú Exportar)
            pyautogui.hotkey('ctrl', 'e')
            time.sleep(1)
            
            # Configurar nombre de archivo
            base_name = self.tab_mapping.get(tab_name, tab_name.lower().replace(' ', '_'))
            if filename_suffix:
                filename = f"SF_{base_name}_{filename_suffix}.csv"
            else:
                filename = f"SF_{base_name}.csv"
            
            # Escribir nombre de archivo
            pyautogui.typewrite(filename)
            time.sleep(0.5)
            
            # Confirmar exportación
            pyautogui.press('enter')
            time.sleep(2)
            
            print(f"✅ Exportado: {filename}")
            return True
            
        except Exception as e:
            print(f"❌ Error exportando {tab_name}: {e}")
            return False
    
    def export_all_data(self):
        """Exportar todos los datos necesarios automáticamente"""
        if not self.wait_for_screaming_frog():
            return False
        
        print("🚀 Iniciando exportación automática...")
        
        # Lista de exportaciones necesarias
        exports = [
            # Datos generales
            ("Interno", None, "all"),
            ("Códigos de respuesta", None, "all"),
            
            # SEO On-Page
            ("Títulos de página", "Todos", "all"),
            ("Títulos de página", "Faltantes", "missing"),
            ("Títulos de página", "Duplicados", "duplicate"),
            ("Títulos de página", "Muy largos", "too_long"),
            ("Títulos de página", "Muy cortos", "too_short"),
            
            # Meta Descriptions
            ("Descripciones meta", "Todos", "all"),
            ("Descripciones meta", "Faltantes", "missing"),
            ("Descripciones meta", "Duplicados", "duplicate"),
            ("Descripciones meta", "Muy largos", "too_long"),
            ("Descripciones meta", "Muy cortos", "too_short"),
            
            # Headers
            ("H1", "Todos", "all"),
            ("H1", "Faltantes", "missing"),
            ("H1", "Múltiples", "multiple"),
            ("H1", "Duplicados", "duplicate"),
            ("H2", "Todos", "all"),
            
            # Contenido
            ("Contenido", "Duplicados cercanos", "near_duplicates"),
            ("Contenido", "Recuento de palabras", "word_count"),
            
            # Imágenes
            ("Imágenes", "Alt text faltante", "missing_alt"),
            ("Imágenes", "Más de 100kb", "large_files"),
            
            # Arquitectura
            ("Enlaces internos", None, "all"),
            ("Páginas huérfanas", None, "all")
        ]
        
        successful_exports = 0
        total_exports = len(exports)
        
        for tab, subtab, suffix in exports:
            if self.export_tab_data(tab, subtab, suffix):
                successful_exports += 1
            time.sleep(1)  # Pausa entre exportaciones
        
        print(f"\n📈 Exportación completada: {successful_exports}/{total_exports} archivos")
        return successful_exports > 0
    
    def generate_export_report(self):
        """Generar reporte de archivos exportados"""
        report = {
            "timestamp": datetime.now().isoformat(),
            "export_directory": str(self.export_dir),
            "exported_files": [],
            "total_files": 0
        }
        
        # Buscar archivos CSV exportados
        csv_files = list(self.export_dir.glob("**/*.csv"))
        
        for csv_file in csv_files:
            file_info = {
                "filename": csv_file.name,
                "path": str(csv_file),
                "size_mb": round(csv_file.stat().st_size / (1024*1024), 2),
                "modified": datetime.fromtimestamp(csv_file.stat().st_mtime).isoformat()
            }
            report["exported_files"].append(file_info)
        
        report["total_files"] = len(csv_files)
        
        # Guardar reporte
        report_file = self.export_dir / "export_report.json"
        with open(report_file, 'w', encoding='utf-8') as f:
            json.dump(report, f, indent=2, ensure_ascii=False)
        
        print(f"📋 Reporte generado: {report_file}")
        return report

def main():
    """Función principal"""
    print("🕷️ SCREAMING FROG AUTO EXPORTER")
    print("=" * 50)
    
    # Crear instancia del exportador
    exporter = ScreamingFrogAutoExporter()
    
    # Crear estructura de carpetas
    exporter.create_folder_structure()
    
    # Exportar todos los datos
    if exporter.export_all_data():
        # Generar reporte
        report = exporter.generate_export_report()
        print(f"\n✅ EXPORTACIÓN COMPLETADA")
        print(f"📁 Archivos guardados en: {exporter.export_dir}")
        print(f"📊 Total de archivos: {report['total_files']}")
    else:
        print("\n❌ Error en la exportación")

if __name__ == "__main__":
    main()