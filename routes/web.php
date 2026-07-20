<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicamentoController;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::view('/profile', 'profile')->name('profile');

    // Health Profile
    Route::view('/perfil-salud', 'perfil-salud')->name('perfil-salud');

    // Consultations
    Route::view('/consulta/chat', 'consulta/chat')->name('consulta.chat');
    Route::view('/consulta/guiada', 'consulta/guiada')->name('consulta.guiada');
    Route::get('/consulta/resultado/{id}', [App\Http\Controllers\ConsultaController::class, 'resultado'])->name('consulta.resultado');

    // Medical History
    Route::view('/historial', 'historial')->name('historial');

    // Symptom Tracking
    Route::view('/seguimiento', 'seguimiento')->name('seguimiento');
    Route::post('/seguimiento', [SeguimientoController::class, 'store'])->name('seguimiento.store');

    // Alerts (paginated via controller + mark as read)
    Route::get('/alertas', function () {
        $alertas = auth()->user()->alertas()->latest()->paginate(15);
        return view('alertas', compact('alertas'));
    })->name('alertas');

    Route::post('/alertas/marcar-leidas', function () {
        auth()->user()->alertas()->where('leida', false)->update(['leida' => true]);
        return back()->with('success', 'Todas las alertas marcadas como leídas');
    })->name('alertas.marcar-leidas');

    // Medicines (via controller instead of Route::view)
    Route::get('/medicamentos/verificador', [MedicamentoController::class, 'verificador'])->name('medicamentos.verificador');
    Route::get('/medicamentos/comparador', [MedicamentoController::class, 'comparador'])->name('medicamentos.comparador');
    Route::view('/medicamentos/biblioteca', 'medicamentos/biblioteca')->name('medicamentos.biblioteca');

    // Disease Library
    Route::view('/enfermedades/biblioteca', 'enfermedades/biblioteca')->name('enfermedades.biblioteca');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/medicamentos', [AdminController::class, 'medicamentos'])->name('medicamentos');
        Route::get('/medicamentos/crear', [AdminController::class, 'medicamentosCreate'])->name('medicamentos.create');
        Route::post('/medicamentos', [AdminController::class, 'medicamentosStore'])->name('medicamentos.store');
        Route::get('/medicamentos/{medicamento}/editar', [AdminController::class, 'medicamentosEdit'])->name('medicamentos.edit');
        Route::put('/medicamentos/{medicamento}', [AdminController::class, 'medicamentosUpdate'])->name('medicamentos.update');
        Route::delete('/medicamentos/{medicamento}', [AdminController::class, 'medicamentosDestroy'])->name('medicamentos.destroy');

        Route::get('/enfermedades', [AdminController::class, 'enfermedades'])->name('enfermedades');
        Route::get('/enfermedades/crear', [AdminController::class, 'enfermedadesCreate'])->name('enfermedades.create');
        Route::post('/enfermedades', [AdminController::class, 'enfermedadesStore'])->name('enfermedades.store');
        Route::get('/enfermedades/{enfermedad}/editar', [AdminController::class, 'enfermedadesEdit'])->name('enfermedades.edit');
        Route::put('/enfermedades/{enfermedad}', [AdminController::class, 'enfermedadesUpdate'])->name('enfermedades.update');
        Route::delete('/enfermedades/{enfermedad}', [AdminController::class, 'enfermedadesDestroy'])->name('enfermedades.destroy');
    });

    // AI Panel (query moved to controller closure — fix BUG-06 orphan query)
    Route::middleware('admin')->group(function () {
        Route::get('/panel-ia', function () {
            $userCount = \App\Models\User::count();
            $consultaCount = \App\Models\Consulta::count();
            $alertasCount = \App\Models\Alerta::count();
            $alertasActivasCount = \App\Models\Alerta::where('leida', false)->count();
            $sintomasFrecuentes = \App\Models\ConsultaSintoma::select('nombre_sintoma', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('nombre_sintoma')
                ->orderByDesc('total')
                ->take(10)
                ->get();
            $riesgos = \App\Models\Consulta::select('nivel_riesgo', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('nivel_riesgo')
                ->get();

            return view('panel-ia', compact('userCount', 'consultaCount', 'alertasCount', 'alertasActivasCount', 'sintomasFrecuentes', 'riesgos'));
        })->name('panel-ia');
    });
});

require __DIR__.'/auth.php';
