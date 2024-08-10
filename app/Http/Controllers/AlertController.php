<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;

class AlertController extends Controller
{
    public function index($id)
        {
            return view('alert.index', compact('id'));
        }
        
    public function alerts()
        {
            $org_id = Auth::user()->organization_id;
            $alerts = Alert::where('organization_id', $org_id)->get();
            return view('alert.alerts' , compact('alerts'));
        }

        public function store(Request $request, $id)
        {
            try {
                $request->validate([
                    'address' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'zip' => 'required|string|max:10',
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric',
                    'CNIC' => 'required|file|mimes:jpg,png,pdf|max:2048'
                ]);

                $alert = new Alert;
                $alert->user_id = Auth::user()->id;
                $alert->organization_id = $id;
                $alert->address = $request->address;
                $alert->city = $request->city;
                $alert->zip = $request->zip;
                $alert->latitude = $request->latitude;
                $alert->longitude = $request->longitude;

                // Handle file upload
                if ($request->hasFile('CNIC')) {
                    $path = $request->file('CNIC')->store('alerts', 'public');
                    $alert->CNIC = $path;
                }

                $alert->save();

                return redirect()->back()->with('success', 'Alert sent successfully!');
            } catch (\Exception $e) {
                \Log::error('Failed to send alert: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to send alert: ' . $e->getMessage());
            }
        }

        
        public function proceed_alert(Request $request){
            $alert_id = $request->input('alert_id');
            $record = Alert::find($alert_id);
            if ($record) {
                $record->status = 'proceed';
                $record->save();
                return redirect()->back()->with('success', 'Alert proceed!');
            }
            return redirect()->back()->with('error', 'error');
        }


        public function sended_alerts(){
            $user = Auth::user()->id;
            $record = Alert::where('user_id' , $user)->get();
            return  view('alert.sendedAlerts', compact('record'));
        }

        
        public function organizationAlerts($organization_id){
            $record = Alert::where('organization_id' , $organization_id)->get();
            return  view('alert.organizationAlerts', compact('record'));
        }
        


        

       
       
        
}