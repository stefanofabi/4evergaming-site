<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirewallRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_ip',
        'flow',
        'protocol',
        'network_address_id',
        'destination_port',
        'action',
        'comment',
        
    ];

    public function networkAddress()
    {
        return $this->belongsTo(NetworkAddress::class);
    }
}
