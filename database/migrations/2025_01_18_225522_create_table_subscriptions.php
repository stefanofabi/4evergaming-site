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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id(); 
                  
            $table->string('firstname'); 
            $table->string('lastname');
            $table->string('email')->unique(); 
            $table->string('phonenumber')->nullable();
            $table->integer('client_id')->unique();
            $table->date('next_payment_date'); 
            $table->string('link')->nullable(); 
            $table->string('reference')->nullable(); 

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
