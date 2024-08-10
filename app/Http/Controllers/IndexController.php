<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $organization = Organization::all();
        return view('home.index', compact('organization'));
    }
}