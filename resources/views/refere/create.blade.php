@extends('layout.app')

@section('content')
 <div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <h1 class="text-center mb-1" style="font-size:30px;">Ajouter un rèfèrè</h1>
          <form action="{{ route('referes.store') }}" method="post">
              @csrf
              <div class="form-group">
                  <label for="numero_refere" class="form-label">Numèro rèfère</label>
                  <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" placeholder="saisir numero refere" autofocus required autocomplete="off" autocorrect="off" autocapitalize="on">
                  @error('id')
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              <div class="form-group row mt-2">
                  <div class="col-md-6">
                     <label for="demandeur" class="form-label mr-2">Demandeur </label>
                     <input type="text" class="form-control mr-2 @error('demandeur') is-invalid @enderror" name="demandeur" placeholder="saisir le nom du demandeur" required autocomplete="off" autocorrect="off" autocapitalize="on">
                     @error('demandeur')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                  <label for="defendeur" class="form-label mr-2">Dèfendeur </label>
                  <input type="text" class="form-control mr-2 @error('defendeur') is-invalid @enderror" name="defendeur" placeholder="saisir le nom du defendeur" required autocomplete="off" autocorrect="off" autocapitalize="on">
                    @error('defendeur')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mt-2">
                  <div class="col-md-6">
                  <label for="date_requete" class="form-label">Date requête</label>
                  <input type="date" class="form-control @error('date_requete') is-invalid @enderror" name="date_requete" placeholder="date de la requete" required>
                    @error('date_requete')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                  <label for="date_audience" class="form-label">Date audience</label>
                  <input type="date" class="form-control @error('date_audience') is-invalid @enderror"name="date_audience" placeholder="date de l'audience" required>
                    @error('date_audience')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              <div class="form-group">
                  <label for="motif_assignation" class="form-label">Motif de l'assignation</label>
                  <textarea class="form-control @error('motif_assignation') is-invalid @enderror" name="motif_assignation" placeholder="motif de l'assignation" required></textarea>
                    @error('motif_assignatiion')
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