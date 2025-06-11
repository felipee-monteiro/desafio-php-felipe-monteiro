import { expect, test } from '@playwright/test';

test.beforeEach(async ({ page }) => {
    await page.goto('/', { timeout: 10000 });
    await expect(page).toHaveURL("/login", { timeout: 10000 });
    await page.getByTestId('resetPassLink').click();
    await expect(page).toHaveURL('forgot-password');
});

test.describe("Reset Password Flow", function () {

});
