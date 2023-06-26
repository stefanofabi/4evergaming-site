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
                'flag' => 'ar.ico'
            ],
            [
                'name' => 'Brasil',
                'short_name' => 'BR',
                'flag' => 'br.ico'
            ],
            [
                'name' => 'Canadá',
                'short_name' => 'CA',
                'flag' => 'ca.ico'
            ],
            [
                'name' => 'Chile',
                'short_name' => 'CL',
                'flag' => 'cl.ico'
            ],
            [
                'name' => 'Estados Unidos',
                'short_name' => 'US',
                'flag' => 'us.ico'
            ],
            [
                'name' => 'México',
                'short_name' => 'MX',
                'flag' => 'mx.ico'
            ],
            [
                'name' => 'Paraguay',
                'short_name' => 'PY',
                'flag' => 'py.ico'
            ],
            [
                'name' => 'Perú',
                'short_name' => 'PE',
                'flag' => 'pe.ico'
            ],
            [
                'name' => 'Uruguay',
                'short_name' => 'UY',
                'flag' => 'uy.ico'
            ],
            [
                'name' => 'Venezuela',
                'short_name' => 'VE',
                'flag' => 've.ico'
            ]
        ]);
    }
}
