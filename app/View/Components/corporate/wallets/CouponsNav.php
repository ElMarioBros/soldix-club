<?php

namespace App\View\Components\corporate\wallets;

use App\Models\Wallet;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CouponsNav extends Component
{
    public function __construct(Wallet $wallet) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.corporate.wallets.coupons-nav');
    }
}
