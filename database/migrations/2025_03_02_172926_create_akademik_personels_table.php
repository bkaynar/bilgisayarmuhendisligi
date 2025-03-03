<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('akademik_personel', function (Blueprint $table) {
            $table->id();
            $table->string('personel_isim_soyisim'); // Moved from translations
            $table->string('personel_img')->nullable();
            $table->string('personel_telefon')->nullable();
            $table->string('personel_email')->nullable();
            $table->boolean('silindi')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akademik_personel');
    }
};
