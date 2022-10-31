<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\RFRequest;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\Auth;

class RFController extends Controller
{
    public function index()
    {
        // Fetch Pending events (via APF) that exists in orgs curr user belongs 
        $eventList = Form::where('form_type', '=', 'APF')
            ->where(function ($query) {
                $authOrgList = Auth::user()->studentOrg->pluck('id')->toArray();
                $query->whereIn('organization_id',$authOrgList);
                $query->where('status','Pending');
            })->orderBy('event_title')->get(['event_title', 'event_id']);
        $departments = Department::orderBy('name')->get();

        return view('_student-organization.forms.budget-requisition', compact('eventList', 'departments'))
        ->with("message", "Hello RF!");
    }

    public function store(RFRequest $request)
    {
        $rf = $request->safe()->except(['event_id','quantity','purpose','price']);
        $event = Form::where('event_id', $request->event_id)->get()->first();

         // get ID for approvers
        $orgAdviser = OrganizationUser::where('organization_id',$event->organization_id)
         ->where('position', 'Adviser')->pluck('id')->first();

        $sao = Staff::whereHas('staffDepartment', function($q){
                $q->where('name', '=', 'Student Activities Office');
            })->where('position', 'Head')->pluck('id')->first();

        $acadserv = Staff::whereHas('staffDepartment', function($q){
                $q->where('name', '=', 'Academic Services');
            })->where('position', 'Head')->pluck('id')->first();

        $finance = Staff::whereHas('staffDepartment', function($q){
                $q->where('name', '=', 'Finance Office');
            })->where('position', 'Head')->pluck('id')->first();
            
            // dd($orgAdviser, $sao,$acadserv,$finance );
        
        $form = Form::create([
            'event_title' => $event->event_title,
            'organization_id' => $event->organization_id,
            'prep_by' => Auth::user()->id,
            'control_number'=> $this->generateUniqueCode(),
            'adviser_staff_id' => $orgAdviser,
            'sao_staff_id' => $sao,
            'acadserv_staff_id' => $acadserv ,
            'finance_staff_id' => $finance,
            'event_id' => $request->event_id,
            'form_type' => 'BRF',
            'target_date' => $event->target_date
        ]);

        // Requisition Create
        $requisition = $form->requisition()->create($rf);

        // Req_Items create
        for($i = 0; $i < count($request->quantity); $i++){
            $requisition->reqItems()->create([
                    'quantity' => $request->quantity[$i],
                    'purposes' => $request->purpose[$i],
                    'price' => $request->price[$i],
                ]);
        }
        return redirect('dashboard')->with('add-rf', 'Budget Requisition Form was successfully created!');
    }

   
    public function update(RFRequest $request, Form $forms)
    {
        $rf = $request->safe()->except(['event_id','quantity','purpose','price']);

        $forms->update(array(
            'event_id' => $request->event_id,
            'status' => 'Pending'
        )); 

        // Requisition update
        $requisition = $forms->requisition()->update($rf);

        // Req_Items update
        for($i = 0; $i < count($request->quantity); $i++){
            $requisition->reqItems()->update([
                    'quantity' => $request->quantity[$i],
                    'purposes' => $request->purpose[$i],
                    'price' => $request->price[$i],
                ]);
        }

        return back()->with('add', 'Updated successfully!');

        
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
    public function generateUniqueCode()
    {
        do {
            $control_number = random_int(100000, 999999);
        } while (Form::where("control_number", "=", $control_number)->first());
  
        return $control_number;
    }

}
