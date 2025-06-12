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

        page.getByTestId("createNewChamado").click();
    });

    test("should be able to me create a chamado", async ({ page }) => {
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
});
