<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use App\Models\Projectgroup;
use Illuminate\Http\Request;

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
        return view('projectgroup.index')->with('groups',$groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $projectgroup = new Projectgroup();
      return view('projectgroup.manage')
        ->with('projectgroup', $projectgroup)
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
      Projectgroup::create($request->all());
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
      return view('projectgroup.manage')
        ->with('projectgroup', $projectgroup)
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
