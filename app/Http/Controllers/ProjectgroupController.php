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
    $projectgroups = array();

    foreach(Projectgroup::all() as $projectgroup) {
      $assigned_to_group = DB::table('projectgroup_has_users')->select('userid')->where('projectgroupid',$projectgroup->id)->pluck('userid');

      $teachers = User::whereIn('id',$assigned_to_group)->whereHas(
        'roles', function($q) {
        $q->where('name', 'teacher');
      })->get();

      $students = User::whereIn('id',$assigned_to_group)->whereHas(
        'roles', function($q) {
        $q->where('name', 'student');
      })->get();

      $project = Project::find($projectgroup->project);

      array_push($projectgroups, [
        'group' => $projectgroup,
        'teachers' => $teachers,
        'students' => $students,
        'project' => $project->name
      ]);
    }

    return view('projectgroup.index')
      ->with('projectgroups', $projectgroups);
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
    $contacts = Contact::all();
    $projects = Project::all();

    $assignedUsers = null;
    $assignedContacts = null;

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', $teachers)
      ->with('students', $students)
      ->with('contacts', $contacts)
      ->with('assignedUsers', $assignedUsers)
      ->with('assignedContacts', $assignedContacts)
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
    $id = Projectgroup::create($request->all())->id;

    // fill in all the users (students and teachers)
    if (isset($request->assignedUsers))
    {
      foreach ($request->assignedUsers as $assignedUser)
      {
        DB::insert('INSERT INTO projectgroup_has_users (userid,projectgroupid) VALUES (?,?)', [$assignedUser, $id]);
      }
    }

    // fill in all the contactpersons
    if (isset($request->assignedContacts))
    {
      foreach ($request->assignedContacts as $assignedContact)
      {
        DB::insert('INSERT INTO projectgroup_has_contacts (contactid,projectgroupid) VALUES (?,?)', [$assignedContact, $id]);
      }
    }

    return redirect()->route('projectgroup.index');
  }

  public function show(Projectgroup $projectgroup)
  {
    return view('projectgroup.show')->with('projectgroup', $projectgroup);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Projectgroup $projectgroup
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function edit(Projectgroup $projectgroup)
  {

    $students = User::role('student')->get();
    $teachers = User::role('teacher')->get();
    $contacts = Contact::all();
    $projects = Project::all();

    $assignedUsers =
      DB::table('projectgroup_has_users')
        ->where('projectgroupid', '=', $projectgroup->id)
        ->join('users', 'projectgroup_has_users.userid', '=', 'users.id')
        ->get('users.id') ?? [];

    $assignedUsers = array_map(function ($teacher) {
      return $teacher->id;
    }, json_decode($assignedUsers));

    $assignedContacts =
      DB::table('projectgroup_has_contacts')
        ->where('projectgroupid', '=', $projectgroup->id)
        ->join('contacts', 'projectgroup_has_contacts.contactid', '=', 'contacts.id')
        ->get('contacts.id') ?? [];

    $assignedContacts = array_map(function ($contact) {
      return $contact->id;
    }, json_decode($assignedContacts));

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', $teachers)
      ->with('students', $students)
      ->with('contacts', $contacts)
      ->with('assignedUsers', $assignedUsers)
      ->with('assignedContacts', $assignedContacts)
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

    // insert the connections with users (students and teachers)
    if (isset($request->assignedUsers)) {
      foreach ($request->assignedUsers as $assignedUser) {
        if (
        !DB::table('projectgroup_has_users')
          ->where('userid', $assignedUser)
          ->where('projectgroupid', $projectgroup->id)
          ->exists()
        ) {
          DB::insert('INSERT INTO projectgroup_has_users (userid,projectgroupid) VALUES (?,?)', [$assignedUser, $projectgroup->id]);
        }
      }
    }

    // insert the connections with contactpersons
    if (isset($request->assignedContacts)) {
      foreach ($request->assignedContacts as $assignedContact) {
        if (
        !DB::table('projectgroup_has_contacts')
          ->where('contactid', $assignedContact)
          ->where('projectgroupid', $projectgroup->id)
          ->exists()
        ) {
          DB::insert('INSERT INTO projectgroup_has_contacts (contactid,projectgroupid) VALUES (?,?)', [$assignedContact, $projectgroup->id]);
        }
      }
    }

    // removing unnecessary connections with users (students and teachers
    foreach (
      DB::table('projectgroup_has_users')
        ->where('projectgroupid', $projectgroup->id)
        ->get()
      as $dbvalue
    ) {
      if (!isset($request->assignedUsers) || !in_array($dbvalue->userid, $request->assignedUsers)) {
        DB::delete('DELETE FROM projectgroup_has_users WHERE userid = ? AND projectgroupid = ?', [$dbvalue->userid, $dbvalue->projectgroupid]);
      }
    }

    // removing unnecessary connections with contactpersons
    foreach (
      DB::table('projectgroup_has_contacts')
        ->where('projectgroupid', $projectgroup->id)
        ->get()
      as $dbvalue
    ) {
      if (!isset($request->assignedContacts) || !in_array($dbvalue->contactid, $request->assignedContacts)) {
        DB::delete('DELETE FROM projectgroup_has_contacts WHERE contactid = ? AND projectgroupid = ?', [$dbvalue->contactid, $dbvalue->projectgroupid]);
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
