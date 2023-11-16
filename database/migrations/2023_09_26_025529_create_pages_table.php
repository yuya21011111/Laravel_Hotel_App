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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('about_heading');
            $table->text('about_content');
            $table->integer('about_status');
            $table->string('terms_heading');
            $table->text('terms_content');
            $table->integer('terms_status');
            $table->string('privacy_heading');
            $table->text('privacy_content');
            $table->string('privacy_status');
            $table->string('contact_heading');
            $table->text('contact_map')->nullable();
            $table->string('contact_status');
            $table->string('photo_gallery_heading');
            $table->integer('photo_gallery_status');
            $table->string('video_gallery_heading');
            $table->integer('video_gallery_status');
            $table->string('faq_heading');
            $table->integer('faq_status');
            $table->string('blog_heading');
            $table->integer('blog_status');
            $table->string('room_heading');
            $table->string('cart_heading');
            $table->integer('cart_status');
            $table->string('checkout_heading');
            $table->integer('checkout_status');
            $table->string('payment_heading');
            $table->string('signup_heading');
            $table->integer('signup_status');
            $table->string('signin_heading');
            $table->integer('signin_status');
            $table->string('forget_password_heading');
            $table->string('reset_password_heading');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
