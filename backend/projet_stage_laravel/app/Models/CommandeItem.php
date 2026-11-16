<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    protected $fillable = ['commande_id','type_piece','piece_id','nom_piece','quantite','prix_unitaire'];
}