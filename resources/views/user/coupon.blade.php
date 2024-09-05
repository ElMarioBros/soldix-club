<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cupón') }}
        </h2>
    </x-slot>

    <x-bladewind::centered-content size="small">
        <img src="https://barcodeapi.org/api/auto/{{ auth()->user()->id . '=' . $coupon->redeem_id }}" class="mx-auto my-6" >

{{--         <div class="mt-8">
            <img src="https://res.cloudinary.com/de6hiq5n4/image/upload/v1683075785/assets/soldix/dummy%20images/t_ht9sxf.jpg" class="rounded-3xl">
        </div> --}}
        <h2 class="text-2xl text-center font-bold mb-4">
            {{ $coupon->name }}
        </h2>

        <p class="text-xl text-center font-medium">
            Valido: De lunes a viernes
        </p>

        <p class="text-xs mt-6">
            No acumulable con otras promociones. Restringido a un cupón por usuario. Las imagenes son ilustrativas. Todos los productos son sujetos a disponibilidad.
        </p>
    </x-bladewind::centered-content>

</x-app-layout>
