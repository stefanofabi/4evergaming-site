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
        Schema::create('online_player_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('count');

            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_player_histories');
    }
};
