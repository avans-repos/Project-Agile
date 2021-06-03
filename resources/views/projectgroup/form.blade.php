<form action="{{route('projectgroup.'.$formAction, ['projectgroup' => $projectgroup, 'redirectUrl' => $redirectUrl])}}" method="POST">
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
                 data-bs-toggle="tooltip" data-bs-placement="left" title="Druk op de checkbox om een docent te selecteren">
            <input
              {{ (is_array(old("assignedUsers",$assignedUsers))) ?
                      (in_array($teacher->id, old("assignedUsers", $assignedUsers))) ? 'checked' : null
                   : null
              }} type="checkbox" name="assignedUsers[]" value="{{$teacher->id}}"><span class="ms-2">{{$teacher->name}}</span>
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
            <th><input type="text" id="student-search" placeholder="Naam"
                       data-bs-toggle="tooltip" data-bs-placement="top" title="Vul hier de naam in om te kunnen filteren"/></th>
            <th><input type="text" id="class-search" placeholder="Klas"
                       data-bs-toggle="tooltip" data-bs-placement="top" title="Vul hier de klas code in om te kunnen filteren"/></th>
          </tr>
        </thead>
        <tbody>
          @foreach($students as $student)
            <tr data-bs-toggle="tooltip" data-bs-placement="left" title="Druk op de checkbox om een student te selecteren">
              <td>
              <input
              {{ (is_array(old("assignedUsers",$assignedUsers))) ?
                      (in_array($student->id, old("assignedUsers",$assignedUsers))) ? 'checked' : null
                   : null
              }} type="checkbox" name="assignedUsers[]" value="{{$student->id}}" >
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

    <div class="mb-1">
      <label class="form-label">Selecteer contactpersonen</label>

      <div class="d-flex flex-column">
        @foreach($contacts as $contact)
          <label class="radio-inline">
            <input
              {{ (is_array(old("assignedContacts",$assignedContacts))) ?
                      (in_array($contact->id, old("assignedContacts", $assignedContacts))) ? 'checked' : null
                   : null
              }} type="checkbox" name="assignedContacts[]" value="{{$contact->id}}" ><span class="ms-2"
                                                                                           data-bs-toggle="tooltip" data-bs-placement="right" title="Druk op de checkbox om een contactpersoon te selecteren">{{$contact->getName()}}</span>
          </label>
        @endforeach
      </div>
    </div>
    <div class="mb-1">
      <label class="form-label">Selecteer project</label>

      <div class="d-flex flex-column">
        <select name="project" id="project" class="form-control">
            <option value="-1">Geen project</option>
          @foreach($projects as $project)
            <option value="{{$project->id}}" @if($project->id == $projectgroup->project) selected @endif>{{$project->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </fieldset>
  <input class="btn btn-primary" type="submit" value="Projectgroep {{$formActionViewName}}">
</form>

<script>
document.getElementById("student-search").addEventListener("keyup", search);
document.getElementById("class-search").addEventListener("keyup", search);

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
</script>
