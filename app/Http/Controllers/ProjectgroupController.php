<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\Address;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use App\Models\ClassRoom;
use App\Models\student_has_class_room;
use App\Models\Project;
use App\Models\Projectgroup;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProjectgroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $projectgroups = [];

    foreach (Projectgroup::all() as $projectgroup) {
      $assigned_to_group = DB::table('projectgroup_has_users')
        ->select('userid')
        ->where('projectgroupid', $projectgroup->id)
        ->pluck('userid');

      $teachers = User::whereIn('id', $assigned_to_group)
        ->whereHas('roles', function ($q) {
          $q->where('name', 'teacher');
        })
        ->get();

      $students = User::whereIn('id', $assigned_to_group)
        ->whereHas('roles', function ($q) {
          $q->where('name', 'student');
        })
        ->get();

      $project = Project::find($projectgroup->project);

      $projectname = 'Geen Project';
      if ($project != null) {
        $projectname = $project->name;
      }

      array_push($projectgroups, [
        'group' => $projectgroup,
        'teachers' => $teachers,
        'students' => $students,
        'project' => $projectname,
      ]);
    }

    return view('projectgroup.index')->with('projectgroups', $projectgroups);
  }

  private function addClassToStudent($students)
  {
    foreach ($students as $student) {
      $student_has_class_room = student_has_class_room::where('student', $student->id)->first();

      if (is_null($student_has_class_room)) {
        $student->classroom = 'Geen Klas';
        continue;
      }

      $class = ClassRoom::where('id', $student_has_class_room->class_room)->first();

      $student->classroom = $class->name;
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $redirectURL = request()->headers->get('referer');
    $projectgroup = new Projectgroup();

    $students = User::role('Student')->get();
    $teachers = User::role('Teacher')->get();
    $contacts = Contact::all();
    $projects = Project::all();

    $this->addClassToStudent($students);

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
      ->with('redirectUrl', $redirectURL)
      ->with('action', 'store');

    //return \response('Hello World!');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function store(ProjectgroupRequest $request)
  {
    $request->validated();

    $redirectUrl = $request->get('redirectUrl') ?? route('projectgroup.index');

    $group = new Projectgroup();
    $group->name = $request->name;

    if ($request->project != -1) {
      $group->project = $request->project;
    }

    $group->save();
    $id = $group->id;

    // fill in all the users (students and teachers)
    if (isset($request->assignedUsers)) {
      foreach ($request->assignedUsers as $assignedUser) {
        DB::table('projectgroup_has_users')->insert([
          'userid' => $assignedUser,
          'projectgroupid' => $id,
        ]);
      }
    }

    // fill in all the contactpersons
    if (isset($request->assignedContacts)) {
      foreach ($request->assignedContacts as $assignedContact) {
        DB::table('projectgroup_has_contacts')->insert([
          'contactid' => $assignedContact,
          'projectgroupid' => $id,
        ]);
      }
    }



    return redirect($redirectUrl);
  }

  public function show(Projectgroup $projectgroup)
  {
    $assignedUsers = DB::table('projectgroup_has_users')
      ->where('projectgroupid', '=', $projectgroup->id)
      ->join('users', 'projectgroup_has_users.userid', '=', 'users.id')
      ->get('users.id')
      ->pluck('id');

    $students = User::role('student')
      ->whereIn('id', $assignedUsers)
      ->get();

    $teachers = User::role('teacher')
      ->whereIn('id', $assignedUsers)
      ->get();

    $project = DB::table('projects')
      ->where('id', '=', $projectgroup->project)
      ->first();

    $assignedContacts = DB::table('projectgroup_has_contacts')
      ->where('projectgroupid', '=', $projectgroup->id)
      ->join('contacts', 'projectgroup_has_contacts.contactid', '=', 'contacts.id')
      ->get('contacts.id')
      ->pluck('id');

    $contacts = Contact::all()->whereIn('id', $assignedContacts);

    $contacts = self::matchAdressWithContacts($contacts);

    $newContacts = Contact::all()->wherenotin('id', $assignedContacts);

    return view('projectgroup.show')
      ->with('projectgroup', $projectgroup)
      ->with('project', $project)
      ->with('students', $students)
      ->with('teachers', $teachers)
      ->with('contacts', $contacts)
      ->with('newContacts', $newContacts);
  }

  public function addcontact($projectgroupid, $contactid)
  {
    DB::table('projectgroup_has_contacts')->insert([
      'projectgroupid' => $projectgroupid,
      'contactid' => $contactid,
    ]);

    return redirect()->route('projectgroup.show', [$projectgroupid]);
  }

  public function removecontact($projectgroupid, $contactid)
  {
    DB::table('projectgroup_has_contacts')
      ->where('projectgroupid', '=', $projectgroupid)
      ->where('contactid', '=', $contactid)
      ->delete();

    return redirect()->route('projectgroup.show', [$projectgroupid]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Projectgroup $projectgroup
   * @return Application|Factory|View|Response
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

    $this->addClassToStudent($students);

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', $teachers)
      ->with('students', $students)
      ->with('contacts', $contacts)
      ->with('assignedUsers', $assignedUsers)
      ->with('assignedContacts', $assignedContacts)
      ->with('projects', $projects)
      ->with('redirectUrl', null)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ProjectgroupRequest $request
   * @param Projectgroup $group
   * @return Response
   */
  public function update(ProjectgroupRequest $request, Projectgroup $projectgroup)
  {
    $request->validated();

    // insert the connecti