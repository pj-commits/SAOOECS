<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Requests\LFRequest;
use Illuminate\Support\Facades\Auth;

class LFController extends Controller
{
    public function index()
    {
        // Fetch !! Approved !! events (via APF) that exists in orgs curr user belongs 
        $eventList = Form::where('form_type', '=', 'APF')
            ->where(function ($query) {
                $authOrgList = Auth::user()->studentOrg->pluck('id')->toArray();
                $query->whereIn('organization_id',$authOrgList);
                $query->where('status','Approved');
            })->orderBy('event_title')->get(['event_title', 'event_id']);

        return view('_student-organization.forms.liquidation', compact('eventList'))
        ->with("message", "Hello LF!"); 
    }

    public function store(LFRequest $request)
    {   
        $lf = $request->safe()->only(['end_date','cash_advance','cv_number','deduct']);
        $event = Form::where('event_id', $request->event_id)->get()->first();

        // get ID for approvers
        $orgAdviser = OrganizationUser::where('organization_id',$request->org_id)
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

     
        $form = Form::create([
            'event_title' => $event->event_title,
            'organization_id' => $event->organization_id,
            'prep_by' => auth()->id(),
            'control_number'=> $this->generateUniqueCode(),
            'adviser_staff_id' => $orgAdviser,
            'sao_staff_id' => $sao,
            'acadserv_staff_id' => $acadserv,
            'finance_staff_id' => $finance ,
            'event_id' => $request->event_id,
            'form_type' => 'LF',
            'target_date' => $event->target_date
        ]);

        // Liquidation Create
        $liquidation = $form->liquidation()->create($lf);

        // Proof of Payments create
        for($i = 0; $i < count($request->itemFrom); $i++){
            $imageName = 'receipt'.time().'.'.$request->image[$i]->extension();
            $liquidation->proofOfPayment()->create([
                'item_from' => $request->itemFrom[$i],
                'item_to' => $request->itemTo[$i],
                'image' => $request->image[$i]->storeAs('receipts',$imageName),
            ]);
        }

        // Liquidation Items create
        for($i = 0; $i < count($request->item_number); $i++){
            $liquidation->liquidationItem()->create([
                    'item_number' => $request->item_number[$i],
                    'date_bought' => $request->date_bought[$i],
                    'item' => $request->item[$i],
                    'price' => $request->price[$i],
                ]);
        }

       
        return redirect('/')->with('add', 'Liquidation Form created successfully!');
       
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function generateUniqueCode()
    {
        do {
            $control_number = random_int(100000, 999999);
        } while (Form::where("control_number", "=", $control_number)->first());
  
        return $control_number;
    }
}
