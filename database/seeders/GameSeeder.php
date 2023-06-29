<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Game::insert([
            [
                'name' => 'Counter-Strike 1.6', 
                'logo' => 'counter-strike16.ico',
                'short_name' => 'CS 1.6',
                'large_logo' => 'counter-strike16-large-logo.png',
                'protocol' => 'cs16'
            ],
            [
                'name' => 'Counter-Strike: Global Offensive', 
                'short_name' => 'CS:GO',
                'logo' => 'counter-strike-global-offensive.ico',
                'protocol' => 'csgo',
                'large_logo' => 'counter-strike-global-offensive-large-logo.png'
            ],
            [
                'name' => 'Multi Theft Auto', 
                'short_name' => 'MTA',
                'logo' => 'multi-theft-auto.ico',
                'large_logo' => 'multi-theft-auto-large-logo.png',
                'protocol' => 'mta',
            ],
            [
                'name' => 'Minecraft', 
                'short_name' => 'MC',
                'logo' => 'minecraft.ico',
                'large_logo' => 'minecraft-large-logo.png',
                'protocol' => 'minecraft',
            ]   
        ]);

    }
}