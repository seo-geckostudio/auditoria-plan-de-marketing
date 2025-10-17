// MCP: GSC Data Fetcher
// Uso: node fetch_gsc_data.js
// Requiere: googleapis y dotenv
// Configurar variables en .env.gsc (ver .env.gsc.example)

const fs = require('fs');
const path = require('path');
// Cargar primero .env.gsc local y, si faltan variables, hacer fallback al .env raíz del proyecto
const dotenv = require('dotenv');
dotenv.config({ path: path.resolve(__dirname, '.env.gsc') });

// Cargar variables desde el .env raíz SIN sobrescribir las ya definidas en .env.gsc
function ensureEnvLoaded() {
  const rootEnvPath = path.resolve(__dirname, '../../.env');
  try {
    const content = fs.readFileSync(rootEnvPath, 'utf8');
    const parsed = dotenv.parse(content);
    for (const [key, value] of Object.entries(parsed)) {
      if (process.env[key] === undefined || process.env[key] === '') {
        process.env[key] = value;
      }
    }
  } catch (e) {
    // Si no existe .env raíz o hay error de lectura, continuar sin interrumpir
  }
}
ensureEnvLoaded();

let google;
try {
  ({ google } = require('googleapis'));
} catch (e) {
  console.error('Falta dependencia googleapis. Instala con: npm i googleapis dotenv');
  process.exit(1);
}

const {
  GOOGLE_CLIENT_ID,
  GOOGLE_CLIENT_SECRET,
  GOOGLE_REFRESH_TOKEN,
  // Fallback a credenciales de Google Ads si no hay genéricas
  GOOGLE_ADS_CLIENT_ID,
  GOOGLE_ADS_CLIENT_SECRET,
  GOOGLE_ADS_REFRESH_TOKEN,
  GSC_SITE_URL,
  GSC_SERVICE_ACCOUNT_PATH
} = process.env;

let webmasters;

async function getAuthClient() {
  // Priorizar Service Account si está configurado
  if (GSC_SERVICE_ACCOUNT_PATH) {
    const projectRoot = path.resolve(__dirname, '../../');
    const saCandidates = [
      GSC_SERVICE_ACCOUNT_PATH,
      path.resolve(projectRoot, GSC_SERVICE_ACCOUNT_PATH || ''),
      path.resolve(projectRoot, 'credentials/gsc-service-account.json'),
      path.resolve(process.cwd(), GSC_SERVICE_ACCOUNT_PATH || ''),
    ].filter(Boolean);
    let saPath = null;
    for (const p of saCandidates) {
      try {
        if (p && fs.existsSync(p)) { saPath = p; break; }
      } catch {}
    }
    if (!saPath) {
      throw new Error(`No se encontró el archivo de service account en: ${saCandidates.join(' | ')}`);
    }
    const key = JSON.parse(fs.readFileSync(saPath, 'utf8'));
    const auth = new google.auth.GoogleAuth({
      credentials: key,
      scopes: ['https://www.googleapis.com/auth/webmasters.readonly']
    });
    const client = await auth.getClient();
    return client;
  }

  // Si no hay Service Account, usar OAuth genérico si está completo
  if (GOOGLE_CLIENT_ID && GOOGLE_CLIENT_SECRET && GOOGLE_REFRESH_TOKEN) {
    const oauth2Client = new google.auth.OAuth2(
      GOOGLE_CLIENT_ID,
      GOOGLE_CLIENT_SECRET,
      'urn:ietf:wg:oauth:2.0:oob'
    );
    oauth2Client.setCredentials({ refresh_token: GOOGLE_REFRESH_TOKEN });
    return oauth2Client;
  }

  // Último recurso: intentar OAuth de Google Ads (puede fallar por alcances)
  if (GOOGLE_ADS_CLIENT_ID && GOOGLE_ADS_CLIENT_SECRET && GOOGLE_ADS_REFRESH_TOKEN) {
    const oauth2Client = new google.auth.OAuth2(
      GOOGLE_ADS_CLIENT_ID,
      GOOGLE_ADS_CLIENT_SECRET,
      'urn:ietf:wg:oauth:2.0:oob'
    );
    oauth2Client.setCredentials({ refresh_token: GOOGLE_ADS_REFRESH_TOKEN });
    return oauth2Client;
  }

  if (GSC_SERVICE_ACCOUNT_PATH) {
    // Resolver ruta relativa al raíz del proyecto
    const saPath = path.isAbsolute(GSC_SERVICE_ACCOUNT_PATH)
      ? GSC_SERVICE_ACCOUNT_PATH
      : path.resolve(__dirname, '../../', GSC_SERVICE_ACCOUNT_PATH);
    const key = JSON.parse(fs.readFileSync(saPath, 'utf8'));
    const scopes = ['https://www.googleapis.com/auth/webmasters.readonly'];
    const jwtClient = new google.auth.JWT(
      key.client_email,
      null,
      key.private_key,
      scopes
    );
    await jwtClient.authorize().catch(() => {});
    return jwtClient;
  }

  console.error('Config incompleta. Proporciona credenciales OAuth (CLIENT_ID/SECRET/REFRESH_TOKEN) o GSC_SERVICE_ACCOUNT_PATH');
  process.exit(1);
}

