<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterial;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = RawMaterial::all();

        return view('inventory.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required|min:1',
            'unit' => 'required|string|max:50'
        ]);

        $rawMaterial = RawMaterial::create($validatedData);

        return redirect()->route('inventory.index')->with('success', 'Raw material added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawMaterial $rawMaterial)
    {
        return view('inventory.edit', compact('rawMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50'
        ]);

        $rawMaterial->update($request->all());
        
        return redirect()->route('inventory.index')->with('success', 'Raw material updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        $rawMaterial = RawMaterial::findOrFail($id);

        $rawMaterial->delete();
        
        return redirect()->route('inventory.index')->with('success', 'Raw material deleted successfully');
    }
}
