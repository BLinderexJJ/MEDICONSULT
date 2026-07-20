<x-mediconsult-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Centro de Alertas</h1>
            <p class="text-gray-500 mt-1">Notificaciones importantes sobre tu salud</p>
        </div>

        @php
            $alertas = auth()->user()->alertas()->latest()->get();
        @endphp

        @if($alertas->count() === 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-16 h-16 text-green-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-gray-500">No tienes alertas pendientes</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($alertas as $alerta)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 
                        {{ $alerta->tipo === 'danger' ? 'border-l-4 border-l-red-500' : ($alerta->tipo === 'warning' ? 'border-l-4 border-l-yellow-500' : 'border-l-4 border-l-blue-500') }}">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    @if($alerta->tipo === 'danger')
                                        <span class="text-red-500">🔴</span>
                                    @elseif($alerta->tipo === 'warning')
                                        <span class="text-yellow-500">🟡</span>
                                    @else
                                        <span class="text-blue-500">🔵</span>
                                    @endif
                                    <h3 class="font-semibold text-gray-900">{{ $alerta->titulo }}</h3>
                                </div>
                                <p class="text-sm text-gray-600">{{ $alerta->descripcion }}</p>
                                <p class="text-xs text-gray-400 mt-2">{{ $alerta->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            @if(!$alerta->leida)
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-medium">Nueva</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-mediconsult-layout>
