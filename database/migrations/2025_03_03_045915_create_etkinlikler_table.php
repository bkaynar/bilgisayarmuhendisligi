<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtkinliklerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etkinlikler', function (Blueprint $table) {
            $table->id();
            $table->string('etkinlik_baslik', 500);
            $table->string('etkinlik_icerik', 500);
            $table->text('etkinlik_text')->nullable();
            $table->date('etkinlik_tarih');
            $table->text('etkinlik_resim');
            $table->timestamps();
        });

        Schema::create('etkinlikler_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etkinlik_id')->constrained('etkinlikler')->onDelete('cascade');
            $table->string('locale', 2);
            $table->string('etkinlik_baslik', 500);
            $table->string('etkinlik_icerik', 500);
            $table->text('etkinlik_text')->nullable();
            $table->timestamps();

            $table->unique(['etkinlik_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etkinlikler_translations');
        Schema::dropIfExists('etkinlikler');
    }
}
