@extends('layouts.app')

@section('title','Projectgroepen')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h1 class="fs-1">Projectgroepen</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" href="{{route('projectgroup.create')}}">Projectgroep toevoegen</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">

        <thead>
        <tr>
          <td class="w-25">Naam</td>
          <td class="w-25">gekoppelde docent(en)</td>
          <td class="w-25">gekoppelde student(en)</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
          <tr>
            <td class="w-25">{{$group->name}}</td>
            <td class="w-25">
              @foreach($assigned_to_group->where('projectgroupid',$group->id) as $assignee)
                {{$assignee->name}}<br>
              @endforeach
            </td>
            <td class="w-25">
              @foreach($assigned_to_group->where('projectgroupid',$group->id) as $assignee)
                {{$assignee->name}}<br>
              @endforeach
            </td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-secondary"
                       href="{{route('projectgroup.edit',$group)}}">Aanpassen</a>
                  </div>
                </div>
                <div class="m-1">
                  <form method="POST" action="{{ route('projectgroup.destroy', $group) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <input type="submit" value="Verwijderen" class="btn btn-danger">
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
