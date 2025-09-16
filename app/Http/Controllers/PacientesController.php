<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacientesController extends Controller
{
    // Listado de pacientes
    public function index()
    {
        $pacientes_activas = Paciente::with('usuario')->where('estado', 'activo')->get();
        $pacientes_inactivas = Paciente::with('usuario')->where('estado', 'inactivo')->get();

        return view('pacientes.index', compact('pacientes_activas', 'pacientes_inactivas'));
    }

    // Formulario para crear
    public function create()
    {
        return view('pacientes.create');
    }

    // Guardar nuevo paciente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'correo' => 'required|email|unique:paciente,correo',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'eps' => 'nullable|string|max:50',
            'rh' => 'nullable|string|max:5',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario',
            'contraseña' => 'required|string|min:6',
        ]);

        // Crear usuario
        $usuario = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->contraseña),
            'id_rol' => 4, // Rol paciente
            'estado' => 'activo', 

        ]);

        // Crear paciente
        Paciente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'fecha_registro' => now(),
            'id_usuario' => $usuario->id_usuario,
            'eps' => $request->eps,
            'rh' => $request->rh,
            'estado' => 'activo',
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente.');
    }
    public function show($id)
{
    $paciente = \App\Models\Paciente::where('id_usuario', $id)->firstOrFail();
    return view('pacientes.show', compact('paciente'));
}



    // Formulario para editar
    public function edit($id)
    {
        $paciente = Paciente::with('usuario')->findOrFail($id);
        return view('pacientes.edit', compact('paciente'));
    }

    // Actualizar paciente
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'correo' => 'required|email|unique:paciente,correo,' . $paciente->id_paciente . ',id_paciente',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'eps' => 'nullable|string|max:50',
            'rh' => 'nullable|string|max:5',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario,' . $paciente->id_usuario . ',id_usuario',
        ]);

        // Actualizar usuario
        $usuarioData = [
            'nombre_usuario' => $request->nombre_usuario,
        ];

        if ($request->contraseña) {
            $usuarioData['contraseña'] = Hash::make($request->contraseña);
        }

        $paciente->usuario->update($usuarioData);

        // Actualizar paciente
        $paciente->update([
    'nombre' => $request->nombre,
    'apellidos' => $request->apellidos,
    'fecha_nacimiento' => $request->fecha_nacimiento,
    'correo' => $request->correo,
    'direccion' => $request->direccion,
    'telefono' => $request->telefono,
    'eps' => $request->eps,
    'rh' => $request->rh,
    'estado' => $request->estado, // <-- muy importante
]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    // Inactivar paciente
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update(['estado' => 'inactivo']);
        return redirect()->route('pacientes.index')->with('success', 'Paciente inactivado correctamente.');
    }

    // Reactivar paciente
    public function reactivar($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update(['estado' => 'activo']);
        return redirect()->route('pacientes.index')->with('success', 'Paciente reactivado correctamente.');
    }
}
