<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
  public function index()
  {
    $projects = Project::all();
    return view('project.index')->with('projects',$projects);
  }

  public function create()
  {
    $project = new Project();
    return view('project.manage')
      ->with('project', $project)
      ->with('action', 'store');
  }

  public function store(CompanyRequest $request)
  {
    $request->validated();

    $addressIds = self::createAddressesAndReturnIds($request);

    Project::create([
      'name' => $request->input('name'),
      'description' => $request->input('description'),
      'deadline' => $request->input('deadline'),
      'notes' => $request->input('notes'),
    ]);
    return redirect()->route('project.index');
  }

}
