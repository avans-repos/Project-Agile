@extends('layouts.app')

@section('title','Contactpersoon bekijken')

@section('content')
    <div class="container">
        <div class="w-auto mt-3">
            <a class="btn btn-primary" href="{{route('contact.index')}}">Terug naar overzicht</a>
        </div>
        <div class="d-md-flex justify-content-between mt-3">
            <h1 class="fs-1">Contactpersoon weergeven</h1>
            <div class="align-self-center">
                <a class="btn btn-secondary" href="{{route('contact.edit',$contact)}}">Contactpersoon aanpassen</a>
            </div>
        </div>
        <div class="d-md-flex">
            <fieldset class="col-sm-6" id="contactDetails">
                <legend>Persoonlijke informatie</legend>
                <div class="row">
                    <div class="col-6">
                        Voorletters
                    </div>
                    <div class="col-6">
                        {{$contact->initials}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Voornaam
                    </div>
                    <div class="col-6">
                        {{$contact->firstname}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Tussenvoegsel
                    </div>
                    <div class="col-6">
                        {{$contact->insertion}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Achternaam
                    </div>
                    <div class="col-6">
                        {{$contact->lastname}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Geslacht
                    </div>
                    <div class="col-6">
                        {{$contact->gender}}
                    </div>
                </div>

            </fieldset>
            <div class="col-sm-6" id="contactDetails">
                <legend>Contactinformatie</legend>
                <div class="row">
                    <div class="col-6">
                        E-mail
                    </div>
                    <div class="col-6">
                        {{$contact->email}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Telefoonnummer
                    </div>
                    <div class="col-6">
                        {{$contact->phonenumber}}
                    </div>
                </div>
                <fieldset class="row">
                    <div class="col-6">
                        Contactsoort
                    </div>
                    <div class="col-6">
                        {{$contact->type}}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
@endsection
