<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * Get the servers for the game.
     */
    public function servers()
    {
        return $this->hasMany(Server::class);
    }

    /**
    * Get the game tags for the game.
    */
    public function gameTags()
    {
        return $this->hasMany(GameTag::class);
    }
}
