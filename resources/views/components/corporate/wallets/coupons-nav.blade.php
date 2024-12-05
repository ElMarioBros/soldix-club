<div>
    @unless (request()->routeIs('corporate.wallets.view'))
        <a href="{{ route('corporate.wallets.view', $wallet->id) }}" class="flex text-blue-600 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M3 19v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path> <path d="M11 15h2"></path> <path d="M9 12h6"></path> <path d="M10 9h4"></path> </svg> 
            <span class="text-lg ml-3">Volver a Campañas Activas</span>
        </a>
    @endunless

    @unless (request()->routeIs('corporate.wallets.view.expired'))
        <a href="{{ route('corporate.wallets.view.expired', $wallet->id) }}" class="flex text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M11.933 5h-6.933v16h13v-8"></path> <path d="M14 17h-5"></path> <path d="M9 13h5v-4h-5z"></path> <path d="M15 5v-2"></path> <path d="M18 6l2 -2"></path> <path d="M19 9h2"></path> </svg> 
            <span class="text-lg ml-3">Ver Campañas Expirados</span>
        </a>
    @endunless

    @unless (request()->routeIs('corporate.wallets.view.future'))
        <a href="{{ route('corporate.wallets.view.future', $wallet->id) }}" class="flex text-blue-600 mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                <path d="M4 21v-4a3 3 0 0 1 3 -3h5"></path>
                <path d="M9 17l3 -3l-3 -3"></path>
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M5 11v-6a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-9.5"></path>
            </svg>
            <span class="text-lg ml-3">Ver Campañas Futuras</span>
        </a>
    @endunless
</div>