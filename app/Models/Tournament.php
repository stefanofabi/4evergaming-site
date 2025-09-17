<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    //

    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'max_participants',
        'max_participants_per_team',
        'organizer_id',
        'location',
        'max_players',
        'prize',
        'entry_fee',
        'game_id',
    ];


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
