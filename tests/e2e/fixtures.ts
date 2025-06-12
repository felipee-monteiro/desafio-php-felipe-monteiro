import { test as base } from "@playwright/test";
import { FieldsTest, getFieldsByKind } from "./utils";

const test = base.extend<{
    loginFields: FieldsTest;
    resetPasswordFields: FieldsTest;
    createChamadosFields: FieldsTest;
}>({
    loginFields: async ({ page }, use) => {
        await use(getFieldsByKind({ kind: "login", page }));
    },
    resetPasswordFields: async ({ page }, use) => {
        await use(
            getFieldsByKind({
                kind: "resetPassword",
                page,
            }),
        );
    },
    createChamadosFields: async ({ page }, use) => {
        await use(
            getFieldsByKind({
                page,
                kind: "createChamado",
            }),
        );
    },
});

export default test;
