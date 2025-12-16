<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()
            ->with('favoritable')
            ->where('favoritable_type', Cafeteria::class)
            ->get()
            ->pluck('favoritable');

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request, $cafeteriaId)
    {
        $cafeteria = Cafeteria::findOrFail($cafeteriaId);
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('favoritable_type', Cafeteria::class)
            ->where('favoritable_id', $cafeteriaId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Cafetería eliminada de favoritos'
            ]);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'favoritable_type' => Cafeteria::class,
                'favoritable_id' => $cafeteriaId,
            ]);
            return response()->json([
                'success' => true,
                'favorited' => true,
                'message' => 'Cafetería agregada a favoritos'
            ]);
        }
    }

    public function check($cafeteriaId)
    {
        if (!Auth::check()) {
            return response()->json(['favorited' => false]);
        }

        $favorited = Favorite::where('user_id', Auth::id())
            ->where('favoritable_type', Cafeteria::class)
            ->where('favoritable_id', $cafeteriaId)
            ->exists();

        return response()->json(['favorited' => $favorited]);
    }
}
