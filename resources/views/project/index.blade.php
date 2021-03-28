@extends('layouts.app')

@section('title','Projecten')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="fs-1">Alle projecten</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" href="{{route('project.create')}}">Project toevoegen</a>
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
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
          <tr>
            <td>{{$project->name}}</td>
            <td>{{$project->description}}</td>
            <td>{{$project->deadline}}</td>
            <td>{{$project->notes}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
