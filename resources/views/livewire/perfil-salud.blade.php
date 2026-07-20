<div class="max-w-4xl mx-auto">
    @if($mensaje)
        <div class="mb-4 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-lg border border-emerald-200 font-medium">
            {{ $mensaje }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Mi Perfil de Salud</h2>

        <form wire:submit="guardar" class="space-y-8">
            {{-- Datos Personales --}}
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Datos Personales</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombres</label>
                        <input type="text" wire:model="name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
                        <input type="text" wire:model="apellido" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">DNI</label>
                        <input type="text" wire:model="dni" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" wire:model="telefono" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                        <input type="date" wire:model="fecha_nacimiento" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                        <select wire:model="sexo" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                            <option value="">Seleccionar</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>
            </section>

            {{-- Datos Físicos --}}
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Datos Físicos</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Peso (kg)</label>
                        <input type="number" step="0.1" wire:model="peso" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Altura (cm)</label>
                        <input type="number" step="0.1" wire:model="altura" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                </div>
            </section>

            {{-- Alergias --}}
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Alergias</h3>
                <input type="text" wire:model.live="buscarAlergia" placeholder="Buscar alergia..." class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                <div class="flex flex-wrap gap-2">
                    @foreach($alergias as $alergia)
                        <button type="button" wire:click="toggleAlergia({{ $alergia->id }})"
                                class="px-3 py-1.5 rounded-full text-sm font-medium border transition
                                {{ in_array($alergia->id, $alergiasSeleccionadas) ? 'bg-red-100 text-red-800 border-red-300' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-red-300' }}">
                            {{ $alergia->nombre }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Enfermedades --}}
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Enfermedades</h3>
                <input type="text" wire:model.live="buscarEnfermedad" placeholder="Buscar enfermedad..." class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                <div class="flex flex-wrap gap-2">
                    @foreach($enfermedades as $enfermedad)
                        <button type="button" wire:click="toggleEnfermedad({{ $enfermedad->id }})"
                                class="px-3 py-1.5 rounded-full text-sm font-medium border transition
                                {{ in_array($enfermedad->id, $enfermedadesSeleccionadas) ? 'bg-amber-100 text-amber-800 border-amber-300' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-amber-300' }}">
                            {{ $enfermedad->nombre }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Medicamentos --}}
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Medicamentos actuales</h3>
                <input type="text" wire:model.live="buscarMedicamento" placeholder="Buscar medicamento..." class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                <div class="flex flex-wrap gap-2">
                    @foreach($medicamentos as $med)
                        <button type="button" wire:click="toggleMedicamento({{ $med->id }})"
                                class="px-3 py-1.5 rounded-full text-sm font-medium border transition
                                {{ in_array($med->id, $medicamentosSeleccionados) ? 'bg-blue-100 text-blue-800 border-blue-300' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-blue-300' }}">
                            {{ $med->nombre }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Situaciones --}}
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Situaciones especiales</h3>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" wire:model="situaciones.embarazo" class="w-5 h-5 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                        <span class="text-gray-700">Embarazo</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" wire:model="situaciones.lactancia" class="w-5 h-5 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                        <span class="text-gray-700">Lactancia</span>
                    </label>
                </div>
            </section>

            <div class="pt-4">
                <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold transition">
                    Guardar Perfil
                </button>
            </div>
        </form>
    </div>
</div>
