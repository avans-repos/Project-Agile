<form action="{{route('actionpoints.'.$formAction, ['actionpoint' => $actionpoint])}}" method="POST">
    @if($formAction == "update")
        @method('PATCH')
    @endif
    @csrf
    <div class="col-sm-6">
        <div class="row">
            <div class="mb-1">
                <label for="deadline" class="form-label">Deadline *</label>
                <input type="datetime-local" id="deadline" value="{{old('deadline',isset($actionpoint->deadline) ? date('Y-m-d\TH:i', strtotime($actionpoint->deadline)) : null)}}" required name="deadline" class="form-control"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Een datum in de toekomst met een format van dd/mm/yyyy, druk op het kalender icoontje om een datum te kiezen">
            </div>
            <div class="col">
                @error('deadline')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-1">
                <label for="title" class="form-label">Titel *</label>
                <input type="text" id="title" required value="{{old('title',$actionpoint->title)}}" name="title" class="form-control" placeholder="Titel">
            </div>
            <div class="col">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-1">
                <label for="description" class="form-label">Beschrijving</label>
                <input type="text" id="description" value="{{old('description',$actionpoint->description)}}" name="description" class="form-control"
                       placeholder="Omschrijving">
            </div>
            <div class="mb-1">
                <label for="reminderdate" class="form-label">Herinneringsdatum</label>
                <input type="date" id="reminderdate" value="{{old('reminderdate', isset($actionpoint->reminderdate) ? date('Y-m-d', strtotime($actionpoint->reminderdate)) : null)}}" name="reminderdate" class="form-control"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="De datum waarop u een herinnering wilt ontvangen, het invullen werkt hetzelfde als bij de deadline datum">
            </div>
            <div class="col">
                @error('reminderdate')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <p class="form-label">Selecteer docenten *</p>

                <div class="d-flex flex-column">
                    @foreach($teachers as $teacher)
                        <label class="radio-inline">

{{--                          <input {{ (is_array(old("assigned")) ? (in_array(strval($teacher), "assigned") ? 'checked' : null )  : null }} type="checkbox" name="assigned[]" value="{{$teacher->id}}">{{$teacher->name}}--}}
                          <input
                            {{ (is_array(old("assigned",$assigned))) ?
                                    (in_array($teacher->id, old("assigned", $assigned))) ? 'checked' : null
                                 : null
                            }} type="checkbox" name="assigned[]" value="{{$teacher->id}}" ><span class="ms-2"
                                                                                                 data-bs-toggle="tooltip" data-bs-placement="right" title="Druk op de checkbox om een docent te selecteren">{{$teacher->name}}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Actiepunt {{$actionViewName}}">
        </div>
    </div>
</form>
