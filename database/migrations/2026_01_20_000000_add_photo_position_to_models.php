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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('photo_position')->default('center')->after('photo');
        });

        Schema::table('joueurs', function (Blueprint $table) {
            $table->string('photo_position')->default('center')->after('photo');
        });

        Schema::table('coaches', function (Blueprint $table) {
            $table->string('photo_position')->default('center')->after('photo');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('photo_position')->default('center')->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('photo_position');
        });

        Schema::table('joueurs', function (Blueprint $table) {
            $table->dropColumn('photo_position');
        });

        Schema::table('coaches', function (Blueprint $table) {
            $table->dropColumn('photo_position');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo_position');
        });
    }
};
