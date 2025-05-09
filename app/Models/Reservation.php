<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'table_id',
        'guests',
        'telephone',
        'email',
        'date',
        'payment_id',
        'dp',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id', );
    }

    public function table() : BelongsTo {
        return $this->belongsTo(Table::class, 'table_id', );
    }

    public function payment() : BelongsTo {
        return $this->belongsTo(Payment::class, 'payment_id', );
    }
}


