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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('birth');
            $table->string('country');
            $table->integer('sex');
            $table->integer('citizen');
            $table->string('nation');
            $table->string('religion');
            $table->integer('phone');
            $table->string('address');
            $table->integer('union')->nullable();
            $table->string('date_admission')->nullable();
            $table->integer('faculty_id');
            $table->integer('branch_id');
            $table->integer('yeartrain_id');
            $table->integer('class_id');
            $table->string('email');
            $table->string('avatar');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
