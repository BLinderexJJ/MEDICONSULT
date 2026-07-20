<x-mediconsult-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.medicamentos') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">&larr; Volver</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">{{ isset($medicamento) ? 'Editar' : 'Nuevo' }} Medicamento</h2>

            <form method="POST" action="{{ isset($medicamento) ? route('admin.medicamentos.update', $medicamento) : route('admin.medicamentos.store') }}">
                @csrf
                @if(isset($medicamento)) @method('PUT') @endif

                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $medicamento->nombre ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Principio Activo *</label>
                        <input type="text" name="principio_activo" value="{{ old('principio_activo', $medicamento->principio_activo ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Indicaciones</label>
                        <textarea name="indicaciones" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('indicaciones', $medicamento->indicaciones ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contraindicaciones</label>
                        <textarea name="contraindicaciones" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('contraindicaciones', $medicamento->contraindicaciones ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Efectos secundarios</label>
                        <textarea name="efectos_secundarios" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('efectos_secundarios', $medicamento->efectos_secundarios ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dosis referencial</label>
                        <textarea name="dosis_referencia" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('dosis_referencia', $medicamento->dosis_referencia ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Interacciones</label>
                        <textarea name="interacciones" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('interacciones', $medicamento->interacciones ?? '') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold transition">
                    {{ isset($medicamento) ? 'Actualizar' : 'Crear' }} Medicamento
                </button>
            </form>
        </div>
    </div>
</x-mediconsult-layout>
