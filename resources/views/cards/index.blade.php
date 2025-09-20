<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Capturista
        </h2>
    </x-slot>

    <x-bladewind::centered-content>
        <div class="mt-6">
            <a class="px-3 py-2 text-lg bg-red-500 rounded-md text-white hover:cursor-pointer" href="#">
                + Registrar Cliente
            </a>
            <div class="my-6">
                @if (session('status'))
                    <x-bladewind::alert
                        class="mb-6"
                        type="success">
                        {{ session('status') }}
                    </x-bladewind::alert>
                @endif
            </div>
        </div>

    </x-bladewind::centered-content>

</x-app-layout>
