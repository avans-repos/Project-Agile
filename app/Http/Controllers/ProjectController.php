<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Projectgroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    $newProjectGroups = Projectgroup::where('project', null)->get();

    $assignedProjectGroups = [];

    return view('project.manage')
      ->with('project', $project)
      ->with('action', 'store')
      ->with('newProjectGroups', $newProjectGroups)
      ->with('assignedProjectGroups', $assignedProjectGroups);
  }

  public function store(ProjectRequest $request)
  {
    $request->validated();

    $project = Project::create($request->all());

    $newProjectGroups = $request->all()['projectGroup'] ?? [];

    foreach ($newProjectGroups as $newProjectGroup) {
      Projectgroup::where('id', $newProjectGroup)
        ->first()
        ->update(['project' => $project->id]);
    }

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
   * @param Project $project
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
   */
  public function edit(Project $project)
  {
    $newProjectGroups = Projectgroup::where('project', null)->orWhere('project', $project->id)->get();

    $assignedProjectGroups = Projectgroup::where('project', $project->id)->get();

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
    Projectgroup::where('project', $project->id)->update(['project' => null]);

    // add the given references to $project in all the ProjectGroups
    foreach ($newProjectGroups as $newProjectGroup) {
      Projectgroup::where('id', $newProjectGroup)
        ->first()
        ->update(['project' => $project->id]);
    }

    return redirect()->route('project.index');
  }

  public function addGroup($projectid, $groupid)
  {
    $group = Projectgroup::find($groupid);
    $group->project = $projectid;
    $group->save();

    return redirect()->route('project.edit', [$projectid]);
  }

  public function removeGroup($projectid, $groupid)
  {
    $group = Projectgroup::find($groupid);
    $group->project = null;
    $group->save();

    return redirect()->route('project.edit', [$projectid]);
  }
}
