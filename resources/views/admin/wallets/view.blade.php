<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Boletera') }}
        </h2>
    </x-slot>

    <x-bladewind::centered-content class="py-12">

        <div class="grid gap-4 grid-cols-2">
            <div class="relative w-full group max-w-md min-w-0 mx-auto mt-12 mb-6 break-words bg-white border shadow-2xl dark:bg-gray-800 dark:border-gray-700 md:max-w-sm rounded-2xl">
                <div class="pb-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="flex justify-center w-full">
                            <div class="relative">
                                @if ($wallet->image)
                                    <img src="{{ $wallet->image }}" class="dark:shadow-xl border-white dark:border-gray-800 rounded-3xl align-middle border-8 absolute -m-16 -ml-18 lg:-ml-16 max-w-[150px]" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-24 text-center">
                        <h3 class="mb-4 text-2xl font-bold leading-normal text-gray-700 dark:text-gray-300">
                            @if ($wallet->name)
                                {{ $wallet->name }}
                            @else
                                {{ $wallet->brand->name }}
                            @endif
                        </h3>
                    </div>

                    <div class="pt-6 pb-1.5 mx-6 mt-6 text-center border-t border-gray-200 dark:border-gray-700/50">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full px-6">
                                <p class="mb-4 font-light leading-relaxed text-gray-600 dark:text-gray-400">
                                    Cuponera soldix club.
                                </p>
                            </div>
                        </div>
                    </div>
    
                    <div class="relative h-6 overflow-hidden translate-y-6 rounded-b-xl">
                        <div class="absolute flex -space-x-12 rounded-b-2xl">
                            <div class="w-36 h-8 transition-colors duration-200 delay-75 transform skew-x-[35deg] bg-red-400/90 group-hover:bg-red-600/90 z-10"></div>
                            <div class="w-28 h-8 transition-colors duration-200 delay-100 transform skew-x-[35deg] bg-red-300/90 group-hover:bg-red-500/90 z-20"></div>
                            <div class="w-28 h-8 transition-colors duration-200 delay-150 transform skew-x-[35deg] bg-red-200/90 group-hover:bg-red-400/90 z-30"></div>
                            <div class="w-28 h-8 transition-colors duration-200 delay-200 transform skew-x-[35deg] bg-red-100/90 group-hover:bg-red-300/90 z-40"></div>
                            <div class="w-28 h-8 transition-colors duration-200 delay-300 transform skew-x-[35deg] bg-red-50/90 group-hover:bg-red-200/90 z-50"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-semibold">
                    Editar información de Boletera
                </h2>
                <hr class="my-3">
                <form action="{{ route('corporate.wallets.update', $wallet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="text-lg ml-2 mb-2 font-semibold">Nombre de la Cuponera (Opcional)</p>
                    <x-bladewind::input placeholder="Ej. Súper Mexicali" name="name" />
            
                    <div class="mb-0.5">
                        <p class="text-lg ml-2 mb-2 font-semibold">Imagen (Opcional)</p>
                        <input class="block w-full text-sm text-gray-900" id="file" name="file" type="file">
                    </div>

                    <input 
                        type="submit" 
                        class="flex my-5 ml-2 px-3 py-2 bg-red-500 rounded-md text-white" 
                        value="Actualizar">
                </form>
            </div>
            <a href="{{ route('corporate.wallets.coupon.add', $wallet->id) }}" class='break-inside bg-red-500 rounded-xl p-4 mb-4 w-full'>
                <div class='flex items-center space-x-4'>
                  <svg width='32' height='32' viewBox='0 0 38 38' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path
                      d='M5.10714 0C3.75264 0 2.45362 0.538072 1.49585 1.49585C0.538072 2.45362 0 3.75264 0 5.10714V29.4643C0 30.8188 0.538072 32.1178 1.49585 33.0756C2.45362 34.0334 3.75264 34.5714 5.10714 34.5714H18.0714C17.5227 33.8418 17.0607 33.0508 16.6949 32.2143H5.10714C4.3778 32.2143 3.67832 31.9246 3.1626 31.4088C2.64687 30.8931 2.35714 30.1936 2.35714 29.4643V5.10714C2.35714 3.58914 3.58914 2.35714 5.10714 2.35714H29.4643C30.9823 2.35714 32.2143 3.58914 32.2143 5.10714V16.6949C33.0507 17.0602 33.8417 17.5216 34.5714 18.0699V5.10714C34.5714 3.75264 34.0334 2.45362 33.0756 1.49585C32.1178 0.538072 30.8188 0 29.4643 0H5.10714ZM8.64286 10.989C7.60094 10.989 6.60169 11.4029 5.86494 12.1397C5.12819 12.8764 4.71429 13.8757 4.71429 14.9176C4.71429 15.9595 5.12819 16.9587 5.86494 17.6955C6.60169 18.4322 7.60094 18.8461 8.64286 18.8461C9.68478 18.8461 10.684 18.4322 11.4208 17.6955C12.1575 16.9587 12.5714 15.9595 12.5714 14.9176C12.5714 13.8757 12.1575 12.8764 11.4208 12.1397C10.684 11.4029 9.68478 10.989 8.64286 10.989ZM7.07143 14.9176C7.07143 14.5008 7.23699 14.1011 7.53169 13.8064C7.82639 13.5117 8.22609 13.3461 8.64286 13.3461C9.05963 13.3461 9.45933 13.5117 9.75403 13.8064C10.0487 14.1011 10.2143 14.5008 10.2143 14.9176C10.2143 15.3343 10.0487 15.734 9.75403 16.0287C9.45933 16.3234 9.05963 16.489 8.64286 16.489C8.22609 16.489 7.82639 16.3234 7.53169 16.0287C7.23699 15.734 7.07143 15.3343 7.07143 14.9176ZM4.71429 25.9239C4.71429 24.8819 5.12819 23.8827 5.86494 23.1459C6.60169 22.4092 7.60094 21.9953 8.64286 21.9953C9.68478 21.9953 10.684 22.4092 11.4208 23.1459C12.1575 23.8827 12.5714 24.8819 12.5714 25.9239C12.5714 26.9658 12.1575 27.965 11.4208 28.7018C10.684 29.4385 9.68478 29.8524 8.64286 29.8524C7.60094 29.8524 6.60169 29.4385 5.86494 28.7018C5.12819 27.965 4.71429 26.9658 4.71429 25.9239ZM8.64286 24.3524C8.22609 24.3524 7.82639 24.518 7.53169 24.8127C7.23699 25.1074 7.07143 25.5071 7.07143 25.9239C7.07143 26.3406 7.23699 26.7403 7.53169 27.035C7.82639 27.3297 8.22609 27.4953 8.64286 27.4953C9.05963 27.4953 9.45933 27.3297 9.75403 27.035C10.0487 26.7403 10.2143 26.3406 10.2143 25.9239C10.2143 25.5071 10.0487 25.1074 9.75403 24.8127C9.45933 24.518 9.05963 24.3524 8.64286 24.3524ZM15.3214 12.5714C15.0089 12.5714 14.7091 12.6956 14.4881 12.9166C14.267 13.1377 14.1429 13.4374 14.1429 13.75C14.1429 14.0626 14.267 14.3624 14.4881 14.5834C14.7091 14.8044 15.0089 14.9286 15.3214 14.9286H28.6786C28.9912 14.9286 29.2909 14.8044 29.5119 14.5834C29.733 14.3624 29.8571 14.0626 29.8571 13.75C29.8571 13.4374 29.733 13.1377 29.5119 12.9166C29.2909 12.6956 28.9912 12.5714 28.6786 12.5714H15.3214ZM27.5 37.7143C30.209 37.7143 32.807 36.6381 34.7226 34.7226C36.6381 32.807 37.7143 30.209 37.7143 27.5C37.7143 24.791 36.6381 22.193 34.7226 20.2774C32.807 18.3619 30.209 17.2857 27.5 17.2857C24.791 17.2857 22.193 18.3619 20.2774 20.2774C18.3619 22.193 17.2857 24.791 17.2857 27.5C17.2857 30.209 18.3619 32.807 20.2774 34.7226C22.193 36.6381 24.791 37.7143 27.5 37.7143V37.7143ZM27.5 20.4286C27.7084 20.4286 27.9082 20.5114 28.0556 20.6587C28.2029 20.8061 28.2857 21.0059 28.2857 21.2143V26.7143H33.7857C33.9941 26.7143 34.194 26.7971 34.3413 26.9444C34.4887 27.0918 34.5714 27.2916 34.5714 27.5C34.5714 27.7084 34.4887 27.9082 34.3413 28.0556C34.194 28.2029 33.9941 28.2857 33.7857 28.2857H28.2857V33.7857C28.2857 33.9941 28.2029 34.194 28.0556 34.3413C27.9082 34.4887 27.7084 34.5714 27.5 34.5714C27.2916 34.5714 27.0918 34.4887 26.9444 34.3413C26.7971 34.194 26.7143 33.9941 26.7143 33.7857V28.2857H21.2143C21.0059 28.2857 20.8061 28.2029 20.6587 28.0556C20.5114 27.9082 20.4286 27.7084 20.4286 27.5C20.4286 27.2916 20.5114 27.0918 20.6587 26.9444C20.8061 26.7971 21.0059 26.7143 21.2143 26.7143H26.7143V21.2143C26.7143 21.0059 26.7971 20.8061 26.9444 20.6587C27.0918 20.5114 27.2916 20.4286 27.5 20.4286V20.4286ZM5.89286 4.71429C5.58028 4.71429 5.28051 4.83846 5.05948 5.05948C4.83846 5.28051 4.71429 5.58028 4.71429 5.89286C4.71429 6.20543 4.83846 6.50521 5.05948 6.72623C5.28051 6.94726 5.58028 7.07143 5.89286 7.07143H28.6786C28.9912 7.07143 29.2909 6.94726 29.5119 6.72623C29.733 6.50521 29.8571 6.20543 29.8571 5.89286C29.8571 5.58028 29.733 5.28051 29.5119 5.05948C29.2909 4.83846 28.9912 4.71429 28.6786 4.71429H5.89286Z'
                      fill='white' />
                  </svg>
                  <span class='text-base font-medium text-white'>Agregar cupón nuevo</span>
                </div>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 pb-16">
            @foreach ($coupons as $coupon)
                <x-coupon
                    id=""
                    type="{{ $coupon->type }}"
                    tag="{{ $coupon->tag }}"
                    valid="Todos los martes">
                    <x-slot name="image">
                        {{ $coupon->image }}
                    </x-slot>
                    {{ $coupon->name }}
                </x-coupon>                
            @endforeach
        </div>

    </x-bladewind::centered-content>
</x-app-layout>