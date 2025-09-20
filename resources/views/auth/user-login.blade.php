<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Iniciar Sesión
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto mt-12 p-6 bg-white rounded-lg shadow">
        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Teléfono</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" required
                    class="w-full px-4 py-2 border rounded">
                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">PIN (4 dígitos)</label>
                <input type="text" name="login_code" value="{{ old('login_code') }}" required maxlength="4"
                    class="w-full px-4 py-2 border rounded">
                @error('login_code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Ingresar
            </button>
        </form>
    </div>
</x-guest-layout>
