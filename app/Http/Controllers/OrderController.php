<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //* Solve N+1 issue
        $orders = auth()->user()->customer->orders()->with('products')->get();

        return view('auth.current-user.my-orders', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $products = $order->products;

        return view('auth.current-user.my-order', compact('products', 'order'));
    }
}
