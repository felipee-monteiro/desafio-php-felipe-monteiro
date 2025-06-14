<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class PriorityCRUDTest extends TestCase
{
    use RefreshDatabase;
    public string $routePrefix = 'tecnico/chamados';

    public static function getInvalidNamesProvider(): array
    {
        return [
            [''],
            [' '],
            ['
                Quis voluptate enim enim et eiusmod et ullamco ipsum. Reprehenderit fugiat ex cupidatat cillum occaecat adipisicing cupidatat commodo id dolore laborum. Irure sunt in minim esse ullamco officia anim aliquip culpa velit tempor. Non aliquip consequat laborum dolore aliquip eiusmod minim do proident elit laborum consequat.

                Quis dolore magna proident laborum anim officia aliqua aute cillum. Dolor exercitation laborum nulla tempor aute mollit ut enim culpa. Duis incididunt cupidatat ipsum officia ea non officia tempor nostrud proident. Lorem do culpa eiusmod laboris tempor commodo aliqua voluptate aute id et. Aliqua amet occaecat eiusmod ad consectetur non eiusmod duis sit reprehenderit aliquip consectetur. Sunt enim dolor fugiat minim id voluptate.

                Deserunt magna fugiat Lorem non deserunt dolore aliquip laboris pariatur ex dolor consectetur deserunt pariatur. Aute qui et fugiat fugiat laborum elit aliquip minim officia. Sint commodo magna aliquip ut officia velit adipisicing eiusmod.

                Culpa et qui ad excepteur minim aliquip ullamco do tempor mollit sint. Id et est anim culpa elit nisi aute incididunt minim. Eu elit dolore enim aliquip dolore ullamco laborum adipisicing. Elit proident id non mollit cupidatat quis reprehenderit ad consequat tempor nostrud est.

                Esse fugiat ex laboris culpa exercitation eu sunt do sit nostrud ipsum. Lorem in sit fugiat non excepteur fugiat ullamco tempor labore laboris. Adipisicing laboris quis anim magna id non qui aliqua minim sit ullamco esse in quis. Eu proident ea consequat id qui Lorem eiusmod enim duis laboris pariatur. Tempor sint occaecat aliqua ullamco amet laboris ad labore laboris. Aute sunt incididunt sunt velit eu magna aliqua exercitation.

                Duis ipsum irure sit consectetur tempor commodo velit ut do cillum non non fugiat anim. Lorem mollit excepteur irure nisi minim voluptate dolor amet laborum deserunt. Esse ipsum tempor duis fugiat labore mollit enim nulla labore veniam.Eiusmod Lorem culpa ea commodo enim et ullamco deserunt nisi. Dolor tempor aliquip anim cupidatat consectetur eiusmod laborum dolore amet nostrud nostrud deserunt et. Enim do dolore amet laborum consectetur. Commodo id nisi tempor officia sunt veniam cupidatat dolore occaecat quis irure sunt ut. Anim do proident sunt amet laboris aliqua duis velit ullamco enim anim consectetur mollit. Eu irure tempor consequat laboris ipsum incididunt. Ut duis culpa eu et labore minim nostrud ea esse incididunt pariatur adipisicing esse laboris.

                Adipisicing duis ut eiusmod velit sint ut incididunt elit cillum ad laboris. Anim nostrud culpa velit velit non sunt pariatur cillum dolore adipisicing sint velit. Sit incididunt elit aute incididunt cillum nisi adipisicing laboris pariatur sint dolor cupidatat incididunt. Ex sint id minim sint ex. Excepteur nulla et velit non. Voluptate pariatur dolor dolor minim pariatur aute commodo eiusmod reprehenderit proident. Exercitation minim do culpa nulla non mollit in.

                Ullamco quis cillum occaecat fugiat officia tempor enim est Lorem incididunt aliqua. Duis aute do enim irure officia. Ad amet amet ut velit sunt elit nulla enim nulla ad. Nulla anim do ullamco tempor sit reprehenderit qui consectetur laborum Lorem elit cupidatat dolore ad. Laborum dolor consectetur in consectetur ad amet. Aliqua nisi in fugiat aliqua veniam deserunt exercitation cupidatat reprehenderit consequat sunt. Et cillum incididunt qui culpa.

                Velit cillum eu sunt et. Cupidatat ex fugiat labore amet consequat et magna sit quis in ea aute dolore. Et velit irure occaecat amet esse. Cupidatat eiusmod pariatur aute excepteur commodo occaecat voluptate consectetur pariatur officia.

                Culpa nulla officia pariatur adipisicing sunt qui anim. Officia consectetur sunt eiusmod Lorem anim velit nulla ullamco dolore. Voluptate voluptate ut esse non eu et non enim eiusmod officia eu pariatur incididunt nostrud. Minim voluptate incididunt sint sit labore. Dolore qui sunt deserunt anim in officia ullamco sunt commodo. Enim deserunt laborum consectetur do culpa qui nostrud labore. Aliquip laboris qui excepteur et irure laborum nisi ullamco id ex commodo do.

                Nulla cillum ullamco nisi aliqua est enim sint ipsum adipisicing id cupidatat voluptate nostrud. Officia nisi aliqua Lorem mollit non nulla est est ipsum aliquip voluptate cupidatat anim tempor. Aute eiusmod fugiat quis eu sint occaecat exercitation. Veniam exercitation cupidatat exercitation ut nulla consequat incididunt ullamco duis elit velit sint adipisicing ipsum. Ad sint Lorem esse sint minim. Ea fugiat ipsum incididunt nisi amet veniam velit.

                Nulla duis amet quis mollit nostrud ex laboris ut ullamco dolor. Eiusmod in pariatur consequat nulla exercitation occaecat magna est quis magna non. Ut ipsum cillum deserunt labore adipisicing do et est cillum cupidatat eiusmod culpa ullamco. Culpa amet amet ex eiusmod.

                Excepteur incididunt fugiat culpa occaecat consequat laboris aliqua. Cillum ea laborum officia nisi et est cupidatat dolore consectetur est commodo et ex. Labore magna ullamco adipisicing commodo id enim qui est est reprehenderit aliquip nostrud cupidatat. Eiusmod fugiat do proident ipsum occaecat culpa. Pariatur veniam proident labore commodo dolor ipsum voluptate culpa anim deserunt Lorem amet velit. Eu enim dolore eiusmod adipisicing dolore magna cillum ea occaecat commodo reprehenderit laboris pariatur tempor.

                Nisi ut ut nostrud sunt veniam velit in dolore deserunt aliqua laboris. Commodo do sunt eu eiusmod ex aute consectetur dolor laboris commodo nulla aliquip non. Et culpa pariatur magna ea voluptate deserunt minim magna duis amet Lorem officia fugiat nisi. Labore tempor fugiat enim enim aute aliquip commodo exercitation consectetur non velit adipisicing do aliqua.

                Lorem tempor veniam nostrud fugiat labore dolor exercitation fugiat esse enim non cillum duis officia. Officia exercitation elit reprehenderit sunt nisi Lorem esse in pariatur irure ut est qui. Culpa aliqua fugiat ea laboris. Labore ullamco ipsum culpa voluptate ad fugiat velit.
            '],
        ];
    }

    public static function getInvalidPrioritiesIdsProvider(): array
    {
        return [
            [0],
            [\PHP_INT_MAX + 12],
            [\PHP_INT_MAX],
            [\PHP_FLOAT_MAX],
            [\PHP_FLOAT_MAX + 12],
        ];
    }

    public static function getProtectedRoutesProvider(): array
    {
        return [
            [[
                'route'  => 'prioridades/manage',
                'method' => 'post',
                'data'   => [
                    'name' => 'test',
                ],
                'status' => 302,
            ]],
            [[
                'route'  => 'prioridades/manage',
                'method' => 'get',
                'data'   => [],
            ]],
            [[
                'route'  => 'prioridades/manage/1',
                'method' => 'put',
                'data'   => [
                    'name' => 'test_updating',
                ],
                'status' => 302,
            ]],
            [[
                'route'  => 'prioridades/manage/1',
                'method' => 'delete',
                'data'   => [],
                'status' => 302,
            ]],
        ];
    }

    #[DataProvider('getProtectedRoutesProvider')]
    public function testShouldNotAllowMeToAccessRoutesWithColaboratorRole(array $routeMetadata): void
    {
        \extract($routeMetadata);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->{$method}($this->routePrefix . "/{$route}");

        $response->assertForbidden();
    }

    #[DataProvider('getInvalidNamesProvider')]
    public function testShouldNotAllowMeToCreateAPriorityWithInvalidNames(string $name): void
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post($this->routePrefix . '/prioridades/manage', [
            'name' => $name,
        ]);

        $response->assertSessionHasErrors();
    }

    public function testShouldAllowMeToDeleteAPriorityWithInvalidNames(): void
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->delete($this->routePrefix . '/prioridades/manage/1');

        $response->assertSessionHasNoErrors();
    }

    #[DataProvider('getInvalidNamesProvider')]
    public function testShouldNotAllowMeToUpdateAPriorityWithInvalidNames(string $name): void
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $methods = ['put', 'patch'];

        foreach ($methods as $method) {
            $response = $this->actingAs($user)->{$method}($this->routePrefix . '/prioridades/manage/1', [
                'name' => $name,
            ]);

            $response->assertSessionHasErrors();
        }
    }

    #[DataProvider('getInvalidPrioritiesIdsProvider')]
    public function testShouldNotAllowMeToDeleteAPriorityWithInvalidNames(float|int $id): void
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $methods = ['put', 'patch', 'delete'];

        foreach ($methods as $method) {
            $response = $this->actingAs($user)->{$method}($this->routePrefix . "/prioridades/manage/{$id}", [
                'name' => 'invalid',
            ]);

            $response->assertSessionHasErrors();
        }
    }

    #[DataProvider('getProtectedRoutesProvider')]
    public function testShouldDoAllCRUDActions(array $routeMetadata): void
    {
        $method = $routeMetadata['method'] ?? 'get';
        $route  = $routeMetadata['route'] ?? '/';
        $data   = $routeMetadata['data'] ?? [];
        $status = $routeMetadata['status'] ?? 200;

        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->{$method}($this->routePrefix . "/{$route}", $data);

        $response->assertSessionHasNoErrors();
        $response->assertStatus($status);
    }
}
