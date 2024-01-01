<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Game;
use App\Models\GameTag;

class CounterStrikeGlobbalOffensiveGameTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $csgo = Game::where('protocol', 'cs2')->firstOrFail();

        $tags = [
            'bomb',
            'hostage',
            'public',
            'competitive',
            '1vs1',
            '2vs2',
            'deathmatch',
            'ctf',
            'kz',
            'zombie',
            'deathrun',
            'soccerjam',
            'gungame',
            'jailbreak',
            'fruit',
            'only',
            'retakes',
            'personalized',
        ];
        
        foreach ($tags as $tag) {
            GameTag::insert([
                'name' => $tag, 
                'game_id' => $csgo->id
            ]);
        }
    }
}
