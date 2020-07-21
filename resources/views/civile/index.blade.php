@extends('layout.app')

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
   @if(count($civiles) > 0)
       <div class="col-md-9">
        <div class="form-group row mb-5">
               <div class="col-md-5 d-flex">
               <div class="py-2 mr-3" style="width:260px;">
                 <label for="" class="form-label" style="font-size:15px;">Rechercher par</label>
               </div>
               <select name="selectType" id="selectCivile" class="form-control">
                   <option value="id">Numèro civile</option>
                   <option value="date_audience">Date audience</option>
                   <option value="numero_quittance">Numèro quittance</option>
                   <option value="civile_type_id">type</option>
               </select>
               </div>
               <div class="col-md-6">
                 <div class="rech-section position-relative">
                   <label for="rech-input"  class="position-absolute form-label" style="top:11px;left:14px;"><i class="fa fa-search"></i></label>
                   <input type="text" class="rech-input form-control" placeholder="rechercher une procedure civile" autocomplete="off">
               </div>
               </div>
        </div>
       <h1 class="text-center mb-2" style="font-size:28px">la liste des procèdures civile</h1>
       <a href="{{ route('civiles.create') }}" class="btn btn-primary mb-3 ">Ajouter une procèdure</a>

       <table class="table" id="table-info">
          <thead>
              <th>N° de procèdure</th>
              <th>Date d'audience</th>
              <th>Type</th>
              <th></th>
               <th></th>
          </thead>
          <tbody>
              @foreach($civiles as $civile)
              <tr>
                 <td>{{ $civile->id }}</td>
                 <td>{{ \Carbon\Carbon::parse($civile->date_audience)->locale('fr_FR')->isoFormat('D MMMM YYYY')}}</td>
                 <td>{{ $civile->type->description}}</td>
                 <td><a href="{{ route('civiles.show',$civile) }}" class="btn btn-sm btn-outline detail">Dètails</td>
                
                 <td style="font-size:12px;">
                 @if(!$civile->numero_quittance && $civile->civile_type_id != 3)
                    <form method="get" action="{{ route('role.create.civile',$civile) }}">
                        @csrf
                         <button class="btn btn-secondary">Ajouter dans rôle gènèral</button>
                    </form>
                  @endif
                 </td>
                 
             </tr>
             @endforeach
          </tbody>
       </table>
       <div class="pagite d-flex justify-content-center">
         {{ $civiles->links() }}
       </div>
       </div>
      </div>
      @else
       <div class="d-flex flex-column justify-content-center">
       <span class="text-center">La liste des procèdures est vide.</span>
       <a href="{{ route('civiles.create') }}" class="btn btn-primary mb-3 ">Ajouter une procèdure</a>
      @endif
   </div>
</div>
@stop
@section('script')
<script src="/js/displayTable.js"></script>
<script src="/js/moment.js"></script>
<script>
  $(document).ready(function(){
     var civiles = [];
     const url = '/civiles/rech';
     const typ = 'Civile';
     const t = 'civiles';
     axios.get(url)
         .then((response) => {
             civiles = response.data;
             civiles.forEach((row) => { 
               return row.date_audience = formatDate(new Date(row.date_audience));
               });
              });
     $('#selectCivile').change(()=>{
        let rechBy = $('#selectCivile').val();
        console.log(rechBy)
      if(rechBy =='date_audience'){
           $('.rech-input').replaceWith('<input type="date" class="rech-input form-control">');
        }else if(rechBy =='civile_type_id'){
           $('.rech-input').replaceWith(`
           <select class="rech-input form-control">
              <option value="par assignement">par assignement</option>
              <option value="requete simple">requete simple</option>
              <option value="appel">appel</option>
           </select>
                                        `);
      }else{
            $('.rech-input').replaceWith('<input type="text" class="rech-input form-control" placeholder="Rechercher une procedure">');
      }

        if($('.rech-input').val() != '')
            displayResult(civiles,typ);
     })
    $('.rech-section').keyup(() => {
       displayResult(civiles,typ,t);
     });
     $('.rech-section').change(() => {
       displayResult(civiles,typ,t);
     });
  });
</script>
@stop