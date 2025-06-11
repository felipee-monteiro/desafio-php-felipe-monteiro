import test from "./fixtures";
import {
    FIELDS_TESTIDS,
    generateRandomEmail,
    generateRandomPassword,
    invalidEmails,
    login,
} from "./utils";

const { describe, beforeEach, expect, afterEach } = test;

describe("Login as colaborador", function () {
    beforeEach(async ({ page }) => {
        await page.goto("/", { timeout: 50000 });
        await expect(page).toHaveURL("/login", { timeout: 50000 });
    });

    afterEach(async ({ page, loginFields, baseURL }) => {
        if (page.url() === `${baseURL}/login`) {
            const { loginField, passwordField } = loginFields.fields;
            await expect(loginField).toBeEmpty();
            await expect(passwordField).toBeEmpty();
        }
    });

    test("should allow me to login as a colaborador", async ({ page }) => {
        await login({
            page,
            rememberMe: false,
            login: "colaborador@mail.com",
            password: "colaborador#engeselt",
        });

        await expect(page).toHaveURL("/chamados");
    });

    test("should not allow me to login when the email is incorrect", async ({
        page,
    }) => {
        await login({
            page,
            login: generateRandomEmail(),
            password: "colaborador#engeselt",
        });

        await expect(page).toHaveURL("/login");
        await expect(
            page.getByTestId(`${FIELDS_TESTIDS.login}-error`),
        ).toBeVisible();
    });

    test("should not allow me to login when the password is incorrect", async ({
        page,
    }) => {
        await login({
            page,
            login: "colaborador@mail.com",
            password: "colaborador#",
        });

        await expect(page).toHaveURL("/login");
        await expect(
            page.getByTestId(`${FIELDS_TESTIDS.login}-error`),
        ).toBeVisible({ timeout: 10000 });
    });

    test("should not allow me to login with invalid emails", async ({
        page,
        loginFields,
    }) => {
        for (const email of invalidEmails) {
            await login({
                page,
                login: email,
                shouldClickOnLoginButton: false,
                password: "...",
            });
            const { loginButton } = loginFields.fields;
            await loginButton.click();
            await expect(page).toHaveURL("/login");
        }
    });

    test("should not allow me to login with invalid passwords", async ({
        page,
        loginFields,
    }) => {
        const invalidPasswords = new Array(6)
            .fill(null)
            .map(() => generateRandomPassword());

        for (const pass of invalidPasswords) {
            await login({
                page,
                login: "colaborador@mail.com",
                shouldClickOnLoginButton: false,
                password: pass,
            });

            const { loginButton } = loginFields.fields;
            await loginButton.click();
            await expect(page).toHaveURL("/login");
        }
    });
});
