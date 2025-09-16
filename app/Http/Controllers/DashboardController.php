<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Secretaria;
use App\Models\Medico;

class DashboardController extends Controller
{
    /**
     * Protege todas las rutas de este controlador con autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar dashboard según el rol del usuario
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->id_rol) 
        {
            case 1: // Administrador
                $secretarias = Secretaria::all(); // Trae todas las secretarias
                $medicos = Medico::all();         // Trae todos los médicos
                return view('dashboard.admin', compact('user', 'secretarias', 'medicos'));

            case 2: // Médico
                $citas = $user->medico->citas ?? collect();
                return view('dashboard.medico', compact('user', 'citas'));

            case 3: // Secretaria
                $pacientes = $user->secretaria->pacientes ?? collect();
                $citas = $user->secretaria->citas ?? collect();
                return view('dashboard.secretaria', compact('user', 'pacientes', 'citas'));

            case 4: // Paciente
                $citas = $user->paciente->citas ?? collect();
                return view('dashboard.paciente', compact('user', 'citas'));

            default:
                abort(403, 'Rol no autorizado');
        }
    }
}
