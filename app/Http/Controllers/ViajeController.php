<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuscarRequest;
use App\Http\Requests\ViajeRequest;
use App\Http\Requests\ReservaRequest;
use App\Models\Viaje;
use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Dompdf\Dompdf;
use DateTime;

class ViajeController extends Controller
{
    // recuperar lista de origenes y detsinos y pasarla al pagina de busqueda.
    public function show()
    {
        $origenes = Viaje::select('origen')->distinct()->get();
        $destinos = Viaje::select('destino')->distinct()->get();
        return view('firstp', compact('origenes', 'destinos'));
    }

    // mostrar los resultados de viajes tras una busqueda exitosa .
    public function resultado(BuscarRequest $request)
    {
        $origenSeleccionado = $request->input('origen');
        $destinoSeleccionado = $request->input('destino');
        $fechaSeleccionada = $request->input('fecha_viaje');

        $viajes = Viaje::where('origen', '=', $origenSeleccionado)
            ->where('destino', '=', $destinoSeleccionado)
            ->where('fecha_viaje', '>=', $fechaSeleccionada)
            ->orderBy('fecha_viaje')
            ->orderBy('hora_viaje')
            ->get();

        if ($viajes->isEmpty()) {
            session()->flash('error', 'No hay viajes disponibles para la fecha seleccionada.');
            return redirect()->route('home');
        }

        session()->forget('error');
        return view('resultado', compact('viajes'));
    }

    // mostrar la vista de formPersonal y pasarla el viaje_id como parametro.
    public function formPersonal(Request $request)
    {
        $viaje_id = $request->id;
        return view('formPersonal', compact('viaje_id'));
    }

    //  completar la reservacion y mostrar informaciones del billete .
    public function billete(ReservaRequest $request)
    {
        //verificar si hay diponibidad
        $viaje = Viaje::findOrFail($request->viaje_id);
        if ($viaje->num_asientos <= 0) {
            session()->flash('error', 'No hay disponibilidad para este viaje.');
            return redirect()->route('home');
        }
        // Restar 1 al número de asientos disponibles en el viaje
        $viaje->num_asientos--;

        $viaje->save();

        // Crear una nueva instancia de Reservacion
        $reservacion = new Reservacion([
            'nombre' => $request->nombre,
            'DNI' => $request->DNI,
            'correo_electronico' => $request->correo_electronico,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'codigo_postal' => $request->codigo_postal,
            'viaje_id' => $request->viaje_id,
        ]);

        // Guardar la reservación en la base de datos
        $reservacion->save();
        return view('billete', compact('reservacion'));
    }

