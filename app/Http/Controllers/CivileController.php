<?php

namespace App\Http\Controllers;

use App\Civile;
use App\CivileType;
use App\RoleGeneral;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\CivileRequest;

class CivileController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $civiles = Civile::orderBy('id')->paginate(3);
        $this->civileResource($civiles);
        return view('civile.index',compact('civiles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('civile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CivileRequest $request)
    {  
       if($request->civile_type_id == 3)
          $this->validate($request,['id_role'=>'integer']);
        $civile = $request->only(['id','demandeur','date_requete','date_audience','motifs','civile_type_id']);
        if($request->defendeur){
            $civile['defendeur'] = $request->defendeur;
        }
       Civile::create($civile);
       if($request->civile_type_id == 3){
           RoleGeneral::create(['id_role'=>$request->id_role,'num_civile'=>$request->id]);
       }
       Flashy::success('Civile ajoutè avec succès');
       return redirect()->route('civiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Civile $civile)
    { 
        return view('civile.show',compact('civile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Civile $civile)
    {   
        $role = RoleGeneral::where('num_civile',$civile->id)->first();
        if($civile->numero_quittance)
            $civile->id_role = $role->id_role;
        return view('civile.edit',compact('civile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Civile $civile)
    {   
        $this->validate($request,[
          'demandeur' =>'bail|required|min:2',
          'date_requete' =>'bail|required|date|before_or_equal:today',
          'date_audience'=>'bail|required|date|after:date_requete',
          'motifs'=>'bail|required|min:2',
        ]);
        if($civile->civile_type_id !=3){
            $this->validate($request,['civile_type_id'=>'bail|required|in:1,2,3','id_role'=>'bail|required_if:civile_type_id,3']);
        }

        if($request->civile_type_id == 3)
           $this->validate($request,['id_role'=>'integer']);
        $new_values = $request->only(['demandeur','date_requete','date_audience','motifs']);
        if($request->civile_type_id != 2){
           $this->validate($request,['defendeur'=>'bail|required|min:2']);
           $new_values['defendeur'] = $request->defendeur;
        }
        if($request->civile_type_id == 3)
           $new_values['civile_type_id'] = $request->civile_type_id ;
        $civile->update($new_values);
        
        
        if(!empty($request->civile_type_id) && $request->civile_type_id == 3){
            if(!$civile->numero_quittance){
                 RoleGeneral::create(['id_role'=>$request->id_role,'num_civile'=>$civile->id]);
            }else{
                $civile->update(['numero_quittance'=>null]);
                $role = RoleGeneral::where('num_civile',$civile->id)->first();
                if($role->id_role != $request->id_role)
                   $role->update(['id_role'=>$request->id_role]);
            }
        }
        Flashy::info('Civile N°'.$civile->id.' modifiè avec succès');
        return redirect()->route('civiles.show',$civile->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Civile $civile )
    {   
        $role=RoleGeneral::where('num_civile',$civile->id);
        $role->delete();
        $civile->delete();
        Flashy::warning('Civile N°'.$civile->id.' supprimè avec succès');
        return redirect()->route('civiles.index');
    }

    public function rech(Request $request){
        $civiles = Civile::orderBy('id')->get();
        return response()->json($this->civileResource($civiles));
    }
    public function civileResource($civiles){
        foreach($civiles as $civile){
            $civile->type = $this->getType($civile);
        }
        return $civiles;
    }
    public function getType($civile){
        $civile_type = CivileType::find($civile->civile_type_id);
        return $civile_type;
    }
}
