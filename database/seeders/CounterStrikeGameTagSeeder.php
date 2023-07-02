<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Game;
use App\Models\GameTag;

class CounterStrikeGameTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $cs16 = Game::where('protocol', 'cs16')->firstOrFail();

        $tags = [
            'bomb',
            'hostage',
            'public',
            'competitive',
            'mix',
            'pcw',
            '1vs1',
            '2vs2',
            'deathmatch',
            'warmup',
            'practice',
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
                'game_id' => $cs16->id
            ]);
        }
    }
}
