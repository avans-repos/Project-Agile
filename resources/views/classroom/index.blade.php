@extends('layouts.app')

@section('title','Klassen')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h1 class="fs-1">Alle Klassen</h1>
      <div class="align-self-center">
        <a class="btn btn-primary" href="{{route('classroom.create')}}">Klas toevoegen</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">

        <thead>
        <tr>
          <td class="w-50">Klas</td>
          <td>Jaar</td>
          <td>Blok</td>
          <td class="w-50">Leerlingen</td>
        </tr>
        </thead>
        <tbody>
        @foreach($classrooms as $classroom)
          <tr>
            <td class="w-25">{{$classroom->name}}</td>
            <td class="w-12">{{$classroom->year}}</td>
            <td class="w-25">{{$classroom->schoolBlock}}</td>
            <td class="w-25">@foreach($classroom->students() as $student)
               {{$student->student()->name}}<br>
              @endforeach
            </td>
            <td>
              <div class="d-md-flex align-items-center">
{{--                <div class="m-1 d-flex justify-content-center align-items-center">--}}
{{--                  <div>--}}
{{--                    <a class="btn btn-primary" href="{{route('contact.show',$classroom)}}">Details</a>--}}
{{--                  </div>--}}
{{--                </div>--}}
                <div class="m-1 d-flex justify-content-center align-items-center">
                  <div>
                    <a class="btn btn-primary"
                       href="{{route('classroom.edit',$classroom)}}">Aanpassen</a>
                  </div>
                </div>
                <div class="m-1">
                  <form method="POST"  id="delete-product-form-{{$classroom->id}}"  action="{{ route('classroom.destroy', $classroom) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="d-flex justify-content-center align-items-center">
                      <a class="btn btn-danger" href="#" onclick="deleteConfirm('delete-product-form-{{$classroom->id}}')">Verwijderen </a>
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
  </div>
@endsection
