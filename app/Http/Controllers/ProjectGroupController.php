<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use App\Models\Project;
use App\Models\Projectgroup;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
      $assigned_to_group = DB::table('project_group_user')
        ->select('user_id')
        ->where('project_group_id', $projectgroup->id)
        ->pluck('user_id');

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
      $student_has_class_room = DB::table('student_class_user')
        ->where('user_id', '=', $student->id)
        ->first();

      if (is_null($student_has_class_room)) {
        $student->classroom = 'Geen Klas';
        continue;
      }

      $class = StudentClass::where('id', $student_has_class_room->student_class_id)->first();

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
      ->with('action', 'store');
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
        DB::table('project_group_user')->insert([
          'user_id' => $assignedUser,
          'project_group_id' => $id,
        ]);
      }
    }

    // fill in all the contactpersons
    if (isset($request->assignedContacts)) {
      foreach ($request->assignedContacts as $assignedContact) {
        DB::table('contact_project_group')->insert([
          'contact_id' => $assignedContact,
          'project_group_id' => $id,
        ]);
      }
    }

    return redirect()->route('projectgroup.index');
  }

  public function show(Projectgroup $projectgroup)
  {
    $assignedUsers = DB::table('project_group_user')
      ->where('project_group_id', '=', $projectgroup->id)
      ->join('users', 'project_group_user.user_id', '=', 'users.id')
      ->get('users.id')
      ->pluck('id');

    $students = User::role('student')
      ->whereIn('id', $assignedUsers)
      ->get();

    $teachers = User::role('teacher')
      ->whereIn('id', $assignedUsers)
      ->get();

    $project = DB::table('projects')
      ->where('id', '=', $projectgroup->id)
      ->get()
      ->first();

    $assignedContacts = DB::table('contact_project_group')
      ->where('project_group_id', '=', $projectgroup->id)
      ->join('contacts', 'contact_project_group.contact_id', '=', 'contacts.id')
      ->get('contacts.id')
      ->pluck('id');

    $contacts = Contact::all()->whereIn('id', $assignedContacts);

    $contacts = self::matchAdressWithContacts($contacts);

    $newContacts = Contact::all()->wherenotin('id', $assignedContacts);

    foreach ($newContacts as $newContact) {
      $newContact->company = [];

      $contactCompanies = Company::leftJoin('company_has_contacts_has_contacttypes', 'companies.id', '=', 'company')
        ->where('contact', '=', $newContact->id)
        ->get();

      foreach ($contactCompanies as $contactCompany) {
        $newContact->company = array_merge($newContact->company, [$contactCompany->name]);
      }
    }

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
    DB::table('contact_project_group')
      ->where('project_group_id', '=', $projectgroupid)
      ->where('contact_id', '=', $contactid)
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
      DB::table('project_group_user')
        ->where('project_group_id', '=', $projectgroup->id)
        ->join('users', 'project_group_user.user_id', '=', 'users.id')
        ->get('users.id') ?? [];

    $assignedUsers = array_map(function ($teacher) {
      return $teacher->id;
    }, json_decode($assignedUsers));

    $assignedContacts =
      DB::table('contact_project_group')
        ->where('project_group_id', '=', $projectgroup->id)
        ->join('contacts', 'contact_project_group.contact_id', '=', 'contacts.id')
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

    // insert the connections with users (students and teachers)
    if (isset($request->assignedUsers)) {
      foreach ($request->assignedUsers as $assignedUser) {
        if (
          !DB::table('project_group_user')
            ->where('user_id', $assignedUser)
            ->where('project_group_id', $projectgroup->id)
            ->exists()
        ) {
          DB::table('project_group_user')->insert([
            'user_id' => $assignedUser,
            'project_group_id' => $projectgroup->id,
          ]);
        }
      }
    }

    // insert the connections with contactpersons
    if (isset($request->assignedContacts)) {
      foreach ($request->assignedContacts as $assignedContact) {
        if (
          !DB::table('project_group_user')
            ->where('contact_id', $assignedContact)
            ->where('project_group_id', $projectgroup->id)
            ->exists()
        ) {
          DB::table('contact_project_group')->insert([
            'contact_id' => $assignedContact,
            'project_group_id' => $projectgroup->id,
          ]);
        }
      }
    }

    // removing unnecessary connections with users (students and teachers
    foreach (
      DB::table('project_group_user')
        ->where('project_group_id', $projectgroup->id)
        ->get()
      as $dbvalue
    ) {
      if (!isset($request->assignedUsers) || !in_array($dbvalue->userid, $request->assignedUsers)) {
        //DB::delete('DELETE FROM projectgroup_has_users WHERE userid = ? AND projectgroupid = ?', [$dbvalue->userid, $dbvalue->projectgroupid]);
        DB::table('project_group_user')
          ->where('user_id', $dbvalue->userid)
          ->where('project_group_id', $dbvalue->projectgroupid)
          ->delete();
      }
    }

    // removing unnecessary connections with contactpersons
    foreach (
      DB::table('contact_project_group')
        ->where('project_group_id', $projectgroup->id)
        ->get()
      as $dbvalue
    ) {
      if (!isset($request->assignedContacts) || !in_array($dbvalue->contactid, $request->assignedContacts)) {
        //DB::delete('DELETE FROM projectgroup_has_contacts WHERE contactid = ? AND projectgroupid = ?', [$dbvalue->contactid, $dbvalue->projectgroupid]);
        DB::table('contact_project_group')
          ->where('contact_id', $dbvalue->contactid)
          ->where('project_group_id', $dbvalue->projectgroupid)
          ->delete();
      }
    }

    $projectgroup->name = $request->name;
    if ($request->project == -1) {
      $projectgroup->project = null;
    } else {
      $projectgroup->project = $request->project;
    }
    $projectgroup->save();

    return redirect()->route('projectgroup.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Projectgroup $projectgroup
   * @return Response
   */
  public function destroy(Projectgroup $projectgroup)
  {
    if (Auth::user()->isAdmin()) {
      $projectgroup->delete();
    }
    return redirect()->route('projectgroup.index');
  }

  private function matchAdressWithContacts($contacts)
  {
    foreach ($contacts as $contact) {
      if ($contact->address == null) {
        // company address
        $contact->address = null;

        $contact->privateAddress = false;
      } else {
        // personal address
        $contact->address = Address::find($contact->address)
          ->get()
          ->first();

        $contact->privateAddress = true;
      }
      if ($contact->address != null) {
        $contact->formattedAddress =
          $contact->address['streetname'] .
          ' ' .
          $contact->address['number'] .
          $contact->address['addition'] .
          ', ' .
          $contact->address['zipcode'] .
          ', ' .
          $contact->address['city'];
      }
    }
    return $contacts;
  }
}
