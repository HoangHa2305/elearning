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
        Schema::create('rate_subject', function (Blueprint $table) {
            $table->id();
            $table->integer('id_section')->nullable();
            $table->integer('id_type')->nullable();
            $table->integer('id_semester')->nullable();
            $table->integer('id_student')->nullable();
            $table->float('about_section')->nullable();
            $table->float('about_teaching')->nullable();
            $table->string('about_content_section')->nullable();
            $table->string('about_curriculum')->nullable();
            $table->float('necessary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_subject');
    }
};
