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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('favicon');
            $table->string('top_bar_phone')->nullable();
            $table->string('top_bar_email')->nullable();
            $table->string('home_feature_status');
            $table->string('home_room_total');
            $table->string('home_room_status');
            $table->string('home_testimonial_status');
            $table->string('home_latest_post_total');
            $table->string('home_latest_post_status');
            $table->string('footer_bar_address')->nullable();
            $table->string('footer_bar_phone')->nullable();
            $table->string('footer_bar_email')->nullable();
            $table->string('copyright')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('github')->nullable();
            $table->string('theme_color_1');
            $table->string('theme_color_2');
            $table->string('analytic_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
