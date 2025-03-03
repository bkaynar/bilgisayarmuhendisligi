<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slider_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->constrained('slider')->onDelete('cascade');
            $table->string('locale', 5);
            $table->text('slider_ustmetin');
            $table->text('slider_altmetin');
            $table->timestamps();

            // Each slider can have only one translation per language
            $table->unique(['slider_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slider_translations');
    }
};
