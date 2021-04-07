<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
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

  public function store(ProjectRequest $request)
  {
    $request->validated();

    Project::create($request->all());
    return redirect()->route('project.index');
  }

  public function destroy(Project $project)
  {
    $project->delete();
    return redirect()->route('project.index');
  }

}
