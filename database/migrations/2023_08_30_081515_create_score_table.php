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
        Schema::create('score', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student');
            $table->integer('id_section');
            $table->integer('id_semester');
            $table->integer('session');
            $table->integer('active');
            $table->integer('diligence_score')->nullable();
            $table->integer('homework_score')->nullable();
            $table->integer('midterm_score')->nullable();
            $table->integer('final_score')->nullable();
            $table->integer('sum_t10_score')->nullable();
            $table->integer('sum_t4_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score');
    }
};
