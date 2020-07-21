@extends('layout.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-8">
            <h1 class="text-center mb-4" style="font-size:22px;">Modification de la procèdure N° {{ $civile->id }}</h1>
          <form action="{{ route('civiles.update',$civile) }}" method="post">
            @csrf
            @method('put')
          @if($civile->civile_type_id != 3)
          <div class="form-group row">
                  <div class="col-md-12 selectDiv">
                  <label for="type_civile" class="form-label">Type de  procèdure</label>
                  <select class="form-control @error('civile_type_id') is-invalid @enderror" name="civile_type_id"  required id="selectCivile">
                     <option value="1" type = "{{ $civile->civile_type_id }} ">par assignement</option>
                     <option value="2" type = "{{ $civile->civile_type_id }} ">requete simple</option>
                     <option value="3" type = "{{ $civile->civile_type_id }} " >appel</option>
                  </select>
                  @error('civile_type_id')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group role-input col-md-6" style="display:none">
      
                   <label for="numero_role" class="form-label">numero role</label>
                    <input type="text" class="form-control @error('id_role') is-invalid @enderror" value="{{$civile->id_role}}" name="id_role"  placeholder="entrer le numero de role">
                    @error('id_role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror 
                   </div>                  

                </div>
                @endif
              <div class="form-group row mt-2">
                  <div class="col-md-6" id="demandeur">
                     <label for="demandeur" class="form-label mr-2">Demandeur </label>
                     <input type="text" class="form-control mr-2 @error('demandeur') is-invalid @enderror" name="demandeur" value="{{$civile->demandeur}}" placeholder="saisir le nom du demandeur" required autofocus>
                     @error('demandeur')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-md-6" id='defendeur'>
                  <label for="defendeur" class="form-label mr-2">Dèfendeur </label>
                  <input type="text" class="form-control mr-2 @error('defendeur') is-invalid @enderror" name="defendeur" value="{{$civile->defendeur}}" placeholder="saisir le nom du defendeur">
                  @error('defendeur')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="form-group row mt-2">
                  <div class="col-md-6">
                  <label for="date_requete" class="form-label">Date requête</label>
                  
                  <input type="date" class="form-control @error('date_requete') is-invalid @enderror" name="date_requete" value="{{ \Carbon\Carbon::parse($civile->date_requete)->toDateString() }}" placeholder="date de la requete" required>
                  @error('date_requete')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                  <div class="col-md-6">
                  <label for="date_audience" class="form-label">Date audience</label>
                  <input type="date" class="form-control @error('date_audience') is-invalid @enderror"name="date_audience" value="{{ \Carbon\Carbon::parse($civile->date_audience)->toDateString() }}" placeholder="date de l'audience" required>
                  @error('date_audience')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
              <div class="form-group">
                  <label for="motifs" class="form-label">Motif de l'assignation</label>
                  <textarea class="form-control @error('motifs') is-invalid @enderror" name="motifs"  placeholder="motif de l'assignation" required>{{ $civile->motifs }}</textarea>
                  @error('motifs')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">modifier</button>
                </div>
          </form>
      </div>
  </div>
</div>
@stop
@section('script')
 <script>
   $(document).ready(function(){

    $('#selectCivile').change(function(){
       const value = $(this).val();
       if(value == 3){
         $('.selectDiv').removeClass('col-md-12');
         $('.selectDiv').addClass('col-md-6');
         $('.role-input').show();

       }else{
        $('.role-input').hide();
        $('.selectDiv').removeClass('col-md-6');
        $('.selectDiv').addClass('col-md-12');
       }
         
      initialize(value);
    });
     $('#id_role.form-control.is-invalid').parent('.role-input').show().prev('.selectDiv').removeClass('col-md-12').addClass('col-md-6');
     $('#selectCivile option').each(function(){
       const type = $(this).attr('type');
       const value = parseInt($(this).attr('value'));
      if( type == value ){
          $(this).attr('selected','true');
       }else{
         $(this).removeAttr('selected');
       }
     })
     initialize($('#selectCivile').val());
  function initialize(val){
    if(val == 2){
        $('#defendeur').hide();
        $('#demandeur').removeClass('col-md-6');
        $('#demandeur').addClass('col-md-12');

      }else{
        $('#defendeur').show();
        $('#demandeur').removeClass('col-md-12');
        $('#demandeur').addClass('col-md-6');        
      }
  }
   });
 </script>
@stop