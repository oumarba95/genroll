<?php

namespace App\Http\Controllers;

use App\Civile;
use App\Refere;
use App\RoleGeneral;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class RoleGeneralController extends Controller
{
    public function createCivile($id){
        $civile = Civile::find($id);
        return view('roleGeneral.civileCreate',compact('civile'));
    }

    public function storeCivile(Request $request,$id){
        
        $this->validate($request,['numero_quittance'=>'required|integer|unique:civiles','id_role'=>'required|integer|unique:role_generals']);
        $civile = Civile::find($id);
        $civile->update(['numero_quittance'=>$request->get('numero_quittance')]);
        RoleGeneral::create(['id_role'=>$request->get('id_role'),'num_civile'=>$civile->id]);
        Flashy::success('Civile N°'.$civile->id.' ajoutè dans le role gènèral.');
        return redirect()->route('civiles.index');
    }


    public function createRefere($id){
        $refere = Refere::find($id);
        return view('roleGeneral.refereCreate',compact('refere'));
    }
    public function storeRefere(Request $request,$id){
        $this->validate($request,['numero_quittance'=>'required|integer|unique:referes','id_role'=>'required|integer|unique:role_generals']);
        $refere = Refere::find($id);
        $refere->update(['numero_quittance'=>$request->get('numero_quittance')]);
        RoleGeneral::create(['id_role'=>$request->get('id_role'),'num_refere'=>$refere->id]);
        Flashy::success('Rèfèrè N°'.$refere->id.' ajoutè dans le role gènèral.');
        return redirect()->route('referes.index');
    }
}
