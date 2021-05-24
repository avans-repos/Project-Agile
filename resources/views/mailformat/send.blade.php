@extends('layouts.app')

@section('content')
  <div class="container mb-5 mt-5">
<form action="{{route('mailformat.sendMail')}}" method="POST">
  @csrf
  <fieldset class="mb-3">
    <legend>Mail Template</legend>
    <div class="row">
      @foreach($mailformats as $mail)
      <div class="col-sm-6 mb-2">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><strong>{{$mail->name}}</strong></h5>
            <p class="card-text">{{$mail->body}}</p>
            <a href="#" class="btn btn-primary mt-3" onclick="useTemplate(`{{$mail->name}}`, `{{$mail->body}}`)">Kiezen</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </fieldset>

  <fieldset class="mb-3">
    <div class="col">
      <label for="name" class="form-label">Naam *</label>
      <input name="name" value="{{old('name',$mail->name)}}" type="text"
             class="form-control"
             id="mail-title"
             placeholder="Titel van standaardtekst" maxlength="45" required>

    </div>
    <div class="mb-1">
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
                @foreach($tags as $tag)
                  <li class="list-group-item d-flex"><h5 class="mb-1 text-primary col-sm-4 cursor-pointer" onclick="insertAtCaret(`{{'{'.$tag->tag.'}'}}`)">{{'{'.$tag->tag.'}'}}</h5>
                    <small class="col-sm-8">{{$tag->description}}</small></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <textarea name="body"
                  class="form-control"
                  id="mail-body" placeholder="Inhoud van de mail." rows="10"
        >{{old('body',$mail->body)}}</textarea>
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
  </div>

  <script>

    function insertAtCaret(text) {
      let txtarea = document.getElementById('mail-body');

      let scrollPos = txtarea.scrollTop;
      let caretPos = txtarea.selectionStart;

      let front = (txtarea.value).substring(0, caretPos);
      let back = (txtarea.value).substring(txtarea.selectionEnd, txtarea.value.length);
      txtarea.value = front + text + back;
      caretPos = caretPos + text.length;
      txtarea.selectionStart = caretPos;
      txtarea.selectionEnd = caretPos;
      txtarea.focus();
      txtarea.scrollTop = scrollPos;
    }

    function useTemplate(title, body){
      document.getElementById('mail-title').value = title;
      document.getElementById('mail-body').value = body;
    }
  </script>
@endsection
