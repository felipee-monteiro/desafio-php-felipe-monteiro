<?php

namespace App\Http\Requests;

use App\Rules\SafeIntengerRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterChamadosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isTecnicoOrColaborador();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'format' => 'required|string|in:pdf,excel,csv',
            // 'data' => 'required|array:id,created_at,updated_at,titulo,descricao,categoria,prioridade,status',
            // 'data.*.id' => ['required', 'numeric', new SafeIntengerRule, 'exists:chamados,id'],
            // 'data.*.titulo' => 'required|string|exists:chamados,titulo',
            // 'data.*.descricao' => 'required|string|exists:chamados,descricao',
            // 'data.*.categoria' => 'array:name',
            // 'data.*.prioridade' => 'array:name',
            // 'data.*.status' => 'array:name',
            // 'data.*.categoria.name' => 'required|string|exists:categoria_chamados,name',
            // 'data.*.status.name' => 'required|string|exists:status_chamados,name',
            // 'data.*.prioridade.name' => 'required|string|exists:prioridade_chamados,name',
        ];
    }
}
