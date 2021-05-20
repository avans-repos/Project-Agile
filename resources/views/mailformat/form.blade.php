<form action="{{route('mailformat.'.$formAction, ['mailformat' => $mailformat])}}" method="POST">
  @csrf
  @if($formAction == 'update')
    @method('PATCH')
  @endif
  <fieldset class="mb-3">
    <div class="mb-1">
      <div class="col">
        <label for="name" class="form-label">Naam *</label>
        <input name="name" value="{{old('name',$mailformat->name)}}" type="text"
               class="form-control"
               id="name"
               placeholder="Titel van standaardtekst" maxlength="45" required>

      </div>
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <div class="col">
        <label for="body" class="form-label">Inhoud</label>
        <textarea name="body"
                  class="form-control"
                  id="body" placeholder="Inhoud van de mail." rows="5"
        >{{old('body',$mailformat->body)}}</textarea>
      </div>
      <div class="col">
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Standaardtekst {{$formActionViewName}}">
</form>
