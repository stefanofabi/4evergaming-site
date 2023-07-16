<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePlayerHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'count',
        
    ];
}
