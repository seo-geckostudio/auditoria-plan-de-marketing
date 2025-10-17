<?php
/**
 * Script para actualizar las instrucciones del paso "Brief del Cliente"
 */

$db = new PDO('sqlite:data/auditoria_seo.sqlite');

// Buscar el paso por nombre
$sql = "SELECT id, nombre FROM pasos_plantilla WHERE nombre LIKE '%BRIEF%' AND nombre LIKE '%CLIENTE%'";
$result = $db->query($sql);
$paso = $result->fetch(PDO::FETCH_ASSOC);

if (!$paso) {
    die("No se encontró el paso Brief del Cliente\n");
}

echo "Paso encontrado: {$paso['nombre']} (ID: {$paso['id']})\n\n";

// Instrucciones completas para el Brief del Cliente
$instrucciones = <<<'EOT'
# PLANTILLA PARA COMPLETAR EL BRIEF DEL CLIENTE

## 📋 Instrucciones para el Cliente

Por favor, proporciona la siguiente información sobre tu empresa y proyecto SEO. Puedes usar esta plantilla para organizar la información y luego importarla automáticamente al sistema.

---

## 1️⃣ INFORMACIÓN GENERAL

**Cliente:** [Nombre del cliente/empresa]
**Fecha:** [DD/MM/YYYY]
**Consultor asignado:** [Nombre del consultor SEO]

**Nombre comercial de la empresa:** [Nombre]
**Razón social (si es diferente):** [Nombre legal]
**Sector/Industria:** [Ej: Alquiler de villas, E-commerce, SaaS, etc.]
**Tamaño de empresa:** [Startup / PYME / Empresa mediana / Gran empresa]
**Años en el mercado:** [Ej: Desde 1998, 5 años, etc.]
**Ubicación principal:** [Ciudad, país]
**Mercados donde opera:** [Países/regiones separados por comas]

---

## 2️⃣ WEBSITE

