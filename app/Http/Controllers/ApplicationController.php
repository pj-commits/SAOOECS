<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrgApplication;
use App\Models\User;
use App\Helper\Helper;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index()
    {
        $lists = OrgApplication::where('status', '=', 'Pending')->get();

        return view('_approvers.org-application-list', compact('lists'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'org_name' => 'required',
            'description' => 'required',
            'purpose' => 'required',
        ]);

        OrgApplication::insert([
            'user_id' => auth()->user()->id,
            'org_name' => $request->org_name,
            'description' => $request->description,
            'purpose' => $request->purpose,
            'status' => 'Pending',
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now'))

        ]);

        return redirect()->back()->with('add', 'Your application was sent successfully!');
    }

    public function show($id)
    {
        $applicationData = OrgApplication::findOrFail($id);

        return view('_approvers.org-application-details', compact('applicationData'));
    }

    public function approve($id)
    {
        $application = OrgApplication::findOrFail($id);
        $user = User::findOrFail($application->user_id);

        //Create organization
        $organization = Organization::create([
            'org_name' => $application->org_name,
            'adviser' => $application->getUser()->first()->first_name." ".$application->getUser()->first()->last_name,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now'))
        ]);
        //Attach adviser to 'organization_user' table
        $user->studentOrg()->attach($organization->id, ['position' => 'Adviser', 'role' => 'Moderator']);

        //Update org application status to 'Approved'
        $application->status = "Approved";
        $application->save();

        return redirect()->route('org-application.index')->with('add', 'Application was approved successfully');
    }


    public function deny($id)
    {
        $application = OrgApplication::findOrFail($id);

        $application->status = "Denied";
        $application->save();

        return redirect()->route('org-application.index')->with('add', 'Application was denied successfully');
    }
}
