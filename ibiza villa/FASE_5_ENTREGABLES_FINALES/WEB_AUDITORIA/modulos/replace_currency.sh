#!/bin/bash
# Script para reemplazar referencias monetarias por métricas alternativas

# Reemplazos de etiquetas
find . -name "*.php" -type f -exec sed -i 's/ROI Esperado/Mejora Esperada/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/Análisis ROI/Análisis de Resultados/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/Inversión:<\/strong>/Esfuerzo:<\/strong>/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/Total Inversión/Total Esfuerzo/g' {} \;

# Reemplazos de valores específicos comunes
find . -name "*.php" -type f -exec sed -i 's/€80k-120k\/año/1,000-2,000 horas\/año/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/€80k-120k/1,000-2,000 horas/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/€20k-30k/250-500 horas/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/€3k-5k/40-80 horas/g' {} \;

# Reemplazos de ROI ratios por mejoras de eficiencia
find . -name "*.php" -type f -exec sed -i 's/ROI 33-72:1/Eficiencia: 90\/100 puntos/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/ROI infinito/Beneficio continuo multi-año/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/ROI INFINITO/BENEFICIO CONTINUO MULTI-AÑO/g' {} \;

# Reemplazos de comparativas PPC
find . -name "*.php" -type f -exec sed -i 's/€137,400\/año coste perpetuo/100% coste continuo perpetuo/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/€137k\/año/Coste 100% continuo/g' {} \;
find . -name "*.php" -type f -exec sed -i 's/coste adquisición ~€0/coste adquisición ~0% (solo mantenimiento)/g' {} \;

echo "Reemplazos completados"
