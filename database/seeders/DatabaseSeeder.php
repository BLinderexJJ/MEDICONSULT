<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AlergiaCatalogo;
use App\Models\EnfermedadCatalogo;
use App\Models\MedicamentoCatalogo;
use App\Models\SintomaCatalogo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@mediconsult.com'],
            [
                'name' => 'Admin',
                'apellido' => 'Sistema',
                'password' => bcrypt('admin123'),
                'dni' => '00000001',
                'rol' => 'admin',
                'telefono' => '999999999',
            ]
        );

        $alergias = ['Penicilina', 'Ibuprofeno', 'Sulfas', 'Aspirina', 'Paracetamol', 'Amoxicilina', 'Naproxeno', 'Codeína', 'Morfina', 'Insulina'];
        foreach ($alergias as $a) {
            AlergiaCatalogo::firstOrCreate(
                ['nombre' => $a],
                ['tipo' => 'medicamento']
            );
        }

        $enfermedades = [
            ['nombre' => 'Diabetes Tipo 1', 'descripcion' => 'Enfermedad autoinmune donde el páncreas no produce insulina'],
            ['nombre' => 'Diabetes Tipo 2', 'descripcion' => 'Trastorno metabólico caracterizado por resistencia a la insulina'],
            ['nombre' => 'Hipertensión Arterial', 'descripcion' => 'Presión arterial elevada de forma crónica'],
            ['nombre' => 'Asma', 'descripcion' => 'Enfermedad inflamatoria de las vías respiratorias'],
            ['nombre' => 'Gastritis', 'descripcion' => 'Inflamación del revestimiento del estómago'],
            ['nombre' => 'Epilepsia', 'descripcion' => 'Trastorno neurológico que causa convulsiones recurrentes'],
            ['nombre' => 'Artritis Reumatoide', 'descripcion' => 'Enfermedad autoinmune que afecta las articulaciones'],
            ['nombre' => 'Enfermedad Renal Crónica', 'descripcion' => 'Pérdida progresiva de la función renal'],
            ['nombre' => 'Hipotiroidismo', 'descripcion' => 'Producción insuficiente de hormonas tiroideas'],
            ['nombre' => 'EPOC', 'descripcion' => 'Enfermedad pulmonar obstructiva crónica'],
        ];
        foreach ($enfermedades as $e) {
            EnfermedadCatalogo::firstOrCreate(
                ['nombre' => $e['nombre']],
                ['descripcion' => $e['descripcion']]
            );
        }

        $this->call(MedicamentoCatalogoSeeder::class);

        $sintomas = [
            ['nombre' => 'Fiebre', 'categoria' => 'generales'],
            ['nombre' => 'Tos', 'categoria' => 'respiratorio'],
            ['nombre' => 'Dolor de cabeza', 'categoria' => 'neurologico'],
            ['nombre' => 'Náuseas', 'categoria' => 'digestivo'],
            ['nombre' => 'Dolor muscular', 'categoria' => 'musculoesqueletico'],
            ['nombre' => 'Dolor de garganta', 'categoria' => 'respiratorio'],
            ['nombre' => 'Congestión nasal', 'categoria' => 'respiratorio'],
            ['nombre' => 'Diarrea', 'categoria' => 'digestivo'],
            ['nombre' => 'Vómitos', 'categoria' => 'digestivo'],
            ['nombre' => 'Fatiga', 'categoria' => 'generales'],
            ['nombre' => 'Dolor abdominal', 'categoria' => 'digestivo'],
            ['nombre' => 'Dificultad para respirar', 'categoria' => 'respiratorio'],
            ['nombre' => 'Mareos', 'categoria' => 'neurologico'],
            ['nombre' => 'Dolor en el pecho', 'categoria' => 'cardiovascular'],
            ['nombre' => 'Erupción cutánea', 'categoria' => 'dermatologico'],
            ['nombre' => 'Dolor de oído', 'categoria' => 'otologico'],
            ['nombre' => 'Estornudos', 'categoria' => 'respiratorio'],
            ['nombre' => 'Escalofríos', 'categoria' => 'generales'],
            ['nombre' => 'Pérdida del olfato', 'categoria' => 'neurologico'],
            ['nombre' => 'Dolor lumbar', 'categoria' => 'musculoesqueletico'],
        ];
        foreach ($sintomas as $s) {
            SintomaCatalogo::firstOrCreate(
                ['nombre' => $s['nombre']],
                ['categoria' => $s['categoria']]
            );
        }
    }
}
