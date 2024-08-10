<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Organizationdetail;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrganizationDetailsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:OrganizationDetail-list|OrganizationDetail-create|OrganizationDetail-edit|OrganizationDetail-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:OrganizationDetail-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:OrganizationDetail-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:OrganizationDetail-delete', ['only' => ['destroy']]);
    }
    
    // public function index(){
    //     // if(!empty($id)){
    //     //     $uniqueid = $id;
    //     // }else{
    //         $uniqueid = auth()->user()->organization_id;
    //     // }
        
        
    //     $organization = Organization::with('organizationdetail')->find($uniqueid);
    //     return view('organizationDetails.index', compact('organization'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }

       public function index(){
        // if(!empty($id)){
        //     $uniqueid = $id;
        // }else{
            $uniqueid = auth()->user()->organization_id;
        // }
        $organization = Organization::with('users')->with('organizationdetail')->find($uniqueid);
        return view('organizationDetails.index', compact('organization'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function allOrganization (){
        $organization = Organization::all();
        return view('organizationDetails.all', compact('organization'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // use Illuminate\Http\RedirectResponse;


    public function destroy(request $request)
    {
        
        $id = $request->segment(3);
        // Delete the associated Organizationdetail record
        organization::where('id', $id)->delete();
    
        return redirect()->route('details')
            ->with('success', 'Organization deleted successfully');
    }
    
    // public function destroy(Organization $organization)
    // {
    //     dd($organization);
    //     // Delete the associated Organizationdetail record
    //     Organizationdetail::where('organization_id', $organization->id)->delete();
    
    //     return redirect()->route('details')
    //         ->with('success', 'Organization deleted successfully');
    // }
    
}