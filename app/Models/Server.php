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
    'num_players',
    'max_players',
    'status',
    'join_link',
    'vars',
    'players',
    'country_id',
    'community_id',
    'game_id',
    'rank',
    'description',
    
  ];

  /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
      'vars' => 'json',
      'players' => 'json',
      
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
