<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Colonnes que l'on peut remplir
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // admin ou user
        'phone',       // téléphone
    ];

    // Colonnes cachées (jamais envoyées en JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Un user peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
