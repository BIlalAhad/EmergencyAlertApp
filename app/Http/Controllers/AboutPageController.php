<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutPageController extends Controller
{
    public function index($organization_id)
    {
        $about = AboutPage::where('organization_id' , $organization_id)->first();
        $user = Auth::user();

        if ($user && $user->hasRole('Admin')) {
            return view('about-pages.index', compact('about' , 'organization_id'));
        } elseif ($user && $user->hasAnyRole(['organization', 'organization member'])) {
            return view('about-pages.organization_view_index', compact('about' , 'organization_id'));
        } else {
            return redirect()->route('home'); // Or any other appropriate route
        }
        
    }

    public function create($organization_id)
    {
        $user = Auth::user();
        if ($user && $user->hasRole('Admin')) {
            return view('about-pages.create', compact('organization_id'));
        } elseif ($user && $user->hasAnyRole(['organization', 'organization member'])) {
            return view('about-pages.organization_view_create', compact('organization_id'));
        } else {
            return redirect()->route('home'); // Or any other appropriate route
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading_1' => 'nullable|string|max:255',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paragraph_1' => 'nullable|string',
            'heading_2' => 'nullable|string|max:255',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'paragraph_2' => 'nullable|string',
        ]);

        // Handle image uploads
        if ($request->hasFile('image_1')) {
            $validated['image_1'] = $request->file('image_1')->store('about_images', 'public');
        }

        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $request->file('image_2')->store('about_images', 'public');
        }
        
        
        $old_data = AboutPage::where('organization_id' , $request->organization_id)->first();
        if(!empty($old_data)){
            return redirect()->back()->with('error', 'record already present');
        }
        $about = new AboutPage();
        $about->organization_id = $request->organization_id;
        $about->heading_1 = $request->heading_1;
        
        if ($request->hasFile('image_1')) {
            $about->image_1 = $request->file('image_1')->store('about_images', 'public');
        }

        $about->paragraph_1 = $request->paragraph_1;
        $about->heading_2 = $request->heading_2;

        if ($request->hasFile('image_2')) {
            $about->image_2 = $request->file('image_2')->store('about_images', 'public');
        }

        $about->paragraph_2 = $request->paragraph_2;

        $about->save();


        return redirect()->back()->with('success', 'About page created successfully.');
    }



    
}