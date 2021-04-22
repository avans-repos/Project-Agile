@extends('layouts.app')

@section('title','Mijn actiepunten')

@section('content')
  <main role="main" class="container">
    <div class="mt-5">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-1">Actiepunten</h1>
        <div class="align-self-center">
          <a class="btn btn-primary" href="{{ route('actionpoints.create') }}">Nieuwe actiepunt aanmaken</a>
        </div>
      </div>
      <table class="table table-striped mt-3">
        <thead>
        <tr>
          <td>Deadline</td>
          <td>Titel</td>
          <td>Omschrijving</td>
          <td>Afgerond</td>
          <td>Reminderdatum</td>
          <td>Toegekend door</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($actionPoints as $actionPoint)
          <tr>
            <td>{{$actionPoint->deadline}}</td>
            <td>{{$actionPoint->title}}</td>
            <td>{{$actionPoint->description}}</td>
            <td>{{$actionPoint->finished == 1 ? 'Ja' : 'Nee'}}</td>
            <td>{{$actionPoint->reminderdate}}</td>
            <td>{{$actionPoint->name}}</td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-primary" href="{{route('actionpoints.show',$actionPoint)}}">Details</a>
                  </div>
                </div>
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-secondary"
                       href="{{route('actionpoints.edit',$actionPoint)}}">Aanpassen</a>
                  </div>
                </div>
                <div class="m-1">
                  <form method="POST" id="delete-product-form-{{$actionPoint->id}}"  class="m-0" action="{{ route('actionpoints.destroy', $actionPoint) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <a class="btn btn-danger" href="#" onclick="deleteConfirm('delete-product-form-{{$actionPoint->id}}')">Verwijderen </a>
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
  </main>
@endsection
