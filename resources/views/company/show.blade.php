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
    <fieldset class="col-sm-12 mt-4" id="companyDetails">
      <legend>Contactpersonen</legend>

      @foreach($contacts as $contact)
      <div class="row">
        <div>
          <b>{{$contact->firstname}} {{$contact->lastname}}</b> 
          <a class="ml-1" href="{{ route('company.removeContact', ['companyid'=>$company->id, 'contactid'=>$contact->id]) }}">x</a>
        </div>

        <div>
          {{ $contact->gender }}
        </div>

        <div>
          <a href="mailto: {{ $contact->email }}">{{ $contact->email }}</a>
        </div>

        <div>
          {{ $contact->phonenumber }}
        </div>

        <div>
          {{ $contact->type }}
        </div>
      </div>
      @endforeach

      <button onClick="showTable()" class="btn btn-primary mt-4">Contactpersoon toevoegen</button>

      <div class="mt-4 d-none" id="add-contact-table">
        <input class="form-control rounded w-25 my-4" type="text" id="searchInput" placeholder="Zoeken..." />
        <table class="table" id="searchTable">
          <thead>
          <tr>
            <th>Naam</th>
            <th>E-mail</th>
            <th>Telefoonnummer</th>
            <th>Bedrijf</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          @foreach($newContacts as $contact)
            <tr>
              <td>
                <b>{{$contact->firstname}} {{$contact->lastname}}</b>
              </td>

              <td>
                <a href="mailto: {{ $contact->email }}">{{ $contact->email }}</a>
              </td>

              <td>
                {{ $contact->phonenumber }}
              </td>

              <td>
                @empty($contact->company)
                  Geen Bedrijf
                @else
                  @foreach($contact->company as $key=>$contactcompany)
                    @if(count($contact->company) == $key + 1)
                      {{$contactcompany}}
                    @else
                      {{$contactcompany}},
                    @endif
                  @endforeach
                @endempty
              </td>

              <td>
                <a href="{{ route('company.addContact', ['companyid'=>$company->id, 'contactid'=>$contact->id]) }}" class="btn btn-secondary">Toevoegen</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
    </fieldset>
  </div>

  <script>
    let table = document.getElementById("add-contact-table");

    function showTable()
    {
      if (table.classList.contains("d-none"))
      {
        table.classList.remove("d-none");
      }
      else
      {
        table.classList.add("d-none");
      }
    }
  </script>

  <script src="{{ asset('js/search.js')}}"></script>
@endsection
