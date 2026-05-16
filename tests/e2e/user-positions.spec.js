import { expect, test } from '@playwright/test';

test('user positions tab loads account reconciliation and history', async ({ page }) => {
    await page.goto('/login');

    await page.getByLabel('Email').fill('admin@kraite.test');
    await page.getByLabel('Password').fill('password');
    await page.getByRole('button', { name: 'Sign in' }).click();

    await expect(page).toHaveURL(/\/dashboard$/);

    await page.goto('/users/2');
    await expect(page.locator('[data-component-name="UserShow"]')).toBeVisible();

    await page.getByRole('button', { name: /Positions\s+0/ }).click();

    await expect(page.locator('[data-component-name="Users/PositionsPanel"]')).toBeVisible();
    await expect(page.getByRole('heading', { name: 'Open positions' })).toBeVisible();
    await expect(page.getByRole('heading', { name: 'All positions' })).toBeVisible();
    await expect(page.getByRole('columnheader', { name: 'Symbol' })).toBeVisible();
    await expect(page.getByRole('columnheader', { name: 'PnL' })).toBeVisible();
});
