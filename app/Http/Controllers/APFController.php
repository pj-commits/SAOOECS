<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Event;
use App\Models\Proposal;
use App\Models\PrePrograms;
use Illuminate\Support\Arr;
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
        //Proposal 
        $proposal = $request->safe()->except(['coorganization', 'coorganizer_name', 'coorganizer_phone', 'coorganizer_email', 'service', 'logistics_date_needed','logistics_venue', 'activity', 'start_date', 'end_date' ]);
        $proposal = Proposal::create($proposal);

        $event =+ 1;

        // Form create
        $form = $proposal->form()->create([
            'event_title' => $proposal->event_title,
            'organization_id' => $proposal->org_id,
            'organization_user_id' => auth()->id(),
            'control_number'=> $this->generateUniqueCode(),
            'adviser_staff_id' => 5,
            'sao_staff_id' => 2,
            'acadserv_staff_id' => 4,
            'finance_staff_id' => 3,
            'event_id' => $event
  
        ]);

        // Logistics create
        for($i = 0; $i < count($request->service); $i++){
            $proposal->logisticalNeed()->create([
                    'service' => $request->service[$i],
                    'date_needed' => $request->logistics_date_needed[$i],
                    'venue' => $request->logistics_venue[$i],
                ]);
        }

         // External Coorg create
         for($i = 0; $i < count($request->coorganization); $i++){
            $proposal->externalCoorganizer()->create([
                    'coorganization' => $request->coorganization[$i],
                    'coorganizer' => $request->coorganizer_name[$i],
                    'email' => $request->coorganizer_phone[$i],
                    'phone_number' => $request->coorganizer_email[$i],
                ]);
        }

        // Pre-programs create
        for($i = 0; $i < count($request->activity); $i++){
            $proposal->preprograms()->create([
                    'activity' => $request->activity[$i],
                    'start_date_time' => $request->start_date[$i],
                    'end_date_time' => $request->end_date[$i],
                ]);
        }

        // dd($proposal, $event, $form);
    
    
        return redirect('/')->with('add', 'APF created successfully!');
    }

    // show form to edit
    public function show($id)
    {
    
    }

    // update form
    public function update(Request $request, $id)
    {
        //
    }

    // delete form
    public function destroy($id)
    {
        //
    }

    // Control Number
    public function generateUniqueCode()
    {
        do {
            $control_number = random_int(100000, 999999);
        } while (Form::where("control_number", "=", $control_number)->first());
  
        return $control_number;
    }

}
