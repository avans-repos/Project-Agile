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
    <div class="mb-1">
      <p class="form-label">Selecteer docenten</p>

      <div class="d-flex flex-column">
        @foreach($teachers as $teacher)
          <label class="radio-inline">
            <input
              {{ (is_array(old("assigned",$assigned))) ?
                      (in_array($teacher->id, old("assigned", $assigned))) ? 'checked' : null
                   : null
              }} type="checkbox" name="assigned[]" value="{{$teacher->id}}" ><span class="ms-2">{{$teacher->name}}</span>
          </label>
        @endforeach
      </div>
    </div>
    <div class="mb-1">
      <p class="form-label">Selecteer studenten</p>

      <div class="d-flex flex-column">
        @foreach($students as $student)
          <label class="radio-inline">
            <input
              {{ (is_array(old("assigned",$assigned))) ?
                      (in_array($student->id, old("assigned", $assigned))) ? 'checked' : null
                   : null
              }} type="checkbox" name="assigned[]" value="{{$student->id}}" ><span class="ms-2">{{$student->name}}</span>
          </label>
        @endforeach
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Projectgroep {{$formActionViewName}}">
</form>
