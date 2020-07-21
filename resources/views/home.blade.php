@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="proced-section">
            <h1 class="text-center" style="font-size:25px;">Veuillez choisir une procédure</h1>
             <div class="item-section">
              <diV class="proced-item">
              <i class="fab fa-servicestack"></i>
              <a href="{{ route('referes.index') }}">Procédure de référe</a>
              </div>
              <diV class="proced-item">
                <i class="fab fa-servicestack"></i>
                <a href="{{ route('civiles.index') }}">Procédure civile</a>
              </div>
             </div>
           </div>
        </div>
    </div>
</div>
@endsection
