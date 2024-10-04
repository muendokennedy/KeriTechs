<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
       return Inertia::render('Admin/AdminProducts');
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
