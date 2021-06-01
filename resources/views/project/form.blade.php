<form action="{{route('project.'.$formAction, ['project' => $project])}}" method="POST">
  @csrf
  @if($formAction == 'update')
    @method('PATCH')
  @endif
  <fieldset class="mb-3">
    <legend>Algemene informatie:</legend>
    <div>
      <div class="mb-1">
        <label for="name" class="form-label">Projectnaam *</label>
        <input name="name" value="{{old('name',$project->name)}}" type="text"
               class="form-control"
               id="name" placeholder="" maxlength="45" required>

      </div>
      <div class="col">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="description" class="form-label">Omschrijving</label>
        <textarea name="description" type="text" class="form-control"
                  id="description">{{old('description',$project->description)}}</textarea>
      </div>
      <div class="col">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="datetime-local" id="deadline"
               value="{{old('deadline',isset($project->deadline) ? date('Y-m-d\TH:i', strtotime($project->deadline)) : null)}}"
               name="deadline" class="form-control">

      </div>
      <div class="col">
        @error('deadline')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div>
      <div class="mb-1">
        <label for="notes" class="form-label">Notities</label>
        <textarea name="notes"
                  class="form-control"
                  id="notes" placeholder="notities" rows="5">{{old('notes',$project->notes)}}</textarea>
      </div>
      <div class="col">
        @error('notes')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </fieldset>

  <fieldset>
    <legend>projectgroepen</legend>
    <div class="row d-flex flex-column">
      <div id="addedGroups">
        <h3>Toegevoegd</h3>
        <ul class="list-group mt-2 mb-2" id="selectedProjectGroups">
          @foreach($assignedProjectGroups as $assignedProjectGroup)
            <li class="list-group-item list-group-item-action"
                id="selectedProjectGroup-{{$assignedProjectGroup->id}}">
              <div class="container">
                <div class="d-flex justify-content-between">
                  <div class="d-inline-flex">
                    <span>{{$assignedProjectGroup->name}}</span>
                  </div>
                  <div class="d-inline-flex">
                    <a class="col-sm btn btn-danger" onclick="deleteProjectGroup({{$assignedProjectGroup->id}})">Verwijderen</a>
                    <input name="projectGroup[]" value="{{$assignedProjectGroup->id}}" hidden>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        <h1 id="noAddedProjectGroupsFound">Geen projectgroepen gekoppeld.</h1>
        <div class="col">
          @error('ProjectGroup')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="mb-3">
        <h3>Toevoegen</h3>
        <input type="text" id="filterProjectGroupInput" onkeyup="filterProjectGroups()"
               placeholder="Zoek naar projectgroepen" title="Typ een naam">
        <ul class="list-group mt-2 mb-2 scroll max-h-screen" id="projectGroupList">
          @foreach($newProjectGroups as $newProjectGroup)
            <li class="list-group-item list-group-item-action" id="{{$newProjectGroup->id}}">
              <div class="container">
                <div class="d-flex justify-content-between">
                  <div class="d-inline-flex">
                    <span>{{$newProjectGroup->name}}</span>
                  </div>
                  <div class="d-inline-flex">
                    <a class="col-sm btn btn-primary"
                       onclick="addProjectGroup({{$newProjectGroup->id}}, '{{$newProjectGroup->name}}')">Toevoegen</a>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        <h1 id="noProjectGroupsFound">Geen projectgroepen om mee te koppelen.</h1>
      </div>
    </div>
  </fieldset>



  <input class="btn btn-primary" type="submit" value="Project {{$formActionViewName}}">
</form>

<fieldset>
  <a class="btn btn-secondary" onClick="ajaxTest()" >
    Voeg nieuwe projectgroep toe.
  </a>

  <div id="ajaxField"></div>

  {{--    <iframe src="{{route('projectgroup.createForm')}}" title="Projectgroep aanmaken">--}}
  {{--    </iframe>--}}
</fieldset>

<script>

  function ajaxTest() {
    $.get("{{route('projectgroup.createForm')}}",
      function(data){
        document.getElementById('ajaxField').innerHTML = data;
    });
  }

  const projectGroupDiv = document.getElementById('selectedProjectGroups');
  const addedGroupsDiv = document.getElementById('addedGroups');

  function displayNotFoundAddedGroupsText() {
    document.getElementById('noAddedProjectGroupsFound').style.display = (document.getElementById('selectedProjectGroups').getElementsByTagName('li').length == 0 ? "" : "none");
  }

  function addProjectGroup(projectGroupId, projectGroupName) {
    let projectGroupTemplate = `
      <li class="list-group-item list-group-item-action" id=selectedProjectGroup-${projectGroupId}>
        <div class="container">
          <div class="d-flex justify-content-between">
            <div class="d-inline-flex">
              <span>${projectGroupName}</span>
            </div>
            <div class="d-inline-flex">
              <a class="btn btn-danger" onclick="deleteProjectGroup(${projectGroupId})">Verwijderen</a>
                <input name="projectGroup[]" value="${projectGroupId}" hidden>
            </div>
          </div>
        </div>
      </li>
      `;
    projectGroupDiv.innerHTML += projectGroupTemplate;

    if (projectGroupDiv.childNodes.length > 0) {
      addedGroupsDiv.style.display = 'block';
    }
    filterProjectGroups();
    displayNotFoundAddedGroupsText();
  }

  function deleteProjectGroup(projectGroupId) {
    document.getElementById(`selectedProjectGroup-${projectGroupId}`).remove();
    filterProjectGroups();
    displayNotFoundAddedGroupsText();
  }

  function filterProjectGroups() {
    let input, filter, ul, li, a, i, txtValue, selectableGroups = 0;
    input = document.getElementById("filterProjectGroupInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("projectGroupList");
    li = ul.getElementsByTagName("li");

    for (i = 0; i < li.length; i++) {
      txtValue = li[i].innerText;
      let isSelected = document.getElementById(`selectedProjectGroup-${li[i].id}`) != null;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && !isSelected) {
        li[i].style.display = "";
        selectableGroups++;
      } else {
        li[i].style.display = "none";
      }
    }

    document.getElementById('noProjectGroupsFound').style.display = (selectableGroups == 0 ? "" : "none");
  }

  window.onload = function (e) {
    filterProjectGroups();
    displayNotFoundAddedGroupsText();
  }
</script>

