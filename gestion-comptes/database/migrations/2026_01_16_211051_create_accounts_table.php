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
       Schema::create('accounts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('client_id')
      ->nullable()
      ->constrained()
      ->nullOnDelete();

    $table->string('nom');
    $table->string('prenom');
    $table->string('telephone')->nullable();
    $table->string('numero_compte')->unique();
    $table->enum('type', ['dinar', 'devise']);
    $table->decimal('solde', 12, 2)->default(0);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
