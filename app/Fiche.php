<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{

    protected $fillable = ['nom', 'type', 'genre', 'sortie', 'synopsis','auteur'];
}
