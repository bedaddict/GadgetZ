<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi antara Category dan Product.
     * Satu category dapat memiliki banyak product.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}