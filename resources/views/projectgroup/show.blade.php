@extends('layouts.app')

@section('title','Contactpersoon bekijken')

@section('content')
  <div class="container">
    <div class="w-auto mt-3">
      <a class="btn btn-primary" href="{{route('projectgroup.index')}}">Terug naar overzicht</a>
    </div>
    <div class="d-md-flex justify-content-between mt-3">
      <h1 class="fs-1">Projectgroep weergeven</h1>
    </div>
    <div class="d-md-flex">
      <fieldset class="col-sm-6">
        <legend>Projectgroep informatie</legend>
        <div class="row">
          <div class="col-6">
            Naam
          </div>
          <div class="col-6">
            {{$projectgroup->name}}
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Project
          </div>
          <div class="col-6">
            {{$project->name ?? 'Nog geen project'}}
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Docenten
          </div>
          <div class="col-6">
            @foreach($teachers as $teacher)
              <div>{{ $teacher->name }}</div>
            @endforeach
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Studenten
          </div>
          <div class="col-6">
            @foreach($students as $student)
              <div>{{ $student->name }}</div>
            @endforeach
          </div>
        </div>
      </fieldset>
      <fieldset class="col-sm-6">
        <legend>Contactpersonen</legend>

        @foreach($contacts as $contact)
          <div class="row">
            <div>
              <b>{{ $contact->firstname . ' ' . $contact->insertion . ' ' . $contact->lastname }}</b>
              <a class="ml-1" href="{{route('projectgroup.removeContact', ['projectgroupid'=>$projectgroup->id, 'contactid' => $contact->id ])}}">x</a>
            </div>

            <div>
              {{ ucfirst($contact->gender) }}
            </div>

            <div>
              <a href="mailto: {{ $contact->email }}">{{ $contact->email }}</a>
            </div>

            <div>
              {{ $contact->phonenumber }}
            </div>

            <div>
              {{$contact->formattedAddress ?? 'Geen adres beschikbaar'}}
            </div>
          </div>
        @endforeach

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
                <a href="{{route('projectgroup.addContact', ['projectgroupid'=>$projectgroup->id, 'contactid' => $contact->id ])}}" class="btn btn-secondary">Toevoegen</a>
              </td>
            </tr>
          @endforeach
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
@endsection
