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
        return redirect()->route('cashier.cart')->with('success', 'Product added to cart!');
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        DB::transaction(function () use ($cart) {
            $totalAmount = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $totalAmount,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $order->orderItems()->create([
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
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

}
