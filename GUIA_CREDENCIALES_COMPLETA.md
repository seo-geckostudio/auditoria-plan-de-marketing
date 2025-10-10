# Guía Completa de Configuración de Credenciales para MCPs

## 📋 Estado Actual

✅ **Google Ads API** - Credenciales ya configuradas
- Developer Token: `il4ZwMP_no7JozSz8iZAvg`
- Client ID: `386701778748-00jh022prnv9prt42989g0s7esf9djsr.apps.googleusercontent.com`
- Login Customer ID: `7009924982`

## 🎯 Credenciales Pendientes por Configurar

### 1. Google Search Console (GSC)

#### Paso 1: Crear Service Account
1. Ve a [Google Cloud Console](https://console.cloud.google.com/)
2. Selecciona tu proyecto o crea uno nuevo
3. Navega a **IAM & Admin > Service Accounts**
4. Haz clic en **"Create Service Account"**
5. Completa los datos:
   - **Name**: `gsc-mcp-service-account`
   - **Description**: `Service account for Google Search Console MCP`
6. Haz clic en **"Create and Continue"**

#### Paso 2: Asignar Permisos
1. En **"Grant this service account access to project"**:
   - Añade el rol: **"Viewer"**
2. Haz clic en **"Continue"** y luego **"Done"**

#### Paso 3: Generar Clave JSON
1. En la lista de Service Accounts, haz clic en el que acabas de crear
2. Ve a la pestaña **"Keys"**
3. Haz clic en **"Add Key" > "Create new key"**
4. Selecciona **JSON** y haz clic en **"Create"**
5. Guarda el archivo como `gsc-service-account.json` en la carpeta `credentials/`

#### Paso 4: Configurar Acceso en Search Console
1. Ve a [Google Search Console](https://search.google.com/search-console/)
2. Selecciona tu propiedad
3. Ve a **Configuración > Usuarios y permisos**
4. Haz clic en **"Agregar usuario"**
5. Introduce el email del service account (lo encuentras en el JSON)
6. Asigna permisos de **"Propietario completo"** o **"Propietario restringido"**

### 2. Google Analytics 4 (GA4)

#### Paso 1: Usar el mismo Service Account
- Puedes reutilizar el service account creado para GSC

#### Paso 2: Configurar Acceso en GA4
1. Ve a [Google Analytics](https://analytics.google.com/)
2. Selecciona tu propiedad GA4
3. Ve a **Admin > Gestión de acceso a la cuenta**
4. Haz clic en **"+"** para añadir usuario
5. Introduce el email del service account
6. Asigna el rol **"Viewer"** o **"Analyst"**
7. Repite para **Gestión de acceso a la propiedad**

#### Paso 3: Obtener IDs necesarios
1. **Property ID**: En Admin > Información de la propiedad
2. **View ID**: En la URL cuando estés en GA4

### 3. Google Keyword Planner (ya configurado con Google Ads)

Las credenciales de Google Ads que ya tienes funcionan para el Keyword Planner.

## 📁 Estructura de Archivos de Credenciales

```
credentials/
├── google-ads-credentials.json          ✅ (ya creado)
├── gsc-service-account.json            ⏳ (por crear)
├── ga4-service-account.json            ⏳ (mismo que GSC)
└── README.md                           ✅ (ya existe)
```

## 🔧 Plantillas de Archivos de Credenciales

### Google Search Console (`gsc-service-account.json`)
```json
{
  "type": "service_account",
  "project_id": "tu-proyecto-id",
  "private_key_id": "...",
  "private_key": "-----BEGIN PRIVATE KEY-----\n...\n-----END PRIVATE KEY-----\n",
  "client_email": "gsc-mcp-service-account@tu-proyecto.iam.gserviceaccount.com",
  "client_id": "...",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "..."
}
```

### Google Analytics 4 (`ga4-config.json`)
```json
{
  "service_account_path": "./credentials/gsc-service-account.json",
  "property_id": "TU_GA4_PROPERTY_ID",
  "view_id": "TU_GA4_VIEW_ID"
}
```

## ⚙️ Configuración de Variables de Entorno

Crea un archivo `.env` en la raíz del proyecto:

```env
# Google Search Console
GSC_SERVICE_ACCOUNT_PATH=./credentials/gsc-service-account.json

# Google Analytics 4
GA4_SERVICE_ACCOUNT_PATH=./credentials/gsc-service-account.json
GA4_PROPERTY_ID=TU_GA4_PROPERTY_ID

# Google Ads (ya configurado)
GOOGLE_ADS_DEVELOPER_TOKEN=il4ZwMP_no7JozSz8iZAvg
GOOGLE_ADS_CLIENT_ID=386701778748-00jh022prnv9prt42989g0s7esf9djsr.apps.googleusercontent.com
GOOGLE_ADS_CLIENT_SECRET=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
GOOGLE_ADS_REFRESH_TOKEN=1//035pUKaVUAYp-CgYIARAAGAMSNwF-L9IrQyIh3QRgdluXjqrWCX8gEdL_NArz0uGOUqN2HTmsnwkPkH82v4r8sd9vLCrCW2Wytv0
GOOGLE_ADS_LOGIN_CUSTOMER_ID=7009924982
```

## 🔒 Medidas de Seguridad

1. **Nunca subas credenciales a repositorios públicos**
2. **Usa permisos mínimos necesarios**
3. **Rota credenciales cada 90 días**
4. **Mantén backups seguros de las credenciales**

## 📝 Próximos Pasos

1. ✅ Crear service account para GSC/GA4
2. ✅ Configurar accesos en las consolas respectivas
3. ✅ Descargar y guardar archivos JSON
4. ✅ Actualizar configuración de Claude Desktop
5. ✅ Probar conexiones MCP

## 🆘 Solución de Problemas

### Error: "Access denied"
- Verifica que el service account tenga los permisos correctos
- Asegúrate de que el email esté añadido en las consolas

### Error: "Invalid credentials"
- Verifica que el archivo JSON esté en la ruta correcta
- Comprueba que no haya caracteres especiales en las rutas

### Error: "Property not found"
- Verifica los IDs de propiedad en GA4
- Asegúrate de tener acceso a la propiedad

## 📞 Contacto y Soporte

Si necesitas ayuda adicional, consulta:
- [Documentación Google Cloud](https://cloud.google.com/docs)
- [Google Search Console API](https://developers.google.com/webmaster-tools)
- [Google Analytics 4 API](https://developers.google.com/analytics/devguides/reporting/data/v1)