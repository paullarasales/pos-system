<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CashierController extends Controller
{
    public function showCart(Request $request)
    {
        $cart = Session::get('cart', []);
    
        $query = $request->input('search');
        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            $products = Product::all();
        }

        return view('cashier.cart', compact('cart', 'products'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price, // Ensure price is included
                'quantity' => 1,
            ];
        }
    
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        
        \Log::info('Cart contents:', $cart);

        if (!auth()->check()) {
            return back()->withErrors(['auth' => 'You must be logged in to checkout.']);
        }

        $employeeId = auth()->id(); 

        DB::transaction(function () use ($cart, $employeeId) {
            $totalAmount = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'employee_id' => $employeeId,
                'total_amount' => $totalAmount,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $order->orderItems()->create([
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'], // Ensure price is accessed correctly
                    ]);

                    foreach ($product->materials as $material) {
                        $rawMaterial = RawMaterial::find($material->id);
                        $requiredQuantity = $material->pivot->quantity * $item['quantity'];

                        if ($rawMaterial && $rawMaterial->quantity >= $requiredQuantity) {
                            $rawMaterial->quantity -= $requiredQuantity;
                            $rawMaterial->save();
                        } else {
                            throw new \Exception('Not enough stock for ' . $rawMaterial->name);
                        }
                    }
                }
            }
        });

        Session::forget('cart');

        return redirect()->route('cashier.cart')->with('success', 'Transaction completed successfully!');
    }
    public function cancel()
    {
        Session::forget('cart');
        return redirect()->route('cashier.cart')->with('success', 'Transaction cancelled successfully.');
    }
}
