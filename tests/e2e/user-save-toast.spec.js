import { expect, test } from '@playwright/test';

test('saving user details redirects to users and shows a toast', async ({ page }) => {
    await page.goto('/login');

    await page.getByLabel('Email').fill('admin@kraite.test');
    await page.getByLabel('Password').fill('password');
    await page.getByRole('button', { name: 'Sign in' }).click();

    await expect(page).toHaveURL(/\/dashboard$/);

    await page.goto('/users/2');
    await expect(page.locator('[data-component-name="UserShow"]')).toBeVisible();
    await expect(page.getByText('Karine Esnault').first()).toBeVisible();
    await expect(page.getByLabel('Avatar Image')).toBeVisible();
    await expect(page.getByLabel('Avatar URL')).toHaveCount(0);

    const admin = page.getByLabel('Administrator');
    await admin.setChecked(true);
    await page.getByRole('button', { name: 'Save' }).click();

    await expect(page).toHaveURL(/\/users$/);
    await expect(page.locator('[data-component-name="UsersIndex"]')).toBeVisible();
    await expect(page.locator('[data-component-name="Toast"]')).toContainText('User Karine Esnault updated.');
});
