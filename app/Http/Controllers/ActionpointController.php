<?php

namespace App\Http\Controllers;

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

        return view('actionPoints.create')->with('teachers',$teachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator = 'Marijn';

        $validated = $request->validate([
            'deadline' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        $actionpoint = Actionpoint::create(array_merge($validated, ['creator' => $creator]));
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
        return view('actionPoints.edit', compact('actionpoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actionpoint $actionpoint)
    {
        $creator = 'Marijn';

        $validated = $request->validate([
            'Deadline' => 'required',
            'Title' => 'required',
            'Description' => 'required'
        ]);

        $actionpoint->update(array_merge($validated, ['Creator' => $creator]));

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
