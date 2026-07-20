<x-mediconsult-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Administración de Enfermedades</h1>
                <p class="text-gray-500 mt-1">Gestionar catálogo de enfermedades</p>
            </div>
            <a href="{{ route('admin.enfermedades.create') }}" class="px-4 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                + Nueva enfermedad
            </a>
        </div>

        @php
            $enfermedades = \App\Models\EnfermedadCatalogo::paginate(15);
        @endphp

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nombre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Descripción</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($enfermedades as $enf)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $enf->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($enf->descripcion, 60) }}</td>
                        <td class="px-6 py-4 text-sm text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.enfermedades.edit', $enf) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 font-medium text-xs">Editar</a>
                                <form method="POST" action="{{ route('admin.enfermedades.destroy', $enf) }}" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 font-medium text-xs">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $enfermedades->links() }}</div>
    </div>
</x-mediconsult-layout>
