<x-mediconsult-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Historial Clínico</h1>
            <p class="text-gray-500 mt-1">Todas tus consultas registradas</p>
        </div>

        @php
            $consultas = auth()->user()->consultas()->latest()->paginate(10);
        @endphp

        @if($consultas->count() === 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p class="text-gray-500 mb-4">No tienes consultas registradas</p>
                <a href="{{ route('consulta.chat') }}" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                    Realizar primera consulta
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($consultas as $consulta)
                    <a href="{{ route('consulta.resultado', $consulta) }}" class="block bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md hover:border-emerald-200 transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-xs font-medium">{{ ucfirst($consulta->tipo) }}</span>
                                    <span class="text-sm text-gray-400">{{ $consulta->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <p class="font-medium text-gray-900">{{ Str::limit($consulta->sintoma_principal ?? 'Consulta sin síntoma principal', 60) }}</p>
                                @if($consulta->descripcion)
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($consulta->descripcion, 100) }}</p>
                                @endif
                            </div>
                            <div class="ml-4">
                                @if($consulta->nivel_riesgo === 'bajo')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">🟢 Bajo</span>
                                @elseif($consulta->nivel_riesgo === 'medio')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">🟡 Medio</span>
                                @elseif($consulta->nivel_riesgo === 'alto')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">🔴 Alto</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">Pendiente</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $consultas->links() }}
            </div>
        @endif
    </div>
</x-mediconsult-layout>
