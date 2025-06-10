import type { Locator, Page } from "@playwright/test";

type Login = {
    login: string;
    password: string;
    rememberMe: boolean;
    page: Page;
};

type LoginFields = {
    loginField: Locator,
    passwordField: Locator,
    rememberMeField: Locator
};

const FIELDS_TESTIDS = {
    login: "email",
    password: "password",
    rememberMe: "rememberMe"
};

async function getLoginFields(page: Page): Promise<LoginFields> {
    return {
        loginField: page.getByTestId(FIELDS_TESTIDS.login),
        passwordField: page.getByTestId(FIELDS_TESTIDS.password),
        rememberMeField: page.getByTestId(FIELDS_TESTIDS.rememberMe)
    };
}

export function isValidString(v: string | string[]): boolean {
    if (Array.isArray(v)) {
        return v.some(function (value: string) {
            return isValidString(value);
        });
    }

    return typeof v === "string" && v.trim().length > 0;
}

export async function login({ page, login, password, rememberMe }: Readonly<Login>): Promise<void> {
    const { loginField, passwordField, rememberMeField } = await getLoginFields(page);

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
        await rememberMeField.clear();
    }
}
