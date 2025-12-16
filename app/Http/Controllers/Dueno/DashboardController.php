<?php

namespace App\Http\Controllers\Dueno;

use App\Http\Controllers\Controller;
use App\Models\Cafeteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Verificar que sea dueño
        if (!$user->isDueno()) {
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
        }

        $cafeterias = Cafeteria::where('user_id', $user->id)
            ->withCount('menuItems', 'inventoryItems')
            ->get();

        return view('dueno.dashboard', compact('cafeterias'));
    }
}
