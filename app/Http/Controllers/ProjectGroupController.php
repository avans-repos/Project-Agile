<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\contact\Contact;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use function request;

class ProjectGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|View
   */
  public function index()
  {
    $projectgroups = [];

    foreach (ProjectGroup::all() as $projectgroup) {
      $teachers = $projectgroup
        ->users()
        ->role('Teacher')
        ->get();

      $students = $projectgroup
        ->users()
        ->role('Student')
        ->get();

      $project = Project::find($projectgroup->project);

      $projectname = $project != null ? $project->name : 'Geen Project';

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
   * @return Application|Factory|View
   */
  public function create()
  {
    $redirectURL = \request()->headers->get('referer');
    $projectgroup = new Projectgroup();

    $projects = Project::all();

    $students = User::role('Student')
      ->orderBy('name')
      ->get();
    $teachers = User::role('Teacher')
      ->orderBy('name')
      ->get();
    $newContacts = Contact::all()->sortBy(function ($contact) {
      return $contact->getName();
    });
    $newProjects = Project::all()->sortBy('name');

    $this->addClassToStudent($students);

    $assignedUsers = [];
    $assignedContacts = [];
    $assignedProjects = [];

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', $teachers)
      ->with('students', $students)
      ->with('assignedUsers', $assignedUsers)
      ->with('newContacts', $newContacts)
      ->with('assignedContacts', $assignedContacts)
      ->with('newProjects', $newProjects)
      ->with('assignedProjects', $assignedProjects)
      ->with('redirectUrl', $redirectURL)
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param ProjectgroupRequest $request
   * @return RedirectResponse
   */
  public function store(ProjectgroupRequest $request): RedirectResponse
  {
    $request->validated();

    $redirectUrl = $request->get('redirectUrl') ?? route('projectgroup.index');

    $uri_parts = explode('/', $redirectUrl);
    $request_url = $uri_parts[count($uri_parts) - 1] . '-' . $uri_parts[count($uri_parts) - 2];

    if ($request_url == 'create-contact') {
      $redirectUrl = route('projectgroup.index');
    }

    $projectGroup = new Projectgroup();
    $projectGroup->name = $request->name;

    $newProjects = $request->all()['project'] ?? [];

    $projectGroup->save();

    foreach ($newProjects as $newProject) {
      $projectGroup->projects()->attach($newProject);
    }

    // fill in all the users (students and teachers)
    if (isset($request->assignedUsers)) {
      $projectGroup->users()->sync($request->assignedUsers);
    }

    $newContacts = $request->all()['contact'] ?? [];

    foreach ($newContacts as $newContact) {
      $projectGroup->contacts()->attach($newContact);
    }

    return redirect($redirectUrl);
  }

  public function show(Projectgroup $projectgroup)
  {
    $contacts = $projectgroup->contacts()->get();

    $newContacts = Contact::all()->wherenotin('id', $contacts->pluck('id'));

    $projects = $projectgroup->projects()->get();

    return view('projectgroup.show')
      ->with('projects', $projects)
      ->with('projectgroup', $projectgroup)
      ->with('newContacts', $newContacts);
  }

  public function addcontact($projectgroupid, $contactid)
  {
    $projectGroup = Projectgroup::all()
      ->where('id', '=', $projectgroupid)
      ->first();
    try {
      $projectGroup->contacts()->attach($contactid);
    } catch (Exception $ex) {
    }

    return redirect()->route('projectgroup.show', [$projectgroupid]);
  }

  public function removecontact($projectgroupid, $contactid)
  {
    $projectGroup = Projectgroup::all()
      ->where('id', '=', $projectgroupid)
      ->first();
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
    self::addClassToStudent($students);

    $assignedContacts = $projectgroup->contacts()->get();

    $newContacts = Contact::all();

    $assignedUsers = $projectgroup->users()->get();

    $assignedProjects = $projectgroup->projects()->get();

    $newProjects = Project::all();

    return view('projectgroup.manage')
      ->with('projectgroup', $projectgroup)
      ->with('teachers', User::role('teacher')->get())
      ->with('students', User::role('student')->get())
      ->with('newProjects', $newProjects)
      ->with('assignedProjects', $assignedProjects)
      ->with('redirectUrl', null)
      ->with('assignedUsers', $assignedUsers)
      ->with('assignedContacts', $assignedContacts)
      ->with('newContacts', $newContacts)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ProjectgroupRequest $request
   * @param ProjectGroup $projectgroup
   * @return RedirectResponse
   */
  public function update(ProjectgroupRequest $request, Projectgroup $projectgroup)
  {
    $request->validated();

    // insert the connections with users (students and teachers)
    if (isset($request->assignedUsers)) {
      $projectgroup->users()->sync($request->assignedUsers);
    }

    // insert the connections with contactpersons
    $projectgroup->contacts()->sync([]);

    $newContacts = $request->all()['contact'] ?? [];
    foreach ($newContacts as $newContact) {
      $projectgroup->contacts()->attach($newContact - 0);
    }

    $projectgroup->name = $request->name;

    $projectgroup->projects()->sync([]);

    $newProjects = $request->all()['project'] ?? [];
    foreach ($newProjects as $newProject) {
      $projectgroup->projects()->attach($newProject);
    }

    $projectgroup->update();

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
