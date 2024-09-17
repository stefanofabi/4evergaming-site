<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkAddress extends Model
{
    use HasFactory;

    public function node()
    {
        return $this->belongsTo(Node::class);
    }
    
}
