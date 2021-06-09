@extends('layouts.app')

@section('title','Projecten')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="fs-1">Alle projecten</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" onclick="clearSessionData()" href="{{route('project.create')}}">Project toevoegen</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <td>Naam</td>
          <td>Omschrijving</td>
          <td>Opleverdatum</td>
          <td>Notities</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
          <tr>
            <td>{{$project->name}}</td>
            <td class="text-break">{{$project->description}}</td>
            <td>{{$project->deadline}}</td>
            <td class="text-break">{{$project->notes}}</td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-secondary" onclick="clearSessionData()"
                       href="{{route('project.edit',$project)}}">Aanpassen</a>
                  </div>
                </div>
                @role('Admin')
                <div class="m-1">
                  <form method="POST" id="delete-product-form-{{$project->id}}" action="{{ route('project.destroy', $project) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <a class="btn btn-danger" href="#" onclick="deleteConfirm('delete-product-form-{{$project->id}}', '{{$project->getDeleteText()}}')">Verwijderen </a>
                    </div>
                  </form>
                </div>
                @endrole
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <script>
    function clearSessionData(){
      sessionStorage.removeItem('projectFormData');
    }
  </script>
@endsection
