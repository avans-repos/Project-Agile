@extends('layouts.layout')

@section('title','Actiepunten')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="display-3">Actiepunten</h1>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('actionpoints.create') }}">Nieuwe actiepunt aanmaken</a>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Deadline</td>
                        <td>Titel</td>
                        <td>Omschrijving</td>
                        <td>Afgerond</td>
                        <td>Reminderdatum</td>
                        <td>Toegekend door</td>
                        <td>Acties</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($actionPoints as $actionPoint)
                        <tr>
                            <td>{{$actionPoint->id}}</td>
                            <td>{{$actionPoint->deadline}}</td>
                            <td>{{$actionPoint->title}}</td>
                            <td>{{$actionPoint->description}}</td>
                            <td>{{$actionPoint->finished}}</td>
                            <td>{{$actionPoint->reminderdate}}</td>
                            <td>{{$actionPoint->creator}}</td>
                            <td>
                                <div class="d-md-flex align-items-center">
                                    <div class="m-1 d-flex justify-content-center align-items-center">
                                        <div>
                                            <a class="btn btn-primary" href="{{route('actionpoints.show',$actionPoint)}}">Details</a>
                                        </div>
                                    </div>
                                    <div class="m-1 d-flex justify-content-center align-items-center">
                                        <div>
                                            <a class="btn btn-secondary"
                                               href="{{route('actionpoints.edit',$actionPoint)}}">Aanpassen</a>
                                        </div>
                                    </div>
                                    <div class="m-1">
                                        <form method="POST" class="m-0" action="{{ route('actionpoints.destroy', $actionPoint) }}">
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
    </div>
