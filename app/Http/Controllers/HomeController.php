<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alert;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            $organization = Organization::count();
            $Users = User::count(); 
            $alerts = Alert::count();
            return view('home' , compact("organization" , "Users" , "alerts"));
        } else {
            $organization_members = Organization::where("id", Auth::user()->organization_id)->count(); 
            $organizations = Organization::count(); 
            $alerts = Alert::where("organization_id", Auth::user()->organization_id)->count();
            $sendedAlerts = Alert::where("user_id" , Auth::user()->id)->count();
            
            return view('userdashboard.dashboard' , compact("organization_members" , "organizations" , "alerts" , "sendedAlerts"));
        }
    }
}