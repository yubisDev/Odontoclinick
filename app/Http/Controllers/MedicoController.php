<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Especialidad;

class MedicoController extends Controller
{
    // Listar médicos activos
    public function index() {
        $medicos = Medico::with('especialidad')->get(); // trae activos e inactivos
        return view('medicos.index', compact('medicos'));
    }


    // Mostrar formulario para agregar médico
    public function create() {
        $especialidades = Especialidad::all();
        return view('medicos.create', compact('especialidades'));
    }
    
    // Mostrar detalles de un médico
    public function show($id)
    {
        $medico = Medico::with('especialidad')->findOrFail($id);
        return view('medicos.show', compact('medico'));
    }

    // Guardar nuevo médico
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:medicos,correo',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario',
            'contraseña' => 'required|string|min:6',
        ]);

        // Crear usuario
        $usuario = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->contraseña),
            'id_rol' => 2, // Suponiendo 2 = médico
            'estado' => 'activo',
        ]);

        // Crear médico
        Medico::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => 'activo',
            'id_usuario' => $usuario->id_usuario,
            'id_especialidad' => $request->id_especialidad,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico agregado correctamente.');
    }

    // Formulario para editar médico
    public function edit($id)
    {
        $medico = Medico::with('usuario')->findOrFail($id);
        $especialidades = Especialidad::all(); // Trae todas las especialidades

        return view('medicos.edit', compact('medico', 'especialidades'));
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
    ]);

    // Actualizar usuario
    $usuarioData = ['nombre_usuario' => $request->nombre_usuario];
    if ($request->contraseña) {
        $usuarioData['contraseña'] = Hash::make($request->contraseña);
    }
    $medico->usuario->update($usuarioData);

    // Actualizar médico
    $medico->update([
        'nombre' => $request->nombre,
        'apellidos' => $request->apellidos,
        'telefono' => $request->telefono,
        'correo' => $request->correo,
        'id_especialidad' => $request->id_especialidad,
    ]);

    return redirect()->route('medicos.index')->with('success', 'Médico actualizado correctamente.');
}


    // Desactivar médico (no elimina)
    public function destroy(Medico $medico)
    {
        $medico->update(['estado' => 'inactivo']);
        return redirect()->route('medicos.index')->with('success', 'Médico desactivado correctamente.');
    }

    // Ver médicos inactivos
    public function inactivos() {
        // Trae solo los médicos con estado 'inactivo'
        $medicos = Medico::where('estado', 'inactivo')->get();
        return view('medicos.index', compact('medicos'));
    }



    // Reactivar médico
    public function reactivar($id) {
        $medico = Medico::findOrFail($id);
        $medico->estado = 'activo';
        $medico->save();

        return redirect()->route('medicos.index')->with('success', 'Médico reactivado correctamente.');
    }


}
