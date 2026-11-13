<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('aspect_ratio')->default('portrait'); // portrait, landscape, square
            $table->string('dimensions')->nullable();
            $table->string('client_name')->nullable();
            $table->string('location')->nullable();
            $table->date('shoot_date')->nullable();
            $table->string('camera_gear')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hero')->default(false);
            $table->integer('display_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
