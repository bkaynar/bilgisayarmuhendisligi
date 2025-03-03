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
        Schema::create('hakkimizda_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hakkimizda_id')->constrained('hakkimizda')->onDelete('cascade');
            $table->string('locale', 5); // 'tr', 'en' gibi dil kodları
            $table->longText('icerik');
            $table->string('baslik')->nullable(); // Başlık alanı ekledim, gerekirse
            $table->string('meta_aciklama')->nullable(); // SEO için meta açıklama, gerekirse
            $table->timestamps();

            // Her hakkimizda girdisi için her dilde sadece bir çeviri olabilir
            $table->unique(['hakkimizda_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hakkimizda_translations');
    }
};
