@extends('layouts.app')

@section('title','contactpersonen')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h1 class="fs-1">Alle contactpersonen</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" href="{{route('contact.create')}}">Contactpersoon toevoegen</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">

        <thead>
        <tr>
          <td class="w-50">Voornaam</td>
          <td>Tussenvoegsel</td>
          <td class="w-50">Achternaam</td>
          <td class="w-50">Type</td>
          <td class="w-50">Huidige werkgever</td>
          <td class="w-50">Laatste project</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
          @if($contact->projectgroups)
          @endif
          <tr>
            <td>{{$contact->firstname}}</td>
            <td>{{$contact->insertion}}</td>
            <td>{{$contact->lastname}}</td>
            <td>{{$contact->type}}</td>
            <td>
              @if($contact->companies()->first() !== null)
                {{$contact->companies()->first()->name}}
              @endif
            </td>
            <td>
              @if($contact->projectgroups()->first() !== null)
              {{$contact->projectgroups()->first()->project()->first()->name}}
              @endif
            </td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-primary" href="{{route('contact.show',$contact)}}">Details</a>
                  </div>
                </div>
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-secondary"
                       href="{{route('contact.edit',$contact)}}">Aanpassen</a>
                  </div>
                </div>
                <div class="m-1">
                  <form method="POST" id="delete-product-form-{{$contact->id}}"
                        action="{{ route('contact.destroy', $contact) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <a class="btn btn-danger" href="#"
                         onclick="deleteConfirm('delete-product-form-{{$contact->id}}')">Verwijderen </a>
                    </div>
                  </form>
                </div>
              </div>

            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
