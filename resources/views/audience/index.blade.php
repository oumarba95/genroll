@extends('layout.app')

@section('content')
<div class="container mt-5">
<div class="row justify-content-center">
 @if(count($civiles) > 0 || count($referes) > 0)
  <div class="col-md-8">
  <h1 class="text-center mb-5" style="font-size:24px;">La liste des audiences d'aujourd'hui</h1>
   <table class="table table-striped table-bordered">
    <thead>
        <th>N° de procèdure</th>
        <th>Demandeur</th>
        <th>Defendeur</th>
        <th>Type</th>
    </thead>
    <tbody>
    @foreach($civiles as $civile)
       <tr>
         <td>{{ $civile->id }}</td>
         <td>{{ $civile->demandeur }}</td>
         <td>{{ $civile->defendeur }}</td>
         <td>Civile({{ $civile->description }})</td>
       </tr>
    @endforeach
    @foreach($referes as $refere)
       <tr>
         <td>{{ $refere->id }}</td>
         <td>{{ $refere->demandeur }}</td>
         <td>{{ $refere->defendeur }}</td>
         <td>{{ __('rèfèrè')}}</td>
       </tr>
    @endforeach
    </tbody>
   </table>
   <div class="d-flex justify-content-center">
   {{ $civiles->links() }}
   </div>
 </div>
@else
<p style="font-size:40px;">Pas d'audience.</p>
@endif
</div>
</div>
@stop