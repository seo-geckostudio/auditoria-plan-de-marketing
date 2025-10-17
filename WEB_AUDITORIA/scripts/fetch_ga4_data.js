// MCP: GA4 Data Fetcher
// Uso: node fetch_ga4_data.js
// Requiere: @google-analytics/data y dotenv
// Configurar variables en .env (ver .env.example)

const fs = require('fs');
const path = require('path');
require('dotenv').config({ path: path.resolve(__dirname, '.env') });

let BetaAnalyticsDataClient;
try {
  ({ BetaAnalyticsDataClient } = require('@google-analytics/data'));
} catch (e) {
  console.error('Falta dependencia @google-analytics/data. Instala con: npm i @google-analytics/data dotenv');
  process.exit(1);
}

const propertyId = process.env.GA4_PROPERTY_ID;
const keyFilename = process.env.GOOGLE_APPLICATION_CREDENTIALS;

if (!propertyId || !keyFilename) {
  console.error('Config incompleta. Define GA4_PROPERTY_ID y GOOGLE_APPLICATION_CREDENTIALS en .env');
  process.exit(1);
}

const client = new BetaAnalyticsDataClient({ keyFilename });

const OUT_DIR = path.resolve(__dirname, '../assets/data/custom');

function ensureOutDir() {
  fs.mkdirSync(OUT_DIR, { recursive: true });
}

function writeCSV(filename, headers, rows) {
  const filePath = path.join(OUT_DIR, filename);
  const csv = [headers.join(',')]
    .concat(rows.map(r => headers.map(h => (r[h] ?? '')).join(',')))
    .join('\n');
  fs.writeFileSync(filePath, csv, 'utf8');
  console.log('✓ CSV escrito:', filePath);
}

function formatDateYYYYMMDD(date) {
  const y = date.getFullYear();
  const m = String(date.getMonth() + 1).padStart(2, '0');
  const d = String(date.getDate()).padStart(2, '0');
  return `${y}-${m}-${d}`;
}

function addMonths(date, delta) {
  const d = new Date(date);
  d.setMonth(d.getMonth() + delta);
  return d;
}

async function runReport(params) {
  const [response] = await client.runReport(params);
  return response;
}

async function fetchSearchEnginesLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const resp = await runReport({
    property: `properties/${propertyId}`,
    dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }],
    dimensions: [
      { name: 'sessionDefaultChannelGroup' },
      { name: 'source' }
    ],
    metrics: [{ name: 'sessions' }],
  });
  const rows = (resp.rows || [])
    .filter(r => r.dimensionValues?.[0]?.value === 'Organic Search')
    .map(r => ({
      searchEngine: r.dimensionValues?.[1]?.value || '',
      sessions: r.metricValues?.[0]?.value || '0'
    }))
    .sort((a,b) => parseInt(b.sessions) - parseInt(a.sessions));
  writeCSV('search_engines_last30.csv', ['searchEngine','sessions'], rows);
}

async function fetchPageviewsByCountryLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const resp = await runReport({
    property: `properties/${propertyId}`,
    dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }],
    dimensions: [{ name: 'country' }],
    metrics: [{ name: 'views' }]
  });
  const rows = (resp.rows || []).map(r => ({
    country: r.dimensionValues?.[0]?.value || '',
    screenPageViews: r.metricValues?.[0]?.value || '0'
  })).sort((a,b) => parseInt(b.screenPageViews) - parseInt(a.screenPageViews));
  writeCSV('pageviews_by_country_last30.csv', ['country','screenPageViews'], rows);
}

async function fetchPageviewsByDeviceLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const resp = await runReport({
    property: `properties/${propertyId}`,
    dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }],
    dimensions: [{ name: 'deviceCategory' }],
    metrics: [{ name: 'views' }]
  });
  const rows = (resp.rows || []).map(r => ({
    deviceCategory: r.dimensionValues?.[0]?.value || '',
    screenPageViews: r.metricValues?.[0]?.value || '0'
  })).sort((a,b) => parseInt(b.screenPageViews) - parseInt(a.screenPageViews));
  writeCSV('pageviews_by_device_last30.csv', ['deviceCategory','screenPageViews'], rows);
}

async function fetchPagesSampleLast30() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 30);
  const resp = await runReport({
    property: `properties/${propertyId}`,
    dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }],
    dimensions: [{ name: 'pagePath' }],
    metrics: [{ name: 'views' }],
    orderBys: [{ desc: true, metric: { metricName: 'views' } }],
    limit: 50
  });
  const rows = (resp.rows || []).map(r => ({
    pagePath: r.dimensionValues?.[0]?.value || '',
    screenPageViews: r.metricValues?.[0]?.value || '0'
  }));
  writeCSV('pages_sample.csv', ['pagePath','screenPageViews'], rows);
}

