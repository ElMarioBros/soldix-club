<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Capturistas
        </h2>
    </x-slot>

    <x-bladewind::centered-content>
        <div class="mt-6">
            <a class="px-3 py-2 text-lg bg-red-500 rounded-md text-white hover:cursor-pointer" href="{{ route('clerks.create') }}">
                + Registrar Capturista nuevo
            </a>
            <div class="my-6">
                @if (session('status'))
                    <x-bladewind::alert
                        class="mb-6"
                        type="success">
                        {{ session('status') }}
                    </x-bladewind::alert>
                @endif
                <x-bladewind::table
    
                    hasShadow="true"
                    striped="false">
    
                    <x-slot name="header">
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th><span class="float-right">Acciones</span> </th>
                    </x-slot>
                    @foreach ($clerks as $clerk)
                        <tr>
                            <td>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-slate-900">
                                        {{ $clerk->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $clerk->email }}
                            </td>
                            <td>
                                <a href="#" class="flex float-right px-3 py-2 bg-red-500 rounded-md text-white">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#ffffff"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        >
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </a>
                            </td>    
                        </tr>
                    @endforeach
    
                </x-bladewind::table>
            </div>
        </div>

    </x-bladewind::centered-content>

</x-app-layout>
