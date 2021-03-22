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
      $group = new Projectgroup();
      return view('projectgroup.manage')
        ->with('group', $group)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projectgroup  $projectgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projectgroup $projectgroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projectgroup  $projectgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projectgroup $projectgroup)
    {
        //
    }
}
