import { expect, test } from '@playwright/test';

test('user sub-tabs show counts and lazy-load accounts', async ({ page }) => {
    await page.goto('/login');

    await page.getByLabel('Email').fill('admin@kraite.test');
    await page.getByLabel('Password').fill('password');
    await page.getByRole('button', { name: 'Sign in' }).click();

    await expect(page).toHaveURL(/\/dashboard$/);

    await page.goto('/users/2');
    await expect(page.locator('[data-component-name="UserShow"]')).toBeVisible();
    await expect(page.getByRole('button', { name: /Accounts\s+1/ })).toBeVisible();
    await expect(page.getByRole('button', { name: /Positions\s+0/ })).toBeVisible();
    await expect(page.getByRole('button', { name: /Billing\s+0/ })).toBeVisible();

    await page.getByRole('button', { name: /Accounts\s+1/ }).click();

    await expect(page.locator('[data-component-name="Users/AccountsPanel"]')).toBeVisible();
    await expect(page.locator('[data-component-name="Users/AccountsRow"]')).toContainText('Karine Binance Account');
    await expect(page.locator('#account-1-margin')).not.toBeVisible();

    await page.getByRole('button', { name: 'Create account' }).click();
    await expect(page.locator('[data-component-name="Users/AccountsCreateForm"]')).toBeVisible();
    await expect(page.locator('#new-account-name')).toBeVisible();
    await expect(page.locator('#new-account-api-system')).toHaveValue('1');
    await expect(page.locator('#new-account-portfolio')).toHaveValue('USDT');
    await expect(page.locator('#new-account-balance-basis')).toHaveValue('total');
    await expect(page.locator('#new-account-api-key')).toBeVisible();
    await expect(page.locator('#new-account-api-secret')).toBeVisible();
    await expect(page.locator('#new-account-api-passphrase')).toHaveCount(0);
    await expect(page.locator('#new-account-api-system')).not.toContainText('KuCoin');
    await expect(page.locator('#new-account-api-system')).not.toContainText('Bybit');
    await page.locator('#new-account-api-system').selectOption({ label: 'BitGet' });
    await expect(page.locator('#new-account-api-passphrase')).toBeVisible();
    await page.getByRole('button', { name: 'Cancel' }).click();
    await expect(page.locator('[data-component-name="Users/AccountsCreateForm"]')).toHaveCount(0);

    await page.locator('[data-component-name="Users/AccountsRow"]').getByRole('button', { name: /Karine Binance Account/ }).click();

    await expect(page.locator('#account-1-portfolio')).toHaveValue('USDT');
    await expect(page.locator('#account-1-trading')).toHaveValue('USDT');
    await expect(page.locator('#account-1-balance-basis')).toHaveValue('total');
    await expect(page.locator('#account-1-long')).toHaveValue('20');
    await expect(page.locator('#account-1-short')).toHaveValue('15');
    await expect(page.locator('#account-1-long-margin')).toHaveAttribute('type', 'text');
    await expect(page.locator('#account-1-long-margin')).toHaveAttribute('inputmode', 'decimal');
    await expect(page.locator('#account-1-short-margin')).toHaveAttribute('type', 'text');
    await expect(page.locator('#account-1-short-margin')).toHaveAttribute('inputmode', 'decimal');

    const accountRow = page.locator('[data-component-name="Users/AccountsRow"]');
    const detailsTab = accountRow.getByRole('tab', { name: 'Details' });
    const connectivityTab = accountRow.getByRole('tab', { name: 'Server connectivity' });

    await expect(detailsTab).toHaveAttribute('data-active', 'true');
    await expect(connectivityTab).toHaveAttribute('data-active', 'false');

    await connectivityTab.click();
    await expect(detailsTab).toHaveAttribute('data-active', 'false');
    await expect(connectivityTab).toHaveAttribute('data-active', 'true');
    await expect(page.getByRole('button', { name: 'Test servers connectivity' })).toBeVisible();
    await expect(page.locator('#account-1-name')).not.toBeVisible();

    await detailsTab.click();
    await expect(detailsTab).toHaveAttribute('data-active', 'true');
    await expect(connectivityTab).toHaveAttribute('data-active', 'false');
    await expect(page.locator('#account-1-name')).toBeVisible();

    await page.locator('#account-1-margin').fill('100');
    await page.locator('#account-1-margin').blur();
    await expect(page.locator('#account-1-long-margin')).toHaveValue('');
    await expect(page.locator('#account-1-short-margin')).toHaveValue('');

    await page.locator('#account-1-long-margin').fill('3.00');
    await page.locator('#account-1-long-margin').blur();
    await expect(page.locator('#account-1-margin')).toHaveValue('');
});
