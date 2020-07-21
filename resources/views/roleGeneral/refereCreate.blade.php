@extends('layout.app')

@section('content')
 <div class="container mt-5">
 <div class="row justify-content-center">
         <div class="col-md-5">
         <form action="{{ route('role.store.refere',$refere) }}" method="post">
          @csrf
          @method('put')
          <div class="form-group">
             <label for="id" class="form-label">Entrer le numèro de rôle</label>
             <input type="text" class="form-control @error('id_role') is-invalid @enderror" name="id_role" required autofocus autocomplete="off">
             @error('id_role')
                <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
          <div class="form-group">
             <label for="numero_quittance" class="form-label">Entrer le numèro de quittance</label>
             <input type="text" class="form-control @error('numero_quittance') is-invalid @enderror" name="numero_quittance" required autofocus autocomplete="off">
             @error('numero_quittance')
                <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
         <div class="form-group">
             <button class="btn btn-primary btn-block" type="submit">Ajouter</button>
         </div>
        </form>               
        </div>
     </div>

 </div>
@stop