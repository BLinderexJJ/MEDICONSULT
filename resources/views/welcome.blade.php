<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <nav class="flex items-center justify-between h-16 sm:h-20">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <span class="text-xl sm:text-2xl font-bold text-emerald-700">MediConsult</span>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 sm:px-5 py-2 sm:py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium text-sm sm:text-base transition">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 sm:px-5 py-2 sm:py-2.5 text-emerald-700 font-medium hover:text-emerald-800 text-sm sm:text-base transition">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="px-4 sm:px-5 py-2 sm:py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium text-sm sm:text-base transition">Registrarse</a>
                    @endauth
                </div>
            </nav>

            {{-- Hero --}}
            <div class="py-12 sm:py-16 lg:py-20 text-center">
                <div class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                    Sistema de Orientación Médica Inteligente
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-4 sm:mb-6">
                    Tu salud, <br class="hidden sm:block">
                    <span class="text-emerald-600">siempre en buenas manos</span>
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto mb-8 sm:mb-10 px-2">
                    Obtén orientación médica preliminar, verifica medicamentos, 
                    consulta tu historial y recibe recomendaciones personalizadas 
                    basadas en tu perfil clínico.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 px-4">
                    @auth
                        <a href="{{ route('consulta.chat') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold text-base sm:text-lg shadow-lg shadow-emerald-200 transition">
                            Nueva Consulta
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold text-base sm:text-lg shadow-lg shadow-emerald-200 transition">
                            Comenzar Ahora
                        </a>
                        <a href="{{ route('login') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-white text-emerald-700 rounded-xl hover:bg-gray-50 font-semibold text-base sm:text-lg border-2 border-emerald-200 transition">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Features --}}
            <div class="py-12 sm:py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-3 sm:mb-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1 sm:mb-2">Consulta Inteligente</h3>
                    <p class="text-sm sm:text-base text-gray-600">Describe tus síntomas y recibe orientación médica preliminar con análisis de riesgo.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-3 sm:mb-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1 sm:mb-2">Verificador de Medicamentos</h3>
                    <p class="text-sm sm:text-base text-gray-600">Consulta compatibilidad de medicamentos con tu perfil clínico y posibles interacciones.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-3 sm:mb-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1 sm:mb-2">Historial y Seguimiento</h3>
                    <p class="text-sm sm:text-base text-gray-600">Accede a tu historial de consultas y realiza seguimiento de tus síntomas.</p>
                </div>
            </div>

            {{-- Footer --}}
            <footer class="py-6 sm:py-8 text-center text-xs sm:text-sm text-gray-500 border-t border-gray-200">
                <p class="mb-2 px-4"><strong>Aviso importante:</strong> Este sistema no reemplaza a un médico. Ante cualquier emergencia, acuda al centro de salud más cercano.</p>
                <p>&copy; {{ date('Y') }} MediConsult. Todos los derechos reservados.</p>
            </footer>
        </div>
    </div>
</x-guest-layout>
