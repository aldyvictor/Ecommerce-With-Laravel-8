<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailCtrl extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with('galleries', 'user')->where('slug', $id)->firstOrFail();
        return view('pages.detail', ['product' => $product]);
    }

    public function addToCart(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => auth()->user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
