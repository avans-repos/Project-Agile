<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
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
    return view('classroom.manage')
      ->with('classroom', $classroom)
    ->with('action', 'update');
  }

  public function update(ClassRoom $classRoom){}
}
