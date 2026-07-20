<x-mediconsult-layout>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Biblioteca de Enfermedades</h1>
            <p class="text-gray-500 mt-1">Información sobre enfermedades comunes</p>
        </div>

        @php
            $enfermedades = \App\Models\EnfermedadCatalogo::paginate(10);
        @endphp

        <div class="grid md:grid-cols-2 gap-6">
            @foreach($enfermedades as $enf)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $enf->nombre }}</h3>
                    @if($enf->descripcion)
                        <div class="mb-3">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">¿Qué es?</h4>
                            <p class="text-sm text-gray-600">{{ $enf->descripcion }}</p>
                        </div>
                    @endif
                    @if($enf->sintomas)
                        <div class="mb-3">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Síntomas</h4>
                            <p class="text-sm text-gray-600">{{ $enf->sintomas }}</p>
                        </div>
                    @endif
                    @if($enf->prevencion)
                        <div class="mb-3">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-1">Prevención</h4>
                            <p class="text-sm text-gray-600">{{ $enf->prevencion }}</p>
                        </div>
                    @endif
                    @if($enf->cuando_acudir)
                        <div class="bg-amber-50 rounded-lg p-3">
                            <h4 class="text-sm font-semibold text-amber-800 uppercase mb-1">Cuándo acudir al médico</h4>
                            <p class="text-sm text-amber-700">{{ $enf->cuando_acudir }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $enfermedades->links() }}
        </div>
    </div>
</x-mediconsult-layout>
