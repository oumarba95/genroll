@extends('layout.app')

@section('content')
   <div class="container mt-5">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <h1 class="text-center mb-4" style="font-size:20px;">Dètails de la procèdure N° {{ $civile->id }}</h1>
           <table class="table table-striped  table-bordered" id="table-info">
               <thead style="font-size:13px;">
                   <th>Date d'audience</th>
                   <th>Demandeur</th>
                   @if($civile->defendeur)
                   <th>Dèfendeur</th>
                   @endif
                   <th>Date de la requête</th>
                   <th>Motif</th>
                   @if($civile->numero_quittance)
                   <th>Numèro de quittance</th>
                   @endif
                   <th></th>
                   <th></th>
               </thead>
               <tbody>
                   <tr>
                       <td>{{ \Carbon\Carbon::parse($civile->date_audience)->locale('fr_FR')->isoFormat('D MMMM YYYY') }}</td>
                       <td>{{ $civile->demandeur }}</td>
                       @if($civile->defendeur)
                       <td>{{ $civile->defendeur }}</td>
                       @endif
                       <td>{{ \Carbon\Carbon::parse($civile->date_requete)->locale('fr_FR')->isoFormat('D MMMM YYYY') }}</td>
                       @if(strlen($civile->motifs) > 20)
                           <td>{{ substr($civile->motifs,0,20)}}...</td>
                       @else
                          <td>{{ $civile->motifs }}</td>
                       @endif
                       @if($civile->numero_quittance)
                       <td>{{ $civile->numero_quittance }}</td>
                       @endif
                       <td>
                           <form method="get" action="{{ route('civiles.edit',$civile) }}">
                               @csrf
                             <button type="submit" class="btn btn-sm btn-outline update">modifier</button>
                           </form>
                        </td>
                        <td>
                           <form method="post" action="{{ route('civiles.destroy',$civile) }}" id="suppForm">
                               @csrf
                               @method('delete')
                             <button type="button" onclick="suppCivile({{ $civile->id }})" class="btn btn-sm btn-outline supp">supprimer</button>
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
     function suppCivile(id){
         if(window.confirm('Voulez vous vraiment supprime la procedure N°'+id))
             $('#suppForm').submit();
             
     }
 </script>
@stop