<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Civile extends Model
{
    protected $fillable = ['id','civile_type_id','demandeur','defendeur','date_requete','motifs','date_audience','numero_quittance'];

    public function type(){
        return $this->belongsTo('App\CivileType');
    }
}
