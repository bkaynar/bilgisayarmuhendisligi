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
        Schema::create('mufredat_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mufredat_id');
            $table->string('locale', 2);
            $table->string('adi', 500);
            $table->timestamps();

            $table->foreign('mufredat_id')->references('id')->on('mufredat')->onDelete('cascade');
            $table->unique(['mufredat_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mufredat_translations');
    }
};
