@extends('layouts.app')

@section('title','Contactpersoon bekijken')

@section('content')
  <div class="container">
    <div class="w-auto mt-3">
      <a class="btn btn-primary" href="{{route('projectgroup.index')}}">Terug naar overzicht</a>
    </div>
    <div class="d-md-flex justify-content-between mt-3">
      <h1 class="fs-1">Projectgroep weergeven</h1>
      <div class="align-self-center">
        <a class="btn btn-secondary" href="{{route('projectgroup.edit',$projectgroup)}}">Contactpersoon aanpassen</a>
      </div>
    </div>
@endsection
