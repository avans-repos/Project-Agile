<form action="{{route('notes.insert', ['contact' => $contact])}}" method="POST">
  @csrf
  @if($formAction == "update")
    @method('PATCH')
  @endif
  <fieldset class="mb-3">
    <div class="mb-1">
      <div class="col">
        <label for="description" class="form-label">Notitie *</label>
        <textarea  name="description" value="{{old('description',$note->description)}}" type="text"
               class="form-control"
                   id="description" placeholder="Notitie hier" rows="5" required></textarea>

      </div>
      <div class="col">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Notitie aanmaken">
</form>
