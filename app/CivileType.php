<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CivileType extends Model
{
    public function civiles(){
        return $this->hasMany('App\Civile');
    }
}
