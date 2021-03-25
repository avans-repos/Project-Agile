<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
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
        $groups = Projectgroup::all();
        $assigned_to_group = DB::table('projectgroup_has_users')->join('users', 'projectgroup_has_users.userid', '=', 'users.id')->select('projectgroupid','users.id', 'users.name')->get();
        return view('projectgroup.index')
          ->with('groups',$groups)
          ->with('assigned_to_group',$assigned_to_group);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $projectgroup = new Projectgroup();


      // When roles are availabe this will be
      // edited to split students from teachers by their role.
      $students = User::all();
      $teachers = User::all();

      $assigned = null;
      return view('projectgroup.manage')
        ->with('projectgroup', $projectgroup)
        ->with('teachers',$teachers)
        ->with('students',$students)
        ->with('assigned',$assigned)
        ->with('action', 'store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectgroupRequest $request)
    {
      $request->validated();
      $id = Projectgroup::create($request->all())->id;

      if (isset($request->assigned)) {
        foreach ($request->assigned as $assigned) {
          DB::insert('INSERT INTO projectgroup_has_users (userid,projectgroupid) VALUES (?,?)', [$assigned, $id]);
        }
      }

      return redirect()->route('projectgroup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projectgroup  $projectgroup
     * @return \Illuminate\Http\Response
     */
    public function show(Projectgroup $projectgroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projectgroup  $projectgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Projectgroup $projectgroup)
    {

      $students = User::all();
      $teachers = User::all();

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
        ->with('teachers',$teachers)
        ->with('students',$students)
        ->with('assigned',$assigned)
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
      foreach (
        DB::table('projectgroup_has_users')
          ->where('projectgroupid', $projectgroup->id)
          ->get()
        as $dbvalue
      ) {
        if (!in_array($dbvalue->userid, $request->assigned)) {
          DB::delete('DELETE FROM projectgroup_has_users WHERE userid = ? AND projectgroupid = ?', [$dbvalue->userid, $dbvalue->projectgroupid]);
        }
      }

      $projectgroup->update($request->all());
      return redirect()->route('projectgroup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projectgroup  $projectgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projectgroup $projectgroup)
    {
      $projectgroup->delete();
      return redirect()->route('projectgroup.index');
    }
}
