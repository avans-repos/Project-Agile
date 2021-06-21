@extends('layouts.app')

<div class="avans-split-background"></div>

@section('title','Home')

@section('content')

<div class="avans-split">
  <div>
    <h1 class="avans-h1">Welkom
      <span class="avans-red">{{ strtok(Auth::user()->name, " ") }}</span>,
    </h1>
    <h2 class="avans-h2">Dit heb je gemist sinds je laatste bezoek.</h2>
    <h2 class="avans-h2 avans-bold avans-red avans-margin-large">Meldingen</h2>

    {{--Meldingen--}}
    <div class="my-3 p-3 bg-white rounded shadow-sm col-sm">
      <div class="d-flex justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
        <h6 class="">Meldingen | {{count($notifications)}}</h6>
        <a type="button" href="{{route('notification.markall')}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Druk op deze knop om alle openstaande meldingen te verwijderen">Alle verwijderen ></a>
      </div>
      @foreach($notifications as $notification)
        <div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              @if($notification->type == "App\Notifications\ActionpointNotification")
                <strong class="text-gray-dark">Herinnering Actiepunt</strong>
              @elseif($notification->type == "App\Notifications\NewNoteNotification")
                <strong class="text-gray-dark">Herinnering contactmoment</strong>
              @endif
              <span class="d-block">{{$notification->data['reminderdate']}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center w-100">
              @if($notification->type == "App\Notifications\ActionpointNotification")
                <span class="d-block"><a href="{{route('actionpoints.show', ['actionpoint' => $notification->data['actionpoint']])}}">{{$notification->data['title']}}</a></span>
              @elseif($notification->type == "App\Notifications\NewNoteNotification")
                <span class="d-block">{{$notification->data['description']}}</span>
              @endif
              <a
                href="{{route('notification.mark',['notificationId' => $notification->id])}}">Markeer als gelezen</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div>
    <h2 class="avans-h2 avans-bold">Actiepunten</h2>

    {{--Actiepunten--}}
    <div class="avans-scrollbox my-4 p-3 bg-white rounded shadow-sm col-sm ms-5">
      <div class="d-flex justify-content-between align-items-center w-100 border-bottom border-gray pb-2 mb-0">
        <h6 class="">Mijn Actiepunten | {{count($actionpoints)}}</h6>
        <a type="button" class="ml-20 btn btn-primary" href="{{route('actionpoints.index')}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Druk op deze knop om een nieuw actiepunt aan te maken">Actiepunt aanmaken ></a>
      </div>
      @foreach($actionpoints as $actionpoint)
        <div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">{{$actionpoint->title}}</strong>
              <span class="d-block {{(new DateTime() > new DateTime(date('Y-m-d H:i:s',strtotime($actionpoint->deadline) - (12*60*60)))) ? 'text-warning' : null}}">{{$actionpoint->deadline}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center w-100">
              <span class="d-block">{{$actionpoint->description}}</span>
              <a class="text-decoration-none"
                  href="{{route('actionpoints.complete',$actionpoint->id)}}">Voltooien</a>
            </div>
            <a class="text-decoration-none" href="{{route('actionpoints.show',$actionpoint->id)}}">Details ></a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@stop
