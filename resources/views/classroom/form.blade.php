<form action="{{route('classroom.'.$formAction, ['classroom' => $classroom])}}" method="POST">
    @csrf
    @if($formAction == "update")
        @method('PATCH')
    @endif
    <fieldset class="mb-3">
        <div class="mb-1">
            <div class="mb-1 row d-sm-flex">
                <div class="col-sm-3">
                    <label for="name" class="form-label">Klasnaam *</label>
                    <input name="name" value="{{old('name',$classroom->name)}}" type="text"
                           class="form-control"
                           id="name"
                           placeholder="42IN4SOa" maxlength="10" required>

                </div>
                <div class="col-sm-9">
                    <label for="year" class="form-label">Schooljaar *</label>
                    <input name="year" value="{{old('year',$classroom->year)}}" type="number"
                           class="form-control"
                           id="year" placeholder="2020" maxlength="4" required>

                </div>
            </div>
            <div class="col">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('year')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </fieldset>

  <div class="mt-3 mb-3">
    <p class="btn btn-primary" onclick="AddContactType()">Contacttype toevoegen</p>
  </div>
    <input class="btn btn-primary" type="submit" value="Contact {{$formActionViewName}}">
</form>
