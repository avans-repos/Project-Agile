<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\StudentClass;
use App\Models\student_has_class_room;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
  public function index()
  {
    $classrooms = StudentClass::all();

    return view('classroom.index')->with('classrooms', $classrooms);
  }

  public function create()
  {
    $classroom = new StudentClass();
    $students = User::role('Student')->get();
    $addedStudents = [];
    return view('classroom.manage')
      ->with('classroom', $classroom)
      ->with('students', $students)
      ->with('addedStudents', $addedStudents)
      ->with('action', 'store');
  }

  public function edit(StudentClass $classroom)
  {
    $students = User::role('Student')->get();
    $addedStudents = student_has_class_room::where('class_room', '=', $classroom->id)->get();
    return view('classroom.manage')
      ->with('classroom', $classroom)
      ->with('students', $students)
      ->with('addedStudents', $addedStudents)
      ->with('action', 'update');
  }

  public function update(StudentClass $classroom, ClassRoomRequest $request)
  {
    $request->validated();
    $classroom->update($request->all());
    $newStudents = $request->all()['student'] ?? [];

    student_has_class_room::where('class_room', '=', $classroom->id)->delete();

    foreach ($newStudents as $student) {
      if (
        User::whereId($student)
          ->first()
          ->exists()
      ) {
        $newLink = new student_has_class_room();
        $newLink['class_room'] = $classroom->id;
        $newLink['student'] = $student;
        $newLink->save();
      }
    }
    return redirect(route('classroom.index'));
  }

  public function store(ClassRoomRequest $request)
  {
    $request->validated();
    $classroomId = StudentClass::create($request->all())->id;
    $newStudents = $request->all()['student'] ?? [];
    foreach ($newStudents as $student) {
      if (
        User::whereId($student)
          ->first()
          ->exists()
      ) {
        $newLink = new student_has_class_room();
        $newLink['class_room'] = $classroomId;
        $newLink['student'] = $student;
        $newLink->save();
      }
    }
    return redirect(route('classroom.index'));
  }

  public function destroy(StudentClass $classroom)
  {
    student_has_class_room::where('class_room', '=', $classroom->id)->delete();
    $classroom->delete();
    return redirect(route('classroom.index'));
  }
}
