<?php

namespace App\Http\Controllers;

use App\Models\Role;

class DashboardController extends Controller
{
    public function redirect()
    {
        if (auth()->user()->role_id == Role::IS_USER) {
            return redirect()->route('public.wallets.index');
        }

        if (auth()->user()->role_id == Role::IS_ADMIN) {
            return redirect()->route('admin.index');
        }

        if (auth()->user()->role_id == Role::IS_CORPORATE) {
            return redirect()->route('corporate.index');
        }
        
        if (auth()->user()->role_id == Role::IS_CASHIER) {
            return redirect()->route('pos');
        }

        if (auth()->user()->role_id == Role::IS_CLERK) {
            return redirect()->route('cards.index');
        }

        //return redirect()->route('wallet');
    }
}