**URL principal:** [https://...]
**Dominios adicionales:** [Si tiene otros dominios]
**Subdominios relevantes:** [blog.ejemplo.com, tienda.ejemplo.com, etc.]
**Antigüedad de la web:** [<1 año / 1-3 años / 3-5 años / >5 años]
**Última remodelación:** [Año]

---

## 3️⃣ MODELO DE NEGOCIO

**Tipo de negocio:** [B2B / B2C / B2B2C / Marketplace / SaaS / Otro]

**Productos/Servicios principales:**
- [Producto/servicio 1]
- [Producto/servicio 2]
- [Producto/servicio 3]

**Propuesta de valor única:**
[Describe qué hace única a tu empresa y por qué los clientes te eligen]

**Objetivo principal del sitio:** [Ventas / Leads / Tráfico / Branding / Otro]

**Objetivos específicos para este año:**
- [Objetivo 1]
- [Objetivo 2]

**Modelo de monetización:** [Venta directa online / Generación leads / Contactos / Publicidad / Suscripciones / Otro]

---

## 4️⃣ PÚBLICO OBJETIVO

**Target principal:**
- **Edad:** [Rango de edad]
- **Ubicación:** [Países/ciudades]
- **Nivel socioeconómico:** [Alto / Medio / Bajo]
- **Comportamiento online:** [Descripción opcional]

**Audiencias secundarias:**
- [Segmento 1: descripción y % de tráfico]
- [Segmento 2: descripción y % de tráfico]

**¿Tiene estacionalidad tu negocio?** [Sí / No]
- **Meses de mayor demanda:** [Meses]
- **Meses de menor demanda:** [Meses]

---

## 5️⃣ COMPETENCIA

**Principales competidores:**

1. **Nombre:** [Competidor 1]
   - **URL:** [https://...]
   - **Por qué compiten:** [Razón]

2. **Nombre:** [Competidor 2]
   - **URL:** [https://...]
   - **Por qué compiten:** [Razón]

3. **Nombre:** [Competidor 3]
   - **URL:** [https://...]
   - **Por qué compiten:** [Razón]

**¿Qué te diferencia de la competencia?**
[Describe tu ventaja competitiva]

---

## 6️⃣ SITUACIÓN SEO ACTUAL

**¿Han hecho SEO anteriormente?** [Sí / No]

**Si sí:**
- **Agencia/consultor anterior:** [Nombre]
- **Período de trabajo:** [Ej: 6 meses, 2 años]
- **Resultados obtenidos:** [Buenos / Regulares / Malos - Describe]
- **¿Por qué terminó la relación?** [Razón]

**¿Tienen equipo con conocimientos SEO?** [Sí / No]

**Herramientas SEO que usan actualmente:**
- [ ] Google Analytics
- [ ] Google Search Console
- [ ] Ahrefs / SEMrush / Moz
- [ ] Screaming Frog
- [ ] Otras: [Especificar]

---

## 7️⃣ OBJETIVOS SEO

**Palabras clave prioritarias:**
- [Keyword 1]
- [Keyword 2]
- [Keyword 3]
- [Keyword 4]
- [Keyword 5]

**Página principal más importante:** [URL]

**Páginas comerciales clave:**
- [URL 1]
- [URL 2]
- [URL 3]

**Landing pages prioritarias:**
- [URL 1]
- [URL 2]

---

## 8️⃣ TIMELINE Y EXPECTATIVAS

**¿Cuándo necesitas la auditoría completa?** [Plazo en días/semanas]

**¿Cuándo planeas implementar cambios?** [Inmediatamente / En X días/meses]

**Timeline de implementación:** [Ej: 30 días, 90 días, 180 días]

**¿Cuándo esperas ver resultados?** [Expectativas realistas]

---

## 9️⃣ ASPECTOS TÉCNICOS

**¿Tienen desarrollador interno?** [Sí / No]

**¿Trabajan con agencia de desarrollo?** [Sí / No]

**Contacto técnico:** [Nombre y email]

**¿Pueden implementar cambios técnicos?** [Fácilmente / Con dificultad / No]

**Limitaciones del CMS:** [Wordpress, Shopify, Custom - Describe limitaciones]

**Restricciones para hacer cambios:** [Describe]

---

## 🔟 INFORMACIÓN ADICIONAL

**Otros canales de marketing que usan:**
- [ ] Google Ads
- [ ] Facebook/Instagram Ads
- [ ] LinkedIn Ads
- [ ] Email marketing
- [ ] Content marketing
- [ ] Influencers
- [ ] Otros: [Especificar]

**Factores especiales a considerar:**
[Cualquier situación especial: fusión, rebrand, lanzamiento, problemas legales, etc.]

**¿Qué esperas obtener de esta auditoría?**
[Describe tus expectativas principales]

---

## 📊 KPIs PRINCIPALES

**¿Qué KPIs son más importantes para tu negocio?**
[Ej: Tráfico orgánico, conversiones, leads, ventas, posicionamiento keywords, etc.]

---

## 1️⃣1️⃣ RECURSOS INTERNOS

**Recursos internos para SEO:** [Ninguno / Básico / Avanzado]

**Observaciones adicionales:**
[Cualquier información adicional relevante]

---

## ✅ PRÓXIMOS PASOS

Una vez completado este brief:
- [ ] Brief validado por ambas partes
- [ ] Objetivos claramente definidos
- [ ] Accesos solicitados (GSC, GA, CMS, etc.)
- [ ] Timeline acordado
- [ ] Kick-off programado

---

## 🤖 CÓMO USAR LA ASISTENCIA CON IA

### Opción 1: Para Cliente Remoto
1. Haz clic en "Generar Plantilla IA"
2. Copia el JSON que se genera
3. Envíalo al cliente con instrucciones para usar ChatGPT/Claude
4. El cliente te devuelve el JSON completado
5. Usa "Importar JSON" para cargar los datos

### Opción 2: Importar JSON Directamente
Si ya tienes un JSON con la estructura correcta:
1. Haz clic en "Importar JSON"
2. Pega el JSON o sube el archivo
3. Los datos se mapearán automáticamente a los campos

### Opción 3: IA Local (Experimental)
Si tienes Claude CLI o Gemini CLI instalado:
1. Coloca esta plantilla en un archivo
2. Usa el comando de IA local
3. El JSON se generará y se importará automáticamente
EOT;

// Actualizar las instrucciones
$sql = "UPDATE pasos_plantilla SET instrucciones = ? WHERE id = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute([$instrucciones, $paso['id']]);

if ($result) {
    echo "✅ Instrucciones actualizadas correctamente\n";
    echo "Longitud del texto: " . strlen($instrucciones) . " caracteres\n";
} else {
    echo "❌ Error al actualizar instrucciones\n";
}
