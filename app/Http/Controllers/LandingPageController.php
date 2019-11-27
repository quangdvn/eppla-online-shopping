<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingPageController extends Controller
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

        $products = Product::where('featured', true)
                            ->take(8)
                            ->inRandomOrder()
                            ->get();

        return view('landing-page', compact('products'));
    }
}
