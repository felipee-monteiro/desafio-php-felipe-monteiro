<?php

namespace App\Http\Requests;

use App\Rules\SafeIntengerRule;
use Illuminate\Foundation\Http\FormRequest;

class AlterarStatusChamadoTecnicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isTecnico();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_chamados_id' => ['required', 'numeric', new SafeIntengerRule, 'exists:status_chamados,id'],
        ];
    }
}
