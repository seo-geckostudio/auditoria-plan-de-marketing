#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para verificar la estructura del JSON generado
"""

import json
import os

def verificar_estructura_json():
    """Verifica que el JSON tenga la estructura correcta"""
    json_path = "analisis_pdf_auditoria/analisis_estructura.json"
    
    if not os.path.exists(json_path):
        print(f"ERROR: No se encuentra el archivo {json_path}")
        return False
    
    try:
        with open(json_path, 'r', encoding='utf-8') as f:
            data = json.load(f)
        
        print("=== VERIFICACIÓN DE ESTRUCTURA JSON ===")
        print(f"Total páginas: {data.get('total_paginas', 'NO ENCONTRADO')}")
        print(f"Estructura correcta: {'paginas' in data}")
        
        if 'paginas' in data and len(data['paginas']) > 0:
            primera_pagina = data['paginas'][0]
            campos_requeridos = ['numero', 'titulo_principal', 'fuente_datos']
            campos_presentes = [campo for campo in campos_requeridos if campo in primera_pagina]
            
            print(f"Primera página tiene campos requeridos: {len(campos_presentes) == len(campos_requeridos)}")
            print(f"Campos presentes: {campos_presentes}")
            print(f"Campos faltantes: {[c for c in campos_requeridos if c not in campos_presentes]}")
            print(f"Todos los campos de primera página: {list(primera_pagina.keys())}")
            
            # Verificar algunas páginas más
            total_paginas = len(data['paginas'])
            print(f"\nTotal de páginas en JSON: {total_paginas}")
            
            # Verificar estructura de páginas aleatorias
            paginas_a_verificar = [0, total_paginas//4, total_paginas//2, total_paginas-1]
            for i in paginas_a_verificar:
                if i < total_paginas:
                    pagina = data['paginas'][i]
                    print(f"Página {i+1}: título='{pagina.get('titulo_principal', 'SIN TÍTULO')}', fuentes={pagina.get('fuente_datos', [])}")
            
            return True
        else:
            print("ERROR: No se encontraron páginas en el JSON")
            return False
            
    except json.JSONDecodeError as e:
        print(f"ERROR: JSON mal formado - {e}")
        return False
    except Exception as e:
        print(f"ERROR: {e}")
        return False

if __name__ == "__main__":
    verificar_estructura_json()