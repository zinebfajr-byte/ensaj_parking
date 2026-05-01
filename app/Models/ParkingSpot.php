<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    // Colonnes que l'on peut remplir
    protected $fillable = [
        'numero',        // ex: A1, B2
        'type',          // voiture ou moto
        'is_available',  // true ou false
    ];

    // Une place peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}