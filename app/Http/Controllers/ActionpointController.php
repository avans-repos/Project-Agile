<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionpointRequest;
use App\Models\Actionpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * This page shows the action points you have created
         *
         */

        $actionPoints = Actionpoint::all();
        return view('actionPoints.index', compact('actionPoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $teachers = array('Ger','Eric','Jurgen');
        $actionpoint = new Actionpoint();
        return view('actionPoints.manage')
            ->with('teachers',$teachers)
            ->with('actionpoint',$actionpoint)
            ->with('action','store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActionpointRequest $request)
    {
        $creator = 'Marijn';

        $request->validated();

        $actionpoint = Actionpoint::create(array_merge($request->all(), ['creator' => $creator]));
        $id = $actionpoint->id;
        foreach($request->assigned as $assigned) {
            DB::insert('INSERT INTO teacher_has_actionpoints (user,actionpointid) VALUES (?,?)',[$assigned,$id]);
        }

        return redirect()->route('actionpoints.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function show(Actionpoint $actionpoint)
    {
        return view('actionPoints.show', compact('actionpoint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function edit(Actionpoint $actionpoint)
    {
        $teachers = array('Ger','Eric','Jurgen');
        return view('actionPoints.manage', compact('actionpoint'))
            ->with('teachers',$teachers)
            ->with('action','update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function update(ActionpointRequest $request, Actionpoint $actionpoint)
    {
        $creator = 'Marijn';

        $request->validated();

        $actionpoint->update(array_merge($request->all(), ['Creator' => $creator]));

        return redirect()->route('actionpoints.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actionpoint $actionpoint)
    {
        $actionpoint->delete();

        return redirect()->route('actionpoints.index');
    }
}
