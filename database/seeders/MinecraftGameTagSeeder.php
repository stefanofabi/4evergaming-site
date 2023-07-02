<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Game;
use App\Models\GameTag;

class MinecraftGameTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $minecraft = Game::where('protocol', 'minecraft')->firstOrFail();

        $tags = [
            'java',
            'bedrock',
            'vanilla',
            'spigot',
            'craftbukkit',
            'survival',
            'adventure',
            'creative',
            'extreme',
            'pvp',
            'spectator',
            'personalized',
        ];
        
        foreach ($tags as $tag) {
            GameTag::insert([
                'name' => $tag, 
                'game_id' => $minecraft->id
            ]);
        }
    }
}
