<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cafeteria_id',
        'name',
        'description',
        'quantity',
        'unit',
        'min_quantity',
        'cost',
        'expiration_date',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'min_quantity' => 'decimal:2',
        'cost' => 'decimal:2',
        'expiration_date' => 'date',
    ];

    // Relaciones
    public function cafeteria()
    {
        return $this->belongsTo(Cafeteria::class);
    }

    // Helpers
    public function isLowStock()
    {
        return $this->quantity <= $this->min_quantity;
    }

    public function isExpired()
    {
        return $this->expiration_date && $this->expiration_date->isPast();
    }
}
