<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
  public function index()
  {
    $classrooms = ClassRoom::all();

    die(json_encode($classrooms));

    return view('classroom.index')
      ->with('classrooms', $classrooms);
  }
}
