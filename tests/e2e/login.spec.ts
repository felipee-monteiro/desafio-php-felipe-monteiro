import test from "./fixtures";
import { FIELDS_TESTIDS, login } from "./utils";

const { describe, beforeEach, expect } = test;

beforeEach(async ({ page }) => {
    await page.goto('/', { timeout: 50000 });
    await expect(page).toHaveURL("/login", { timeout: 50000 });
});

describe("Login as colaborador", function () {
    test('should allow me to login as a colaborador', async ({ page }) => {
        await login({
            page,
            rememberMe: false,
            login: 'colaborador@mail.com',
            password: 'colaborador#engeselt'
        });

        await expect(page).toHaveURL('/chamados');
    });

    test('should not allow me to login when the email is incorrect', async ({ page }) => {
        await login({
            page,
            login: 'colaborador@mai.com',
            password: 'colaborador#engeselt',
        });

        await expect(page).toHaveURL('/login');
        await expect(page.getByTestId(`${FIELDS_TESTIDS.login}-error`)).toBeVisible();
    });

    test('should not allow me to login when the password is incorrect', async ({ page }) => {
        await login({
            page,
            login: 'colaborador@mail.com',
            password: 'colaborador#',
        });

        await expect(page).toHaveURL('/login');
        await expect(page.getByTestId(`${FIELDS_TESTIDS.login}-error`)).toBeVisible({ timeout: 10000 });
    });

    test('should not allow me to login with invalid emails', async ({ page, loginFields }) => {
        const invalidEmails = [
            '',
            ' ',
            'test',
            'test@',
            'test@a',
            'test@mail.'
        ];
        for (const email of invalidEmails) {
            await login({ page, login: email, shouldClickOnLoginButton: false, password: '...' });
            const { loginButton } = loginFields.fields;
            await loginButton.click();
            await expect(page).toHaveURL('/login');
        }
    });

    test('should not allow me to login with invalid passwords', async ({ page }) => {
        const invalidPasswords = [
            '',
            ' ',
            'test',
            'test@',
            'test@a',
            'test@mail.'
        ];
        for (const pass of invalidPasswords) {
            await login({ page, login: 'colaborador@mail.com', password: pass });
            await expect(page).toHaveURL('/login');
        }
    });
});

