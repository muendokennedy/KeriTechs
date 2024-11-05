<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class AdminController extends Controller
{
    //
    public function adminHome()
    {
        return Inertia::render('Admin/AdminHome');
    }
    public function adminAnalytics()
    {
        return Inertia::render('Admin/AdminAnalytics');
    }
    public function adminProducts()
    {
      $products = Product::all();

       return Inertia::render('Admin/AdminProducts', [
         'products' => ProductResource::collection($products)
       ]);
    }
    public function adminOrders()
    {
       return Inertia::render('Admin/AdminOrders');
    }
    public function adminStock()
    {
       return Inertia::render('Admin/AdminStock');
    }
    public function adminClientinfo()
    {
       return Inertia::render('Admin/AdminClientInfo');
    }
    public function adminSettings()
    {
       return Inertia::render('Admin/AdminSettings');
    }
}
