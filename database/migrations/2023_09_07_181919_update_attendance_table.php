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
        Schema::table('attendance', function (Blueprint $table) {
            $table->string('content')->nullable()->default(null)->change();
            $table->string('absent')->nullable()->default(null)->change();
            $table->string('late')->nullable()->default(null)->change();
            $table->string('permission')->nullable()->default(null)->change();
            $table->string('time')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            //
        });
    }
};
