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
        Schema::create('firewall_rules', function (Blueprint $table) {
            $table->id();
            $table->string('source_ip');
            $table->enum('flow', ['INPUT', 'OUTPUT']);
            $table->enum('protocol', ['ANY', 'TCP', 'UDP']);
            $table->unsignedBigInteger('network_address_id')->nullable();
            $table->integer('destination_port')->nullable();
            $table->enum('action', ['ACCEPT', 'DROP']);
            $table->text('comment')->nullable();

            // Foreign keys
            $table->foreign('network_address_id')->references('id')->on('network_addresses')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unique(['source_ip', 'flow', 'protocol', 'network_address_id', 'destination_port'], 'unique_firewall_rule_index');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firewall_rules');
    }
};
