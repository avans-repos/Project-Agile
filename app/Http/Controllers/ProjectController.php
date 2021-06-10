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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    $newProjectGroups = Projectgroup::all();

    $assignedProjectGroups = [];

    return view('project.manage')
      ->with('project', $project)
      ->with('action', 'store')
      ->with('newProjectGroups', $newProjectGroups)
      ->with('assignedProjectGroups', $assignedProjectGroups);
  }

  public function store(ProjectRequest $request): RedirectResponse
  {
    $request->validated();

    $project = Project::create($request->all());

    $project->save();

    $newProjectGroups = $request->all()['projectGroup'] ?? [];

    foreach ($newProjectGroups as $newProjectGroup) {
      $project->projectgroups()->attach($newProjectGroup);
    }

    return redirect()->route('project.index');
  }

  public function destroy(Project $project): RedirectResponse
  {
    if (Auth::user()->isAdmin()) {
      $project->delete();
    }
    return redirect()->route('project.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Project $project
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
   */
  public function edit(Project $project)
  {
    $newProjectGroups = Projectgroup::all();

    $assignedProjectGroups = $project->projectgroups()->get();

    return view('project.manage')
      ->with('project', $project)
      ->with('newProjectGroups', $newProjectGroups)
      ->with('assignedProjectGroups', $assignedProjectGroups)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ProjectRequest $request
   * @param Project $project
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(ProjectRequest $request, Project $project)
  {
    $request->validated();
    $project->update($request->all());
    $newProjectGroups = $request->all()['projectGroup'] ?? [];

    // remove all references to $project in all the ProjectGroups
    $project->projectgroups()->sync([]);

    // add the given references to $project in all the ProjectGroups
    foreach ($newProjectGroups as $newProjectGroup) {
      $project->projectgroups()->attach($newProjectGroup);
    }

    $project->projectgroups()->sync($newProjectGroups);

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
