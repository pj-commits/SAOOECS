<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Proposal;
use App\Models\PrePrograms;
use Illuminate\Http\Request;
use App\Models\LogisticalNeed;
use App\Models\OrganizationUser;
use App\Http\Requests\APFRequest;
use App\Models\ExternalCoorganizer;
use Illuminate\Support\Facades\Auth;

class APFController extends Controller
{
    // display form
    public function index()
    {
        $authOrgList = Auth::user()->studentOrg;

        return view('_student-organization.forms.activity-proposal', compact('authOrgList'))
        ->with("message", "Hello APF!");
    }

    // save form
    public function store(APFRequest $request)
    {   
     
        //Validate Request // Divide
        $proposal = $request->safe()->except(['coorganization', 'coorganizer_name', 'coorganizer_phone', 'coorganizer_email', 'service', 'logistics_date_needed','logistics_venue', 'activity', 'start_date', 'end_date' ]);
        $coorg = collect($request->safe()->only('coorganization', 'coorganizer_name', 'coorganizer_phone', 'coorganizer_email'));
        $logistics = $request->safe()->only('service', 'logistics_date_needed', 'logistics_venue');
        $activity = collect($request->safe()->only('activity', 'start_date', 'end_date'));

        $proposal = Proposal::create($proposal);

        //Control Number
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10000, 99999)
            . mt_rand(10000, 99999)
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)];
        $controlNumber = str_shuffle($pin);
        
        $form = $proposal->form()->create([
            'prep_by' => auth()->id(),
            'adviser_faculty_id' => 5,
            'sao_staff_id' => 2,
            'acad_serv_id' => 4,
            'finance_staff_id' => 3,
            'form_type' => 'APF',
            'org_id' => $proposal->org_id,
            'control_number' => $controlNumber,
            'event_title' => $proposal->event_title,
        ]);


        dd($coorg);
        

        dd($logistics);
    
        for($i = 0; $i < 3; $i++){
            foreach($logistics as $l => $i){
                dd($l, $i, $logistics);
            }
        }
    
        dd('uwu');
        
        ExternalCoorganizer::create($coorg);
        PrePrograms::create($activity);
        
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
