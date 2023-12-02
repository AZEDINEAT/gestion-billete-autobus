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
    public function show()
    {
        $origenes = Viaje::select('origen')->distinct()->get();
        $destinos = Viaje::select('destino')->distinct()->get();
        return view('firstp', compact('origenes', 'destinos'));
    }

    public function mostrarViajes()
    {
        $viajes = Viaje::all();
        return view('mostrarViajes', compact('viajes'));
    }

    public function eliminar($id)
    {
        $viaje = Viaje::findOrFail($id);
        $reservas = Reservacion::where('viaje_id', '=', $id);
        $reservas->delete();
        $viaje->delete();
        session()->flash('mensaje', 'El viaje se ha eliminado correctamente.');
        return redirect('/mostrarViajes');
    }

    public function modificar($id)
    {
        $viaje = Viaje::findOrFail($id);
        return view('viajes', compact('viaje'));
    }
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


    public function detalle($id)
    {
        $viaje = Viaje::find($id);
        return $viaje;
    }

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

    public function profil(Request $request)
    {
        $viaje_id = $request->id;
        return view('profil', compact('viaje_id'));
    }
    public function descargarPDF($id)
    {
        $reservacion = Reservacion::find($id);
        $html = view('pdf', compact('reservacion'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfnombre = 'ticket-' . $reservacion->nombre . '.pdf';
        return $dompdf->stream($pdfnombre);
    }

    public function guardarReservacion(ReservaRequest $request)
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
        return view('final', compact('reservacion'));
    }



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


    public function showReserva(Request $req)
    {
        $param1 = $req->input('param1');
        $param2 = $req->input('param2');
        $perfil = Reservacion::where('id', '=', $param1)
            ->where('viaje_id', '=', $param2)
            ->first();
        return $perfil;
    }

    public function eliminarReserva($id, $Viaje_id)
    {
        $perfil = Reservacion::where('id', '=', $id)
            ->where('viaje_id', '=', $Viaje_id)
            ->first();
        $perfil->delete();
        return redirect('/mostrarReservas/' . $Viaje_id);

    }
    public function modificarReserva(ReservaRequest $request)
    {
        //añadir validacion para id
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
            session()->flash('error', 'la reservacion no existe.');
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
        session()->flash('error', 'La reservacion se ha actualizado correctamente.');
        return redirect('/mostrarReservas/' . $request->input('viaje_id'));

    }



}
