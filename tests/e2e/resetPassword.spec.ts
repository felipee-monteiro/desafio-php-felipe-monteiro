import test from './fixtures';
import { generateRandomEmail, solicitateToRedefinePassword } from './utils';

const { describe, beforeEach, expect } = test;

describe("Reset Password Flow", function () {
    beforeEach(async ({ page }) => {
        await page.goto('/', { timeout: 10000 });
        await expect(page).toHaveURL("login", { timeout: 10000 });
        await page.getByTestId('resetPassLink').click();
        await expect(page).toHaveURL('forgot-password');
    });

    test('should not allow me to recover password with invalid emails', async function ({ page }) {
        await solicitateToRedefinePassword({
            email: generateRandomEmail(),
            page
        });

        await expect(page.getByTestId("resetPasswordEmailField-error")).toBeVisible();
    });
});
