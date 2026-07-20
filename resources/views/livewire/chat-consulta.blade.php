<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-emerald-500 to-teal-500">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-white">Consulta Médica Inteligente</h2>
                    <p class="text-sm text-white/80">Describe tus síntomas para recibir orientación</p>
                </div>
            </div>
        </div>

        {{-- Messages --}}
        <div class="h-96 overflow-y-auto p-6 space-y-4" x-data x-init="$el.scrollTop = $el.scrollHeight" wire:poll>
            @foreach($mensajes as $index => $msg)
                @if($msg['tipo'] === 'bot')
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div class="bg-gray-50 rounded-2xl rounded-tl-none px-4 py-3 max-w-[80%]">
                            <p class="text-gray-700">{{ $msg['texto'] }}</p>
                        </div>
                    </div>
                @elseif($msg['tipo'] === 'user')
                    <div class="flex items-start justify-end space-x-3 space-x-reverse">
                        <div class="bg-emerald-600 rounded-2xl rounded-tr-none px-4 py-3 max-w-[80%]">
                            <p class="text-white">{{ $msg['texto'] }}</p>
                        </div>
                        <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xs font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                @elseif($msg['tipo'] === 'resultado')
                    <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-200 space-y-4">
                        @if($msg['riesgo'] === 'bajo')
                            <div class="flex items-center space-x-2 text-green-700">
                                <span class="text-2xl">🟢</span>
                                <span class="font-semibold text-lg">Riesgo Bajo</span>
                            </div>
                        @elseif($msg['riesgo'] === 'medio')
                            <div class="flex items-center space-x-2 text-yellow-700">
                                <span class="text-2xl">🟡</span>
                                <span class="font-semibold text-lg">Riesgo Medio</span>
                            </div>
                        @else
                            <div class="flex items-center space-x-2 text-red-700">
                                <span class="text-2xl">🔴</span>
                                <span class="font-semibold text-lg">Riesgo Alto</span>
                            </div>
                        @endif

                        <div>
                            <h4 class="font-medium text-gray-900 mb-1">Posibles causas:</h4>
                            <p class="text-gray-700">{{ $msg['causas'] }}</p>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-1">Recomendaciones:</h4>
                            <div class="text-gray-700 whitespace-pre-line">{{ $msg['recomendaciones'] }}</div>
                        </div>

                        <a href="{{ route('consulta.resultado', $msg['consultaId']) }}" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium text-sm transition">
                            Ver resultado completo
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Symptom selector --}}
        @if($mostrarPreguntas)
            <div class="border-t border-gray-100 p-4">
                <p class="text-sm font-medium text-gray-700 mb-3">Selecciona síntomas adicionales:</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($sintomasDisponibles as $sintoma)
                        <button wire:click="toggleSintoma({{ $sintoma->id }})" 
                                class="px-3 py-1.5 rounded-full text-sm font-medium transition border
                                {{ in_array($sintoma->id, $sintomasSeleccionados) 
                                    ? 'bg-emerald-100 text-emerald-800 border-emerald-300' 
                                    : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-emerald-300' }}">
                            {{ $sintoma->nombre }}
                        </button>
                    @endforeach
                </div>
                @if(count($sintomasSeleccionados) > 0)
                    <button wire:click="finalizarSintomas" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition">
                        Analizar síntomas ({{ count($sintomasSeleccionados) }} seleccionados)
                    </button>
                @endif
            </div>
        @endif

        {{-- Input --}}
        @if(!$mostrarPreguntas)
            <div class="border-t border-gray-100 p-4">
                <form wire:submit="enviarMensaje" class="flex space-x-3">
                    <input type="text" wire:model="mensajeActual" placeholder="Describe tus síntomas..." 
                           class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none"
                           {{ $paso >= 2 ? 'disabled' : '' }}>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-medium transition disabled:opacity-50"
                            {{ $paso >= 2 ? 'disabled' : '' }}>
                        Enviar
                    </button>
                </form>
            </div>
        @endif
    </div>

    @if(!$mostrarPreguntas && $paso === 0)
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-900 mb-3">¿Prefieres una consulta guiada?</h3>
        <p class="text-sm text-gray-600 mb-4">Selecciona tus síntomas mediante botones, ideal para adultos mayores o personas que prefieren no escribir.</p>
        <a href="{{ route('consulta.guiada') }}" class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 font-medium text-sm transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Consulta Guiada
        </a>
    </div>
    @endif
</div>