    // mostrar el billette en pdf 
    public function descargarPDF($id)
    {
        $reservacion = Reservacion::find($id);
        $html = view('pdfBillete', compact('reservacion'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfnombre = 'billete-' . $reservacion->nombre . '.pdf';
        return $dompdf->stream($pdfnombre);
    }

    //  mostrar los viajes que existen
    public function mostrarViajes()
    {
        $viajes = Viaje::all();
        return view('mostrarViajes', compact('viajes'));
    }

    // obtenir informaciones del viaje para el modal
    public function detalle($id)
    {
        $viaje = Viaje::find($id);
        return $viaje;
    }

    //  mostrar la pagina de modificacion de viaje 
    public function modificar($id)
    {
        $viaje = Viaje::findOrFail($id);
        return view('viajes', compact('viaje'));
    }

    // modificar el viaje 
    public function update(ViajeRequest $request, $id)
    {
        $viaje = Viaje::findOrFail($id);
        $viaje->numero_bus = $request->input('numero_bus');
        $viaje->fecha_viaje = $request->input('fecha_viaje');
        $viaje->hora_viaje = $request->input('hora_viaje');
        $viaje->hora_llegada = $request->input('hora_llegada');
        $viaje->origen = $request->input('origen');
        $viaje->destino = $request->input('destino');
        $viaje->num_asientos = $request->input('num_asientos_dispo');
        $viaje->precio = $request->input('precio');
        // Calcular la duración del viaje
        $hora_salida = new DateTime($viaje->hora_viaje);
        $hora_llegada = new DateTime($viaje->hora_llegada);
        if ($hora_llegada < $hora_salida) {
            $hora_llegada->modify('+1 day'); // Ajustar la fecha de llegada al día siguiente
        }
        $duracion = $hora_salida->diff($hora_llegada);

        $duracion_str = $duracion->format('%H:%I:%S');
        $viaje->duracion = $duracion_str;
        $viaje->save();

        session()->flash('mensaje', 'El viaje se ha modificado correctamente.');

        return redirect('/mostrarViajes');
    }

    // eliminar viaje 
    public function eliminar($id)
    {
        $viaje = Viaje::findOrFail($id);
        $reservas = Reservacion::where('viaje_id', '=', $id);
        $reservas->delete();
        $viaje->delete();
        session()->flash('mensaje', 'El viaje se ha eliminado correctamente.');
        return redirect('/mostrarViajes');
    }

    // crear un nuevo viaje
    public function crearViaje(ViajeRequest $request)
    {
        $viaje = new Viaje();
        $viaje->numero_bus = $request->input('numero_bus');
        $viaje->fecha_viaje = $request->input('fecha_viaje');
        $viaje->hora_viaje = $request->input('hora_viaje');
        $viaje->hora_llegada = $request->input('hora_llegada');
        $viaje->origen = $request->input('origen');
        $viaje->destino = $request->input('destino');
        $viaje->num_asientos = $request->input('num_asientos_dispo');
        $viaje->precio = $request->input('precio');

        // Calcular la duración del viaje
        $hora_salida = new DateTime($viaje->hora_viaje);
        $hora_llegada = new DateTime($viaje->hora_llegada);
        if ($hora_llegada < $hora_salida) {
            $hora_llegada->modify('+1 day'); // Ajustar la fecha de llegada al día siguiente
        }
        $duracion = $hora_salida->diff($hora_llegada);

        $duracion_str = $duracion->format('%H:%I:%S');
        $viaje->duracion = $duracion_str;

        $viaje->save();
        session()->flash('mensaje', 'El viaje se ha creado correctamente.');
        return redirect('/mostrarViajes');
    }

    // mostrar reservas de un viaje específico
    public function mostrarResarva($id)
    {
        $reserva = Reservacion::where('viaje_id', '=', $id)
            ->orderBy('id')
            ->get();
        if ($reserva->isEmpty()) {
            // No hay reservas para este viaje, mostrar una alerta
            session()->flash('reservas', 'No hay reservacion en este viaje.');

            return redirect('/mostrarViajes');
        }
        return view('mostrarReservas', compact('reserva'));
    }

    // eliminar una reserva
    public function eliminarReserva($id, $Viaje_id)
    {
        $perfil = Reservacion::where('id', '=', $id)
            ->where('viaje_id', '=', $Viaje_id)
            ->first();
        $perfil->delete();
        session()->flash('mensaje', 'la reservacion eliminada correctamente.');
        return redirect('/mostrarReservas/' . $Viaje_id);
    }

    // obtenir detalle de una reserva.
    public function showReserva(Request $req)
    {
        $param1 = $req->input('param1');
        $param2 = $req->input('param2');
        $perfil = Reservacion::where('id', '=', $param1)
            ->where('viaje_id', '=', $param2)
            ->first();
        return $perfil;
    }

    // modificar informaciones de una reserva
    public function modificarReserva(ReservaRequest $request)
    {
        //  añadir validacion para id
        $request->validate([
            'id' => 'required',
        ], [
            'id.required' => 'El campo ID es obligatorio.',
        ]);

        //buscar la reservacion con id
        $perfil = Reservacion::where('id', '=', $request->input('id'))
            ->where('viaje_id', '=', $request->input('viaje_id'))
            ->first();
        if ($perfil == null) {
            session()->flash('mensaje', 'la reservacion no existe.');
            return redirect('/mostrarReservas/' . $request->input('viaje_id'));
        }
        // Crear una nueva instancia de Reservacion
        $perfil->nombre = $request->input('nombre');
        $perfil->DNI = $request->input('DNI');
        $perfil->correo_electronico = $request->input('correo_electronico');
        $perfil->direccion = $request->input('direccion');
        $perfil->ciudad = $request->input('ciudad');
        $perfil->codigo_postal = $request->input('codigo_postal');

        // Guardar la reservación en la base de datos
        $perfil->save();
        session()->flash('mensaje', 'La reservacion se ha actualizado correctamente.');
        return redirect('/mostrarReservas/' . $request->input('viaje_id'));

    }

    // obtenir informaciones de billete con dni
    public function confirmacion($dni)
    {
        $reservacion = Reservacion::where('DNI', $dni)->first();
        $viaje = Viaje::find($reservacion->viaje_id);
        // metemos viaje y resevacion en una tabla
        $informaciones = [
            'reservacion' => $reservacion,
            'viaje' => $viaje,
        ];
        return $informaciones;
    }

}
