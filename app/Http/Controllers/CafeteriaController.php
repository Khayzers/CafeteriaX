<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use App\Models\Category;
use Illuminate\Http\Request;

class CafeteriaController extends Controller
{
    public function index()
    {
        $cafeterias = Cafeteria::where('is_active', true)
            ->with(['user', 'menuItems.category'])
            ->withCount('menuItems')
            ->paginate(12);
            
        $categories = Category::all();
        
        return view('cafeterias.index', compact('cafeterias', 'categories'));
    }
    
    public function show($id)
    {
        $cafeteria = Cafeteria::where('is_active', true)
            ->with(['user', 'menuItems.category'])
            ->findOrFail($id);
            
        return view('cafeterias.show', compact('cafeteria'));
    }
}
