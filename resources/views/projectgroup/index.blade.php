@extends('layouts.app')

@section('title','Projectgroepen')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h1 class="fs-1">Projectgroepen</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" onclick="clearSessionData()"
          href="{{route('projectgroup.create')}}">Projectgroep toevoegen</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">

        <thead>
        <tr>
          <td class="w-25">Naam</td>
          <td class="w-25">Gekoppelde docent(en)</td>
          <td class="w-25">Gekoppelde student(en)</td>
          <td class="w-25">Project</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($projectgroups as $projectgroup)
          <tr>
            <td class="w-25">{{$projectgroup['group']['name']}}</td>
            <td class="w-25">
              @foreach($projectgroup['teachers'] as $assignee)
                {{$assignee['name']}}<br>
              @endforeach
            </td>
            <td class="w-25">
              @foreach($projectgroup['students'] as $assignee)
                {{$assignee['name']}}<br>
              @endforeach
            </td>
            <td class="w-25">
              {{$projectgroup['project']}}
            </td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div class="m-1 d-flex justify-content-center align-items-center">
                    <div>
                      <a class="btn btn-primary" href="{{route('projectgroup.show',$projectgroup['group'])}}">Details</a>
                    </div>
                  </div>
                  <div>
                    <a class="btn btn-secondary" onclick="clearSessionData()"
                       href="{{route('projectgroup.edit',$projectgroup['group'])}}">Aanpassen</a>
                  </div>
                </div>
                @role('Admin')
                <div class="m-1">
                  <form method="POST" id="delete-product-form-{{ $projectgroup['group']->id}}" action="{{ route('projectgroup.destroy', $projectgroup['group']) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <a class="btn btn-danger" href="#" onclick="deleteConfirm('delete-product-form-{{$projectgroup['group']->id}}', `{{$projectgroup['group']->getDeleteText()}}`)">Verwijderen </a>
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
      sessionStorage.removeItem('projectGroupFormData');
    }
  </script>
@endsection
