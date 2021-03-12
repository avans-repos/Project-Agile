@extends('layouts.layout')

@section('title','Actiepunt bekijken')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left">
                    <h2>Actiepunten:</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('actionpoints.index') }}">Terug</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deadline:</strong>
                    {{ $actionpoint->deadline }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Titel:</strong>
                    {{ $actionpoint->title }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Omschrijving:</strong>
                    {{ $actionpoint->description }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reminder datum:</strong>
                    {{ $actionpoint->reminderDate }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Toegekend door:</strong>
                    {{ $actionpoint->creator }}
                </div>
            </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Toegekend aan:</strong>
              @foreach($assigned as $teacher)
                {{$teacher->user}}
              @endforeach
            </div>
          </div>
        </div>
    </div>
