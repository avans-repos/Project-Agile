<form action="{{route('projectgroup.'.$formAction, ['projectgroup' => $projectgroup, 'redirectUrl' => $redirectUrl])}}"
      method="POST">
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
               id="name" placeholder="Projectgroep 1" maxlength="100" required>

      </div>
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-1">
      <label class="form-label">Selecteer docenten</label>

      <div class="d-flex flex-column">
        @foreach($teachers as $teacher)
          <label class="radio-inline"
                 data-bs-toggle="tooltip" data-bs-placement="left"
                 title="Druk op de checkbox om een docent te selecteren">
            <input data-teacher-id="{{$teacher->id}}"
                   {{ (is_array(old("assignedUsers",$assignedUsers))) ?
                           (in_array($teacher->id, old("assignedUsers", $assignedUsers))) ? 'checked' : null
                        : null
                   }} type="checkbox" name="assignedUsers[]" value="{{$teacher->id}}"><span
              class="ms-2">{{$teacher->name}}</span>
          </label>
        @endforeach
      </div>
    </div>

    <div class="mb-1">
      <label class="form-label">Selecteer studenten</label>

      <table class="table" id="student-table">
        <thead>
        <tr>
          <th>Selecteren</th>
          <th>Naam</th>
          <th>Klas</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
          <tr data-bs-toggle="tooltip" data-bs-placement="left"
              title="Druk op de checkbox om een student te selecteren">
            <td>
              <input data-student-id="{{$student->id}}"
                {{ (is_array(old("assignedUsers",$assignedUsers))) ?
                        (in_array($student->id, old("assignedUsers",$assignedUsers))) ? 'checked' : null
                     : null
                }} type="checkbox" name="assignedUsers[]" value="{{$student->id}}">
            </td>
            <td>{{$student->name}}</td>
            <td>{{$student->classroom}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    <fieldset>
      <legend>Contactpersonen</legend>
      <div class="row d-flex flex-column">
        <div id="addedContacts">
          <h3>Toegevoegd</h3>
          <ul class="list-group mt-2 mb-2" id="selectedContacts">
            @foreach($assignedContacts as $assignedContact)

              <li class="list-group-item list-group-item-action"
                 id="{{'selectedContact-'.$assignedContact->id}}">
                <div class="container">
                  <div class="d-flex justify-content-between">
                    <div class="d-inline-flex">
                      <span
                        id="addedContactName-{{$assignedContact->id}}">{{$assignedContact->getName()}}</span>
                    </div>
                    <div class="d-inline-flex">
                      <a class="col-sm btn btn-danger" onclick="deleteContact({{$assignedContact->id}})">Verwijderen</a>
                      <input name="contact[]" value="{{$assignedContact->id}}" hidden>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <h1 id="noAddedContactsFound">Geen contactpersonen gekoppeld.</h1>
          <div class="col">
            @error('Contact')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="mb-3">
          <h3>Toevoegen</h3>
          <input type="text" id="filterContactInput" onkeyup="filterContacts()"
                 placeholder="Zoek naar contactpersonen" title="Typ een naam">
          <ul class="list-group mt-2 mb-2 scroll max-h-screen" id="contactList">
            @foreach($newContacts as $newContact)
              <li class="list-group-item list-group-item-action" id="{{$newContact->id}}">
                <div class="container">
                  <div class="d-flex justify-content-between">
                    <div class="d-inline-flex">
                      <span>{{$newContact->getName()}}</span>
                    </div>
                    <div class="d-inline-flex">
                      <a class="col-sm btn btn-primary"
                         onclick="addContact({{$newContact->id}}, `{{e($newContact->getName())}}`)">Toevoegen</a>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <h1 id="noContactsFound">Geen contactpersonen om mee te koppelen.</h1>
        </div>
      </div>
    </fieldset>

    <fieldset>
      <a href="{{route('contact.create')}}" class="btn btn-secondary mb-3" onclick="saveToSessionStorage()">
        Nieuw contactpersoon aanmaken
      </a>

    </fieldset>

    <fieldset>
      <legend>Projecten</legend>
      <div class="row d-flex flex-column">
        <div id="addedProjects">
          <h3>Toegevoegd</h3>
          <ul class="list-group mt-2 mb-2" id="selectedProjects">
            @foreach($assignedProjects as $assignedProject)
              <li class="list-group-item list-group-item-action"
                  id="{{'selectedProject-'.$assignedProject->id}}">
                <div class="container">
                  <div class="d-flex justify-content-between">
                    <div class="d-inline-flex">
                      <span
                        id="addedProjectName-{{$assignedProject->id}}">{{$assignedProject->name}}</span>
                    </div>
                    <div class="d-inline-flex">
                      <a class="col-sm btn btn-danger" onclick="deleteProject({{$assignedProject->id}})">Verwijderen</a>
                      <input name="project[]" value="{{$assignedProject->id}}" hidden>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <h1 id="noAddedProjectsFound">Geen projecten gekoppeld.</h1>
          <div class="col">
            @error('Project')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="mb-3">
          <h3>Toevoegen</h3>
          <input type="text" id="filterProjectInput" onkeyup="filterProjects()"
                 placeholder="Zoek naar projecten" title="Typ een naam">
          <ul class="list-group mt-2 mb-2 scroll max-h-screen" id="projectList">
            @foreach($newProjects as $newProject)
              <li class="list-group-item list-group-item-action" id="{{$newProject->id}}">
                <div class="container">
                  <div class="d-flex justify-content-between">
                    <div class="d-inline-flex">
                      <span>{{$newProject->name}}</span>
                    </div>
                    <div class="d-inline-flex">
                      <a class="col-sm btn btn-primary"
                         onclick="addProject({{$newProject->id}}, `{{$newProject->name}}`)">Toevoegen</a>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <h1 id="noProjectsFound">Geen projecten om mee te koppelen.</h1>
        </div>
      </div>
    </fieldset>

  </fieldset>
  <input class="btn btn-primary" type="submit" onclick="clearSessionData()" value="Projectgroep {{$formActionViewName}}">
</form>

<script>
  // Add eventlisteners
  // document.getElementById("student-search").addEventListener("keyup", search);
  // document.getElementById("class-search").addEventListener("keyup", search);

  // Session storage manager
  function clearSessionData() {
    sessionStorage.removeItem('projectGroupFormData');
  }

  function getAddedContacts() {
    const addedContactObjects = document.getElementById('selectedContacts').getElementsByTagName('li');
    let returnValue = [];
    for (let i = 0; i < addedContactObjects.length; i++) {
      const id = addedContactObjects[i].id.split('selectedContact-')[1];
      const contactObject = {id: id, name: document.getElementById(`addedContactName-${id}`).innerText};
      returnValue.push(contactObject);
    }
    return returnValue;
  }

  function getAddedProjects() {
    const addedProjectObjects = document.getElementById('selectedProjects').getElementsByTagName('li');
    let returnValue = [];
    for (let i = 0; i < addedProjectObjects.length; i++) {
      const id = addedProjectObjects[i].id.split('selectedProject-')[1];
      const projectObject = {id: id, name: document.getElementById(`addedProjectName-${id}`).innerText};
      returnValue.push(projectObject);
    }
    return returnValue;
  }

  // Student search logic
  function search() {
    // Declare variables
    let inputstudent = document.getElementById("student-search");
    let filterstudent = inputstudent.value.toUpperCase();

    let inputclass = document.getElementById("class-search");
    let filterclass = inputclass.value.toUpperCase();

    let table = document.getElementById("student-table");
    let tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (let i = 0; i < tr.length; i++) {
      let studenttd = tr[i].getElementsByTagName("td")[1];
      let classtd = tr[i].getElementsByTagName("td")[2];

      if (studenttd && classtd) {
        let studentvalue = studenttd.textContent || studenttd.innerText;
        let classvalue = classtd.textContent || classtd.innerText;

        if (studentvalue.toUpperCase().indexOf(filterstudent) > -1 && classvalue.toUpperCase().indexOf(filterclass) > -1) {
          tr[i].classList.remove("d-none");
        } else {
          tr[i].classList.add("d-none");
        }
      }
    }
  }

  // Contact list logic
  const contactDiv = document.getElementById('selectedContacts');
  const addedContactsDiv = document.getElementById('addedContacts');

  //Project list logic
  const projectDiv = document.getElementById('selectedProjects');
  const addedProjectsDiv = document.getElementById('addedProjects');



  // Contact logic
  function displayNotFoundAddedContactsText() {
    document.getElementById('noAddedContactsFound').style.display = (document.getElementById('selectedContacts').getElementsByTagName('li').length == 0 ? "" : "none");
  }

  function displayNotFoundAddedProjectsText() {
    document.getElementById('noAddedProjectsFound').style.display = (document.getElementById('selectedProjects').getElementsByTagName('li').length == 0 ? "" : "none");
  }

  function removeAllContacts() {
    let addedContactObjects = document.getElementById('selectedContacts').getElementsByTagName('li');
    while (addedContactObjects.length > 0) {
      addedContactObjects = document.getElementById('selectedContacts').getElementsByTagName('li');
      for (let i = 0; i < addedContactObjects.length; i++) {
        const id = addedContactObjects[i].id.split('selectedContact-')[1];
        deleteContact(id);
      }
    }
  }

  function removeAllProjects() {
    let addedProjectObjects = document.getElementById('selectedProjects').getElementsByTagName('li');
    while(addedProjectObjects.length>0) {
      addedProjectObjects = document.getElementById('selectedContacts').getElementsByTagName('li');
      for (let i = 0; i < addedProjectObjects.length; i++) {
        const id = addedProjectObjects[i].id.split('selectedProject-')[1];
        deleteProject(id);
      }
    }
  }

  function saveToSessionStorage() {
    let storageObject = {
      name: document.getElementById('name').value,
      teachers: getSelectedTeachers(),
      students: getSelectedStudents(),
      contacts: getAddedContacts(),
      projects: getAddedProjects()
    };
    sessionStorage.setItem('projectGroupFormData', JSON.stringify(storageObject));
  }

  function loadFromSessionStorage() {
    let storageObject = sessionStorage.getItem('projectGroupFormData');
    if (!storageObject) return;
    removeAllContacts();
    removeAllProjects();
    storageObject = JSON.parse(storageObject);

    // contacts
    for (let i = 0; i < storageObject.contacts.length; i++) {
      let contact = storageObject.contacts[i];
      addContact(contact.id, contact.name);
    }

    //projects
    for (let i = 0; i < storageObject.projects.length; i++) {
      let project = storageObject.projects[i];
      addProject(project.id, project.name);
    }

    // name
    document.getElementById('name').value = storageObject.name;

    // teachers
    for (let i = 0; i < storageObject.teachers.length; i++) {
      let teacher = storageObject.teachers[i];
      const boxToToggle = document.querySelector('input[data-teacher-id="' + teacher + '"]');
      if (boxToToggle != null) {
        boxToToggle.checked = true;
        }
      }

    // students
    for (let i = 0; i < storageObject.students.length; i++) {
      let student = storageObject.students[i];
      const boxToToggle = document.querySelector('input[data-student-id="' + student + '"]');
      if (boxToToggle != null) {
        boxToToggle.checked = true;
      }
    }
  }

  function addContact(contactId, contactName) {
    let contactTemplate = `
      <li class="list-group-item list-group-item-action" id=selectedContact-${contactId}>
        <div class="container">
          <div class="d-flex justify-content-between">
            <div class="d-inline-flex">
              <span id=addedContactName-${contactId}>${contactName}</span>
            </div>
            <div class="d-inline-flex">
              <a class="btn btn-danger" onclick="deleteContact(${contactId})">Verwijderen</a>
                <input name="contact[]" value="${contactId}" hidden>
            </div>
          </div>
        </div>
      </li>
      `;
    contactDiv.innerHTML += contactTemplate;

    if (contactDiv.childNodes.length > 0) {
      addedContactsDiv.style.display = 'block';
    }
    filterContacts();
    displayNotFoundAddedContactsText();
  }

  function addProject(projectId, projectName) {
    let projectTemplate =  `
      <li class="list-group-item list-group-item-action" id=selectedProject-${projectId}>
          <div class="container">
            <div class="d-flex justify-content-between">
              <div class="d-inline-flex">
                <span id=addedProjectName-${projectId}>${projectName}</span>
              </div>
              <div class="d-inline-flex">
                <a class="btn btn-danger" onclick="deleteProject(${projectId})">Verwijderen</a>
                  <input name="project[]" value="${projectId}" hidden>
              </div>
            </div>
          </div>
        </li>
    `;
    projectDiv.innerHTML += projectTemplate;

    if (projectDiv.childElementCount > 0) {
      addedProjectsDiv.style.display = 'block';
    }
    filterProjects();
    displayNotFoundAddedProjectsText();
  }

  function deleteContact(contactId) {
    document.getElementById(`selectedContact-${contactId}`).remove();
    filterContacts();
    displayNotFoundAddedProjectsText();
  }

  function deleteProject(projectId) {
    document.getElementById(`selectedProject-${projectId}`).remove();
    filterProjects();
    displayNotFoundAddedProjectsText();
  }

  function filterContacts() {
    let input, filter, ul, li, a, i, txtValue, selectableContacts = 0;
    input = document.getElementById("filterContactInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("contactList");
    li = ul.getElementsByTagName("li");

    for (i = 0; i < li.length; i++) {
      txtValue = li[i].innerText;
      let isSelected = document.getElementById(`selectedContact-${li[i].id}`) != null;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && !isSelected) {
        li[i].style.display = "";
        selectableContacts++;
      } else {
        li[i].style.display = "none";
      }
    }

    document.getElementById('noContactsFound').style.display = (selectableContacts == 0 ? "" : "none");
  }

  function filterProjects() {
    let input, filter, ul, li, a, i, txtValue, selectableProjects = 0;
    input = document.getElementById("filterProjectInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("projectList");
    li = ul.getElementsByTagName("li");

    for (i = 0; i < li.length; i++) {
      txtValue = li[i].innerText;
      let isSelected = document.getElementById(`selectedProject-${li[i].id}`) != null;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && !isSelected) {
        li[i].style.display = "";
        selectableProjects++;
      } else {
        li[i].style.display = "none";
      }
    }

    document.getElementById('noProjectsFound').style.display = (selectableProjects == 0 ? "" : "none");
  }

  function getSelectedTeachers() {
    const inputElements = document.querySelectorAll('[data-teacher-id]:checked');

    let teacherIds = [];
    inputElements.forEach(element => {
      teacherIds.push(element.dataset.teacherId - 0);
    });

    return teacherIds;
  }

  function getSelectedStudents() {
    const inputElements = document.querySelectorAll('[data-student-id]:checked');

    let studentIds = [];
    inputElements.forEach(element => {
      studentIds.push(element.dataset.studentId - 0);
    });

    return studentIds;
  }

  // On load triggers
  window.onload = function (e) {
    loadFromSessionStorage();
    filterContacts();
    filterProjects();
    displayNotFoundAddedContactsText();
    displayNotFoundAddedProjectsText();
  }
</script>
