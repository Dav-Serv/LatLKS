<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name'
    ];

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
