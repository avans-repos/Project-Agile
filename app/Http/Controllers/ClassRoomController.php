<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
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
    return view('classroom.manage')
      ->with('classroom', $classroom)
      ->with('students', $students)
      ->with('action', 'update');
  }

  public function update(ClassRoom $classRoom){}
}
