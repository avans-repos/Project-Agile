<div>Contactgeschiedenis</div>

<div class="align-self-center">
  <a class="btn btn-primary" href="{{ route('contactpoint.create',$contact->id) }}">Nieuw contactmoment toevoegen</a>
</div>
<table class="table table-striped mt-3">
  <thead>
  <tr>
    <td>Datum</td>
    <td>Omschrijving</td>
  </tr>
  </thead>
  <tbody>
  @foreach($contactpoints as $contactpoint)
    <tr>
      <td>{{$contactpoint->dateOfContact}}</td>
      <td style="word-break:break-all;">{{$contactpoint->description}}</td>
      <td>
        <div class="d-md-flex align-items-center">
          <div class="m-1 d-flex justify-content-center align-items-center">
            <div>
              <a class="btn btn-secondary"
                 href="{{route('contactpoint.edit',$contactpoint->id, $contact)}}">Aanpassen</a>
            </div>
          </div>
          <div class="m-1">
            <form method="POST" class="m-0" action="{{ route('contactpoint.destroy', $contactpoint->id) }}">
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
