#!/bin/bash

# Script para corregir problemas de diseño reportados

cd "$(dirname "$0")/modulos"

echo "=== Corrigiendo problemas de diseño ==="

# 1. E-E-A-T: Cambiar summary-card a diseño vertical (label arriba, value abajo)
echo "1. Corrigiendo summary-card en E-E-A-T..."
sed -i '
/\.summary-card {/,/^}/ {
    s/display: flex;/display: flex;\n    flex-direction: column;/
    s/align-items: center;/align-items: center;\n    text-align: center;/
    s/gap: 15px;/gap: 8px;/
}
/\.summary-value {/,/^}/ {
    s/font-size: 32px;/font-size: 28px;/
    s/color: #88B04B;/color: #88B04B;\n    word-break: break-word;/
}
/\.summary-label {/,/^}/ {
    s/color: #64748b;/color: #333;\n    font-weight: 600;/
}
' fase8_seo_moderno/00_eeat_audit.php

# 2. Arquitectura: page-meta y metadata en blanco
echo "2. Corrigiendo page-meta y metadata en Arquitectura..."
for file in fase3_arquitectura/*.php; do
    sed -i '
    /\.page-meta/,/^}/ {
        s/color: #64748b;/color: white;/
        s/color: #666;/color: white;/
        s/color: #777;/color: white;/
    }
    /\.metadata-item/,/^}/ {
        s/color: #666;/color: white;/
        s/color: #777;/color: white;/
    }
    /\.meta-label/,/^}/ {
        s/color: #888;/color: rgba(255,255,255,0.9);/
        s/color: #999;/color: rgba(255,255,255,0.9);/
    }
    /\.meta-value/,/^}/ {
        s/color: #333;/color: white;/
    }
    ' "$file"
done

# 3. Resumen Ejecutivo: summary-label, summary-value, summary-detail con overflow
echo "3. Corrigiendo Resumen Ejecutivo..."
sed -i '
/\.summary-card/,/^}/ {
    s/padding: 20px;/padding: 20px;\n    min-height: 120px;/
}
/\.summary-label/,/^}/ {
    s/margin-bottom: 8px;/margin-bottom: 8px;\n    color: white;\n    display: -webkit-box;\n    -webkit-line-clamp: 2;\n    -webkit-box-orient: vertical;\n    overflow: hidden;/
}
/\.summary-value/,/^}/ {
    s/margin-bottom: 5px;/margin-bottom: 5px;\n    display: -webkit-box;\n    -webkit-line-clamp: 1;\n    -webkit-box-orient: vertical;\n    overflow: hidden;\n    word-break: break-word;/
}
/\.summary-detail/,/^}/ {
    s/color: #666;/color: rgba(255,255,255,0.9);\n    display: -webkit-box;\n    -webkit-line-clamp: 3;\n    -webkit-box-orient: vertical;\n    overflow: hidden;/
}
' fase4_situacion_actual/00_situacion_actual.php

# 4. Keywords orgánicas: stat-item highlight (blanco sobre blanco)
echo "4. Corrigiendo stat-item highlight..."
sed -i '
/\.stat-item\.highlight/,/^}/ {
    s/background: white;/background: #f0f9ff;\n    border-left: 4px solid #88B04B;/
    s/color: white;/color: #333;/
}
/\.stat-item\.highlight \.stat-label/,/^}/ {
    s/color: white;/color: #666;/
}
/\.stat-item\.highlight \.stat-value/,/^}/ {
    s/color: white;/color: #88B04B;/
}
' fase4_situacion_actual/00_situacion_actual.php fase6_seo_onpage/02_seo_onpage.php

# 5. Portada sección 6: áreas analizadas blanco sobre gris
echo "5. Corrigiendo portada sección 6..."
find fase6_seo_onpage -name "*.php" -exec sed -i '
/\.feature-card/,/^}/ {
    s/color: #666;/color: #333;/
    s/color: #777;/color: #333;/
}
/\.feature-card h3/,/^}/ {
    s/color: #888;/color: #333;/
}
/\.area-item/,/^}/ {
    s/color: white;/color: #333;/
    s/background: rgba(255,255,255,0.1);/background: rgba(136,176,75,0.1);\n    border: 1px solid rgba(136,176,75,0.3);/
}
' {} \;

echo "=== Correcciones completadas ==="
