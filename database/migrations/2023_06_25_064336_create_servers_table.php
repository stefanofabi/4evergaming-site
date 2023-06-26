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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->integer('port');
            $table->string('server_address');
            $table->string('hostname');
            $table->string('map');
            $table->integer('max_players');
            $table->integer('users_online');
            $table->boolean('status');
            $table->string('join_link');
            $table->json('vars');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('rank_points')->default(0);
            $table->unsignedBigInteger('rank');

            $table->unique(['ip', 'port', 'community_id']);

            $table->foreign('community_id')->references('id')->on('communities')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict')->onUpdate('cascade');

            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
