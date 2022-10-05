<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APFController extends Controller
{
    // display form
    public function index()
    {
        return view('_student-organization.forms.activity-proposal')
        ->with("message", "Hello APF!");
    }

    // save form
    public function store(APFRequest $request)
    {
        
        Form::create($request->validated());
        
        // dd($request);
        return redirect()->route('forms.apf.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
