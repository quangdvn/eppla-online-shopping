<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->couponCode)
                        ->first();

        if (!$coupon) {
            return redirect()
                    ->route('cart.index')
                    ->withInput()
                    ->withErrors('Invalid coupon code. Please try again !!');
        } else {
            dispatch_now(new UpdateCoupon($coupon));
        }

        return redirect()
                ->route('cart.index')
                ->with('success_message', 'Coupon has been applied !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return back()->with('success_message', 'Coupon has been removed.');
    }
}
