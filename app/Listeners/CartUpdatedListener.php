<?php

namespace App\Listeners;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the Coupon stored in Session when cart is updated.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $coupon = session()->get('coupon')['name'];

        if ($coupon) {
            $newCoupon = Coupon::where('code', $coupon)
            ->first();

            dispatch_now(new UpdateCoupon($newCoupon));
        }
    }
}
