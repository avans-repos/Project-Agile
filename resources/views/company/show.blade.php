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

        <div class="row">
          <div class="col-6">
            Notitie
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p>{{$company->note}}</p>
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
    <fieldset class="mt-4" id="companyDetails">
      <legend>Contactpersonen</legend>
      <div class="d-flex flex-column">
        @foreach($contacts as $contact)
          <div class="d-flex align-items-start bg-white rounded shadow-sm p-3">
            <div class="me-sm-3">
              <div>
                <b>{{$contact->firstname}} {{$contact->lastname}}</b>
                <a class="ml-1" href="{{$company->id}}/removecontact/{{ $contact->id }}">x</a>
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
            <div class="w-100">
              <div
                class="d-flex w-100 justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
                <h6 class="">Notities | {{$notes->where('contact',$contact->id)->count()}}</h6>
              </div>
              @php
                $firstNote = $notes->where('contact',$contact->id)[0]
              @endphp

              <div class="my-3 p-3 bg-white rounded shadow-sm col-sm-7 w-100">
                <div class="media text-muted pt-3">
                  <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                      <strong class="text-gray-dark">Gemaakt door: {{$firstNote->name}}
                        op {{date('d-m-Y H:i:s', strtotime($firstNote->creation))}}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center w-100 mt-2">
                      <span class="d-block text-break">{{$firstNote->description}}</span>
                    </div>
                  </div>
                </div>
              </div>
              <button class="read-more-button" type="button" data-bs-toggle="collapse" data-bs-target=".extra-notes">
                Meer lezen...
              </button>
              <div class="collapse extra-notes" id="notes-{{$contact->id}}">
                <div class="w-100">
                  @foreach($notes->where('contact',$contact->id) as $note)
                    @continue($loop->index == 0)
                    <div class="my-3 p-3 bg-white rounded shadow-sm col-sm-7 w-100">
                      <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                          <div class="d-flex justify-content-between align-items-center w-100">
                            <strong class="text-gray-dark">Gemaakt door: {{$note->name}}
                              op {{date('d-m-Y H:i:s', strtotime($note->creation))}}</strong>
                          </div>
                          <div class="d-flex justify-content-between align-items-center w-100 mt-2">
                            <span class="d-block text-break">{{$note->description}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button onClick="showTable()" class="btn btn-primary mt-4">Contactpersoon toevoegen</button>

      <table class="table mt-4 d-none" id="add-contact-table">
        <tr>
          <th>Naam</th>
          <th>E-mail</th>
          <th>Telefoonnummer</th>
          <th></th>
        </tr>
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
              <a href="{{$company->id}}/addcontact/{{ $contact->id }}" class="btn btn-secondary">Toevoegen</a>
            </td>
          </tr>
        @endforeach
      </table>
    </fieldset>
  </div>

  <script>
    let table = document.getElementById("add-contact-table");

    function showTable() {
      if (table.classList.contains("d-none")) {
        table.classList.remove("d-none");
      } else {
        table.classList.add("d-none");
      }
    }

    let showMoreTexts = document.querySelectorAll(".read-more-button");
    showMoreTexts.forEach(element => element.addEventListener('click',function() {editReadMoreText(element)}));

    function editReadMoreText(element) {

      console.log(element);

      if(element.innerHTML === 'Minder lezen...') {
        element.innerHTML = 'Meer lezen...';
      } else {
        element.innerHTML = 'Minder lezen...';
      }
    }
  </script>
@endsection
