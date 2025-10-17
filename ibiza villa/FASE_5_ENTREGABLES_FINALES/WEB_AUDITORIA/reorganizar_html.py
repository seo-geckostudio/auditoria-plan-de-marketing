#!/usr/bin/env python3
"""
Script para reorganizar automáticamente las páginas del HTML de la auditoría
Orden correcto: Portada → Índice → [Portada Sección N → Páginas de Sección N] × 5
"""

import re
from pathlib import Path

def extraer_secciones(html_content):
    """Extrae todas las secciones del HTML y las organiza por ID"""

    # Patrones para encontrar secciones
    pattern = r'(<section[^>]*id="([^"]+)"[^>]*>.*?</section>)'

    secciones = {}
    for match in re.finditer(pattern, html_content, re.DOTALL):
        section_html = match.group(1)
        section_id = match.group(2)
        secciones[section_id] = section_html

    return secciones

def ordenar_paginas():
    """Define el orden correcto de las páginas"""

    orden = ['portada', 'indice']

    # Sección 1: Análisis Situación Actual (páginas 003-019)
    orden.append('seccion-situacion-actual')
    for i in range(3, 20):
        orden.append(f'pagina-{i:03d}')

    # Sección 2: Análisis Demanda (páginas 020-024)
    orden.append('seccion-demanda')
    for i in range(20, 25):
        orden.append(f'pagina-{i:03d}')

    # Sección 3: SEO On-Page (páginas 025-113)
    orden.append('seccion-seo-onpage')
    for i in range(25, 114):
        orden.append(f'pagina-{i:03d}')

    # Sección 4: SEO Off-Page (páginas 114-129)
    orden.append('seccion-seo-offpage')
    for i in range(114, 130):
        orden.append(f'pagina-{i:03d}')

    # Sección 5: Priorización (páginas 130-131)
    orden.append('seccion-priorizacion')
    for i in range(130, 132):
        orden.append(f'pagina-{i:03d}')

    return orden

def reorganizar_html(input_file, output_file):
    """Reorganiza el HTML completo"""

    print(f"[*] Leyendo archivo: {input_file}")
    with open(input_file, 'r', encoding='utf-8') as f:
        html_content = f.read()

    # Extraer header (hasta <main>)
    header_match = re.search(r'(.*?<main[^>]*>)', html_content, re.DOTALL)
    if not header_match:
        print("[X] Error: No se encontró el tag <main>")
        return False

    header = header_match.group(1)

    # Extraer footer (desde </main> hasta el final)
    footer_match = re.search(r'(</main>.*)', html_content, re.DOTALL)
    if not footer_match:
        print("[X] Error: No se encontró el cierre </main>")
        return False

    footer = footer_match.group(1)

    # Extraer todas las secciones
    print("[SEARCH] Extrayendo secciones...")
    main_content = html_content[len(header):-len(footer)]

    # Usar un patrón más simple para extraer secciones
    sections = {}
    section_pattern = r'<section[^>]*id="([^"]+)"[^>]*>(?:(?!</section>).)*</section>'

    for match in re.finditer(section_pattern, main_content, re.DOTALL):
        section_id = match.group(1)
        section_html = match.group(0)
        sections[section_id] = section_html
        print(f"  [OK] Encontrada: {section_id}")

    print(f"\n[INFO] Total secciones encontradas: {len(sections)}")

    # Obtener orden correcto
    orden_correcto = ordenar_paginas()
    print(f"[LIST] Orden esperado: {len(orden_correcto)} paginas")

    # Reconstruir HTML en orden correcto
    print("\n[BUILD] Reconstruyendo HTML...")
    secciones_ordenadas = []
    paginas_no_encontradas = []

    for page_id in orden_correcto:
        if page_id in sections:
            secciones_ordenadas.append(sections[page_id])
            print(f"  [OK] {page_id}")
        else:
            paginas_no_encontradas.append(page_id)
            print(f"  [!] No encontrada: {page_id}")

    # Construir HTML final
    html_reorganizado = header + '\n\n' + '\n\n'.join(secciones_ordenadas) + '\n\n' + footer

    # Guardar
    print(f"\n[SAVE] Guardando en: {output_file}")
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(html_reorganizado)

    print(f"\n[SUCCESS] HTML reorganizado exitosamente!")
    print(f"   - Paginas ordenadas: {len(secciones_ordenadas)}")
    print(f"   - Paginas no encontradas: {len(paginas_no_encontradas)}")

    if paginas_no_encontradas:
        print(f"\n[!] Paginas faltantes:")
        for page_id in paginas_no_encontradas[:10]:  # Mostrar solo primeras 10
            print(f"   - {page_id}")

    return True

if __name__ == '__main__':
    base_path = Path(__file__).parent
    input_file = base_path / 'index.html'
    output_file = base_path / 'index_backup.html'

    # Crear backup
    print("[SAVE] Creando backup del archivo original...")
    with open(input_file, 'r', encoding='utf-8') as f:
        backup_content = f.read()
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(backup_content)
    print(f"[SUCCESS] Backup creado: {output_file}\n")

    # Reorganizar
    success = reorganizar_html(input_file, input_file)

    if success:
        print("\n[SUCCESS] Proceso completado! Recarga la pagina en tu navegador.")
    else:
        print("\n[X] Hubo errores en el proceso")
