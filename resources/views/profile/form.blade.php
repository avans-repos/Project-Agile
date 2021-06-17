<form action="{{route('profile.' . $action, ['user' => $user])}}" method="POST">
  @csrf
  <fieldset class="mb-3">
    <legend>Persoonlijke informatie:</legend>
    <div class="mb-1">
      <div class="mb-1 row d-sm-flex">
        <div class="col-sm-3">
          <label for="initials" class="form-label">Naam</label>
          <input name="initials" value="{{$user->name}}" type="text"
                 class="form-control"
                 placeholder="JDV" maxlength="10" disabled>
        </div>
      </div>
    </div>
    <div class="mb-1">
      <div class="mb-1 row d-sm-flex">
        <div class="col-sm-4">
          <label for="email" class="form-label">E-Mail</label>
          <input name="email" value="{{old('email',$user->email)}}" type="text"
                 class="form-control"
                 id="email" placeholder="avans@example.com" maxlength="255" >

        </div>
      </div>
      <div class="col">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="col-sm-8">
      <label for="password" class="form-label">Wachtwoord</label>
      <input name="password" value="{{old('password')}}" type="password"
             class="form-control" id="password"
             placeholder="*********" maxlength="255" >
    </div>
    <div class="col-sm-8">
      <label for="confirm_password" class="form-label">Wachtwoord Bevestiging</label>
      <input name="confirm_password" value="{{old('confirm_password')}}" type="password"
             class="form-control" id="confirm_password"
             placeholder="*********" maxlength="255" >
    </div>
    <div class="col">
      @error('password')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      @error('passwordconfirm')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Profiel {{$actionViewName}}">
</form>
