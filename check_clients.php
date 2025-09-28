<?php
$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');
$stmt = $pdo->query('SELECT id, nombre_empresa, contacto_nombre, contacto_email, fecha_creacion FROM clientes ORDER BY id DESC LIMIT 5');
echo "Últimos clientes creados:\n";
while ($row = $stmt->fetch()) {
    echo "ID: {$row['id']} | {$row['nombre_empresa']} | {$row['contacto_nombre']} | {$row['contacto_email']} | {$row['fecha_creacion']}\n";
}
?>