@extends('layouts.app')

@section('title','Bedrijf details')

@section('content')
  <div class="container">
    <div class="w-auto mt-3">
      <a class="btn btn-primary" href="{{route('company.index')}}">Terug naar overzicht</a>
    </div>
    <div class="d-md-flex justify-content-between">
      <h1 class="fs-1">{{$company->name}}</h1>
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
      </fieldset>
      <fieldset class="col-sm-6" id="companyAddresses">
        <legend>Adres</legend>
        <div id="adres1">
          <span class="text-decoration-underline">
        @if($address2 == null)
              Bezoekadres & postadres
            @else
              Bezoekadres
            @endif
          </span>
          <div class="row">
            <div class="col-6">
              Straatnaam
            </div>
            <div class="col-6">
              {{$address1->streetname}}
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              Huisnummer + toevoeging
            </div>
            <div class="col-6">
              {{$address1->number . $address1->addition}}
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              Postcode
            </div>
            <div class="col-6">
              {{$address1->zipcode}}
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              Plaats
            </div>
            <div class="col-6">
              {{$address1->city}}
            </div>
          </div>
        </div>
        @if($address2 != null)
          <div id="address2">
            <span class="text-decoration-underline">Postadres</span>
            <div class="row">
              <div class="col-6">
                Straatnaam
              </div>
              <div class="col-6">
                {{$address2->streetname}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Huisnummer + toevoeging
              </div>
              <div class="col-6">
                {{$address2->number . $address2->addition}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Postcode
              </div>
              <div class="col-6">
                {{$address2->zipcode}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Plaats
              </div>
              <div class="col-6">
                {{$address2->city}}
              </div>
            </div>
          </div>
        @endif
      </fieldset>
    </div>
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
    </fieldset>
  </div>


@endsection
