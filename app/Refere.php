<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refere extends Model
{
    protected $fillable = ['id','demandeur','defendeur','date_requete','date_audience','motif_assignation','numero_quittance'];

}
