<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();

            // specifications
            $table->string('cpu_specification');
            $table->string('ram_specification');
            $table->string('disk_specification');
            $table->string('connection_specification');
            $table->string('power_supply_specification'); 
            $table->string('operating_system'); 
            

            // numbers
            $table->integer('cpu');
            $table->integer('ram');   
            $table->integer('disk');     
            $table->integer('connection'); 
            $table->integer('power_supply'); 

            // alias to connect to the database
            $table->string('mysql_connection')->nullable();  
            $table->string('phpmyadmin')->nullable();  

            $table->boolean('enable_monitor'); 

            $table->timestamps();               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
