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
                      Initialen
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
                        {{ucfirst($contact->gender)}}
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
                        {{$contact->email ?? 'N.v.t.'}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Telefoonnummer
                    </div>
                    <div class="col-6">
                        {{$contact->phonenumber ?? 'N.v.t.'}}
                    </div>
                </div>

            </div>


        </div>

<div class="mt-5 mb-5 d-md-flex">
  <div class="col-sm-6">
  <legend>Werk</legend>
    <fieldset class="row">
      <div class="col-6">
        <strong>Bedrijf</strong>
      </div>
      <div class="col-6">
        <strong>Contact type</strong>
      </div>
    </fieldset>
  @foreach($contact->companies()->get() as $company)
    <fieldset class="row">
      <div class="col-6">
        {{$company->company()->first()->name}}
      </div>
      <div class="col-6">
        {{ucfirst($company->contacttype) }}
      </div>
    </fieldset>
  @endforeach
  </div>
    <fieldset class="col-sm-6" id="companyAddresses">
      <legend>Adres</legend>
      @if($contact->address() != null && $contact->address()->first() != null)
        <div id="adres1">
          <div class="row">
            <div class="col-6">
              Straatnaam
            </div>
            <div class="col-6">
              {{$contact->address()->first()->streetname}}
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              Huisnummer + toevoeging
            </div>
            <div class="col-6">
              {{$contact->address()->first()->number . $contact->address()->first()->addition}}
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              Postcode
            </div>
            <div class="col-6">
              {{$contact->address()->first()->zipcode}}
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              Plaats
            </div>
            <div class="col-6">
              {{$contact->address()->first()->city}}
            </div>
          </div>
        </div>
      @else
        <div>Geen adres beschikbaar</div>
      @endif
    </fieldset>
</div>

      <div class="my-3 p-3 bg-white rounded shadow-sm col-sm-7">
        <div class="d-flex justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
          <h6 class="">Notities |  {{$contact->notes()->get()->count()}}</h6>
          <a type="button" class="btn btn-primary" href="{{route('notes.create', $contact)}}">Notitie aanmaken ></a>
        </div>
        @foreach($contact->notes()->get() as $note)
          <div class="media text-muted pt-3">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <div class="d-flex justify-content-between align-items-center w-100">
                <strong class="text-gray-dark">Gemaakt door: {{$note->name}} op {{date('d-m-Y H:i', strtotime($note->creation))}}</strong>
                <a href="{{route('notes.edit',$note->id)}}">Bewerken</a>
              </div>
              <div class="d-flex justify-content-between align-items-center w-100 mt-2">
                <span></span>
                <form method="POST" id="delete-product-form-{{$note->id}}" action="{{ route('notes.delete', $note->id) }}">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <div class="d-flex justify-content-center align-items-center">
                    <a href="#" onclick="deleteConfirm('delete-product-form-{{$note->id}}')">Verwijderen </a>
                  </div>
                </form>
              </div>
              <div class="d-flex justify-content-between align-items-center w-100 mt-2">
                <span class="d-block text-break">{{$note->description}}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
@endsection
