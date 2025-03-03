<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('akademik_personel_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akademik_personel_id')->constrained('akademik_personel')->onDelete('cascade');
            $table->string('locale', 5);
            $table->string('personel_unvan')->nullable();
            $table->string('personel_gorev')->nullable();
            $table->string('personel_fakulte')->nullable();
            $table->string('personel_bolum')->nullable();
            $table->text('personel_hakkinda')->nullable();
            $table->timestamps();

            // Kısa bir isim belirterek sorunu çözün
            $table->unique(['akademik_personel_id', 'locale'], 'akd_pers_trans_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akademik_personel_translations');
    }
};
