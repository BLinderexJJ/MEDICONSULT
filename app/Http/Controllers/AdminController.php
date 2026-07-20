<?php

namespace App\Http\Controllers;

use App\Models\MedicamentoCatalogo;
use App\Models\EnfermedadCatalogo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // === MEDICAMENTOS ===
    public function medicamentos()
    {
        $medicamentos = MedicamentoCatalogo::paginate(15);
        return view('admin.medicamentos', compact('medicamentos'));
    }

    public function medicamentosCreate()
    {
        return view('admin.medicamentos-form');
    }

    public function medicamentosStore(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'principio_activo' => 'required|string|max:100',
            'categoria_terapeutica' => 'nullable|string|max:100',
            'presentacion' => 'nullable|string|max:50',
            'concentracion' => 'nullable|string|max:50',
            'edad_minima_meses' => 'nullable|integer|min:0',
            'dosis' => 'nullable|string|max:200',
            'indicaciones' => 'nullable|string|max:2000',
            'contraindicaciones' => 'nullable|string|max:2000',
            'efectos_secundarios' => 'nullable|string|max:2000',
            'dosis_referencia' => 'nullable|string|max:2000',
            'interacciones' => 'nullable|string|max:2000',
            'requiere_receta' => 'nullable|boolean',
            'embarazo' => 'nullable|string|max:20',
            'lactancia' => 'nullable|string|max:20',
            'insuficiencia_renal' => 'nullable|string|max:100',
            'insuficiencia_hepatica' => 'nullable|string|max:100',
            'alergias_relacionadas' => 'nullable|string|max:200',
            'estado' => 'nullable|string|max:20',
        ]);

        MedicamentoCatalogo::create($validated);
        return redirect()->route('admin.medicamentos')->with('success', 'Medicamento creado');
    }

    public function medicamentosEdit(MedicamentoCatalogo $medicamento)
    {
        return view('admin.medicamentos-form', compact('medicamento'));
    }

    public function medicamentosUpdate(Request $request, MedicamentoCatalogo $medicamento)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'principio_activo' => 'required|string|max:100',
            'categoria_terapeutica' => 'nullable|string|max:100',
            'presentacion' => 'nullable|string|max:50',
            'concentracion' => 'nullable|string|max:50',
            'edad_minima_meses' => 'nullable|integer|min:0',
            'dosis' => 'nullable|string|max:200',
            'indicaciones' => 'nullable|string|max:2000',
            'contraindicaciones' => 'nullable|string|max:2000',
            'efectos_secundarios' => 'nullable|string|max:2000',
            'dosis_referencia' => 'nullable|string|max:2000',
            'interacciones' => 'nullable|string|max:2000',
            'requiere_receta' => 'nullable|boolean',
            'embarazo' => 'nullable|string|max:20',
            'lactancia' => 'nullable|string|max:20',
            'insuficiencia_renal' => 'nullable|string|max:100',
            'insuficiencia_hepatica' => 'nullable|string|max:100',
            'alergias_relacionadas' => 'nullable|string|max:200',
            'estado' => 'nullable|string|max:20',
        ]);

        $medicamento->update($validated);
        return redirect()->route('admin.medicamentos')->with('success', 'Medicamento actualizado');
    }

    public function medicamentosDestroy(MedicamentoCatalogo $medicamento)
    {
        $medicamento->delete();
        return redirect()->route('admin.medicamentos')->with('success', 'Medicamento eliminado');
    }

    // === ENFERMEDADES ===
    public function enfermedades()
    {
        $enfermedades = EnfermedadCatalogo::paginate(15);
        return view('admin.enfermedades', compact('enfermedades'));
    }

    public function enfermedadesCreate()
    {
        return view('admin.enfermedades-form');
    }

    public function enfermedadesStore(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:2000',
            'sintomas' => 'nullable|string|max:2000',
            'prevencion' => 'nullable|string|max:2000',
            'cuando_acudir' => 'nullable|string|max:2000',
        ]);

        EnfermedadCatalogo::create($validated);
        return redirect()->route('admin.enfermedades')->with('success', 'Enfermedad creada');
    }

    public function enfermedadesEdit(EnfermedadCatalogo $enfermedad)
    {
        return view('admin.enfermedades-form', compact('enfermedad'));
    }

    public function enfermedadesUpdate(Request $request, EnfermedadCatalogo $enfermedad)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:2000',
            'sintomas' => 'nullable|string|max:2000',
            'prevencion' => 'nullable|string|max:2000',
            'cuando_acudir' => 'nullable|string|max:2000',
        ]);

        $enfermedad->update($validated);
        return redirect()->route('admin.enfermedades')->with('success', 'Enfermedad actualizada');
    }

    public function enfermedadesDestroy(EnfermedadCatalogo $enfermedad)
    {
        $enfermedad->delete();
        return redirect()->route('admin.enfermedades')->with('success', 'Enfermedad eliminada');
    }
}
