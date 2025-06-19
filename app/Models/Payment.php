<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    protected $fillable = [
        'first_name',
        'last_name',
        'email',

        'description',
        'transaction',
        'payment_method',
        'payment_type',
        'external_reference',
        'date',
        'amount',
        'status',

        'verified',

        'client_id'
    ];
}
