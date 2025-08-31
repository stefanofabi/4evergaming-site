<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    //

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * Get the favorite maps for the server.
    */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
