<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Secretaria;
use App\Models\Rol;
use App\Models\Especialidad;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string',
            'contraseña' => 'required|string'
        ]);

        $user = User::where('nombre_usuario', $request->nombre_usuario)->first();

        if (!$user || !Hash::check($request->contraseña, $user->contraseña)) {
            return back()->withErrors([
                'nombre_usuario' => 'Credenciales incorrectas.'
            ])->withInput();
        }

        if (trim(strtolower($user->estado)) != 'activo') {
            return back()->withErrors([
                'nombre_usuario' => 'Usuario inactivo, contacte al administrador.'
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function showRegisterForm()
    {
        $roles = Rol::all();
        $especialidades = Especialidad::all();
        return view('auth.register', compact('roles', 'especialidades'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario|max:255',
            'password' => 'required|string|min:6|confirmed',
            'id_rol' => 'required|integer|exists:roles,id_rol',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|max:255',

            // Campos de Médico solo si id_rol = 2
            'id_especialidad' => 'required_if:id_rol,2|exists:especialidad,id_especialidad',
            'telefono_medico' => 'required_if:id_rol,2|string|max:50',

            // Campos de Paciente solo si id_rol = 4
            'telefono' => 'required_if:id_rol,4|string|max:50',
            'eps' => 'required_if:id_rol,4|string|max:255',
            'rh' => 'required_if:id_rol,4|string|max:5',
        ]);

        $estado = 'activo'; // Cambia a 'activo' si quieres login inmediato

        $user = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'estado' => $estado,
        ]);

        // Crear datos según el rol
        if ($request->id_rol == 2) {
            Medico::create([
                'id_usuario' => $user->id_usuario,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono_medico,
                'correo' => $request->correo,
                'estado' => $estado,
                'id_especialidad' => $request->id_especialidad,
            ]);
        } elseif ($request->id_rol == 3) {
            Secretaria::create([
                'id_usuario' => $user->id_usuario,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->input('telefono', ''),
                'fecha_ingreso' => now(),
                'estado' => $estado,
                'correo' => $request->correo,
            ]);
        } elseif ($request->id_rol == 4) {
            Paciente::create([
                'id_usuario' => $user->id_usuario,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'eps' => $request->eps,
                'rh' => $request->rh,
                'estado' => $estado,
            ]);
        }

        // Solo iniciar sesión si el usuario es activo
        if ($estado === 'activo') {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Usuario registrado y autenticado.');
        }

        return redirect()->route('login')->with('success', 'Usuario registrado. Espere aprobación del administrador.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
