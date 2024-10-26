<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CashierController extends Controller
{
    public function showCart()
    {
        $cart = Session::get('cart', []);
        $products = Product::all();

        return view('cashier.cart', compact('cart', 'products'));
    }

    public function addToCart(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;   
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cashier.cart')->with('success', 'Product added to the cart successfully');
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return back()->with(['cart' => 'Your cart is empty']);
        }

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                foreach($product->materials as $material) {
                    $rawMaterial = RawMaterial::find($material->id);
                    if ($rawMaterial && $rawMaterial->quantity >= $material->pivot->quantity * $item['quantity']) {
                        $rawMaterial->quantity -= $material->pivot->quantity * $item['quantity'];
                        $rawMaterial->save();
                    } else {
                        return back()->withErrors(['material' => 'Not enough stocks for' . $rawMaterial->name]);
                    }
                }
            }
        }

        Session::forget('cart');

        return redirect()->route('cashier.cart')->with('success', 'Transaction completed!');
    }
}
