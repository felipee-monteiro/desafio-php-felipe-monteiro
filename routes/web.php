<?php

declare(strict_types=1);

use App\Factories\Document\ConcreteCreator\CsvChamadoCreator;
use App\Factories\Document\ConcreteCreator\ExcelChamadoCreator;
use App\Factories\Document\ConcreteCreator\PDFChamadoCreator;
use App\Http\Controllers\CategoriaChamadoController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\PrioridadeChamadoController;
use App\Http\Controllers\StatusChamadoController;
use App\Http\Controllers\Tecnico\ChamadoTecnicoController;
use App\Http\Controllers\UsersTecnicoController;
use App\Http\Requests\FilterChamadosRequest;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', static function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => \PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(static function (): void {
    Route::get('/dashboard', static function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/', static function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified', 'can:isActive'])->group(static function (): void {
    Route::get('/dashboard', static function () {
        if (auth()->user()->isTecnico()) {
            return redirect()->route('tecnico.chamados.index');
        }

        return redirect()->route('chamados.index');
    })->name('dashboard');

    function registerExportRoute(string $path = '/colaborador/chamados/export'): void
    {
        Route::post($path, static function (FilterChamadosRequest $request) {
            $chamados = $request->input('data');
            $format   = $request->input('format');

            $document = match ($format) {
                'pdf' => [
                    'class' => new pdfchamadocreator(),
                    'mime'  => 'application/pdf',
                ],
                'excel' => [
                    'class' => new excelchamadocreator(),
                    'mime'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ],
                'csv' => [
                    'class' => new CsvChamadoCreator(),
                    'mime'  => 'text/csv',
                ],
                default => throw new \RuntimeException('Formato não reconhecido'),
            };

            $fileProcessor = $document['class']->createDocument();
            $rawFile       = $fileProcessor->process(\compact('chamados'));

            $componentProps = [
                'rawFile'      => \base64_encode($rawFile),
                'fileMimeType' => $document['mime'],
            ];

            return Inertia::render('FilePreview', $componentProps);
        });
    }

    /**
     * Rotas do COLABORADOR.
     */
    Route::middleware(['can:isColaborador'])->group(static function (): void {
        Route::resources([
            'chamados' => ChamadoController::class,
        ]);
        registerExportRoute();
    });

    /**
     * Rotas do TÉCNICO.
     */
    Route::prefix('tecnico')->name('tecnico.')->middleware(['can:isTecnico'])->group(static function (): void {
        Route::get('chamados', [ChamadoTecnicoController::class, 'index'])->name('chamados.index');
        Route::get('chamados/{chamado}', [ChamadoTecnicoController::class, 'show'])->name('chamados.show');
        Route::post('chamados/{chamado}/resposta', [ChamadoTecnicoController::class, 'responder'])->name('chamados.responder');
        Route::patch('chamados/{chamado}/status', [ChamadoTecnicoController::class, 'alterarStatus'])->name('chamados.status');

        registerExportRoute('/chamados/export');

        Route::resources([
            'categorias'                  => CategoriaChamadoController::class,
            'users'                       => UsersTecnicoController::class,
            'chamados/status/manage'      => StatusChamadoController::class,
            'chamados/prioridades/manage' => PrioridadeChamadoController::class,
        ]);
    });
});
