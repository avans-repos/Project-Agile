@extends('layouts.app')



@section('content')
  <?php
  $actionViewName = '';
  if ($action == 'store') {
    $actionViewName = 'toevoegen';
  } else {
    $actionViewName = 'aanpassen';
  }
  ?>
@section('title','Project '.$actionViewName)
<div class="container mb-5">
  <div class="w-auto mt-3">
    <a class="btn btn-primary" href="{{route('project.index')}}">Terug naar overzicht</a>
  </div>
  <div class="d-flex justify-content-between">
    <h1 class="fs-1">Project {{$actionViewName}}</h1>
  </div>
  @if($errors->any())
    <div class="alert alert-danger">
      <strong>Er is iets misgegaan</strong>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div id="create-project-form-container" class="col-md-6">
    @include('project.form',array('formAction'=>$action,'formActionViewName'=>$actionViewName))
  </div>

{{--  @if($action === 'update')--}}
{{--  <div class="mt-5">--}}
{{--    <legend>Gekoppelde projectgroepen:</legend>--}}

{{--    <table class="table">--}}
{{--      <tr>--}}
{{--        <th>Groep id</th>--}}
{{--        <th>Groep naam</th>--}}
{{--        <th>Actie</th>--}}
{{--      </tr>--}}

{{--      @foreach($currentProjectgroups as $group)--}}
{{--      <tr>--}}
{{--        <td>{{ $group->id }}</td>--}}
{{--        <td>{{ $group->name }}</td>--}}
{{--        <td>--}}
{{--          <form method="GET" id="delete-group-{{$group->id}}" action="{{ route('removegroup', ['projectid' => $project->id, 'groupid' => $group->id]) }}">--}}
{{--            <a href="#" onclick="deleteConfirm('delete-group-{{$group->id}}')" class="btn btn-danger">Verwijderen</a>--}}
{{--          </form>--}}
{{--        </td>--}}
{{--      </tr>--}}
{{--      @endforeach--}}
{{--    </table>--}}
{{--  </div>--}}

{{--  <button onClick="showTable()" class="btn btn-primary mt-4">Projectgroep toevoegen</button>--}}

{{--  <div class="mt-5 d-none" id="add-projectgroup-table">--}}
{{--    <legend>Beschikbare projectgroepen:</legend>--}}

{{--    <table class="table">--}}
{{--      <tr>--}}
{{--        <th>Groep id</th>--}}
{{--        <th>Groep naam</th>--}}
{{--        <th>Actie</th>--}}
{{--      </tr>--}}

{{--      @foreach($availableProjectgroups as $group)--}}
{{--      <tr>--}}
{{--        <td>{{ $group->id }}</td>--}}
{{--        <td>{{ $group->name }}</td>--}}
{{--        <td><a href="{{ route('addgroup', ['projectid' => $project->id, 'groupid' => $group->id]) }}" class="btn btn-secondary">Toevoegen</a></td>--}}
{{--      </tr>--}}
{{--      @endforeach--}}
{{--    </table>--}}
{{--  </div>--}}
{{--  @endif--}}

{{--</div>--}}

{{--<script>--}}
{{--    let table = document.getElementById("add-projectgroup-table");--}}
{{--    function showTable()--}}
{{--    {--}}
{{--      table.classList.toggle("d-none");--}}
{{--    }--}}
{{--  </script>--}}
@endsection
