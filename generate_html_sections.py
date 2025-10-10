import json
import os

def generar_html_sections():
    """Genera automáticamente todas las secciones HTML basadas en los datos del PDF"""
    
    # Cargar datos convertidos
    json_path = "analisis_pdf_auditoria/analisis_estructura.json"
    with open(json_path, 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    # Generar HTML para cada página
    html_sections = []
    
    for pagina in data['paginas']:
        page_id = pagina['id']
        titulo = pagina['titulo']
        subtitulo = pagina['subtitulo']
        fuentes = pagina['fuentes']
        bullets = pagina['bullets']
        
        # Crear fuentes como texto
        fuentes_text = ", ".join(fuentes) if fuentes else "Manual"
        
        # Generar bullets HTML
        bullets_html = ""
        if bullets:
            bullets_html = "<ul class='audit-bullets'>"
            for bullet in bullets:
                bullets_html += f"<li>{bullet}</li>"
            bullets_html += "</ul>"
        
        # Generar sección HTML
        section_html = f'''
        <section id="{page_id}" class="audit-page" data-page-number="{len(html_sections) + 1}" data-source="{fuentes_text}">
            <div class="page-header">
                <h2 class="page-title">{titulo}</h2>
                <h3 class="page-subtitle">{subtitulo}</h3>
            </div>
            <div class="page-content">
                {bullets_html}
                <div class="page-placeholder">
                    <p class="placeholder-text">Contenido detallado de la página {len(html_sections) + 1}</p>
                    <p class="data-source">Fuente: {fuentes_text}</p>
                </div>
            </div>
        </section>'''
        
        html_sections.append(section_html)
    
    # Leer el archivo index.html actual
    index_path = "ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/index.html"
    with open(index_path, 'r', encoding='utf-8') as f:
        html_content = f.read()
    
    # Encontrar donde insertar las secciones (después del main tag)
    main_start = html_content.find('<main class="content">')
    main_end = html_content.find('</main>')
    
    if main_start != -1 and main_end != -1:
        # Reemplazar el contenido del main
        new_main_content = '<main class="content">\n' + '\n'.join(html_sections) + '\n  </main>'
        
        new_html = html_content[:main_start] + new_main_content + html_content[main_end + 7:]
        
        # Guardar el archivo actualizado
        with open(index_path, 'w', encoding='utf-8') as f:
            f.write(new_html)
        
        print(f"✅ Generadas {len(html_sections)} secciones HTML")
        print(f"📄 Archivo actualizado: {index_path}")
        
        return len(html_sections)
    else:
        print("❌ Error: No se encontró la estructura main en index.html")
        return 0

if __name__ == "__main__":
    generar_html_sections()