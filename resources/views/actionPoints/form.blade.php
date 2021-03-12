<form action="{{route('actionpoints.'.$formAction, ['actionpoint' => $actionpoint])}}" method="POST">
    @if($formAction == "update")
        @method('PATCH')
    @endif
    @csrf
    <div class="col-sm-6">
        <div class="row">
            <div class="mb-1">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" id="deadline" value="{{old('deadline',$actionpoint->deadline,date('Y-m-d'))}}" required name="deadline" class="form-control">
            </div>
            <div class="col">
                @error('deadline')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-1">
                <label for="title" class="form-label">Titel</label>
                <input type="text" id="title" required value="{{old('title',$actionpoint->title)}}" name="title" class="form-control" placeholder="Titel">
            </div>
            <div class="col">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-1">
                <label for="description" class="form-label">Beschrijving</label>
                <input type="text" id="description" value="{{old('description',$actionpoint->description)}}" name="description" required class="form-control"
                       placeholder="Omschrijving">
            </div>
            <div class="mb-1">
                <label for="reminderdate" class="form-label">Herinneringsdatum</label>
                <input type="datetime-local" id="reminderdate" value="{{old('reminderdate',$actionpoint->reminderdate)}}" name="reminderdate" class="form-control">
            </div>
            <div class="col">
                @error('reminderdate')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <p class="form-label">Selecteer docenten</p>

                <div class="d-flex flex-column">
                    @foreach($teachers as $teacher)
                        <label class="radio-inline">

{{--                          <input {{ (is_array(old("assigned")) ? (in_array(strval($teacher), "assigned") ? 'checked' : null )  : null }} type="checkbox" name="assigned[]" value="{{$teacher->id}}">{{$teacher->name}}--}}
                          <input {{ in_array($teacher->id, $assigned) ? 'checked' : null }} type="checkbox" name="assigned[]" value="{{$teacher->id}}">{{$teacher->name}}
                        </label>
                    @endforeach
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Actiepunt {{$actionViewName}}">
        </div>
    </div>
</form>
