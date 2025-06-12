import test from "./fixtures";
import { createChamado, generateRandomTitle, login } from "./utils";

const { describe, beforeEach, expect } = test;

describe("Create a Chamado", () => {
    beforeEach(async ({ page }) => {
        await page.goto("/");
        await expect(page).toHaveURL("login");

        await login({
            login: "colaborador@mail.com",
            password: "colaborador#engeselt",
            page,
        });

        await expect(page).toHaveURL("chamados");

        await page.getByTestId("createNewChamado").click();
    });

    test("should allow me to create a chamado", async ({ page }) => {
        const title = generateRandomTitle();

        await createChamado({
            page,
            categoria: "2",
            prioridade: "2",
            description: generateRandomTitle(),
            title,
        });

        await expect(page).toHaveURL("chamados");
        await expect(page.getByTestId(title)).toBeVisible();

        await page.getByTestId(`${title}-chamadoDetails`).click();

        await expect(page.getByTestId(`${title}-title`)).toBeVisible();
    });

    test("should not allow me to create the same chamado twice", async ({
        page,
    }) => {
        const title = "testee";

        for (let i = 0; i < 2; i++) {
            await createChamado({
                categoria: "2",
                prioridade: "2",
                description: "teste",
                page,
                title,
            });

            if (i == 1) {
                await expect(page).toHaveURL("chamados/create");
            } else {
                await page.getByTestId("createNewChamado").click();
            }
        }
    });

    test("should not allow me to create a chamado without required fields", async ({
        page,
    }) => {
        const invalidData = ["", " "];

        for (const data of invalidData) {
            await createChamado({
                categoria: "2",
                prioridade: "2",
                page,
                title: data,
                description: data,
            });
            await expect(page).toHaveURL("chamados/create");
        }
    });
});
