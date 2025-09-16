<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string',
            'contraseña' => 'required|string'
        ]);

        // Buscar usuario por nombre_usuario
        $user = User::where('nombre_usuario', $request->nombre_usuario)->first();

        // Verificar usuario y contraseña
        if ($user && Hash::check($request->contraseña, $user->contraseña)) {

            // Verificar si el usuario está activo
            if ($user->estado != "activo") {
                return back()->withErrors([
                    'nombre_usuario' => 'Usuario inactivo, contacte al administrador.'
                ]);
            }

            // Iniciar sesión
            Auth::login($user);

            // Redirigir al dashboard según el rol
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'nombre_usuario' => 'Credenciales incorrectas'
        ])->withInput();
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario|max:255',
            'contraseña' => 'required|string|min:6|confirmed',
            'id_rol' => 'required|integer|exists:roles,id_rol'
        ]);

        // Crear usuario
        $user = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->contraseña),
            'id_rol' => $request->id_rol,
            'estado' => 1
        ]);

        // Loguear automáticamente al usuario (opcional)
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
