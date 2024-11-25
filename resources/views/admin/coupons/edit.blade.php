<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de cupón') }}
        </h2>
    </x-slot>

    <x-bladewind::centered-content class="pb-12">
        
        <a class="flex w-24 mt-5 px-3 py-2 bg-red-500 rounded-md text-white hover:cursor-pointer" href="{{ route('corporate.wallets.view', $coupon->wallet_id) }}">← Volver</a>

        <div class="max-w-md px-2 m-auto">
            <x-coupon
                id="{{ $coupon->id }}#"
                image="{{ $coupon->image }}"
                type="{{ $coupon->type }}"
                tag="{{ $coupon->tag }}"
                valid="Consulte validez en interior">
    
                <x-slot name="image">
                    {{ $coupon->image }}
                </x-slot>
    
                {{ $coupon->name }}
            </x-coupon>

        </div>
        
        <form action="{{ route('corporate.coupons.update') }}" method="post">
            @csrf
            @method('PATCH')
            <div class="max-w-lg px-2 m-auto">
                @if (session('status'))
                    <x-bladewind::alert
                        type="error">
                        {{ session('status') }}
                    </x-bladewind::alert>
                @endif
                <input type="hidden" name="id" value="{{ $coupon->id }}">

                <x-coupon-validity-days :coupon="$coupon" :editable="true"/>
    
                <p class="mt-5 mb-2 font-semibold text-xl">Duración de campaña</p>
                <div class="grid grid-cols-2">
                    <label class="ml-4 select-none" for="campain_starts">Inicio</label>
                    <label class="ml-4 select-none" for="campain_finishes">Acaba</label>
                    <input class="mx-2" type="date" name="campain_starts" id="campain_starts" value="{{ $coupon->campain_starts }}">
                    <input class="mx-2" type="date" name="campain_finishes" id="campain_finishes" value="{{ $coupon->campain_finishes }}">
                </div>
    
                <p class="mt-5 mb-2 font-semibold text-xl">Visibilidad</p>            
                    <input
                        id="is_active"
                        class="relative float-left mt-[0.15rem] p-2.5 rounded-[35%] border-[0.125rem] border-solid border-gray-700 bg-red-200 text-green-600 hover:cursor-pointer"
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ ! $coupon->is_active ?: 'checked' }}/>
                    <label for="is_active" class="ml-1 text-lg">Hacer público</label>

                <div x-data="{ showAdvanced: false }" class="mt-7">
                    <!-- Toggle Button -->
                    <button @click.prevent="showAdvanced = !showAdvanced" class="px-4 py-2 bg-gray-500 text-white rounded">
                        <span x-show="!showAdvanced">Mostrar Opciones Avanzadas</span>
                        <span x-show="showAdvanced">Ocultar Opciones Avanzadas</span>
                    </button>
                
                    <!-- Advanced Settings Section -->
                    <div x-show="showAdvanced" class="mt-4 p-4 border rounded bg-gray-100">
                        <p class="mt-5 mb-2 font-semibold text-xl">Opciones Avanzadas</p>
                        <p class="mt-1">Identificador del producto</p>
                        <input
                            value="{{ $coupon->target_item }}"
                            type="text"
                            name="target_item"
                            id="target_item"
                            placeholder="Ej. 9005570635"
                            class="w-full rounded-sm border border-[#e0e0e0] bg-white mb-0.5 py-3 px-6 text-base font-medium placeholder-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                        <p class="mt-1">Acción</p>
                        <input
                            value="{{ $coupon->action }}"
                            type="text"
                            name="action"
                            id="action"
                            placeholder="Ej. DT50"
                            class="w-full rounded-sm border border-[#e0e0e0] bg-white mb-0.5 py-3 px-6 text-base font-medium placeholder-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                        <p class="mt-1">Producto condicional</p>
                        <input
                            value="{{ $coupon->conditional_item }}"
                            type="text"
                            name="conditional_item"
                            id="conditional_item"
                            placeholder="Ej. 9758420209"
                            class="w-full rounded-sm border border-[#e0e0e0] bg-white mb-0.5 py-3 px-6 text-base font-medium placeholder-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
    
                    </div>
                </div>
                

                <input
                    type="submit"
                    class="flex w-full my-5 px-3 py-2 bg-red-500 rounded-md text-white hover:cursor-pointer"
                    value="Guardar">
    
            </div>
        </form>

    </x-bladewind::centered-content>

</x-app-layout>