async function fetchChannelsLast365() {
  const endDate = new Date();
  const startDate = new Date();
  startDate.setDate(endDate.getDate() - 365);
  const resp = await runReport({
    property: `properties/${propertyId}`,
    dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }],
    dimensions: [{ name: 'sessionDefaultChannelGroup' }],
    metrics: [{ name: 'sessions' }]
  });
  const rowsRaw = (resp.rows || []).map(r => ({
    channelGroup: r.dimensionValues?.[0]?.value || '',
    sessions: parseInt(r.metricValues?.[0]?.value || '0')
  }));
  const total = rowsRaw.reduce((acc, r) => acc + r.sessions, 0) || 1;
  const rows = rowsRaw.map(r => ({
    channelGroup: r.channelGroup,
    sessions: r.sessions.toString(),
    sessionsPct: ((r.sessions / total) * 100).toFixed(2) + '%',
    revenuePct: ''
  })).sort((a,b) => parseInt(b.sessions) - parseInt(a.sessions));
  writeCSV('channels_last365.csv', ['channelGroup','sessions','sessionsPct','revenuePct'], rows);
}

async function fetchOrganicSessionsYoYLast12() {
  const endDate = new Date();
  const startDate = addMonths(endDate, -11); // 12 meses
  const prevStart = addMonths(startDate, -12);
  const prevEnd = addMonths(endDate, -12);

  const common = {
    property: `properties/${propertyId}`,
    dimensions: [{ name: 'month' }, { name: 'sessionDefaultChannelGroup' }],
    metrics: [{ name: 'sessions' }]
  };

  const [currResp, prevResp] = await Promise.all([
    runReport({
      ...common,
      dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }]
    }),
    runReport({
      ...common,
      dateRanges: [{ startDate: formatDateYYYYMMDD(prevStart), endDate: formatDateYYYYMMDD(prevEnd) }]
    })
  ]);

  const currMap = new Map();
  (currResp.rows || []).forEach(r => {
    const month = r.dimensionValues?.[0]?.value || '';
    const ch = r.dimensionValues?.[1]?.value || '';
    if (ch === 'Organic Search') {
      currMap.set(month, parseInt(r.metricValues?.[0]?.value || '0'));
    }
  });

  const prevMap = new Map();
  (prevResp.rows || []).forEach(r => {
    const month = r.dimensionValues?.[0]?.value || '';
    const ch = r.dimensionValues?.[1]?.value || '';
    if (ch === 'Organic Search') {
      prevMap.set(month, parseInt(r.metricValues?.[0]?.value || '0'));
    }
  });

  // Meses en formato MM (GA4 Data API usa 01..12)
  const months = [];
  for (let i = 0; i < 12; i++) {
    const m = addMonths(startDate, i);
    months.push(String(m.getMonth() + 1).padStart(2, '0'));
  }

  const rows = months.map(m => ({
    month: m,
    sessions_prev: (prevMap.get(m) || 0).toString(),
    sessions_curr: (currMap.get(m) || 0).toString()
  }));

  writeCSV('organic_sessions_yoy_last12.csv', ['month','sessions_prev','sessions_curr'], rows);
}

async function fetchOrganicConversionsLast12() {
  const endDate = new Date();
  const startDate = addMonths(endDate, -11);
  const resp = await runReport({
    property: `properties/${propertyId}`,
    dateRanges: [{ startDate: formatDateYYYYMMDD(startDate), endDate: formatDateYYYYMMDD(endDate) }],
    dimensions: [{ name: 'month' }, { name: 'sessionDefaultChannelGroup' }],
    metrics: [{ name: 'conversions' }]
  });
  const map = new Map();
  (resp.rows || []).forEach(r => {
    const m = r.dimensionValues?.[0]?.value || '';
    const ch = r.dimensionValues?.[1]?.value || '';
    if (ch === 'Organic Search') {
      const val = parseFloat(r.metricValues?.[0]?.value || '0');
      map.set(m, val);
    }
  });
  const rows = [];
  for (let i=0;i<12;i++) {
    const m = String(addMonths(startDate, i).getMonth() + 1).padStart(2, '0');
    rows.push({ month: m, conversions: (map.get(m) || 0).toString() });
  }
  writeCSV('organic_conversions_by_month_last12.csv', ['month','conversions'], rows);
}

async function main() {
  ensureOutDir();
  console.log('→ Extrayendo datos GA4 (MCP)...');
  try {
    await fetchSearchEnginesLast30();
    await fetchPageviewsByCountryLast30();
    await fetchPageviewsByDeviceLast30();
    await fetchPagesSampleLast30();
    await fetchChannelsLast365();
    await fetchOrganicSessionsYoYLast12();
    await fetchOrganicConversionsLast12();
    console.log('✓ Extracción completada. CSVs disponibles en assets/data/custom');
  } catch (e) {
    console.error('Error durante extracción:', e.message);
    process.exit(1);
  }
}

main();