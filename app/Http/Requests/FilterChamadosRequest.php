<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\SafeIntengerRule;
use Illuminate\Foundation\Http\FormRequest;

final class FilterChamadosRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|list<mixed>|string>
     */
    public function rules(): array
    {
        $crudFieldNameArrayRule = 'required';

        return [
            'format'                 => 'required|string|in:pdf,excel,csv',
            'data'                   => 'required',
            'data.*.id'              => ['required', 'numeric', new SafeIntengerRule()],
            'data.*.titulo'          => 'required|string',
            'data.*.descricao'       => 'required|string',
            'data.*.categoria'       => $crudFieldNameArrayRule,
            'data.*.prioridade'      => $crudFieldNameArrayRule,
            'data.*.status'          => $crudFieldNameArrayRule,
            'data.*.categoria.name'  => 'required|string',
            'data.*.status.name'     => 'required|string',
            'data.*.prioridade.name' => 'required|string',
        ];
    }
}
