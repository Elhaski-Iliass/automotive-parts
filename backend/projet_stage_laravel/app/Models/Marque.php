<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $table = 'marque';
    protected $primaryKey = 'id_marq';
    public $timestamps = false;
    protected $fillable = ['nom'];

    public function modeles() {
        return $this->hasMany(Modele::class, 'id_marq', 'id_marq');
    }
}
