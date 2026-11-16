<?php
namespace App\Http\Controllers;

use App\Models\Freinage;
use Illuminate\Http\Request;

class FreinageController extends Controller
{
    public function index() {
        return Freinage::with(['marque','modele'])->get();
    }

    public function show($id) {
        return Freinage::with(['marque','modele'])->findOrFail($id);
    }

    public function store(Request $request) {
        $request->validate([
            'nom'     => 'required|string',
            'prix'    => 'required|integer',
            'id_marq' => 'required|exists:marque,id_marq',
            'id_mod'  => 'required|exists:modele,id_mod',
            'etat'    => 'required|in:neuf,occasion,reconditionné',
        ]);
        return response()->json(Freinage::create($request->all()), 201);
    }

    public function update(Request $request, $id) {
        $frein = Freinage::findOrFail($id)->update($request->all());
        return response()->json($frein);
    }

    public function destroy($id) {
        Freinage::findOrFail($id)->delete();
        return response()->json(['message' => 'Supprimé']);
    }
}