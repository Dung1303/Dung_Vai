<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table = 'products';

    protected $fillable = ['name', 'price', 'stock', 'category_id'];

    // Quan hệ với categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}