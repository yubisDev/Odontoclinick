<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Horario;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /**
     * Muestra una lista de citas, aplicando filtros de búsqueda si se proporcionan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Inicia la consulta base para las citas, cargando las relaciones de paciente y medico.
        $citas = Cita::with(['paciente', 'medico']);

        // ---- Lógica de Filtros Multicriterio ----

        // 1. Filtro por Paciente: Busca en la relación 'paciente'.
        // 'whereHas' nos permite filtrar citas basadas en la existencia de una relación.
        if ($request->filled('paciente')) {
            $citas->whereHas('paciente', function($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->input('paciente') . '%')
                      ->orWhere('apellidos', 'like', '%' . $request->input('paciente') . '%');
            });
        }

        // 2. Filtro por Doctor: Similar al filtro de paciente, busca en la relación 'medico'.
        if ($request->filled('medico')) {
            $citas->whereHas('medico', function($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->input('medico') . '%')
                      ->orWhere('apellidos', 'like', '%' . $request->input('medico') . '%');
            });
        }

        // 3. Filtro por Estado de la Cita.
        if ($request->filled('estado')) {
            $citas->where('estado', $request->input('estado'));
        }

        // Ordena los resultados por fecha y hora de forma ascendente.
        $citas = $citas->orderBy('fecha_horario', 'asc')->get();
        
        // Cargamos todas los pacientes y médicos activos para la funcionalidad del datalist en la vista
        $pacientes = Paciente::where('estado', 'activo')->get();
        $medicos = Medico::where('estado', 'activo')->get();

        // Pasa los resultados (filtrados o no) y las listas de pacientes/médicos a la vista.
        return view('citas.index', compact('citas', 'pacientes', 'medicos'));
    }

    public function create()
    {
        // La secretaria necesita ver todos los pacientes activos para crear una cita para ellos.
        $pacientes = Paciente::where('estado', 'activo')->get();
        $medicos = Medico::where('estado', 'activo')->get();

        return view('citas.create', compact('pacientes', 'medicos'));
    }

    /**
     * Muestra el formulario para agendar una cita desde la perspectiva del paciente.
     *
     * @return \Illuminate\View\View
     */
    public function agendar()
    {
        $medicos = Medico::where('estado', 'activo')->get();
        return view('pacientes.agendar', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required|integer',
            'id_doctor' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|string|max:50',
            'notas' => 'nullable|string',
        ]);

        // Combina la fecha y la hora en un único objeto Carbon (datetime)
        $fechaHora = Carbon::parse($request->fecha . ' ' . $request->hora);

        // Verifica si la fecha es en el pasado
        if ($fechaHora->lt(Carbon::now())) {
            return back()->withErrors(['fecha' => 'No se puede agendar una cita en el pasado.'])->withInput();
        }

        // Verifica si el doctor ya tiene una cita agendada en la misma fecha y hora
        $existeCita = Cita::where('id_doctor', $request->id_doctor)
                         ->where('fecha_horario', $fechaHora)
                         ->exists();

        if ($existeCita) {
            return back()->withErrors(['fecha' => 'El doctor ya tiene una cita en esa fecha y hora.'])->withInput();
        }

        Cita::create([
            'id_paciente' => $request->id_paciente,
            'id_doctor' => $request->id_doctor,
            'fecha_horario' => $fechaHora, // Asigna el valor combinado
            'estado' => $request->estado,
            'notas' => $request->notas,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente.');
    }
    
    /**
     * Almacena una nueva cita agendada por el paciente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromPaciente(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required|integer',
            'id_doctor' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'notas' => 'nullable|string',
        ]);

        // Combina la fecha y la hora en un único objeto Carbon (datetime)
        $fechaHora = Carbon::parse($request->fecha . ' ' . $request->hora);

        // Verifica si la fecha es en el pasado
        if ($fechaHora->lt(Carbon::now())) {
            return back()->withErrors(['fecha' => 'No se puede agendar una cita en el pasado.'])->withInput();
        }

        // Verifica si el doctor ya tiene una cita agendada en la misma fecha y hora
        $existeCita = Cita::where('id_doctor', $request->id_doctor)
                         ->where('fecha_horario', $fechaHora)
                         ->exists();

        if ($existeCita) {
            return back()->withErrors(['fecha' => 'El doctor ya tiene una cita en esa fecha y hora.'])->withInput();
        }

        Cita::create([
            'id_paciente' => $request->id_paciente,
            'id_doctor' => $request->id_doctor,
            'fecha_horario' => $fechaHora, // Asigna el valor combinado
            'estado' => 'pendiente', // Por defecto, una cita agendada por el paciente es pendiente de confirmación
            'notas' => $request->notas,
        ]);

        // Aquí deberías redirigir al paciente a su vista de citas
        return redirect()->route('pacientes.citas')->with('success', 'Cita agendada correctamente. La confirmación será enviada en breve.');
    }
    
    /**
     * Muestra una lista de citas para el paciente autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function misCitas()
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();
        $citas = collect(); // Colección vacía por defecto
        $paciente = null; // Paciente nulo por defecto
        $mensaje_error = null;

        // Si el usuario no está autenticado, muestra un mensaje
        if (!$user) {
            $mensaje_error = 'Debes iniciar sesión para ver tus citas.';
        } else {
            // Busca el paciente asociado al usuario
            $paciente = Paciente::where('id_usuario', $user->id_usuario)->first();
            
            // Si no se encuentra el paciente, muestra un mensaje de error
            if (!$paciente) {
                $mensaje_error = 'No se encontró el perfil de paciente asociado a este usuario.';
            } else {
                // Si el paciente existe, carga sus citas
                $citas = Cita::where('id_paciente', $paciente->id_paciente)
                             ->with('medico')
                             ->orderBy('fecha_horario')
                             ->get();
            }
        }

        return view('pacientes.citas', compact('citas', 'paciente', 'mensaje_error'));
    }

    public function show($id_cita)
    {
        $cita = Cita::with(['paciente', 'medico'])->findOrFail($id_cita);
        return view('citas.show', compact('cita'));
    }

    public function edit($id_cita)
    {
        // Buscar la cita
        $cita = Cita::findOrFail($id_cita);

        // Cargar pacientes activos, médicos activos y horarios
        $pacientes = Paciente::where('estado', 'activo')->get();
        $medicos = Medico::where('estado', 'activo')->get();
        
        return view('citas.edit', compact('cita', 'pacientes', 'medicos'));
    }

    public function update(Request $request, $id_cita)
    {
        $request->validate([
            'id_paciente' => 'required|integer',
            'fecha_horario' => 'required|date',
            'estado' => 'required|string|max:50',
            'notas' => 'nullable|string',
            'id_doctor' => 'required|integer',
        ]);

        // Evitar conflicto de citas, ignorando la propia cita al actualizar
        $existeCita = Cita::where('id_doctor', $request->id_doctor)
                             ->where('fecha_horario', $request->fecha_horario)
                             ->where('id_cita', '!=', $id_cita)
                             ->exists();

        if ($existeCita) {
            return back()->withErrors(['id_doctor' => 'El doctor ya tiene una cita en esa fecha y hora.'])->withInput();
        }

        $fechaHora = Carbon::parse($request->fecha_horario);
        if ($fechaHora->lt(Carbon::now())) {
            return back()->withErrors(['fecha_horario' => 'No se puede agendar una cita en el pasado.'])->withInput();
        }

        $cita = Cita::findOrFail($id_cita);
        $cita->update($request->all());

        return redirect()->route('citas.index')
                         ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy($id_cita)
    {
        $cita = Cita::findOrFail($id_cita);
        $cita->delete();

        return redirect()->route('citas.index')
                         ->with('success', 'Cita eliminada correctamente.');
    }

    /**
     * Método para obtener las horas disponibles para un doctor en una fecha específica.
     */
    public function getAvailableHours(Request $request)
    {
        $request->validate([
            'id_doctor' => 'required|exists:medicos,id_doctor',
            'fecha' => 'required|date',
        ]);

        $fecha = Carbon::parse($request->input('fecha'));
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $diaSemana = strtolower($fecha->locale('es')->dayName);

        $horario = Horario::where('id_doctor', $request->input('id_doctor'))
                          ->whereRaw('LOWER(dia_semana) = ?', [$diaSemana])
                          ->first();

        if (!$horario) {
            return response()->json([]);
        }

        $citasReservadas = Cita::where('id_doctor', $request->input('id_doctor'))
                               ->whereDate('fecha_horario', $fecha)
                               ->pluck('fecha_horario')
                               ->map(function ($cita) {
                                   return Carbon::parse($cita)->format('H:i');
                               })
                               ->toArray();

        $horasDisponibles = [];
        $horaInicio = Carbon::parse($horario->hora_inicio);
        $horaFin = Carbon::parse($horario->hora_fin);
        $intervalo = 30; // Minutos por cita

        while ($horaInicio->lt($horaFin)) {
            $horaString = $horaInicio->format('H:i');
            if (!in_array($horaString, $citasReservadas) && $horaInicio->greaterThanOrEqualTo(Carbon::now())) {
                $horasDisponibles[] = $horaString;
            }
            $horaInicio->addMinutes($intervalo);
        }

        return response()->json($horasDisponibles);
    }
}
