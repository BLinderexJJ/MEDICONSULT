<x-mediconsult-layout>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('medicamentos.verificador') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">&larr; Volver al verificador</a>
        </div>

        @php
            $m1 = request('m1') ? \App\Models\MedicamentoCatalogo::find(request('m1')) : null;
            $m2 = request('m2') ? \App\Models\MedicamentoCatalogo::find(request('m2')) : null;
        @endphp

        @if($m1 && $m2)
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Comparación: {{ $m1->nombre }} vs {{ $m2->nombre }}</h1>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 w-1/4">Característica</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">{{ $m1->nombre }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-700">{{ $m2->nombre }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Principio activo</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m1->principio_activo }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m2->principio_activo }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Indicaciones</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m1->indicaciones ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m2->indicaciones ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Contraindicaciones</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m1->contraindicaciones ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m2->contraindicaciones ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Efectos secundarios</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m1->efectos_secundarios ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m2->efectos_secundarios ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Dosis referencial</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m1->dosis_referencia ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $m2->dosis_referencia ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Fiebre</td>
                            <td class="px-6 py-4 text-sm {{ stripos($m1->indicaciones ?? '', 'fiebre') !== false ? 'text-green-600' : 'text-gray-500' }}">
                                {{ stripos($m1->indicaciones ?? '', 'fiebre') !== false ? '✅ Sí' : 'No especificado' }}
                            </td>
                            <td class="px-6 py-4 text-sm {{ stripos($m2->indicaciones ?? '', 'fiebre') !== false ? 'text-green-600' : 'text-gray-500' }}">
                                {{ stripos($m2->indicaciones ?? '', 'fiebre') !== false ? '✅ Sí' : 'No especificado' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Inflamación</td>
                            <td class="px-6 py-4 text-sm {{ stripos($m1->indicaciones ?? '', 'inflamación') !== false || stripos($m1->principio_activo, 'ibuprofeno') !== false ? 'text-green-600' : 'text-gray-500' }}">
                                {{ stripos($m1->indicaciones ?? '', 'inflamación') !== false || stripos($m1->principio_activo, 'ibuprofeno') !== false ? '✅ Sí' : 'No especificado' }}
                            </td>
                            <td class="px-6 py-4 text-sm {{ stripos($m2->indicaciones ?? '', 'inflamación') !== false || stripos($m2->principio_activo, 'ibuprofeno') !== false ? 'text-green-600' : 'text-gray-500' }}">
                                {{ stripos($m2->indicaciones ?? '', 'inflamación') !== false || stripos($m2->principio_activo, 'ibuprofeno') !== false ? '✅ Sí' : 'No especificado' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">Gastritis</td>
                            <td class="px-6 py-4 text-sm {{ $m1->contraindicaciones && stripos($m1->contraindicaciones, 'gastritis') !== false ? 'text-red-600' : 'text-green-600' }}">
                                {{ $m1->contraindicaciones && stripos($m1->contraindicaciones, 'gastritis') !== false ? '❌ Riesgo' : '✅ Seguro' }}
                            </td>
                            <td class="px-6 py-4 text-sm {{ $m2->contraindicaciones && stripos($m2->contraindicaciones, 'gastritis') !== false ? 'text-red-600' : 'text-green-600' }}">
                                {{ $m2->contraindicaciones && stripos($m2->contraindicaciones, 'gastritis') !== false ? '❌ Riesgo' : '✅ Seguro' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <p class="text-gray-500">Selecciona dos medicamentos para comparar</p>
                <a href="{{ route('medicamentos.verificador') }}" class="text-emerald-600 hover:text-emerald-700 font-medium mt-2 inline-block">Ir al verificador</a>
            </div>
        @endif
    </div>
</x-mediconsult-layout>
