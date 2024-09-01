<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Alert;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class organizationController extends Controller
{
    public function index(){
        $data =[];
        $data['organization'] = Organization::with('organizationdetail' , 'members' , 'aboutPage')->get();
        return response()->json($data);
    }

    public function profile($user_id){
        $data['profile'] = User::with('profileDetails')->find($user_id);
        return response()->json($data);
    }

    public function alerts($user_id){
        $data['alerts'] = Alert::where('user_id' ,  $user_id)->with('organization')->get();
        return response()->json($data);
    }

    public function post_alert(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'address' => 'required|string|max:255',
                'user_id' => 'required',
                'city' => 'required|string|max:255',
                'zip' => 'required|string|max:10',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'CNIC' => 'required|file|mimes:jpg,png,pdf|max:2048'
            ]);

            $alert = new Alert;
            $alert->user_id = $validatedData['user_id']; // Use Auth::id() for API
            $alert->organization_id = $id;
            $alert->address = $validatedData['address'];
            $alert->city = $validatedData['city'];
            $alert->zip = $validatedData['zip'];
            $alert->latitude = $validatedData['latitude'];
            $alert->longitude = $validatedData['longitude'];

            // Handle file upload
            if ($request->hasFile('CNIC')) {
                $path = $request->file('CNIC')->store('alerts', 'public');
                $alert->CNIC = $path;
            }

            $alert->save();

            return response()->json([
                'message' => 'Alert sent successfully!',
                'alert' => $alert
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Failed to send alert: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to send alert',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function org() {
        $organizations = Organization::all();
        $data = [];
    
        foreach ($organizations as $org) {
            $data[] = [
                'name' => $org->name,
                'id' => $org->id
            ];
        }
    
        return response()->json($data);
    }

}