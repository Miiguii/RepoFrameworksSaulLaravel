<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('datos_personales', function (Blueprint $table) {
            $table->string('CURP', 18)->nullable()->unique()->after('Email');
        });
    }

    public function down(): void
    {
        Schema::table('datos_personales', function (Blueprint $table) {
            $table->dropColumn('CURP');
        });
    }
};
