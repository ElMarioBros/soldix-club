<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\RedeemedCoupon;
use App\Models\Coupon;
use App\Models\Card;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(): View 
    {
        // Today and yesterday redemptions
        $todayRedemptions = RedeemedCoupon::whereDate('created_at', Carbon::today())->count();
        $yesterdayRedemptions = RedeemedCoupon::whereDate('created_at', Carbon::yesterday())->count();
        
        // Add these new metrics
        $totalRedemptions = RedeemedCoupon::count();
        $todayRegisteredCards = Card::whereDate('created_at', Carbon::today())->count();
        
        // Total registered cards
        $registeredCards = Card::count();

        // Top redeemed coupons
        $topRedeemedCoupons = DB::table('redeemed_coupons')
            ->join('coupons', 'redeemed_coupons.coupon_id', '=', 'coupons.id')
            ->select(
                'coupons.name as title',
                'coupons.type as brand',
                DB::raw('COUNT(*) as redemptions')
            )
            ->where('coupons.is_active', true)
            ->groupBy('coupons.id', 'coupons.name', 'coupons.type')
            ->orderByRaw('COUNT(*) DESC')
            ->take(5)
            ->get();

        $weeklyRedemptions = collect(range(0, 6))
            ->map(function($days) {
                return [
                    'date' => Carbon::now()->subDays($days),
                    'count' => RedeemedCoupon::whereDate('created_at', Carbon::now()->subDays($days))
                        ->count()
                ];
            })
            ->values()
            ->toArray();

        // All active coupons
        $allCoupons = Coupon::select(
                'name as title', 
                'description', 
                'type as brand', 
                'tag as category',
                'is_active',
                'campain_starts as starts_at',
                'campain_finishes as expires_at'
            )
            ->where('is_active', '1')
            ->get();

        // Recent redemptions
        $recentRedemptions = RedeemedCoupon::select(
                'redeemed_coupons.cashier',
                'redeemed_coupons.created_at',
                'redeemed_coupons.user_id',
                'redeemed_coupons.coupon_id'
            )
            ->join('users', 'redeemed_coupons.user_id', '=', 'users.id')
            ->join('cards', 'users.id', '=', 'cards.user_id')
            ->with(['coupon'])
            ->latest('redeemed_coupons.created_at')
            ->take(8)
            ->get()
            ->map(function($redemption) {
                $user = User::find($redemption->user_id);
                $card = $user->card;
                
                return (object)[
                    'cashier' => $redemption->cashier,
                    'created_at' => $redemption->created_at,
                    'card_number' => '*****' . substr($card->public_code, -4),
                    'user_name' => $user->name,
                    'coupon_title' => $redemption->coupon->name,
                    'coupon_brand' => $redemption->coupon->type,
                    'store_name' => $redemption->brand
                ];
            });

        return view('corporate.analytics.index', compact(
            'todayRedemptions',
            'yesterdayRedemptions',
            'registeredCards',
            'topRedeemedCoupons',
            'weeklyRedemptions',
            'allCoupons',
            'recentRedemptions',
            'totalRedemptions',
            'todayRegisteredCards'
        ));
    }

    public function indexClients(): View 
    {
        return view('corporate.analytics.clients', [
            'users' => auth()->user()->corporate->users()
                ->where('role_id', Role::IS_USER)
                ->orderBy('created_at', 'desc')
                ->paginate(60)
        ]);
    }

}
