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
        Schema::create('content_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('height');
            $table->string('location');
            $table->string('scientific_name');
            $table->string('lifespan');
            $table->string('leaf_shape')->nullable();
            $table->string('family');
            $table->foreignId('category_id')->constrained('content_categories')->onDelete('cascade');
            $table->foreignId('content_id')->constrained('content')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_info');
    }
};
