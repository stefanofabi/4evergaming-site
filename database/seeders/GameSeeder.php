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
            ],    
            [
                'name' => 'Call Of Duty 2', 
                'short_name' => 'COD2',
                'logo' => 'cod2.ico',
                'large_logo' => 'call-of-duty-2-large-logo.png',
                'protocol' => 'cod2',
            ],
            [
                'name' => 'Medal Of Honor: Allied Assault', 
                'short_name' => 'MOHAA',
                'logo' => 'mohaa.ico',
                'large_logo' => 'medal-of-honor-allied-assault-large-logo.png',
                'protocol' => 'mohaa',
            ],
            [
                'name' => 'Call Of Duty: United Offensive', 
                'short_name' => 'CODUO',
                'logo' => 'coduo.ico',
                'large_logo' => 'call-of-duty-united-offensive-large-logo.png',
                'protocol' => 'coduo',
            ],
            [
                'name' => 'Battlefield 2', 
                'short_name' => 'BF2',
                'logo' => 'bf2.ico',
                'large_logo' => 'battlefield-2-large-logo.png',
                'protocol' => 'bf2',
            ],
            [
                'name' => 'Day Of Defeat', 
                'short_name' => 'DOD',
                'logo' => 'dod.ico',
                'large_logo' => 'day-of-defeat-large-logo.png',
                'protocol' => 'dod',
            ],
            [
                'name' => 'Call Of Duty 4', 
                'short_name' => 'COD4',
                'logo' => 'cod4.ico',
                'large_logo' => 'call-of-duty-4-large-logo.png',
                'protocol' => 'cod4',
            ],
            [
                'name' => 'Left 4 Dead 2', 
                'short_name' => 'L4D2',
                'logo' => 'l4d2.ico',
                'large_logo' => 'left-4-dead-2-large-logo.png',
                'protocol' => 'l4d2',
            ],
            [
                'name' => 'Counter-Strike: Source', 
                'short_name' => 'CSS',
                'logo' => 'css.ico',
                'large_logo' => 'counter-strike-source-large-logo.png',
                'protocol' => 'css',
            ],
            [
                'name' => 'No More Room In Hell', 
                'short_name' => 'NMRIH',
                'logo' => 'nmrih.ico',
                'large_logo' => 'no-more-room-in-hell-large-logo.png',
                'protocol' => 'nmrih',
            ]
        ]);

    }
}
