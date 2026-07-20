<x-mediconsult-layout>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Biblioteca de Medicamentos</h1>
            <p class="text-gray-500 mt-1">Base de conocimiento de medicamentos</p>
        </div>

        @php
            $medicamentos = \App\Models\MedicamentoCatalogo::paginate(12);
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($medicamentos as $med)
                <a href="{{ route('medicamentos.verificador', ['q' => $med->nombre]) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-emerald-200 transition">
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $med->nombre }}</h3>
                    <p class="text-sm text-emerald-600 mb-3">{{ $med->principio_activo }}</p>
                    <p class="text-sm text-gray-600">{{ Str::limit($med->indicaciones, 80) }}</p>
                    <div class="mt-3 flex flex-wrap gap-1">
                        @if($med->contraindicaciones && stripos($med->contraindicaciones, 'gastritis') !== false)
                            <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs">⚠️ Gastritis</span>
                        @endif
                        @if($med->interacciones)
                            <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded text-xs">⚠️ Interacciones</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $medicamentos->links() }}
        </div>
    </div>
</x-mediconsult-layout>
