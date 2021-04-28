@extends('layouts.app')

@section('title','Gebruiker aanpassen')

@section('content')
  <div class="container">
    <div class="w-auto mt-3">
      <a class="btn btn-primary" href="{{route('user.index')}}">Terug naar overzicht</a>
    </div>
    <div class="d-md-flex justify-content-between mt-3">
      <h1 class="fs-1">Gebruiker aanpasen</h1>
    </div>
    <div class="d-md-flex">
      <fieldset class="col-sm-6" id="userDetails">
        <legend>Gebruikersinformatie</legend>
        <div class="row">
          <div class="col-6">
            Naam
          </div>
          <div class="col-6">
            {{$user->name}}
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Emailadres
          </div>
          <div class="col-6">
            {{$user->email}}
          </div>
        </div>
        <legend>Huidige Rollen</legend>
        @foreach($user->getRoleNames() as $role)
          <fieldset class="row">
            <div class="col-6">
              {{$role}}
            </div>
          </fieldset>
        @endforeach
      </fieldset>
      <div class="col-sm-6">
        <form action="{{route('user.update', ['user' => $user])}}" method="post">
          @csrf
          @method('PATCH')

          @if ($errors->any())
              @foreach ($errors->all() as $error)
              <div class="alert alert-danger">
                <p>{{ $error }}</p>
              </div>
              @endforeach
          @endif

          <legend>Rollen aanpassen</legend>
          <select class="form-select overflow-auto" name="roles[]" multiple>
            @foreach($roles as $role)
                <option
                  value="{{$role->id}}"
                  @if($user->hasRole($role))
                    selected
                  @endif>
                  {{$role->name}}
                </option>
            @endforeach
          </select>
          <br>
          <button class="btn btn-primary" type="submit">
            Aanpassingen bevestingen
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
