<?php
namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    // Client — ses propres commandes
    public function mesCommandes(Request $request) {
        $commandes = Commande::with('items')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($commandes);
    }

    // Client — créer une commande
    public function store(Request $request) {
        $request->validate([
            'items'             => 'required|array',
            'adresse_livraison' => 'required|string',
        ]);

        $total = collect($request->items)->sum(fn($i) => $i['prix_unitaire'] * $i['quantite']);

        $commande = Commande::create([
            'user_id'           => $request->user()->id,
            'total'             => $total,
            'adresse_livraison' => $request->adresse_livraison,
            'statut'            => 'en_attente',
        ]);

        foreach ($request->items as $item) {
            $commande->items()->create($item);
        }

        return response()->json($commande->load('items'), 201);
    }

    // Admin — toutes les commandes
    public function index() {
        return response()->json(
            Commande::with(['user','items'])->orderBy('created_at','desc')->get()
        );
    }

    // Admin — changer le statut
    public function updateStatut(Request $request, $id) {
        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => $request->statut]);
        return response()->json($commande);
    }
}