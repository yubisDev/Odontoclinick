<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Pacientes activos
        $pacientes_activas = Paciente::where('estado', 'activo')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellidos', 'like', "%{$search}%")
                      ->orWhere('correo', 'like', "%{$search}%")
                      ->orWhere('telefono', 'like', "%{$search}%");
                });
            })
            ->orderBy('id_paciente', 'asc')
            ->get();
        
        // Pacientes inactivos
        $pacientes_inactivas = Paciente::where('estado', 'inactivo')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellidos', 'like', "%{$search}%")
                      ->orWhere('correo', 'like', "%{$search}%")
                      ->orWhere('telefono', 'like', "%{$search}%");
                });
            })
            ->orderBy('id_paciente', 'asc')
            ->get();
        
        return view('pacientes.index', compact('pacientes_activas', 'pacientes_inactivas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación para ambos registros
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'correo' => 'required|email|max:100|unique:paciente,correo',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'eps' => 'nullable|string|max:50',
            'rh' => 'nullable|string|max:5',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario',
            'contraseña' => 'required|string|min:6',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Crear el usuario en la tabla 'usuarios'
            $user = User::create([
                'nombre_usuario' => $request->nombre_usuario,
                'contraseña' => Hash::make($request->contraseña),
                'estado' => 'activo',
                'id_rol' => 4, // El rol de paciente es 4
            ]);

            // 2. Crear el paciente y asociarlo con el ID del nuevo usuario
            Paciente::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'correo' => $request->correo,
                'direccion' => $request->direccion,
                'fecha_registro' => now(),
                'telefono' => $request->telefono,
                'eps' => $request->eps,
                'rh' => $request->rh,
                'estado' => 'activo',
                'id_usuario' => $user->id_usuario, // Vincula al paciente con el usuario
            ]);
        });

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente y usuario creados correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtiene el ID del usuario autenticado
        $authUser = Auth::id();

        // Busca el paciente por el ID del usuario. Si no lo encuentra, da un error 404.
        $paciente = Paciente::where('id_usuario', $id)->firstOrFail();

        // Medida de seguridad: asegura que el usuario solo pueda ver sus propios datos.
        if ($authUser != $paciente->id_usuario && !in_array(Auth::user()->id_rol, [1, 3])) {
            abort(403);
        }

        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        // Verificación de permisos
        if (Auth::id() != $paciente->id_usuario && Auth::user()->id_rol != 1 && Auth::user()->id_rol != 3) {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'correo' => 'required|email|max:100|unique:paciente,correo,' . $paciente->id_paciente . ',id_paciente',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'eps' => 'nullable|string|max:50',
            'rh' => 'nullable|string|max:5',
            'estado' => 'nullable|in:activo,inactivo'
        ]);

        $paciente->update($request->all());

        // Redirigir al perfil del paciente actualizado
        return redirect()->route('pacientes.show', $paciente->id_usuario)
            ->with('success', 'Datos actualizados correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        // El botón "Eliminar" ahora cambia el estado a 'inactivo'.
        $paciente->estado = 'inactivo';
        $paciente->save();

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente desactivado correctamente.');
    }

    /**
     * Reactiva un paciente de 'inactivo' a 'activo'.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function reactivar(Paciente $paciente)
    {
        $paciente->estado = 'activo';
        $paciente->save();

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente reactivado correctamente.');
    }
}
