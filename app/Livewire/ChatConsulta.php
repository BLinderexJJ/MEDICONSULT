<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Consulta;
use App\Models\ConsultaSintoma;
use App\Models\SintomaCatalogo;
use App\Models\Alerta;

class ChatConsulta extends Component
{
    public $mensajes = [];
    public $mensajeActual = '';
    public $consultaId = null;
    public $paso = 0;
    public $sintomaPrincipal = '';
    public $descripcion = '';
    public $sintomasSeleccionados = [];
    public $intensidades = [];
    public $duraciones = [];
    public $mostrarPreguntas = false;

    public function mount()
    {
        $this->mensajes[] = [
            'tipo' => 'bot',
            'texto' => '¡Hola! Soy el asistente médico de MediConsult. Describe tus síntomas para recibir orientación preliminar.',
        ];

        if (auth()->user()->enfermedades->count() > 0 || auth()->user()->alergias->count() > 0) {
            $this->mensajes[] = [
                'tipo' => 'bot',
                'texto' => 'He revisado tu perfil clínico. Tomaré en cuenta tus condiciones preexistentes y alergias durante el análisis.',
            ];
        }
    }

    public function enviarMensaje()
    {
        if (empty(trim($this->mensajeActual))) return;

        $texto = trim($this->mensajeActual);
        $this->mensajes[] = ['tipo' => 'user', 'texto' => $texto];
        $this->mensajeActual = '';

        if ($this->paso === 0) {
            $this->sintomaPrincipal = $texto;
            $this->mensajes[] = [
                'tipo' => 'bot',
                'texto' => '¿Podrías describir con más detalle tus síntomas? Por ejemplo, ¿desde cuándo los tienes y cómo han evolucionado?',
            ];
            $this->paso = 1;
        } elseif ($this->paso === 1) {
            $this->descripcion = $texto;
            $this->mensajes[] = [
                'tipo' => 'bot',
                'texto' => 'Gracias. Selecciona los síntomas adicionales que presentas para un mejor análisis:',
            ];
            $this->mostrarPreguntas = true;
            $this->paso = 2;
        }
    }

    public function toggleSintoma($sintomaId)
    {
        if (in_array($sintomaId, $this->sintomasSeleccionados)) {
            $this->sintomasSeleccionados = array_diff($this->sintomasSeleccionados, [$sintomaId]);
            unset($this->intensidades[$sintomaId]);
            unset($this->duraciones[$sintomaId]);
        } else {
            $this->sintomasSeleccionados[] = $sintomaId;
        }
    }

    public function finalizarSintomas()
    {
        $this->mensajes[] = [
            'tipo' => 'bot',
            'texto' => 'Perfecto. Estoy analizando tus síntomas según tu perfil clínico...',
        ];

        $this->analizarConsulta();
        $this->mostrarPreguntas = false;
    }

    public function analizarConsulta()
    {
        $user = auth()->user();

        $sintomasTexto = collect($this->sintomasSeleccionados)
            ->map(fn($id) => SintomaCatalogo::find($id)?->nombre)
            ->filter()->implode(', ');

        $riesgo = $this->calcularRiesgo();
        $causas = $this->generarCausas();
        $recomendaciones = $this->generarRecomendaciones($riesgo);

        $consulta = Consulta::create([
            'user_id' => $user->id,
            'tipo' => 'libre',
            'sintoma_principal' => $this->sintomaPrincipal,
            'descripcion' => $this->descripcion,
            'nivel_riesgo' => $riesgo,
            'posibles_causas' => $causas,
            'recomendaciones_generales' => $recomendaciones,
        ]);

        foreach ($this->sintomasSeleccionados as $sintomaId) {
            ConsultaSintoma::create([
                'consulta_id' => $consulta->id,
                'sintoma_id' => $sintomaId,
                'nombre_sintoma' => SintomaCatalogo::find($sintomaId)?->nombre ?? 'desconocido',
                'intensidad' => $this->intensidades[$sintomaId] ?? 'moderado',
                'duracion_dias' => $this->duraciones[$sintomaId] ?? null,
            ]);
        }

        $this->consultaId = $consulta->id;

        $this->verificarAlertas($user, $consulta);

        $this->mensajes[] = [
            'tipo' => 'resultado',
            'consultaId' => $consulta->id,
            'riesgo' => $riesgo,
            'causas' => $causas,
            'recomendaciones' => $recomendaciones,
        ];
    }

