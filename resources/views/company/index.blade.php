@extends('layouts.layout')

@section('title','Bedrijven')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h1>Alle bedrijven</h1>
            <div class="align-self-center">
                <a class="btn btn-primary" href="{{route('company.create')}}">Bedrijf toevoegen</a>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-striped table-bordered">

            <thead>
            <tr>
                <td>Naam</td>
                <td>Telefoonnummer</td>
                <td>E-mail</td>
                <td>Website</td>
                <td>Acties</td>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{$company->name}}</td>
                    <td>{{$company->phonenumber}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->website}}</td>
                    <td>
                      <div class="d-md-flex align-items-center">
                        <div class="m-1 d-flex justify-content-center align-items-center">
                          <div>
                            <a class="btn btn-primary" href="{{route('company.show',$company)}}">Details</a>
                          </div>
                        </div>
                        <div class="m-1 d-flex justify-content-center align-items-center">
                          <div>
                            <a class="btn btn-secondary"
                               href="{{route('company.edit',$company)}}">Aanpassen</a>
                          </div>
                        </div>
                        <div class="m-1" style="display: none">
                          <form method="POST" action="{{ route('company.destroy', $company) }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <div class="d-flex justify-content-center align-items-center">
                              <input type="submit" value="Verwijderen" class="btn btn-danger">
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
