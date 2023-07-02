<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Game;
use App\Models\GameTag;

class MultiTheftAutoGameTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $mta = Game::where('protocol', 'mta')->firstOrFail();

        $tags = [
            'roleplay',
            'deathmatch',
            'race',
            'pvp',
            'freeroam',
            'zombie',
            'teams',
            'cooperative',
            'ctf',
            'personalized',
        ];
        
        foreach ($tags as $tag) {
            GameTag::insert([
                'name' => $tag, 
                'game_id' => $mta->id
            ]);
        }
    }
}
