<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {
            if (redirectNotUser(auth()->user())) {
                return redirect('/admin');
            }
        }

        $mightLikeProducts = Product::mightLike()->get();

        return view('cart')->with([
            'mightLikeProducts' => $mightLikeProducts,
            'taxConst' => calculateTotal()->get('taxConst'),
            'discount' => calculateTotal()->get('discount'),
            'newSubtotal' => calculateTotal()->get('newSubtotal'),
            'newTax' => calculateTotal()->get('newTax'),
            'newTotal' => calculateTotal()->get('newTotal')
        ]);
    }

    /**
     * Update a given Resourse
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'valueQuantity' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5 !!']));

            return response()->json(['success' => 'false'], 400);
        }

        // //* Check if user orders more products than in the stock
        if ($request->valueQuantity > $request->productQuantity) {
            session()->flash('errors', collect(['Not enough products in stock now !!']));

            return response()->json(['success' => 'false'], 400);
        }

        Cart::instance('shopping')->update($id, $request->valueQuantity);

        session()->flash('success_message', 'Quantity has been updated !!');

        return response()->json(['success' => 'true'], 200);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        $duplicateProduct = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicateProduct->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
        }

        Cart::instance('shopping')->add($product->id, $product->name, 1, $product->price)
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
     * Clear all Cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {
        Cart::instance('shopping')->destroy();

        session()->forget('coupon');

        return back()->with('success_message', 'Cart has been cleared !!');
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

        $duplicateProduct = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicateProduct->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in WishList');
        }

        Cart::instance('wishList')->add($product->id, $product->name, 1, $product->price)
                ->associate('App\Models\Product');

        return redirect()
                ->route('cart.index')
                ->with('success_message', 'Item added to Wish List');
    }
}
