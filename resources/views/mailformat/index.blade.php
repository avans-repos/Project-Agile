@extends('layouts.app')

@section('title','contactpersonen')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h1 class="fs-1">Alle standaardteksten</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" href="{{route('mailformat.create')}}">Standaardtekst toevoegen</a>
      </div>
    </div>
    <div>
      <table class="table-layout-fixed table table-striped">
        <thead>
        <tr>
          <td>Naam</td>
          <td>Inhoud</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($mailFormats as $mailFormat)
          <tr>
            <td><p class="text-nowrap overflow-hidden text-truncate">{{$mailFormat->name}}</p></td>
            <td>
              <div class="collapse show multi-collapse-{{$mailFormat->id}}" id="smalltext-{{$mailFormat->id}}">
                <p class="text-nowrap overflow-hidden text-truncate">{{$mailFormat->body}}</p>
              </div>
              <div class="collapse multi-collapse-{{$mailFormat->id}}" id="fulltext-{{$mailFormat->id}}">
                <div class="card card-body">
                  <p>{!! nl2br(e($mailFormat->body))!!}</p>
                </div>
              </div>
            </td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse-{{$mailFormat->id}}" aria-expanded="false" aria-controls="smalltext-{{$mailFormat->id}} fulltext-{{$mailFormat->id}}">Volledige inhoud</button>
                  </div>
                </div>
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-secondary"
                       href="{{route('mailformat.edit',$mailFormat)}}">Aanpassen</a>
                  </div>
                </div>
                @role('Admin')
                <div class="m-1">
                  <form method="POST" id="delete-product-form-{{$mailFormat->id}}"
                        action="{{ route('mailformat.destroy', $mailFormat) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <a class="btn btn-danger" href="#"
                         onclick="deleteConfirm('delete-product-form-{{$mailFormat->id}}')">Verwijderen </a>
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
@endsection
