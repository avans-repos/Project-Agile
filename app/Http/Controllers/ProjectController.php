<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

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

  public function store(ProjectRequest $request): RedirectResponse
  {
    $request->validated();

    $project = Project::create($request->all());

    return redirect()->route('project.edit', [$project->id]);
  }

  public function destroy(Project $project): RedirectResponse
  {
    $project->delete();
    return redirect()->route('project.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Project $project
   * @return Application|Factory|View
   */
  public function edit(Project $project)
  {
    $currentProjectgroups = ProjectGroup::where('project', $project->id)->get();
    $availableProjectgroups = ProjectGroup::where('project', null)->get();

    return view('project.manage')
      ->with('project', $project)
      ->with('currentProjectgroups', $currentProjectgroups)
      ->with('availableProjectgroups', $availableProjectgroups)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ProjectRequest $request
   * @param Project $project
   * @return Response
   */
  public function update(ProjectRequest $request, Project $project): Response
  {
    $request->validated();
    $project->update($request->all());
    return redirect()->route('project.index');
  }

  public function addGroup($projectid, $groupid)
  {
    $group = ProjectGroup::find($groupid);
    $group->project = $projectid;
    $group->save();

    return redirect()->route('project.edit', [$projectid]);
  }

  public function removeGroup($projectid, $groupid)
  {
    $group = ProjectGroup::find($groupid);
    $group->project = null;
    $group->save();

    return redirect()->route('project.edit', [$projectid]);
  }
}
