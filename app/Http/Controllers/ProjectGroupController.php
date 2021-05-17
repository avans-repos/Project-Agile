<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\Address;
use App\Models\contact\Contact;
use App\Models\StudentClass;
use App\Models\Project;
use App\Models\Projectgroup;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $projectgroups = [];

    foreach (ProjectGroup::all() as $projectgroup) {
      $teachers = $projectgroup->users()->role('Teacher')->get();

      $students =  $projectgroup->users()->role('Student')->get();

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
      $className = $student->classrooms()->first()->name ?? 'Geen Klas';

      $student->classroom = $className;
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

    $projectGroup = new Projectgroup();
    $projectGroup->name = $request->name;

    if ($request->project != -1) {
      $projectGroup->project = $request->project;
    }

    $projectGroup->save();

    // fill in all the users (students and teachers)
    if (isset($request->assignedUsers)) {
      $projectGroup->users()->sync($request->assignedUsers);
    }

    // fill in all the contactpersons
    if (isset($request->assignedContacts)) {
      $projectGroup->contacts()->sync($request->assignedContacts);
    }

    return redirect()->route('projectgroup.index');
  }

  public function show(Projectgroup $projectgroup)
  {
    $assignedUsers = $projectgroup
      ->users()
      ->get()
      ->pluck('id');

    $students = User::role('Student')
      ->whereIn('id', $assignedUsers)
      ->get();

    $teachers = User::role('Teacher')
      ->whereIn('id', $assignedUsers)
      ->get();

    $project = Project::all()
      ->where('id', '=', $projectgroup->project)
      ->first();

    $contacts = $projectgroup->contacts()->get();

    $contacts = self::matchAdressWithContacts($contacts);

    $newContacts = Contact::all()->wherenotin('id', $contacts->pluck('id'));

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
    $projectGroup = Projectgroup::all()->where('id', '=', $projectgroupid)->first();
    $projectGroup->contacts()->attach($contactid);

    return redirect()->route('projectgroup.show', [$projectgroupid]);
  }

  public function removecontact($projectgroupid, $contactid)
  {
    $projectGroup = Projectgroup::all()->where('id', '=', $projectgroupid)->first();
    $projectGroup->contacts()->detach($contactid);

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
    $this->addClassToStudent($students);

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', User::role('teacher')->get())
      ->with('students', User::role('student')->get())
      ->with('contacts', Contact::all())
      ->with('projects', Project::all())
      ->with('assignedUsers', $projectgroup->users()->get())
      ->with('assignedContacts', $projectgroup->contacts()->get())
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
      $projectgroup->users()->sync($request->assignedUsers);
    }

    // insert the connections with contactpersons
    if (isset($request->assignedContacts)) {
      $projectgroup->contacts()->sync($request->assignedContacts);
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
    $projectgroup->delete();
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
