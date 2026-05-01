<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');              // lié à la table users
            $table->foreignId('parking_spot_id')
                  ->constrained()
                  ->onDelete('cascade');              // lié à parking_spots
            $table->dateTime('date_debut');            // quand commence la réservation
            $table->dateTime('date_fin');              // quand elle se termine
            $table->string('statut')->default('en_attente'); // en_attente / confirmee / annulee
            $table->string('matricule');               // plaque d'immatriculation
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
