<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViajeRequest extends FormRequest
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
            'numero_bus' => 'required|integer',
            'fecha_viaje' => 'required|date|after:today',
            'hora_viaje' => 'required',
            'hora_llegada' => 'required',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'num_asientos_dispo' => 'required|integer|gte:0',
            'precio' => 'required|numeric|gte:0',
        ];
    }
    public function messages()
    {
        return [
            'numero_bus.required' => 'El campo número de bus es obligatorio.',
            'numero_bus.integer' => 'El campo número de bus debe ser un número entero.',
            'fecha_viaje.required' => 'El campo fecha de viaje es obligatorio.',
            'fecha_viaje.date' => 'El campo fecha de viaje debe ser una fecha válida.',
            'fecha_viaje.after' => 'El campo fecha de viaje debe ser posterior a hoy.',
            'hora_viaje.required' => 'El campo hora de viaje es obligatorio.',
            'hora_llegada.required' => 'El campo hora de llegada es obligatorio.',
            'origen.required' => 'El campo origen es obligatorio.',
            'origen.string' => 'El campo origen debe ser una cadena de texto.',
            'origen.max' => 'El campo origen no puede superar los :max caracteres.',
            'destino.required' => 'El campo destino es obligatorio.',
            'destino.string' => 'El campo destino debe ser una cadena de texto.',
            'destino.max' => 'El campo destino no puede superar los :max caracteres.',
            'num_asientos_dispo.required' => 'El campo número de asientos disponibles es obligatorio.',
            'num_asientos_dispo.integer' => 'El campo número de asientos disponibles debe ser un número entero.',
            'num_asientos_dispo.gte' => 'El campo número de asientos disponibles debe ser mayor que cero.',
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.numeric' => 'El campo precio debe ser un número.',
            'precio.gte' => 'El campo precio debe ser mayor o igual a cero.',
        ];
    }
}
