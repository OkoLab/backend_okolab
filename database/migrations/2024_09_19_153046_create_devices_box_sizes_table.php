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
        Schema::create('devices_box_sizes', function (Blueprint $table) {
            $table->id();
            $table->integer('article'); // Device article
            $table->string('name'); // Device name
            $table->integer('length'); // Length of the box
            $table->integer('width');  // Width of the box
            $table->integer('height'); // Height of the box
            $table->integer('weight'); // Weight of the box
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices_box_sizes');
    }
};
