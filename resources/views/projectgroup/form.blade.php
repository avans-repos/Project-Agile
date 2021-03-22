<form action="{{route('projectgroup.'.$formAction, ['projectgroup' => $projectgroup])}}" method="POST">
  @csrf
  @if($formAction == "update")
    @method('PATCH')
  @endif
  <fieldset class="mb-3">
    <legend>Algemene informatie:</legend>
    <div class="mb-1">
      <div class="col">
        <label for="name" class="form-label">Naam *</label>
        <input name="name" value="{{old('name',$projectgroup->name)}}" type="text"
               class="form-control"
               id="name" placeholder="Projectgroup 1" maxlength="100" required>

      </div>
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Projectgroep {{$formActionViewName}}">
</form>
