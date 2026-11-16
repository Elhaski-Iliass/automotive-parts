<?php
namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index() {
        return response()->json(Marque::all());
    }

    public function modeles($id) {
        $marque = Marque::with('modeles')->findOrFail($id);
        return response()->json($marque->modeles);
    }
}