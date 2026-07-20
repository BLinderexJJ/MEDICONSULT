<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function resultado($id)
    {
        $consulta = Consulta::findOrFail($id);
        abort_if($consulta->user_id !== auth()->id() && !auth()->user()->esAdmin(), 403);
        return view('consulta/resultado', compact('consulta'));
    }
}
