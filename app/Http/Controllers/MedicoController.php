<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Auth;


class MedicoController extends Controller
{
    // Listar médicos activos
    public function index()
    {
        $medicos = Medico::with('especialidad')->get(); // trae activos e inactivos
        return view('medicos.index', compact('medicos'));
    }

    // Mostrar formulario para agregar médico
    public function create()
    {
        $especialidad = Especialidad::all();
        return view('medicos.create', compact('especialidad'));
    }

    public function show($id)
    {
        $medico = Medico::with('usuario', 'especialidad')->findOrFail($id);
        return view('medicos.show', compact('medico'));
    }

    public function store(Request $request)
    {
        // 1. Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:medicos,correo',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario',
            'password' => 'required|string|min:6|confirmed', 
            'id_especialidad' => 'required|exists:especialidad,id_especialidad',
            'estado' => 'required|in:activo,inactivo', // Valida el campo 'estado'
        ]);

        // 2. Crear el usuario
        $usuario = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->password), // Usa el campo 'password' del formulario
            'id_rol' => 2,
            'estado' => 'activo',
        ]);

        // 3. Crear el médico, usando el ID del usuario recién creado
        Medico::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => 'activo',
            'id_usuario' => $usuario->id_usuario,
            'id_especialidad' => $request->id_especialidad,
        ]);

        // 4. Redirigir y mostrar el mensaje de éxito
        return redirect()->route('medicos.index')->with('success', 'Médico agregado correctamente.');
    }

    // Formulario para editar médico
    public function edit($id)
    {
        $medico = Medico::with('usuario')->findOrFail($id);
        $especialidad = Especialidad::all();
        return view('medicos.edit', compact('medico', 'especialidad'));
    }

    // Actualizar médico
    public function update(Request $request, $id)
    {
        $medico = Medico::with('usuario')->findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:medicos,correo,' . $medico->id_doctor . ',id_doctor',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario,' . $medico->id_usuario . ',id_usuario',
            'contraseña' => 'nullable|string|min:6|confirmed', // 'nullable' para permitir que el campo esté vacío
            'estado' => 'required|string|in:activo,inactivo',
            'id_especialidad' => 'required|exists:especialidad,id_especialidad'
        ]);

        // Actualizar usuario
        $usuarioData = ['nombre_usuario' => $request->nombre_usuario];
        if ($request->filled('contraseña')) { // Usar filled() para verificar si la contraseña no está vacía
            $usuarioData['contraseña'] = Hash::make($request->contraseña);
        }
        $medico->usuario->update($usuarioData);

        // Actualizar médico
        $medico->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => $request->estado,
            'id_especialidad' => $request->id_especialidad,
        ]);
        
        // Lógica de redirección basada en el rol
        if (Auth::check() && Auth::user()->id_rol == 2) {
            return redirect()->route('medicos.show', Auth::user()->id_usuario)
                             ->with('success', 'Perfil actualizado correctamente.');
        }

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado correctamente.');
    }

    // Desactivar médico (no elimina)
    public function destroy(Medico $medico)
    {
        $medico->update(['estado' => 'inactivo']);
        return redirect()->route('medicos.index')->with('success', 'Médico desactivado correctamente.');
    }

    // Ver médicos inactivos
    public function inactivos()
    {
        $medicos = Medico::where('estado', 'inactivo')->get();
        return view('medicos.index', compact('medicos'));
    }

    // Reactivar médico
    public function reactivar($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->estado = 'activo';
        $medico->save();

        return redirect()->route('medicos.index')->with('success', 'Médico reactivado correctamente.');
    }

    // Mostrar formulario para que el médico edite su propio perfil
    public function perfil()
    {
        $medico = auth()->user()->medico;
        $especialidad = Especialidad::all();
        return view('medicos.perfil', compact('medico', 'especialidad'));
    }
    public function updatePerfil(Request $request)
    {
        $medico = auth()->user()->medico;

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:medicos,correo,' . $medico->id_doctor . ',id_doctor',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario,' . $medico->id_usuario . ',id_usuario',
            'password' => 'nullable|string|min:6|confirmed',
            'estado' => 'required|string|in:activo,inactivo',
            'id_especialidad' => 'required|exists:especialidad,id_especialidad'
        ]);

        // Actualizar usuario
        $usuarioData = ['nombre_usuario' => $request->nombre_usuario];
        if ($request->filled('password')) {
            $usuarioData['contraseña'] = Hash::make($request->password);
        }
        $medico->usuario->update($usuarioData);

        // Actualizar médico
        $medico->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => $request->estado,
            'id_especialidad' => $request->id_especialidad,
        ]);

        return redirect()->route('medicos.show', $medico->id_doctor)
                         ->with('success', 'Perfil actualizado correctamente.');
    }
}