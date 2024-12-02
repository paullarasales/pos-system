<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterial;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $materials = RawMaterial::all();
            return view('inventory.index', compact('materials', 'user'));
        } else {
            return redirect()->route('login')->with('message', 'Please log in to access the dashboard.');
        }
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
    public function edit($id)
    {
        $rawMaterial = RawMaterial::findOrFail($id);
        return view('inventory.edit', compact('rawMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rawMaterial = RawMaterial::findOrFail($id);
        $rawMaterial->update($request->only(['name', 'quantity', 'unit']));

        return redirect()->route('inventory.index')->with('success', 'Raw Material updated successfully.');
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
