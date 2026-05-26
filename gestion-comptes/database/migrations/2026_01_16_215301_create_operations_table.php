<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('to_account_id')
                  ->nullable()
                  ->constrained('accounts')
                  ->onDelete('cascade');

            $table->enum('type', ['versement','retrait','virement']);
            $table->decimal('montant', 12, 2);
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};