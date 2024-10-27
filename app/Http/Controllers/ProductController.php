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
            'materials' => 'array',
            'materials.*.selected' => 'boolean',
            'materials.*.quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::create($request->only(['name', 'price']));

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
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'price']));
    
        if ($request->filled('raw_materials')) {
            $materials = [];
            foreach ($request->raw_materials as $material_id => $quantity) {
                $materials[$material_id] = ['quantity' => $quantity];
            }
            $product->materials()->sync($materials);
        } else {
            $product->materials()->detach();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
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
