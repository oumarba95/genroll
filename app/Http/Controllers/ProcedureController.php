<?php

namespace App\Http\Controllers;

use App\Civile;
use App\Refere;
use Carbon\Carbon;
use App\CivileType;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function audience(){
        $referes = Refere::whereDate('date_audience',Carbon::today())->paginate(3);
        $civiles = Civile::whereDate('date_audience',Carbon::today())->paginate(3);
        foreach($civiles as $civile){
           $type = CivileType::find($civile->civile_type_id);
           $civile->description = $type->description;
        }
        return view('audience.index',compact('referes'),compact('civiles'));
    }


}
