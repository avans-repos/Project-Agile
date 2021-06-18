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
    <div>
      <fieldset class="col-sm-12">
        <legend>Projectgroep informatie</legend>
        <div class="row">
          <div class="col-6">
            Naam
          </div>
          <div class="col-6 mb-2">
            {{$projectgroup->name}}
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            Project(en)
          </div>
          <div class="col-6">
            @if($projects != [])
              @foreach($projects as $project)
                <div>{{$project->name}}</div>
              @endforeach
            @else
              <div>Geen projecten gekoppeld</div>
            @endif

          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            Docenten
          </div>
          <div class="col-6">
            @foreach($projectgroup->users()->role('Teacher')->get() as $teacher)
              <div>{{ $teacher->name }}</div>
            @endforeach
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            Studenten
          </div>
          <div class="col-6">
            @foreach($projectgroup->users()->role('Student')->get() as $student)
              <div>{{ $student->name }}</div>
            @endforeach
          </div>
        </div>
      </fieldset>
      <fieldset class="col-sm-12 mt-5">
        <legend>Contactpersonen</legend>

        @foreach($projectgroup->contacts()->get() as $contact)
          <div class="row">
            <div>
              <b>{{ $contact->getName() }}</b>
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

        <div class="mt-4 d-none" id="add-contact-table">
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
                  <b>{{$contact->getName()}}</b>
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
                  <a
                    href="{{route('projectgroup.addContact', ['projectgroupid'=>$projectgroup->id, 'contactid' => $contact->id ])}}"
                    class="btn btn-secondary">Toevoegen</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
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
    </script>
@endsection
