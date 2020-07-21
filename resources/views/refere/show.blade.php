@extends('layout.app')

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <h1 class="text-center mb-4" style="font-size:20px;">Dètails du rèfèrè N° {{ $refere->id }}</h1>
           <table class="table table-striped  table-bordered">
               <thead style="font-size:13px;">
                   <th>Demandeur</th>
                   <th>Dèfendeur</th>
                   <th>Date de la requête</th>
                   <th>Date d'audience</th>
                   <th>Motif de l'assignation</th>
                   @if($refere->numero_quittance )
                      <th>Numèro de quittance</th>
                   @endif
                   <th></th>
                   <th></th>
               </thead>
               <tbody>
                   <tr>
                       <td>{{ $refere->demandeur }}</td>
                       <td>{{ $refere->defendeur }}</td>
                       <td>{{ Carbon\Carbon::parse($refere->date_requete)->locale('fr_FR')->isoFormat('D MMMM YYYY') }}</td>  
                       <td>{{ Carbon\Carbon::parse($refere->date_audience)->locale('fr_FR')->isoFormat('D MMMM YYYY') }}</td>
                       @if(strlen($refere->motif_assignation) > 20)
                           <td>{{ substr($refere->motif_assignation,0,20) }}...</td>
                       @else
                          <td>{{ $refere->motif_assignation }}</td>
                       @endif
                       @if($refere->numero_quittance)
                          <td>{{ $refere->numero_quittance }}</td>
                       @endif
                       <td>
                           <form method="get" action="{{ route('referes.edit',$refere) }}">
                              @csrf 
                             <button type="submit" class="btn btn-sm btn-outline update">modifier</button>
                           </form>
                        </td>
                        <td>
                           <form method="post"  action="{{ route('referes.destroy',$refere) }}" id="suppForm">
                            @csrf
                            @method('delete')
                             <button type="button" onclick ="suppRefere({{ $refere->id}})" class="btn btn-sm btn-outline supp">supprimer</button>
                           </form>
                       </td>
                   </tr>
               </tbody>    
           </table>
       </div>
   </div>
</div>
@stop
@section('script')
<script>
  function suppRefere(id){
      if(window.confirm('voulez vous vraiment supprimè le rèfèrè numèro '+id))
         $('#suppForm').submit();
  }
</script>
@stop