async function resolveSiteUrl(/* authClient */) {
  if (GSC_SITE_URL) return GSC_SITE_URL;
  // Fallback seguro: usar el dominio principal del proyecto si no está definido
  const fallback = 'https://www.ibizavilla.com/';
  console.log('→ GSC_SITE_URL no definido. Usando fallback:', fallback);
  return fallback;
}

const OUT_DIR = path.resolve(__dirname, '../assets/data/custom');
// Duplicar salida en informe final (ibiza villa / FASE_5_ENTREGABLES_FINALES)
const OUT_DIR_FINAL = path.resolve(__dirname, '../../ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/assets/data/custom');

function ensureOutDir() {
  fs.mkdirSync(OUT_DIR, { recursive: true });
  try { fs.mkdirSync(OUT_DIR_FINAL, { recursive: true }); } catch {}
}

function writeCSV(filename, headers, rows) {
  const csv = [headers.join(',')]
    .concat(rows.map(r => headers.map(h => (r[h] ?? '')).join(',')))
    .join('\n');
  const filePathA = path.join(OUT_DIR, filename);
  fs.writeFileSync(filePathA, csv, 'utf8');
  console.log('✓ CSV escrito:', filePathA);

  // Copia al informe final si la ruta existe
  try {
    const filePathB = path.join(OUT_DIR_FINAL, filename);
    fs.writeFileSync(filePathB, csv, 'utf8');
    console.log('✓ CSV replicado:', filePathB);
  } catch {}
}

function formatDateYYYYMMDD(date) {
  const y = date.getFullYear();
  const m = String(date.getMonth() + 1).padStart(2, '0');
  const d = String(date.getDate()).padStart(2, '0');
  return `${y}-${m}-${d}`;
}

let SITE_URL = GSC_SITE_URL;

async function querySearchAnalytics({ startDate, endDate, dimensions, rowLimit = 25000 }) {
  const res = await webmasters.searchanalytics.query({
    siteUrl: SITE_URL,
    requestBody: {
      startDate,
      endDate,
      dimensions,
      rowLimit
    }
  });
  return res.data.rows || [];
}

async function fetchPagesLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const rows = await querySearchAnalytics({
    startDate: formatDateYYYYMMDD(startDate),
    endDate: formatDateYYYYMMDD(endDate),
    dimensions: ['page']
  });
  const out = rows.map(r => ({
    page: (r.keys && r.keys[0]) || '',
    clicks: r.clicks || 0,
    impressions: r.impressions || 0,
    ctr: (r.ctr || 0).toFixed ? (r.ctr * 100).toFixed(2) : r.ctr,
    position: r.position || 0
  })).sort((a,b) => b.clicks - a.clicks);
  writeCSV('gsc_pages_last30.csv', ['page','clicks','impressions','ctr','position'], out);
}