    private function calcularRiesgo()
    {
        $user = auth()->user();
        $score = 0;

        $palabrasAltoRiesgo = ['dificultad respirar', 'dolor pecho', 'desmayo', 'convulsión', 'sangrado', 'fiebre alta', 'vómito sangre'];
        foreach ($palabrasAltoRiesgo as $palabra) {
            if (stripos($this->descripcion, $palabra) !== false || stripos($this->sintomaPrincipal, $palabra) !== false) {
                $score += 3;
            }
        }

        if ($user->enfermedades->count() > 0) $score += 1;
        if ($user->edad >= 60) $score += 1;
        if (count($this->sintomasSeleccionados) >= 4) $score += 1;

        if ($score >= 4) return 'alto';
        if ($score >= 2) return 'medio';
        return 'bajo';
    }

    private function generarCausas()
    {
        $causas = [];

        $mapaSintomas = [
            'fiebre' => 'Infección viral o bacteriana',
            'tos' => 'Infección respiratoria',
            'dolor de cabeza' => 'Cefalea tensional o migraña',
            'dolor de garganta' => 'Faringitis o amigdalitis',
            'dolor muscular' => 'Mialgia por esfuerzo o infección',
            'náuseas' => 'Trastorno digestivo',
            'diarrea' => 'Gastroenteritis',
            'congestión nasal' => 'Rinitis o sinusitis',
            'fatiga' => 'Posible cuadro viral',
        ];

        $sintomaPrincipalLower = strtolower($this->sintomaPrincipal);
        foreach ($mapaSintomas as $key => $causa) {
            if (stripos($sintomaPrincipalLower, $key) !== false) {
                $causas[] = $causa;
            }
        }

        foreach ($this->sintomasSeleccionados as $sintomaId) {
            $sintoma = SintomaCatalogo::find($sintomaId);
            if ($sintoma && isset($mapaSintomas[strtolower($sintoma->nombre)])) {
                $causa = $mapaSintomas[strtolower($sintoma->nombre)];
                if (!in_array($causa, $causas)) $causas[] = $causa;
            }
        }

        if (empty($causas)) $causas[] = 'Síntomas inespecíficos que requieren evaluación';

        return implode(', ', array_slice($causas, 0, 3));
    }

    private function generarRecomendaciones($riesgo)
    {
        $recomendaciones = [];
        $recomendaciones[] = 'Mantener hidratación adecuada';
        $recomendaciones[] = 'Descanso suficiente';

        $lowerDesc = strtolower($this->descripcion . ' ' . $this->sintomaPrincipal);
        if (stripos($lowerDesc, 'fiebre') !== false) {
            $recomendaciones[] = 'Tomar paracetamol (si no hay contraindicación)';
        }
        if (stripos($lowerDesc, 'tos') !== false) {
            $recomendaciones[] = 'Realizar nebulizaciones con solución salina';
        }
        if (stripos($lowerDesc, 'dolor') !== false) {
            $recomendaciones[] = 'Aplicar compresas frías o calientes según el tipo de dolor';
        }

        if ($riesgo === 'alto') {
            $recomendaciones[] = '🔴 ACUDIR A EMERGENCIAS MÉDICAS DE INMEDIATO';
        } elseif ($riesgo === 'medio') {
            $recomendaciones[] = '🟡 Consultar a un médico en las próximas 24-48 horas';
        } else {
            $recomendaciones[] = '🟢 Monitorear síntomas en casa';
        }

        $recomendaciones[] = '⚠️ Este sistema no reemplaza a un médico. Ante cualquier emergencia, acuda al centro de salud más cercano.';

        return implode("\n", $recomendaciones);
    }

    private function verificarAlertas($user, $consulta)
    {
        $lowerDesc = strtolower($this->descripcion . ' ' . $this->sintomaPrincipal);

        foreach ($user->alergias as $alergia) {
            $nombreAlergia = strtolower($alergia->nombre);
            if (stripos($lowerDesc, $nombreAlergia) !== false) {
                Alerta::create([
                    'user_id' => $user->id,
                    'titulo' => 'Alergia detectada',
                    'descripcion' => "Tienes registrada alergia a {$alergia->nombre}. Ten precaución.",
                    'tipo' => 'danger',
                    'categoria' => 'alergia',
                ]);
            }
        }
    }

    public function render()
    {
        $sintomas = SintomaCatalogo::all();
        return view('livewire.chat-consulta', [
            'sintomas' => $sintomas,
            'sintomasDisponibles' => $sintomas,
        ]);
    }
}
