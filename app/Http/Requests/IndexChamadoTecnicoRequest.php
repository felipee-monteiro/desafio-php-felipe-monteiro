<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexChamadoTecnicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user->isTecnico() || $user->isColaborador();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $status =  [
            'Aberto',
            'Em atendimento',
            'Resolvido',
            'Fechado'
        ];

        $prioridades = [
            'Baixa',
            'Média',
            'Alta'
        ];

        return [
            'status' => 'nullable|sometimes|in:' . \implode(",", $status),
            'prioridade' => 'nullable|sometimes|in:' . \implode(",", $prioridades),
        ];
    }
}
