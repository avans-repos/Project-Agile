@extends('layouts.layout')

@section('title','Actiepunt aanmaken')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Voeg nieuw actiepunt toe</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('actionpoints.index') }}"> Terug</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('actionpoints.store') }}" method="POST">
            @csrf
            <div class="col-sm-6">
                <div class="row">
                    <div class="mb-1">
                        <label for="deadline" class="form-label">Titel</label>
                        <input type="datetime-local" id="deadline" name="deadline" class="form-control">
                    </div>
                    <div class="mb-1">
                        <label for="title" class="form-label">Titel</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Titel">
                    </div>
                    <div class="mb-1">
                        <label for="description" class="form-label">Beschrijving</label>
                        <input type="text" id="description" name="description" required class="form-control"
                               placeholder="Omschrijving">
                    </div>
                    <div class="mb-1">
                        <label for="ReminderDate" class="form-label">Herinneringsdatum</label>
                        <input type="datetime-local" id="reminderDate" name="ReminderDate" class="form-control">
                    </div>

                    <div class="mb-1">
                        <p class="form-label">Selecteer docenten</p>
                        <div class="d-flex flex-column">
                            @foreach($teachers as $teacher)
                                <label class="radio-inline"><input type="checkbox" name="assigned[]" value="{{$teacher}}">{{$teacher}}</label>
                            @endforeach
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Toevoegen">
                </div>
            </div>
        </form>
    </div>
