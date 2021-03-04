@extends('layout')

@section('content')

    <div class="d-flex align-center mt-5 justify-content-center">
        <div class="col-sm-3 text-center d-flex flex-column">
            <h1>Login</h1>
            <form method="POST" action="{{url("login")}}">
                @csrf
                <div class="form-group mb-2">
                    <label for="selectUser">Selecteer gebruiker</label>
                    <select required name="userSelect" class="form-control" id="selectUser">
                        <option value="1">Docent 1</option>
                        <option value="2">Docent 2</option>
                        <option value="3">Docent 3</option>
                        <option value="4">Docent 4</option>
                        <option value="5">Docent 5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
