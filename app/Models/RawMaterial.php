<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'unit'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_materials')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
