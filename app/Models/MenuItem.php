<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cafeteria_id',
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'is_available',
        'allergens',
        'preparation_time',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'allergens' => 'array',
    ];

    // Relaciones
    public function cafeteria()
    {
        return $this->belongsTo(Cafeteria::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
