<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de tarjeta
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Cliente</h3>
                <p class="text-sm text-gray-500">Información del titular de la tarjeta</p>
            </div>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                <div>
                    <dt class="font-medium text-gray-700">Nombre</dt>
                    <dd class="text-gray-900">{{ $card->user->name }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-700">Celular</dt>
                    <dd class="text-gray-900">{{ $card->user->phone }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-700">Género</dt>
                    <dd class="text-gray-900 capitalize">{{ $card->user->gender }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-700">Edad</dt>
                    <dd class="text-gray-900">{{ $card->user->age }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-medium text-gray-700">Ocupación</dt>
                    <dd class="text-gray-900">{{ $card->user->occupation }}</dd>
                </div>
            </dl>

            <div class="border-t mt-6 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tarjeta</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    @if (auth()->user()->role_id == App\Models\Role::IS_CLERK)
                        <div>
                            <dt class="font-medium text-gray-700">PIN de acceso</dt>
                            <dd class="text-gray-900">{{ $card->login_code }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="font-medium text-gray-700">Número de Tarjeta</dt>
                        <dd class="text-gray-900">{{ $card->public_code }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="font-medium text-gray-700">Registrado el</dt>
                        <dd class="text-gray-500">{{ $card->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                @if (auth()->user()->role_id == App\Models\Role::IS_CLERK)
                    <a href="{{ route('cards.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Volver
                    </a>
                    <a href="{{ route('cards.edit', $card) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Editar
                    </a>
                @elseif (auth()->user()->role_id == App\Models\Role::IS_CORPORATE)
                    <a href="{{ route('analytics.clients.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        < Volver
                    </a>
                @endif
                {{-- <form action="{{ route('cards.destroy', $card) }}" method="POST" onsubmit="return confirm('¿Eliminar tarjeta?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                        Eliminar
                    </button>
                </form> --}}
            </div>
        </div>
    </div>
</x-app-layout>
