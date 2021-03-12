@extends('layouts.layout')

@section('title','Bedrijven')

@section('content')
<div class="container">
        <div class="w-auto mt-3">
            <a class="btn btn-primary" href="{{route('company.index')}}">Terug naar overzicht</a>
        </div>
        <div class="d-md-flex justify-content-between">
            <h1>{{$company->name}}</h1>
            <div class="align-self-center">
                <a class="btn btn-secondary" href="{{route('company.edit',$company)}}">Bedrijf aanpassen</a>
            </div>
        </div>
        <div class="d-md-flex">
            <fieldset class="col-sm-6" id="companyDetails">
                <legend>Algemene informatie</legend>
                <div class="row">
                    <div class="col-6">
                        Bedrijfsnaam
                    </div>
                    <div class="col-6">
                        {{$company->name}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Telefoonnummer
                    </div>
                    <div class="col-6">
                        {{$company->phonenumber}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Email
                    </div>
                    <div class="col-6">
                        <a href="mailto:{{$company->email}}">{{$company->email}}</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Bedrijfsgrote
                    </div>
                    <div class="col-6">
                        {{$company->size}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Website
                    </div>
                    <div class="col-6">
                        <a href="{{$company->website}}">{{$company->website}}</a>
                    </div>
                </div>
            </div>

            <div class="d-md-flex mt-4">
                <fieldset class="col-sm-6" id="companyDetails">
                <legend>Contactpersonen</legend>

                <div class="row">
                    <div class="col-6">
                        Contactpersoon 1
                    </div>
                    <div class="col-6">
                        Hamster Kwak
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
