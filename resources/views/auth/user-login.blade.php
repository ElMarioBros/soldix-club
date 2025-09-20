<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">
            Iniciar Sesión
        </h2>
    </x-slot>

    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-red-50 to-red-100 px-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 sm:p-10">
            
            <p class="text-center text-gray-600 mb-6">
                Ingresa tu número de teléfono y PIN de 4 dígitos
            </p>

            <form method="POST" action="{{ route('user.login.submit') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                    <input 
                        type="tel" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-400 focus:border-red-400 transition-all duration-200 bg-gray-50 placeholder-gray-400"
                        placeholder="Ej: 6864567890"
                    />
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">PIN (4 dígitos)</label>
                    <input 
                        type="text" 
                        name="login_code" 
                        value="{{ old('login_code') }}" 
                        required 
                        maxlength="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-400 focus:border-red-400 transition-all duration-200 bg-gray-50 text-center font-mono text-lg placeholder-gray-400"
                        placeholder="••••"
                    />
                    @error('login_code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                    <span>Ingresar</span>
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
