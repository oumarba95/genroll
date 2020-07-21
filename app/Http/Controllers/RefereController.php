<?php

namespace App\Http\Controllers;

use App\Refere;
use App\RoleGeneral;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\RefereRequest;

class RefereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referes = Refere::orderBy('id')->paginate(3);
        return view('refere.index',compact('referes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('refere.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefereRequest $request)
    {
       Refere::create($request->all());
       Flashy::success('Rèfère ajoutè avec succès');
       return redirect()->route('referes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Refere $refere)
    { 
        return view('refere.show',compact('refere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Refere $refere)
    {
        return view('refere.edit',compact('refere'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Refere $refere)
    {   
        $this->validate($request,[
          'demandeur' =>'required|min:2',
          'defendeur' => 'required|min:2',
          'date_requete' =>'required|date|before_or_equal:today',
          'date_audience'=>'required|date|after:date_requete',
          'motif_assignation'=>'required|min:2'
        ]);
        $new_values = $request->only(['demandeur','defendeur','date_requete','date_audience','motif_assignation']);
        $refere->update($new_values);
        Flashy::info('Rèfèrè N°'.$refere->id.' modifiè avec succès');
        return redirect()->route('referes.show',$refere->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refere $refere )
    {   
        $role = RoleGeneral::where('num_refere',$refere->id);
        $role->delete();
        $refere->delete();
        Flashy::warning('Rèfèrè N°'.$refere->id.' supprimè avec succès');
        return redirect()->route('referes.index');
    }

    public function rech(Request $request){
        $referes = Refere::orderBy('id')->get();
        return response()->json($referes);
    }

}
