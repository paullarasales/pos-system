<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function materials()
    {
        return $this->belongsToMany(RawMaterial::class, 'product_materials')
                    ->withPivot('quantity');
    }

    /**
     * Process the sale and reduce raw material quantities.
     *
     * @param int $quantitySold
     * @return void
     */

     public function processSale(int $quantitySold)
    {
        foreach ($this->materials as $material) {
            $totalQuantitySold = $material->pivot->quantity * $quantitySold;
            $material->quantity -= $totalQuantitySold;
            $material->save();
        }
    }
}
