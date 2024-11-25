<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CouponValidityDays extends Component
{
    public $coupon;
    public $editable;
    
    public function __construct($coupon, $editable = false)
    {
        $this->coupon = $coupon;
        $this->editable = $editable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.coupon-validity-days');
    }
}
