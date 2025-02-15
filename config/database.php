<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'whmcs' => [
            'driver'    => env('DB_CONNECTION_WHMCS'),
            'host'      => env('DB_HOST_WHMCS'),
            'port'      => env('DB_PORT_WHMCS'),
            'database'  => env('DB_DATABASE_WHMCS'),
            'username'  => env('DB_USERNAME_WHMCS'),
            'password'  => env('DB_PASSWORD_WHMCS'),
        ],

        'tcadmin' => [
            'driver'    => env('DB_CONNECTION_TCADMIN'),
            'host'      => env('DB_HOST_TCADMIN'),
            'port'      => env('DB_PORT_TCADMIN'),
            'database'  => env('DB_DATABASE_TCADMIN'),
            'username'  => env('DB_USERNAME_TCADMIN'),
            'password'  => env('DB_PASSWORD_TCADMIN'),
        ],

        'chain' => [
            'driver'    => env('DB_CONNECTION_CHAIN'),
            'host'      => env('DB_HOST_CHAIN'),
            'port'      => env('DB_PORT_CHAIN'),
            'database'  => env('DB_DATABASE_CHAIN'),
            'username'  => env('DB_USERNAME_CHAIN'),
            'password'  => env('DB_PASSWORD_CHAIN'),
        ],

        'ester' => [
            'driver'    => env('DB_CONNECTION_ESTER'),
            'host'      => env('DB_HOST_ESTER'),
            'port'      => env('DB_PORT_ESTER'),
            'database'  => env('DB_DATABASE_ESTER'),
            'username'  => env('DB_USERNAME_ESTER'),
            'password'  => env('DB_PASSWORD_ESTER'),
        ],

        'ghost' => [
            'driver'    => env('DB_CONNECTION_GHOST'),
            'host'      => env('DB_HOST_GHOST'),
            'port'      => env('DB_PORT_GHOST'),
            'database'  => env('DB_DATABASE_GHOST'),
            'username'  => env('DB_USERNAME_GHOST'),
            'password'  => env('DB_PASSWORD_GHOST'),
        ],

        'lava' => [
            'driver'    => env('DB_CONNECTION_LAVA'),
            'host'      => env('DB_HOST_LAVA'),
            'port'      => env('DB_PORT_LAVA'),
            'database'  => env('DB_DATABASE_LAVA'),
            'username'  => env('DB_USERNAME_LAVA'),
            'password'  => env('DB_PASSWORD_LAVA'),
        ],

        'raider' => [
            'driver'    => env('DB_CONNECTION_RAIDER'),
            'host'      => env('DB_HOST_RAIDER'),
            'port'      => env('DB_PORT_RAIDER'),
            'database'  => env('DB_DATABASE_RAIDER'),
            'username'  => env('DB_USERNAME_RAIDER'),
            'password'  => env('DB_PASSWORD_RAIDER'),
        ],

        'ray' => [
            'driver'    => env('DB_CONNECTION_RAY'),
            'host'      => env('DB_HOST_RAY'),
            'port'      => env('DB_PORT_RAY'),
            'database'  => env('DB_DATABASE_RAY'),
            'username'  => env('DB_USERNAME_RAY'),
            'password'  => env('DB_PASSWORD_RAY'),
        ],

        'storm' => [
            'driver'    => env('DB_CONNECTION_STORM'),
            'host'      => env('DB_HOST_STORM'),
            'port'      => env('DB_PORT_STORM'),
            'database'  => env('DB_DATABASE_STORM'),
            'username'  => env('DB_USERNAME_STORM'),
            'password'  => env('DB_PASSWORD_STORM'),
        ],
        
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
