<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventFormRequest extends FormRequest
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
            "title" => ["required","min:3"],
            "start" => ["required","date"],
            "end" => ["required","date"],
            "color" => ["required"]
        ];

    }

    public function messages(): array
    {
        return [
            "title.required" => "O título não pode ser vazio",
            "title.min3" => "O título deve ter mais de 3 caracteres",
            "start.required" => "A data de início não pode ser vazia",
            "start.date" => "O campo data de início precisa ser uma data",
            "end.required" => "A data de fim não pode ser vazia",
            "end.date" => "O campo data de fim precisa ser uma data",
            "color.required" => "A cor não pode ser vazia"
        ];
    }
}
