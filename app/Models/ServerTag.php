<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'game_tag_id',
        
    ];

    public function gameTag()
    {
        return $this->belongsTo(GameTag::class);
    }
}
