<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    // Listado
    public function index()
{
    $secretarias_activas = Secretaria::with('usuario')->activas()->get();
    $secretarias_inactivas = Secretaria::with('usuario')->inactivas()->get();

    return view('secretarias.index', compact('secretarias_activas', 'secretarias_inactivas'));
}



    // Crear formulario
    public function create()
    {
        return view('secretarias.create');
    }

    // Guardar nueva secretaria
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:secretaria,correo',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario',
            'contraseña' => 'required|string|min:6',
        ]);

        // Crear usuario
        $usuario = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->contraseña),
            'id_rol' => 3, // Rol secretaria
            'estado' => '1', // <-- agregar esto

        ]);

        // Crear secretaria
        Secretaria::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'fecha_ingreso' => now(),
            'id_usuario' => $usuario->id_usuario,
            'estado' => 'activo',
            'correo' => $request->correo,
        ]);

        return redirect()->route('secretarias.index')->with('success', 'Secretaria creada correctamente.');
    }

    // Formulario de edición
    public function edit($id)
    {
        $secretaria = Secretaria::with('usuario')->findOrFail($id);
        return view('secretarias.edit', compact('secretaria'));
    }

    // Actualizar secretaria
    public function update(Request $request, Secretaria $secretaria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:secretaria,correo,' . $secretaria->id_secretaria . ',id_secretaria',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario,' . $secretaria->id_usuario . ',id_usuario',
        ]);

        // Actualizar usuario
        $usuarioData = [
            'nombre_usuario' => $request->nombre_usuario,
        ];

        if ($request->contraseña) {
            $usuarioData['contraseña'] = Hash::make($request->contraseña);
        }

        $secretaria->usuario->update($usuarioData);

        // Actualizar secretaria
        $secretaria->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => $request->estado,
        ]);

        return redirect()->route('secretarias.index')->with('success', 'Secretaria actualizada correctamente.');
    }

    // Inactivar secretaria
    public function destroy($id)
    {
        $secretaria = Secretaria::findOrFail($id);
        $secretaria->update(['estado' => 'inactivo']);
        return redirect()->route('secretarias.index')->with('success', 'Secretaria inactivada correctamente.');
    }

    // Reactivar secretaria
    public function reactivar($id)
    {
        $secretaria = Secretaria::findOrFail($id);
        $secretaria->update(['estado' => 'activo']);
        return redirect()->route('secretarias.index')->with('success', 'Secretaria reactivada correctamente.');
    }
}
