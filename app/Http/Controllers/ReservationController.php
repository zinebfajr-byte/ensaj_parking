<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Liste les réservations
    // Admin → toutes | User → seulement les siennes
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $reservations = Reservation::with(['user', 'parkingSpot'])->get();
        } else {
            $reservations = Reservation::with(['parkingSpot'])
                ->where('user_id', $user->id)
                ->get();
        }

        return response()->json($reservations);
    }

    // Créer une réservation
    public function store(Request $request)
    {
        $request->validate([
            'parking_spot_id' => 'required|exists:parking_spots,id',
            'date_debut'      => 'required|date',
            'date_fin'        => 'required|date|after:date_debut',
            'matricule'       => 'required|string',
        ]);

        // Vérifier que la place est disponible
        $spot = ParkingSpot::findOrFail($request->parking_spot_id);
        if (!$spot->is_available) {
            return response()->json([
                'message' => 'Cette place est déjà occupée'
            ], 422);
        }

        $reservation = Reservation::create([
            'user_id'         => $request->user()->id,
            'parking_spot_id' => $request->parking_spot_id,
            'date_debut'      => $request->date_debut,
            'date_fin'        => $request->date_fin,
            'matricule'       => $request->matricule,
            'statut'          => 'en_attente',
        ]);

        // Marquer la place comme occupée
        $spot->update(['is_available' => false]);

        return response()->json($reservation, 201);
    }

    // Afficher une réservation
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'parkingSpot'])->findOrFail($id);
        return response()->json($reservation);
    }

    // Modifier le statut (admin seulement)
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,annulee',
        ]);

        $reservation->update(['statut' => $request->statut]);

        // Si annulée → libérer la place
        if ($request->statut === 'annulee') {
            $reservation->parkingSpot->update(['is_available' => true]);
        }

        return response()->json($reservation);
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        // Libérer la place
        $reservation->parkingSpot->update(['is_available' => true]);
        $reservation->delete();
        return response()->json(['message' => 'Réservation supprimée']);
    }
}
