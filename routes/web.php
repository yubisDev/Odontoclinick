<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CitasController;




// ------------------ Página principal ------------------
Route::get('/', fn() => view('welcome'));

// ------------------ Auth ------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------ Dashboard unificado ------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// ------------------ CRUDs protegidos ------------------
Route::middleware('auth')->group(function () {

    // Pacientes
    Route::resource('pacientes', PacientesController::class);
    Route::post('pacientes/{paciente}/reactivar', [PacientesController::class, 'reactivar'])->name('pacientes.reactivar');

    // Médicos
    Route::resource('medicos', MedicoController::class);
    Route::post('medicos/{medico}/reactivar', [MedicoController::class, 'reactivar'])->name('medicos.reactivar');

    // Secretarias
    Route::resource('secretarias', SecretariaController::class);
    Route::post('secretarias/{id}/reactivar', [SecretariaController::class, 'reactivar'])->name('secretarias.reactivar');

    // Tratamientos
    Route::resource('tratamientos', TratamientoController::class);

    // Productos
    Route::resource('productos', ProductoController::class);

    // Inventario
    Route::resource('inventario', InventarioController::class);

    // Citas
    Route::resource('citas', CitaController::class);

    // Pagos
    Route::resource('pagos', PagoController::class);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::resource('reportes', ReporteController::class);

Route::get('paciente/citas', [CitasController::class, 'misCitas'])
    ->name('mis.citas')
    ->middleware('auth');

Route::get('/paciente/{id}', [PacientesController::class, 'show'])
    ->name('pacientes.show')
    ->middleware('auth');