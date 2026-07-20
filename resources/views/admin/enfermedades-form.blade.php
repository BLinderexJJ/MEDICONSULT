<x-mediconsult-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.enfermedades') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">&larr; Volver</a>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">{{ isset($enfermedad) ? 'Editar' : 'Nueva' }} Enfermedad</h2>
            <form method="POST" action="{{ isset($enfermedad) ? route('admin.enfermedades.update', $enfermedad) : route('admin.enfermedades.store') }}">
                @csrf
                @if(isset($enfermedad)) @method('PUT') @endif

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $enfermedad->nombre ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('descripcion', $enfermedad->descripcion ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Síntomas</label>
                        <textarea name="sintomas" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('sintomas', $enfermedad->sintomas ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prevención</label>
                        <textarea name="prevencion" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('prevencion', $enfermedad->prevencion ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cuándo acudir al médico</label>
                        <textarea name="cuando_acudir" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('cuando_acudir', $enfermedad->cuando_acudir ?? '') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold transition">
                    {{ isset($enfermedad) ? 'Actualizar' : 'Crear' }} Enfermedad
                </button>
            </form>
        </div>
    </div>
</x-mediconsult-layout>
