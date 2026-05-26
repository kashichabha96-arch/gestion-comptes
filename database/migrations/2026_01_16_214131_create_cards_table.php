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
      Schema::create('cards', function (Blueprint $table) {
    $table->id();
    $table->string('type_carte')->nullable();
    $table->string('nom')->nullable();
    $table->string('prenom')->nullable();
    $table->string('num_carte')->unique();
    $table->string('date_expiration')->nullable();
    $table->unsignedBigInteger('account_id')->nullable();
    $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};