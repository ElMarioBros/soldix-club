<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            Registro de Capturista
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-red-50 to-red-100 py-12">
        <div class="max-w-xl mx-auto">
            <div class="mt-6">
                <a href="{{ route('cards.index') }}" class="inline-flex items-center text-red-600 hover:text-red-800 transition-colors duration-200 text-lg p-4 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la tabla
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form action="{{ route('cards.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Name Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre Completo *
                        </label>
                        <input
                            type="text" 
                            name="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                            placeholder="Ingrese su nombre completo"
                            value="{{ old('name') }}"
                            required
                        />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Número de Teléfono 10 digitos *
                        </label>
                        <input
                            type="tel" 
                            name="phone"
                            minlength="10"
                            maxlength="10"
                            pattern="[0-9]{10}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                            placeholder="Ej: 686 456 7890"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10)"
                            value="{{ old('phone') }}"
                            required
                        />
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Gender and Age Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Género *
                            </label>
                            <select
                                name="gender"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                required
                            >
                                <option value="">Seleccionar</option>
                                <option value="masculino" {{ old('gender') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="femenino" {{ old('gender') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('gender')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Edad *
                            </label>
                            <input
                                type="number" 
                                name="age"
                                min="18"
                                max="100"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Edad"
                                value="{{ old('age') }}"
                                required
                            />
                            @error('age')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                    <!-- Occupation Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Ocupación *
                        </label>
                        <select
                            name="occupation"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                            required
                        >
                            <option value="">Seleccione su ocupación</option>
                            @foreach($occupations as $value => $label)
                                <option value="{{ $value }}" {{ old('occupation') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('occupation')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Login Code Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pin de Usuario *
                        </label>
                        <input
                            type="number" 
                            name="login_code"
                            minlength="4"
                            maxlength="4"
                            pattern="[0-9]{4}"
                            class="w-full h-16 text-xl text-center px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white font-mono"
                            placeholder="Ingrese el Pin del Usuario"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4)"
                            value="{{ old('login_code') }}"
                            required
                        />
                        @error('login_code')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Public Code Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Código de Tarjeta*
                        </label>
                        <input
                            type="number" 
                            name="public_code"
                            class="w-full h-16 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white font-mono"
                            placeholder="Escanee la tarjeta"
                            required
                        />
                        @error('public_code')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Registrar Capturista
                        </span>
                    </button>
                </form>

            </div>


        </div>
    </div>
</x-app-layout>