async function fetchQueriesLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const rows = await querySearchAnalytics({
    startDate: formatDateYYYYMMDD(startDate),
    endDate: formatDateYYYYMMDD(endDate),
    dimensions: ['query']
  });
  const out = rows.map(r => ({
    query: (r.keys && r.keys[0]) || '',
    clicks: r.clicks || 0,
    impressions: r.impressions || 0,
    ctr: (r.ctr || 0).toFixed ? (r.ctr * 100).toFixed(2) : r.ctr,
    position: r.position || 0
  })).sort((a,b) => b.clicks - a.clicks);
  writeCSV('gsc_queries_last30.csv', ['query','clicks','impressions','ctr','position'], out);
}

async function fetchPagesByDeviceLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const rows = await querySearchAnalytics({
    startDate: formatDateYYYYMMDD(startDate),
    endDate: formatDateYYYYMMDD(endDate),
    dimensions: ['page','device']
  });
  const out = rows.map(r => ({
    page: (r.keys && r.keys[0]) || '',
    device: (r.keys && r.keys[1]) || '',
    clicks: r.clicks || 0,
    impressions: r.impressions || 0,
    ctr: (r.ctr || 0).toFixed ? (r.ctr * 100).toFixed(2) : r.ctr,
    position: r.position || 0
  }));
  writeCSV('gsc_pages_by_device_last30.csv', ['page','device','clicks','impressions','ctr','position'], out);
}

async function fetchPagesByCountryLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const rows = await querySearchAnalytics({
    startDate: formatDateYYYYMMDD(startDate),
    endDate: formatDateYYYYMMDD(endDate),
    dimensions: ['page','country']
  });
  const out = rows.map(r => ({
    page: (r.keys && r.keys[0]) || '',
    country: (r.keys && r.keys[1]) || '',
    clicks: r.clicks || 0,
    impressions: r.impressions || 0,
    ctr: (r.ctr || 0).toFixed ? (r.ctr * 100).toFixed(2) : r.ctr,
    position: r.position || 0
  }));
  writeCSV('gsc_pages_by_country_last30.csv', ['page','country','clicks','impressions','ctr','position'], out);
}

async function fetchQueriesByDeviceLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const rows = await querySearchAnalytics({
    startDate: formatDateYYYYMMDD(startDate),
    endDate: formatDateYYYYMMDD(endDate),
    dimensions: ['query','device']
  });
  const out = rows.map(r => ({
    query: (r.keys && r.keys[0]) || '',
    device: (r.keys && r.keys[1]) || '',
    clicks: r.clicks || 0,
    impressions: r.impressions || 0,
    ctr: (r.ctr || 0).toFixed ? (r.ctr * 100).toFixed(2) : r.ctr,
    position: r.position || 0
  }));
  writeCSV('gsc_queries_by_device_last30.csv', ['query','device','clicks','impressions','ctr','position'], out);
}

async function fetchQueriesByCountryLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const rows = await querySearchAnalytics({
    startDate: formatDateYYYYMMDD(startDate),
    endDate: formatDateYYYYMMDD(endDate),
    dimensions: ['query','country']
  });
  const out = rows.map(r => ({
    query: (r.keys && r.keys[0]) || '',
    country: (r.keys && r.keys[1]) || '',
    clicks: r.clicks || 0,
    impressions: r.impressions || 0,
    ctr: (r.ctr || 0).toFixed ? (r.ctr * 100).toFixed(2) : r.ctr,
    position: r.position || 0
  }));
  writeCSV('gsc_queries_by_country_last30.csv', ['query','country','clicks','impressions','ctr','position'], out);
}

async function main() {
  ensureOutDir();
  console.log('→ Extrayendo datos GSC (MCP)...');
  try {
    const authClient = await getAuthClient();
    webmasters = google.webmasters({ version: 'v3', auth: authClient });
    SITE_URL = await resolveSiteUrl();
    await fetchPagesLast30();
    await fetchQueriesLast30();
    await fetchPagesByDeviceLast30();
    await fetchPagesByCountryLast30();
    await fetchQueriesByDeviceLast30();
    await fetchQueriesByCountryLast30();
    console.log('✓ Extracción GSC completada. CSVs disponibles en assets/data/custom');
  } catch (e) {
    console.error('Error durante extracción GSC:', e.message);
    process.exit(1);
  }
}

main();