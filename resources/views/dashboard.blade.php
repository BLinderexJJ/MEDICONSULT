<x-mediconsult-layout>
    <div class="max-w-7xl mx-auto space-y-6 lg:space-y-8">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Bienvenido, {{ auth()->user()->name }}</h1>
                <p class="text-sm sm:text-base text-gray-500 mt-0.5">Panel de control de salud</p>
            </div>
            <a href="{{ route('consulta.chat') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium text-sm transition-colors shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nueva Consulta
            </a>
        </div>

        {{-- Tarjetas principales --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
            {{-- Historial --}}
            <a href="{{ route('historial') }}" class="bg-white rounded-xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-700 text-sm sm:text-base">Historial Clínico</h3>
                        <p class="text-xs sm:text-sm text-gray-500 truncate">Últimas consultas</p>
                    </div>
                </div>
            </a>

            {{-- Perfil de Salud --}}
            <a href="{{ route('perfil-salud') }}" class="bg-white rounded-xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-purple-200 hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-200 transition shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-purple-700 text-sm sm:text-base">Perfil de Salud</h3>
                        <p class="text-xs sm:text-sm text-gray-500 truncate">Información clínica</p>
                    </div>
                </div>
            </a>

            {{-- Medicamentos --}}
            <a href="{{ route('medicamentos.verificador') }}" class="bg-white rounded-xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-amber-200 hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover:bg-amber-200 transition shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-amber-700 text-sm sm:text-base">Medicamentos</h3>
                        <p class="text-xs sm:text-sm text-gray-500 truncate">Verificar y comparar</p>
                    </div>
                </div>
            </a>

            {{-- Biblioteca --}}
            <a href="{{ route('enfermedades.biblioteca') }}" class="bg-white rounded-xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-sky-200 hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-sky-100 rounded-xl flex items-center justify-center group-hover:bg-sky-200 transition shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-sky-700 text-sm sm:text-base">Biblioteca</h3>
                        <p class="text-xs sm:text-sm text-gray-500 truncate">Enfermedades y condiciones</p>
                    </div>
                </div>
            </a>

            {{-- Alertas --}}
            <a href="{{ route('alertas') }}" class="bg-white rounded-xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-red-200 hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-100 rounded-xl flex items-center justify-center group-hover:bg-red-200 transition shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-red-700 text-sm sm:text-base">Alertas</h3>
                        <p class="text-xs sm:text-sm text-gray-500 truncate">Riesgos e interacciones</p>
                    </div>
                </div>
            </a>

            {{-- Seguimiento --}}
            <a href="{{ route('seguimiento') }}" class="bg-white rounded-xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-teal-200 hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-teal-100 rounded-xl flex items-center justify-center group-hover:bg-teal-200 transition shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-teal-700 text-sm sm:text-base">Seguimiento</h3>
                        <p class="text-xs sm:text-sm text-gray-500 truncate">Evolución de síntomas</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Últimas consultas --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">Últimas Consultas</h2>
                <a href="{{ route('historial') }}" class="text-xs sm:text-sm text-emerald-600 hover:text-emerald-700 font-medium">Ver todas</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse(auth()->user()->consultas()->latest()->take(5)->get() as $consulta)
                <a href="{{ route('consulta.resultado', $consulta) }}" class="flex items-center justify-between px-4 sm:px-6 py-3 sm:py-4 hover:bg-gray-50 transition">
                    <div class="min-w-0 flex-1 mr-3">
                        <p class="font-medium text-gray-900 text-sm sm:text-base truncate">{{ Str::limit($consulta->sintoma_principal ?? 'Consulta ' . $consulta->tipo, 40) }}</p>
                        <p class="text-xs sm:text-sm text-gray-500">{{ $consulta->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="shrink-0">
                        @if($consulta->nivel_riesgo === 'bajo')
                            <span class="inline-flex items-center px-2.5 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-medium">Bajo</span>
                        @elseif($consulta->nivel_riesgo === 'medio')
                            <span class="inline-flex items-center px-2.5 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Medio</span>
                        @elseif($consulta->nivel_riesgo === 'alto')
                            <span class="inline-flex items-center px-2.5 py-0.5 bg-red-100 text-red-800 rounded-full text-xs font-medium">Alto</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">Pendiente</span>
                        @endif
                    </div>
                </a>
                @empty
                <div class="px-4 sm:px-6 py-8 sm:py-10 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-sm sm:text-base">No tienes consultas registradas</p>
                    <a href="{{ route('consulta.chat') }}" class="text-emerald-600 hover:text-emerald-700 font-medium mt-2 inline-block text-sm sm:text-base">Realizar primera consulta</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-mediconsult-layout>
