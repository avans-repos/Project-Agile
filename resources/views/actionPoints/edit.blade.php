<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Actiepunt aanpassen</h2>
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

<form action="{{ route('actionpoints.update',$actionpoint->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Deadline:</strong>
                <input type="datetime-local" name="Deadline" value="{{ $actionpoint->Deadline }}" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Titel:</strong>
                <input type="text" name="Title" value="{{ $actionpoint->Title }}" class="form-control" placeholder="Titel">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Omschrijving:</strong>
                <input type="text" name="Description" value="{{ $actionpoint->Description }}" class="form-control" placeholder="Omschrijving">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Aanpassen</button>
        </div>
    </div>

</form>
