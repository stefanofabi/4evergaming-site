<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * Get the servers for the country.
     */
    public function servers()
    {
        return $this->hasMany(Server::class);
    }
}
