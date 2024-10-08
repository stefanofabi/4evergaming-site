<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GameSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CounterStrikeGameTagSeeder::class);
        $this->call(CounterStrikeGlobbalOffensiveGameTagSeeder::class);
        $this->call(MinecraftGameTagSeeder::class);
        $this->call(MultiTheftAutoGameTagSeeder::class);
        $this->call(NodeSeeder::class);
        $this->call(NetworkAddressSeeder::class);
        
    }
}
