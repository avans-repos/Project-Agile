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
                </tr>
            </thead>
            <tbody>
                @foreach($actionPoints as $actionPoint)
                    <tr>
                        <td>{{$actionPoint->id}}</td>
                        <td>{{$actionPoint->Deadline}}</td>
                        <td>{{$actionPoint->Title}}</td>
                        <td>{{$actionPoint->Description}}</td>
                        <td>{{$actionPoint->Finished}}</td>
                        <td>{{$actionPoint->ReminderDate}}</td>
                        <td>{{$actionPoint->Creator}}</td>
                        <td>
                            <form action="{{ route('actionpoints.destroy', $actionPoint->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('actionpoints.show', $actionPoint->id) }}">Details</a>
                                <a class="btn btn-primary" href="{{ route('actionpoints.edit',$actionPoint->id) }}">Aanpassen</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit class=btn btn-danger">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
