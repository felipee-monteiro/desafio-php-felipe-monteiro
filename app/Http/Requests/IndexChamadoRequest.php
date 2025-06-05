<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexChamadoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|list<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status'     => 'nullable|sometimes|exists:status_chamados,id',
            'prioridade' => 'nullable|sometimes|exists:prioridade_chamados,id',
        ];
    }
}
