@extends('layouts.app')

@section('content')
  <div class="container mb-5 mt-5">
<form action="{{route('mailformat.sendMail')}}" id="sendMailForm" method="POST">
  @csrf
  <fieldset class="mb-3">
    <legend  class="mb-3">E-mail Template</legend>
    <div class="mb-1">
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <table class="table-layout-fixed table table-striped">

      <thead>
      <tr>
        <td>Naam</td>
        <td>Inhoud</td>
        <td>Acties</td>
      </tr>
      </thead>
      <tbody>
      @foreach($mailformats as $mailFormat)
        <tr>
          <td><p class="text-nowrap overflow-hidden text-truncate">{{$mailFormat->name}}</p></td>
          <td>
            <div class="collapse show multi-collapse-{{$mailFormat->id}}" id="smalltext-{{$mailFormat->id}}">
              <p class="text-nowrap overflow-hidden text-truncate">{{$mailFormat->body}}</p>
            </div>
            <div class="collapse multi-collapse-{{$mailFormat->id}}" id="fulltext-{{$mailFormat->id}}">
              <div class="card card-body">
                <p>{!! nl2br(e($mailFormat->body))!!}</p>
              </div>
            </div>
          </td>
          <td>
            <div class="d-md-flex align-items-center">
              <div class="m-1 d-flex justify-content-center align-items-center">
                <div>
                  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse-{{$mailFormat->id}}" aria-expanded="false" aria-controls="smalltext-{{$mailFormat->id}} fulltext-{{$mailFormat->id}}">Volledige inhoud</button>
                </div>
              </div>
              <div class="m-1 d-flex justify-content-center align-items-center">
                <div>
                  <a href="#" class="btn btn-secondary" onclick="useTemplate(`{{$mailFormat->name}}`, `{{$mailFormat->body}}`)">Kiezen</a>
                </div>
              </div>
            </div>

          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </fieldset>

  <fieldset class="mb-3">
    <legend class="mb-3">Te verzenden E-mail</legend>
    <div class="col">
      <label for="name" class="form-label">Titel *</label>
      <input name="name" value="{{old('name')}}" type="text"
             class="form-control"
             id="mail-title"
             placeholder="Titel van standaardtekst" maxlength="45" required>

    </div>
    <div class="mb-1">
      <div class="col">
        <div class="mt-3">
          <div class="d-flex align-items-end justify-content-between mb-1">
            <label for="body" class="form-label mb-1">Inhoud *</label>
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
                  id="mail-body" placeholder="Inhoud van de mail." rows="10" required
        >{{old('body')}}</textarea>
      </div>
    </div>
    <div class="col">
      @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </fieldset>

  <fieldset class="mt-5">
    <legend>Toegevoegde contacten</legend>
    <ul class="list-group mt-2 mb-2 scroll max-h-96" id="selectedContacts">
    </ul>
    <div class="col">
      @error('contact')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </fieldset>

  <fieldset class="mt-5">
    <legend>Contacten toevoegen</legend>
    <input type="text" id="filterContactInput" class="rounded" onkeyup="filterContacts()" placeholder="Zoek naar contacten" title="Typ een naam">
    <ul class="list-group mt-2 mb-2 scroll max-h-96" id="contactList">
      @foreach($contacts as $contact)
        <li class="list-group-item list-group-item-action" id="{{$contact->id}}">
          <div class="container">
            <div class="row">
              <div class="col">
                <span>{{$contact->getName()}}</span>
              </div>
                <div class="col">
                <span>{{$contact->email}}</span>
                </div>
              <div class="col-md-auto"></div>
              <div class="col col-lg-2">
                <a class="col-sm btn btn-primary" onclick="addContact({{$contact->id}}, `{{e($contact->getName())}}`, `{{e($contact->email)}}`)">Toevoegen</a>
              </div>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </fieldset>

  <fieldset class="mb-3">
    <legend>Projecten en projectgroepen toevoegen</legend>
    <div class="accordion" id="mail-project-accordion">
    @foreach($projects as $i=>$project)
        <div class="accordion-item">
          <h2 class="accordion-header mail-accordion">
            <button type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#mail-project-accordion .accordion-item:nth-child({{$i + 1}}) .accordion-collapse"
                    aria-expanded="false">
              {{$project->name}}
            </button>

            <button type="button"
                    class="col col-lg-3 btn btn-primary"
                    onclick="addContacts(
                    {{
                      // Get all project groups and map each project group's contact
                      $project->projectGroups()->get()->map(
                        function($projectGroup) {
                          return  $projectGroup->contacts()->get()->map(function($contact) {
                            // Map each contact to the expected values (this returns an array)
                            return [
                              'id' => $contact->id,
                              'name' => $contact->getName(),
                              'email' => $contact->email
                            ];
                          });
                      // Flatten the array as it would normally return contacts in one array per project (i.e. a 2 dimensional array)
                      })->flatten(1)
                    }})">
              Project toevoegen
            </button>
          </h2>
          <div class="accordion-collapse collapse" data-bs-parent="#mail-project-accordion">
            <div class="accordion-body">
                @foreach($project->projectgroups()->get() as $projectGroup)
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col fw-bold">
                        <span>{{$projectGroup->name}}</span>
                      </div>
                      <div class="col-md-auto"></div>
                      <div class="col col-lg-3">
                        <button type="button"
                                class="btn btn-outline-secondary float-right"
                                onclick="addContacts(
                                  {{
                                    $projectGroup->contacts()->get()->map(function($contact) {
                                        return [
                                            'id' => $contact->id,
                                            'name' => $contact->getName(),
                                            'email' => $contact->email
                                        ];
                                    })
                                  }})">
                          Projectgroep toevoegen
                        </button>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    @foreach($projectGroup->contacts()->get() as $contact)
                      <div class="row">
                        <div class="col">
                          <span>{{$contact->getName()}}</span>
                        </div>
                        <div class="col">
                          <span>{{$contact->email}}</span>
                        </div>
                        <div class="col-md-auto"></div>
                        <div class="col col-lg-3">
                          <button type="button" class="btn btn-outline-secondary float-right" onclick="addContact({{$contact->id}}, '{{$contact->getName()}}', '{{$contact->email}}')">Contact toevoegen</button>
                        </div>
                      </div>
                      <br>
                    @endforeach
                  </li>
                </ul>
                <br>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </fieldset>

    <a class="btn btn-primary float-right mb-3" type="submit" href="#" onclick="showConfirm()" >Versturen</a>
    </form>
  </div>



  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div id="mailContactConfirmationToast" class="toast hide bg-white" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">De contacten zijn toegevoegd</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <script>

      function showConfirm(){
        let recipients = '';
        let recipientsElements = document.querySelectorAll('[id=recipientName]');
          if(recipientsElements.length === 0){
            recipients = 'Niemand';
          }
          else {
            for (let i = 0; i < recipientsElements.length; i++) {
              recipients += recipientsElements[i].innerText;
              if (i < recipientsElements.length - 1) {
                recipients += ', ';
              }
            }
          }
        sendEmailConfirm('sendMailForm', recipients);
      }

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

    function addContacts(contacts) {
      contacts.forEach(contact => addContact(contact.id, contact.name, contact.email));

      const toastElement = new bootstrap.Toast(document.getElementById('mailContactConfirmationToast'));
      toastElement.show();
    }

    function addContact(contactId, contactName, email){
      // Check if contact has already been added and return if true
      const selectedIds = [...document.querySelectorAll('#selectedContacts input')].map(elem => elem.value - 0);
      if(selectedIds.includes(contactId)) return;

      let contactTemplate = `
              <li class="list-group-item list-group-item-action" id="selectedContact-${contactId}">
            <div class="container">
              <div class="row">
                <div class="col">
                  <span id='recipientName'>${contactName}</span>
                </div>
                <div class="col">
               <span id='recipientMail'>${email}</span>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-2">
                  <a class="col-sm btn btn-danger" onclick="deleteContact(${contactId})">Verwijderen</a>
                  <input name="contact[]" value="${contactId}" hidden>
                </div>
              </div>
            </div>
          </li>
          `;

      const contactDiv = document.getElementById('selectedContacts');
        contactDiv.innerHTML += contactTemplate;

      filterContacts();
    }

    function deleteContact(contactId){
      document.getElementById(`selectedContact-${contactId}`).remove();
      filterContacts();
    }

    function filterContacts() {
      let input, filter, ul, li, a, i, txtValue;
      input = document.getElementById("filterContactInput");
      filter = input.value.toUpperCase();
      ul = document.getElementById("contactList");
      li = ul.getElementsByTagName("li");
      for (i = 0; i < li.length; i++) {
        txtValue = li[i].innerText;
        let isSelected = document.getElementById(`selectedContact-${li[i].id}`) != null;
        if (txtValue.toUpperCase().indexOf(filter) > -1 && !isSelected) {
          li[i].style.display = "";
        } else {
          li[i].style.display = "none";
        }
      }
    }
  </script>
@endsection
