<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Organizationdetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:organization-list|organization-create|organization-edit|organization-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:organization-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:organization-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:organization-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {    
        $organizations = Organization::latest()->paginate(5);
        return view('organizations.index', compact('organizations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function details(){
        $user = Auth::user();

    if ($user && $user->hasRole('Admin')) {
        return view('organizationDetails.admin-view');
    } elseif ($user && $user->hasAnyRole(['organization', 'organization member'])) {
        return view('organizationDetails.organization-view');
    } else {
        return redirect()->route('home'); // Or any other appropriate route
    }
    }

    public function submitDetails(Request $request , $id='')
    {
        $request->validate([
            'DateOfEstablishment' => 'required|date',
            'RegistrationNumber' => 'required|string',
            'HeadquartersAddress' => 'required|string',
            'WebsiteURL' => 'required',
            'NumberOfEmployees' => 'required',
        ]);
        $record = Organizationdetail::where('organization_id' , $id)->first();
        if(!empty($record)){
            return redirect()->route('details')->with('error', '1 record already exist against this organization');
        }
        $details = new Organizationdetail;

        $details->organization_id = $id;
        $details->DateOfEstablishment = $request->DateOfEstablishment;
        $details->RegistrationNumber = $request->RegistrationNumber;
        $details->HeadquartersAddress = $request->HeadquartersAddress;
        $details->WebsiteURL = $request->WebsiteURL;
        $details->NumberOfEmployees = $request->NumberOfEmployees;
    
        if ($details->save()) {
            return redirect()->route('details')->with('success', 'Organization details saved successfully!');
        } else {
            return redirect()->route('details')->with('error', 'Failed to save organization details.');
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        Organization::create($request->all());

        return redirect()->route('organizations.index')
            ->with('success', 'Organization created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization): View
    {
        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization): View
    {
        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $organization->update($request->all());

        return redirect()->route('organizations.index')
            ->with('success', 'Organization updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization): RedirectResponse
    {
        $organization->delete();

        return redirect()->route('organizations.index')
            ->with('success', 'Organization deleted successfully');
    }



    
}