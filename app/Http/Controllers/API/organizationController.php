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
}