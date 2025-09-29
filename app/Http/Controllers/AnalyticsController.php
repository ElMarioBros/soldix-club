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
        $corporate = auth()->user()->corporate;
        
        // Create base query builder that we'll clone for different purposes
        $baseQuery = $corporate->users()
            ->where('role_id', Role::IS_USER);

        // Get all stats in a single query for better performance
        $basicStats = (clone $baseQuery)
            ->select([
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as today'),
                DB::raw('SUM(CASE WHEN DATE(created_at) = CURDATE() - INTERVAL 1 DAY THEN 1 ELSE 0 END) as yesterday')
            ])
            ->first();

        // Get distributions in a single query
        $distributions = (clone $baseQuery)
            ->select([
                'gender',
                'occupation',
                'age',
                DB::raw('COUNT(*) as count')
            ])
            ->whereNotNull('gender')
            ->groupBy('gender', 'occupation', 'age')
            ->get();

        // Process the distributions data
        $genderDistribution = $distributions->groupBy('gender')
            ->map->count()
            ->toArray();

        $occupationDistribution = $distributions->groupBy('occupation')
            ->map->count()
            ->sortDesc()
            ->take(6)
            ->toArray();

        // Process age ranges
        $ageRanges = [
            '18-24' => [18, 24],
            '25-34' => [25, 34],
            '35-44' => [35, 44],
            '45-54' => [45, 54],
            '55+' => [55, 150]
        ];

        $ageDistribution = array_map(function($range) use ($distributions) {
            return $distributions->whereBetween('age', $range)->count();
        }, $ageRanges);

        return view('corporate.analytics.clients', [
            'users' => (clone $baseQuery)->orderBy('created_at', 'desc')->paginate(35),
            'totalUsers' => $basicStats->total,
            'todayUsers' => $basicStats->today,
            'yesterdayUsers' => $basicStats->yesterday,
            'genderDistribution' => $genderDistribution,
            'ageDistribution' => $ageDistribution,
            'occupationDistribution' => $occupationDistribution
        ]);
    }

}
