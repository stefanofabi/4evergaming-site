<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Node;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Node::insert([
            [
                'name' => 'Chain', 
                'cpu_specification' => 'Intel Core i9 14900 5.8GHz',
                'memory_specification' => '128 GB DDR4',
                'disk_specification' => '2 TB SSD NVMe',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente EVGA 750w 80 Plus Gold',
                'operating_system' => 'Debian 12',
                
                'cpu' => 32,
                'memory' => 128,
                'disk' => 2000,
                'connection' => 1000,
                'power_supply' => 750,

                'mysql_connection' => 'chain',
                'phpmyadmin' => 'https://chain.4evergaming.net/phpmyadmin',

                'enable_monitor' => 1,
            ],
            [
                'name' => 'Ester', 
                'cpu_specification' => 'Intel Xeon E5-2650v2 2.6GHz',
                'memory_specification' => '128 GB DDR3 ECC',
                'disk_specification' => '2 TB SSD',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente Dell 700w',
                'operating_system' => 'Ubuntu 20.04',

                'cpu' => 32,
                'memory' => 128,
                'disk_capacity' => 2000,
                'connection' => 1000,
                'power_supply' => 700,

                'mysql_connection' => 'ester',
                'phpmyadmin' => 'https://ester.4evergaming.net/phpmyadmin',

                'enable_monitor' => 1,
            ],
            [
                'name' => 'Ghost', 
                'cpu_specification' => 'Intel Xeon E5-2650v2 2.6GHz',
                'memory_specification' => '128 GB DDR3 ECC',
                'disk_specification' => '2 TB SSD',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente Dell 700w',
                'operating_system' => 'Ubuntu 20.04',

                'cpu' => 32,
                'memory' => 128,
                'disk_capacity' => 2000,
                'connection' => 1000,
                'power_supply' => 700,

                'mysql_connection' => 'ghost',
                'phpmyadmin' => 'https://ghost.4evergaming.net/phpmyadmin',
                
                'enable_monitor' => 1,
            ],
            [
                'name' => 'Lava', 
                'cpu_specification' => 'Intel Xeon E5-2650v2 2.6GHz',
                'memory_specification' => '64 GB DDR3 ECC',
                'disk_specification' => '2 TB SSD',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente Dell 700w',
                'operating_system' => 'Ubuntu 20.04',

                'cpu' => 32,
                'memory' => 64,
                'disk_capacity' => 2000,
                'connection' => 1000,
                'power_supply' => 700,

                'mysql_connection' => 'lava',
                'phpmyadmin' => 'https://lava.4evergaming.net/phpmyadmin',

                'enable_monitor' => 1,
            ],
            [
                'name' => 'Raider', 
                'cpu_specification' => 'Intel Xeon E5-2650v2 2.6GHz',
                'memory_specification' => '64 GB DDR3 ECC',
                'disk_specification' => '1 TB SSD',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente Dell 700w',
                'operating_system' => 'Ubuntu 20.04',

                'cpu' => 32,
                'memory' => 64,
                'disk_capacity' => 1000,
                'connection' => 1000,
                'power_supply' => 700,

                'mysql_connection' => 'raider',
                'phpmyadmin' => 'https://raider.4evergaming.net/phpmyadmin',

                'enable_monitor' => 1,
            ],
            [
                'name' => 'Ray', 
                'cpu_specification' => 'Intel Xeon E5-2650v2 2.6GHz',
                'memory_specification' => '128 GB DDR3 ECC',
                'disk_specification' => '1 TB SSD',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente Dell 700w',
                'operating_system' => 'Ubuntu 20.04',

                'cpu' => 32,
                'memory' => 128,
                'disk_capacity' => 1000,
                'connection' => 1000,
                'power_supply' => 700,

                'mysql_connection' => 'ray',
                'phpmyadmin' => 'https://ray.4evergaming.net/phpmyadmin',

                'enable_monitor' => 1,
            ],
            [
                'name' => 'Storm', 
                'cpu_specification' => 'Intel Xeon E5-2650v2 2.6GHz',
                'memory_specification' => '64 GB DDR3 ECC',
                'disk_specification' => '2 TB SSD',
                'connection_specification' => '1000 Mbps',
                'power_supply_specification' => 'Fuente Dell 700w',
                'operating_system' => 'Ubuntu 20.04',

                'cpu' => 32,
                'memory' => 64,
                'disk_capacity' => 2000,
                'connection' => 1000,
                'power_supply' => 700,

                'mysql_connection' => 'storm',
                'phpmyadmin' => 'https://storm.4evergaming.net/phpmyadmin',

                'enable_monitor' => 1,
            ],
        ]);

    }
}
