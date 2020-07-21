@extends('layout.app')

@section('content')
 <div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <h1 class="text-center mb-4" style="font-size:25px;">Ajouter une procèdure civile</h1>
          <form action="{{ route('civiles.store') }}" method="post">
             @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                      <label for="numero_civile" class="form-label">Numero procèdure</label>
                      <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" placeholder="saisir numero procedure" autofocus required autocomplete="off">
                      @error('id')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  <div class="col-md-6">
                  <label for="type_civile" class="form-label">Type de  procèdure</label>
                  <select class="form-control @error('civile_type_id') is-invalid @enderror" name="civile_type_id" id="selectCivile" required>
                     <option value="1">Par assignement</option>
                     <option value="2">Requete simple</option>
                     <option value="3">Appel</option>
                  </select>
                  @error('civile_type_id')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="form-group role-input" style="display:none">
                   <label for="numero_role" class="form-label">numero role</label>
                    <input type="text" class="form-control @error('id_role') is-invalid @enderror" name="id_role"  placeholder="entrer le numero de role">
                    @error('id_role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror 
                   
                </div>
              <div class="form-group row mt-2">
                  <div class="col-md-6" id="demandeur">
                     <label for="demandeur" class="form-label mr-2">Demandeur </label>
                     <input type="text" class="form-control mr-2 @error('demandeur') is-invalid @enderror" name="demandeur" placeholder="saisir le nom du demandeur" required autocomplete="off">
                     @error('demandeur')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>

                  <div class="col-md-6" id="defendeur">
                  <label for="defendeur" class="form-label mr-2">Dèfendeur </label>
                  <input type="text" class="form-control mr-2 @error('defendeur') is-invalid @enderror" name="defendeur"  placeholder="saisir le nom du defendeur" autocomplete="off">
                  @error('defendeur')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="form-group row mt-2">
                  <div class="col-md-6">
                  <label for="date_requete" class="form-label">Date requête</label>
                  <input type="date" class="form-control @error('date_requete') is-invalid @enderror" name="date_requete" placeholder="date de la requete" required autocomplete="off">
                  @error('date_requete')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                  <div class="col-md-6">
                  <label for="date_audience" class="form-label">Date audience</label>
                  <input type="date" class="form-control @error('date_audience') is-invalid @enderror" name="date_audience" placeholder="date de l'audience" required autocomplete="off">
                  @error('date_audience')
                        <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
              <div class="form-group">
                  <label for="motifs" class="form-label">Motif de l'assignation</label>
                  <textarea class="form-control @error('motifs') is-invalid @enderror" name="motifs" placeholder="motif de l'assignation" required></textarea>
                  @error('motifs')
                        <span class="text-danger">{{ $message }}</span>
                 @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">enregister</button>
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
         $('.role-input').show();

       }else{
        $('.role-input').hide();
       }
       
       if(value == 2){
          $('#defendeur').hide();
          $('#demandeur').removeClass('col-md-6');
          $('#demandeur').addClass('col-md-12');
       }else{
          $('#defendeur').show();
          $('#demandeur').removeClass('col-md-12');
          $('#demandeur').addClass('col-md-6');         
       }
  });
  $('input.is-invalid').parent('.role-input').show();

  });
</script>
@stop