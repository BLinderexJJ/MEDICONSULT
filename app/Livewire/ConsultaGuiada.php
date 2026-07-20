<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SintomaCatalogo;
use App\Models\Consulta;
use App\Models\ConsultaSintoma;
use App\Models\Alerta;

class ConsultaGuiada extends Component
{
    public $sintomasSeleccionados = [];
    public $sintomaPrincipal = '';
    public $intensidad = 'moderado';
    public $duracion = '';
    public $paso = 0;
    public $categoriaActual = null;
    public $consultaId = null;
    public $resultado = null;

    public function seleccionarCategoria($categoria)
    {
        $this->categoriaActual = $categoria;
    }

    public function toggleSintoma($sintomaId)
    {
        if (in_array($sintomaId, $this->sintomasSeleccionados)) {
            $this->sintomasSeleccionados = array_diff($this->sintomasSeleccionados, [$sintomaId]);
        } else {
            $this->sintomasSeleccionados[] = $sintomaId;
        }
    }

    public function siguientePaso()
    {
        if ($this->paso === 0 && empty($this->sintomasSeleccionados)) return;

        if ($this->paso === 0) {
            $this->paso = 1;
        }
    }

    public function analizar()
    {
        $this->validate([
            'sintomasSeleccionados' => 'required|min:1',
        ]);

        $user = auth()->user()->load('enfermedades');

        // Pre-cargar todos los síntomas en una sola query (fix N+1)
        $sintomasMap = SintomaCatalogo::whereIn('id', $this->sintomasSeleccionados)
            ->pluck('nombre', 'id');

        $sintomasNombres = $sintomasMap->values()->filter();

        $riesgo = $this->calcularRiesgo($user);
        $causas = $this->generarCausas($sintomasNombres);
        $recomendaciones = $this->generarRecomendaciones($riesgo, $sintomasNombres);

        $consulta = Consulta::create([
            'user_id' => $user->id,
            'tipo' => 'guiada',
            'sintoma_principal' => $sintomasNombres->first() ?? 'consulta guiada',
            'descripcion' => 'Síntomas: ' . $sintomasNombres->implode(', '),
            'nivel_riesgo' => $riesgo,
            'posibles_causas' => $causas,
            'recomendaciones_generales' => $recomendaciones,
        ]);

        foreach ($this->sintomasSeleccionados as $sintomaId) {
            ConsultaSintoma::create([
                'consulta_id' => $consulta->id,
                'sintoma_id' => $sintomaId,
                'nombre_sintoma' => $sintomasMap[$sintomaId] ?? 'desconocido',
                'intensidad' => $this->intensidad,
                'duracion_dias' => $this->duracion ? (int)$this->duracion : null,
            ]);
        }

        $this->consultaId = $consulta->id;
        $this->resultado = compact('riesgo', 'causas', 'recomendaciones');
        $this->paso = 2;
    }

    private function calcularRiesgo($user = null)
    {
        $user = $user ?? auth()->user()->load('enfermedades');
        $score = count($this->sintomasSeleccionados);

        if ($this->intensidad === 'severo') $score += 2;
        if ($user->enfermedades->count() > 0) $score += 1;
        if ($score >= 5) return 'alto';
        if ($score >= 3) return 'medio';
        return 'bajo';
    }

    private function generarCausas($nombres)
    {
        $causas = [];
        $mapa = [
            'Fiebre' => 'Infección viral',
            'Tos' => 'Infección respiratoria',
            'Dolor de cabeza' => 'Cefalea tensional',
            'Dolor de garganta' => 'Faringitis',
            'Dolor muscular' => 'Mialgia',
            'Náuseas' => 'Trastorno digestivo',
            'Diarrea' => 'Gastroenteritis',
            'Fatiga' => 'Cuadro viral',
        ];
        foreach ($nombres as $nombre) {
            if (isset($mapa[$nombre])) $causas[] = $mapa[$nombre];
        }
        return implode(', ', $causas) ?: 'Síntomas inespecíficos';
    }

    private function generarRecomendaciones($riesgo, $nombres)
    {
        $recomendaciones = ['Mantener hidratación', 'Descanso adecuado'];
        if ($nombres->contains('Fiebre')) $recomendaciones[] = 'Paracetamol si es necesario (verificar contraindicaciones)';
        if ($riesgo === 'alto') $recomendaciones[] = '🔴 ACUDIR A EMERGENCIAS DE INMEDIATO';
        elseif ($riesgo === 'medio') $recomendaciones[] = '🟡 Consultar médico en 24-48h';
        else $recomendaciones[] = '🟢 Monitorear en casa';
        $recomendaciones[] = '⚠️ Esto no reemplaza una consulta médica real';
        return implode("\n", $recomendaciones);
    }

    public function render()
    {
        $categorias = SintomaCatalogo::select('categoria')->distinct()->whereNotNull('categoria')->get();
        $sintomas = $this->categoriaActual
            ? SintomaCatalogo::where('categoria', $this->categoriaActual)->get()
            : SintomaCatalogo::all();
        return view('livewire.consulta-guiada', compact('categorias', 'sintomas'));
    }
}
