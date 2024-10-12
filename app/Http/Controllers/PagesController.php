<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function adminDashBoard()
    {
        return view('admin.dashboard');
    }

    public function product()
    {
        return view('admin.product');
    }

    public function inventory()
    {
        return view('admin.inventory');
    }

    public function sales()
    {
        return view('admin.sales');
    }

    public function userManagement()
    {
        return view('admin.users');
    }
}
