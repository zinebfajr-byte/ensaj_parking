<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();                                    // identifiant auto
            $table->string('numero');                        // ex: A1, B2, C3
            $table->string('type');                          // voiture ou moto
            $table->boolean('is_available')->default(true);  // libre ou occupé
            $table->timestamps();                            // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_spots');
    }
};