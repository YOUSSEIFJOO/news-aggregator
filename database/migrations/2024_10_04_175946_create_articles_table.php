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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->index();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('source', 255)->index();
            $table->string('category', 255)->nullable();
            $table->string('author', 255)->nullable();
            $table->string('url')->index();
            $table->string('image_url')->nullable();
            $table->string('published_at')->index();
            $table->timestamps();

            $table->fullText(['description', 'content', 'category', 'author']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
