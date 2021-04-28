<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\ClassRoom;
use App\Models\student_has_class_room;
use App\Models\User;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
  public function index()
  {
    $classrooms = ClassRoom::all();

    return view('classroom.index')
      ->with('classrooms', $classrooms);
  }

  public function edit(ClassRoom $classroom)
  {
    $students = User::role('Student')->get();
    $addedStudents =  student_has_class_room::where('class_room', '=', $classroom->id)->get();
    return view('classroom.manage')
      ->with('classroom', $classroom)
      ->with('students', $students)
      ->with('addedStudents', $addedStudents)
      ->with('action', 'update');
  }

  public function update(ClassRoom $classroom, ClassRoomRequest  $request){
    $classroom->update($request->all());
    $newStudents = $request->all()['student'];

    student_has_class_room::where('class_room', '=', $classroom->id)->delete();

    foreach ($newStudents as $student){
      if(User::whereId($student)->first()->exists()){
        $newLink = new student_has_class_room();
        $newLink['class_room'] = $classroom->id;
        $newLink['student'] = $student;
        $newLink->save();
      }
    }
   return redirect(route('classroom.index'));
  }
}
