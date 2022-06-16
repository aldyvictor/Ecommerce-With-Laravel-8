<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardProductCtrl extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
                    ->where('user_id', Auth::user()->id)
                    ->get();
        return view('pages.dashboard-products', ['products' => $products]);
    }

    public function details()
    {
        return view('pages.dashboard-products-details');
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', ['categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->product_name);
        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photos')->store('assets/products', 'public')
        ];

        $productGallery = ProductGallery::create($gallery);

        return redirect()->route('dashboard-products');
    }
}
