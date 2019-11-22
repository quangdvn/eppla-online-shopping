<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckOutController extends Controller
{
    protected function storeOrderDetail($request, $error)
    {
        //* Insert into orders table after success payment
        $newOrder = Order::create([
            'customer_id' => auth()->user() ? auth()->user()->customer->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => calculateTotal()->get('discount'),
            'billing_discount_code' => calculateTotal()->get('code'),
            'billing_subtotal' => calculateTotal()->get('newSubtotal'),
            'billing_tax' => calculateTotal()->get('newTax'),
            'billing_total' => calculateTotal()->get('newTotal'),
            'error' => $error,
        ]);

        //* Insert into order_product table after success payment
        foreach (Cart::instance('shopping')->content() as $cartItem) {
            OrderProduct::create([
                'order_id' => $newOrder->id,
                'product_id' => $cartItem->model->id,
                'quantity' => $cartItem->qty
            ]);
        }
    }

    public function __construct()
    {
        // $this->middleware('auth');
    }

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

        if (auth()->user() && request()->is('guestcheckout')) {
            return redirect()->route('checkout.index');
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
        //* Temporary create a JSON data to send to Stripe
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

            //? SUCCESSFUL charge

            $this->storeOrderDetail($request, null);

            //* Clear out the current Cart
            Cart::instance('shopping')->destroy();

            session()->forget('coupon');

            return redirect()
                    ->route('confirmation.index')
                    ->with('success_message', 'Thank you, your payment has been successfully accepted !!');
        } catch (CardErrorException $e) {
            //! ERROR charge
            $this->storeOrderDetail($request, $e->getMessage());

            return back()
                    ->withInput()
                    ->withErrors("Error! {$e->getMessage()}");
        }
    }
}
