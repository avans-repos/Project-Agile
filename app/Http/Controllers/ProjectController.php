<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Projectgroup;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  //
  public function index()
  {
    $projects = Project::all();
    return view('project.index')->with('projects', $projects);
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

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Project $project
   * @return \Illuminate\Http\Response
   */
  public function edit(Project $project)
  {
    return view('project.manage')
      ->with('project', $project)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\ProjectRequest $request
   * @param \App\Models\Project $project
   * @return \Illuminate\Http\Response
   */
  public function update(ProjectRequest $request, Project $project)
  {
    $request->validated();
    $project->update($request->all());
    return redirect()->route('project.index');
  }
}
