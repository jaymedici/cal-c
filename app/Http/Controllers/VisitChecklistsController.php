<?php

namespace App\Http\Controllers;

use App\Models\VisitChecklist;
use Illuminate\Http\Request;

class VisitChecklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
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
     * @param  \App\Models\VisitChecklist  $visitChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(VisitChecklist $visitChecklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitChecklist  $visitChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitChecklist $visitChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitChecklist  $visitChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitChecklist $visitChecklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitChecklist  $visitChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitChecklist $visitChecklist)
    {
        //
    }
}
