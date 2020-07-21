@extends('layout.app')

@section('content')
<div class="container mt-5">
<div class="row justify-content-center">
    @if(count($referes) > 0)
       <div class="col-md-9">

              <div class="form-group row mb-5">
               <div class="col-md-5 d-flex">
               <div class="py-2" style="width:260px;">
                 <label for="" class="form-label" style="font-size:15px;">Rechercher par</label>
               </div>
               <select name="selectType" id="selectRefere" class="form-control">
                   <option value="id">Numèro rèfèrè</option>
                   <option value="date_audience">Date audience</option>
                   <option value="numero_quittance">Numèro quittance</option>
               </select>
               </div>
               <div class="col-md-6">
                 <div class="rech-section position-relative">
                   <label for="rech-input"  class="position-absolute form-label" style="top:11px;left:14px;"><i class="fa fa-search"></i></label>
                   <input type="text" class="rech-input form-control" placeholder="rechercher un rèfèrè"autofocus autocomplete="false">
               </div>
               </div>
             </div>
            </div>
        </div>
       <h1 class="text-center mb-2" style="font-size:28px">la liste des rèfèrès</h1>
       <a href="{{ route('referes.create') }}" class="btn btn-primary mb-3 " style="margin-left:108px;">Ajouter un rèfèrè</a>
       <div class="col-md-9 offset-md-1">
       <table  class="table" id="table-info">
          <thead>
              <tr>
                <th>N° rèfèrè</th>
                <th>Date d'audience</th>
                <th></th>
                <th></th>
              </tr>
          </thead>
          <tbody>
            @foreach($referes as $refere)
              <tr>
                 <td>{{ $refere->id}}</td>
                 <td>{{ Carbon\Carbon::parse($refere->date_audience)->locale('fr_FR')->isoFormat('D MMMM YYYY') }}</td>
                 <td><a href="{{ route('referes.show',$refere) }}" class="btn btn-sm btn-outline detail">Dètails</td>
                 <td style="font-size:12px;">
                 @if( !$refere->numero_quittance)
                    <form method="get" action="{{ route('role.create.refere',$refere) }}">
                         <button class="btn btn-secondary">Ajouter dans rôle gènèral</button>
                    </form>
                  @endif
                 </td>
             </tr>
             @endforeach
          </tbody>
       </table>
       <div class="d-flex justify-content-center" id="links">
          {{ $referes->links() }}
       </div>
       </div>
      </div>
      @else
      <div class="d-flex flex-column mt-5">
      <p class="text-center" style="font-size:20px">La liste des rèfèrès est vide.</p>
      <a href="{{ route('referes.create') }}" class="btn btn-primary mb-3 ">Ajouter un rèfèrè</a>
      </div>
       @endif
   </div>

</div>
@stop
@section('script')
<script src="/js/displayTable.js"></script>
<script src="/js/moment.js"></script>
<script>
  $(document).ready(function(){
     var referes = [];
     const typ = 'Refere';
     const url = '/referes/rech';
     const t = "referes";
     axios.get(url)
         .then((response) => {
             referes = response.data;
             referes.forEach((row) => { 
               return row.date_audience = formatDate(new Date(row.date_audience));
               });
              });
     $('#selectRefere').change(()=>{
        let rechBy = $('#selectRefere').val();
      if(rechBy =='date_audience'){
           $('.rech-input').attr('type','date');
           $('.rech-input').removeAttr('placeholder');
        }else{
           $('.rech-input').attr({'type':'text','placeholder':'Rechercher un refere'});
        }
        if($('.rech-input').val() != '')
            displayResult(referes,typ,t);
     })
    $('.rech-input').keyup(() => {
       displayResult(referes,typ,t);
     });

  });
</script>
@stop