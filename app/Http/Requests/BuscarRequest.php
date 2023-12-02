<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarRequest extends FormRequest
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
            'origen' => 'required',
            'destino' => 'required',
            'fecha_viaje' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'origen.required' => 'El campo Origen es obligatorio.',
            'destino.required' => 'El campo Destino es obligatorio.',
            'fecha_viaje.required' => 'El campo Fecha de Viaje es obligatorio.',
        ];
    }
}
