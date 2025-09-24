<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Medico;
use Illuminate\Support\Facades\Auth;

class HorariosController extends Controller
{
    /**
     * Muestra el panel de administración de horarios con todos los médicos y sus horarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminPanel()
    {
        $medicos = Medico::with('horarios')->get();
        return view('horarios.admin-panel', compact('medicos'));
    }

    /**
     * Muestra el panel de horarios para el médico que ha iniciado sesión.
     *
     * @return \Illuminate\Http\Response
     */
    public function medicoPanel()
    {
        // Obtener el perfil del médico autenticado.
        // Se asume que la tabla 'users' tiene una relación o campo que vincula a 'medicos'.
        $medico = Medico::where('id_usuario', Auth::id())->first();

        // Si el usuario autenticado no es un médico, redirige.
        if (!$medico) {
            return redirect('/')->with('error', 'No se encontró información de tu perfil de médico.');
        }

        return view('horarios.medico-panel', compact('medico'));
    }

    /**
     * Muestra el formulario para crear un nuevo horario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = Medico::where('estado', 'activo')->get();
        $authMedicoId = null;
        if (Auth::check() && !Auth::user()->esAdmin()) {
            $authMedicoId = Medico::where('id_usuario', Auth::id())->value('id_doctor');
        }

        return view('horarios.create', compact('medicos', 'authMedicoId'));
    }

    /**
     * Almacena un nuevo horario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_doctor = (Auth::check() && !Auth::user()->esAdmin())
            ? Medico::where('id_usuario', Auth::id())->value('id_doctor')
            : $request->id_doctor;

        $request->validate([
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'cant_pacientes' => 'required|integer|min:1',
            'dia_semana' => 'required|string|max:10',
        ]);
        
        $horarioData = $request->all();
        $horarioData['id_doctor'] = $id_doctor;

        Horario::create($horarioData);
        
        return (Auth::check() && !Auth::user()->esAdmin())
            ? redirect()->route('horarios.medico.panel')->with('success', 'Horario agregado correctamente')
            : redirect()->route('horarios.admin.panel')->with('success', 'Horario agregado correctamente');
    }

    /**
     * Muestra el formulario para editar un horario existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        
        // Redirige si el usuario no tiene permiso para editar
        if (Auth::check() && !Auth::user()->esAdmin()) {
            $authMedicoId = Medico::where('id_usuario', Auth::id())->value('id_doctor');
            if ($horario->id_doctor != $authMedicoId) {
                 return redirect()->back()->with('error', 'No tienes permiso para editar este horario.');
            }
        }

        $medicos = Medico::where('estado', 'activo')->get();
        return view('horarios.edit', compact('horario', 'medicos'));
    }

    /**
     * Actualiza un horario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);
        
        // Redirige si el usuario no tiene permiso para actualizar
        if (Auth::check() && !Auth::user()->esAdmin()) {
            $authMedicoId = Medico::where('id_usuario', Auth::id())->value('id_doctor');
            if ($horario->id_doctor != $authMedicoId) {
                 return redirect()->back()->with('error', 'No tienes permiso para actualizar este horario.');
            }
        }

        $request->validate([
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'cant_pacientes' => 'required|integer|min:1',
            'dia_semana' => 'required|string|max:10',
        ]);

        $horario->update($request->all());

        return (Auth::check() && !Auth::user()->esAdmin())
            ? redirect()->route('horarios.medico.panel')->with('success', 'Horario actualizado correctamente')
            : redirect()->route('horarios.admin.panel')->with('success', 'Horario actualizado correctamente');
    }

    /**
     * Elimina un horario de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);

        // Redirige si el usuario no tiene permiso para eliminar
        if (Auth::check() && !Auth::user()->esAdmin()) {
            $authMedicoId = Medico::where('id_usuario', Auth::id())->value('id_doctor');
            if ($horario->id_doctor != $authMedicoId) {
                 return redirect()->back()->with('error', 'No tienes permiso para eliminar este horario.');
            }
        }

        $horario->delete();
        
        return (Auth::check() && !Auth::user()->esAdmin())
            ? redirect()->route('horarios.medico.panel')->with('success', 'Horario eliminado correctamente')
            : redirect()->route('horarios.admin.panel')->with('success', 'Horario eliminado correctamente');
    }
}
