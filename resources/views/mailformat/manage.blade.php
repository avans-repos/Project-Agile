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
@section('title','Standaardtekst '.$actionViewName)
    <div class="container mb-5">
        <div class="w-auto mt-3">
            <a class="btn btn-primary" href="{{route('mailformat.index')}}">Terug naar overzicht</a>
        </div>
        <div class="d-flex justify-content-between">
            <h1 class="fs-1">Standaardtekst {{$actionViewName}}</h1>
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
        <div id="create-contact-form-container" class="col-md-6">
            @include('mailformat.form',array('formAction'=>$action,'formActionViewName'=>$actionViewName))
        </div>
    </div>
@endsection
