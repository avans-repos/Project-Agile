<form action="{{route('mailformat.sendMail')}}" method="POST">
  @csrf
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
        <div class="mt-3">
          <div class="d-flex align-items-end justify-content-between mb-1">
            <label for="body" class="form-label mb-1">Inhoud</label>
            <p class="btn-secondary btn btn-sm" data-bs-target="#taghelp" data-bs-toggle="collapse">Welke tags kan ik
              gebruiken?</p>
          </div>
          <div class="collapse" id="taghelp">
            <div class="card card-body p-3 mb-1">
              <ul class="list-group list-group my-2">
                @foreach($tags as $tag=>$description)
                  <li class="list-group-item d-flex"><h5 class="mb-1 text-primary col-sm-4">{{'{'.$tag.'}'}}</h5>
                    <small class="col-sm-8">{{$description}}</small></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <textarea name="body"
                  class="form-control"
                  id="body" placeholder="Inhoud van de mail." rows="10"
        >{{old('body',$mailformat->body)}}</textarea>
      </div>
      <div class="col">
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Versturen">
</form>
