<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use App\Models\Project;
use App\Models\Projectgroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectgroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $groups = array();

    foreach(Projectgroup::all() as $group) {
      $assigned_to_group = DB::table('projectgroup_has_users')->select('userid')->where('projectgroupid',$group->id)->pluck('userid');

      $teachers = User::whereIn('id',$assigned_to_group)->whereHas(
        'roles', function($q) {
        $q->where('name', 'teacher');
      })->get();

      $students = User::whereIn('id',$assigned_to_group)->whereHas(
        'roles', function($q) {
        $q->where('name', 'student');
      })->get();

      $project = Project::find($group->project);
      
      $projectname = "Geen Project";
      if ($project != null) $projectname = $project->name;
      
      array_push($groups, [
        'group' => $group,
        'teachers' => $teachers,
        'students' => $students,
        'project' => $projectname
      ]);
    }

    return view('projectgroup.index')
      ->with('groups', $groups);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $projectgroup = new Projectgroup();

    $students = User::role('Student')->get();
    $teachers = User::role('Teacher')->get();
    $projects = Project::all();

    $assigned = null;
    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', $teachers)
      ->with('students', $students)
      ->with('assigned', $assigned)
      ->with('projects', $projects)
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProjectgroupRequest $request)
  {
    $request->validated();

    if ($request->project == -1)
    {
      $group = new Projectgroup;
      $group->name = $request->name;
      $group->save();

      $id = $group->id;
    } 
    else 
    {
      $id = Projectgroup::create($request->all())->id;
    }

    if (isset($request->assigned)) {
      foreach ($request->assigned as $assigned) {
        DB::insert('INSERT INTO projectgroup_has_users (userid,projectgroupid) VALUES (?,?)', [$assigned, $id]);
      }
    }

    return redirect()->route('projectgroup.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Projectgroup $projectgroup
   * @return \Illuminate\Http\Response
   */
  public function edit(Projectgroup $projectgroup)
  {

    $students = User::role('student')->get();
    $teachers = User::role('teacher')->get();
    $projects = Project::all();

    $assigned =
      DB::table('projectgroup_has_users')
        ->where('projectgroupid', '=', $projectgroup->id)
        ->join('users', 'projectgroup_has_users.userid', '=', 'users.id')
        ->get('users.id') ?? [];

    $assigned = array_map(function ($teacher) {
      return $teacher->id;
    }, json_decode($assigned));

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', $teachers)
      ->with('students', $students)
      ->with('assigned', $assigned)
      ->with('projects', $projects)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ProjectgroupRequest $request
   * @param Projectgroup $group
   * @return \Illuminate\Http\Response
   */
  public function update(ProjectgroupRequest $request, Projectgroup $projectgroup)
  {
    $request->validated();

    if (isset($request->assigned)) {

    foreach ($request->assigned as $assigned) {
      if (
      !DB::table('projectgroup_has_users')
        ->where('userid', $assigned)
        ->where('projectgroupid', $projectgroup->id)
        ->exists()
      ) {
        DB::insert('INSERT INTO projectgroup_has_users (userid,projectgroupid) VALUES (?,?)', [$assigned, $projectgroup->id]);
      }
    }
  }
    foreach (
      DB::table('projectgroup_has_users')
        ->where('projectgroupid', $projectgroup->id)
        ->get()
      as $dbvalue
    ) {
      if (!isset($request->assigned) || !in_array($dbvalue->userid, $request->assigned)) {
        DB::delete('DELETE FROM projectgroup_has_users WHERE userid = ? AND projectgroupid = ?', [$dbvalue->userid, $dbvalue->projectgroupid]);
      }
    }

    $projectgroup->update($request->all());
    return redirect()->route('projectgroup.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Projectgroup $projectgroup
   * @return \Illuminate\Http\Response
   */
  public function destroy(Projectgroup $projectgroup)
  {
    $projectgroup->delete();
    return redirect()->route('projectgroup.index');
  }
}
