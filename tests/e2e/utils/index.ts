import type { Locator, Page } from "@playwright/test";

type Login = {
    login: string;
    password: string;
    rememberMe?: boolean;
    shouldClickOnLoginButton?: boolean;
    page: Page;
};

type LoginFields = {
    loginField: Locator,
    passwordField: Locator,
    rememberMeField: Locator,
    loginButton: Locator,
};

export const FIELDS_TESTIDS = {
    login: "email",
    password: "password",
    rememberMe: "rememberMe",
    loginButton: "loginButton"
};

export function getLoginFields(page: Page): LoginFields {
    return {
        loginField: page.getByTestId(FIELDS_TESTIDS.login),
        passwordField: page.getByTestId(FIELDS_TESTIDS.password),
        rememberMeField: page.getByTestId(FIELDS_TESTIDS.rememberMe),
        loginButton: page.getByTestId(FIELDS_TESTIDS.loginButton)
    };
}

export function isValidString(v: string | string[]): boolean {
    if (Array.isArray(v)) {
        return v.every(function (value: string) {
            return isValidString(value);
        });
    }

    return typeof v === "string" && v.trim().length > 0;
}

export async function login({ page, login, password, shouldClickOnLoginButton = true, rememberMe = false }: Readonly<Login>): Promise<void> {
    const { loginField, passwordField, rememberMeField, loginButton } = getLoginFields(page);

    if (!isValidString([
        login,
        password
    ])) {
        throw new TypeError("please verify the input string before try again");
    }

    await loginField.fill(login);
    await passwordField.fill(password);

    if (rememberMe) {
        await rememberMeField.check();
    } else {
        await page.uncheck(`input[data-testid="${FIELDS_TESTIDS.rememberMe}"]`);
    }

    if (shouldClickOnLoginButton) {
        await loginButton.click();
    }
}
