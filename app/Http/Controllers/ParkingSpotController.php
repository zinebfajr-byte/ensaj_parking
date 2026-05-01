<?php

namespace App\Http\Controllers;

use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class ParkingSpotController extends Controller
{
    // Liste toutes les places
    public function index()
    {
        $spots = ParkingSpot::all();
        return response()->json($spots);
    }

    // Créer une nouvelle place (admin seulement)
    public function store(Request $request)
    {
        $request->validate([
            'numero'       => 'required|string|unique:parking_spots',
            'type'         => 'required|in:voiture,moto',
        ]);

        $spot = ParkingSpot::create([
            'numero'       => $request->numero,
            'type'         => $request->type,
            'is_available' => true,
        ]);

        return response()->json($spot, 201);
    }

    // Afficher une seule place
    public function show($id)
    {
        $spot = ParkingSpot::findOrFail($id);
        return response()->json($spot);
    }

    // Modifier une place (admin seulement)
    public function update(Request $request, $id)
    {
        $spot = ParkingSpot::findOrFail($id);
        $spot->update($request->all());
        return response()->json($spot);
    }

    // Supprimer une place (admin seulement)
    public function destroy($id)
    {
        $spot = ParkingSpot::findOrFail($id);
        $spot->delete();
        return response()->json(['message' => 'Place supprimée']);
    }
}
