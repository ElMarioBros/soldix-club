<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 px-4 mb-12">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('cards.create') }}"
               class="inline-block px-4 py-2 text-white bg-red-500 rounded-lg shadow hover:bg-red-600">
                + Registrar Cliente
            </a>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('status') }}
            </div>
        @endif

        <div class="hidden md:block bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Celular</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Género</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Edad</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ocupación</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">PIN</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Código tarjeta</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Registrado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->phone }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($user->gender) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->age }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->occupation }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($user->card)->login_code ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($user->card)->public_code ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ optional($user->created_at)->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                @if($user->card)
                                    <a href="{{ route('cards.show', $user->card) }}"
                                       class="inline-flex items-center px-3 py-2 text-white bg-red-500 rounded-md shadow hover:bg-red-600">
                                        Ver
                                    </a>
                                @else
                                    <a href="{{ route('cards.create') }}?user_id={{ $user->id }}"
                                       class="inline-flex items-center px-3 py-2 text-white bg-yellow-500 rounded-md shadow hover:bg-yellow-600">
                                        Asignar tarjeta
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-10 text-center text-gray-500" colspan="9">
                                No hay clientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE CARDS --}}
        <div class="md:hidden space-y-3">
            @forelse ($users as $user)
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->phone }}</div>
                        </div>
                        <div class="text-xs text-gray-500">{{ optional($user->created_at)->format('d/m/Y') ?? '-' }}</div>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-2 text-sm text-gray-700">
                        <div><span class="font-medium">Género:</span> {{ ucfirst($user->gender) }}</div>
                        <div><span class="font-medium">Edad:</span> {{ $user->age }}</div>
                        <div class="col-span-2"><span class="font-medium">Ocupación:</span> {{ $user->occupation }}</div>
                        <div><span class="font-medium">PIN:</span> {{ optional($user->card)->login_code ?? '-' }}</div>
                        <div><span class="font-medium">Código tarjeta:</span> {{ optional($user->card)->public_code ?? '-' }}</div>
                    </div>

                    <div class="mt-3 flex justify-end space-x-2">
                        @if($user->card)
                            <a href="{{ route('cards.show', $user->card) }}"
                               class="px-3 py-2 text-sm text-white bg-red-500 rounded-md shadow hover:bg-red-600">Ver</a>
                        @else
                            <a href="{{ route('cards.create') }}?user_id={{ $user->id }}"
                               class="px-3 py-2 text-sm text-white bg-yellow-500 rounded-md shadow hover:bg-yellow-600">Asignar tarjeta</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500">No hay clientes registrados.</div>
            @endforelse
        </div>

    </div>
</x-app-layout>
