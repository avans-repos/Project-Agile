@if($formAction == "update")
    <form action="{{route('notes.update', ['note' => $note])}}" method="POST">
    @method('PATCH')
@else
    <form action="{{route('notes.insert', ['contact' => $contact])}}" method="POST">
@endif
    @csrf
    <fieldset class="mb-3">
      <div class="mb-1">
        <div class="col">
          <label for="description" class="form-label">Notitie *</label>
          <textarea name="description"
                    class="form-control"
                    id="description" placeholder="Notitie hier" rows="5"
                    required>{{old('description',$note->description)}}</textarea>
        </div>
      </div>
    </fieldset>
      <div class="mb-1">
        <div class="col">
          <label for="reminder" class="form-label">
            <input type="checkbox" name="reminder" value="1" id="reminder" {{(old("reminder")) ? (old("reminder") == 0) ? null : 'checked' : 'checked'}}> Herinnering volgend contactmoment
          </label>
        </div>
      </div>
    <fieldset id="reminderFormSection" class="mb-3">
      <legend>Herinnering voor volgend contactmoment</legend>
      <div class="mb-1">
        <div class="col">
          <label for="reminderdate" class="form-label">Datum *</label>
          <input type="date" name="reminderdate" id="reminderdate" value="{{old('reminderdate',($notification != null) ? $notification->data['reminderdate'] : Carbon\Carbon::today()->addDays(1)->format('Y-m-d'))}}">
        </div>
      </div>
      <div class="mb-1">
        <div class="col">
          <label for="reminderDescription" class="form-label">Omschrijving</label>
          <textarea name="reminderDescription"
                    class="form-control"
                    id="reminderDescription" placeholder="Optionele omschrijving voor de herinnering." rows="5"
                    >{{old('reminderDescription',($notification != null) ? $notification->data['description'] : null)}}</textarea>
        </div>
      </div>
    </fieldset>
    <input class="btn btn-primary" type="submit" value="Notitie {{$actionViewName}}">
  </form>
  <script>
    var div = document.getElementById("reminderFormSection");
    var checkbox = document.getElementById("reminder");

    if(checkbox.checked) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }

    checkbox.addEventListener("change", function(){
      if(this.checked) {
        div.style.display = "block";
      } else {
        div.style.display = "none";
      }
    });
  </script>
