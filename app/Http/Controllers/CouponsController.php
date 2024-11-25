<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Wallet;
use App\Models\Role;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class CouponsController extends Controller
{
    public function index()
    {
        return view('admin.coupons.index');
    }

    public function view($id)
    {
        $coupon = Coupon::find($id);

        return (auth()->user()->role_id == Role::IS_USER)
                    ? view('user.coupon', compact('coupon'))
                    : view('user.coupon', compact('coupon'));
    }

    public function add()
    {
        return view('admin.coupons.add');
    }

    public function add_to_wallet($id)
    {

        if(auth()->user()->corporate_id != Wallet::find($id)->corporate_id){
            return redirect()->route('corporate.brands');
        }
        
        return view('admin.coupons.add', ['id' => $id]);
    }

    public function store(Request $request, $id)
    {

        $wallet = Wallet::find($id);
        $wallet->coupons()->create([
            'name' => $request->name,
            'description' => '',
            'type' => $request->type,
            'tag' => $request->tag,
            'redeem_id' => uniqid(),
            'campain_starts' => '',
            'campain_ends' => '',
            'is_active' => 0,
            'parameters' => 0,
        ]);

        return redirect()->route('corporate.wallets.view', $id);
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $wallet = $coupon->wallet()->first();

        if(auth()->user()->corporate_id != $wallet->corporate_id){
            return redirect()->route('corporate.brands');
        }

        return view('admin.coupons.edit', ['coupon' => $coupon]);
    }

    public function update(Request $request)
    {
        $coupon = Coupon::find($request->id);

        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($daysOfWeek as $day) {
            $requestKey = 'is_valid_' . $day;
            $coupon->$requestKey = $request->$requestKey ? 1 : 0;
        }

        if ($request->campain_starts) {
            $coupon->campain_starts = $request->campain_starts;
        }

        if ($request->campain_finishes) {
            $coupon->campain_finishes = $request->campain_finishes;
        }

        //advanced settings
        if ($request->target_item) {
            $coupon->target_item = $request->target_item;
        }

        if ($request->action) {
            $coupon->action = $request->action;
        }

        if ($request->conditional_item) {
            $coupon->conditional_item = $request->conditional_item;
        }


        if ($request->is_active == 1 && !$this::isPublishable($coupon)) {
            return redirect()->route('corporate.coupons.edit', $coupon->id)->with('status', 'El cupon debe tener fecha de inicio y fin de campaña, y al menos un día de validez para hacerse público.');
        } else if($request->is_active){
            $coupon->is_active = $request->is_active;
        } else{
            $coupon->is_active = 0;
        }

        $coupon->save();

        return redirect()->route('corporate.coupons.edit', $coupon->id);
    }

    static function isPublishable($coupon)
    {
        // Check if campain_starts and campain_finishes are set
        if (!$coupon->campain_starts || !$coupon->campain_finishes) {
            return false;
        }

        // Check if at least one day of the week is set to 1
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        foreach ($daysOfWeek as $day) {
            if ($coupon->{'is_valid_' . $day}) {
                return true; // At least one day is valid
            }
        }

        return false; // No day is set to 1
    }

}
