import { expect, test } from '@playwright/test';
import { FIELDS_TESTIDS, getLoginFields, login } from "./utils";

test.beforeEach(async ({ page }) => {
    await page.goto('/');
    expect(page).toHaveURL("/login");
});

test.describe("Login as colaborador", function () {
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
        await expect(page.getByTestId(`${FIELDS_TESTIDS.login}-error`)).toBeVisible();
    });

    test('should not allow me to login when the email is invalid', async ({ page }) => {
        const invalidEmails = [
            'test',
            'test@',
            'test@a',
            'test@mail.',
        ];

        invalidEmails.forEach(async function (mail) {
            await login({
                page,
                login: mail,
                shouldClickOnLoginButton: false,
                password: 'colaborador#engeselt',
            });

            const { loginButton } = getLoginFields(page);

            await loginButton.click();

            await expect(page).toHaveURL('/login')
        });
    });
});

