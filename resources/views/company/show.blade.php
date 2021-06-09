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
          <div class="col-6">
            <span>{{$company->note}}</span>
          </div>
        </div>
      </fieldset>
      <fieldset class="col-sm-6" id="companyAddresses">
        <legend>Adres</legend>
        <div id="adres1">
          @if($company->mailing_address() != null)
            <span class="text-decoration-underline">
            @if($company->mailing_address()->id == $company->visiting_address()->id)
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
                {{$company->visiting_address()->streetname}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Huisnummer + toevoeging
              </div>
              <div class="col-6">
                {{$company->visiting_address()->number . $company->visiting_address()->addition}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Postcode
              </div>
              <div class="col-6">
                {{$company->visiting_address()->zipcode}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Plaats
              </div>
              <div class="col-6">
                {{$company->visiting_address()->city}}
              </div>
            </div>
        </div>
        @if($company->mailing_address()->id != $company->visiting_address()->id)
          <div id="address2">
            <span class="text-decoration-underline">Postadres</span>
            <div class="row">
              <div class="col-6">
                Straatnaam
              </div>
              <div class="col-6">
                {{$company->mailing_address()->streetname}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Huisnummer + toevoeging
              </div>
              <div class="col-6">
                {{$company->mailing_address()->number . $company->mailing_address()->addition}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Postcode
              </div>
              <div class="col-6">
                {{$company->mailing_address()->zipcode}}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Plaats
              </div>
              <div class="col-6">
                {{$company->mailing_address()->city}}
              </div>
            </div>
          </div>
        @endif
        @else
          <span>
            Geen adresgegevens gevonden
          </span>
        @endif
      </fieldset>
    </div>
    <fieldset class="col-sm-12 mt-4" id="companyDetails">
      <legend>Contactpersonen</legend>
      @foreach($company->contacts()->get() as $contact)
        <div class="my-3 p-3 bg-white rounded shadow-sm  d-flex">
          <div class="col-sm-3">
            <div>
              <b>{{$contact->contact()->first()->getName()}}</b>
              <a class="ml-1"
                 href="{{ route('company.removeContact', ['companyid'=>$company->id, 'contactid'=>$contact->contact()->first()->id]) }}">x</a>
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
          <div class="col-sm-9 ml-3">
            <div
              class="d-flex w-100 justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
              <h6 class="">Notities | {{$contact->contact()->first()->notes()->get()->count()}}</h6>
            </div>
            @if($contact->contact()->first()->notes()->get()->count() > 0)
              <div class="my-3 p-3 bg-white rounded shadow-sm col-sm-7 w-100">
                <div class="media text-muted pt-3">
                  <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                      <strong class="text-gray-dark">Gemaakt
                        door: {{$contact->contact()->first()->notes()->orderByDesc('creation')->first()->contact()->first()->getName()}}
                        op {{date('d-m-Y H:i', strtotime($contact->contact()->first()->notes()->orderByDesc('creation')->first()->creation))}}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center w-100 mt-2">
                      <span
                        class="d-block text-break">{{$contact->contact()->first()->notes()->orderByDesc('creation')->first()->description}}</span>
                    </div>
                  </div>
                </div>
              </div>
              @if($contact->contact()->first()->notes()->get()->count() > 1)
                <button class="read-more-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#notes-{{$contact->contact()->first()->id}}">Meer lezen...
                </button>
                <div class="collapse extra-notes" id="notes-{{$contact->contact()->first()->id}}">
                  <div class="w-100 h-50 notes-height">
                    @foreach($contact->contact()->first()->notes()->orderByDesc('creation')->get() as $note)
                      @continue($loop->index == 0)
                      <div class="my-3 p-3 bg-white rounded shadow-sm col-sm-7 w-100">
                        <div class="media text-muted pt-3">
                          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                              <strong class="text-gray-dark">Gemaakt door: {{$note->contact()->first()->getName()}}
                                op {{date('d-m-Y H:i', strtotime($note->creation))}}</strong>
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
              @endif
            @endif
          </div>
        </div>
      @endforeach
      <button onClick="showTable()" class="btn btn-primary mt-4">Contactpersoon toevoegen</button>

      <div class="mt-4 d-none" id="add-contact-table">
        <table class="table table-striped" id="searchTable">
          <thead>
          <tr>
            <th>Naam</th>
            <th>E-mail</th>
            <th>Telefoonnummer</th>
            <th>Bedrijf</th>
            <th>Acties</th>
          </tr>
          </thead>
          <tbody>
          @foreach($newContacts as $contact)
            <tr>
              <td>
                <b>{{$contact->getName()}}</b>
              </td>

              <td>
                <a href="mailto: {{ $contact->email }}">{{ $contact->email }}</a>
              </td>

              <td>
                {{ $contact->phonenumber }}
              </td>

              <td>
                @if($contact->companies()->first() == null)
                  Geen Bedrijf
                @else
                  @foreach($contact->companies()->get() as $contactCompany)
                    @if($loop->last)
                      {{$contactCompany->company()->first()->name}}
                    @else
                      {{$contactCompany->company()->first()->name}},
                    @endif
                  @endforeach
                @endempty
              </td>

              <td>
                <a href="{{ route('company.addContact', ['companyid'=>$company->id, 'contactid'=>$contact->id]) }}"
                   class="btn btn-secondary">Toevoegen</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
  </div>
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

    let readMoreButtons = document.querySelectorAll('.read-more-button');

    console.log(readMoreButtons);

    readMoreButtons.forEach(button => {
      button.addEventListener('click', () => {
        if (!button.classList.contains('collapsed')) {
          button.innerHTML = "Minder lezen..."
        } else {
          button.innerHTML = "Meer lezen..."
        }
      })
    })
  </script>

@endsection
