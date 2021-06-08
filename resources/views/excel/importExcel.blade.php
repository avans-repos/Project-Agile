@extends('layouts.app')

@section('title','Excel importeren')

@section('content')
  <main role="main" class="container mt-5">
    <div class="row col-sm-6">
      <fieldset class="mb-3">
        <legend>Contactpersonen importeren</legend>
        <p>Hieronder kunt u doormiddel van een .xslx bestand contactpersonen importeren in het systeem.</p>
        <form action="{{ route('excel.importFile') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-sm-6 mb-3">
            <input type="file" name="file" class="form-control">
          </div>
          <button class="btn btn-primary">Importeer Excel bestand</button>
        </form>
      </fieldset>
    </div>
  </main>
@stop
