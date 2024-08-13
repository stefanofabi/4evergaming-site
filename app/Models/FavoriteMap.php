<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'map',
        'name',
        
    ];
}
