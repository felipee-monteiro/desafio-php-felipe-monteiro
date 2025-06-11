import type { Locator, Page } from "@playwright/test";
import { faker } from '@faker-js/faker';

type Login = {
    login: string;
    password: string;
    rememberMe?: boolean;
    shouldClickOnLoginButton?: boolean;
    page: Page;
};

export const FIELDS_TESTIDS = {
    login: "email",
    password: "password",
    rememberMe: "rememberMe",
    loginButton: "loginButton"
};

export type FieldsTestIdsKinds = "login" | "resetPassword";

export interface FieldsTest {
    type: FieldsTestIdsKinds;
    fields: Record<string, Locator>;
};

export function getFieldsByKind({ kind, page }: {
    page: Page,
    kind: FieldsTestIdsKinds
}): FieldsTest {
    switch (kind) {
        case "login":
            return {
                type: "login",
                fields: {
                    loginField: page.getByTestId("email"),
                    passwordField: page.getByTestId("password"),
                    rememberMeField: page.getByTestId("rememberMe"),
                    loginButton: page.getByTestId("loginButton"),
                }
            };
        case "resetPassword":
            return {
                type: "resetPassword",
                fields: {
                    resetPasswordLink: page.getByTestId(""),
                    resetPasswordEmailField: page.getByTestId(""),
                    resetPasswordButton: page.getByTestId(""),
                }
            };
        default:
            throw new TypeError(`invalid field kind "${kind}"`);
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
    const { loginField, passwordField, rememberMeField, loginButton } = getFieldsByKind({
        kind: "login",
        page
    }).fields;

    await loginField.fill(login);
    await passwordField.fill(password);

    if (rememberMe) {
        await rememberMeField.check();
    }

    if (shouldClickOnLoginButton) {
        await loginButton.click();
    }
}

export function generateRandomEmail(): string {
    return faker.internet.email({
        allowSpecialCharacters: true
    });
}
