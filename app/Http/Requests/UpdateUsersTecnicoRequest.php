<?php

namespace App\Http\Requests;

use App\Rules\SafeIntengerRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersTecnicoRequest extends FormRequest
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
            'role_id' => ['nullable', 'sometimes', 'numeric', new SafeIntengerRule, 'exists:roles,id'],
            'is_active' => 'nullable|sometimes|boolean',
        ];
    }
}
