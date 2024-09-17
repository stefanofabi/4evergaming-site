<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Node;
use App\Models\NetworkAddress;

class NetworkAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $nodesWithIps = [
            'Chain' => ['45.235.98.65', '45.235.98.68'],
            'Ester' => ['45.235.98.59', '45.235.98.66', '45.235.98.67'],
            'Ghost' => ['45.235.98.41',	'45.235.98.62',	'45.235.98.63',	'45.235.98.64'],
            'Lava' => ['45.235.98.50',	'45.235.98.61',	'45.235.98.69',	'45.235.98.74'],
            'Raider' => ['45.235.98.42', '45.235.98.48'],
            'Ray' => ['45.235.98.40', '45.235.98.44', '45.235.98.98'],
            'Storm' => ['45.235.99.18'],
        ];

        foreach ($nodesWithIps as $nodeName => $ips) 
        {
            // get node by name
            $node = Node::where('name', $nodeName)->firstOrFail();
        
            // insert ip addresses
            foreach ($ips as $ip) {
                $node->networkAddresses()->create([
                    'ip_address' => $ip,
                    'node_id' => $node->id
                ]);
            }
        }


    }
}
