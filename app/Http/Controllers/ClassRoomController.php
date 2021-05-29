<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\StudentClass;
use App\Models\student_has_class_room;
use App\Models\User;

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
    $addedStudents = $classroom->students()->get();
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

    $classroom->students()->sync($newStudents);

    return redirect(route('classroom.index'));
  }

  public function store(ClassRoomRequest $request)
  {
    $request->validated();
    $classroom = StudentClass::create($request->all());
    $newStudents = $request->all()['student'] ?? [];

    $classroom->students()->sync($newStudents);
    return redirect(route('classroom.index'));
  }

  public function destroy(StudentClass $classroom)
  {
    $classroom->delete();
    return redirect(route('classroom.index'));
  }
}
