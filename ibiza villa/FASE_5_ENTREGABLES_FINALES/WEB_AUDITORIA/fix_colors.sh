#!/bin/bash
# Script para reemplazar TODOS los colores no corporativos con Gecko Studio

cd modulos

# VERDE VIEJO → VERDE GREENERY
find . -name "*.php" -exec sed -i 's/#54a34a/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#6ab85e/#6d8f3c/g' {} \;
find . -name "*.php" -exec sed -i 's/#28a745/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#218838/#6d8f3c/g' {} \;

# AZULES → VERDE CLARO CORPORATIVO (fondos)
find . -name "*.php" -exec sed -i 's/#f0f9ff/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#dbeafe/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#bfdbfe/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#e0f2fe/#f0f7e6/g' {} \;

# AZULES INTENSOS → VERDE GREENERY
find . -name "*.php" -exec sed -i 's/#3b82f6/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#2563eb/#6d8f3c/g' {} \;
find . -name "*.php" -exec sed -i 's/#1d4ed8/#6d8f3c/g' {} \;

# ROJOS/ROSAS → ELIMINAR (fondos pastel a verde claro)
find . -name "*.php" -exec sed -i 's/#fef3f2/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fee2e2/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fff1f2/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fce7f3/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fef2f2/#f0f7e6/g' {} \;

# ROJOS/ROSAS INTENSOS → VERDE GREENERY
find . -name "*.php" -exec sed -i 's/#ec4899/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#be123c/#6d8f3c/g' {} \;
find . -name "*.php" -exec sed -i 's/#ef4444/#88B04B/g' {} \;

# AMARILLOS/NARANJAS → VERDE CLARO (fondos)
find . -name "*.php" -exec sed -i 's/#fef3c7/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fde68a/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fed7aa/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fffbeb/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fff3cd/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fff9e6/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#fffef8/#f0f7e6/g' {} \;

# AMARILLOS/NARANJAS INTENSOS → VERDE GREENERY
find . -name "*.php" -exec sed -i 's/#f59e0b/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#ffc107/#88B04B/g' {} \;

# VERDES INCORRECTOS → VERDE GREENERY
find . -name "*.php" -exec sed -i 's/#10b981/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#22c55e/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#d1fae5/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#dcfce7/#f0f7e6/g' {} \;
find . -name "*.php" -exec sed -i 's/#f0fdf4/#f0f7e6/g' {} \;

# MORADOS → VERDE GREENERY
find . -name "*.php" -exec sed -i 's/#a855f7/#88B04B/g' {} \;
find . -name "*.php" -exec sed -i 's/#8b5cf6/#88B04B/g' {} \;

# GRISES VARIADOS → GRIS CORPORATIVO
find . -name "*.php" -exec sed -i 's/#6b7280/#787878/g' {} \;
find . -name "*.php" -exec sed -i 's/#e5e7eb/#f5f5f5/g' {} \;
find . -name "*.php" -exec sed -i 's/#f9fafb/#f5f5f5/g' {} \;
find . -name "*.php" -exec sed -i 's/#f8fafc/#f5f5f5/g' {} \;
find . -name "*.php" -exec sed -i 's/#e2e8f0/#f5f5f5/g' {} \;
find . -name "*.php" -exec sed -i 's/#f1f5f9/#f5f5f5/g' {} \;

echo "✅ Colores corporativos Gecko Studio aplicados"
