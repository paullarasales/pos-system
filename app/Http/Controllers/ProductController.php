<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'photo' => 'nullable|image'
        ]);

        $product = Product::create($validatedData);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('products', $filename, 'public');

            $product->photo = $path;

            $product->save();
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        return view('admin.update-product', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::delete($product->photo);
            }
            $product->photo = $request->file('photo')->store('products');
        }
        $product->save();

        return response()->json(['success' => 'Product updated successfully!',
            'product' => $product,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        $product->delete();

        return response()->json([
            'message' => 'Prodcut deleted successfully'
        ]);
    }
}
