<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cafeterias = Cafeteria::where('is_active', true)
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::orderBy('order')->get();

        return view('home', compact('cafeterias', 'categories'));
    }
}
