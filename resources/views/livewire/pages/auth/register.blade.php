<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $apellido = '';
    public string $dni = '';
    public string $telefono = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'dni' => ['nullable', 'string', 'max:20', 'unique:'.User::class],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['rol'] = 'paciente';

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Crear cuenta</h2>
        <p class="text-gray-500 text-sm mt-1">Completa tus datos para registrarte</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <x-input-label for="name" :value="__('Nombres')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="apellido" :value="__('Apellidos')" />
                <x-text-input wire:model="apellido" id="apellido" class="block mt-1 w-full" type="text" />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <x-input-label for="dni" :value="__('DNI')" />
                <x-text-input wire:model="dni" id="dni" class="block mt-1 w-full" type="text" />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="telefono" :value="__('Teléfono')" />
                <x-text-input wire:model="telefono" id="telefono" class="block mt-1 w-full" type="text" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-emerald-600 hover:text-emerald-700 font-medium" href="{{ route('login') }}" wire:navigate>
                ¿Ya tienes cuenta?
            </a>
            <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition">
                Registrarse
            </button>
        </div>
    </form>
</div>
