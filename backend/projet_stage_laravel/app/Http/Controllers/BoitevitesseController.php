<?php
namespace App\Http\Controllers;

use App\Models\BoiteVitesse;
use Illuminate\Http\Request;

class BoitevitesseController extends Controller
{
    public function index() {
        return BoiteVitesse::with(['marque','modele'])->get();
    }

    public function show($id) {
        return BoiteVitesse::with(['marque','modele'])->findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'nom'     => 'required|string',
            'prix'    => 'required|integer',
            'id_marq' => 'required|exists:marque,id_marq',
            'id_mod'  => 'required|exists:modele,id_mod',
            'etat'    => 'required|in:neuf,occasion,reconditionné',
        ]);
        return response()->json(BoiteVitesse::create($request->all()), 201);
    }

    public function update(Request $request, $id) {
        $bv = BoiteVitesse::findOrFail($id);
        $bv->update($request->all());
        return response()->json($bv);
    }

    public function destroy($id) {
        BoiteVitesse::findOrFail($id)->delete();
        return response()->json(['message' => 'Supprimé']);
    }
}