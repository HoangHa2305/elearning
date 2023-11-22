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
        Schema::create('type_project', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('id_branch');
            $table->integer('id_semester');
            $table->string('date_start');
            $table->string('time_start');
            $table->string('date_end');
            $table->string('time_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_project');
    }
};
