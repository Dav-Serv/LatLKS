<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    protected $fillable =[
        'name',
        'desc',
        'status',
    ];
}
