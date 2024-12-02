<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\RawMaterial;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('materials')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rawMaterials = RawMaterial::all();
        return view('products.create', compact('rawMaterials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'materials' => 'array',
            'materials.*.selected' => 'boolean',
            'materials.*.quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::create($request->only(['name', 'price']));

        // Handle image upload
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->move(public_path('products'), $request->file('photo')->getClientOriginalName());
            $product->photo = 'products/' . $request->file('photo')->getClientOriginalName();
            $product->save();
        }

        foreach ($request->materials as $materialId => $material) {
            if (isset($material['selected']) && $material['selected'] == '1') {
                $quantity = $material['quantity'] ?? 0;
                $product->materials()->attach($materialId, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $rawMaterials = RawMaterial::all(); 
        return view('products.edit', compact('product', 'rawMaterials'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'materials' => 'array',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;

        // Handle image upload
        if ($request->hasFile('photo')) {
            // Optionally delete the old image if you want
            if ($product->photo) {
                unlink(public_path($product->photo)); // Delete old image
            }
            $imagePath = $request->file('photo')->move(public_path('products'), $request->file('photo')->getClientOriginalName());
            $product->photo = 'products/' . $request->file('photo')->getClientOriginalName();
        }

        $product->save();

        $materials = $request->input('materials', []);
        $syncData = [];

        foreach ($materials as $materialId => $data) {
            if (isset($data['selected']) && $data['selected'] == 1) {
                $syncData[$materialId] = ['quantity' => $data['quantity'] ?? 0]; 
            }
        }

        $product->materials()->sync($syncData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
