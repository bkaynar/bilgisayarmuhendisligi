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
        Schema::create('hedeflerimiz_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hedeflerimiz_id')->constrained('hedeflerimiz')->onDelete('cascade');
            $table->string('locale', 2);
            $table->text('hedef_icerik');
            $table->string('hedef_baslik', 255);
            $table->timestamps();

            $table->unique(['hedeflerimiz_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hedeflerimiz_translations');
    }
};
