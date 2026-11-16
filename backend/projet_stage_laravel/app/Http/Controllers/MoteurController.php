<?php
namespace App\Http\Controllers;

use App\Models\Moteur;
use Illuminate\Http\Request;

class MoteurController extends Controller
{
    public function index() {
        return Moteur::with(['marque', 'modele'])->get();
    }

    public function show($id) {
        return Moteur::with(['marque', 'modele'])->findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'nom'          => 'required|string',
            'prix'         => 'required|integer',
            'id_marq'      => 'required|exists:marque,id_marq',
            'id_mod'       => 'required|exists:modele,id_mod',
            'etat'         => 'required|in:neuf,occasion,reconditionné',
            'disponibilite'=> 'boolean',
        ]);
        return response()->json(Moteur::create($request->all()), 201);
    }

    public function update(Request $request, $id) {
        $moteur = Moteur::findOrFail($id);
        $moteur->update($request->all());
        return response()->json($moteur);
    }

    public function destroy($id) {
        Moteur::findOrFail($id)->delete();
        return response()->json(['message' => 'Supprimé']);
    }
}