<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freinage extends Model
{
    protected $table = 'freinage';
    protected $primaryKey = 'id_frein';
    public $timestamps = false;
    protected $fillable = ['nom','id_marq','id_mod','description','disponibilite','prix','etat','image'];

    public function marque() {
        return $this->belongsTo(Marque::class, 'id_marq', 'id_marq');
    }
    public function modele() {
        return $this->belongsTo(Modele::class, 'id_mod', 'id_mod');
    }
}
// Même chose pour BoiteVitesse, Embrayage, Freinage
// (changer table et primaryKey : id_bv, id_emb, id_frein)
