@extends('layouts.app')



@section('content')
@section('title','Notitie voor ' . $contact->getName())
<div class="container mb-5">
  <div class="w-auto mt-3">
    <a class="btn btn-primary" href="{{route('contact.show', $contact->id)}}">Terug naar contact</a>
  </div>
  <div class="d-flex justify-content-between">
    <h1 class="fs-1 mt-3">Weet je zeker dat je de notitie voor {{$contact->getName()}} wilt verwijderen?</h1>
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
  <div id="create-contact-form-container" class="col-md-6">
    <p class="mb-3 mt-3">{{$note->description}}</p>
    <form method="POST" action="{{ route('notes.deleteConfirmed', $note->id) }}">
      {{ method_field('DELETE') }}
      {{ csrf_field() }}
      <input type="submit" value="Verwijderen >" class="btn btn-danger">
    </form>
  </div>
</div>
@endsection
