<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "editTitle" => ["required","min:3"],
            "editStart" => ["required","date"],
            "editEnd" => ["required","date"],
            "editColor" => ["required"]
        ];
    }

    public function messages(): array
    {
        return [
            "editTitle.required" => "O título não pode ser vazio",
            "editTitle.min3" => "O título deve ter mais de 3 caracteres",
            "editStart.required" => "A data de início não pode ser vazia",
            "editStart.date" => "O campo data de início precisa ser uma data",
            "editEnd.required" => "A data de fim não pode ser vazia",
            "editEnd.date" => "O campo data de fim precisa ser uma data",
            "editColor.required" => "A cor não pode ser vazia"
        ];
    }
}
