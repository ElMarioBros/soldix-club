<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cupón') }}
        </h2>
    </x-slot>

    <x-bladewind::centered-content size="small">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=test" class="mx-auto my-6" >
        <p class="text-4xl text-center mb-9 mt-4">24012881288</p>

{{--         <div class="mt-8">
            <img src="https://res.cloudinary.com/de6hiq5n4/image/upload/v1683075785/assets/soldix/dummy%20images/t_ht9sxf.jpg" class="rounded-3xl">
        </div> --}}
        <h2 class="text-2xl text-center font-bold mb-4">
            Hamburguesa con papas gratis en la compra de una del mismo tamaño.
        </h2>

        <p class="text-xl text-center font-medium">
            Valido: De lunes a viernes
        </p>

        <p class="text-xs mt-6">
            No acumulable con otras promociones. Restringido a un cupón por usuario. Las imagenes son ilustrativas. Todos los productos son sujetos a disponibilidad.
        </p>
    </x-bladewind::centered-content>

</x-app-layout>
