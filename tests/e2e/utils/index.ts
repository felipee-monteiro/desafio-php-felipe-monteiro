import type { Locator, Page } from "@playwright/test";
import { faker } from "@faker-js/faker";

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
    loginButton: "loginButton",
};

export type FieldsTestIdsKinds = "login" | "resetPassword" | "createChamado";

export interface FieldsTest<T extends string> {
    type: FieldsTestIdsKinds;
    fields: Record<T, Locator>;
}

export const invalidEmails = ["", " ", "test", "test@", "test@a", "test@mail."];

export function getFieldsByKind({
    kind,
    page,
}: {
    page: Page;
    kind: FieldsTestIdsKinds;
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
                },
            };
        case "resetPassword":
            return {
                type: "resetPassword",
                fields: {
                    resetPasswordLink: page.getByTestId("resetPasswordLink"),
                    resetPasswordEmailField: page.getByTestId(
                        "resetPasswordEmailField",
                    ),
                    resetPasswordButton: page.getByTestId(
                        "resetPasswordButton",
                    ),
                },
            };
        case "createChamado":
            return {
                type: "createChamado",
                fields: {
                    createChamadoTitleField:
                        page.getByTestId("chamadoTitleField"),
                    createChamadoDescriptionField: page.getByTestId(
                        "chamadoDescriptionField",
                    ),
                    createChamadoPrioridade: page.getByTestId(
                        "createChamadoPrioridade",
                    ),
                    createChamadoCategoria: page.getByTestId(
                        "createChamadoCategoria",
                    ),
                    createChamadoAnexo: page.getByTestId("createChamadoAnexo"),
                    createChamadoButton: page.getByTestId(
                        "createChamadoButton",
                    ),
                },
            };
        default:
            throw new TypeError(`invalid field kind "${kind}"`);
    }
}

export function isValidString(v: string | string[]): boolean {
    if (Array.isArray(v)) {
        return v.every(function (value: string) {
            return isValidString(value);
        });
    }

    return typeof v === "string" && v.trim().length > 0;
}

export async function login({
    page,
    login,
    password,
    shouldClickOnLoginButton = true,
    rememberMe = false,
}: Readonly<Login>): Promise<void> {
    const { loginField, passwordField, rememberMeField, loginButton } =
        getFieldsByKind({
            kind: "login",
            page,
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

export async function solicitateToRedefinePassword({
    page,
    email,
}: {
    page: Page;
    email: string;
}): Promise<void> {
    const { resetPasswordEmailField, resetPasswordButton } = getFieldsByKind({
        kind: "resetPassword",
        page,
    }).fields;

    await resetPasswordEmailField.fill(email);
    await resetPasswordButton.click();
}

export function generateRandomEmail(): string {
    return faker.internet.email({
        allowSpecialCharacters: true,
    });
}

export function generateRandomPassword(): string {
    return faker.internet.password({
        length: 8,
    });
}

export function generateRandomTitle(): string {
    return faker.internet.displayName();
}

export async function createChamado({
    categoria,
    description,
    page,
    prioridade,
    title,
    shouldClickOnSendButton = true,
}: {
    page: Page;
    title: string;
    description: string;
    categoria: string;
    prioridade: string;
    anexo?: string;
    shouldClickOnSendButton?: boolean;
}): Promise<void> {
    const {
        createChamadoTitleField,
        createChamadoDescriptionField,
        createChamadoCategoria,
        createChamadoButton,
        createChamadoPrioridade,
    } = getFieldsByKind({
        kind: "createChamado",
        page,
    }).fields;

    await createChamadoTitleField.fill(title);
    await createChamadoDescriptionField.fill(description);
    await createChamadoCategoria.selectOption(categoria);
    await createChamadoPrioridade.selectOption(prioridade);

    if (shouldClickOnSendButton) {
        await createChamadoButton.click();
    }
}
