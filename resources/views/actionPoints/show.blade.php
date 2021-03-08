<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Actiepunten:</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('actionpoints.index') }}"> Terug</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Deadline:</strong>
            {{ $actionpoint->Deadline }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Titel:</strong>
            {{ $actionpoint->Title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Omschrijving:</strong>
            {{ $actionpoint->Description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Reminder datum:</strong>
            {{ $actionpoint->ReminderDate }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Toegekend door:</strong>
            {{ $actionpoint->Creator }}
        </div>
    </div>

</div>
