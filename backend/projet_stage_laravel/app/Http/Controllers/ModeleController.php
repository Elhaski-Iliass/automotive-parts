<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    // ModeleController.php
public function pieces($id)
{
    $modele = Modele::with(['marque','moteurs','boitesVitesse','embrayages','freinages'])
                    ->findOrFail($id);

    return response()->json([
        'modele'        => $modele->nom,
        'marque'        => $modele->marque->nom,
        'moteurs'       => $modele->moteurs,
        'boites_vitesse'=> $modele->boitesVitesse,
        'embrayages'    => $modele->embrayages,
        'freinages'     => $modele->freinages,
    ]);
}
}
