<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Order;

class PagesController extends Controller
{
    public function adminDashBoard()
    {
        return view('admin.dashboard');
    }

    public function product()
    {
        return view('admin.product-add');
    }

    public function productDisplay()
    {
        $products = Product::all();
        
        return view('admin.product', compact('products'));
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        return view('admin.update-product', compact('product'));
    }

    public function inventory()
    {
        return view('admin.inventory');
    }

    public function sales($year)
    {
        return view('admin.sales');
    }

    public function userManagement()
    {
        $employees = Employee::all();
        return view('admin.users', compact('employees'));
    }
}
