<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Analítica
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Tarjetas de estadísticas principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Cupones canjeados hoy -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Canjeados Hoy</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $todayRedemptions ?? 0 }}</p>
                                <p class="text-xs text-gray-400">
                                    @if(($yesterdayRedemptions ?? 0) > 0)
                                        @php $change = (($todayRedemptions ?? 0) - ($yesterdayRedemptions ?? 0)) / ($yesterdayRedemptions ?? 1) * 100 @endphp
                                        <span class="{{ $change >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $change >= 0 ? '+' : '' }}{{ number_format($change, 1) }}%
                                        </span> que ayer ({{ $yesterdayRedemptions }})
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Canjeados -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Canjeados</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalRedemptions ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjetas registradas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Tarjetas Registradas</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $registeredCards ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjetas registradas hoy -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Tarjetas Registradas Hoy</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $todayRegisteredCards ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos y tablas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Cupones más canjeados -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Cupones Más Canjeados</h3>
                        <div class="space-y-4">
                            @forelse($topRedeemedCoupons ?? [] as $coupon)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 text-sm">{{ $coupon->title }}</p>
                                    <p class="text-xs text-gray-500">{{ $coupon->brand }}</p>
                                </div>
                                <div class="text-right ml-4">
                                    <p class="text-lg font-semibold text-gray-900">{{ $coupon->redemptions }}</p>
                                    <p class="text-xs text-gray-500">canjes</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500">No hay datos de canjes disponibles</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Actividad por tienda -->
                {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Actividad por Tienda</h3>
                        <div class="space-y-4">
                            @forelse($storeActivity ?? [] as $store)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 text-sm">{{ $store->name ?? 'Tienda N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $store->location ?? 'Sin ubicación' }}</p>
                                </div>
                                <div class="text-right ml-4">
                                    <p class="text-lg font-semibold text-gray-900">{{ $store->daily_scans ?? 0 }}</p>
                                    <p class="text-xs text-gray-500">escaneos hoy</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500">No hay datos de tiendas disponibles</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div> --}}

                <!-- Tendencia de canjes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Canjes por Día (Últimos 7 días)</h3>
                        <div class="mt-4">
                            <div class="flex items-end justify-between h-32 space-x-1">
                                @php
                                    $counts = array_column($weeklyRedemptions, 'count');
                                    $maxRedemptions = max($counts);
                                @endphp
                                @foreach($weeklyRedemptions as $data)
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-blue-200 rounded-t flex items-end justify-center pb-1" 
                                            style="height: {{ $maxRedemptions > 0 ? ($data['count'] / $maxRedemptions) * 120 : 0 }}px; min-height: 20px;">
                                            <span class="text-xs text-blue-800 font-medium">{{ $data['count'] }}</span>
                                        </div>
                                        <span class="text-xs text-gray-500 mt-1">{{ $data['date']->format('d/m') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Canjes recientes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Canjes Recientes</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha/Hora
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tarjeta
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cupón
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cajero
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentRedemptions ?? [] as $redemption)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $redemption->created_at ? Carbon\Carbon::parse($redemption->created_at)->format('d/m/Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <code class="px-2 py-1 text-xs bg-gray-100 rounded">{{ $redemption->card_number }}</code>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $redemption->user_name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $redemption->coupon_title }}</div>
                                        <div class="text-xs text-gray-500">{{ $redemption->coupon_brand }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $redemption->cashier }}</div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No hay canjes recientes
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>