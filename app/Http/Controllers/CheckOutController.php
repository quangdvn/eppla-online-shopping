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
        return view('checkout');
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
                'amount' => Cart::instance('shopping')->total() / 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    // change to OrderID after using Real MySQL Database
                    'contents' => $paymentContent,
                    'quantity' => Cart::instance('shopping')->count()
                ]
            ]);

            //* Successful charge
            Cart::instance('shopping')->destroy();

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
