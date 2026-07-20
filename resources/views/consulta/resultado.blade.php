<x-mediconsult-layout>
    @php
        $consulta = \App\Models\Consulta::findOrFail($id);
    @endphp
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('historial') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">&larr; Volver al historial</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-emerald-500 to-teal-500">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-white">Resultado de Consulta</h2>
                    <span class="text-sm text-white/80">{{ $consulta->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="p-6 space-y-6">
                {{-- Riesgo --}}
                <div class="text-center">
                    @if($consulta->nivel_riesgo === 'bajo')
                        <span class="inline-flex items-center px-6 py-3 bg-green-100 text-green-800 rounded-full text-xl font-bold">🟢 Riesgo Bajo</span>
                    @elseif($consulta->nivel_riesgo === 'medio')
                        <span class="inline-flex items-center px-6 py-3 bg-yellow-100 text-yellow-800 rounded-full text-xl font-bold">🟡 Riesgo Medio</span>
                    @elseif($consulta->nivel_riesgo === 'alto')
                        <span class="inline-flex items-center px-6 py-3 bg-red-100 text-red-800 rounded-full text-xl font-bold">🔴 Riesgo Alto</span>
                    @endif
                </div>

                {{-- Síntoma principal --}}
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Síntoma principal</h3>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-4">{{ $consulta->sintoma_principal }}</p>
                </div>

                @if($consulta->descripcion)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Descripción</h3>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-4">{{ $consulta->descripcion }}</p>
                </div>
                @endif

                {{-- Síntomas adicionales --}}
                @if($consulta->sintomas->count() > 0)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Síntomas registrados</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($consulta->sintomas as $sintoma)
                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-sm font-medium">
                                {{ $sintoma->nombre_sintoma }}
                                @if($sintoma->intensidad)
                                    ({{ $sintoma->intensidad }})
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Causas --}}
                @if($consulta->posibles_causas)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Posibles causas</h3>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-4">{{ $consulta->posibles_causas }}</p>
                </div>
                @endif

                {{-- Recomendaciones --}}
                @if($consulta->recomendaciones_generales)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Recomendaciones</h3>
                    <div class="text-gray-700 bg-emerald-50 rounded-lg p-4 whitespace-pre-line">{{ $consulta->recomendaciones_generales }}</div>
                </div>
                @endif

                {{-- Acciones --}}
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('consulta.chat') }}" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                        Nueva consulta
                    </a>
                    <a href="{{ route('medicamentos.verificador') }}" class="px-6 py-2.5 bg-white text-emerald-700 border border-emerald-300 rounded-lg hover:bg-emerald-50 font-medium transition">
                        Verificar medicamentos
                    </a>
                    <a href="{{ route('seguimiento') }}?consulta={{ $consulta->id }}" class="px-6 py-2.5 bg-white text-teal-700 border border-teal-300 rounded-lg hover:bg-teal-50 font-medium transition">
                        Dar seguimiento
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-mediconsult-layout>
