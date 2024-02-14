<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('redeemed_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('coupon_id');
            $table->string('cashier')->nullable();
            $table->string('session')->nullable();
            $table->string('transaction_data')->nullable();
            $table->string('brand')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeemed_coupons');
    }
};