<?php

namespace Database\Seeders;

use App\Models\Chamado;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChamadoSeeder extends Seeder
{
    public function run(): void
    {
        $colaborador = User::where('role_id', 1)->first();

        $chamados = [
            [
                'titulo' => 'Problema com internet',
                'descricao' => 'Sem acesso à internet no setor de TI.',
                'categoria_chamado_id' => 1,
                'prioridade' => 3,
            ],
            [
                'titulo' => 'Lâmpada queimada',
                'descricao' => 'Lâmpada do corredor principal está queimada.',
                'categoria_chamado_id' => 2,
                'prioridade' => 2,
            ],
            [
                'titulo' => 'Erro no sistema de ponto',
                'descricao' => 'Sistema de registro de ponto não está funcionando.',
                'categoria_chamado_id' => 1,
                'prioridade' => 3,
            ],
            [
                'titulo' => 'Solicitação de cadeira ergonômica',
                'descricao' => 'Solicitação de troca por cadeira ergonômica.',
                'categoria_chamado_id' => 3,
                'prioridade' => 1,
            ],
            [
                'titulo' => 'Impressora com atolamento',
                'descricao' => 'Impressora da recepção está com papel atolado.',
                'categoria_chamado_id' => 1,
                'prioridade' => 2,
            ],
        ];

        foreach ($chamados as $chamado) {
            Chamado::firstOrCreate(
                ['titulo' => $chamado['titulo']],
                [
                    'descricao' => $chamado['descricao'],
                    'categoria_chamado_id' => $chamado['categoria_chamado_id'],
                    'prioridade_chamado_id' => $chamado['prioridade'],
                    'status_chamados_id' => 1,
                    'user_id' => $colaborador->id,
                ]
            );
        }
    }
}
