@extends('layouts.layout')

@section('title','Actiepunten')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="display-3">Mijn Actiepunten:</h1>
        <table class="table table-striped">
          <thead>
          <tr>
            <td>Deadline</td>
            <td>Titel</td>
            <td>Omschrijving</td>
            <td>Afgerond</td>
            <td>Reminderdatum</td>
            <td>Toegekend door</td>
          </tr>
          </thead>
          <tbody>
          @foreach($actionPoints as $actionPoint)
            <tr>
              <td>{{$actionPoint->deadline}}</td>
              <td>{{$actionPoint->title}}</td>
              <td>{{$actionPoint->description}}</td>
              <td>{{$actionPoint->finished}}</td>
              <td>{{$actionPoint->reminderdate}}</td>
              <td>{{$actionPoint->creator}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
