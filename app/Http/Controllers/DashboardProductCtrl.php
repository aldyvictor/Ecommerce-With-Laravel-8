<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
