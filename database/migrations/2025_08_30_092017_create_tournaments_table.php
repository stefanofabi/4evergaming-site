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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id(); 

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('tournament_image')->nullable();
            $table->enum('type', ['single', 'team']);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->unsignedInteger('max_participants')->nullable();
            $table->unsignedInteger('max_participants_per_team')->nullable();

            $table->string('location')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');

            $table->string('prize')->nullable(); 
            $table->decimal('entry_fee', 10, 2)->default(0);
            $table->string('event_url')->nullable(); 
            
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('game_id');

            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
