<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'estado' => 'required|in:mejor,igual,peor',
            'consulta_id' => 'nullable|exists:consultas,id',
            'notas' => 'nullable|string|max:500',
        ]);

        Seguimiento::create([
            'user_id' => auth()->id(),
            'consulta_id' => $request->consulta_id,
            'estado' => $request->estado,
            'notas' => $request->notas,
        ]);

        return back()->with('success', 'Seguimiento registrado');
    }
}
