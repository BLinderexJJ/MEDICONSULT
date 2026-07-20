<x-mediconsult-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Seguimiento de Síntomas</h1>
            <p class="text-gray-500 mt-1">Registra cómo te sientes hoy</p>
        </div>

        @php
            $ultimaConsulta = auth()->user()->consultas()->latest()->first();
            $seguimientos = auth()->user()->seguimientos()->latest()->take(10)->get();
        @endphp

        <div class="grid md:grid-cols-2 gap-6 mb-8">
            {{-- Estado actual --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">¿Cómo te encuentras hoy?</h3>
                @if($ultimaConsulta)
                    <p class="text-sm text-gray-500 mb-4">Basado en tu consulta del {{ $ultimaConsulta->created_at->format('d/m/Y') }}</p>
                @endif
                <form method="POST" action="{{ route('seguimiento.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="consulta_id" value="{{ $ultimaConsulta?->id }}">
                    <div class="flex flex-wrap gap-3">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="estado" value="mejor" class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-green-300 transition">
                                <span class="text-2xl">😊</span>
                                <p class="text-sm font-medium text-gray-700 mt-1">Mejor</p>
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="estado" value="igual" class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:border-yellow-300 transition">
                                <span class="text-2xl">😐</span>
                                <p class="text-sm font-medium text-gray-700 mt-1">Igual</p>
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="estado" value="peor" class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-red-300 transition">
                                <span class="text-2xl">😢</span>
                                <p class="text-sm font-medium text-gray-700 mt-1">Peor</p>
                            </div>
                        </label>
                    </div>
                    <textarea name="notas" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Notas adicionales..."></textarea>
                    <button type="submit" class="w-full px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                        Registrar
                    </button>
                </form>
            </div>

            {{-- Historial de seguimientos --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Historial de seguimiento</h3>
                @forelse($seguimientos as $seguimiento)
                    <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                        <div class="flex items-center space-x-3">
                            @if($seguimiento->estado === 'mejor')
                                <span class="text-xl">😊</span>
                            @elseif($seguimiento->estado === 'igual')
                                <span class="text-xl">😐</span>
                            @else
                                <span class="text-xl">😢</span>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ ucfirst($seguimiento->estado) }}</p>
                                <p class="text-xs text-gray-500">{{ $seguimiento->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        @if($seguimiento->notas)
                            <span class="text-xs text-gray-400 max-w-[120px] truncate">{{ $seguimiento->notas }}</span>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-8">Aún no has registrado seguimientos</p>
                @endforelse
            </div>
        </div>
    </div>
</x-mediconsult-layout>
