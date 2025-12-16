<?php

namespace App\Http\Controllers\Dueno;

use App\Http\Controllers\Controller;
use App\Models\Cafeteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CafeteriaController extends Controller
{
    public function create()
    {
        return view('dueno.cafeterias.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
            'opening_hours' => 'nullable|array',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['is_active'] = true;
        
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('cafeterias/logos', 'public');
        }
        
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('cafeterias/covers', 'public');
        }
        
        Cafeteria::create($validated);
        
        return redirect()->route('dueno.dashboard')->with('success', 'Cafetería creada exitosamente');
    }
    
    public function edit($id)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($id);
        return view('dueno.cafeterias.edit', compact('cafeteria'));
    }
    
    public function update(Request $request, $id)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
            'opening_hours' => 'nullable|array',
            'is_active' => 'boolean',
        ]);
        
        if ($request->hasFile('logo')) {
            if ($cafeteria->logo) {
                Storage::disk('public')->delete($cafeteria->logo);
            }
            $validated['logo'] = $request->file('logo')->store('cafeterias/logos', 'public');
        }
        
        if ($request->hasFile('cover_image')) {
            if ($cafeteria->cover_image) {
                Storage::disk('public')->delete($cafeteria->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('cafeterias/covers', 'public');
        }
        
        $cafeteria->update($validated);
        
        return redirect()->route('dueno.dashboard')->with('success', 'Cafetería actualizada exitosamente');
    }
    
    public function destroy($id)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($id);
        
        if ($cafeteria->logo) {
            Storage::disk('public')->delete($cafeteria->logo);
        }
        
        if ($cafeteria->cover_image) {
            Storage::disk('public')->delete($cafeteria->cover_image);
        }
        
        $cafeteria->delete();
        
        return redirect()->route('dueno.dashboard')->with('success', 'Cafetería eliminada exitosamente');
    }
}
