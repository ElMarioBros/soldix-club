<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Cliente
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-6 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('cards.update', $card) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo *</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $card->user->name) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white"
                        required
                    />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Celular --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Teléfono 10 dígitos *</label>
                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone', $card->user->phone) }}"
                        minlength="10"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10)"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white"
                        required
                    />
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Género / Edad --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Género *</label>
                        <select name="gender" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white">
                            <option value="">Seleccionar</option>
                            <option value="masculino" {{ old('gender', $card->user->gender) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('gender', $card->user->gender) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Edad *</label>
                        <input
                            type="number"
                            name="age"
                            min="18"
                            max="100"
                            value="{{ old('age', $card->user->age) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white"
                            required
                        />
                        @error('age') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Ocupación --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ocupación *</label>
                    <select name="occupation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white">
                        <option value="">Seleccione su ocupación</option>
                        <option value="ama_casa" {{ old('occupation', $card->user->occupation) == 'ama_casa' ? 'selected' : '' }}>Ama de Casa</option>
                        <option value="personal_operativo" {{ old('occupation', $card->user->occupation) == 'personal_operativo' ? 'selected' : '' }}>Personal Operativo de Fábrica</option>
                        <option value="supervision_produccion" {{ old('occupation', $card->user->occupation) == 'supervision_produccion' ? 'selected' : '' }}>Supervisión / Coordinación de Producción</option>
                        <option value="gerencia_industrial" {{ old('occupation', $card->user->occupation) == 'gerencia_industrial' ? 'selected' : '' }}>Gerencia / Dirección Industrial</option>
                        <option value="jubilado" {{ old('occupation', $card->user->occupation) == 'jubilado' ? 'selected' : '' }}>Jubilado</option>
                        <option value="desempleado" {{ old('occupation', $card->user->occupation) == 'desempleado' ? 'selected' : '' }}>Desempleado</option>
                        <option value="estudiante" {{ old('occupation', $card->user->occupation) == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                        <option value="contador" {{ old('occupation', $card->user->occupation) == 'contador' ? 'selected' : '' }}>Empleado de Oficina</option>
                        <option value="independiente" {{ old('occupation', $card->user->occupation) == 'independiente' ? 'selected' : '' }}>Trabajador Independiente</option>
                        <option value="empresario" {{ old('occupation', $card->user->occupation) == 'empresario' ? 'selected' : '' }}>Empresario</option>
                        <option value="profesional_salud" {{ old('occupation', $card->user->occupation) == 'profesional_salud' ? 'selected' : '' }}>Profesional de la Salud</option>
                        <option value="profesor" {{ old('occupation', $card->user->occupation) == 'profesor' ? 'selected' : '' }}>Profesor / Docente</option>
                        <option value="policia" {{ old('occupation', $card->user->occupation) == 'policia' ? 'selected' : '' }}>Policía</option>
                        <option value="chofer" {{ old('occupation', $card->user->occupation) == 'chofer' ? 'selected' : '' }}>Chofer / Conductor</option>
                        <option value="agricultor" {{ old('occupation', $card->user->occupation) == 'agricultor' ? 'selected' : '' }}>Agricultor / Campesino</option>
                        <option value="comerciante" {{ old('occupation', $card->user->occupation) == 'comerciante' ? 'selected' : '' }}>Comerciante</option>
                        <option value="otro" {{ old('occupation', $card->user->occupation) == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('occupation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- PIN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pin de Usuario *</label>
                    <input
                        type="text"
                        name="login_code"
                        value="{{ old('login_code', $card->login_code) }}"
                        minlength="4"
                        maxlength="4"
                        pattern="[0-9]{4}"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4)"
                        class="w-full h-14 text-xl text-center px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white font-mono"
                        required
                    />
                    @error('login_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Código de tarjeta --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Código de Tarjeta *</label>
                    <input
                        type="text"
                        name="public_code"
                        value="{{ old('public_code', $card->public_code) }}"
                        class="w-full h-14 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-gray-50 focus:bg-white font-mono"
                        required
                    />
                    @error('public_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('cards.show', $card) }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancelar</a>

                    <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
