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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('event_name')->nullable();
            $table->string('image')->nullable();
            $table->longText('event_description')->nullable();
            $table->string('location')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();

            $table->string('organizer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
