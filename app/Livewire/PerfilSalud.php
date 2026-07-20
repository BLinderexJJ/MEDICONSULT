<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AlergiaCatalogo;
use App\Models\EnfermedadCatalogo;
use App\Models\MedicamentoCatalogo;

class PerfilSalud extends Component
{
    public $name;
    public $apellido;
    public $dni;
    public $telefono;
    public $fecha_nacimiento;
    public $sexo;
    public $peso;
    public $altura;
    public $alergiasSeleccionadas = [];
    public $enfermedadesSeleccionadas = [];
    public $medicamentosSeleccionados = [];
    public $situaciones = ['embarazo' => false, 'lactancia' => false];
    public $buscarAlergia = '';
    public $buscarEnfermedad = '';
    public $buscarMedicamento = '';
    public $mensaje = null;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->apellido = $user->apellido;
        $this->dni = $user->dni;
        $this->telefono = $user->telefono;
        $this->fecha_nacimiento = $user->fecha_nacimiento?->format('Y-m-d');
        $this->sexo = $user->sexo;
        $this->peso = $user->peso;
        $this->altura = $user->altura;
        $this->alergiasSeleccionadas = $user->alergias->pluck('id')->toArray();
        $this->enfermedadesSeleccionadas = $user->enfermedades->pluck('id')->toArray();
        $this->medicamentosSeleccionados = $user->medicamentos->pluck('id')->toArray();
        foreach ($user->situaciones as $s) {
            if (isset($this->situaciones[$s->situacion])) {
                $this->situaciones[$s->situacion] = true;
            }
        }
    }

    public function toggleAlergia($id)
    {
        $this->alergiasSeleccionadas = in_array($id, $this->alergiasSeleccionadas)
            ? array_diff($this->alergiasSeleccionadas, [$id])
            : array_merge($this->alergiasSeleccionadas, [$id]);
    }

    public function toggleEnfermedad($id)
    {
        $this->enfermedadesSeleccionadas = in_array($id, $this->enfermedadesSeleccionadas)
            ? array_diff($this->enfermedadesSeleccionadas, [$id])
            : array_merge($this->enfermedadesSeleccionadas, [$id]);
    }

    public function toggleMedicamento($id)
    {
        $this->medicamentosSeleccionados = in_array($id, $this->medicamentosSeleccionados)
            ? array_diff($this->medicamentosSeleccionados, [$id])
            : array_merge($this->medicamentosSeleccionados, [$id]);
    }

    public function guardar()
    {
        $user = auth()->user();

        $user->update([
            'name' => $this->name,
            'apellido' => $this->apellido,
            'dni' => $this->dni,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'peso' => $this->peso,
            'altura' => $this->altura,
        ]);

        $user->alergias()->sync($this->alergiasSeleccionadas);
        $user->enfermedades()->sync($this->enfermedadesSeleccionadas);
        $user->medicamentos()->sync($this->medicamentosSeleccionados);

        $user->situaciones()->delete();
        foreach ($this->situaciones as $key => $activa) {
            if ($activa) {
                $user->situaciones()->create([
                    'situacion' => $key,
                    'activa' => true,
                ]);
            }
        }

        $this->mensaje = 'Perfil actualizado correctamente';
    }

    public function render()
    {
        $alergias = AlergiaCatalogo::when($this->buscarAlergia, fn($q) => $q->where('nombre', 'like', "%{$this->buscarAlergia}%"))->get();
        $enfermedades = EnfermedadCatalogo::when($this->buscarEnfermedad, fn($q) => $q->where('nombre', 'like', "%{$this->buscarEnfermedad}%"))->get();
        $medicamentos = MedicamentoCatalogo::when($this->buscarMedicamento, fn($q) => $q->where('nombre', 'like', "%{$this->buscarMedicamento}%"))->get();

        return view('livewire.perfil-salud', compact('alergias', 'enfermedades', 'medicamentos'));
    }
}
