<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Colonnes que l'on peut remplir
    protected $fillable = [
        'user_id',
        'parking_spot_id',
        'date_debut',
        'date_fin',
        'statut',      // en_attente, confirmee, annulee
        'matricule',   // plaque d'immatriculation
    ];

    // Une réservation appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une réservation appartient à une place
    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class);
    }
}