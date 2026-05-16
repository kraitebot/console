import { expect, test } from '@playwright/test';

test('entity pages navigate from the sidebar with a content fade', async ({ page }) => {
    await page.goto('/login');

    await page.getByLabel('Email').fill('admin@kraite.test');
    await page.getByLabel('Password').fill('password');
    await page.getByRole('button', { name: 'Sign in' }).click();

    await expect(page).toHaveURL(/\/dashboard$/);

    await page
        .locator('[data-component-name="Aside/AsideQuickNav"]')
        .filter({ hasText: 'CRUDs' })
        .click();
    const sidebar = page.locator('[data-component-name="Aside"]');
    const usersLink = sidebar.getByRole('link', { name: 'Users', exact: true });
    const accountsLink = sidebar.getByRole('link', { name: 'Accounts', exact: true });

    await usersLink.click();

    await expect(page).toHaveURL(/\/users$/);
    await expect(usersLink).toHaveCSS('color', 'rgb(102, 255, 76)');
    await expect(page.locator('[data-component-name="Nav/ActiveIndicator"]')).toBeVisible();
    await expect(page.locator('[data-component-name="UsersIndex"]')).toBeVisible();
    await expect(page.getByText('Users').first()).toBeVisible();
    await expect(page.getByRole('columnheader', { name: 'Avatar' })).toBeVisible();
    await expect(page.getByRole('columnheader', { name: /Name/ })).toBeVisible();
    await expect(page.getByPlaceholder('Search users...')).toBeVisible();
    await expect(page.locator('[data-component-name="Table/TBody"] [data-component-name="Table/Tr"]')).toHaveCount(2);
    await expect(page.getByText(/Showing 1-2 of/)).toHaveCount(0);
    await expect(page.getByRole('columnheader', { name: /Name/ })).toHaveCSS('background-color', 'rgb(102, 255, 76)');
    await expect(page.locator('[data-component-name="Header"]')).toBeVisible();
    await expect(page.locator('[data-component-name="Breadcrumb"]')).toContainText('Users');

    await page.getByPlaceholder('Search users...').fill('admin');
    await expect(page.getByRole('cell', { name: 'Test Admin' })).toBeVisible();
    await page.getByPlaceholder('Search users...').fill('zzzz-no-user-match');
    await expect(page.locator('[data-component-name="Empty"]')).toBeVisible();
    await page.getByPlaceholder('Search users...').clear();
    await expect(page.locator('[data-component-name="Table/TBody"] [data-component-name="Table/Tr"]')).toHaveCount(2);

    await page.locator('[data-component-name="Aside"]').evaluate((aside) => {
        aside.dataset.persistProbe = 'sidebar-survived';
    });

    await page.evaluate(() => {
        window.Alpine.store('pageTransition').duration = 500;
    });

    await accountsLink.click();
    await expect(page.locator('[data-component-name="PageTransition"]')).toHaveClass(/opacity-0/);
    await expect(page.locator('[data-component-name="Header"]')).not.toHaveClass(/opacity-0/);
    await expect(page).toHaveURL(/\/accounts$/);
    await expect(accountsLink).toHaveCSS('color', 'rgb(102, 255, 76)');
    await expect(usersLink).not.toHaveCSS('color', 'rgb(102, 255, 76)');
    await expect(page.locator('[data-component-name="AccountsIndex"]')).toBeVisible();
    await expect(page.locator('[data-component-name="Breadcrumb"]')).toContainText('Accounts');
    await expect(page.getByText('Accounts will live here')).toBeVisible();
    await expect(page.locator('[data-component-name="PageTransition"]')).toHaveClass(/opacity-100/);
    await expect(page.locator('[data-component-name="Aside"]')).toHaveAttribute('data-persist-probe', 'sidebar-survived');

    await usersLink.click();
    await expect(page).toHaveURL(/\/users$/);
    await expect(page.locator('[data-component-name="UsersIndex"]')).toBeVisible();
});
