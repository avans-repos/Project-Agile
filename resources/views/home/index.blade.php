@extends('layouts.app')

@section('title','Home')

@section('content')
  <main role="main" class="container">
    <div class="row">
      {{--Meldingen--}}
      <div class="my-3 p-3 bg-white rounded shadow-sm col-sm">
       <div class="d-flex justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
        <h6 class="">Meldingen | 0</h6>
          <a type="button" class="btn btn-primary">Alle verwijderen ></a>
        </div>
       </div>

      {{--Actiepunten--}}
      <div class="my-3 p-3 bg-white rounded shadow-sm col-sm ms-5">
        <div class="d-flex justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
          <h6 class="">Mijn Actiepunten | {{count($actionpoints)}}</h6>
          <a type="button" class="btn btn-primary" href="{{route('actionpoints.index')}}">Actiepunt aanmaken ></a>
        </div>
        @foreach($actionpoints as $actionpoint)
          <div class="media text-muted pt-3">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <div class="d-flex justify-content-between align-items-center w-100">
                <strong class="text-gray-dark">{{$actionpoint->title}}</strong>
                <span class="d-block" style="color: {{(new DateTime() > new DateTime(date("Y-m-d H:i:s",strtotime($actionpoint->deadline) - (12*60*60)))) ? 'orange' : null}}">{{$actionpoint->deadline}}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center w-100">
                <span class="d-block">{{$actionpoint->description}}</span>
                <a style="text-decoration: none;"  href="{{route('actionpoints.complete',$actionpoint->id)}}">Voltooien</a>
              </div>
              <a style="text-decoration: none;" href="{{route('actionpoints.show',$actionpoint->id)}}">Details ></a>
            </div>
          </div>
        @endforeach
      </div>
    </div>



  </main>
  @stop
