<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laboratuvar_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained('laboratuvar', 'lab_id')->onDelete('cascade'); // Reference lab_id
            $table->string('locale', 5); // Language codes like 'tr', 'en'
            $table->string('lab_ad', 500);
            $table->text('lab_aciklama');
            $table->timestamps();

            // Each laboratory can have only one translation per language
            $table->unique(['lab_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratuvar_translations');
    }
};
