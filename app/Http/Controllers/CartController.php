<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightLikeProducts = Product::mightLike()->get();

        return view('cart', compact('mightLikeProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::instance('shopping')->add($request->id, $request->name, 1, $request->price)
                ->associate('App\Models\Product');

        return redirect()
                ->route('cart.index')
                ->with('success_message', 'Item was added to your cart !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('shopping')->remove($id);

        return back()->with('success_message', 'Item has been remove !!');
    }

    /**
     * Move to Wish List to buy later
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveToWishList($id)
    {
        $product = Cart::instance('shopping')->get($id);

        Cart::instance('shopping')->remove($id);

        $duplicateProduct = Cart::instance('shopping')->search(function($cartItem,$rowId) use($id) {
            return $rowId === $id;
        });

        if($duplicateProduct->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in WishList');
        }

        Cart::instance('wishList')->add($product->id, $product->name, 1, $product->price)
                ->associate('App\Models\Product');

        return redirect()
                ->route('cart.index')
                ->with('success_message', 'Item added to Wish List');
    }
}
