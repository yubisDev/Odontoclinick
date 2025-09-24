<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Secretaria;
use App\Models\Historial;
use App\Models\Pago;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $hoy = Carbon::now();

        switch ($user->id_rol) 
        {
            case 1: // Administrador
                $secretarias = Secretaria::all();
                $medicos = Medico::all();
                $pagos = Pago::all();
                return view('dashboard.admin', compact('user', 'secretarias', 'medicos', 'pagos'));

            case 2: // Médico
                // Usamos el operador de encadenamiento opcional para evitar errores si el perfil del médico es nulo
                $medico = $user->medico;

                if (!$medico) {
                    return redirect()->route('dashboard')->with('error', 'Tu perfil de médico no se encuentra configurado. Contacta a un administrador.');
                }
                
                $citasProximas = Cita::with(['paciente', 'medico'])
                                     ->where('id_doctor', $medico->id_doctor)
                                     ->where('fecha_horario', '>=', $hoy)
                                     ->orderBy('fecha_horario', 'asc')
                                     ->get();

                $citasPasadas = Cita::with(['paciente', 'medico'])
                                     ->where('id_doctor', $medico->id_doctor)
                                     ->where('fecha_horario', '<', $hoy)
                                     ->orderBy('fecha_horario', 'desc')
                                     ->get();

                // Historias clínicas de los pacientes con citas pasadas
                $pacientesIds = $citasPasadas->pluck('id_paciente')->unique();
                $historiales = Historial::with('paciente')
                                        ->whereHas('paciente', function($q) use ($medico) {
                                            $q->where('id_doctor', $medico->id_doctor);
                                        })->get();

                return view('dashboard.medico', compact('user', 'citasProximas', 'citasPasadas', 'historiales'));

            case 3: // Secretaria
                $citasProximas = Cita::with(['paciente', 'medico'])
                                     ->where('fecha_horario', '>=', $hoy)
                                     ->orderBy('fecha_horario', 'asc')
                                     ->get();

                $citasPasadas = Cita::with(['paciente', 'medico'])
                                     ->where('fecha_horario', '<', $hoy)
                                     ->orderBy('fecha_horario', 'desc')
                                     ->get();

                return view('dashboard.secretaria', compact('user', 'citasProximas', 'citasPasadas'));

            case 4: // Paciente
                // Usamos el operador de encadenamiento opcional para evitar errores
                $citasProximas = Cita::with(['paciente', 'medico'])
                                     ->where('id_paciente', $user->paciente?->id_paciente)
                                     ->where('fecha_horario', '>=', $hoy)
                                     ->orderBy('fecha_horario', 'asc')
                                     ->get();

                $citasPasadas = Cita::with(['paciente', 'medico'])
                                     ->where('id_paciente', $user->paciente?->id_paciente)
                                     ->where('fecha_horario', '<', $hoy)
                                     ->orderBy('fecha_horario', 'desc')
                                     ->get();

                return view('dashboard.paciente', compact('user', 'citasProximas', 'citasPasadas'));

            default:
                abort(403, 'Rol no autorizado');
        }
    }
}
