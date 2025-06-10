import { expect, test } from '@playwright/test';
import { login } from "./utils";

test.beforeEach(async function ({ page }) {
    await page.goto('/');
    await expect(page).toHaveURL("/login");
})

test('has title', async ({ page }) => {

});
