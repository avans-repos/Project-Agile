<form action="{{route('project.'.$formAction, ['project' => $project])}}" method="POST">
  @csrf
  @if($formAction == "update")
    @method('PATCH')
  @endif
  <fieldset class="mb-3">
    <legend>Algemene informatie:</legend>
    <div>
      <div class="mb-1">
        <label for="name" class="form-label">Projectnaam</label>
        <input name="name" value="{{old('name',$project->name)}}" type="text"
               class="form-control"
               id="name" placeholder="" maxlength="45" required>

      </div>
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="description" class="form-label">Omschrijving</label>
        <input name="description" value="{{old('description',$project->description)}}" type="text"
               class="form-control"
               id="description" placeholder="" maxlength="255" required>
      </div>
      <div class="col">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="datetime-local" id="deadline" value="{{old('deadline',isset($project->deadline) ? date('Y-m-d\TH:i', strtotime($project->deadline)) : null)}}" required name="deadline" class="form-control">

      </div>
      <div class="col">
        @error('deadline')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="notes" class="form-label">Notities</label>
        <textarea name="notes"
               class="form-control"
               id="notes" placeholder="notities" step="1">{{old('notes',$project->notes)}}</textarea>
      </div>
      <div class="col">
        @error('notes')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Project {{$formActionViewName}}">
</form>

