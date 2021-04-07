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
        <textarea name="description"  type="text"
               class="form-control"
                   id="description" placeholder="Notitie hier" rows="5" required>{{old('description',$note->description)}}</textarea>
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Notitie {{$actionViewName}}">
</form>
