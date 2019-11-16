<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::instance('shopping')->count() == 0) {
            return redirect()->route('landing-page');
        }

        return view('checkout')->with([
            'taxConst' => calculateTotal()->get('taxConst'),
            'discount' => calculateTotal()->get('discount'),
            'newSubtotal' => calculateTotal()->get('newSubtotal'),
            'newTax' => calculateTotal()->get('newTax'),
            'newTotal' => calculateTotal()->get('newTotal')
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $paymentContent = Cart::instance('shopping')
            ->content()
            ->map(function ($item) {
                return $item->model->slug . ', ' . $item->qty;
            })
            ->values()
            ->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => calculateTotal()->get('newTotal') / 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    // change to OrderID after using Real MySQL Database
                    'contents' => $paymentContent,
                    'quantity' => Cart::instance('shopping')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson()
                ]
            ]);

            //* Successful charge
            Cart::instance('shopping')->destroy();

            session()->forget('coupon');

            return redirect()
                    ->route('confirmation.index')
                    ->with('success_message', 'Thank you, your payment has been successfully accepted !!');
        } catch (CardErrorException $e) {
            return back()
            ->withInput()
            ->withErrors("Error! {$e->getMessage()}");
        }
    }
}
