@extends('layouts.app')

@section('title','userpersonen')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h1 class="fs-1">Gebruikers</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" href="{{route('user.create')}}">Gebruiker toevoegen</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">

        <thead>
        <tr>
          <td>Naam</td>
          <td class="w-50">Emailadres</td>
          <td>Acties</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
              <div class="d-md-flex align-items-center">
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-secondary"
                       href="{{route('user.edit',$user)}}">Aanpassen</a>
                  </div>
                </div>
{{--                <div class="m-1">--}}
{{--                  <form method="POST" action="{{ route('user.destroy', $user) }}">--}}
{{--                    {{ method_field('DELETE') }}--}}
{{--                    {{ csrf_field() }}--}}
{{--                    <div class="d-flex justify-content-center align-items-center">--}}
{{--                      <input type="submit" value="Verwijderen" class="btn btn-danger">--}}
{{--                    </div>--}}
{{--                  </form>--}}
{{--                </div>--}}
              </div>

            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
