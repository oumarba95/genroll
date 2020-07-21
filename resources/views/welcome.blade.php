@extends('layout.app')
@section('style')
  <style>
    body{
      background-color:white;
      color:black;
    }
  </style>
@stop
@section('content')
  <div class="home-section">
    <div class="home-section-container">
        <div class="call-to-action">
          <h1 class="mb-3">Gérer un service d'enrôllement avec Genroll</h1>
           @if(!auth()->user())
             <a class="section-btn" href="/login">se connecter</a>
           @endif
        </div>
        <div class="section-img">
           <h1>Justice</h1>
       </div>
    </div>
  </div>
  <div class="row justify-content-center mt-5 mb-5">
           <div class="proced-section col-md-8">
            <h1 class="text-center" style="font-size:25px;">Service d'enrollement</h1>
             <div class="item-section">
              <div class="proced-item-section">
              <diV class="proced-item" style="width:500px;">
              <i class="fab fa-servicestack" style="margin-left:200px;"></i>
              <p style="margin-left:167px;">Procédure de référe</p>
              </div>
              <div class="proced-desc mt-4 pr-4">
                 <p class="text-justify" style="font-size:14px;">Les référes viennent sous forme d'assignation(acte remis par un huissier
                   saisissant le tribunal pour la procédure d'un fait) avec une date d'audience
                    et le tribunal saisi.
                    Les référes ont différents motifs qui sont:l'expulsion-RSD-Retractation......
                 </p>
              </div>
            </div>
             <div class="proced-item-section"> 
              <diV class="proced-item" style="width:500px">
                <i class="fab fa-servicestack" style="margin-left:200px;" ></i>
                <p style="margin-left:180px;">Procédure civile</p>
              </div>
              <div class="proced-des mt-4 pr-4">
                 <p class="text-justify" style="font-size:14px;">Les civiles sont subdiviséés en trois sorte:</br>
                 -Par assignation</br>
                 -les civiles peuvent venir au greffe sous forme de requête simple
                 -Les civiles peuvent être des dossiers d'appel TI(dossiers provenant du tribunal d'instance pour appel)
                 pour être rejugé.L'appel peut être: un référé-un paiement-une ordonnance...
                </p>
              </div>
             </div>
            </div>
           </div>   
  </div>
@stop