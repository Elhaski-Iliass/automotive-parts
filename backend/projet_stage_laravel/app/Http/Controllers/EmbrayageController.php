<?php
namespace App\Http\Controllers;

use App\Models\Embrayage;
use Illuminate\Http\Request;

class EmbrayageController extends Controller
{
    public function index() {
        return Embrayage::with(['marque','modele'])->get();
    }

    public function show($id) {
        return Embrayage::with(['marque','modele'])->findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'nom'     => 'required|string',
            'prix'    => 'required|integer',
            'id_marq' => 'required|exists:marque,id_marq',
            'id_mod'  => 'required|exists:modele,id_mod',
            'etat'    => 'required|in:neuf,occasion,reconditionné',
        ]);
        return response()->json(Embrayage::create($request->all()), 201);
    }

    public function update(Request $request, $id) {
        $emb = Embrayage::findOrFail($id);
        $emb->update($request->all());
        return response()->json($emb);
    }

    public function destroy($id) {
        Embrayage::findOrFail($id)->delete();
        return response()->json(['message' => 'Supprimé']);
    }
}