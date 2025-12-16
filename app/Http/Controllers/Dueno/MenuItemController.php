<?php

namespace App\Http\Controllers\Dueno;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Cafeteria;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index($cafeteriaId)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($cafeteriaId);
        $menuItems = $cafeteria->menuItems()->with('category')->get();
        $categories = Category::all();
        
        return view('dueno.menu.index', compact('cafeteria', 'menuItems', 'categories'));
    }
    
    public function create($cafeteriaId)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($cafeteriaId);
        $categories = Category::all();
        
        return view('dueno.menu.create', compact('cafeteria', 'categories'));
    }
    
    public function store(Request $request, $cafeteriaId)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($cafeteriaId);
        
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'is_available' => 'boolean',
            'allergens' => 'nullable|array',
            'preparation_time' => 'nullable|integer|min:0',
        ]);
        
        $validated['cafeteria_id'] = $cafeteria->id;
        $validated['is_available'] = $request->has('is_available');
        
        // Manejar imagen base64 del cropper
        if ($request->has('image') && !empty($request->image)) {
            $imageData = $request->image;
            
            // Extraer el contenido base64
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $type = strtolower($type[1]);
                
                $imageData = base64_decode($imageData);
                $filename = 'menu-item-' . time() . '.' . $type;
                
                Storage::disk('public')->put('menu-items/' . $filename, $imageData);
                $validated['image'] = 'menu-items/' . $filename;
            }
        }
        
        MenuItem::create($validated);
        
        return redirect()->route('dueno.menu.index', $cafeteriaId)->with('success', 'Item agregado exitosamente');
    }
    
    public function edit($cafeteriaId, $id)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($cafeteriaId);
        $menuItem = MenuItem::where('cafeteria_id', $cafeteria->id)->findOrFail($id);
        $categories = Category::all();
        
        return view('dueno.menu.edit', compact('cafeteria', 'menuItem', 'categories'));
    }
    
    public function update(Request $request, $cafeteriaId, $id)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($cafeteriaId);
        $menuItem = MenuItem::where('cafeteria_id', $cafeteria->id)->findOrFail($id);
        
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'allergens' => 'nullable|array',
            'preparation_time' => 'nullable|integer|min:0',
        ]);
        
        $validated['is_available'] = $request->has('is_available');
        
        // Manejar imagen recortada en base64
        if ($request->has('image') && !empty($request->image)) {
            $imageData = $request->image;
            
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);
                $type = strtolower($type[1]);
                
                // Eliminar imagen anterior si existe
                if ($menuItem->image) {
                    Storage::disk('public')->delete($menuItem->image);
                }
                
                $filename = 'menu-item-' . time() . '.' . $type;
                Storage::disk('public')->put('menu-items/' . $filename, $imageData);
                $validated['image'] = 'menu-items/' . $filename;
            }
        } else {
            // Si no hay nueva imagen, mantener la actual
            unset($validated['image']);
        }
        
        $menuItem->update($validated);
        
        return redirect()->route('dueno.menu.index', $cafeteriaId)->with('success', 'Item actualizado exitosamente');
    }
    
    public function destroy($cafeteriaId, $id)
    {
        $cafeteria = Cafeteria::where('user_id', Auth::id())->findOrFail($cafeteriaId);
        $menuItem = MenuItem::where('cafeteria_id', $cafeteria->id)->findOrFail($id);
        
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }
        
        $menuItem->delete();
        
        return redirect()->route('dueno.menu.index', $cafeteriaId)->with('success', 'Item eliminado exitosamente');
    }
}
