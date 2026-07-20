<x-mediconsult-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Verificador de Medicamentos</h1>
            <p class="text-gray-500 mt-1">Consulta información y compatibilidad de medicamentos</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Buscador y lista --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Buscar medicamento</h3>
                <form method="GET" class="mb-4">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Ej: Paracetamol..." 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                </form>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    @foreach($medicamentosLista as $med)
                        <a href="{{ route('medicamentos.verificador', ['q' => $med->nombre]) }}" 
                           class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition {{ $query === $med->nombre ? 'bg-emerald-50 border border-emerald-200' : 'border border-transparent' }}">
                            <p class="font-medium text-gray-900">{{ $med->nombre }}</p>
                            <p class="text-sm text-gray-500">{{ $med->principio_activo }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Detalle --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                @if($medDetalle)
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $medDetalle->nombre }}</h3>
                    <p class="text-sm text-emerald-600 font-medium mb-4">Principio activo: {{ $medDetalle->principio_activo }}</p>

                    <div class="space-y-4">
                        @if($medDetalle->indicaciones)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Indicaciones</h4>
                                <p class="text-gray-600 text-sm">{{ $medDetalle->indicaciones }}</p>
                            </div>
                        @endif
                        @if($medDetalle->contraindicaciones)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Contraindicaciones</h4>
                                <p class="text-gray-600 text-sm">{{ $medDetalle->contraindicaciones }}</p>
                            </div>
                        @endif
                        @if($medDetalle->efectos_secundarios)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Efectos secundarios</h4>
                                <p class="text-gray-600 text-sm">{{ $medDetalle->efectos_secundarios }}</p>
                            </div>
                        @endif
                        @if($medDetalle->dosis_referencia)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Dosis referencial</h4>
                                <p class="text-gray-600 text-sm">{{ $medDetalle->dosis_referencia }}</p>
                            </div>
                        @endif
                        @if($medDetalle->interacciones)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Interacciones</h4>
                                <p class="text-gray-600 text-sm">{{ $medDetalle->interacciones }}</p>
                            </div>
                        @endif

                        {{-- Compatibilidad con perfil --}}
                        <div class="border-t border-gray-100 pt-4 mt-4">
                            <h4 class="font-semibold text-gray-900 mb-3">Compatibilidad con tu perfil</h4>

                            @if($compatible)
                                <div class="flex items-center space-x-2 text-green-700 bg-green-50 p-3 rounded-lg">
                                    <span>✅</span>
                                    <span class="font-medium">Compatible con tu perfil</span>
                                </div>
                            @else
                                <div class="space-y-2">
                                    @foreach($incompatibilidades as $inc)
                                        <div class="flex items-center space-x-2 text-red-700 bg-red-50 p-3 rounded-lg">
                                            <span>❌</span>
                                            <span class="font-medium">{{ $inc }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-gray-500">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <p>Selecciona un medicamento para ver su información</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Comparador --}}
        <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Comparador de Medicamentos</h3>
            <form method="GET" action="{{ route('medicamentos.comparador') }}" class="grid md:grid-cols-2 gap-4">
                <select name="m1" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="">Seleccionar medicamento 1</option>
                    @foreach($medicamentosCatalogo as $m)
                        <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                    @endforeach
                </select>
                <select name="m2" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="">Seleccionar medicamento 2</option>
                    @foreach($medicamentosCatalogo as $m)
                        <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                    @endforeach
                </select>
                <div class="md:col-span-2">
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                        Comparar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-mediconsult-layout>
