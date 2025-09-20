<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Capturistas
        </h2>
    </x-slot>

    <x-bladewind::centered-content>
        <div class="mt-6 max-w-2xl m-auto">
            <a class="px-3 py-2 text-lg bg-red-500 rounded-md text-white hover:cursor-pointer ml-3" href="{{ route('clerks.index') }}">
                ← Volver
            </a>
            <div class="mt-10">
                <form action="{{ route('clerks.store') }}" method="POST">
                    @csrf
    
                    <p class="font-bold text-lg ml-2 text-gray-700 mt-2">Nombre</p>
                    <input
                        type="text" name="name"
                        class="w-full rounded-sm border border-[#b6b6b6] bg-white mb-0.5 py-3 px-6 text-base font-medium text-[#6B7280] outline-none  focus:shadow-md"
                    />
                    @error('name')
                        <p class="text-red-500 text-sm ml-2">{{ $message }}</p>
                    @enderror
    
                    <p class="font-bold text-lg ml-2 text-gray-700 mt-2">Usuario</p>
                    <input 
                        type="text" name="username" 
                        class="w-full rounded-sm border border-[#b6b6b6] bg-white mb-0.5 py-3 px-6 text-base font-medium text-[#6B7280] outline-none  focus:shadow-md"
                    />
                    @error('username')
                        <p class="text-red-500 text-sm ml-2">{{ $message }}</p>
                    @enderror
    
                    <p class="font-bold text-lg ml-2 text-gray-700 mt-2">Contraseña</p>
                    <input 
                        type="password" name="password" 
                        class="w-full rounded-sm border border-[#b6b6b6] bg-white mb-0.5 py-3 px-6 text-base font-medium text-[#6B7280] outline-none  focus:shadow-md"
                    />
                    @error('password')
                        <p class="text-red-500 text-sm ml-2">{{ $message }}</p>
                    @enderror
    
                    <input 
                        type="submit" 
                        class="flex my-5 ml-2 px-3 py-2 bg-red-500 rounded-md text-white" 
                        value="Registrar"
                    />
                </form>
            </div>
        </div>

    </x-bladewind::centered-content>

</x-app-layout>
