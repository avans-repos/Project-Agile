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
                <td>Id</td>
                <td>Naam</td>
                <td>Telefoonnummer</td>
                <td>E-mail</td>
                <td>Aantal medewerkers</td>
                <td>Website</td>
                <td>Acties</td>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{$company->id}}</td>
                    <td>{{$company->name}}</td>
                    <td>{{$company->phonenumber}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->size}}</td>
                    <td>{{$company->website}}</td>
                    <td>
                        <a class="btn btn-info" href="{{route('company.show',$company->id)}}">Show</a>
                        <a class="btn btn-primary" href="{{route('company.edit',$company->id)}}">Edit</a>
                        <a class="btn btn-danger" href="{{route('company.destroy',$company->id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>

@endsection
