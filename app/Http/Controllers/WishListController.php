<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

class WishListController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('wishList')->remove($id);

        return back()->with('success_message', 'Item has been remove !!');
    }

    /**
     * Move current item to Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveToCart($id)
    {
        $product = Cart::instance('wishList')->get($id);

        Cart::instance('wishList')->remove($id);

        $duplicateProduct = Cart::instance('wishList')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicateProduct->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your Cart');
        }

        Cart::instance('shopping')->add($product->id, $product->name, 1, $product->price)
                ->associate('App\Models\Product');

        return redirect()
                ->route('cart.index')
                ->with('success_message', 'Item added to your Cart !!');
    }
}
