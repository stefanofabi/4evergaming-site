<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Country::insert([
            [
                'name' => 'Argentina',
                'short_name' => 'AR',
                'flag' => 'ar.png'
            ],
            [
                'name' => 'Brasil',
                'short_name' => 'BR',
                'flag' => 'br.png'
            ],
            [
                'name' => 'Canadá',
                'short_name' => 'CA',
                'flag' => 'ca.png'
            ],
            [
                'name' => 'Chile',
                'short_name' => 'CL',
                'flag' => 'cl.png'
            ],
            [
                'name' => 'Estados Unidos',
                'short_name' => 'US',
                'flag' => 'us.png'
            ],
            [
                'name' => 'México',
                'short_name' => 'MX',
                'flag' => 'mx.png'
            ],
            [
                'name' => 'Paraguay',
                'short_name' => 'PY',
                'flag' => 'py.png'
            ],
            [
                'name' => 'Perú',
                'short_name' => 'PE',
                'flag' => 'pe.png'
            ],
            [
                'name' => 'Uruguay',
                'short_name' => 'UY',
                'flag' => 'uy.png'
            ],
            [
                'name' => 'Venezuela',
                'short_name' => 'VE',
                'flag' => 've.png'
            ]
        ]);
    }
}
