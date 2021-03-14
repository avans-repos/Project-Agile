@extends('layouts.app')

@section('title','Actiepunt bekijken')

@section('content')

    <div class="container">
        <div class="row mt-3">
            <div class="col-sm-12">
              <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('actionpoints.index') }}">Terug</a>
              </div>
                <div class="pull-left mt-3">
                    <h2 class="fs-2">Actiepunt:</h2>
                </div>
            </div>
        </div>

      <div class="d-md-flex">
        <fieldset class="col-sm-6" id="contactDetails">
          <div class="row">
            <div class="col-6">
              Deadline
            </div>
            <div class="col-6">
              {{$actionpoint->deadline}}
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              Reminder datum
            </div>
            <div class="col-6">
              {{$actionpoint->reminderdate}}
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              Titel
            </div>
            <div class="col-6">
              {{$actionpoint->title}}
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              Omschrijving
            </div>
            <div class="col-6">
              {{$actionpoint->description}}
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              Toegekend door
            </div>
            <div class="col-6">
              {{$creatorName}}
            </div>
          </div>

        </fieldset>
        <div class="col-sm-6" id="contactDetails">
          <legend>Toegekend aan</legend>
          <div class="row">
            <ul class="list-group w-100">
              @foreach($assigned as $teacher)
                <li  class="list-group-item w-80">{{$teacher->name}}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

@endsection
