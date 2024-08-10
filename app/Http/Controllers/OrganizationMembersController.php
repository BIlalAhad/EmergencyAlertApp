<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Organization_member;
use Illuminate\Support\Facades\Auth;

class OrganizationMembersController extends Controller
{
    public function index($id){
        $user_record = User::paginate(5);
        $organization = Organization::all();
        if (Auth::user()->hasRole('Admin')){
            return view ('members.index' , compact('id' , 'user_record' , 'organization'));
        }else{
            return view ('members.organizationMembersView' , compact('id' , 'user_record' , 'organization'));
        }
    }

    public function showOrgMembers($id)
    {
        $organizationMembers = Organization_member::where('organization_id', $id)->with('user')->get();
        return view('members.allmembers', compact('organizationMembers'));
    }
    

    public function destroyMember($id)
    {
        // Find the user by ID
        $user = User::find($id);
        

        if ($user) {
            // Remove the role from the user
            $user->removeRole('organization member');

            // You may also want to remove the user from the organization members table
            Organization_member::where('user_id', $id)->delete();

            // Redirect or return response as needed
            return redirect()->back()->with('success', 'Member role removed successfully');
        }

        // If user not found, return error response
        return redirect()->back()->with('error', 'User not found');
}

        public function members()
        {
            $id = Auth::user()->organization_id;
            $organization = Organization::with(['users' => function($query) {
                $query->role(['organization', 'organization member']);
            }])->find($id);
            
            return view('members.members', compact('organization'));
        }


    public function store($id , $user_id){
        $org_member = Organization_member::where('user_id' , $user_id)->first();
        if($org_member){
            return redirect()->back()
            ->with('error', 'member already exist');
        }else{
            $table = new Organization_member;
            $table->user_id = $user_id;
            $table->organization_id =$id; 
            $table->save();
            $user = User::find($user_id);
            if ($user) {
                $user->assignRole('organization member');
            }
    
            // Redirect or return response as needed
            return redirect()->back()
            ->with('success', 'member added successfully');
        
    }}
}