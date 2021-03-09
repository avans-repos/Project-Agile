@extends('layouts.layout')

@section('content')
    <?php
        $actionViewName = "";
        if($action == 'store') {
            $actionViewName = "toevoegen";
        } else {
            $actionViewName = "aanpassen";
        }

    ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <h1>Contactpersoon {{$actionViewName}}</h1>
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
            @include('contact.form',array('formAction'=>$action,'formActionViewName'=>$actionViewName))
        </div>
    </div>
@endsection
