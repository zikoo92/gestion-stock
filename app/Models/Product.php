<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name', 
        'sku', 
        'prix_achat', 
        'prix_vente', 
        'quantite', 
        'image'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/no-image.png');
    }
}
