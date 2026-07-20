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
        $request->validate([
            'nombre' => 'required|max:100',
            'principio_activo' => 'required|max:100',
        ]);

        MedicamentoCatalogo::create($request->all());
        return redirect()->route('admin.medicamentos')->with('success', 'Medicamento creado');
    }

    public function medicamentosEdit(MedicamentoCatalogo $medicamento)
    {
        return view('admin.medicamentos-form', compact('medicamento'));
    }

    public function medicamentosUpdate(Request $request, MedicamentoCatalogo $medicamento)
    {
        $medicamento->update($request->all());
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
        $request->validate(['nombre' => 'required|max:100']);
        EnfermedadCatalogo::create($request->all());
        return redirect()->route('admin.enfermedades')->with('success', 'Enfermedad creada');
    }

    public function enfermedadesEdit(EnfermedadCatalogo $enfermedad)
    {
        return view('admin.enfermedades-form', compact('enfermedad'));
    }

    public function enfermedadesUpdate(Request $request, EnfermedadCatalogo $enfermedad)
    {
        $enfermedad->update($request->all());
        return redirect()->route('admin.enfermedades')->with('success', 'Enfermedad actualizada');
    }

    public function enfermedadesDestroy(EnfermedadCatalogo $enfermedad)
    {
        $enfermedad->delete();
        return redirect()->route('admin.enfermedades')->with('success', 'Enfermedad eliminada');
    }
}
