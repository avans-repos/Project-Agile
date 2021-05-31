<form action="{{route('company.'.$formAction, ['company' => $company])}}" method="POST">
  @csrf
  @if($formAction == 'update')
    @method('PATCH')
  @endif
  <fieldset class="mb-3">
    <legend>Algemene informatie:</legend>
    <div>
      <div class="mb-1">
        <label for="name" class="form-label">Bedrijfsnaam *</label>
        <input name="name" value="{{old('name',$company->name)}}" type="text"
               class="form-control"
               id="name" placeholder="Avans" maxlength="50" required>

      </div>
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="phonenumber" class="form-label">Telefoonnummer *</label>
        <input name="phonenumber" value="{{old('phonenumber',$company->phonenumber)}}" type="tel"
               class="form-control"
               id="phonenumber" placeholder="06 - 12345678" maxlength="15"
               data-bs-toggle="tooltip" data-bs-placement="right" title="Een telefoonnummer kan zowel in het +31... formaat als het 06-... formaat, een max van 15 tekens">

      </div>
      <div class="col">
        @error('phonenumber')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="email" class="form-label">E-mail *</label>
        <input name="email" value="{{old('email',$company->email)}}" type="tel"
               class="form-control"
               id="email" placeholder="email@domain.com" maxlength="320" required>

      </div>
      <div class="col">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="size" class="form-label">Aantal medewerkers</label>
        <input name="size" value="{{old('size',$company->size)}}" type="number"
               class="form-control"
               id="size" placeholder="12" min="0" maxlength="11" step="1">

      </div>
      <div class="col">
        @error('size')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="website" class="form-label">Website</label>
        <input name="website" value="{{old('website',$company->website)}}" type="text"
               class="form-control"
               id="website" placeholder="bedrijfsnaam.nl" maxlength="255">

      </div>
      <div class="col">
        @error('website')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="note" class="form-label">Notitie</label>
        <textarea placeholder="Een kleine notitie over het bedrijf." name="note" rows="5" class="form-control" id="note">{{old('note',$company->note)}}</textarea>
      </div>
      <div class="col">
        @error('note')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>
  <fieldset class="mb-3">
    <legend>Bezoekadres</legend>
    <div>
      <div class="mb-1">
        <label for="streetname1" class="form-label">Straatnaam *</label>
        <input name="streetname1" value="{{old('streetname1',$address1->streetname)}}" type="text"
               class="form-control"
               id="streetname1"
               placeholder="Sintjanstraat" maxlength="100" required>

      </div>

      <div class="col">
        @error('streetname1')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <div class="mb-1 row d-sm-flex">
        <div class="col-sm-4">
          <label for="number1" class="form-label">Huisnummer *</label>
          <input name="number1" value="{{old('number1',$address1->number)}}" type="number"
                 class="form-control"
                 id="number1" placeholder="123" maxlength="11" min="0" required>

        </div>
        <div class="col-sm-4">
          <label for="addition1" class="form-label">Toevoeging</label>
          <input name="addition1" value="{{old('addition1',$address1->addition)}}" type="text"
                 class="form-control"
                 id="addition1" placeholder="123" maxlength="5">

        </div>
      </div>
      <div class="col">
        @error('number1')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('addition1')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <div class="mb-1 row d-sm-flex">
        <div class="col-sm-6">
          <label for="zipcode1" class="form-label">Postcode *</label>
          <input name="zipcode1" value="{{old('zipcode1',$address1->zipcode)}}" type="text"
                 class="form-control"
                 id="zipcode1" placeholder="1234 AB" maxlength="10" required
                 data-bs-toggle="tooltip" data-bs-placement="right" title="Een postcode met 4 cijfers, een spatie en 2 hoofdletters">

        </div>
        <div class="col-sm-6">
          <label for="city1" class="form-label">Plaatsnaam *</label>
          <input name="city1" value="{{old('city1',$address1->city)}}" type="text"
                 class="form-control"
                 id="city1" placeholder="Amsterdam" maxlength="100" required>

        </div>
      </div>
      <div class="col">
        @error('zipcode1')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('city1')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <label for="address_same" class="form-label">
      <input type='hidden' value='1' name='address_same'>
      <input type="checkbox" name="address_same" value="0" id="address_same" {{($address2->id == $address1->id && old('address_same') == 0) ? 'checked' : null}}> Postadres is hetzelfde als het bezoekadres
    </label>
    <input name="country1" type="hidden" value="Nederland">
  </fieldset>
  <fieldset class="mb-3" id="mailing_address">
    <legend>Postadres</legend>
    <div>
      <div class="mb-1">
        <label for="streetname2" class="form-label">Straatnaam *</label>
        <input name="streetname2" value="{{old('streetname2',$address2->streetname)}}" type="text"
               class="form-control"
               id="streetname2"
               placeholder="Sintjanstraat" maxlength="100">

      </div>

      <div class="col">
        @error('streetname2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <div class="mb-1 row d-sm-flex">
        <div class="col-sm-4">
          <label for="number2" class="form-label">Huisnummer *</label>
          <input name="number2" value="{{old('number2',$address2->number)}}" type="number"
                 class="form-control"
                 id="number2" placeholder="123" maxlength="11" min="0">

        </div>
        <div class="col-sm-4">
          <label for="addition2" class="form-label">Toevoeging</label>
          <input name="addition2" value="{{old('addition2',$address2->addition)}}" type="text"
                 class="form-control"
                 id="addition2" placeholder="123" maxlength="5">

        </div>
      </div>
      <div class="col">
        @error('number2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('addition2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <div class="mb-1 row d-sm-flex">
        <div class="col-sm-6">
          <label for="zipcode2" class="form-label">Postcode *</label>
          <input name="zipcode2" value="{{old('zipcode2',$address2->zipcode)}}" type="text"
                 class="form-control"
                 id="zipcode2" placeholder="1234 AB" maxlength="10">

        </div>
        <div class="col-sm-6">
          <label for="city2" class="form-label">Plaatsnaam *</label>
          <input name="city2" value="{{old('city2',$address2->city)}}" type="text"
                 class="form-control"
                 id="city2" placeholder="Amsterdam" maxlength="100">

        </div>
      </div>
      <div class="col">
        @error('zipcode2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('city2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <input name="country2" type="hidden" value="Nederland">
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Bedrijf {{$formActionViewName}}">
</form>
<script>
  var div = document.getElementById("mailing_address");
  var checkbox = document.getElementById("address_same");
  if(checkbox.checked) {
    div.style.display = "none";
  } else {
    div.style.display = "block";
  }
  checkbox.addEventListener("change", function(){
    if(this.checked) {
      div.style.display = "none";
    } else {
      div.style.display = "block";
    }
  });
</script>
