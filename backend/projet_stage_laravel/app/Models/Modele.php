<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    protected $table = 'modele';
    protected $primaryKey = 'id_mod';
    public $timestamps = false;
    protected $fillable = ['nom', 'id_marq'];

    public function marque() {
        return $this->belongsTo(Marque::class, 'id_marq', 'id_marq');
    }
    public function moteurs() {
        return $this->hasMany(Moteur::class, 'id_mod', 'id_mod');
    }
    public function boitesVitesse() {
        return $this->hasMany(BoiteVitesse::class, 'id_mod', 'id_mod');
    }
    public function embrayages() {
        return $this->hasMany(Embrayage::class, 'id_mod', 'id_mod');
    }
    public function freinages() {
        return $this->hasMany(Freinage::class, 'id_mod', 'id_mod');
    }
}
