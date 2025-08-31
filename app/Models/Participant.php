<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //

    public function user() 
    {
		return $this->belongsTo(User::class);
	}

    public function tournament() 
    {
		return $this->belongsTo(Tournament::class);
	}
}
