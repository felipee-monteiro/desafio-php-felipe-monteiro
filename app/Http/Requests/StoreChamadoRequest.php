<?php

namespace App\Http\Requests;

use App\Rules\SafeIntengerRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreChamadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isColaborador();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required',
            'status_chamados_id' => ['required', 'numeric', new SafeIntengerRule, 'exists:status_chamados,id'],
            'categoria_chamado_id' => ['required', 'numeric', new SafeIntengerRule, 'exists:categoria_chamados,id'],
            'prioridade_chamado_id' => 'required|numeric|exists:prioridade_chamados,id',
            'anexo' => 'nullable|file|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'categoria_chamado_id' => "categoria"
        ];
    }
}
