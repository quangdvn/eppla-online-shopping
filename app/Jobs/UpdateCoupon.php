<?php

namespace App\Jobs;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateCoupon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $coupon;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //* Store discount information into session
        session()->put('coupon', [
            'name' => $this->coupon->code,
            'type' => $this->coupon->type,
            'discount' => $this->coupon->discount(Cart::instance('shopping')->subtotal())
        ]);
    }
}
