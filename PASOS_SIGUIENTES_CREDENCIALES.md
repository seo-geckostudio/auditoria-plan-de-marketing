# 🚀 Pasos Siguientes para Completar la Configuración de Credenciales

## ✅ Lo que ya está configurado

1. **Google Ads API** - ✅ Completamente configurado
   - Todas las credenciales están en `claude_desktop_config.json`
   - Archivo JSON creado en `credentials/google-ads-credentials.json`

## 🎯 Lo que necesitas hacer AHORA

### Paso 1: Crear Service Account para Google Search Console y Analytics

#### 1.1 Ir a Google Cloud Console
```
🔗 https://console.cloud.google.com/
```

#### 1.2 Crear o seleccionar proyecto
- Si no tienes proyecto, créalo
- Si ya tienes uno, selecciónalo

#### 1.3 Crear Service Account
1. Ve a **IAM & Admin > Service Accounts**
2. Clic en **"Create Service Account"**
3. Nombre: `gsc-mcp-service-account`
4. Descripción: `Service account for Google Search Console and GA4 MCP`
5. Rol: **Viewer**

#### 1.4 Descargar clave JSON
1. Clic en el service account creado
2. Pestaña **"Keys"**
3. **"Add Key" > "Create new key"**
4. Formato: **JSON**
5. **IMPORTANTE**: Guarda el archivo como `gsc-service-account.json` en la carpeta `credentials/`

### Paso 2: Configurar acceso en Google Search Console

#### 2.1 Ir a Search Console
```
🔗 https://search.google.com/search-console/
```

#### 2.2 Añadir service account
1. Selecciona tu propiedad web
2. **Configuración > Usuarios y permisos**
3. **"Agregar usuario"**
4. Email: `gsc-mcp-service-account@TU-PROYECTO.iam.gserviceaccount.com`
   (Lo encuentras en el archivo JSON descargado)
5. Permisos: **"Propietario completo"**

### Paso 3: Configurar acceso en Google Analytics 4

#### 3.1 Ir a Google Analytics
```
🔗 https://analytics.google.com/
```

#### 3.2 Añadir service account
1. Selecciona tu cuenta/propiedad GA4
2. **Admin > Gestión de acceso a la cuenta**
3. Clic en **"+"**
4. Email del service account (mismo que GSC)
5. Rol: **"Viewer"** o **"Analyst"**
6. **Repetir para "Gestión de acceso a la propiedad"**

#### 3.3 Obtener Property ID
1. En GA4: **Admin > Información de la propiedad**
2. Copia el **"ID de propiedad"** (formato: 123456789)
3. **IMPORTANTE**: Anota este número, lo necesitarás después

### Paso 4: Actualizar configuración con tu Property ID

#### 4.1 Editar claude_desktop_config.json
Reemplaza `REEMPLAZAR_CON_TU_GA4_PROPERTY_ID` con tu Property ID real:

```json
"GA4_PROPERTY_ID": "123456789"
```

#### 4.2 Crear archivo .env (opcional pero recomendado)
Copia `.env.template` como `.env` y completa:

```env
GA4_PROPERTY_ID=TU_PROPERTY_ID_REAL
```

## 🔍 Verificación Final

### Archivos que debes tener:
```
credentials/
├── google-ads-credentials.json          ✅ (ya existe)
├── gsc-service-account.json            ⏳ (debes crear)
├── ga4-config-template.json            ✅ (plantilla)
└── README.md                           ✅ (ya existe)
```

### Configuración que debe estar completa:
- ✅ Google Ads: Credenciales en `claude_desktop_config.json`
- ⏳ GSC: Service account añadido en Search Console
- ⏳ GA4: Service account añadido en Analytics + Property ID configurado

## 🆘 Si tienes problemas

### Error: "No se puede crear service account"
- Verifica que tengas permisos de administrador en Google Cloud
- Asegúrate de tener un proyecto seleccionado

### Error: "No puedo añadir usuario en Search Console"
- Verifica que seas propietario de la propiedad
- Usa el email exacto del service account (del archivo JSON)

### Error: "Property ID no funciona"
- Verifica que sea el ID correcto (solo números)
- Asegúrate de tener acceso a esa propiedad GA4

## 📞 Siguiente paso después de completar

Una vez que hayas:
1. ✅ Creado el service account
2. ✅ Descargado `gsc-service-account.json`
3. ✅ Añadido accesos en GSC y GA4
4. ✅ Actualizado el Property ID

**Ejecuta el script de instalación:**
```bash
MCP_INSTALLATION_SCRIPT.bat
```

¡Y estarás listo para usar todos los MCPs! 🎉