@extends('layouts.app')

@section('content')
  <?php
  $actionViewName = '';
  if ($action == 'store') {
    $actionViewName = 'toevoegen';
  } else {
    $actionViewName = 'aanpassen';
  }
  ?>
@section('title','Profiel '.$actionViewName)
<div class="container mb-5">
  <div class="w-auto mt-3">
    <a class="btn btn-primary" href="{{route('dashboard')}}">Terug naar dashboard</a>
  </div>
  <div class="d-flex justify-content-between">
    <h1 class="fs-1">Profiel {{$actionViewName}}</h1>
  </div>
  @if($errors->any())
    <div class="alert alert-danger">
      <strong>Er is iets misgegaan</strong>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div id="create-project-form-container" class="col-md-6">
    @include('profile.form',array('formAction'=>$action,'formActionViewName'=>$actionViewName))
  </div>
@endsection
