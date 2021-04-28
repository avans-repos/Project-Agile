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

  <fieldset class="mt-5">
    <legend>Toegevoegde studenten</legend>

    <ul class="list-group mt-2 mb-2" id="selectedStudents">
      @foreach($addedStudents as $student)
        <li class="list-group-item list-group-item-action" id="selectedStudent-{{$student->student()->id}}">
          <div class="container">
            <div class="row">
              <div class="col">
                <span>{{$student->student()->name}}</span>
              </div>
              <div class="col-md-auto"></div>
              <div class="col col-lg-2">
                <a class="col-sm btn btn-danger" onclick="deleteStudent({{$student->student()->id}})">Verwijderen</a>
                <input name="student[]" value="{{$student->student()->id}}" hidden>
              </div>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    <div class="col">
      @error('student')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </fieldset>

  <fieldset class="mt-5">
    <legend>Studenten toevoegen</legend>
    <input type="text" id="filterStudentInput" onkeyup="filterStudents()" placeholder="Zoek naar studenten" title="Typ een naam">
    <ul class="list-group mt-2 mb-2 scroll max-h-screen" id="studentList">
      @foreach($students as $student)
        <li class="list-group-item list-group-item-action" id="{{$student->id}}">
          <div class="container">
            <div class="row">
              <div class="col">
                <span>{{$student->name}}</span>
              </div>
              <div class="col-md-auto"></div>
              <div class="col col-lg-2">
                <a class="col-sm btn btn-primary" onclick="addStudent({{$student->id}}, '{{$student->name}}')">Toevoegen</a>
              </div>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </fieldset>
    <input class="btn btn-primary" type="submit" value="Klas {{$formActionViewName}}">
</form>



<script>

  function addStudent(studentId, studentName){

    let studentTemplate = `
            <li class="list-group-item list-group-item-action" id="selectedStudent-${studentId}">
          <div class="container">
            <div class="row">
              <div class="col">
                <span>${studentName}</span>
              </div>
              <div class="col-md-auto"></div>
              <div class="col col-lg-2">
                <a class="col-sm btn btn-danger" onclick="deleteStudent(${studentId})">Verwijderen</a>
                <input name="student[]" value="${studentId}" hidden>
              </div>
            </div>
          </div>
        </li>
        `;

    const studentDiv = document.getElementById('selectedStudents');
    studentDiv.innerHTML += studentTemplate;

    filterStudents();
  }

  function deleteStudent(studentId){
    document.getElementById(`selectedStudent-${studentId}`).remove();
    filterStudents();
  }

  function filterStudents() {
    let input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("filterStudentInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("studentList");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
      txtValue = li[i].innerText;
      let isSelected = document.getElementById(`selectedStudent-${li[i].id}`) != null;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && !isSelected) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
  window.onload = function(e) {
    filterStudents();
  }
</script>
