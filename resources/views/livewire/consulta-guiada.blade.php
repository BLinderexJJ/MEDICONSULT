<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @if($paso === 0)
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Consulta Guiada</h2>
                <p class="text-gray-500">Selecciona tus síntomas para un análisis rápido</p>
            </div>

            {{-- Categorías --}}
            <div class="flex flex-wrap gap-2 mb-6 justify-center">
                <button wire:click="seleccionarCategoria(null)" 
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ is_null($categoriaActual) ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Todos
                </button>
                @foreach($categorias as $cat)
                    <button wire:click="seleccionarCategoria('{{ $cat->categoria }}')"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                            {{ $categoriaActual === $cat->categoria ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ ucfirst($cat->categoria) }}
                    </button>
                @endforeach
            </div>

            {{-- Síntomas --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-6">
                @foreach($sintomas as $sintoma)
                    <button wire:click="toggleSintoma({{ $sintoma->id }})"
                            class="p-4 rounded-xl border-2 text-center transition
                            {{ in_array($sintoma->id, $sintomasSeleccionados) 
                                ? 'border-emerald-500 bg-emerald-50 text-emerald-700' 
                                : 'border-gray-200 hover:border-emerald-300 text-gray-700' }}">
                        <span class="block text-sm font-medium">{{ $sintoma->nombre }}</span>
                    </button>
                @endforeach
            </div>

            @if(count($sintomasSeleccionados) > 0)
                <div class="text-center">
                    <button wire:click="siguientePaso" class="px-8 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold transition">
                        Continuar ({{ count($sintomasSeleccionados) }} seleccionados)
                    </button>
                </div>
            @endif

        @elseif($paso === 1)
            <div class="max-w-md mx-auto">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Detalles adicionales</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Intensidad de los síntomas</label>
                        <select wire:model="intensidad" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                            <option value="leve">Leve</option>
                            <option value="moderado">Moderado</option>
                            <option value="severo">Severo</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Desde cuándo?</label>
                        <select wire:model="duracion" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                            <option value="">Seleccionar...</option>
                            <option value="1">Hoy</option>
                            <option value="2">2 días</option>
                            <option value="3">3 días</option>
                            <option value="5">5 días</option>
                            <option value="7">1 semana</option>
                            <option value="14">2 semanas</option>
                            <option value="30">1 mes o más</option>
                        </select>
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button wire:click="$set('paso', 0)" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition">
                            Atrás
                        </button>
                        <button wire:click="analizar" class="flex-1 px-4 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                            Analizar
                        </button>
                    </div>
                </div>
            </div>

        @elseif($paso === 2 && $resultado)
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-6">
                    @if($resultado['riesgo'] === 'bajo')
                        <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-lg font-semibold">🟢 Riesgo Bajo</span>
                    @elseif($resultado['riesgo'] === 'medio')
                        <span class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-lg font-semibold">🟡 Riesgo Medio</span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-full text-lg font-semibold">🔴 Riesgo Alto</span>
                    @endif
                </div>

                <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Posibles causas</h4>
                        <p class="text-gray-700">{{ $resultado['causas'] }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Recomendaciones</h4>
                        <div class="text-gray-700 whitespace-pre-line">{{ $resultado['recomendaciones'] }}</div>
                    </div>
                </div>

                <div class="flex space-x-3 mt-6">
                    <a href="{{ route('consulta.resultado', $consultaId) }}" class="flex-1 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold text-center transition">
                        Ver detalle completo
                    </a>
                    <a href="{{ route('consulta.guiada') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-semibold transition">
                        Nueva consulta
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
