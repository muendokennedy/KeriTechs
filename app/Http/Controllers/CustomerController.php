<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    //

    public function index()
    {
        return Inertia::render('Welcome');
    }
    public function about()
    {
        return Inertia::render('About');
    }
    public function products()
    {
       return Inertia::render('Products');
    }
    public function contact()
    {
       return Inertia::render('Contact');
    }
    public function cart()
    {
       return Inertia::render('Cart');
    }
    public function productpage()
    {
       return Inertia::render('ProductPage');
    }
}
