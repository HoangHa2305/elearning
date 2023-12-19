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
        Schema::create('tution', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student');
            $table->integer('id_semester');
            $table->string('code');
            $table->string('desc');
            $table->integer('total');
            $table->string('date');
            $table->string('collector');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tution');
    }
};
