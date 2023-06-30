<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Establecimientos') }}
        </h2>
    </x-slot>

    <x-bladewind::centered-content class="py-12">

        @if (session('status'))
            <x-bladewind::alert
                type="success">
                {{ session('status') }}
            </x-bladewind::alert>
        @endif

        @if (auth()->user()->is_local_admin)
            <button onclick="showModal('register')" class="flex my-5 ml-2 px-3 py-2 bg-red-500 rounded-md text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus mr-1" width="20" height="25" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="9" />
                    <line x1="9" y1="12" x2="15" y2="12" />
                    <line x1="12" y1="9" x2="12" y2="15" />
                </svg>
                Agregar
            </button>                
        @else
            <p class="mb-2 text-sm font-semibold text-gray-600">Sólo super admin puede agregar nuevos administradores.</p>
        @endif

        <x-bladewind::table
            hasShadow="true"
            striped="true">

            <x-slot name="header">
                <th>Establecimientos</th>
                <th>Marca</th>
                <th>Dirección</th>
                <th><span class="float-right">Acciones</span> </th>
            </x-slot>

                @if ($stores)
                    @foreach ($stores as $store)
                        <tr>
                            <td>
                                <div class="ml-3">
                                    <div class="text-lg font-medium text-slate-900">
                                        {{ $store->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <div class="text-base font-base text-slate-800">
                                        {{ $store->brand()->first()->name }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="text-base text-slate-800">
                                    {{ $store->address }}
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif


        </x-bladewind::table>


    </x-bladewind::centered-content>

    <x-bladewind::modal
        title="Agregar Nuevo Establecimiento"
        name="register"
        size="large"
        centerActionButtons="false"
        okButtonLabel=""
        cancelButtonLabel="Cerrar"
        >
        <hr class="mb-7 mt-1">
        <form action="{{ route('corporate.stores.store') }}" method="POST">
            @csrf

            <p class="my-3 text-lg">Información de Establecimiento</p>

            <p class="text-lg ml-2 font-semibold">Marca</p>
            <select name="brand" class="w-full mb-2 mt-1 border border-gray-300 text-gray-500 rounded-sm text-base" required>
                @if (isset($brands))
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach                    
                @endif
            </select>

            <p class="text-lg ml-2 font-semibold">Nombre</p>
            <x-bladewind::input placeholder="Ej. Sucursal Rio Nuevo" name="store" required="true"/>

            <p class="text-lg ml-2 font-semibold">Dirección (Opcional)</p>
            <x-bladewind::input placeholder="Ej. Calle Rio Nuevo #23, Col. Carbajal" name="address" class="mb-4" required="true"/>

            <hr>

            <p class="mb-3 mt-4 text-lg">Administrador de Establecimiento</p>

            <p class="text-lg ml-2 font-semibold">Nombre</p>
            <x-bladewind::input placeholder="Ej. Juan Sanchez" name="name" required="true"/>

            <p class="text-lg ml-2 font-semibold">Usuario</p>
            <x-bladewind::input placeholder="Ej. jsanchez" name="username" required="true"/>

            <p class="text-lg ml-2 font-semibold">Contraseña</p>
            <x-bladewind::input type="password" placeholder="*********" name="password" viewable="true" required="true"/>

            <input 
                type="submit" 
                class="flex my-5 ml-2 px-3 py-2 bg-red-500 rounded-md text-white" 
                value="Registrar">
        </form>
    </x-bladewind::modal>


</x-app-layout>