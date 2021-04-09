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
@section('title','Actiepunt '.$actionViewName)
<main role="main" class="container">
<div class="container mb-5">
    <div class="w-auto mt-3">
        <a class="btn btn-primary" href="{{route('actionpoints.index')}}">Terug naar overzicht</a>
    </div>
    <div class="d-flex justify-content-between">
        <h1 class="fs-1">Actiepunt {{$actionViewName}}</h1>
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
    <div id="create-actionpoints-form-container" class="col-md-6">
        @include('actionPoints.form',array('formAction'=>$action,'formActionViewName'=>$actionViewName))
    </div>
</div>
</main>
@endsection
