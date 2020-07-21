@extends('layout.app')

@section('content')
 <div class="container mt-5">
     <div class="row justify-content-center">
         <div class="col-md-5">
         <form action="{{ route('role.store.civile',$civile) }}" method="post">
             @csrf
             @method('put')
            <div class="form-group">
             <label for="mumero_quittance" class="form-label">Entrer le numèro de quittance</label>
             <input type="text" class="form-control" name="numero_quittance" required autofocus>
            </div>
            <div class="form-group">
             <label for="id_role" class="form-label">Entrer le numèro de role</label>
             <input type="text" class="form-control" name="id_role" required autofocus>
            </div>
            <div class="form-group">
             <button class="btn btn-primary btn-block" type="submit">Ajouter</button>
            </div>
     </form>
         </div>
     </div>

 </div>
@stop