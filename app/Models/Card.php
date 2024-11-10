<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    GET USER
    GET WALLETS THAT BELONG TO THIS BRAND
    FOR EACH WALLETS AS WALLET
        GET COUPONS THAT BELONG TO THE WALLET

    */

}
