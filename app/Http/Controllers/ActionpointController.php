<?php

namespace App\Http\Controllers;

use App\Models\Actionpoint;
use Illuminate\Http\Request;

class ActionpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actionpoints = Actionpoint::latest()->paginate(5);

        return view('actionpoints.index', compact('actionpoints'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function show(Actionpoint $actionpoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function edit(Actionpoint $actionpoint)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actionpoint  $actionpoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actionpoint $actionpoint)
    {
        //
    }
}
