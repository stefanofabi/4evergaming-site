<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
  use HasFactory;

  protected $fillable = [
    'ip',
    'port',
    'server_address',
    'hostname',
    'map',
    'max_players',
    'users_online',
    'status',
    'join_link',
    'vars',
    'country_id',
    'community_id',
    'game_id',
    'rank',
  ];

  /**
  * Get the community associated with the server.
  */
	public function community() 
  {
		return $this->belongsTo(Community::class);
	}

  /**
  * Get the game associated with the server.
  */
	public function game() 
  {
		return $this->belongsTo(Game::class);
	}

  /**
  * Get the game associated with the server.
  */
	public function country() 
  {
		return $this->belongsTo(Country::class);
	}
}
