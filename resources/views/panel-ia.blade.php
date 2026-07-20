<x-mediconsult-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Panel de Inteligencia Artificial</h1>
            <p class="text-gray-500 mt-1">Estadísticas y tendencias del sistema</p>
        </div>

        {{-- Cards --}}
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <p class="text-sm text-gray-500 mb-1">Usuarios registrados</p>
                <p class="text-3xl font-bold text-gray-900">{{ $userCount }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <p class="text-sm text-gray-500 mb-1">Consultas realizadas</p>
                <p class="text-3xl font-bold text-gray-900">{{ $consultaCount }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <p class="text-sm text-gray-500 mb-1">Alertas generadas</p>
                <p class="text-3xl font-bold text-gray-900">{{ $alertasCount }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <p class="text-sm text-gray-500 mb-1">Alertas activas</p>
                <p class="text-3xl font-bold text-gray-900">{{ $alertasActivasCount }}</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Síntomas frecuentes --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Síntomas más frecuentes</h3>
                <div class="space-y-3">
                    @foreach($sintomasFrecuentes as $sintoma)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">{{ $sintoma->nombre_sintoma }}</span>
                            <div class="flex items-center space-x-2">
                                <div class="w-32 bg-gray-100 rounded-full h-2">
                                    @php
                                        $max = $sintomasFrecuentes->first()->total ?? 1;
                                        $pct = ($sintoma->total / $max) * 100;
                                    @endphp
                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $sintoma->total }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Distribución de riesgos --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Distribución de niveles de riesgo</h3>
                <div class="space-y-4">
                    @foreach($riesgos as $riesgo)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">
                                {{ $riesgo->nivel_riesgo ? ucfirst($riesgo->nivel_riesgo) : 'Sin definir' }}
                            </span>
                            <div class="flex items-center space-x-2">
                                <div class="w-32 bg-gray-100 rounded-full h-2">
                                    @php
                                        $maxR = $riesgos->max('total');
                                        $pctR = $maxR > 0 ? ($riesgo->total / $maxR) * 100 : 0;
                                    @endphp
                                    <div class="h-2 rounded-full 
                                        {{ $riesgo->nivel_riesgo === 'bajo' ? 'bg-green-500' : ($riesgo->nivel_riesgo === 'medio' ? 'bg-yellow-500' : 'bg-red-500') }}"
                                         style="width: {{ $pctR }}%">
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $riesgo->total }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Predicción --}}
        <div class="mt-6 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl p-8 text-white">
            <h3 class="text-xl font-bold mb-3">🤖 Predicción del sistema</h3>
            <p class="text-white/90">
                Basado en el análisis de {{ $consultaCount }} consultas realizadas, los usuarios con síntomas similares 
                a los registrados suelen requerir evaluación médica profesional en un plazo de 48 horas 
                cuando presentan 3 o más síntomas concurrentes.
            </p>
            <div class="mt-4 grid md:grid-cols-3 gap-4">
                <div class="bg-white/10 rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ number_format($consultaCount > 0 ? ($riesgos->where('nivel_riesgo', 'bajo')->first()?->total ?? 0) / $consultaCount * 100 : 0, 1) }}%</p>
                    <p class="text-sm text-white/80">Consultas de bajo riesgo</p>
                </div>
                <div class="bg-white/10 rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ number_format($consultaCount > 0 ? ($riesgos->where('nivel_riesgo', 'medio')->first()?->total ?? 0) / $consultaCount * 100 : 0, 1) }}%</p>
                    <p class="text-sm text-white/80">Consultas de riesgo medio</p>
                </div>
                <div class="bg-white/10 rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ number_format($consultaCount > 0 ? ($riesgos->where('nivel_riesgo', 'alto')->first()?->total ?? 0) / $consultaCount * 100 : 0, 1) }}%</p>
                    <p class="text-sm text-white/80">Consultas de alto riesgo</p>
                </div>
            </div>
        </div>
    </div>
</x-mediconsult-layout>
