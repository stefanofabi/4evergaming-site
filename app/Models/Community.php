<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $guarded = [
        'user_id',  
        'calification'
    ];

    /**
     * Get the user associated with the community.
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the servers for the community.
     */
    public function servers()
    {
        return $this->hasMany(Server::class);
    }
}
