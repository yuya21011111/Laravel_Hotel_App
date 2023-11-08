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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->string('total_rooms');
            $table->string('amenities')->nullable();
            $table->string('size')->nullable();
            $table->string('total_beds')->nullable();
            $table->string('total_bathrooms')->nullable();
            $table->string('total_balconies')->nullable();
            $table->string('total_guests')->nullable();
            $table->string('featured_photo');
            $table->string('video_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
