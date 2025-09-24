<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use App\Models\User;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'estado' => '1',
        ]);

        // Crear secretaria
        Secretaria::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->input('telefono', ''),
            'fecha_ingreso' => $request->input('fecha_ingreso', now()),
            'id_usuario' => $usuario->id_usuario,
            'estado' => $request->input('estado', 'activo'),
            'correo' => $request->correo,
        ]);

        return redirect()->route('secretarias.index')->with('success', 'Secretaria creada correctamente.');
    }

    // Formulario de edición
    public function edit(Secretaria $secretaria)
    {
        // Permitir editar si es secretaria o administrador
        if (!in_array(auth()->user()->id_rol, [1, 3])) {
            abort(403, 'Acceso denegado. No tienes permisos para editar secretarias.');
        }


        $secretaria->load('usuario');
        
        // Obtener citas futuras (si las hay)
        $proximasCitas = Cita::with(['paciente', 'medico'])
            ->where('fecha_horario', '>', Carbon::now())
            ->orderBy('fecha_horario', 'asc')
            ->get();
        
        // Obtener historial de citas (si las hay)
        $citasPasadas = Cita::with(['paciente', 'medico'])
            ->where('fecha_horario', '<=', Carbon::now())
            ->orderBy('fecha_horario', 'desc')
            ->get();
            
        return view('secretarias.edit', compact('secretaria', 'proximasCitas', 'citasPasadas'));
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
            'telefono' => $request->input('telefono', $secretaria->telefono),
            'correo' => $request->correo,
            'estado' => $request->input('estado', $secretaria->estado),
        ]);

        return redirect()->route('secretarias.index')->with('success', 'Secretaria actualizada correctamente.');
    }

    // Inactivar secretaria
    public function destroy(Secretaria $secretaria)
    {
        // Inactivar secretaria
        $secretaria->update(['estado' => 'inactivo']);

        // Inactivar usuario asociado
        $secretaria->usuario->update(['estado' => 'inactivo']);

        return redirect()->route('secretarias.index')
                     ->with('success', 'Secretaria inactivada correctamente.');
    }

    public function reactivar(Secretaria $secretaria)
    { 
        // Reactivar secretaria
        $secretaria->update(['estado' => 'activo']);

        // Reactivar usuario asociado
        $secretaria->usuario->update(['estado' => 'activo']);

        return redirect()->route('secretarias.index')
                     ->with('success', 'Secretaria reactivada correctamente.');
    }

}
