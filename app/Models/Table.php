<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    protected $fillable =[
        'name',
        'location',
        'limit',
        'price',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
?>