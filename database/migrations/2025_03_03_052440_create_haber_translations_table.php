<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaberTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haberler_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('haber_id');
            $table->string('locale', 2);
            $table->string('haber_baslik', 500);
            $table->text('haber_icerik');
            $table->timestamps();

            $table->foreign('haber_id')->references('id')->on('haberler')->onDelete('cascade');
            $table->unique(['haber_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('haberler_translations');
    }
}
