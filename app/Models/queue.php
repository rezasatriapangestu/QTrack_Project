<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class queue extends Model
{
    protected $fillable = [
        'service_id',
        'counter_id',
        'number',
        'status',
        'called_at',
        'served_at',
        'canceled_at',
        'finished_at',
    ];
}
