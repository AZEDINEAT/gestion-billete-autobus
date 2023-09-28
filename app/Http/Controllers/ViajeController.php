<?php

namespace App\Http\Controllers;
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

   /*  */

    public function mostrarViajes()
   {
    $viajes = Viaje::all();
    return view('mostrarViajes', compact('viajes'));
   }

   public function eliminar($id)
   {
    $viaje = Viaje::findOrFail($id);
    $viaje->delete();
    session()->flash('mensaje', 'El viaje se ha eliminado correctamente.');
   return redirect('/mostrarViajes');
   }

   public function modificar($id)
   {
    $viaje = Viaje::findOrFail($id);
   return view('viajes' ,compact('viaje'));
   } 

    public function update(Request $request, $id)
    {
        $viaje = Viaje::findOrFail($id);
        $viaje->numero_bus = $request->input('numero_bus');
        $viaje->fecha_viaje = $request->input('fecha_viaje');
        $viaje->hora_viaje = $request->input('hora_viaje');
        $viaje->hora_llegada = $request->input('hora_llegada');
        $viaje->origen = $request->input('origen');
        $viaje->destino = $request->input('destino');
        $viaje->num_asientos_dispo = $request->input('num_asientos_dispo');
        $viaje->precio = $request->input('precio');
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

    public function crearViaje(Request $request)
    {
    $viaje = new Viaje();
    $viaje->numero_bus = $request->input('numero_bus');
    $viaje->fecha_viaje = $request->input('fecha_viaje');
    $viaje->hora_viaje = $request->input('hora_viaje');
    $viaje->hora_llegada = $request->input('hora_llegada');
    $viaje->origen = $request->input('origen');
    $viaje->destino = $request->input('destino');
    $viaje->num_asientos_dispo = $request->input('num_asientos_dispo');
    $viaje->precio = $request->input('precio');

    // Calcular la duración del viaje
    $hora_salida = new DateTime($viaje->hora_viaje);
    $hora_llegada = new DateTime($viaje->hora_llegada);
    $duracion = $hora_salida->diff($hora_llegada);
    $duracion_str = $duracion->format('%H:%I:%S');
    $viaje->duracion = $duracion_str;

    $viaje->save();
    session()->flash('mensaje', 'El viaje se ha creado correctamente.');
    return redirect('/mostrarViajes');
    }


    public function resultado(Request $request)
    {
        $request->validate([
            'origen' => 'required',
            'destino' => 'required',
            'fecha_viaje' => 'required',
        ]);

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

    public function guardarReservacion(Request $request)
    {
            // Validar los datos del formulario
          $request->validate([
                'nombre'=> 'required|string|max:255',
                'DNI' => 'required|string|max:255',
                'correo_electronico' => 'required|email|max:255',
                'direccion' => 'required|string|max:255',
                'ciudad' => 'required|string|max:255',
                'codigo_postal' => 'required|string|max:5',
            ]);

            // Crear una nueva instancia de Reservacion
            $reservacion = new Reservacion([
                'nombre'=> $request->nombre,
                'DNI' => $request->DNI,
                'correo_electronico' => $request->correo_electronico,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'viaje_id' => $request->viaje_id,
            ]);

            // Guardar la reservación en la base de datos
            $reservacion->save();

            $viaje = Viaje::findOrFail($request->viaje_id);

            // Restar 1 al número de asientos disponibles en el viaje
            $viaje->num_asientos_dispo--;
            
            $viaje->save();

            return view('final' ,compact('reservacion'));
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
        return $dompdf->stream($pdfnombre );
    }
   








}
