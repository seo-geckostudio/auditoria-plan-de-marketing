import os
import re
from pathlib import Path

# Mapeo de colores: viejo → nuevo (Gecko Studio)
COLOR_MAP = {
    # Verde viejo → Verde Greenery
    '#54a34a': '#88B04B',
    '#6ab85e': '#6d8f3c',
    '#28a745': '#88B04B',
    '#218838': '#6d8f3c',
    
    # Azules → Verde claro corporativo (fondos)
    '#f0f9ff': '#f0f7e6',
    '#dbeafe': '#f0f7e6',
    '#bfdbfe': '#f0f7e6',
    '#e0f2fe': '#f0f7e6',
    
    # Azules intensos → Verde Greenery
    '#3b82f6': '#88B04B',
    '#2563eb': '#6d8f3c',
    '#1d4ed8': '#6d8f3c',
    
    # Rojos/Rosas fondos → Verde claro
    '#fef3f2': '#f0f7e6',
    '#fee2e2': '#f0f7e6',
    '#fff1f2': '#f0f7e6',
    '#fce7f3': '#f0f7e6',
    '#fef2f2': '#f0f7e6',
    
    # Rojos/Rosas intensos → Verde Greenery
    '#ec4899': '#88B04B',
    '#be123c': '#6d8f3c',
    '#ef4444': '#88B04B',
    
    # Amarillos/Naranjas fondos → Verde claro
    '#fef3c7': '#f0f7e6',
    '#fde68a': '#f0f7e6',
    '#fed7aa': '#f0f7e6',
    '#fffbeb': '#f0f7e6',
    '#fff3cd': '#f0f7e6',
    '#fff9e6': '#f0f7e6',
    '#fffef8': '#f0f7e6',
    
    # Amarillos/Naranjas intensos → Verde Greenery
    '#f59e0b': '#88B04B',
    '#ffc107': '#88B04B',
    
    # Verdes incorrectos → Verde Greenery
    '#10b981': '#88B04B',
    '#22c55e': '#88B04B',
    '#d1fae5': '#f0f7e6',
    '#dcfce7': '#f0f7e6',
    '#f0fdf4': '#f0f7e6',
    
    # Morados → Verde Greenery
    '#a855f7': '#88B04B',
    '#8b5cf6': '#88B04B',
    
    # Grises variados → Gris corporativo
    '#6b7280': '#787878',
    '#e5e7eb': '#f5f5f5',
    '#f9fafb': '#f5f5f5',
    '#f8fafc': '#f5f5f5',
    '#e2e8f0': '#f5f5f5',
    '#f1f5f9': '#f5f5f5',
}

def replace_colors_in_file(filepath):
    """Reemplaza todos los colores en un archivo"""
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        modified = content
        replacements_made = 0
        
        for old_color, new_color in COLOR_MAP.items():
            # Buscar con case insensitive
            count = modified.count(old_color)
            count += modified.count(old_color.upper())
            
            if count > 0:
                modified = re.sub(old_color, new_color, modified, flags=re.IGNORECASE)
                replacements_made += count
        
        if replacements_made > 0:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(modified)
            return replacements_made
        
        return 0
    except Exception as e:
        print(f"Error en {filepath}: {e}")
        return 0

# Procesar todos los archivos PHP en modulos/
modulos_dir = Path('modulos')
total_files = 0
total_replacements = 0

for php_file in modulos_dir.rglob('*.php'):
    replacements = replace_colors_in_file(php_file)
    if replacements > 0:
        total_files += 1
        total_replacements += replacements
        print(f"✓ {php_file.name}: {replacements} reemplazos")

print(f"\n✅ Completado: {total_replacements} colores reemplazados en {total_files} archivos")
