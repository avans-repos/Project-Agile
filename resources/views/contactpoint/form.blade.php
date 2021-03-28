<form action="{{route('contactpoint.'.$formAction, ['contactpoint' => $contactpoint])}}" method="POST">
    @csrf
    @if($formAction == "update")
      @method('PATCH')
    @endif

  <input name="contactid" value="{{$contact->id}}" type="hidden">
  <div class="mb-1">
    <div class="mb-1 row d-sm-flex">
      <div class="col-sm-12">
        <label for="dateOfContact" class="form-label">Datum *</label>
        <input name="dateOfContact" value="{{date('Y-m-d\TH:i', strtotime((old('dateOfContact',$contactpoint->dateOfContact))))}}" type="datetime-local"
               class="form-control"
               id="dateOfContact" required>
        <label for="description" class="form-label">Omschrijving *</label>
        <input name="description" value="{{old('description',$contactpoint->description)}}" type="text"
               class="form-control"
               id="description"
               placeholder="omschrijving" maxlength="255" required>

      </div>
    </div>
    <div class="col">
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <input class="btn btn-primary" type="submit" value="Contactpoint {{$formActionViewName}}">
</form>
