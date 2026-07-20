<?php

namespace App\Http\Controllers;

use App\Models\MedicamentoCatalogo;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Verificador de medicamentos: busca, muestra detalle y verifica compatibilidad.
     */
    public function verificador(Request $request)
    {
        $user = auth()->user()->load(['alergias', 'enfermedades']);
        $query = $request->input('q');

        // Listado filtrado por búsqueda
        $medicamentosLista = MedicamentoCatalogo::when($query, fn($q) => $q->where('nombre', 'like', "%{$query}%"))
            ->get();

        // Detalle del medicamento seleccionado (por nombre exacto)
        $medDetalle = $query ? MedicamentoCatalogo::where('nombre', $query)->first() : null;

        // Verificar compatibilidad con perfil del usuario
        $compatible = true;
        $incompatibilidades = [];

        if ($medDetalle) {
            foreach ($user->alergias as $alergia) {
                if (stripos($medDetalle->nombre, $alergia->nombre) !== false || stripos($medDetalle->principio_activo, $alergia->nombre) !== false) {
                    $compatible = false;
                    $incompatibilidades[] = "Alergia a {$alergia->nombre}";
                }
            }
            if ($medDetalle->contraindicaciones) {
                foreach ($user->enfermedades as $enf) {
                    if (stripos($medDetalle->contraindicaciones, $enf->nombre) !== false) {
                        $compatible = false;
                        $incompatibilidades[] = "Contraindicado en {$enf->nombre}";
                    }
                }
            }
        }

        // Catálogo completo para el comparador (select solo lo necesario)
        $medicamentosCatalogo = MedicamentoCatalogo::select('id', 'nombre')->orderBy('nombre')->get();

        return view('medicamentos.verificador', compact(
            'medicamentosLista', 'medDetalle', 'compatible', 'incompatibilidades',
            'medicamentosCatalogo', 'query'
        ));
    }

    /**
     * Comparador de dos medicamentos lado a lado.
     */
    public function comparador(Request $request)
    {
        $m1 = $request->input('m1') ? MedicamentoCatalogo::find($request->input('m1')) : null;
        $m2 = $request->input('m2') ? MedicamentoCatalogo::find($request->input('m2')) : null;

        return view('medicamentos.comparador', compact('m1', 'm2'));
    }
}
