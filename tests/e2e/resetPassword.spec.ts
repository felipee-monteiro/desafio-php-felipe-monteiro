import test from "./fixtures";
import {
    generateRandomEmail,
    invalidEmails as base,
    solicitateToRedefinePassword,
} from "./utils";

const { describe, beforeEach, expect } = test;

describe("Reset Password Flow", function () {
    beforeEach(async ({ page }) => {
        await page.goto("/", { timeout: 10000 });
        await expect(page).toHaveURL("login", { timeout: 10000 });
        await page.getByTestId("resetPassLink").click();
        await expect(page).toHaveURL("forgot-password");
    });

    test("should not allow me to recover password with invalid emails", async function ({
        page,
    }) {
        const invalidEmails = [...base, generateRandomEmail()];

        for (const email of invalidEmails) {
            await solicitateToRedefinePassword({
                email,
                page,
            });
        }

        await expect(
            page.getByTestId("resetPasswordEmailField-error"),
        ).toBeVisible();
    });

    test("should allow me to recover a password with a valid email", async ({
        page,
    }) => {
        await solicitateToRedefinePassword({
            email: "colaborador@mail.com",
            page,
        });

        await expect(
            page.getByTestId("resetPasswormEmailField-success"),
        ).toBeVisible();
    });

    test("should not allow me to recover a pass with the same email more than once (ratelimiting)", async ({
        page,
    }) => {
        for (let i = 0; i < 3; i++) {
            await solicitateToRedefinePassword({
                email: "colaborador@mail.com",
                page,
            });
        }

        await expect(
            page.getByTestId("resetPasswordEmailField-error"),
        ).toBeVisible();
    });
});
