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
        Schema::create('characters', function (Blueprint $table) {
            $table->id(); // ID del personaggio
            $table->json('sheet'); // Nome del file associato al personaggio
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID dell'utente, con vincolo di chiave esterna
            $table->timestamps(); // Timestamp per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
