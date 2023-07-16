<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
  use HasFactory;

  /**
  * The attributes that aren't mass assignable.
  *
  * @var array
  */
  protected $guarded = [
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

  /**
  * Get the game tags for the server.
  */
  public function serverTags()
  {
    return $this->hasMany(ServerTag::class);
  }

  /**
  * Get the favorite maps for the server.
  */
  public function favoriteMaps()
  {
    return $this->hasMany(FavoriteMap::class);
  }

  /**
  * Get the historical online players for the server.
  */
  public function onlinePlayerHistories()
  {
    return $this->hasMany(OnlinePlayerHistory::class);
  }
}
