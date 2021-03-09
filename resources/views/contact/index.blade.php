@extends('layouts.layout')

@section('title','contactpersonen');

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h1>Alle contactpersonen</h1>
            <div class="align-self-center">
                <a class="btn btn-primary" href="{{route('contact.create')}}">Contactpersoon toevoegen</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <thead>
                <tr>
                    <td class="w-50">Voornaam</td>
                    <td class="w-50">Achternaam</td>
                    <td>Acties</td>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->firstname}}</td>
                        <td>{{$contact->lastname}}</td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <div class="me-2">
                                    <a class="btn btn-primary" href="{{route('contact.show',$contact)}}">Details</a>
                                </div>
                                <div class="me-2">
                                    <a class="btn btn-secondary" href="{{route('contact.edit',$contact)}}">Aanpassen</a>
                                </div>
                                <div class="">
                                    <form method="POST" action="{{ route('contact.destroy', $contact) }}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <input type="submit" value="Verwijderen" class="btn btn-danger">
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
