@extends('layout.app')

@section('content')
 <div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-8">
            <h1 class="text-center mb-4" style="font-size:22px;">Modification du rèfèrè N° {{ $refere->id}}</h1>
          <form action="{{ route('referes.update',$refere) }}" method="post">
              @csrf
              @method('put')
              <div class="form-group row">
                  <div class="col-md-6">
                     <label for="demandeur" class="form-label mr-2">Demandeur </label>
                    <input type="text" class="form-control mr-2 @error('demandeur') is-invalid @enderror" name="demandeur" value="{{ old('demandeur') ? old('demandeur')  : $refere->demandeur }}" placeholder="saisir le nom du demandeur" required autofocus autocomplete="off" autocorrect="off" autocapitalize="on">
                    @error('demandeur')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                  <label for="defendeur" class="form-label mr-2">Dèfendeur </label>
                  <input type="text" class="form-control mr-2 @error('defendeur') is-invalid @enderror" name="defendeur" value="{{ old('defendeur') ? old('defendeur') : $refere->defendeur }}" placeholder="saisir le nom du defendeur" autocomplete="off" autocorrect="off" autocapitalize="on">
                    @error('defendeur')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mt-2">
                  <div class="col-md-6">
                  <label for="date_requete" class="form-label">Date requête</label>
                  <input type="date" class="form-control @error('date_requete') is-invalid @enderror" name="date_requete" value="{{ old('date_requete') ? old('date_requete')  : Carbon\Carbon::parse($refere->date_requete)->toDateString() }}" placeholder="date de la requete" required autocomplete="off" autocorrect="off" autocapitalize="on">
                   @error('date_requete')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                  <label for="date_audience" class="form-label">Date audience</label>
                  <input type="date" class="form-control @error('date_audience') is-invalid @enderror" name="date_audience" value="{{old('date_audience') ? old('date_audience') : Carbon\Carbon::parse($refere->date_audience)->toDateString() }}" placeholder="date de l'audience" required autocomplete="off" autocorrect="off" autocapitalize="on">
                    @error('date_audience')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              <div class="form-group">
                  <label for="motif_assignation" class="form-label">Motif de l'assignation</label>
                  <textarea class="form-control @error('motif_assignation') is-invalid @enderror" name="motif_assignation"  placeholder="motif de l'assignation" reuired autocorrect="off" autocapitalize="on">{{ old('motif_assignation') ? old('motif_assignation') : $refere->motif_assignation }}</textarea>
                  @error('motif_assignation')
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