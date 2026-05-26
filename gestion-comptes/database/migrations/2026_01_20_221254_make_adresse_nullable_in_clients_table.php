<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->date('date_naissance')->nullable()->change();
            $table->string('adresse')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->date('date_naissance')->nullable(false)->change();
            $table->string('adresse')->nullable(false)->change();
        });
    }
};
