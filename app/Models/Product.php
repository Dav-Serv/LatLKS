<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable =[
        'image',
        'name',
        'category_id',
        'desc',
        'stock',
        'price',
    ];

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', );
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
