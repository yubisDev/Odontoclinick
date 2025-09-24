<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
 PacientesController,
 SecretariaController,
 MedicoController,
 DashboardController,
 AuthController,
 TratamientoController,
 ProductoController,
 InventarioController,
 CitaController,
 PagoController,
 ReporteController,
 ProcedimientoController,
 HistorialController,
 HorariosController
};

// ------------------ Página principal ------------------
Route::get('/', fn() => view('welcome'));

// ------------------ Autenticación ------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------ Dashboard (con middleware de autenticación) ------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
 ->name('dashboard')
 ->middleware('auth');

// ------------------ Rutas Protegidas (Requiere Autenticación) ------------------
Route::middleware('auth')->group(function () {
 
 // ------------------ Rutas Específicas del Paciente (autenticado) ------------------
 // Estas rutas deben ir PRIMERO para que no haya conflictos.
 Route::prefix('pacientes')->name('pacientes.')->group(function () {
  Route::get('agendar', [CitaController::class, 'agendar'])->name('agendar');
  Route::post('agendar/store', [CitaController::class, 'storeFromPaciente'])->name('agendar.store');
  Route::get('mis-citas', [CitaController::class, 'misCitas'])->name('citas');
 });

 // ------------------ Rutas de Pacientes ------------------
 // El resource debe ir DESPUÉS de las rutas específicas
 Route::resource('pacientes', PacientesController::class);
 Route::put('pacientes/{paciente}/reactivar', [PacientesController::class, 'reactivar'])->name('pacientes.reactivar');

 // ------------------ Rutas Específicas de Citas ------------------
 // Esta ruta es para el AJAX y debe ir ANTES del Route::resource
 Route::get('/citas/horarios-disponibles', [CitaController::class, 'getAvailableHours'])->name('citas.horarios-disponibles');

 // ------------------ Rutas de Citas (Recurso) ------------------
 Route::resource('citas', CitaController::class);

 // ------------------ Rutas de Médicos ------------------
 Route::resource('medicos', MedicoController::class);
 Route::post('medicos/{medico}/reactivar', [MedicoController::class, 'reactivar'])->name('medicos.reactivar');
 // Rutas para el perfil del médico
 Route::get('/medico/perfil', [MedicoController::class, 'perfil'])->name('medicos.perfil');
 Route::put('/medico/perfil', [MedicoController::class, 'updatePerfil'])->name('medicos.perfil.update');

 // ------------------ Rutas de Secretarias ------------------
 Route::resource('secretarias', SecretariaController::class);
 Route::post('secretarias/{secretaria}/reactivar', [SecretariaController::class, 'reactivar'])->name('secretarias.reactivar');

 // ------------------ Rutas de Tratamientos, Productos, Inventario, Pagos ------------------
 Route::resources([
  'tratamientos' => TratamientoController::class,
  'productos' => ProductoController::class,
  'inventario' => InventarioController::class,
  'pagos'  => PagoController::class,
 ]);
 
 // ------------------ Rutas de Historial Médico ------------------
 Route::prefix('historial')->name('historial.')->group(function () {
  Route::get('/', [HistorialController::class, 'indexAll'])->name('index_all');
  Route::get('/{id_paciente}', [HistorialController::class, 'index'])->name('index');
  Route::get('/show/{id}', [HistorialController::class, 'show'])->name('show');
  Route::get('/create/{id_paciente}/{id_cita?}', [HistorialController::class, 'create'])->name('create');
  Route::post('/store', [HistorialController::class, 'store'])->name('store');
  Route::get('/{id}/edit', [HistorialController::class, 'edit'])->name('edit');
  Route::put('/{id}', [HistorialController::class, 'update'])->name('update');
  Route::delete('/{id}', [HistorialController::class, 'destroy'])->name('destroy');
 });

 // ------------------ Rutas de Horarios ------------------
 Route::prefix('horarios')->name('horarios.')->group(function () {
  Route::get('/panel', [HorariosController::class, 'panel'])->name('panel');
  Route::get('/create', [HorariosController::class, 'create'])->name('create');
  Route::post('/store', [HorariosController::class, 'store'])->name('store');
  Route::get('/edit/{id}', [HorariosController::class, 'edit'])->name('edit');
  Route::put('/update/{id}', [HorariosController::class, 'update'])->name('update');
  Route::delete('/destroy/{id}', [HorariosController::class, 'destroy'])->name('destroy');
 });
});