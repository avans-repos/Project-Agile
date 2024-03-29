<form action="{{route('contact.'.$formAction, ['contact' => $contact, 'redirectUrl' => $redirectUrl])}}" method="POST">
    @csrf
    @if($formAction == 'update')
        @method('PATCH')
    @endif
    <fieldset class="mb-3">
        <legend>Persoonlijke informatie:</legend>
        <div class="mb-1">
            <div class="mb-1 row d-sm-flex">
                <div class="col-sm-3">
                    <label for="initials" class="form-label">Initialen</label>
                    <input name="initials" value="{{old('initials',$contact->initials)}}" type="text"
                           class="form-control"
                           id="initials"
                           placeholder="JDV" maxlength="10">

                </div>
                <div class="col-sm-9">
                    <label for="firstname" class="form-label">Voornaam *</label>
                    <input name="firstname" value="{{old('firstname',$contact->firstname)}}" type="text"
                           class="form-control"
                           id="firstname" placeholder="John" maxlength="50" required>

                </div>
            </div>
            <div class="col">
                @error('initials')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('firstname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <div class="mb-1 row d-sm-flex">
                <div class="col-sm-4">
                    <label for="insertion" class="form-label">Tussenvoegsel</label>
                    <input name="insertion" value="{{old('insertion',$contact->insertion)}}" type="text"
                           class="form-control"
                           id="insertion" placeholder="van der" maxlength="10">

                </div>
                <div class="col-sm-8">
                    <label for="lastname" class="form-label">Achternaam *</label>
                    <input name="lastname" value="{{old('lastname',$contact->lastname)}}" type="text"
                           class="form-control" id="lastname"
                           placeholder="Doe" maxlength="50" required>
                </div>
            </div>
            <div class="col">
                @error('insertion')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('lastname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <label for="gender" class="form-label">Geslacht</label>
            <select class="form-control" name="gender" id="gender">
                <option disabled selected>Selecter geslacht</option>
                @foreach ($genders as $gender)
                    <option
                        {{ ($gender->type == old('gender',$contact->gender) ? 'selected':'') }} value="{{ $gender->type }}">
                        {{ ucfirst(trans($gender->type)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            @error('gender')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </fieldset>
    <fieldset class="mb-3">
        <legend>Contactinformatie</legend>
        <div>
            <div class="mb-1">
                <label for="email" class="form-label">E-mail</label>
                <input name="email" value="{{old('email',$contact->email)}}" type="email" class="form-control"
                       id="email"
                       placeholder="JohnDoe@domain.com" maxlength="320">

            </div>
            <div class="col">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div>
            <div class="mb-1">
                <label for="phonenumber" class="form-label">Telefoonnummer</label>
                <input name="phonenumber" value="{{old('phonenumber',$contact->phonenumber)}}" type="tel"
                       class="form-control"
                       id="phonenumber" placeholder="06-12345678" maxlength="15"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Een telefoonnummer kan zowel in het +31... formaat als het 06-... formaat, een max van 15 tekens">

            </div>
            <div class="col">
                @error('phonenumber')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </fieldset>

  <fieldset class="mb-3">
    <legend>Adres</legend>
    <div>
      <div class="mb-1">
        <label for="streetname1" class="form-label">Straatnaam</label>
        <input name="streetname1" value="{{old('streetname1',$address->streetname)}}" type="text"
               class="form-control"
               id="streetname1"
               placeholder="Sintjanstraat" maxlength="100">

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
          <label for="number1" class="form-label">Huisnummer</label>
          <input name="number1" value="{{old('number1',$address->number)}}" type="number"
                 class="form-control"
                 id="number1" placeholder="123" maxlength="11" min="0">

        </div>
        <div class="col-sm-4">
          <label for="addition1" class="form-label">Toevoeging</label>
          <input name="addition1" value="{{old('addition1',$address->addition)}}" type="text"
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
          <label for="zipcode1" class="form-label">Postcode</label>
          <input name="zipcode1" value="{{old('zipcode1',$address->zipcode)}}" type="text"
                 class="form-control"
                 id="zipcode1" placeholder="1234 AB" maxlength="10"
                 data-bs-toggle="tooltip" data-bs-placement="right" title="Een postcode met 4 cijfers, een spatie en 2 hoofdletters">

        </div>
        <div class="col-sm-6">
          <label for="city1" class="form-label">Plaatsnaam</label>
          <input name="city1" value="{{old('city1',$address->city)}}" type="text"
                 class="form-control"
                 id="city1" placeholder="Amsterdam" maxlength="100">

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
    <input name="country1" type="hidden" value="Nederland">
  </fieldset>

  <fieldset class="mb-3">
    <legend>Contacttype per bedrijf</legend>
    <div id="companies">
      @if(count($contact->companies()->get()) == 0)
    <div id="company-1" class="mt-3.5">
    <div>
      <div class="mb-1">
        <label for="company" class="form-label">Bedrijf</label>
        <select class="form-control" name="company-1" id="companySelector-1">
          <option disabled selected>Selecteer Bedrijf</option>
          @foreach ($companies as $company)
            <option
              {{ ($company->name == old('type',$company->name) ? 'selected':'') }} value="{{ $company->name }}">
              {{ ucfirst(trans($company->name)) }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col">
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="contactType" class="form-label">Contactsoort</label>
        <select class="form-control" name="contacttype-1" id="contactTypeSelector-1">
          <option disabled selected>Selecteer contactsoort</option>
          @foreach ($contactTypes as $contactType)
            <option
              {{ ($contactType->name == old('type',$contact->type) ? 'selected':'') }} value="{{ $contactType->name }}">
              {{ ucfirst(trans($contactType->name)) }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col">
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    </div>
    </div>
    @endif
    @foreach($contact->companies()->get() as $contactcompany)
      <div id="company-{{$loop->index + 1}}" class="mt-3.5">
        <div>
          <div class="mb-1">
            <label for="company" class="form-label">Bedrijf</label>
            <select class="form-control" name="company-{{$loop->index + 1}}" id="companySelector-1">
              <option disabled selected>Selecteer Bedrijf</option>
              @foreach ($companies as $company)
                <option
                  {{ ($company->name == $contactcompany->company()->first()->name ? 'selected':'') }} value="{{ $company->name }}">
                  {{ ucfirst(trans($company->name)) }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col">
            @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div>
          <div class="mb-1">
            <label for="contactType" class="form-label">Contactsoort</label>
            <select class="form-control" name="contacttype-{{$loop->index + 1}}" id="contactTypeSelector-1">
              <option disabled selected>Selecteer contactsoort</option>
              @foreach ($contactTypes as $contactType)
                <option
                  {{ ($contactType->name == $contactcompany->contacttype ? 'selected':'') }} value="{{ $contactType->name }}">
                  {{ ucfirst(trans($contactType->name)) }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col">
            @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
    @endforeach
  </fieldset>
  <div class="mt-3 mb-3">
    <p class="btn btn-primary" onclick="AddContactType()">Contacttype toevoegen</p>
  </div>
    <input class="btn btn-primary" type="submit" value="Contact {{$formActionViewName}}">
</form>
