<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_url',
        'logo',
        'user_id',
        'description',
        
    ];

    /**
  * Get the user associated with the community.
  */
	public function user() 
    {
          return $this->belongsTo(User::class);
      }

}
