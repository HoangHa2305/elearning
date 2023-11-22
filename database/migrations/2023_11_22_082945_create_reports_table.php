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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student');
            $table->string('code_student');
            $table->integer('parent')->nullable();
            $table->integer('id_parent')->nullable();
            $table->integer('id_group');
            $table->string('title')->nullable();
            $table->string('topic')->nullable();
            $table->text('desc_topic')->nullable();
            $table->string('date_topic')->nullable();
            $table->string('report')->nullable();
            $table->text('desc_report')->nullable();
            $table->string('date_report')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
