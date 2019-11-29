<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShopController extends Controller
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

        $pagination = 9;
        $categories = Category::all();

        //* When there is a queryString attach onto the URL
        if (request()->cat) {
            //* Use with() to prevent N+1 Problem
            $products = Product::with('categories')
                        ->whereHas('categories', function ($query) {
                            $query->where('slug', request()->cat);
                        })
                        ->inRandomOrder();
            $categoryName = optional($categories->where('slug', request()->cat)
                                    ->first())
                                    ->name;
            if (!$categoryName) {
                $categoryName = 'Not Found';
            }
        } else {
            $products = Product::where('featured', true)
                                    ->take(12)
                                    ->inRandomOrder();

            $categoryName = 'Featured Products';
        }

        //* After retriving the required products
        //* sort by price if a queryString exists

        if (request()->sort == 'asc') {
            $products = $products
                        ->orderBy('price', 'asc')
                        ->paginate($pagination);
        } elseif (request()->sort == 'desc') {
            $products = $products
                        ->orderBy('price', 'desc')
                        ->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop', compact('products', 'categories', 'categoryName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $dupId = $product->id;

        $duplicateProduct = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($dupId) {
            return $cartItem->id == $dupId;
        });

        $stockStatus = getStockStatus($product->quantity);

        $mightLikeProducts = Product::where('slug', '!=', $slug)->mightLike()->get();

        return view('detail', compact('product', 'mightLikeProducts', 'duplicateProduct', 'stockStatus'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3'
        ]);

        $query = $request->input('query');

        //* Simple implemant with Like
        // $searchProducts = Product::where('name', 'like', "%{$query}%")->paginate(10);

        //* Implement with Searchable package
        $searchProducts = Product::search($query)->paginate(10);

        return view('search-results', compact('searchProducts'));
    }

    public function algoliaSearch()
    {
        if (auth()->user()) {
            if (redirectNotUser(auth()->user())) {
                return redirect('/admin');
            }
        }

        return view('algolia-search-results');
    }
}
