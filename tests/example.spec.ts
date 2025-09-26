import { test, expect } from '@playwright/test';

test('has title', async ({ page }) => {
  await page.goto('/');

  // Expect a title "to contain" a substring.
  await expect(page).toHaveTitle(/Sistema de Auditorías/);
});

test('navigate to auditorias', async ({ page }) => {
  await page.goto('/');

  // Click the auditorias link.
  await page.click('a[href*="auditorias"]');

  // Expects the URL to contain auditorias.
  await expect(page).toHaveURL(/.*auditorias/);
});