<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'DNI' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'codigo_postal' => 'required|integer|gt:0',
        ];

    }
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede superar los :max caracteres.',
            'DNI.required' => 'El campo DNI es obligatorio.',
            'DNI.string' => 'El campo DNI debe ser una cadena de texto.',
            'DNI.max' => 'El campo DNI no puede superar los :max caracteres.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'correo_electronico.max' => 'El campo correo electrónico no puede superar los :max caracteres.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo dirección no puede superar los :max caracteres.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'ciudad.string' => 'El campo ciudad debe ser una cadena de texto.',
            'ciudad.max' => 'El campo ciudad no puede superar los :max caracteres.',
            'codigo_postal.required' => 'El campo código postal es obligatorio.',
            'codigo_postal.integer' => 'El campo código postal debe ser un número entero.',
            'codigo_postal.gt' => 'El campo código postal debe ser mayor que cero.',
        ];
    }
}
