<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('resource_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->string('disability_focus'); // hearing-impaired, visually-impaired, etc.
            $table->string('accessibility_features')->nullable();
            $table->integer('duration_seconds')->nullable(); // For audio/video content
            $table->string('language')->default('en');
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resource_metadata');
    }
}; 